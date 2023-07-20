<template>

  <div id="HomeView">
    <div class="home">
      <div class="HelloWorld">
        <img alt="ICP logo"  src="../assets/icp.png" />
        <HelloWorld  msg="โครงการการวางแผนอาชีพรายบุคคล" />
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from "@/components/HelloWorld.vue";

export default {
  name: "HomeView",
  components: {
    HelloWorld,
  },
};
</script>

<style scoped>
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 160px;
  height: 100px;
}
.HelloWorld {
  margin: auto;
  text-align: center;
}
</style>
