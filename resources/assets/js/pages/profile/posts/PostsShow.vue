<template>
  <div class="settings-account profile">
    <div class="card">
      <div class="card-header">
        <div class="actions">
          <router-link class="btn btn-info btn-sm" :to="`/profile/posts/edit/${post.id}`"><i class="fa fa-edit fa-fw"></i>Edit</router-link>
          <a class="btn btn-danger btn-sm" href="#" @click="confirmDelete"><i class="fa fa-trash fa-fw"></i>Delete</a>
          <a class="btn btn-success btn-sm" href="whatsapp://send?text=The text to share!" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i>WhatsApp </a>
            <iframe :src="'https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Famal.work%2Fposts%2F'+post.id+'&layout=button_count&size=large&width=86&height=28&appId'" width="75" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

        </div>
      </div>
      <div class="card-body">
        <section class="site-section py-lg">
          <div class="container">
            <div class="row blog-entries ">
              <div class="col-md-12 col-lg-12 main-content">
                <img :src="'/storage/'+post.image" alt="Image" class="img-fluid mb-5">
                 <div class="post-meta">
                   <template v-if="post.user">
                       <span class="author mr-2"><img :src="'/storage/'+post.user.profile.image" alt="member image">&nbsp;</span>
                   </template>
                   <template v-else>
                       <span class="author mr-2"><img :src="'/storage/'+post.member.profile.image" alt="member image">&nbsp;</span>
                   </template>
                  <span class="mr-2">{{ post.approved_at | moment("MMMM D, YYYY") }}</span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> {{post.comments.length}} </span>
                  <span class="ml-2"><span class="fa fa-eye"></span> {{post.views}} </span>
                  <span class="status ml-2"  :class="post.status">{{ post.status}}</span>

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

                </div>

              </div>

            </div>
          </div>
        </section>

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
  name: 'profile.show',
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
      title: 'Profile| Posts',
    }
  },
  methods: {
    getPost() {
      axios.get('/api/profile/posts/show/'+this.post_id)
      .then((response) => {
        console.log(response);
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
    },
    confirmDelete() {
      var result = confirm("Are you sure to delete?");
      if (result) {
        axios.post('/api/profile/posts/delete', {post_id: this.post_id})
          .then(response => {
            if (response.data.status === true) {
              this.$router.push({ name: 'profile.posts.index' })
            }
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
    this.post_id = this.$route.params.id;
    this.getPost();
    this.getComments();

  }

}
</script>
