<template>
  <div>
    <div class="m-5">
      <div class="row">
        <div class="col-3 mb-3" v-for="item in allData" :key="item.id">
          <div class="card card-main border p-2">
            <div class="pb-2">
              <div
                :id="'data' + item.id"
                class="carousel slide"
                data-ride="carousel"
              >
                <div class="carousel-inner">
                  <div
                    class="carousel-item"
                    v-for="(image, i) in item.file"
                    :key="i"
                    :class="i === 0 ? 'active' : ''"
                  >
                    <div class="image">
                      <img
                        class="img-size"
                        v-bind:src="image"
                        alt="First slide"
                      />
                    </div>
                  </div>
                </div>
                <a
                  class="carousel-control-prev"
                  :href="'#data' + item.id"
                  role="button"
                  data-slide="prev"
                >
                  <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a
                  class="carousel-control-next"
                  :href="'#data' + item.id"
                  role="button"
                  data-slide="next"
                >
                  <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                  ></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
            <div class="card-title pl-3 pr-3">
              <h3 class="">{{ item.title }}</h3>
              <p class="description">{{ item.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      allData: null,
    };
  },
  async mounted() {
    console.log("all data comonent mounted.");
    const abc = await axios
      .get("http://localhost:8000/api/all")
      .then((response) => {
        const data = response.data.data.map(function (el) {
          el.file = JSON.parse(el.file);
          return el;
        });
        console.log(data, "data");
        this.allData = data;
      })
      .catch((err) => {
        console.log("error==>", err);
      });
  },
};
</script>

<style scoped>
.img-size {
  width: 250px;
  display: block;
  margin: auto;
}
.carousel-item {
  height: 260px;
  overflow: hidden;
}
.card-main {
  box-shadow: 1px 3px 7px rgba(0, 0, 0, 0.25);
}
.image {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}
.description {
  display: -webkit-box;
  height:45px;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  font-size: 14px;
}
.card-title h3 {
    font-weight: 600;
    font-size: 18px;
}
</style>
