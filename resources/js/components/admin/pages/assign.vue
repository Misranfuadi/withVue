<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
          <p class="_title0">
            Role Assign
            <Select
              v-model="data.role_id"
              placeholder="Select role"
              v-if="dataRoles.length"
              style="width: 200px"
              @on-change="changeAdmin"
            >
              <Option :value="role.id" v-for="(role,i) in dataRoles" :key="i">{{ role.roleName }}</Option>
            </Select>
          </p>
          <div class="_overflow _table_div">
            <table class="_table">
              <!-- TABLE TITLE -->
              <tr>
                <th>No</th>
                <th>Name Resource</th>
                <th>Read</th>
                <th>Write</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>

              <!-- ITEMS -->

              <tr v-for="(data, i) in dataAssign" :key="i">
                <td>{{i+1}}</td>
                <td class="_table_name">{{ data.sourceName }}</td>
                <td>
                  <Checkbox v-model="data.read" :disabled="data.write||data.update||data.delete"></Checkbox>
                </td>
                <td>
                  <Checkbox v-model="data.write" @on-change="data.read= true"></Checkbox>
                </td>
                <td>
                  <Checkbox v-model="data.update" @on-change="data.read= true"></Checkbox>
                </td>
                <td>
                  <Checkbox v-model="data.delete" @on-change="data.read= true"></Checkbox>
                </td>
              </tr>
            </table>
            <div class="space">
              <Button
                type="info"
                @click="updateRole"
                :loading="isLoading"
              >{{ isLoading?'Updating...':'Update' }}</Button>
            </div>
          </div>
        </div>
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
        role_id: "",
      },
      dataRoles: [],
      isLoading: false,
      dataAssign: [],
      dataAssignFresh: [
        {
          sourceName: "Home",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "/",
          icon: "ios-speedometer",
        },
        {
          sourceName: "Tags",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "tags",
          icon: "ios-paper",
        },
        {
          sourceName: "Category",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "category",
          icon: "md-cog",
        },
        {
          sourceName: "User Management",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "user",
          icon: "ios-people",
        },
        {
          sourceName: "Role Management",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "role",
          icon: "md-key",
        },
        {
          sourceName: "Role Assignment",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "assign",
          icon: "md-options",
        },
        {
          sourceName: "Blogs",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "blog",
          icon: "ios-paper",
        },
      ],
    };
  },
  methods: {
    async updateRole() {
      this.isLoading = true;
      let data = JSON.stringify(this.dataAssign);
      const res = await this.callApi("post", "app/updateAssign", {
        permission: data,
        id: this.data.role_id,
      });
      if (res.status == 200) {
        this.success("Role has been assigned succsessfully!");
        let index = this.dataRoles.findIndex(
          (role) => role.id == this.data.role_id
        );
        this.dataRoles[index].permission = data;
      } else {
        this.wrong();
      }
      this.isLoading = false;
    },
    changeAdmin() {
      let index = this.dataRoles.findIndex(
        (role) => role.id == this.data.role_id
      );
      let permission = this.dataRoles[index].permission;
      if (!permission) {
        this.dataAssign = this.dataAssignFresh;
      } else {
        this.dataAssign = JSON.parse(permission);
      }
    },
  },

  async created() {
    const res = await this.callApi("get", "app/dataRole");
    if (res.status == 200) {
      this.dataRoles = res.data;
      if (res.data.length) {
        this.data.role_id = res.data[0].id;
        if (res.data[0].permission) {
          this.dataAssign = JSON.parse(res.data[0].permission);
        }
      }
    } else {
      this.wrong();
    }
  },
};
</script>
