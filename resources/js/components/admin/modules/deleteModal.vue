<template>
  <div>
    <Modal v-model="getDeleteObj.deleteModal" width="360" :closable="false" :mask-closable="false">
      <p slot="header" style="color:#f60;text-align:center">
        <Icon type="ios-information-circle"></Icon>
        <span>Delete confirmation</span>
      </p>
      <div style="text-align:center">
        <p>Are you sure you want to delete this data?</p>
      </div>
      <div slot="footer">
        <Button type="error" long :loading="isLoading" @click="deleteData">Delete</Button>
        <div class="space"></div>
        <Button long @click="closeModal">Cancel</Button>
      </div>
    </Modal>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      isLoading: false,
    };
  },
  methods: {
    async deleteData() {
      this.isLoading = true;
      const res = await this.callApi(
        "delete",
        this.getDeleteObj.url,
        this.getDeleteObj.data
      );
      if (res.status == 200) {
        // this.dataCategories.splice(this.index, 1);
        this.success(
          this.getDeleteObj.title + " has been deleted successfully!"
        );
        this.$store.commit("setDeleteModal", true);
        this.isLoading = false;
      } else {
        this.wrong();
        this.$store.commit("setDeleteModal", false);
        this.isLoading = false;
      }
    },
    closeModal() {
      this.$store.commit("setDeleteModal", false);
    },
  },
  computed: {
    ...mapGetters(["getDeleteObj"]),
  },
};
</script>
