<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div
          class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
        >
          <p class="_title0">
            Tags
            <Button @click="addModal = true" v-if="isWrite">
              <Icon type="md-add" />Add Tag
            </Button>
          </p>
          <div class="_overflow _table_div">
            <table class="_table" v-if="dataTags.length">
              <!-- TABLE TITLE -->
              <tr>
                <th>No</th>
                <th>Nama Tag</th>
                <th>Created at</th>
                <th v-if="isUpdate || isDelete">Action</th>
              </tr>

              <!-- ITEMS -->
              <tr v-for="(tag, i) in dataTags" :key="i">
                <td>{{ i + 1 }}</td>
                <td class="_table_name">{{ tag.tagName }}</td>
                <td>{{ tag.created_at }}</td>
                <td v-if="isUpdate || isDelete">
                  <Button
                    type="info"
                    size="small"
                    v-if="isUpdate"
                    @click="showEditModal(tag, i)"
                    >Edit</Button
                  >
                  <Button
                    type="error"
                    size="small"
                    v-if="isDelete"
                    @click="showDeleteModal(tag, i)"
                    >Delete</Button
                  >
                </td>
              </tr>
            </table>
          </div>
        </div>

        <!--~~~~~~~ Add Modal ~~~~~~~~~-->
        <Modal
          title="Add tag"
          v-model="addModal"
          :closable="false"
          :mask-closable="false"
        >
          <Input v-model="data.tagName" placeholder="Enter name tag" />
          <div slot="footer">
            <Button type="default" @click="closeModal">Close</Button>
            <Button type="primary" @click="addData" :loading="isLoading">{{
              isLoading ? "Adding..." : "Add tag"
            }}</Button>
          </div>
        </Modal>

        <!--~~~~~~~ Edit Modal ~~~~~~~~~-->
        <Modal
          title="Edit tag"
          v-model="editModal"
          :closable="false"
          :mask-closable="false"
        >
          <Input v-model="editData.tagName" placeholder="Edit name tag" />
          <div slot="footer">
            <Button type="default" @click="editModal = false">Close</Button>
            <Button type="primary" @click="updateData" :loading="isLoading">{{
              isLoading ? "Editing..." : "Edit tag"
            }}</Button>
          </div>
        </Modal>

        <!--~~~~~~~ Delete Modal ~~~~~~~~~-->
        <deleteModal></deleteModal>
      </div>
    </div>
  </div>
</template>
<script>
import deleteModal from "../modules/deleteModal";
import { mapGetters } from "vuex";
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
    async addData() {
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
        for (let i in res.data.errors) {
          this.error(res.data.errors[i][0]);
        }
      } else {
        this.wrong();
      }
      this.isLoading = false;
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

    async updateData() {
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
        for (let i in res.data.errors) {
          this.error(res.data.errors[i][0]);
        }
      } else {
        this.wrong();
      }
      this.isLoading = false;
    },

    showDeleteModal(tag, i) {
      const deleteObj = {
        title: "Tag",
        deleteModal: true,
        url: "app/deleteTag",
        data: tag,
        index: i,
        isDeleted: false,
      };
      this.$store.commit("setDeleteModalObj", deleteObj);
    },

    closeModal() {
      this.data.tagName = "";
      this.addModal = false;
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
  components: {
    deleteModal,
  },

  computed: {
    ...mapGetters(["getDeleteObj"]),
  },
  watch: {
    getDeleteObj(obj) {
      if (obj.isDeleted) {
        this.dataTags.splice(obj.index, 1);
      }
    },
  },
};
</script>
