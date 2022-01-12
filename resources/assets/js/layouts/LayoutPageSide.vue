<template>
  <div class="col-md-12 col-lg-4 sidebar">
    <div class="sidebar-box">
      <h3 class="heading">Popular Posts</h3>
      <div class="post-entry-sidebar">
        <ul>
          <li v-for="popular in popPosts" :key="popular.id">
            <router-link to="">
              <img :src="'/storage/'+popular.image" alt="Image placeholder" class="mr-4">
              <div class="text">
                <h4>{{popular.title}}</h4>
                <div class="post-meta">
                  <span class="mr-2">{{ popular.approved_at | moment("MMMM D, YYYY") }}</span>
                </div>
              </div>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
    <!-- END sidebar-box -->

    <div class="sidebar-box">
      <h3 class="heading">Categories</h3>
      <ul class="categories">
        <li v-for="cat in categories" :key="cat.id">
          <a href="#">{{ cat.name }} <span>({{cat.child.length }})</span></a>
        </li>

      </ul>
    </div>
    <!-- END sidebar-box -->

    <div class="sidebar-box">
      <h3 class="heading">Ads Categories</h3>
      <ul class="categories">
        <li v-for="acat in adsCategories" :key="acat.id">
          <a href="#">{{ acat.name }} <span>({{acat.child.length }})</span></a>
        </li>

      </ul>
    </div>
  </div>
  <!-- END sidebar -->

</template>
<script>
  export default {
    data() {
      return {
        popPosts: {},
        categories: {},
        adsCategories: {},
      }
    },
    methods: {
      popularPosts() {
        axios.get('/api/general/popular_posts')
        .then((response) => {
          if(response.data.status == true) {
            this.popPosts = response.data.posts;
          }

        })
      },
      getPostsCategories() {
        axios.get('/api/general/categories')
        .then((response) => {
          if(response.data.status == true) {
            this.categories = response.data.categories;
          }

        })
      },
      getAdsCategories() {
        axios.get('/api/general/acategories')
        .then((response) => {
          if(response.data.status == true) {
            this.adsCategories = response.data.ads_categories;
            console.log(response.data.ads_categories);

          }

        })
      },
    },
    created() {
      this.popularPosts();
      this.getPostsCategories();
      this.getAdsCategories();
    }
  }
</script>
