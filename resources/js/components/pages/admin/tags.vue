<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
          <p class="_title0">
            Tags
            <Button @click="addModal=true">
              <Icon type="md-add" />Add Tag
            </Button>
          </p>
          <div class="_overflow _table_div">
            <table class="_table">
              <!-- TABLE TITLE -->
              <tr>
                <th>No</th>
                <th>Nama Tag</th>
                <th>Created at</th>
                <th>Action</th>
              </tr>

              <!-- ITEMS -->
              <template v-if="dataTags.length">
                <tr v-for="(tag, i) in dataTags" :key="i">
                  <td>{{i+1}}</td>
                  <td class="_table_name">{{ tag.tagName }}</td>
                  <td>{{ tag.created_at }}</td>
                  <td>
                    <Button type="info" size="small" @click="showEditModal(tag, i)">Edit</Button>
                    <Button
                      type="error"
                      size="small"
                      @click="showDeleteModal(tag, i)"
                      :loading="tag.isDeleting"
                    >{{ tag.isDeleting?'Deleting...':'Delete' }}</Button>
                  </td>
                </tr>
              </template>
            </table>
          </div>
        </div>

        <!--~~~~~~~ Add Modal ~~~~~~~~~-->
        <Modal title="Add tag" v-model="addModal" :closable="false" :mask-closable="false">
          <Input v-model="data.tagName" placeholder="Enter name tag" />
          <div slot="footer">
            <Button type="default" @click="addModal=false">Close</Button>
            <Button
              type="primary"
              @click="addTag"
              :loading="isLoading"
            >{{ isLoading?'Adding...':'Add tag' }}</Button>
          </div>
        </Modal>

        <!--~~~~~~~ Edit Modal ~~~~~~~~~-->
        <Modal title="Edit tag" v-model="editModal" :closable="false" :mask-closable="false">
          <Input v-model="editData.tagName" placeholder="Edit name tag" />
          <div slot="footer">
            <Button type="default" @click="editModal=false">Close</Button>
            <Button
              type="primary"
              @click="editTag"
              :loading="isLoading"
            >{{ isLoading?'Editing...':'Edit tag' }}</Button>
          </div>
        </Modal>

        <!--~~~~~~~ Delete Modal ~~~~~~~~~-->
        <Modal v-model="deleteModal" width="360" :closable="false" :mask-closable="false">
          <p slot="header" style="color:#f60;text-align:center">
            <Icon type="ios-information-circle"></Icon>
            <span>Delete confirmation</span>
          </p>
          <div style="text-align:center">
            <p>Are you sure you want to delete this tag ?</p>
          </div>
          <div slot="footer">
            <Button type="error" long :loading="isLoading" @click="deleteTag">Delete</Button>
            <div class="space"></div>
            <Button long @click="deleteModal=false">Cancel</Button>
          </div>
        </Modal>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      data: {
        tagName: "",
      },
      addModal: false,
      isLoading: false,
      dataTags: {},

      editModal: false,
      editData: {
        tagName: "",
      },
      index: -1,
      deleteModal: false,
      deleteData: {},
    };
  },
  methods: {
    async addTag() {
      if (this.data.tagName.trim() == "") {
        return this.error("Tag name is required");
      }
      this.isLoading = true;
      const res = await this.callApi("post", "app/createTag", this.data);
      if (res.status == 201) {
        this.success("Tag has been added successfully");
        this.dataTags.unshift(res.data);
        this.data.tagName = "";
        this.addModal = false;
        this.isLoading = false;
      } else if (res.status == 422) {
        if (res.data.errors.tagName) {
          this.error(res.data.errors.tagName[0]);
          this.isLoading = false;
        }
      } else {
        this.wrong();
        this.isLoading = false;
      }
    },

    showEditModal(tag, index) {
      let obj = {
        id: tag.id,
        tagName: tag.tagName,
      };
      this.editData = obj;
      this.editModal = true;

      this.index = index;
    },

    async editTag() {
      if (this.editData.tagName.trim() == "") {
        return this.error("Tag name is required");
      }
      this.isLoading = true;
      const res = await this.callApi("post", "app/updateTag", this.editData);
      if (res.status == 200) {
        this.success("Tag has been edited successfully");
        this.dataTags[this.index].tagName = this.editData.tagName;
        this.editModal = false;
        this.isLoading = false;
      } else if (res.status == 422) {
        if (res.data.errors.tagName) {
          this.error(res.data.errors.tagName[0]);
          this.isLoading = false;
        }
      } else {
        this.wrong();
        this.isLoading = false;
      }
    },

    showDeleteModal(tag, index) {
      this.deleteModal = true;
      this.deleteData = tag;
      this.index = index;
    },

    async deleteTag() {
      this.isLoading = true;
      const res = await this.callApi(
        "delete",
        "app/deleteTag",
        this.deleteData
      );
      if (res.status == 200) {
        this.dataTags.splice(this.index, 1);
        this.isLoading = false;
        this.deleteModal = false;
        this.success(
          "Tag " + this.deleteData.tagName + " has been deleted successfully!"
        );
      } else {
        this.wrong();
        this.isLoading = false;
      }
    },
  },

  async created() {
    const res = await this.callApi("get", "app/dataTag");
    if (res.status == 200) {
      this.dataTags = res.data;
    } else {
      this.wrong();
    }
  },
};
</script>
