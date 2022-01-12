<template>
  <div class="">
    <div class="container">
      <div class="front-login py-3 pt-3">
        <div class="row align-items-center">


          <div class="col-12 form-content">
            <form class="form-horizontal" @submit.prevent="authenticate">
                <div class="form-group" v-if="authError">
                  {{authError}}
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-12 control-label">E-Mail Address or Username</label>

                    <div class="col-md-12">
                        <input id="email" type="text" class="form-control" name="email" value="" v-model="form.email"  autofocus>

                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-md-12 control-label">Password</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" v-model="form.password" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" > Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 ">
                      <button type="submit" class="btn btn-primary">
                          Login
                      </button>
                      <router-link to="/password/email" class="pt-2" >
                          Forgot Your Password?
                      </router-link>
                      <a class="" href="#">
                          You don't have an account? Register Now
                      </a>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {login} from '../../helpers/auth';
export default {
  name: 'login',
  metaInfo: {
    title: 'Login'
  },
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      error: null
    }
  },
  methods: {
    authenticate() {
      this.$store.dispatch('login');
      login(this.$data.form)
           .then((res) => {
             this.$store.commit('loginSuccess', res);
             this.$router.push({path: '/'});
           })
           .catch((error) => {
             this.$store.commit('loginFailed', {error});
           });
    }
  },
  computed: {
    authError() {
      return this.$store.getters.authError;
    }
  }
}
</script>
