<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 offset-2">
        <div class="card">
          <header class="card-header">
            <strong class="card-title">Add a New Category</strong>
            <div class="card-tools">
              <router-link to="/categories" class="btn btn-dark"
                >All Categories</router-link
              >
            </div>
          </header>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" @submit.prevent="addCategory">
            <div class="card-body">
              <div class="form-group row">
                <label for="category" class="col-sm-3 col-form-label"
                  >Category Name</label
                >
                <div class="col-sm-9">
                  <input
                    type="text"
                    id="category"
                    placeholder="Category Name"
                    class="form-control"
                    v-model="form.name"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                  />
                  <has-error :form="form" field="name"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="category" class="col-sm-3 col-form-label"
                  >Status</label
                >
                <div class="col-sm-9 mt-2">
                  <div class="form-group form-inline">
                    <div class="form-check mr-4">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="radio1"
                        id="active"
                        value=1
                        v-model="form.status"
                      />
                      <label class="form-check-label" for="active">Active</label>
                    </div>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="radio1"
                        id="inactive"
                        value=0
                        v-model="form.status"
                      />
                      <label class="form-check-label" for="inactive">Inactive</label>
                    </div>
                  </div>
                  <span :class="{ 'is-invalid': form.errors.has('status') }"></span>
                  <has-error :form="form" field="status"></has-error>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <button type="submit" class="btn btn-dark float-right" :disabled="form.busy">
                Add Category
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
export default {
  name: "category",
  data: function () {
        return {
          form:new Form({
            name:null,
            status:1
          }),
          test:'test'
        };
      },
  mounted(){
    this.load(false);
  },
  methods:{
    addCategory:function(){
      this.load(true);
      let link=this;
      this.form.post('/category/create')
            .then(function(response){
              if(response.statusText){
                toastr.success('Category Successfully Added.');
                link.form.name=null;
              }
               link.load(false);
            });

     
    },
  }
};
</script>

<style>
</style>