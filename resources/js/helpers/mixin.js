const { Callbacks } = require('jquery');

window.Vue = require('vue');

Vue.mixin({
    methods:{
        sweetConfirm: function (callback,total){
            Swal.fire({
                title: "Are you sure?",
                text: "You want to remove",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, remove it!",
              }).then((result) => {
                if (result.isConfirmed) {
                  callback();
                  
                }
              });
        },
        loadThumbnail: function (e) {
          let file = e.target.files[0];
          if (file.type == 'image/jpeg'||'image/png') {
              let reader = new FileReader();
              reader.onload = e => {
                  this.form.thumbnail = e.target.result;
                  this.form.fileType= file.type;
              }
              reader.readAsDataURL(file);
          } else {
              toastr.error('Something');
          }
      },
      getCategoryPosts: function(slug,callback){
        this.load(true);
        const this_=this;
      axios.get("/all-category-posts/"+slug)
            .then(function(response){
              callback(response)
              this_.load(false);
            })
            .catch(function(){
              this_.load(false);
            });
            
      },
      load:function(set){
        this.$root.isLoading=set;
      }
    }
})