
<style scoped>
._1adminOverveiw_table_recent {
  margin: 0 auto;
  margin-top: 220px;
}
.login_footer {
  text-align: center;
}
.login_header h3 {
  text-align: center;
  margin-bottom: 25px;
  font-weight: bold;
}
</style>

<template>
  <div>
    <div class="container-fluid">
      <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
      <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20 col-md-4">
        <div class="login_header">
          <h3>Welcome to dashboard</h3>
        </div>
        <div class="space">
          <Input type="text" v-model="data.email" placeholder="Email" />
        </div>
        <div class="space">
          <Input type="password" v-model="data.password" password placeholder="Password" />
        </div>
        <div class="login_footer space">
          <Button
            type="primary"
            @click="login"
            :loading="isLoading"
          >{{ isLoading?'Login...':'Login' }}</Button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {
        email: "",
        password: "",
      },
      isLoading: false,
    };
  },
  methods: {
    async login() {
      if (this.data.email.trim() == "") {
        return this.error("Email is required");
      }
      if (this.data.password.trim() == "") {
        return this.error("Password is required");
      }
      this.isLoading = true;
      const res = await this.callApi("post", "app/login", this.data);

      if (res.status == 200) {
        this.success(res.data.msg);
        window.location = "/";
      } else {
        if (res.status == 401) {
          this.warng(res.data.msg);
        } else if (res.status == 422) {
          for (let i in res.data.errors) {
            this.error(res.data.errors[i][0]);
          }
        } else {
          this.wrong;
        }
      }
      this.isLoading = false;
    },
  },
};
</script>
