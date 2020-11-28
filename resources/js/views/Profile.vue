<template>
  <div>
    <div class="m-2">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-table mr-1"></i>
          {{ user.name }}
        </div>
        <div class="card-body">
          <div class="table-responsive col-6">
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
                <button type="submit" class="btn btn-primary">Login
                </button>
              </div>
            </form>
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
      }
    }
  },
  methods: {
    ...mapActions([
      'updateProfile',
      'fetchProfile'
    ]),
    async updateProfile() {
      try {
        await this.updateProfile(this.formData, this.$store.state.token);
      } catch (error) {
        console.log(error);
      }
    }
  },
  computed: {
    ...mapGetters({
      user: 'getUser',
      token: 'getToken'
    })
  },
  created() {
    this.formData.name = this.$store.state.user.name;
    this.formData.email = this.$store.state.user.email;
  }
}
</script>

<style scoped>

</style>
