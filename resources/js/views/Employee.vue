<template>
  <div class="m-5">
    <table class="table">
      <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th v-if="getGuard === 'user'">Company</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="employee in getEmployee.data">
        <td>{{ employee.name }}</td>
        <td>{{ employee.email }}</td>
        <td v-if="getGuard === 'user'">{{ employee.company.name }}</td>
      </tr>
      </tbody>
    </table>
    <pagination :data="getEmployee" @pagination-change-page="getEmployeeAction"></pagination>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import pagination from 'laravel-vue-pagination';


export default {
  name: "Employee",
  components: {
    pagination
  },
  data() {
    return {
    }
  },
  computed: {
    ...mapGetters([
      'getEmployee',
      'getGuard'
    ])
  },
  methods: {
    ...mapActions([
      "getEmployeeAction",
    ])
  },
  created() {
    this.getEmployeeAction(this.$store.state.pagination.currentPage)
  },
}
</script>

<style scoped>

</style>
