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
                        <form class="form-horizontal" @submit.prevent="sendEmail" @keydown="form.onKeydown($event)">
                            <div class="form-group">
                                <label for="email" class="col-md-12 control-label">E-Mail Address</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" name="email" value="" required>
                                    <has-error :form="form" field="email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" :disabled="form.busy">
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
  name: 'password.email',
  metaInfo: {
    title: 'Password Reset'
  },
  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),
  methods: {
    async sendEmail () {
      const { data } = await this.form.post('/api/auth/password/email')
      this.status = data.status
      this.form.reset()
    }
  }
}
</script>
