<template>
  <div class="bg-primary">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-lg-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                  <div class="alert alert-danger" v-if="showError">
                    <span>Username or Password is incorrect</span>
                  </div>
                  <form @submit.prevent="login">
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
                <div class="card-footer text-center">
                  <div class="small">

                    <router-link to="/company/login"><strong>Company Login</strong></router-link>
                    |
                    <router-link to="/employee/login"><strong>Employee Login</strong></router-link>

                    <hr>
                    <strong>Jobberman</strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; Jobberman 2020</div>
              <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex';

export default {
  name: "Login",
  data() {
    return {
      formData: {
        email: '',
        password: '',
      },
      showError: false,
    }
  },
  methods: {
    ...mapActions([
      'loginAction'
    ]),
    async login() {
      try {
        await this.loginAction(this.formData);
        this.$router.dispatch('/dashboard');
      } catch (error) {
        this.showError = true;
      }
    }
  },
}
</script>

<style scoped>

</style>
