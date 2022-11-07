<template>
  <div id="upload-file mt-5">
    <div class="row">
      <div class="errors col-12" v-if="errors">
        <div class="alert alert-danger" role="alert">
          <ul>
            <li v-for="error, index in errors" :key="index"> {{ error[0] }} </li>
          </ul>
        </div>
      </div>
      <div class="col-2"></div>
      <div class="col-8">
        <div class="card mb-3">
          <div class="card-header">Upload Image</div>
          <div class="card-body">
            <form class="" enctype="multipart/form-data">
              <label for="title">Title :</label>
              <input
                type="text"
                name=""
                id="title"
                required
                class="form-control"
                v-model="title"
              />
              <label for="description" class="pt-2">Description :</label>
              <input
                id="description"
                type="text"
                class="form-control"
                required
                name=""
                v-model="description"
              />
              <label for="images" class="pt-2">Images :</label>
              <input
                type="file"
                accept="image/*"
                required
                id="images"
                multiple
                class="input-file form-control"
                v-on:change="onChange"
              /><br />
              <!-- <progress max="100" :value.prop="uploadPercentage"></progress> -->
              <div class="progress">
                <div class="progress-bar" role="progressbar" style= "max:100" aria-valuenow="25" :value.prop="uploadPercentage"  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <button
                type="submit"
                class="btn btn-primary"
                @click.prevent="upload"
              >
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-2"></div>
    </div>
  </div>
</template>
  <script>
</script>
<style >
.border {
  border: 1 solid #e2e8f0 !important;
}
</style>
<script>
export default {
  data() {
    return {
      title: "",
      description: "",
      file: [],
      success: "",
      uploadPercentage: 0,
      errors: null,
    };
  },
  methods: {
    handleFileUpload(){
  this.file = this.$refs.file.files[0];
  console.log('this.filethis.file==>',this.file);
},
    onChange(e) {
      if (e.target.files) {
        this.file = e.target.files;
      }
    },
    async upload(e) {
      e.preventDefault();
      let data = new FormData();
      data.append("title", this.title);
      data.append("description", this.description);
      for (let i = 0; i < this.file.length; i++) {
        data.append("file[]", this.file[i]);
      }
        // await axios
        // .post("http://localhost:8000/api/uploadfile", data)
        // .then((res) => {
        //   this.$router.push({ path: `/galleryview` });
        // })
        // .catch((err) => {
        //   this.errors = err.response.data.errors;
        // });
        await axios
        .post("http://localhost:8000/api/uploadfile", data,
            {
                headers: {
                        'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: function( progressEvent ) {
                    this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ) );
                }.bind(this)
            }
            ).then(function(){
                console.log('SUCCESS!!');
            })
            .catch(function(){
                console.log('FAILURE!!');
            });
    },
  },
};
</script>
