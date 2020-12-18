<template>
  <div>
      <div class="wrapper">
        <div class="row" style="margin-top: 30px">
        <div class="col-md-8">
          <div
            class="col-md-12"
            style="border: 1px solid #ccc; padding: 15px 15px 30px 0px"
          >
            <div class="col-md-12">
              <h3 style="border-bottom: 3px solid rgb(43, 153, 202); padding-bottom: 5px">
                <span style="padding: 6px 12px; background: rgb(43, 153, 202)"
                   > Search By- {{$route.params.slug}}</span
                >
              </h3>
            </div>

                <div class="col-md-12" style="padding: 50px;">
          <div class="row text-dark">

            <div class="row">
                <div class="col-xs-6" v-for="(post,index) in SearchPosts" style="padding-left:20px; padding-right:20px">
                  <router-link :to="`/post/${post.slug}`">
                   <img
                  :src="post.thumbnail"
                  width="100%"
                  style="margin-bottom: 15px"
                  />
                  <h3 style="color:black;">{{post.title | uppercase }}</h3>
                </router-link>
                  <p v-html="$options.filters.subString(post.content,140)"></p>
                </div>
            </div>
            <div v-if="SearchPosts.length==0">
              <h3>No Result Found!</h3>
            </div>
            
            
          </div>
        </div>
          </div>

          
    
        </div>

        <sidebar></sidebar>
      
      </div>
      </div>
  </div>
</template>

<script>
import sidebarVue from './sidebar.vue';

export default {
    name:'forntend',
    data:function(){
      return{
        SearchPosts:[],
      }
    },
    components:{
      'sidebar':sidebarVue
    },
    watch:{
      $route(){
          this.getSearchPosts(this.$route.params.slug)
      }
    },
    mounted(){
      this.getSearchPosts(this.$route.params.slug)
    },
    methods:{
      getSearchPosts: function(slug){
        this.load(true);
        const this_=this;
      axios.post("/search/", {slug:slug})
            .then(function(response){
              this_.SearchPosts= response.data.posts;

              this_.load(false);
            });
      },
    }
}
</script>

<style>

</style>