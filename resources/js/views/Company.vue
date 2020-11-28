<template>
  <div class="m-5">
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
