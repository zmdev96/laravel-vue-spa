<template>
  <div class="settings-account">
    <div class="card">
      <div class="card-header">
        Your Account Password
      </div>
      <div class="card-body">
        <alert-success :form="user_data" :message="status" />
        <alert-error :form="user_data" message="There were some problems with your input."></alert-error>

        <form id="settings-general-form" class="p-2" @submit.prevent="updateInfo" enctype="">
          <input type="hidden" name="id" v-model="user_data.id" value="">
          <div class="row py-2">
            <div class="col">
              <label for="Current_password" class="">Current Password</label>
              <input type="password" class="form-control" name="current_password" v-model="user_data.current_password"
                    :class="{ 'is-invalid': user_data.errors.has('current_password') }" id="Current_password" >
              <span class="show-password" v-on:click="switchVisibility($event)"><i class="fa fa-eye fa-fw"></i></span >

              <has-error :form="user_data" field="current_password" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <label for="Password" class="">New Password</label>
              <input type="password" class="form-control" name="password" v-model="user_data.password"
                    :class="{ 'is-invalid': user_data.errors.has('password') }" id="Password" >
              <span class="show-password" v-on:click="switchVisibility($event)"><i class="fa fa-eye fa-fw"></i></span >

              <has-error :form="user_data" field="password" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <label for="Password_con" class="">Confirm new Password</label>
              <input type="password" class="form-control" name="confirm_password" v-model="user_data.confirm_password"
                    :class="{ 'is-invalid': user_data.errors.has('confirm_password') }" id="Password_con" >
              <span class="show-password" v-on:click="switchVisibility($event)"><i class="fa fa-eye fa-fw"></i></span >

              <has-error :form="user_data" field="confirm_password" />
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" :disabled="user_data.busy">
                Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import {refreshUser} from '../../helpers/auth';

import Vue from 'vue'
import { Form, HasError, AlertError, AlertSuccess} from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)
export default {
  name: 'settings.security',
  data() {
    return {
      status: '',
      user_data: new Form({
        current_password: '',
        password: '',
        confirm_password: '',
        id: '',
        token: '',
      }),
    }
  },
  metaInfo() {
    return {
      title: 'Settings',
    }
  },
  methods: {
    async updateInfo () {
      const { data } = await this.user_data.post('/api/settings/security')
      if (data.status === true) {
        this.status = data.message;
        this.user_data.reset()
        this.$store.dispatch('refreshUser');
        refreshUser(this.$data.form)
             .then((res) => {
               this.$store.commit('UpdateUser', res);
             });
      }else {
        this.status = data.message;
        this.user_data.current_password = '';
        this.user_data.password = '';
        this.user_data.confirm_password = '';
      }
    },
    switchVisibility(event) {
      const field = event.target.parentNode.parentNode.childNodes[2];
      if (field.getAttribute("type") == 'password') {
        field.setAttribute("type", "text");
      }else {
        field.setAttribute("type", "password");
      }
    }
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },
  },
  created() {
    this.user_data.token = this.currentUser.token;
    this.user_data.id = this.currentUser.id;
  }

}
</script>
