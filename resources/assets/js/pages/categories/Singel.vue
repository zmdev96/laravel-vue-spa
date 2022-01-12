<template>
  <div class="">
    <section class="site-section py-sm">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Categories| {{category.name}}</h2>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row">
              <template v-for="child in category.child">
                <div class="col-md-6" v-for="post in child.posts" :key="post.id">
                  <router-link  :to="`/posts/${post.id}`" class="blog-entry " >
                    <img :src="'/storage/'+post.image"  alt="Image placeholder">
                    <div class="blog-content-body">
                      <div class="post-meta">
                        <template v-if="post.user">
                            <span class="author "><img :src="'/storage/'+post.user.profile.image" alt="member image" > </span>
                        </template>
                        <template v-else>
                            <span class="author "><img :src="'/storage/'+post.member.profile.image" alt="member image"> </span>
                        </template>
                        <span class="">{{ post.approved_at | moment("MMMM D,YYYY") }}</span>
                    <span class="ml-2"><span class="fa fa-comments"></span> {{post.comments.length}}</span>
                      </div>
                      <div class="cat-info">
                        <span><router-link  :to="`/categories/sub/${child.id}`">{{child.name}}</router-link></span>
                      </div>
                      <h2>{{post.title}}</h2>
                    </div>
                  </router-link>
                </div>
              </template>
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
  name: 'categories.singel',
  data() {
    return {
      category: {},
      cat_id: '',
    }
  },
  metaInfo() {
    return {
      title:`Categories| ${this.category.name} `,
    }
  },
  components: {
    LayoutPageSide,
  },
  methods: {
    getCategory() {
      axios.get('/api/categories/singel/'+this.cat_id)
      .then((response) => {
        if(response.data.status == true) {
          this.category = response.data.category;
        }

      })
    }
  },
  created() {
    this.cat_id = this.$route.params.id
    this.getCategory();
  }
}
</script>
