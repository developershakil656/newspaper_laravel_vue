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
                   v-if="categoryPosts">{{categoryName | uppercase}} News</span
                >
              </h3>
            </div>
            <div class="col-md-6" v-for="(post,index) in categoryPosts" v-if="index == 0">
              <router-link :to="`/post/${post.slug}`">
                <img
                  :src="post.thumbnail"
                  width="100%"
                  style="margin-bottom: 15px"
                />
                <h4>{{post.title | uppercase}}</h4>
              </router-link>
              <p align="justify" v-html="$options.filters.subString(post.content,200)"></p>
              <router-link :to="`/post/${post.slug}`">Read more</router-link>
            </div>

            <div class="col-md-6">
              <div
                class="row"
                style="
                  border-bottom: 1px solid #ccc;
                  padding-bottom: 10px;
                  margin-bottom: 10px;"
                
                 v-for="(post,index) in categoryPosts" v-if="0<index & 4>index"
              >
                <div class="col-md-5">
                  <div class="row">
                    <router-link :to="`/post/${post.slug}`">
                    <img
                      :src="post.thumbnail"
                      width="100%"
                    />
                    </router-link>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="row">
                    <router-link :to="`/post/${post.slug}`">
                      <h4>{{post.title | uppercase}}</h4>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>

                <div class="col-md-12" style="padding: 50px;">
          <div class="row text-dark">

            <div class="row">
                <div class="col-xs-6" v-for="(post,index) in categoryPosts" v-if="index>3" style="padding-left:20px; padding-right:20px">
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
            
            
          </div>
        </div>

        <div v-if="categoryPosts.length==0">
              <h3>No Result Found!</h3>
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
        categoryPosts:[],
        categoryName:'',
      }
    },
    components:{
      'sidebar':sidebarVue
    },
    watch:{
      $route(){
        const this_= this;
          this.getCategoryPosts(this.$route.params.slug,function(response){
              this_.categoryPosts= response.data.posts;
              this_.categoryName= response.data.categoryName;
          })
      }
    },
    mounted(){
      const this_ = this;
      this.getCategoryPosts(this.$route.params.slug,function(response){
            this_.categoryPosts= response.data.posts;
            this_.categoryName= response.data.categoryName;
      })
    },
}
</script>

<style>

</style>