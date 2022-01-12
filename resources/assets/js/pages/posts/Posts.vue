<template>
  <div class="">
    <section class="site-section py-sm">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Posts</h2>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row">
                <div class="col-md-6" v-for="post in posts" :key="post.id">
                  <router-link :to="`/posts/${post.id}`" class="blog-entry " >
                    <img :src="'/storage/'+post.image"  alt="Image placeholder">
                    <div class="blog-content-body">
                      <div class="post-meta">
                        <template v-if="post.user">
                            <span class="author"><img :src="'/storage/'+post.user.profile.image" alt="member image"></span>
                            <span class="author">{{post.user.first_name}} {{post.user.last_name}},</span>

                        </template>
                        <template v-else>
                            <span class="author mr-2"><img :src="'/storage/'+post.member.profile.image" alt="member image"> </span>
                            <span class="author">{{post.member.first_name}} {{post.member.last_name}},</span>

                        </template>
                        <span class="">{{ post.approved_at | moment("MMMM D,YYYY") }}</span>
                        <span class="ml-2"><span class="fa fa-comments"></span> {{post.comments.length}}</span>
                      </div>
                      <div class="cat-info">
                        <span>{{post.sub.name}}</span>
                      </div>
                      <h2>{{post.title}}</h2>
                    </div>
                  </router-link>
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
import LayoutPageSide from '../../layouts/LayoutPageSide.vue';
export default {
  name: 'posts-com',
  data() {
    return {
      posts: {},
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
    getPosts() {
      axios.get('/api/posts')
      .then((response) => {
        if(response.data.status == true) {
          this.posts = response.data.posts;
          console.log(response.data.posts);
        }
      })
    }
  },
  created() {
    this.getPosts();
  }
}
</script>
