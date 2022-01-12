<template>
  <div class="settings-account">
    <div class="card">
      <div class="card-header">
        Your Account Info
      </div>
      <div class="card-body">
        <alert-success :form="user_data" :message="status" />
        <form id="settings-general-form" class="p-2" @submit.prevent="updateInfo" enctype="multipart/form-data">
          <input type="hidden" name="id" v-model="user_data.id" value="">

          <div class="row py-2">
            <div class="col">
              <label for="City" class="">City</label>
              <input type="text" class="form-control" name="city" v-model="user_data.city"
                    :class="{ 'is-invalid': user_data.errors.has('city') }" id="City" >
              <has-error :form="user_data" field="city" />
            </div>
            <div class="col">
              <label for="Address" class="">Address</label>
              <input type="text" class="form-control" name="address" v-model="user_data.address"
                     :class="{ 'is-invalid': user_data.errors.has('address') }"  id="Address">
              <has-error :form="user_data" field="address" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <label for="Phone" class="">Phone</label>
              <input type="text" class="form-control" name="phone"  v-model="user_data.phone"
                     :class="{ 'is-invalid': user_data.errors.has('phone') }" id="Phone">
              <has-error :form="user_data" field="phone" />
            </div>
            <div class="col">
              <label for="Birth_year" class="">Birth year</label>
              <input type="date" class="form-control" name="birth_year" v-model="user_data.birth_year"
                    :class="{ 'is-invalid': user_data.errors.has('birth_year') }" id="Birth_year" >
              <has-error :form="user_data" field="birth_year" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col-6">
              <label for="Image" class="">Image</label>
              <input type="file" class="form-control" name="image" @change="imageSelect"
                     :class="{ 'is-invalid': user_data.errors.has('image') }" id="Image">
              <has-error :form="user_data" field="image" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <label for="About" class="">About</label>
              <textarea type="file" class="form-control" name="about" rows="6"  v-model="user_data.about"
                     :class="{ 'is-invalid': user_data.errors.has('about') }" id="About"></textarea>
              <has-error :form="user_data" field="about" />
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
import {objectToFormData} from 'object-to-formdata'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)
export default {
  name: 'settings.general',
  data() {
    return {
      status: '',
      user_data: new Form({
        city: '',
        address: '',
        phone: '',
        birth_year: '',
        about: '',
        id:'',
        token: '',
      }),
      user_image: {
        id: '',
        token: '',
        image: null,
      }
    }
  },
  metaInfo() {
    return {
      title: 'Settings',
    }
  },
  methods: {
    async updateInfo () {

       const { data } = await this.user_data.post('/api/settings/general');
       //const data = this.user_data.image;
        if (data.status === true) {
          this.status = data.message;
          this.imageUpload();

          //this.logoutInterval();
          this.$store.dispatch('refreshUser');
          refreshUser(this.$data.form).then((res) => {
             this.$store.commit('UpdateUser', res);
          });
        }

    },
    imageSelect (e) {
      const file = e.target.files[0]
      this.user_image.image = file;
    },
    imageUpload () {
      if (this.user_image.image !== null) {
        const formData = new FormData()
        formData.append('image', this.user_image.image)
        formData.append('id', this.user_image.id)
        formData.append('token', this.user_image.token)
        axios.post('/api/settings/imageUpload',formData)
        .then( response =>  {
          this.$store.dispatch('refreshUser');
          refreshUser(this.$data.form).then((res) => {
             this.$store.commit('UpdateUser', res);
          });
        });
      }else {
        return;
      }
    }
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },
  },
  created() {
    this.user_data.id = this.currentUser.id;
    this.user_data.token = this.currentUser.token;
    this.user_data.city = this.currentUser.city;
    this.user_data.address = this.currentUser.address;
    this.user_data.phone = this.currentUser.phone;
    this.user_data.birth_year = this.currentUser.birth_year;
    this.user_data.about = this.currentUser.about;
    this.user_image.id = this.currentUser.id;
    this.user_image.token = this.currentUser.token;

  }

}
</script>
