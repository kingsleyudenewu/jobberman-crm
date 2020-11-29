<template>
  <div>
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <AdminDashboard :company="getCompany"/>

  </div>
</template>

<script>
import AdminDashboard from "../components/AdminDashboard";
import {mapGetters, mapActions} from 'vuex';

export default {
  name: "Dashboard",
  components: {
    AdminDashboard
  },
  computed: {
    ...mapGetters([
      'getGuard',
      'getCompany'
    ])
  },
  methods: {
    ...mapActions([
        'getCompanyAction'
    ])
  },
  created() {
    this.getCompanyAction(this.$store.state.pagination.currentPage)
  },
}
</script>

<style scoped>

</style>
