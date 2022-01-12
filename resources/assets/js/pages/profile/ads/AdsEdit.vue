<template>
  <div class="settings-account">
    <div class="card">
      <div class="card-header">
        Edit Ads
      </div>
      <div class="card-body">
        <alert-success :form="ad_data" :message="status" />
        <form id="settings-general-form" class="p-2" @submit.prevent="updateAd" enctype="multipart/form-data">
          <input type="hidden" name="id" v-model="ad_data.id" value="">
          <div class="row py-2">
            <div class="col">
              <label for="Title" class="">Title</label>
              <input type="text" class="form-control" name="title" v-model="ad_data.title"
                    :class="{ 'is-invalid': ad_data.errors.has('title') }" id="Title" >
              <has-error :form="ad_data" field="title" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <label for="Description" class="">Description</label>
              <input type="text" class="form-control" name="desc" v-model="ad_data.desc"
                    :class="{ 'is-invalid': ad_data.errors.has('desc') }" id="Description" >
              <has-error :form="ad_data" field="desc" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <label for="Category" class="">Category</label>
              <select class="form-control" name="category" id="Category"
               :class="{ 'is-invalid': ad_data.errors.has('category')}"
                v-model="ad_data.category" >
               <option value="">Choose Category</option>
                <option v-for="category in categories" v-bind:value="category.id">
                  {{ category.name }}
                </option>
              </select>
              <has-error :form="ad_data" field="category" />
            </div>
            <div class="col">
              <label for="Purchase_type" class="">Purchase type</label>
              <select class="form-control" name="purchase_type" id="Purchase_type"
                :class="{ 'is-invalid': ad_data.errors.has('purchase_type') }"
                v-model="ad_data.purchase_type" @change="purchasePrice">
                <option value="" >Choose Purchase type</option>
                <option value="free"> Free </option>
                <option value="paid"> Paid </option>
               </select>
              <has-error :form="ad_data" field="purchase_type" />
            </div>
            <div class="col" v-if="disablePriceField">
              <label for="Price" class="">Price</label>
              <input type="text" name="price" v-model="ad_data.price" id="Price" class="form-control"
              :class="{ 'is-invalid': ad_data.errors.has('price') }">
               <has-error :form="ad_data" field="price" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col" >
              <label for="address" class="">Address</label>
              <input type="text" name="address" v-model="ad_data.address" id="address" class="form-control"
              :class="{ 'is-invalid': ad_data.errors.has('address') }">
               <has-error :form="ad_data" field="address" />
            </div>
            <div class="col">
              <label for="Image" class="">Image</label>
              <input type="file" class="form-control" name="image" @change="imageSelect"
                     :class="{ 'is-invalid': ad_data.errors.has('image') }" id="Image">
              <has-error :form="ad_data" field="image" />
            </div>

          </div>
          <div class="row py-2">
            <div class="col">
              <ckeditor v-model="ad_data.content" :config="editor.config" rows="8" cols="100" ></ckeditor>
              <has-error :form="ad_data" field="content" />
            </div>
          </div>
          <div class="form-group">
            <p style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                              by updating, Post Status will be changed to Pending!</p>
            <button type="submit" class="btn btn-primary" :disabled="ad_data.busy">
                Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

import Vue from 'vue'
import CKEditor from 'ckeditor4-vue';
import { Form, HasError, AlertError, AlertSuccess} from 'vform'
import objectToFormData from 'object-to-formdata'

Vue.use( CKEditor );
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)
export default {
  name: 'profile.ads.create',
  data() {
    return {
      status: '',
      ad_data: new Form({
        ad_id:'',
        title: '',
        desc: '',
        category:'',
        address:'',
        purchase_type:'',
        price:'',
        image:'',
        content:'',
        id:'',
        token: '',
      }),
      ad_image: {
        id: '',
        token: '',
        image: null,
      },
      categories: {},
      SubCategories: '',
      disablePriceField: false,
      editor: {
        config:{
          language: 'en',
          height: 400,
          width: '100%',
          filebrowserImageUploadUrl: '/api/general/ckeditor/ads/upload',
          filebrowserUploadMethod: 'form',

        }
      }
    }
  },
  metaInfo() {
    return {
      title: 'Profile| Ads Create',
    }
  },
  methods: {
    async updateAd () {
      const { data } = await this.ad_data.post('/api/profile/ads/update')
      if (data.status === true) {
       this.imageUpload();
        this.status = data.message;
       }
    },
    getAd () {
     axios.get('/api/profile/ads/edit/'+ this.ad_data.ad_id)
       .then(response => {
         if (response.data.status === true) {
           this.ad_data.title = response.data.ad.title;
           this.ad_data.desc = response.data.ad.description;
           this.ad_data.category = response.data.ad.category.id;
           this.ad_data.purchase_type = response.data.ad.purchase_type;
           if (response.data.ad.purchase_type == 'paid') {
             this.disablePriceField = true;
           }
           this.ad_data.price = response.data.ad.price ;
           this.ad_data.address = response.data.ad.address ;
           this.ad_data.content = response.data.ad.content ;

         }
      });
   },
     getCategoreis () {
      axios.post('/api/profile/ads/create')
        .then(response => {
          this.categories = response.data.categories;
        });
    },
    imageSelect (e) {
      const file = e.target.files[0]
      this.ad_image.image = file;
    },
    imageUpload (){
      if (this.ad_image.image !== null) {
        const formData = new FormData()
        formData.append('image', this.ad_image.image)
        formData.append('id', this.ad_image.id)
        formData.append('token', this.ad_image.token)
        axios.post('/api/profile/ads/image/create',formData)
        .then( response =>  {
         });
      }
    },
    purchasePrice () {
      if (this.ad_data.purchase_type == 'paid') {
        this.disablePriceField = true;
      }else {
        this.disablePriceField = false;

      }
    }
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },
  },
  created() {
    this.ad_data.ad_id = this.$route.params.id;
    this.ad_data.token = this.currentUser.token;
    this.ad_image.token = this.currentUser.token;
    this.ad_image.id = this.$route.params.id;
    this.ad_data.id = this.currentUser.id;
    this.getAd();
    this.getCategoreis();
  }

}
</script>
