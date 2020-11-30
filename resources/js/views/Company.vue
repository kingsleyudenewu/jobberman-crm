<template>
  <div class="m-2">
    <div class="card mb-4">
      <div class="card-header">
        <b-button v-if="getGuard === 'user'" v-b-modal="'my-modal'" class="float-right">Add
          Company
        </b-button>
        <i class="fas fa-table mr-1"></i>
        Company Data
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

          <b-modal id="my-modal">
            <form @submit.prevent="createCompany">
              <div class="form-group">
                <label class="small mb-1" for="email">Name</label>
                <input class="form-control py-4"
                       id="name"
                       v-model="formData.name"
                       type="text" placeholder="Enter full name"/>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="email">Email</label>
                <input class="form-control py-4"
                       id="email"
                       v-model="formData.email"
                       type="email" placeholder="Enter email address"/>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="url">Url</label>
                <input class="form-control py-4"
                       id="url"
                       v-model="formData.url"
                       type="text" placeholder="Enter Url"/>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="password">Password</label>
                <input class="form-control py-4"
                       id="password"
                       v-model="formData.password"
                       type="password" placeholder="Enter password"/>
              </div>

              <div class="form-group">
                <label class="small mb-1" for="logo">Logo</label>
                <input type="file" id="logo" ref="logo" class="form-control" @change="handleFileUpload">

              </div>
              <div
                  class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                <button type="submit" class="btn btn-primary">Sumbit
                </button>
              </div>
            </form>
          </b-modal>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import pagination from 'laravel-vue-pagination';


export default {
  name: "Company",
  components: {
    pagination
  },
  data() {
    return {
      formData: {
        name: '',
        email: '',
        password: '',
        logo: '',
        url: ''
      },
    }
  },
  computed: {
    ...mapGetters([
      'getCompany',
        'getGuard'
    ])
  },
  methods: {
    ...mapActions([
      "getCompanyAction",
      "createCompanyAction"
    ]),
    async createCompany() {
      console.log(this.formData);
      await this.createCompanyAction(this.formData);
      location.reload();
    },
    async handleFileUpload(e) {
      const image = e.target.files[0];
      await this.toBase64(image);
    },
    async toBase64(file){
      try{
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => this.formData.logo = reader.result;
      }
      catch (error) {
        console.log(error);
      }
    }
  },
  created() {
    this.getCompanyAction(this.$store.state.pagination.currentPage)
  },
}
</script>

<style scoped>

</style>
