<template >
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <section class="card">
          <header class="card-header">
            <h3 class="card-title">Manage All Users</h3>
            <div class="card-tools">
              
            </div>
          </header>
          <div class="card-body">
            <div class="adv-table">

              <div class="mb-2">
                <button class="btn btn-danger pr-4" @click="deleteAll()" :disabled="!isChecked"><i class="fas fa-trash-alt text-white mr-2"></i>Delete</button>
                <button class="btn btn-success pr-4" @click="changeStatus('Active')" :disabled="!isChecked"><i class="fas fa-arrow-up text-white mr-2"></i>Active</button>
                <button class="btn btn-warning pr-4" @click="changeStatus('Inactive')" :disabled="!isChecked"><i class="fas fa-arrow-down text-white mr-2"></i>Inctive</button>

                <button class="btn btn-success pr-4 float-right" @click="changeRole(2)" :disabled="!isChecked"><i class="fas fa-arrow-up text-white mr-2"></i>Make-Admin like-you</button>
                <button class="btn btn-info pr-4 float-right" @click="changeRole(1)" :disabled="!isChecked"><i class="fas fa-arrow-up text-white mr-2"></i>Make-Editor</button>
                <button class="btn btn-warning pr-4 float-right" @click="changeRole(0)" :disabled="!isChecked"><i class="fas fa-arrow-down text-white mr-2"></i>Make-User</button>
              </div>

              <table
                class="display table table-bordered table-striped table-responsive"
              >
                <thead>
                  <tr>
                    <th><input type="checkbox" v-model="allChecked" @click="isAllChecked"> NO.</th>
                    <th>Name</th>
                    <th>Picture</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>User Role</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="gradeX" v-for="(user, index) in users.data">
                    <td><input type="checkbox" :value="user.id" v-model="checkedIds" :disabled="user.id==1"> {{ ++index }}</td>
                    <td>{{user.name}}</td>
                    <td><img style="width:100px" :src="user.image" alt=""></td>
                    <td>{{user.email}}</td>
                    <td>{{user.number}}</td>
                    <td><p>{{userRole(user.user_role) }}</p></td>
                     <td>
                      <p class="badge p-2" :class="statusColor(user.status)">
                        {{ showStatus(user.status) }}
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- pagination component -->
                <pagination :data="users" @pagination-change-page="getResults">
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
  name: "users",
   data:function(){
    return{
      isChecked:false,
      checkedIds:[],
      allChecked:false,
      users:{}
    }
  },
  mounted() {
    this.getResults();
  },
  computed: {
    // users() {
    //   return this.$store.getters.users;
    // },
  },
  watch: {
      checkedIds: function (checkedIds) {
          this.isChecked = (checkedIds.length>0);
          this.allChecked = (checkedIds.length>0);

          this.allChecked = (checkedIds.length === this.users.length);
      }
  },
  methods: {
    getResults(page = 1) {
      this.load(true);

			axios.get('users?page=' + page)
				.then(response => {
          this.users = response.data.users;

          this.load(false);
				});
		},
      userRole:function(data){
          if(data==0){
              return 'User';
          }else if(data==1){
              return 'Editor';
          } else{
              return 'Admin';
          }
      },
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
    isAllChecked:function(){
      if(!this.allChecked){
        this.users.data.forEach(user => {
          if(user.id!=1){
            this.checkedIds.push(user.id);
          }
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
          axios.post("/user/delete/all",{data:data}).then(function () {
              link.isChecked=false,
              link.checkedIds=[],
              link.allChecked=false,

              Swal.fire("Deleted!", "Your "+total+" Users has been deleted.", "success");
              toastr.success(total+" Users Successfully Delated");
              link.getResults(link.users.current_page);
          });
          },total);
        
    },
    changeStatus:function(status){
      this.load(true);
      const link=this;
       let data=this.checkedIds;
       let total=this.checkedIds.length;

       let statusIn = (status=='Active'?1:0);

        axios.post("/user/change/all",{data:data, status:statusIn}).then(function (response) {
        link.isChecked=false,
        link.checkedIds=[],
        link.allChecked=false,

        toastr.success(total+" Users Successfully "+status);
        link.getResults(link.users.current_page);
        });
    },
    changeRole:function(role){
      this.load(true);
      const link=this;
       let data=this.checkedIds;
       let total=this.checkedIds.length;

        axios.post("/user/role/all",{data:data, role:role}).then(function (response) {
        link.isChecked=false,
        link.checkedIds=[],
        link.allChecked=false,

        toastr.success(" Users role change Successfull!");
        link.getResults(link.users.current_page);
        });
    },
  },
};
</script>


<style>
</style>


