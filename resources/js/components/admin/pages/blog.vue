<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
          <Row type="flex" justify="center" align="middle">
            <p class="_title0">New Blog</p>
          </Row>
          <div class="space">
            <Input v-model="data.title" placeholder="Enter title blog" />
          </div>
          <div class="_overflow _table_div blog_editor">
            <editor ref="editor" autofocus :config="config" :init-data="initData" @save="onSave" />
          </div>
          <div class="space">
            <Select
              filterable
              placeholder="Select category"
              v-model="data.category_id"
              v-if="dataCategory.length"
            >
              <Option v-for="(c,i) in dataCategory" :key="i" :value="c.id">{{ c.name}}</Option>
            </Select>
            <Button to="/category" v-else>Add Category</Button>
          </div>
          <div class="space">
            <Select
              filterable
              multiple
              placeholder="Select tag"
              v-model="data.tag_id"
              v-if="dataTag.length"
            >
              <Option v-for="(t,i) in dataTag" :value="t.id" :key="i">{{ t.tagName }}</Option>
            </Select>
            <Button to="/tags" v-else>Add Tag</Button>
          </div>
          <div class="space">
            <Input
              type="textarea"
              :rows="4"
              v-model="data.post_excerpt"
              placeholder="Post excerpt"
            />
          </div>
          <div class="space">
            <Input
              type="textarea"
              :rows="4"
              v-model="data.metaDescription"
              placeholder="Meta description"
            />
          </div>
          <Row type="flex" justify="center" align="middle">
            <div class="space">
              <Button
                type="primary"
                @click="save"
                :loading="isLoading"
              >{{ isLoading?'Please wait':'Save blog' }}</Button>
            </div>
          </Row>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      articleHTML: "",
      dataCategory: [],
      dataTag: [],
      isLoading: false,
      data: {
        title: "",
        post: "",
        post_excerpt: "",
        metaDescription: "",
        category_id: null,
        tag_id: null,
      },
      config: {
        image: {
          endpoints: {
            byFile: "/uploads/blogImage",
          },
          image: {
            field: "image",
            types: "image/*",
          },
        },
      },

      initData: null,
    };
  },
  methods: {
    async onSave(response) {
      var data = response;
      await this.outputHtml(data.blocks);
      this.data.post = this.articleHTML;
      this.data.jsonData = JSON.stringify(data);
      if (this.data.title.trim() == "") return this.error("Title is required");
      if (this.data.post.trim() == "") return this.error("Post is required");
      if (!this.data.category_id) return this.error("Category is required");
      if (!this.data.tag_id.length) return this.error("Tag is required");
      if (this.data.post_excerpt.trim() == "")
        return this.error("Post exerpt is required");
      if (this.data.metaDescription.trim() == "")
        return this.error("Meta description is required");
      this.isLoading = true;
      const res = await this.callApi("post", "app/createBlog", this.data);
      if (res.status === 200) {
        this.success("Blog has been created successfully!");
        // redirect...
        //this.$router.push("blog");
      } else {
        if (res.status == 422) {
          for (let i in res.data.errors) {
            this.error(res.data.errors[i][0]);
          }
        } else {
          this.wrong();
        }
      }
      this.isLoading = false;
    },
    async save() {
      this.$refs.editor.save();
    },
    outputHtml(articleObj) {
      articleObj.map((obj) => {
        switch (obj.type) {
          case "paragraph":
            this.articleHTML += this.makeParagraph(obj);
            break;
          case "image":
            this.articleHTML += this.makeImage(obj);
            break;
          case "header":
            this.articleHTML += this.makeHeader(obj);
            break;
          case "raw":
            this.articleHTML += `<div class="ce-block">
					<div class="ce-block__content">
					<div class="ce-code">
						<code>${obj.data.html}</code>
					</div>
					</div>
				</div>\n`;
            break;
          case "code":
            this.articleHTML += this.makeCode(obj);
            break;
          case "list":
            this.articleHTML += this.makeList(obj);
            break;
          case "quote":
            this.articleHTML += this.makeQuote(obj);
            break;
          case "warning":
            this.articleHTML += this.makeWarning(obj);
            break;
          case "checklist":
            this.articleHTML += this.makeChecklist(obj);
            break;
          case "embed":
            this.articleHTML += this.makeEmbed(obj);
            break;
          case "delimeter":
            this.articleHTML += this.makeDelimeter(obj);
            break;
          default:
            return "";
        }
      });
    },
  },

  async created() {
    const [resCategory, resTag] = await Promise.all([
      this.callApi("get", "app/dataCategory"),
      this.callApi("get", "app/dataTag"),
    ]);

    if (resCategory.status == 200) {
      this.dataCategory = resCategory.data;
    } else {
      this.wrong();
    }

    if (resTag.status == 200) {
      this.dataTag = resTag.data;
    } else {
      this.wrong();
    }
  },
};
</script>
