<template>
  <div class="">
    <section class="site-section py-sm">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Categories > {{sub.parent.name}} > {{sub.name}}</h2>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row">
                <div class="col-md-6" v-for="post in sub.posts" :key="post.id">
                  <router-link :to="`/posts/${post.id}`" class="blog-entry " >
                    <img :src="'/storage/'+post.image"  alt="Image placeholder">
                    <div class="blog-content-body">
                      <div class="post-meta">
                        <template v-if="post.user">
                            <span class="author mr-2"><img :src="'/storage/'+post.user.profile.image" alt="member image">&nbsp;</span>
                        </template>
                        <template v-else>
                            <span class="author mr-2"><img :src="'/storage/'+post.member.profile.image" alt="member image">&nbsp;</span>
                        </template>
                        <span class="mr-2">{{ post.approved_at | moment("MMMM D, YYYY") }}</span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> {{post.comments.length}}</span>
                      </div>
                      <div class="cat-info">
                        <span>{{sub.name}}</span>
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
  name: 'categories.sub',
  data() {
    return {
      sub: {},
      sub_id: '',
    }
  },
  metaInfo() {
    return {
      title:`Categories| ${this.sub.name} `,
    }
  },
  components: {
    LayoutPageSide,
  },
  methods: {
    getSubCategory() {
      axios.get('/api/categories/sub/'+this.sub_id)
      .then((response) => {
        if(response.data.status == true) {
          this.sub = response.data.sub;
          console.log(response.data.sub);
        }

      })
    }
  },
  created() {
    this.sub_id = this.$route.params.id
    this.getSubCategory();
  }
}
</script>
