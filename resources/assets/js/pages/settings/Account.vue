<template>
  <div class="settings-account">
    <div class="card">
      <div class="card-header">
        Your Account Info
      </div>
      <div class="card-body">
        <alert-success :form="user_data" :message="status" />
        <form id="settings-general-form" class="p-2" @submit.prevent="updateInfo">
          <input type="hidden" name="id" v-model="user_data.id" value="">
          <div class="row py-2">
            <div class="col">
              <label for="Username" class="">Username</label>
              <input type="text" class="form-control" name="username" v-model="user_data.username"
                    :class="{ 'is-invalid': user_data.errors.has('username') }" id="Username" >
              <has-error :form="user_data" field="username" />
            </div>
            <div class="col">
              <label for="E-Mail" class="">E-Mail</label>
              <input type="email" class="form-control" name="email" v-model="user_data.email"
                     :class="{ 'is-invalid': user_data.errors.has('email') }"  id="E_Mail">
              <has-error :form="user_data" field="email" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <label for="First_name" class="">First name</label>
              <input type="text" class="form-control" name="first_name"  v-model="user_data.first_name"
                     :class="{ 'is-invalid': user_data.errors.has('first_name') }" id="First_name">
              <has-error :form="user_data" field="first_name" />
            </div>
            <div class="col">
              <label for="Last_name" class="">Last name </label>
              <input type="text" class="form-control" name="last_name" v-model="user_data.last_name"
                    :class="{ 'is-invalid': user_data.errors.has('last_name') }" id="Last_name" >
              <has-error :form="user_data" field="last_name" />
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
  name: 'settings.account',
  data() {
    return {
      status: '',
      user_data: new Form({
        username: '',
        email: '',
        first_name: '',
        last_name: '',
        id:'',
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
      const { data } = await this.user_data.post('/api/settings/account')
      if (data.status === true) {
        this.status = data.message;
        //this.logoutInterval();
        this.$store.dispatch('refreshUser');
        refreshUser(this.$data.form)
             .then((res) => {
               this.$store.commit('UpdateUser', res);
             });
      }
    },
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },
  },
  created() {
    this.user_data.token = this.currentUser.token;
    this.user_data.username = this.currentUser.username;
    this.user_data.email = this.currentUser.email;
    this.user_data.first_name = this.currentUser.first_name;
    this.user_data.last_name = this.currentUser.last_name;
    this.user_data.id = this.currentUser.id;
  }

}
</script>
