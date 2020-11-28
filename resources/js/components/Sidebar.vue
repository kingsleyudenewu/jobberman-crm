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

          <router-link to="/employee" class="nav-link" v-if="getGuard === 'user' || getGuard === 'company'">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Employee
          </router-link>

          <router-link to="/company" class="nav-link" v-if="getGuard === 'user'">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Company
          </router-link>

          <a @click="logOut" class="nav-link" href="javascript:void(0);">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            LogOut
          </a>
        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ getUser.name }}
      </div>
    </nav>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  name: "Sidebar",
  methods: {
    ...mapActions([
        'logOutAction'
    ]),
    async logOut() {
      try {
        if (this.$store.getters.getGuard === 'user') {
          await this.logOutAction();
          await this.$router.push({name:"Login"})
        }
        else if (this.$store.getters.getGuard === 'company') {
          await this.logOutAction(this.getToken);
          await this.$router.push({name:"CompanyLogin"})
        }
        else {
          await this.logOutAction();
          await this.$router.push({name:"EmployeeLogin"})
        }

      }
      catch (error) {
        console.log(error);
      }
    }
  },
  computed: {
    ...mapGetters([
        'isAuthenticated',
        'getGuard',
        'getUser',
        'getToken'
    ])
  }
}
</script>

<style scoped>

</style>
