<template >
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <section class="card">
          <header class="card-header">
            <h3 class="card-title">Manage All Sliders</h3>
            <div class="card-tools">
              <router-link to="/posts" class="btn btn-dark"
                >Add Slider</router-link
              >
            </div>
          </header>
          <div class="card-body">
            <div class="adv-table">
              <div class="mb-2">
               
                <button
                  class="btn btn-success pr-4"
                  @click="changeStatus('Published')"
                  :disabled="!isChecked"
                >
                  <i class="fas fa-arrow-up text-white mr-2"></i>Active
                </button>
                <button
                  class="btn btn-warning pr-4"
                  @click="changeStatus('Draft')"
                  :disabled="!isChecked"
                >
                  <i class="fas fa-arrow-down text-white mr-2"></i>Inctive
                </button>

                <button
                  class="btn btn-info pr-4 float-right text-white"
                  @click="addPosition()"
                  
                >
                  <i class="fas fa-save text-white mr-2"></i>Save Position
                </button>
                 <button
                  class="btn btn-danger pr-4"
                  @click="deleteAll()"
                  :disabled="!isChecked"
                >
                  <i class="fas fa-trash-alt text-white mr-2"></i>Remove From Slider
                </button>
              </div>

              <table
                class="display table table-bordered table-striped table-responsive"
              >
                <thead>
                  <tr>
                    <th>
                      <input
                        type="checkbox"
                        v-model="allChecked"
                        @click="isAllChecked"
                      />
                      NO.
                    </th>
                    <th>Category</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Position</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="gradeX" v-for="(slider, index) in sliders">
                    <td>
                      <div style="width: 27px">
                        <input
                          type="checkbox"
                          :value="slider.id"
                          v-model="checkedIds"
                        />
                        {{ ++index }}
                      </div>
                    </td>
                    <td>{{ slider.category.name }}</td>
                    <td>
                      <img
                        style="width: 150px"
                        :src="slider.thumbnail"
                        alt=""
                      />
                    </td>
                    <td>{{ slider.title }}</td>
                    <td><input type="number" :placeholder="slider.slider_position" v-model="position[slider.id]" @change="slidersId(slider.id)"/></td>
                    <td>
                      <p class="badge" :class="statusColor(slider.status)">
                        {{ slider.status | capitalize }}
                      </p>
                    </td>
                  </tr>
                  <tr class="text-danger text-center" v-if="emptyData()">
                    <td colspan="7">No Data Found!</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "sliders",
  data: function () {
    return {
      isChecked: false,
      checkedIds: [],
      allChecked: false,
      sliderId:[],
      position: {}
    };
  },
  mounted() {
    this.$store.dispatch("getSliders");
  },

  watch: {
    checkedIds: function (checkedIds) {
      this.isChecked = checkedIds.length > 0;
      this.allChecked = checkedIds.length > 0;

      this.allChecked = checkedIds.length === this.sliders.length;
    },
  },

  computed: {
    sliders() {
      // this.position=this.$store.getters.sliders;
      this.load(false);
      return this.$store.getters.sliders;
    },
  },

  mounted() {
    this.$store.dispatch("getSliders");
  },

  methods: {
    slidersId:function(id){
      this.sliderId.push(id)
    },

    addPosition:function(){
      this.load(true);
      let link= this;
      let id= this.sliderId;
      let position= this.position;
      axios.post("/slider/position", { id:id, position:position }).then(function (resposne) {
            toastr.success("Sliders Successfully Arrenged");
            link.sliderId=[];
            link.position={};
            link.$store.dispatch("getSliders");
      this.load(false);
          });
    },
    emptyData: function () {
      return this.sliders.length < 1;
    },

    statusColor: function (status) {
      let display = {
        draft: "bg-danger",
        published: "bg-success",
      };
      return display[status];
    },

    isAllChecked: function () {
      if (!this.allChecked) {
        this.checkedIds = [];
        this.sliders.forEach((slider) => {
          this.checkedIds.push(slider.id);
        });
      } else {
        this.checkedIds = [];
      }
    },
    deleteAll: function () {
      
      const link = this;
      let data = this.checkedIds;
      let total = this.checkedIds.length;

      this.sweetConfirm(function () {
        link.load(true);
        axios.post("/slider/delete/all", { data: data }).then(function () {
          (link.isChecked = false),
            (link.checkedIds = []),
            (link.allChecked = false),
            Swal.fire(
              "Deleted!",
              "Your " + total + " Slider has been removed.",
              "success"
            );
          link.$store.dispatch("getSliders");
          link.load(false);
        });
      }, total);
    },
    changeStatus: function (status) {
      this.load(true);
      const link = this;
      let data = this.checkedIds;
      let total = this.checkedIds.length;

      let statusIn = status == "Published" ? "published" : "draft";

      axios
        .post("/post/change/all", { data: data, status: statusIn })
        .then(function (response) {
          (link.isChecked = false),
            (link.checkedIds = []),
            (link.allChecked = false),
            toastr.success(total + " Posts Successfully " + status);
          link.$store.dispatch("getSliders");
          link.load(false);
        });
      
    },
  },
};
</script>


<style>
</style>


