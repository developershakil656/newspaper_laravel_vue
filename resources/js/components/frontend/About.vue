<template>
  <div onclick="alert(‘you just clicked this’);">
      <h2>about page</h2>
      <!-- <span  v-on:onload="test()">load</span> -->
  </div>
</template>

<script>
import CubeSpin from 'vue-loading-spinner/src/components/Circle2';
export default {
    name:'forntend',
    data:function(){
        return{
            isLoading: true
        }
    },
    computed:{

    },
    components:{
        CubeSpin
    },
}
</script>

<style>

</style>