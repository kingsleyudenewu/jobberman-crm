<template>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <router-link to="/dashboard" class="navbar-brand">
      Jobberman CRM
    </router-link>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
        class="fas fa-bars"></i></button>

    <!-- Navbar Search-->

    <!-- Navbar-->
    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button"
             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
              class="fas fa-user fa-fw"></i></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <router-link to="/profile" class="navbar-brand">
              Profile
            </router-link>
            <div class="dropdown-divider"></div>
            <a @click="logOut" class="dropdown-item" href="javascript:void(0);">Logout</a>
          </div>
        </li>
      </ul>
    </div>

  </nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  name: "Header",
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
          await this.logOutAction();
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
        'getGuard'
    ])
  }

}
</script>

<style scoped>

</style>
