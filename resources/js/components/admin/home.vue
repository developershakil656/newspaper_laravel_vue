<template>
  <div>
      <div class="content">
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>10</h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <router-link to="/users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53</h3>

              <p>Posts</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <router-link to="/posts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>24</h3>

              <p>Categories</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <router-link to="/categories" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>5</h3>

              <p>Sliders</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <router-link to="/sliders" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
          </div>
        </div>
        <!-- ./col -->
      </div>
      </div>
  </div>
</template>

<script>
export default {
    name:'home',
    computed:{

    },
    mounted(){
      this.load(false);
    }
}
</script>

<style>

</style>