<template>
  <div class="">

      <section class="site-section pt-5 pb-5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                <carousel :items="1" :autoplay="true" class="owl-theme home-slider">
                  <div>
                    <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('/assets/front/images/img_1.jpg'); ">
                      <div class="text half-to-full">
                        <span class="category mb-5">Food</span>
                        <div class="post-meta">

                          <span class="author mr-2"><img src="/assets/front/images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;
                          <span class="mr-2">March 15, 2018 </span> &bullet;
                          <span class="ml-2"><span class="fa fa-comments"></span> 3</span>

                        </div>
                        <h3>How to Find the Video Games of Your Youth</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>
                      </div>
                    </a>
                  </div>
                </carousel>
            </div>
          </div>
        </div>
      </section>
      <!-- END section -->

      <section class="site-section py-sm">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2 class="mb-4">Latest Posts</h2>
            </div>
          </div>
          <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
              <div class="row">
                <template v-if="posts.length" >
                  <div class="col-md-6" v-for="post in posts" :key="post.id">
                    <router-link to="/posts" class="blog-entry " >
                      <img :src="'/storage/'+post.image" alt="Image placeholder">
                     <div class="blog-content-body">
                        <div class="post-meta">
                          <template v-if="post.user">
                            <span class="author mr-2"><img :src="'/storage/'+post.user.profile.image" alt="Colorlib"> {{post.user.first_name + ' ' + post.user.last_name }}</span>&bullet;
                          </template>
                          <template v-else>
                            <span class="author mr-2"><img :src="'/storage/'+post.member.profile.image" alt="Colorlib"> {{post.member.first_name + ' ' + post.member.last_name }}</span>&bullet;
                          </template>
                          <span class="mr-2">{{ post.approved_at | moment("MMMM D, YYYY") }}</span> &bullet;
                          <span class="ml-2"><span class="fa fa-eye"></span> {{post.views}}</span>
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
import LayoutPageSide from '../layouts/LayoutPageSide.vue';
import Carousel from 'vue-owl-carousel';

export default {
  name: 'home',
  metaInfo: {
    title: 'Amal Blog'
  },
  components: {
    LayoutPageSide,
    Carousel
  },
  data() {
    return {
      posts: {},
    }
  },
  methods: {
    getPosts() {
      axios.get('/api/home/posts')
      .then((response) => {
        if(response.data.status == true) {
          this.posts = response.data.posts;
        }

      })
    }
  },
  created() {
    this.getPosts();
  }
}
</script>
