<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div
          class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
        >
          <p class="_title0">
            Categories
            <Button @click="addModal = true" v-if="isWrite">
              <Icon type="md-add" />Add Category
            </Button>
          </p>
          <div class="_overflow _table_div">
            <table class="_table" v-if="dataCategories.length">
              <!-- TABLE TITLE -->
              <tr>
                <th>No</th>
                <th>Icon Image</th>
                <th>Nama Category</th>
                <th>Created at</th>
                <th v-if="isUpdate || isDelete">Action</th>
              </tr>

              <!-- ITEMS -->

              <tr v-for="(category, i) in dataCategories" :key="i">
                <td>{{ i + 1 }}</td>
                <td class="table_image">
                  <img
                    v-if="category.iconImage != ''"
                    :src="`/uploads/category/${category.iconImage}`"
                  />
                </td>
                <td class="_table_name">{{ category.name }}</td>
                <td>{{ category.created_at }}</td>
                <td v-if="isUpdate || isDelete">
                  <Button
                    v-if="isUpdate"
                    type="info"
                    size="small"
                    @click="showEditModal(category, i)"
                    >Edit</Button
                  >
                  <Button
                    v-if="isDelete"
                    type="error"
                    size="small"
                    @click="showDeleteModal(category, i)"
                    >Delete</Button
                  >
                </td>
              </tr>
            </table>
          </div>
        </div>

        <!-- Add Modal -->
        <Modal
          title="Add category"
          v-if="isWrite"
          v-model="addModal"
          :closable="false"
          :mask-closable="false"
        >
          <Input v-model="data.name" placeholder="Enter name category" />
          <div class="space"></div>
          <Upload
            v-if="data.iconImage == ''"
            ref="uploads"
            type="drag"
            :headers="{
              'x-csrf-token': token,
              'X-Requested-with': 'XMLHttpRequest',
            }"
            action="/app/uploadImageCategory"
            :on-success="handleSuccess"
            :on-error="handleError"
            :format="['jpg', 'jpeg', 'png']"
            :max-size="2048"
            :on-format-error="handleFormatError"
            :on-exceeded-size="handleMaxSize"
          >
            <div style="padding: 20px 0">
              <Icon
                type="ios-cloud-upload"
                size="52"
                style="color: #3399ff"
              ></Icon>
              <p>Click or drag a image here to upload</p>
            </div>
          </Upload>

          <div class="demo-upload-list" v-if="data.iconImage">
            <img :src="`/uploads/category/${data.iconImage}`" />
            <div class="demo-upload-list-cover">
              <Icon type="ios-trash-outline" @click="deleteImage"></Icon>
            </div>
          </div>
          <div slot="footer">
            <Button type="default" @click="addModal = false">Close</Button>
            <Button type="primary" @click="addData" :loading="isLoading">{{
              isLoading ? "Adding..." : "Add category"
            }}</Button>
          </div>
        </Modal>

        <!-- Edit Modal -->
        <Modal
          v-if="isUpdate"
          title="Edit category"
          v-model="editModal"
          :closable="false"
          :mask-closable="false"
        >
          <Input v-model="editData.name" placeholder="Edit name tag" />
          <div class="space"></div>
          <Upload
            v-show="editData.iconImage == ''"
            ref="editUploads"
            type="drag"
            :headers="{
              'x-csrf-token': token,
              'X-Requested-with': 'XMLHttpRequest',
            }"
            action="/app/uploadImageCategory"
            :on-success="handleSuccess"
            :on-error="handleError"
            :format="['jpg', 'jpeg', 'png']"
            :max-size="2048"
            :on-format-error="handleFormatError"
            :on-exceeded-size="handleMaxSize"
          >
            <div style="padding: 20px 0">
              <Icon
                type="ios-cloud-upload"
                size="52"
                style="color: #3399ff"
              ></Icon>
              <p>Click or drag a image here to upload</p>
            </div>
          </Upload>
          <div class="demo-upload-list" v-if="editData.iconImage">
            <img :src="`/uploads/category/${editData.iconImage}`" />
            <div class="demo-upload-list-cover">
              <Icon type="ios-trash-outline" @click="deleteImage(false)"></Icon>
            </div>
          </div>

          <div slot="footer">
            <Button type="default" @click="closeEditModal">Close</Button>
            <Button type="primary" @click="updateData" :loading="isLoading">{{
              isLoading ? "Editing..." : "Edit category"
            }}</Button>
          </div>
        </Modal>

        <!-- Delete Modal -->
        <deleteModal v-if="isDelete"></deleteModal>
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
      token: "",
      data: {
        name: "",
        iconImage: "",
      },
      addModal: false,
      isLoading: false,
      dataCategories: {},

      editModal: false,
      editData: {
        name: "",
        iconImage: "",
      },
      isEditing: false,
      index: -1,
      deleteModal: false,
      deleteData: {},
    };
  },
  methods: {
    async addData() {
      if (this.isWrite) {
        if (this.data.name.trim() == "") {
          return this.error("Category name is required");
        }
        if (this.data.iconImage.trim() == "") {
          return this.error("Icon image is required");
        }
        this.isLoading = true;
        const res = await this.callApi("post", "app/createCategory", this.data);
        if (res.status == 201) {
          this.success("Category has been added successfully");
          this.dataCategories.unshift(res.data);
          this.data.name = "";
          this.data.iconImage = "";
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
      } else {
        this.wrong();
      }
    },

    showEditModal(category, index) {
      if (this.isUpdate) {
        let obj = {
          id: category.id,
          name: category.name,
          iconImage: category.iconImage,
        };
        this.editData = obj;
        this.editModal = true;
        this.isEditing = true;
        this.index = index;
      } else {
        this.wrong();
      }
    },

    async updateData() {
      if (this.isUpdate) {
        if (this.editData.name.trim() == "") {
          return this.error("Category name is required");
        }
        if (this.editData.iconImage.trim() == "") {
          return this.error("Icon image is required");
        }
        this.isLoading = true;
        const res = await this.callApi(
          "post",
          "app/updateCategory",
          this.editData
        );
        if (res.status == 200) {
          this.success("Tag has been edited successfully");
          this.dataCategories[this.index].name = this.editData.name;
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
      } else {
        this.wrong();
      }
    },

    showDeleteModal(category, i) {
      if (this.isDelete) {
        const deleteObj = {
          title: "Category",
          deleteModal: true,
          url: "app/deleteCategory",
          data: category,
          index: i,
          isDeleted: false,
        };
        this.$store.commit("setDeleteModalObj", deleteObj);
      } else {
        this.wrong();
      }
    },

    async deleteCategory() {
      if (this.isDelete) {
        this.isLoading = true;
        const res = await this.callApi(
          "delete",
          "app/deleteCategory",
          this.deleteData
        );
        if (res.status == 200) {
          this.dataCategories.splice(this.index, 1);
          this.isLoading = false;
          this.deleteModal = false;
          this.success(
            "Category " +
              this.deleteData.name +
              " has been deleted successfully!"
          );
        } else {
          this.wrong();
          this.isLoading = false;
        }
      } else {
        this.wrong();
      }
    },

    handleSuccess(res, file) {
      if (this.isEditing) {
        return (this.editData.iconImage = res);
      }
      this.data.iconImage = res;
    },
    handleError(res, file) {
      this.$Notice.warning({
        title: "The file format is incorrect",
        desc: file.errors.file.length
          ? file.errors.file[0]
          : "Something went wrong",
      });
    },
    handleFormatError(file) {
      this.$Notice.warning({
        title: "The file format is incorrect",
        desc:
          "File format of " +
          file.name +
          " is incorrect, please select jpg or png.",
      });
    },
    handleMaxSize(file) {
      this.$Notice.warning({
        title: "Exceeding file size limit",
        desc: "File  " + file.name + " is too large, no more than 2M.",
      });
    },
    async deleteImage(isAdd = true) {
      if (this.isDelete) {
        let image;
        if (isAdd) {
          image = this.data.iconImage;
          this.data.iconImage = "";
          this.$refs.uploads.clearFiles();
        } else {
          image = this.editData.iconImage;
          this.editData.iconImage = "";
          this.$refs.editUploads.clearFiles();
        }
        const res = await this.callApi("delete", "app/deleteImageCategory", {
          imageName: image,
        });
        if (res.status != 200) {
          this.data.iconImage = image;
          this.wrong();
        }
      } else {
        this.wrong();
      }
    },
    closeEditModal() {
      this.isEditing = false;
      this.editModal = false;
    },
  },

  async created() {
    this.token = window.Laravel.csrfToken;
    const res = await this.callApi("get", "app/dataCategory");
    if (res.status == 200) {
      this.dataCategories = res.data;
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
        this.dataCategories.splice(obj.index, 1);
      }
    },
  },
};
</script>
