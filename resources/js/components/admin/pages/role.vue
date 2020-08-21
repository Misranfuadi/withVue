<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
          <p class="_title0">
            Roles
            <Button @click="addModal=true">
              <Icon type="md-add" />Add Role
            </Button>
          </p>
          <div class="_overflow _table_div">
            <table class="_table" v-if="dataRoles.length">
              <!-- TABLE TITLE -->
              <tr>
                <th>No</th>
                <th>Nama Role</th>
                <th>Created at</th>
                <th>Action</th>
              </tr>

              <!-- ITEMS -->
              <tr v-for="(role, i) in dataRoles" :key="i">
                <td>{{i+1}}</td>
                <td class="_table_name">{{ role.roleName }}</td>
                <td>{{ role.created_at }}</td>
                <td>
                  <Button type="info" size="small" @click="showEditModal(role, i)">Edit</Button>
                  <Button type="error" size="small" @click="showDeleteModal(role, i)">Delete</Button>
                </td>
              </tr>
            </table>
          </div>
        </div>

        <!--~~~~~~~ Add Modal ~~~~~~~~~-->
        <Modal title="Add role" v-model="addModal" :closable="false" :mask-closable="false">
          <Input v-model="data.roleName" placeholder="Enter name role" />
          <div slot="footer">
            <Button type="default" @click="addModal=false">Close</Button>
            <Button
              type="primary"
              @click="addData"
              :loading="isLoading"
            >{{ isLoading?'Adding...':'Add role' }}</Button>
          </div>
        </Modal>

        <!--~~~~~~~ Edit Modal ~~~~~~~~~-->
        <Modal title="Edit role" v-model="editModal" :closable="false" :mask-closable="false">
          <Input v-model="editData.roleName" placeholder="Edit name role" />
          <div slot="footer">
            <Button type="default" @click="editModal=false">Close</Button>
            <Button
              type="primary"
              @click="updateData"
              :loading="isLoading"
            >{{ isLoading?'Editing...':'Edit role' }}</Button>
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
        roleName: "",
      },
      addModal: false,
      isLoading: false,
      dataRoles: {},

      editModal: false,
      editData: {
        roleName: "",
      },
      index: -1,
      deleteModal: false,
      deleteData: {},
    };
  },
  methods: {
    async addData() {
      if (this.data.roleName.trim() == "") {
        return this.error("Role name is required");
      }
      this.isLoading = true;
      const res = await this.callApi("post", "app/createRole", this.data);
      if (res.status == 201) {
        this.success("Role has been added successfully");
        this.dataRoles.unshift(res.data);
        this.data.roleName = "";
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

    showEditModal(role, index) {
      let obj = {
        id: role.id,
        roleName: role.roleName,
      };
      this.editData = obj;
      this.editModal = true;

      this.index = index;
    },

    async updateData() {
      if (this.editData.roleName.trim() == "") {
        return this.error("Role name is required");
      }
      this.isLoading = true;
      const res = await this.callApi("post", "app/updateRole", this.editData);
      if (res.status == 200) {
        this.success("Role has been edited successfully");
        this.dataRoles[this.index].roleName = this.editData.roleName;
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

    showDeleteModal(role, i) {
      const deleteObj = {
        title: "Role",
        deleteModal: true,
        url: "app/deleteRole",
        data: role,
        index: i,
        isDeleted: false,
      };
      this.$store.commit("setDeleteModalObj", deleteObj);
    },
  },

  async created() {
    const res = await this.callApi("get", "app/dataRole");
    if (res.status == 200) {
      this.dataRoles = res.data;
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
        this.dataRoles.splice(obj.index, 1);
      }
    },
  },
};
</script>
