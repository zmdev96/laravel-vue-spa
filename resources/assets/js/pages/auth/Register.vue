<template>
  <div class="">
    <div class="container front-register">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                      <alert-error :form="form">error</alert-error>

                        <form  @submit.prevent="register">
                            <div class="row py-2">
                              <div class="col">
                                <label for="First_name" class="">First name</label>
                                <input id="First_name" type="text" class="form-control" name="first_name"  v-model="form.first_name" :class="{ 'is-invalid': form.errors.has('first_name') }" value="" autofocus>
                                <has-error :form="form" field="first_name" />

                              </div>
                              <div class="col">
                                <label for="Last_name" class="">Last name </label>
                                <input id="Last_name" type="text" class="form-control" name="last_name" v-model="form.last_name" :class="{ 'is-invalid': form.errors.has('last_name') }"  value="">
                                <has-error :form="form" field="last_name" />

                              </div>
                            </div>
                            <div class="row py-2">
                              <div class="col">
                                <label for="email" class="">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" value="" >
                                <has-error :form="form" field="email" />

                              </div>
                            </div>

                            <div class="row py-2">
                              <div class="col ">
                                <label for="password" class="">Password</label>
                                <input id="password" type="password" class="form-control" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" name="password" >
                                <has-error :form="form" field="password" />

                              </div>
                              <div class="col">
                                <label for="re_password" class="">Re-Password</label>
                                <input id="re_password" type="password" class="form-control" v-model="form.re_password" :class="{ 'is-invalid': form.errors.has('re_password') }" name="re_password" >
                                <has-error :form="form" field="re_password" />

                              </div>
                            </div>
                            <div class="birthday">
                              <label for="" class="birthday-lable">Birthday</label>
                              <div class="row">
                                <div class="col">
                                  <select id="dobday" name="b_day" v-model="form.b_day" :class="{ 'is-invalid': form.errors.has('b_day') }" class="form-control"></select>
                                </div>
                                <div class="col">
                                  <select id="dobmonth" name="b_month" v-model="form.b_month" :class="{ 'is-invalid': form.errors.has('b_month') }" class="form-control"></select>
                                </div>
                                <div class="col">
                                  <select id="dobyear" name="b_year" v-model="form.b_year" :class="{ 'is-invalid': form.errors.has('b_year') }" class="form-control"></select>
                                </div>
                              </div>
                              <has-error :form="form" field="b_day" />
                              <has-error :form="form" field="b_month" />
                              <has-error :form="form" field="b_year" />

                            </div>
                            <div class="row py-3">
                                <div class="col">
                                  <button type="submit" class="btn btn-primary" :disabled="form.busy">
                                      Register
                                  </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

</template>
<script>
import Vue from 'vue'
import { Form, HasError, AlertError, AlertSuccess} from 'vform'
import {login} from '../../helpers/auth';

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)

export default {
  name: 'register',
  metaInfo: {
    title: 'Register'
  },
  data: () => ({
    status: '',
    form: new Form({
      first_name: '',
      last_name: '',
      email: '',
      password:'',
      re_password:'',
      b_day:'',
      b_month:'',
      b_year:''
    }),
    login_data: {
      email: '',
      password:'',
    }
  }),
  methods: {
    async register () {
      this.form.post('/api/auth/register')
        .then(({ data }) => {
          this.$store.dispatch('login');
          login(this.$data.form)
               .then((res) => {
                 this.$store.commit('loginSuccess', res);
                 this.$router.push({path: '/'});
               })
               .catch((error) => {
                 this.$store.commit('loginFailed', {error});
               });
        })

    }
  }
}
</script>
