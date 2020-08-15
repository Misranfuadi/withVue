<template>
  <div>
    <h2 ref="test">ini contoh hook</h2>
    <h3>Ini namanya {{name}}</h3>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "sapa aja",
    };
  },

  beforeCreate() {
    console.log(this.name);
  },
  created() {
    console.log("data name", this.name);
  },
  mounted() {
    console.log(this.$refs.test);
  },
};
</script>
