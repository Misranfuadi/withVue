<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
          <p class="_title0">
            Users
            <Button @click="addModal=true">
              <Icon type="md-add" />Add User
            </Button>
          </p>
          <div class="_overflow _table_div">
            <table class="_table" v-if="dataUsers.length">
              <!-- TABLE TITLE -->
              <tr>
                <th>No</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Type User</th>
                <th>Created at</th>
                <th>Action</th>
              </tr>

              <!-- ITEMS -->

              <tr v-for="(user, i) in dataUsers" :key="i">
                <td>{{i+1}}</td>
                <td class="_table_name">{{ user.fullName }}</td>
                <td>{{ user.email }}</td>
                <td style="text-transform: capitalize">{{ user.role.roleName }}</td>
                <td>{{ user.created_at }}</td>
                <td>
                  <Button type="info" size="small" @click="showEditModal(user, i)">Edit</Button>
                  <Button
                    type="error"
                    size="small"
                    @click="showDeleteModal(user, i)"
                    :loading="user.isDeleting"
                  >{{ user.isDeleting?'Deleting...':'Delete' }}</Button>
                </td>
              </tr>
            </table>
          </div>
        </div>

        <!--~~~~~~~ Add Modal ~~~~~~~~~-->
        <Modal title="Add tag" v-model="addModal" :closable="false" :mask-closable="false">
          <div class="space">
            <Input type="text" v-model="data.fullName" placeholder="Full Name" />
          </div>
          <div class="space">
            <Input type="email" v-model="data.email" placeholder="Email" />
          </div>
          <div class="space">
            <Input type="password" v-model="data.password" placeholder="Password" />
          </div>
          <div class="space">
            <Select v-model="data.role_id" placeholder="Select user type" v-if="dataRoles.length">
              <Option :value="role.id" v-for="(role,i) in dataRoles" :key="i">{{ role.roleName }}</Option>
            </Select>
          </div>
          <div slot="footer">
            <Button type="default" @click="addModal=false">Close</Button>
            <Button
              type="primary"
              @click="addData"
              :loading="isLoading"
            >{{ isLoading?'Adding...':'Add User' }}</Button>
          </div>
        </Modal>

        <!--~~~~~~~ Edit Modal ~~~~~~~~~-->
        <Modal title="Edit user" v-model="editModal" :closable="false" :mask-closable="false">
          <div class="space">
            <Input type="text" v-model="editData.fullName" placeholder="Full Name" />
          </div>
          <div class="space">
            <Input type="email" v-model="editData.email" placeholder="Email" />
          </div>
          <div class="space">
            <Input type="password" v-model="editData.password" placeholder="Password" />
          </div>
          <div class="space">
            <Select
              v-model="editData.role_id"
              placeholder="Select user type"
              v-if="dataRoles.length"
            >
              <Option :value="role.id" v-for="(role,i) in dataRoles" :key="i">{{ role.roleName }}</Option>
            </Select>
          </div>
          <div slot="footer">
            <Button type="default" @click="editModal=false">Close</Button>
            <Button
              type="primary"
              @click="updateData"
              :loading="isLoading"
            >{{ isLoading?'Editing...':'Edit user' }}</Button>
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
        fullName: "",
        email: "",
        password: "",
        role_id: "",
      },
      addModal: false,
      isLoading: false,
      dataUsers: {},

      dataRoles: {},

      editModal: false,
      editData: {
        fullName: "",
        email: "",
        password: "",
        role_id: "",
        role: { roleName: "" },
      },
      index: -1,
      deleteModal: false,
      deleteData: {},
    };
  },
  methods: {
    async addData() {
      if (this.data.fullName.trim() == "") {
        return this.error("Full Name is required");
      }
      if (this.data.email.trim() == "") {
        return this.error("Email is required");
      }
      if (this.data.password.trim() == "") {
        return this.error("Password is required");
      }
      if (!this.data.role_id) {
        return this.error("User Type is required");
      }
      this.isLoading = true;
      const res = await this.callApi("post", "app/createUser", this.data);
      if (res.status == 201) {
        this.success("Tag has been added successfully");
        this.dataUsers.unshift(res.data);
        this.data.fullName = "";
        this.data.email = "";
        this.data.password = "";
        this.data.role_id = "";
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

    showEditModal(user, index) {
      let obj = {
        id: user.id,
        fullName: user.fullName,
        email: user.email,
        role_id: user.role_id,
        created_at: user.created_at,
        role: { roleName: user.role.roleName },
      };
      this.editData = obj;
      this.editModal = true;

      this.index = index;
    },

    async updateData() {
      if (this.editData.fullName.trim() == "") {
        return this.error("Full Name is required");
      }
      if (this.editData.email.trim() == "") {
        return this.error("Email is required");
      }
      if (!this.editData.role_id) {
        return this.error("User Type is required");
      }
      this.isLoading = true;
      const res = await this.callApi("post", "app/updateUser", this.editData);
      if (res.status == 200) {
        this.success("User has been edited successfully");
        this.dataUsers[this.index] = this.editData;
        this.editData.password = "";
        this.editModal = false;
        this.isLoading = false;
      } else if (res.status == 422) {
        for (let i in res.data.errors) {
          this.error(res.data.errors[i][0]);
        }
        this.isLoading = false;
      } else {
        this.wrong();
        this.isLoading = false;
      }
    },

    showDeleteModal(user, i) {
      const deleteObj = {
        title: "User",
        deleteModal: true,
        url: "app/deleteUser",
        data: user,
        index: i,
        isDeleted: false,
      };
      this.$store.commit("setDeleteModalObj", deleteObj);
    },
  },

  async created() {
    const [res, resRole] = await Promise.all([
      this.callApi("get", "app/dataUser"),
      this.callApi("get", "app/dataRole"),
    ]);

    if (res.status == 200) {
      this.dataUsers = res.data;
    } else {
      this.wrong();
    }

    if (res.status == 200) {
      this.dataRoles = resRole.data;
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
        this.dataUsers.splice(obj.index, 1);
      }
    },
  },
};
</script>
