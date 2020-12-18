<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-10 offset-1">
        <div class="card">
          <header class="card-header">
            <strong class="card-title">Update Post</strong>
            <div class="card-tools">
              <router-link to="/posts" class="btn btn-dark"
                >All Posts</router-link
              >
            </div>
          </header>
          <!-- /.card-header -->
          <!-- form start -->
          <form
            class="form-horizontal"
            enctype="multipart/form-data"
            @submit.prevent="updatePost"
          >
          
            <div class="card-body">
              <div class="form-group row">
                <label for="thumbnail" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                  <img :src="form.thumbnail" alt="" style="max-hight: 150px" />
                </div>
              </div>

              <div class="form-group row">
                <label for="thumbnail" class="col-sm-3 col-form-label"
                  >Post Thumbnail</label
                >
                <div class="col-sm-9">
                  <input
                    type="file"
                    name="thumbnail"
                    id="thumbnail"
                    @change="loadThumbnail($event)"
                  />

                  <has-error :form="form" field="thumbnail"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="post" class="col-sm-3 col-form-label"
                  >Post Title</label
                >
                <div class="col-sm-9">
                  <input
                    type="text"
                    id="post"
                    placeholder="Post Title"
                    class="form-control"
                    v-model="form.title"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                  />
                  <has-error :form="form" field="name"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="category" class="col-sm-3 col-form-label"
                  >Post Category</label
                >
                <div class="col-sm-9">
                  <select
                    id="category"
                    class="form-control"
                    v-model="form.category_id"
                  >
                    <option value="null">Select Category</option>
                    <option v-for="category in categories" :value="category.id" :class="category_status(category.status)">
                      {{ category.name | uppercase}}
                    </option>
                  </select>
                  <has-error :form="form" field="category"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="post" class="col-sm-3 col-form-label"
                  >Post Content</label
                >
                <div class="col-sm-9">
                  <ckeditor
                    :editor="editor"
                    v-model="form.content"
                    :config="editorConfig"
                  ></ckeditor>
                  <has-error :form="form" field="content"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="post" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9 mt-2">
                  <div class="form-group form-inline">
                    <div class="form-check mr-4">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="radio1"
                        id="published"
                        value="published"
                        v-model="form.status"
                      />
                      <label class="form-check-label" for="published"
                        >Publish</label
                      >
                    </div>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="radio1"
                        id="draft"
                        value="draft"
                        v-model="form.status"
                      />
                      <label class="form-check-label" for="draft">Draft</label>
                    </div>
                  </div>
                  <span
                    :class="{ 'is-invalid': form.errors.has('status') }"
                  ></span>
                  <has-error :form="form" field="status"></has-error>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <button
                type="submit"
                class="btn btn-dark float-right"
                :disabled="form.busy"
              >
                Update Post
              </button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  name: "post",
  data: function () {
    return {
      form: new Form({
        title: null,
        category_id: null,
        content: null,
        status: null,
        thumbnail: null,
        newThumbnail:false,
        id:null,
        fileType: null,
      }),
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      },
    };
  },
  methods: {
    getPost(id) {
      
      const this_ = this;
      axios.get("/post/show/" + id).then(function (response) {
        this_.form.fill(response.data.post);
        this_.$root.isLoading=false;
         
      });
    },
    updatePost: function () {
      this.load(true);
      let link = this;
      this.form.post("/post/update/").then(function (response) {
        if (response.statusText) {
          link.$router.push("/posts");
          link.successAlert();
          link.form.title = null;
          link.form.category_id = null;
          link.form.content = null;
          link.form.status = null;
          link.form.thumbnail = null;
          link.form.fileType = null;
          link.load(false);
        }
      });
    },
    successAlert: function () {
      toastr.success("Post Successfully Updated.");
    },
    category_status:function(status){
      if(status==0){
        return 'bg-danger';
      }
    }
  },
  mounted() {
    this.getPost(this.$route.params.id);
    this.$store.dispatch("getCategories");
  },
  computed:{
    categories() {
      return this.$store.getters.categories;
    },
  }
};
</script>

<style>
</style>