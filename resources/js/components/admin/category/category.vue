<template >
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-1">
        <section class="card">
          <header class="card-header">
            <h3 class="card-title">Manage All Category</h3>
            <div class="card-tools">
              <router-link to="/add-category" class="btn btn-dark"
                >Add Category</router-link
              >
            </div>
          </header>
          <div class="card-body">
            <div class="adv-table">

              <div class="mb-2">
                <button class="btn btn-danger pr-4" @click="deleteAll()" :disabled="!isChecked"><i class="fas fa-trash-alt text-white mr-2"></i>Delete</button>
                <button class="btn btn-success pr-4" @click="changeStatus('Active')" :disabled="!isChecked"><i class="fas fa-arrow-up text-white mr-2"></i>Active</button>
                <button class="btn btn-warning pr-4" @click="changeStatus('Inactive')" :disabled="!isChecked"><i class="fas fa-arrow-down text-white mr-2"></i>Inctive</button>
              </div>

              

              <table
                class="display table table-bordered table-striped laravel-vue-datatable"
                id="dynamic-table"
              >
                <thead>
                  <tr>
                    <th><input type="checkbox" v-model="allChecked" @click="isAllChecked"> NO.</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th style="width: 200px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="gradeX" v-for="(category, index) in categories">
                    
                    <td><input type="checkbox" :value="category.id" v-model="checkedIds"> {{ ++index }}</td>
                    <td>{{ category.name }}</td>
                    <td>
                      <p class="badge p-2" :class="statusColor(category.status)">
                        {{ showStatus(category.status) }}
                      </p>
                    </td>
                    <td class="text-right">

                      <router-link :to="`/edit-category/${category.slug}`" class="btn btn-xs btn-info" ><i class="fas fa-edit text-white"></i></router-link>

                    </td>
                  </tr>
                  <tr class="text-danger text-center" v-if="emptyData()"><td colspan="5">No Data Found!</td></tr>
                </tbody>
              </table> 
            </div>
          </div>
        </section>
      </div>
      </div>
  </div>
</template>

<script>

export default {
  name: "category",
  data:function(){
    return{
      isChecked:false,
      checkedIds:[],
      allChecked:false,
    }
  },
  mounted() {
    this.load(true);
    this.$store.dispatch("getCategories");
    this.emptyData();
    this.load(false);
  },
  computed: {
    categories() {
      
      return this.$store.getters.categories;
      
      
    },
  },
  watch: {
      checkedIds: function (checkedIds) {
          this.isChecked = (checkedIds.length>0);
          this.allChecked = (checkedIds.length>0);

          this.allChecked = (checkedIds.length === this.categories.length);
      }
  },
  methods: {
    showStatus: function (status) {
      let display = {
        0: "Inactive",
        1: " Active ",
      };
      return display[status];
    },
    statusColor: function (status) {
      let display = {
        0: "bg-danger",
        1: "bg-success",
      };
      return display[status];
    },
    emptyData:function(){
      return this.categories.length<1;
    },
    isAllChecked:function(){
      if(!this.allChecked){
        this.categories.forEach(category => {
          this.checkedIds.push(category.id);
        });
      }else{
        this.checkedIds=[]
      }
    },
    deleteAll:function(){

       const link=this;
       let data=this.checkedIds;
       let total=this.checkedIds.length;

      this.sweetConfirm(function(){
      link.load(true);
          axios.post("/category/delete/all",{data:data}).then(function () {
              link.isChecked=false,
              link.checkedIds=[],
              link.allChecked=false,

              Swal.fire("Deleted!", "Your "+total+" Categories has been deleted.", "success");
              toastr.success(total+" Categories Successfully Delated");
              link.$store.dispatch("getCategories");
              link.load(false);
          });
          },total);
        
    },
    changeStatus:function(status){
      this.load(true);
      const link=this;
       let data=this.checkedIds;
       let total=this.checkedIds.length;

       let statusIn = (status=='Active'?1:0);

        axios.post("/category/change/all",{data:data, status:statusIn}).then(function (response) {
        link.isChecked=false,
        link.checkedIds=[],
        link.allChecked=false,

        toastr.success(total+" Categories Successfully "+status);
        link.$store.dispatch("getCategories");
        link.load(false);
        });
      
    },
  }  
};
</script>


<style>
</style>


