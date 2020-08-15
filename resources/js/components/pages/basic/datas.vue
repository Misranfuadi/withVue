<template>
  <div>
    <h2>data counter {{counter}}</h2>
    <button @click="ubah(1)">Tambah</button>
    <button @click="ubah(-1)">Kurang</button>
    <br />

    <div>
      <h2 v-if="showItem">ini tampilan TRUE</h2>
      <h2 v-else>ini tampilan FALSE</h2>
    </div>

    <button @click="showItem = !showItem">Ubah tampilan</button>

    <br />
    <div v-if="blogs.length">
      <div v-for="(blog, i) in blogs" :key="i">
        <h3>{{blog.title}}</h3>
        <p>{{blog.post}}</p>
      </div>
    </div>
    <div v-else>
      <h2>no data</h2>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      counter: 1000,
      blogs: [],
      showItem: true,
    };
  },

  methods: {
    ubah(angka) {
      this.counter += angka;
    },
  },

  created() {
    this.counter = 0;

    let posts = [
      {
        title: "judul 1",
        post: "ini isi post 1",
        id: 1,
      },
      {
        title: "judul 2",
        post: "ini isi post 2",
        id: 2,
      },
      {
        title: "judul 3",
        post: "ini isi post 3",
        id: 3,
      },
      {
        title: "judul 4",
        post: "ini isi post 4",
        id: 4,
      },
    ];

    this.blogs = posts;
  },
};
</script>
