<template>
  <div class="settings-account">
    <div class="card">
      <div class="card-header">
        Your Posts
      </div>
      <div class="card-body">
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-12 main-content">
            <div class="row">
                <div class="col-md-4" v-for="post in posts" :key="post.id">
                  <router-link :to="`/profile/posts/${post.id}`" class="blog-entry " >
                    <img :src="'/storage/'+post.image"  alt="Image placeholder">
                    <div class="blog-content-body">
                      <div class="post-meta">
                        <span class="mr-2">{{ post.created_at | moment("MMMM D, YYYY") }}</span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> {{post.comments.length}}</span>
                      </div>
                      <div class="cat-info">
                        <span>{{post.sub.name}}</span>
                      </div>
                      <h2>{{post.title}}</h2>
                      <div class="post-footer">
                        <span  :class="post.status">{{ post.status}}</span>
                      </div>
                    </div>
                  </router-link>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'profile.index',
  data() {
    return {
      member_id: '',
      posts: {},

    }
  },
  metaInfo() {
    return {
      title: 'Profile| Posts',
    }
  },
  methods: {
    getPosts() {
      axios.get('/api/profile/posts/'+ this.member_id)
      .then((response) => {
        if(response.data.status == true) {
          this.posts = response.data.posts;
      }
      })
    }
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    },
  },
  created() {
    this.member_id = this.currentUser.id;
    this.getPosts();

  }

}
</script>
