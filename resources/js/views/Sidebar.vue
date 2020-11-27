<template>

  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Core</div>
          <router-link to="/dashboard" class="nav-link">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
          </router-link>

          <router-link to="/employee" class="nav-link" v-if="getGuard === 'user">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Employee
          </router-link>
        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Start Bootstrap
      </div>
    </nav>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  name: "Sidebar",
  computed: {
    ...mapGetters([
        'isAuthenticated',
        'getGuard'
    ])
  }
}
</script>

<style scoped>

</style>
