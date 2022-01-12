<template>
  <div class="">
    <div class="container">
      <div class="front-login py-3 pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>

                    <div class="panel-body">
                      <alert-success :form="form" :message="status" />
                      <alert-error :form="form">This password reset token is invalid.</alert-error>

                        <form class="form-horizontal" @submit.prevent="reset" @keydown="form.onKeydown($event)">
                            <div class="form-group">
                                <label for="email" class="col-md-12 control-label">E-Mail Address</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" name="email" value="" required>
                                    <has-error :form="form" field="email" />

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-12 control-label">Password</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" name="password" value="" required>
                                    <has-error :form="form" field="password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-md-12 control-label">Confirm Password</label>
                                <div class="col-md-12">
                                    <input id="password_confirmation" type="password" class="form-control" v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" name="password_confirmation" value="" required>
                                    <has-error :form="form" field="password_confirmation" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send Password Reset Link
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
  </div>
</template>

<script>
import Vue from 'vue'
import { Form, HasError, AlertError, AlertSuccess} from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)

export default {
  name: 'password.reset',
  metaInfo: {
    title: 'Password Reset'
  },
  data: () => ({
    status: '',
    form: new Form({
      email: '',
      password: '',
      password_confirmation: '',
      token: '',
    })
  }),
  created() {
    this.form.token = this.$route.params.token
  },
  methods: {
    async reset () {
      const { data } = await this.form.post('/api/auth/password/reset')
      this.status = data.status
      console.log(data.status);
      //this.form.reset()
    }
  }
}
</script>
