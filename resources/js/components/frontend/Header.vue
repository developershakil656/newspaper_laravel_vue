<template>
  <div style="z-index: 20; position: relative;">
    <div class="wrapper" style="padding: 5px 0">
      <div class="row" id="top">
        <div class="col-md-9 top-left">
          <div class="col-md-6">
            <span class="day">{{ date | uppercase }}</span>
          </div>
          <div class="col-md-6"></div>
        </div>
        <div class="col-md-3" style="margin: 5px 0">
          <router-link
            to="/login/google"
            class="btn btn-block"
            style="background: #2ca0c9; color: #fff"
            v-if="!user"
            ><i
              class="fab fa-google"
              style="margin-right: 10px; padding: 5px"
            ></i
            >Sing In With <label>Google</label></router-link
          >
          <button
            class="btn btn-block"
            style="background: #2ca0c9; color: #fff"
            @click="logout"
            v-if="user"
          >
            <img
              :src="user.image"
              alt=""
              style="
                height: 30px;
                width: 30px;
                border-radius: 50%;
                margin: 0px 15px;
              "
            />Logout <label> {{ user.name }}</label>
          </button>
        </div>
      </div>
    </div>
    <hr />

    <div class="wrapper">
      <div class="row brand">
        <div class="col-md-4 name">
          <font color="#555555">NEWS</font><font color="#2ca0c9">PAPER</font>
        </div>
        <div class="col-md-8">
          <img
            src="assets/frontend/images/final-news-site_06.gif"
            width="100%"
          />
        </div>
      </div>
    </div>

    <div class="main-menu">
      <div class="menu">
        <nav class="navbar">
          <div class="navbar-header">
            <button
              type="button"
              class="navbar-toggle"
              data-toggle="collapse"
              data-target="#mynavbar"
              style="float: left"
            >
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="nav nav-justified">
              <li>
                <router-link to="/"
                  ><i class="fas fa-home"></i> Home</router-link
                >
              </li>

              <li v-for="(category, index) in categories" v-if="index < 7">
                <router-link :to="`/category/${category.slug}`">
                  {{ category.name | uppercase }}
                </router-link>
              </li>
            </ul>
          </div>
        </nav>
      </div>

      <!-- search option  -->
      <div class="search" style="position: absolute; right: 0">
        <form @submit.prevent="searchThis()">
          <input type="search" class="form-control" v-model="search" /><i
          class="fas fa-search"
          style="position: relative; right: -17px; color: #fff; top: -26px; cursor: pointer;"
          @click="searchThis()"
        ></i>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",
  data: function () {
    return {
      date: "",
      user: {},
      search:""
    };
  },
  mounted() {
    this.$store.dispatch("getActiveCategories");
    this.date_function();
    this.checkAuth();
  },
  watch:{
    $route(){
        if(!this.$router.currentRoute.path.includes('/search/')){
          this.search='';
        }
    }
  },
  computed: {
    categories() {
      return this.$store.getters.categories;
    },
  },
  methods: {
    date_function: function () {
      let day = {
        0: "sunday",
        1: "monday",
        2: "tuesday",
        3: "wednesday",
        4: "thusday",
        5: "friday",
        6: "saturday",
      };

      var currentDate = new Date();
      this.date =
        day[currentDate.getDay()] +
        ", " +
        currentDate.getDate() +
        "-" +
        (currentDate.getMonth() + 1) +
        "-" +
        currentDate.getFullYear();
    },
    logout() {
      this.load(true);
      const this_ = this;
      
      axios
        .post("/logout")
        .then((response) => {
          this_.user = null;
          toastr.success('Logout Success!.');
          this.load(false);
        })
        .catch((error) => {
          location.reload();
          this.load(false);
        });
    },
    checkAuth: function () {
      const this_ = this;
      axios.get("/check-auth").then((response) => {
        this_.user = response.data.user;
        if(this_.user){
          toastr.success('Welcome Back '+this_.user.name +'!');
        }
      });
    },

    searchThis:function(){
      let find= this.search;
      if(find){
        this.$router.push(`/search/${find}`);
      }
      
    }

  },
};
</script>

<style>
</style>