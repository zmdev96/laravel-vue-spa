<template>
  <div class="">
    <section class="site-section py-lg">
      <div class="container">
        <div class="row blog-entries ">
          <div class="col-md-12 col-lg-8 main-content">
            <img :src="'/storage/'+post.image" alt="Image" class="img-fluid mb-5">
             <div class="post-meta">
               <template v-if="post.user">
                   <span class="author "><img :src="'/storage/'+post.user.profile.image" alt="member image"></span>
                   <span class="author">{{post.user.first_name}} {{post.user.last_name}},</span>

               </template>
               <template v-else>
                   <span class="author "><img :src="'/storage/'+post.member.profile.image" alt="member image"> </span>
                   <span class="author">{{post.member.first_name}} {{post.member.last_name}},</span>

               </template>
              <span class="mr-2">{{ post.approved_at | moment("MMMM D,  YYYY") }}</span>
              <span class="ml-2"><span class="fa fa-comments"></span> {{post.comments.length}} </span>
              <span class="ml-2"><span class="fa fa-eye"></span> {{post.views}} </span>

            </div>
            <h1 class="mb-4">{{post.title}}</h1>
            <a class="category mb-5" >{{post.sub.parent.name}}</a> <a class="category mb-5"> {{post.sub.name}}</a>

            <div class="post-content-body" v-html="post.content">
            </div>
            <div class="pt-3">
              <h3 class="mb-3" id="comments_count"></h3>
              <div class="total-comments">
                  <ul class="comment-list" v-for="comm in this.comments" :key="comm.id">
                    <li class="comment" >
                      <div class="vcard">
                        <img :src="'/storage/'+comm.member.profile.image" alt="Image placeholder">
                      </div>
                      <div class="comment-body">
                        <h3>{{comm.member.first_name}} {{comm.member.last_name}}</h3>
                        <div class="meta">{{ comm.created_at | moment("MMMM D, YYYY") }}</div>
                        <p>{{comm.comment}}</p>
                      </div>
                    </li>
                  </ul>
              </div>
              <!-- END comment-list -->
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-2">Leave a comment</h3>
                  <div class="comment-form" v-if="isLoggedIn">
                    <form id="comment_form" class="p-2" @submit.prevent="createComment">
                      <div class="form-group">
                        <textarea v-model="comment_form.comment" :class="{ 'is-invalid': comment_form.errors.has('comment') }" name="comment" id="comment"  cols="30" rows="5" class="form-control comment" placeholder="Write Your Comment Hier!"></textarea>
                        <input type="hidden" name="member_id" v-model="comment_form.member_id" >
                        <input type="hidden" name="post_id" v-model="comment_form.post_id" >

                        <!-- <input type="hidden" name="post_id" v-model="comment_form.post_id" > -->
                        <alert-success :form="comment_form" :message="comment_status" />
                        <has-error :form="comment_form" field="comment" />

                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary" :disabled="comment_form.busy">
                            Send Comment
                        </button>
                      </div>
                    </form>
                  </div>
                  <div v-else>
                    <router-link to="/login" >Login to write a Comment</router-link>
                  </div>
              </div>

            </div>

          </div>
          <!-- END main-content -->
          <Layout-page-side></Layout-page-side>

        </div>
      </div>
    </section>
  </div>
</template>

<script>
import LayoutPageSide from '../../layouts/LayoutPageSide.vue'
import Vue from 'vue'
import { Form, HasError, AlertError, AlertSuccess} from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)
export default {
  name: 'posts.show',
  data() {
    return {
      post: {},
      comments: [],
      post_id: '',
      comment_status: '',
      comment_form: new Form({
        comment: '',
        member_id: '',
        post_id: '',
      })

    }
  },
  metaInfo() {
    return {
      title: 'Posts',
    }
  },
  components: {
    LayoutPageSide,
  },
  methods: {
    getPost() {
      axios.get('/api/posts/show/'+this.post_id)
      .then((response) => {

        if(response.data.status == true) {
          this.post = response.data.post;
        }
      })
    },
    getComments() {
      axios.get('/api/posts/comments/'+this.post_id)
      .then((response) => {
        if(response.data.status == true) {
          this.comments = response.data.comments;
        }
      })
    },
    async createComment () {
      const { data } = await this.comment_form.post('/api/posts/comments/create')
      this.comment_status = data.message
      this.comment_form.reset()
      this.getComments();
    }
  },
  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn
    },
    currentUser() {
      return this.$store.getters.currentUser
    },
  },
  created() {
    this.post_id = this.$route.params.id;
    this.getPost();
    this.getComments();
    if (this.isLoggedIn) {
      this.comment_form.member_id = this.$store.getters.currentUser.id;
      this.comment_form.post_id = this.$route.params.id;
    }
  }

}
</script>
