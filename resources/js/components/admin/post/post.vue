<template >
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <section class="card">
          <header class="card-header">
            <h3 class="card-title">Manage All Posts</h3>
            <div class="card-tools" @click="load(true)" >
              <router-link to="/add-post" class="btn btn-dark" 
                >Add Post</router-link
              >
            </div>
          </header>
          <router-link @click="load(true)" to="">true</router-link>
          
          <div class="card-body">
            <div class="adv-table">

              <div class="mb-2">
                <button class="btn btn-danger pr-4" @click="deleteAll()" :disabled="!isChecked"><i class="fas fa-trash-alt text-white mr-2"></i>Delete</button>
                <button class="btn btn-success pr-4" @click="changeStatus('Published')" :disabled="!isChecked"><i class="fas fa-arrow-up text-white mr-2"></i>Active</button>
                <button class="btn btn-warning pr-4" @click="changeStatus('Draft')" :disabled="!isChecked"><i class="fas fa-arrow-down text-white mr-2"></i>Inctive</button>
                <button class="btn btn-info pr-4" @click="addSlider()" :disabled="!isChecked"><i class="fas fa-arrow-up text-white mr-2"></i>Add to Slider</button>
              </div>

              <table
                class="display table table-bordered table-striped table-responsive"
              >
                <thead>
                  <tr>
                    <th><input type="checkbox" v-model="allChecked" @click="isAllChecked"> NO.</th>
                    <th>Category</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th style="width: 75px">Slider</th>
                    <th style="width: 75px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="gradeX" v-for="(post, index) in laravelData.data">
                    <td><div style="width: 27px;"><input type="checkbox" :value="post.id" v-model="checkedIds"> {{ ++index }}</div></td>
                    <td>{{post.category.name}}</td>
                    <td><img style="width:150px" :src="post.thumbnail" alt=""></td>
                    <td>{{post.title}}</td>
                    <td><p v-html="$options.filters.subString(post.content,120)"></p></td>
                    <td><p class="badge" :class="statusColor(post.status)">{{post.status | capitalize}}</p></td>
                    <td>
                      <i class="fas fa-check-circle text-success" style="border-radius:50%; font-size:20px" v-if="post.slider"></i>
                      <i class="fas fa-exclamation-circle text-warning" style="border-radius:50%; font-size:20px background:#343a40" v-if="!post.slider"></i>
                    </td>
                    <td class="text-right">
                      <router-link :to="`/edit-post/${post.id}`" class="btn btn-xs btn-info" ><i class="fas fa-edit text-white"></i></router-link>
                    </td>
                  </tr>
                  <tr class="text-danger text-center" v-if="emptyData()"><td colspan="7">No Data Found!</td></tr>
                </tbody>       

              </table>
              <!-- pagination component -->
              <pagination :data="laravelData" @pagination-change-page="getResults">
	<span slot="prev-nav">&lt; Previous</span>
	<span slot="next-nav">Next &gt;</span>
</pagination>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "post",
  data:function(){
    return{
      isChecked:false,
      checkedIds:[],
      allChecked:false,
      laravelData: {}
    }
  },
  mounted() {
    // this.$store.dispatch("getPosts");
    this.getResults();
  },
  watch: {
      checkedIds: function (checkedIds) {
          this.isChecked = (checkedIds.length>0);
          this.allChecked = (checkedIds.length>0);

          this.allChecked = (checkedIds.length === this.laravelData.length);
      },
  },
  computed: {
    // posts() {
    //   return this.$store.getters.posts;
    // },
  },
  methods: {
    
    getResults(page = 1) {
      this.load(true);

			axios.get('all-posts?page=' + page)
				.then(response => {
          this.laravelData = response.data;

          this.load(false);
				});
		},
    statusColor: function (status) {
      let display = {
        "draft": "bg-danger",
        "published": "bg-success",
      };
      return display[status];
    },
    emptyData:function(){
      return this.laravelData.data.length<1;
    },
    
    isAllChecked:function(){
      if(!this.allChecked){
        this.checkedIds=[];
        this.laravelData.data.forEach(post => {
          this.checkedIds.push(post.id);
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
          axios.post("/post/delete/all",{data:data}).then(function () {
              link.isChecked=false,
              link.checkedIds=[],
              link.allChecked=false,

              Swal.fire("Deleted!", "Your "+total+" Posts has been deleted.", "success");
              toastr.success(total+" Posts Successfully Delated");
              // link.$store.dispatch("getPosts");
              link.getResults(link.laravelData.current_page);
          });
          },total);
        
    },
    changeStatus:function(status){
      this.load(true);
      const link=this;
       let data=this.checkedIds;
       let total=this.checkedIds.length;

       let statusIn = (status=='Published'?'published':'draft');

        axios.post("/post/change/all",{data:data, status:statusIn}).then(function (response) {
        link.isChecked=false,
        link.checkedIds=[],
        link.allChecked=false,

        toastr.success(total+" Posts Successfully "+status);
        // link.$store.dispatch("getPosts");
        link.getResults(link.laravelData.current_page);
        });
    },
    addSlider:function(status){
      this.load(true);
      const link=this;
       let data=this.checkedIds;
       let total=this.checkedIds.length;

      //  let statusIn = (status=='Published'?'published':'draft');

        axios.post("/add/slider",{data:data}).then(function (response) {
        link.isChecked=false,
        link.checkedIds=[],
        link.allChecked=false,

        toastr.success(total+" Posts Successfully Added to Sliders");
        // link.$store.dispatch("getPosts");
        link.getResults(link.laravelData.current_page);
        });
    },
  },
};
</script>


<style>
</style>


