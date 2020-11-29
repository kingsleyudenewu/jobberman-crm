<template>
  <div>
    <div class="m-2">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-table mr-1"></i>
          {{ getUser.name }}
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div class="row">
              <div class="col-12">
                <div class="alert alert-danger" v-if="showError">
                  <span>Operation failed</span>
                </div>

                <div class="alert alert-success" v-if="showSuccess">
                  <span>Operation Successful</span>
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <form @submit.prevent="updateProfile">
                  <div class="form-group">
                    <label class="small mb-1" for="email">Name</label>
                    <input class="form-control py-4"
                           id="name"
                           value="user.name"
                           v-model="formData.name"
                           type="text"
                           placeholder="Enter your name"/>
                  </div>
                  <div class="form-group">
                    <label class="small mb-1" for="email">Email</label>
                    <input class="form-control py-4"
                           id="email"
                           v-model="formData.email"
                           type="email" placeholder="Enter email address"/>
                  </div>
                  <div class="form-group">
                    <label class="small mb-1" for="password">Password</label>
                    <input class="form-control py-4"
                           id="password"
                           v-model="formData.password"
                           type="password" placeholder="Enter password"/>
                  </div>
                  <div
                      class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                    <button type="submit" class="btn btn-primary">Update
                    </button>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';

export default {
  name: "Profile",
  data() {
    return {
      formData: {
        name: '',
        email: '',
        password: '',
      },
      showError: false,
      showSuccess: false,
    }
  },
  methods: {
    ...mapActions([
      'updateProfileAction',
    ]),
    async updateProfile() {
      try {
        await this.updateProfileAction(this.formData);
        this.showSuccess = true;
      } catch (error) {
        console.log(error);
      }
    }
  },
  computed: {
    ...mapGetters([
      'getUser',
      'getToken',
      'getGuard'
    ])
  },
  created() {
    this.formData.name = this.$store.state.user.name;
    this.formData.email = this.$store.state.user.email;
  }
}
</script>

<style scoped>

</style>
