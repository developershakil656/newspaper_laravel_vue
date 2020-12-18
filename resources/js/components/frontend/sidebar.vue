<template>
  <div>
        <div class="col-md-4">

          <div class="col-md-12" style="border: 1px solid #ccc; padding: 15px">
            <h3 style="border-bottom: 3px solid #2b99ca; padding-bottom: 5px">
              <span style="padding: 6px 12px; background: #2b99ca"
                >Latest NEWS</span
              >
            </h3>
            <div
              class="col-md-12"
              style="
                border-bottom: 1px solid #ccc;
                padding-bottom: 10px;
                margin-bottom: 10px;
              "
              v-for="(post,index) in posts"
              v-if="3<index & 13>index"
            >
              <router-link :to="`/post/${post.slug}`">
                <div class="col-md-4">
                <div class="row">
                  <img
                    :src="post.thumbnail"
                    width="100%"
                    style="margin-left: -15px"
                  />
                </div>
              </div>
              <div class="col-md-8">
                <div class="row" style="padding-left: 10px">
                  <h4>{{post.title | uppercase}}</h4>
                </div>
              </div>
              </router-link>
            </div>

            <div class="col-md-12 text-center" style="padding: 30px 0px">
              <img src="assets/frontend/images/add.jpg" width="80%" />
            </div>
          
          
          </div>

          <div
            class="col-md-12"
            style="
              border: 1px solid #ccc;
              padding: 15px 15px 30px 15px;
              margin-top: 30px;
            "
          >
            <div class="col-md-12">
              <h3 style="border-bottom: 3px solid #2b99ca; padding-bottom: 5px">
                <span style="padding: 6px 12px; background: #2b99ca"
                  >MORE CATEGORIES</span
                >
              </h3>
            </div>
            <div class="col-md-6" v-for="(category,index) in categories" v-if=" 6 < index">
              <router-link :to="`/category/${category.slug}`">
                <h4>{{category.name | uppercase}}</h4>
              </router-link>
            </div>
          </div>

          
        </div>
  </div>
</template>

<script>
export default {
    name:'sidebar',
    mounted(){
        this.$store.dispatch("getActivePosts");
        this.$store.dispatch("getActiveCategories");
    },
    computed: {
        posts() {
        return this.$store.getters.posts;
        },
        categories() {
        return this.$store.getters.categories;
        },
    }
}
</script>

<style>

</style>