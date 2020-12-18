<template>
  <div>
    <div class="wrapper main-content" style="overflow:hidden">
      <div class="row">
        <div class="col-md-6" style="max-height: 350px; overflow: hidden;">
          <div class="slick_slider">
            <div class="single_iteam" v-for="(slider,index) in sliders" v-if="slider">
              <router-link :to="`/post/${slider.slug}`">
                <img :src="slider.thumbnail" alt=""
              /></router-link>
              <div class="slider_article">
                <h2>
                  <router-link :to="`/post/${slider.slug}`">{{slider.title}}</router-link>
                </h2>
                <p v-html="$options.filters.subString(slider.content,120)"></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6" style="padding-left: 20px;">
          <div class="row text-dark">

            <div class="row">
                <div class="col-xs-6" v-for="(post,index) in posts" v-if="index<2" style="border-right:1px solid #333131; border-left:1px solid #333131; height: 150px; overflow:hidden; margin-bottom:5px">
                  <router-link :to="`/post/${post.slug}`">

                  <h3 style="color:black;">{{post.title | uppercase }}</h3>
                  <p v-html="$options.filters.subString(post.content,120)"></p>

                </router-link>
                </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xs-6" v-for="(post,index) in posts" v-if="1<index & 4>index" style="border-left:1px solid #333131; border-right:1px solid #333131; height: 150px; overflow:hidden;  margin-bottom:5px">
                <router-link :to="`/post/${post.slug}`">

                  <h3 style="color:black;">{{post.title | uppercase}}</h3>
                  <p v-html="$options.filters.subString(post.content,120)"></p>

                </router-link>
              </div>
            </div>
            <hr>
            
          </div>
        </div>
      </div>


      <div class="row" style="margin-top: 30px">
        <div class="col-md-8">
          <div
            class="col-md-12"
            style="border: 1px solid #ccc; padding: 15px 15px 30px 0px"
          >
            <div class="col-md-12">
              <h3 style="border-bottom: 3px solid rgb(43, 153, 202); padding-bottom: 5px">
                <span style="padding: 6px 12px; background: rgb(43, 153, 202)"
                  >Top News</span
                >
              </h3>
            </div>
            <div class="col-md-6" v-for="(post,index) in posts" v-if="index == 9">
              <router-link :to="`/post/${post.slug}`">
              <img
                :src="post.thumbnail"
                width="100%"
                style="margin-bottom: 15px"
              />
              </router-link>
              <p align="justify" v-html="$options.filters.subString(post.content,220)"></p>
              <router-link :to="`/post/${post.slug}`">Read more</router-link>
            </div>

            <div class="col-md-6">
              <div
                class="row"
                style="
                  border-bottom: 1px solid #ccc;
                  padding-bottom: 10px;
                  margin-bottom: 10px;"
                
                 v-for="(post,index) in posts" v-if="12<index & 18>index"
              >
                <div class="col-md-4">
                  <div class="row">
                    <router-link :to="`/post/${post.slug}`">
                    <img
                      :src="post.thumbnail"
                      width="100%"
                    />
                    </router-link>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="row">
                    <router-link :to="`/post/${post.slug}`">
                      <h4>{{post.title | uppercase}}</h4>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div
                class="col-md-12"
                style="border: 1px solid #ccc; padding-bottom: 30px"
              >
                <div
                  class="col-md-12"
                  style="
                    border-bottom: 1px solid #ccc;
                    padding: 20px 10px;
                    margin-bottom: 10px;
                  "
                >
                  <h3
                    style="
                      border-bottom: 3px solid #d95757;
                      padding-bottom: 5px;
                    "
                  >
                    <span style="padding: 6px 12px; background: #d95757"
                      ><router-link to="category/sports" style="color:white">CORONA</router-link></span
                    >
                  </h3>
                  <div v-for="(post,index) in corona" v-if="index==0">
                    <router-link :to="`/post/${post.slug}`">
                        <img
                        :src="post.thumbnail"
                        width="100%"
                        style="margin-bottom: 15px"
                      />
                    </router-link>
                  <p align="justify" v-html="$options.filters.subString(post.content,140)"></p>
                 <router-link :to="`/post/${post.slug}`"> Read More</router-link>
                  
                  </div>
                </div>
                <div
                  class="col-md-12"
                  style="
                    border-bottom: 1px solid #ccc;
                    padding-bottom: 10px;
                    margin-bottom: 10px;
                  "
                  v-for="(post,index) in corona" v-if="index>0 & index<6"
                >
                  <div class="col-md-4">
                    <div class="row fashion">
                      <router-link :to="`/post/${post.slug}`">
                        <img
                        :src="post.thumbnail"
                        width="100%"
                      />
                    </router-link>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="row" style="padding-left: 0px">
                      <router-link :to="`/post/${post.slug}`"><h4>{{post.title | uppercase}}</h4></router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div
                class="col-md-12"
                style="border: 1px solid #ccc; padding-bottom: 30px"
              >
                <div
                  class="col-md-12"
                  style="
                    border-bottom: 1px solid #ccc;
                    padding: 20px 10px;
                    margin-bottom: 10px;
                  "
                >
                  <h3
                    style="
                      border-bottom: 3px solid #d95757;
                      padding-bottom: 5px;
                    "
                  >
                    <span style="padding: 6px 12px; background: #d95757"
                      ><router-link to="category/sports" style="color:white">SPORTS</router-link></span
                    >
                  </h3>
                  <div v-for="(post,index) in sports" v-if="index==0">
                    <router-link :to="`/post/${post.slug}`">
                        <img
                        :src="post.thumbnail"
                        width="100%"
                        style="margin-bottom: 15px"
                      />
                    </router-link>
                  <p align="justify" v-html="$options.filters.subString(post.content,140)"></p>
                 <router-link :to="`/post/${post.slug}`"> Read More</router-link>
                  
                  </div>
                </div>
                <div
                  class="col-md-12"
                  style="
                    border-bottom: 1px solid #ccc;
                    padding-bottom: 10px;
                    margin-bottom: 10px;
                  "
                  v-for="(post,index) in sports" v-if="index>0 & index<6"
                >
                  <div class="col-md-4">
                    <div class="row fashion">
                      <router-link :to="`/post/${post.slug}`">
                        <img
                        :src="post.thumbnail"
                        width="100%"
                      />
                    </router-link>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="row" style="padding-left: 0px">
                      <router-link :to="`/post/${post.slug}`"><h4>{{post.title | uppercase}}</h4></router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div
                class="col-md-12"
                style="
                  border: 1px solid #ccc;
                  padding: 15px 15px 30px 0px;
                  margin-top: 30px;
                "
              >
                <div class="col-md-12">
                  <h3
                    style="
                      border-bottom: 3px solid #81d742;
                      padding-bottom: 5px;
                    "
                  >
                    <span style="padding: 6px 12px; background: #81d742"
                      ><router-link to="category/travel" style="color:white">TECHNOLOGY</router-link></span
                    >
                  </h3>
                </div>
                <div class="col-md-6" v-for="(post,index) in technology" v-if="index==0">
                  <router-link :to="`/post/${post.slug}`">
                        <img
                        :src="post.thumbnail"
                        width="100%"
                        style="margin-bottom: 15px"
                      />
                    </router-link>
                  <p align="justify" v-html="$options.filters.subString(post.content,220)"></p>
                 <router-link :to="`/post/${post.slug}`"> Read More</router-link>
                </div>
                <div class="col-md-6">
                  <div
                    class="row"
                    style="
                      border-bottom: 1px solid #ccc;
                      padding-bottom: 10px;
                      margin-bottom: 10px;
                    "
                    v-for="(post,index) in technology" v-if="index>0 & index<6"
                  >
                    <div class="col-md-4">
                  <div class="row">
                    <router-link :to="`/post/${post.slug}`">
                    <img
                      :src="post.thumbnail"
                      width="100%"
                    />
                    </router-link>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="row">
                    <router-link :to="`/post/${post.slug}`">
                      <h4>{{post.title | uppercase}}</h4>
                    </router-link>
                  </div>
                </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-12 image-gallery">
              <div
                class="col-md-12"
                style="
                  border: 1px solid #ccc;
                  padding: 15px 15px 30px 15px;
                  margin-top: 30px;
                "
              >
                <h3
                  style="border-bottom: 3px solid #81d742; padding-bottom: 5px"
                >
                  <span style="padding: 6px 12px; background: #81d742"
                    ><router-link to="category/travel" style="color:white">TRAVEL</router-link></span
                  >
                </h3>
                <div class="row">
                  <div class="col-md-3" v-for="(post,index) in travel" v-if="index<10 & post.thumbnail != null">
                    
                <router-link :to="`/post/${post.slug}`">
                <img :src="post.thumbnail" style="width:100%; min-height:77px" />
                </router-link>
                </div>
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
  name: "home",
  data:function(){
    return{
      sports:null,
      corona:null,
      travel:null,
      technology:null
    }
  },
  components:{
    sidebar: sidebarVue
  },
  mounted(){
    const this_ = this;
    
    this.$store.dispatch("getActivePosts");
    this.$store.dispatch("getActiveCategories");
    this.$store.dispatch("getActiveSliders");

    this.getCategoryPosts('sports',function(response){
          this_.sports= response.data.posts;
    });
    this.getCategoryPosts('corona',function(response){
          this_.corona= response.data.posts;
    });
    this.getCategoryPosts('technology',function(response){
          this_.technology= response.data.posts;
    });
    this.getCategoryPosts('travel',function(response){
          this_.travel= response.data.posts;
    })
  },
  computed: {
    posts() {
      return this.$store.getters.posts;
    },
    categories() {
      return this.$store.getters.categories;
    },
    sliders() {
      return this.$store.getters.sliders;
    },
  }

};
</script>

<style>
</style>