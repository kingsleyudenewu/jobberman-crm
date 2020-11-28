<template>
  <div>
    <Pagination :pagination="pagination" @paginate="" :offset="4"></Pagination>
  </div>
</template>

<script>
import {mapState, mapActions } from 'vuex';
import Pagination from "../components/Pagination";

export default {
  name: "Company",
  components: {
    Pagination
  },
  data() {
    return {
      offset: 4,
      pagination: {},
      company: []
    }
  },
  computed: {
    ...mapState([
      'company'
    ])
  },
  methods: {
    ...mapActions([
      "getCompanyAction",
    ])
  },
  created() {
    this.company = this.getCompanyAction()
  },
}
</script>

<style scoped>

</style>
