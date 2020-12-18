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
                <img
                  :src="post.thumbnail"
                  width="100%"
                  style="margin-bottom: 15px"
                />
                <h2>{{post.title | uppercase}}</h2>
              <p align="justify" v-html="post.content"></p>
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
        post:{},
      }
    },
    components:{
      'sidebar':sidebarVue
    },
    mounted(){
        this.getPost(this.$route.params.slug);
    },
    methods:{
        getPost(slug) {
          this.load(true);
            const this_ = this;
            axios.get("/post/" + slug)
              .then(function (response) {
                this_.post = response.data.post

                this_.load(false);
            });
        }
    },
    watch:{
      $route(){
        this.getPost(this.$route.params.slug)
      }
    },
}
</script>

<style>

</style>