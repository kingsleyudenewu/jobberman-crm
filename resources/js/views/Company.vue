<template>
  <div class="m-2">
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        DataTable Example
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Url</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="company in getCompany.data">
              <td>{{ company.name }}</td>
              <td>{{ company.email }}</td>
              <td>{{ company.url }}</td>
            </tr>
            </tbody>
          </table>
          <pagination :data="getCompany" @pagination-change-page="getCompanyAction"></pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
import pagination from 'laravel-vue-pagination';


export default {
  name: "Company",
  components: {
    pagination
  },
  data() {
    return {
    }
  },
  computed: {
    ...mapGetters([
      'getCompany'
    ])
  },
  methods: {
    ...mapActions([
      "getCompanyAction",
    ])
  },
  created() {
    this.getCompanyAction(this.$store.state.pagination.currentPage)
  },
}
</script>

<style scoped>

</style>
