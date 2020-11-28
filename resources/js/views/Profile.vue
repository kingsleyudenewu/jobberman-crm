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
            <b-form @submit="updateProfile">
              <b-form-group
                  id="input-group-1"
                  value="kkk"
                  label="Email address:"
                  label-for="input-1"
                  description="We'll never share your email with anyone else."
              >
                <b-form-input
                    id="input-1"
                    v-model="form.email"
                    type="email"
                    required
                    placeholder="Enter email"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
                <b-form-input
                    id="input-2"
                    v-model="form.name"
                    required
                    placeholder="Enter name"
                ></b-form-input>
              </b-form-group>
              <b-button type="submit" variant="primary">Submit</b-button>
              <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
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
      form: {
        name: '',
        email: '',
        password: '',
      }
    }
  },
  methods: {
    ...mapActions([
      'updateProfile'
    ]),
    async updateProfile() {
      try{
        await this.updateProfile(this.form, this.token);
      }
      catch (error) {
        console.log(error);
      }
    }
  },
  computed: {
    ...mapGetters({
      user: 'getUser',
      token: 'getToken'
    })
  }
}
</script>

<style scoped>

</style>
