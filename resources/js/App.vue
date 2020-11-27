<template>
  <div>
    <div v-if="isAuthenticated">
      <Header/>
      <div id="layoutSidenav">
        <Sidebar/>
        <div id="layoutSidenav_content">
          <transition name="fade" mode="out-in">
            <main>
              <div class="container-fluid">
                <router-view></router-view>
              </div>
            </main>
          </transition>
          <Footer/>
        </div>
      </div>
    </div>

    <div v-if="!isAuthenticated">
        <router-view></router-view>
    </div>

  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Header from "./views/Header";
import Sidebar from "./views/Sidebar";
import Footer from "./views/Footer";


export default {
  name: "App",
  components: {
    Header,
    Sidebar,
    Footer
  },
  computed: {
    ...mapGetters([
        'isAuthenticated'
    ])
  }
}
</script>

<style scoped>

</style>
