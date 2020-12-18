export default{
    state: {
      categories:[],
      posts:[],
      sliders:[],
      users:[]
    },
    getters:{
        categories(state){
            return state.categories
        },
        posts(state){
          return state.posts
        },
        sliders(state){
          return state.sliders
        },
        users(state){
          return state.users
        }
    },
    
    mutations: {
      categories(state,data){
        state.categories = data;
      },
      posts(state,data){
        state.posts=data;
      },
      sliders(state,data){
        state.sliders=data;
      },
      users(state,data){
        state.users=data;
      }
    },

    actions:{
      // categories
      getCategories(data){
        axios.get("/all-categories")
              .then(function(response){
                data.commit("categories",response.data.categories)
              })
      },
      getActiveCategories(data){
        axios.get("/all-active-categories")
              .then(function(response){
                data.commit("categories",response.data.categories)
              })
      },

      //posts
      getPosts(data){
        axios.get("/all-posts")
            .then(function(response){
              data.commit('posts',response.data.posts)
            })
      },
      getActivePosts(data){
        axios.get("/all-active-posts")
              .then(function(response){
                data.commit("posts",response.data.posts)
              })
      },

      //sliders
      getSliders(data){
        axios.get("/all-sliders")
            .then(function(response){
              data.commit('sliders',response.data.sliders)
            })
      },
      getActiveSliders(data){
        axios.get("/active-sliders")
            .then(function(response){
              data.commit('sliders',response.data.sliders)
            })
      },

      //users
      getUsers(data){
        axios.get("/users")
            .then(function(response){
              data.commit('users',response.data.users)
            })
      },
    }
  }