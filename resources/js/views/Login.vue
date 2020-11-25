<template>
    <div class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <div class="alert alert-danger" v-if="loginError && errors.message">
                                            <span>{{ errors.message[0] }}</span>
                                        </div>
                                        <form>
                                            <div class="form-group">
                                                <label class="small mb-1" for="email">Email</label>
                                                <input class="form-control py-4"
                                                       id="email"
                                                       v-model="email"
                                                       type="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Password</label>
                                                <input class="form-control py-4"
                                                       id="password"
                                                       v-model="password"
                                                       type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <a class="btn btn-primary" @click="login">Login
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small">
                                            <strong>Jobberman</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
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
    import store from '../store'
    export default {
        name: "Login",
        data() {
            return {
                email: '',
                password: '',
                loginError: false,
                errors: {},
            }
        },
        methods: {
            login() {
                this.loginError = false;
                this.axios.post('api/auth/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    if (response.data.success === true) {

                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
