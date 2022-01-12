<template>
  <div class="settings-account">
    <div class="card">
      <div class="card-header">
        Create new Post
      </div>
      <div class="card-body">
        <alert-success :form="post_data" :message="status" />
        <form id="settings-general-form" class="p-2" @submit.prevent="createPost" enctype="multipart/form-data">
          <input type="hidden" name="id" v-model="post_data.id" value="">
          <div class="row py-2">
            <div class="col">
              <label for="Title" class="">Title</label>
              <input type="text" class="form-control" name="title" v-model="post_data.title"
                    :class="{ 'is-invalid': post_data.errors.has('title') }" id="Title" >
              <has-error :form="post_data" field="title" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <label for="Description" class="">Description</label>
              <input type="text" class="form-control" name="desc" v-model="post_data.desc"
                    :class="{ 'is-invalid': post_data.errors.has('desc') }" id="Description" >
              <has-error :form="post_data" field="desc" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <label for="Category" class="">Category</label>
              <select class="form-control" name="category" id="Category"
               :class="{ 'is-invalid': post_data.errors.has('category')}"
                v-model="post_data.category" @change="fetchSubCategory">
               <option value="">Choose Category</option>
                <option v-for="category in categories" v-bind:value="category.id">
                  {{ category.name }}
                </option>
              </select>
              <has-error :form="post_data" field="category" />
            </div>
            <div class="col">
              <label for="SubCategory" class="">Sub Category</label>
              <select class="form-control" name="sub_category" id="SubCategory"
                :class="{ 'is-invalid': post_data.errors.has('sub_category') }"
                :disabled="disableSubCategories" v-model="post_data.sub_category">
                <option value="" >Choose Sub Category</option>
                <option v-for="sub_cat in SubCategories" v-bind:value="sub_cat.id">
                  {{ sub_cat.name }}
                </option>
               </select>
              <has-error :form="post_data" field="sub_category" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col-6">
              <label for="Image" class="">Image</label>
              <input type="file" class="form-control" name="image" @change="imageSelect"
                     :class="{ 'is-invalid': post_data.errors.has('image') }" id="Image">
              <has-error :form="post_data" field="image" />
            </div>
          </div>
          <div class="row py-2">
            <div class="col">
              <ckeditor v-model="post_data.content" :config="editor.config" rows="8" cols="100" ></ckeditor>
              <has-error :form="post_data" field="content" />
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" :disabled="post_data.busy">
                Create
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
  name: 'profile.create',
  data() {
    return {
      status: '',
      post_data: new Form({
        title: '',
        desc: '',
        category:'',
        sub_category: '',
        image:'',
        content:'',
        id:'',
        token: '',
      }),
      post_image: {
        id: '',
        token: '',
        image: null,
      },
      categories: {},
      SubCategories: '',
      disableSubCategories: true,
      editor: {
        config:{
          language: 'en',
          height: 400,
          width: '100%',
          filebrowserImageUploadUrl: '/api/general/ckeditor/upload',
          filebrowserUploadMethod: 'form',

        }
      }
    }
  },
  metaInfo() {
    return {
      title: 'Profile| Post Create',
    }
  },
  methods: {
    async createPost () {
      const { data } = await this.post_data.post('/api/profile/posts/store')
      if (data.status === true) {
        this.post_image.id = data.post_id;
        this.imageUpload();
        this.status = data.message;
        this.post_data.reset();  
      }
    },
     getCategoreis () {
      axios.post('/api/profile/posts/create', {request_type: 'getCategoreis'})
        .then(response => {
          this.categories = response.data.categories;
        });
    },
    fetchSubCategory () {
        this.post_data.sub_categories = '';

      if (this.post_data.category !== '') {
         //document.getElementById('SubCategory').childNodes[0].selected = 'selected';
        this.disableSubCategories = false;
        axios.post('/api/profile/posts/create', {
          request_type: 'getSubCategoreis',
          category_id: this.post_data.category
         }).then(response => {
            this.post_data.sub_category = '';
            this.SubCategories = response.data.sub_categories;
          });
      }else {
        this.post_data.sub_category = '';
        this.disableSubCategories = true;

      }
    },
    imageSelect (e) {
      const file = e.target.files[0]
      this.post_image.image = file;
    },
    imageUpload (){
      if (this.post_image.image !== null) {
        const formData = new FormData()
        formData.append('image', this.post_image.image)
        formData.append('id', this.post_image.id)
        formData.append('token', this.post_image.token)
        axios.post('/api/profile/posts/image/create',formData)
        .then( response =>  {

        });
      }
    }
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },
  },
  created() {
    this.post_data.token = this.currentUser.token;
    this.post_image.token = this.currentUser.token;
    this.post_data.id = this.currentUser.id;
    this.getCategoreis();
  }

}
</script>
