<template>
<div>
  <div class="row">
    <div class="col-xl-3 col-md-6">
      <div class="card bg-primary text-white mb-4">
        <div class="card-body">Primary Card</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <a class="small text-white stretched-link" href="#">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-warning text-white mb-4">
        <div class="card-body">Warning Card</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <a class="small text-white stretched-link" href="#">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-success text-white mb-4">
        <div class="card-body">Success Card</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <a class="small text-white stretched-link" href="#">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-danger text-white mb-4">
        <div class="card-body">Danger Card</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <a class="small text-white stretched-link" href="#">View Details</a>
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Company Records
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
            <tr v-for="comp in company.data">
              <td>{{ comp.name }}</td>
              <td>{{ comp.email }}</td>
              <td>{{ comp.url }}</td>
            </tr>
            </tbody>
          </table>
          <pagination :data="company" @pagination-change-page="getCompanyAction"></pagination>

        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import {mapActions} from 'vuex';
import pagination from 'laravel-vue-pagination';

export default {
  name: "AdminDashboard",
  components: {
    pagination
  },
  props: {
    company: Object,
  },
  methods: {
    ...mapActions([
        'getCompanyAction'
    ])
  }
}
</script>

<style scoped>

</style>
