<template>
  <div class="text-left">
    <nav class="navbar navbar-expand-lg navbar-light bg-light naigation">
      <div class="collapse navbar-collapse naigation">
        <div class="navbar-nav">
          <router-link to="/" class="nav-item nav-link">Home</router-link>
          <router-link to="/galleryview" class="nav-item nav-link"
            >Gallery View</router-link
          >
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "navbar",
};
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: black;
}
.naigation button {
  width: 100px;
  color: black !important;
  height: 35px;
}
</style>
