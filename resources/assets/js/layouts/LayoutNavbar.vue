<template>
  <nav class="navbar navbar-expand-md  navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand d-none d-md-block" href="#">Amal Blog</a>

      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <router-link class="nav-link" to="/">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/posts">Posts</router-link>
          </li>
          <!-- Blogs Categories -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle "
             href="category.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Posts Categories</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <template v-if='!postsCategories.length'>
                <a class="dropdown-item" href="#">No Categoreis</a>
              </template>
              <template v-else>
                <router-link to="/categories" class="dropdown-item">All Categoreis</router-link>
                <router-link :to="`/categories/${cat.id}`" class="dropdown-item"  v-for="cat in postsCategories" :key="cat.id">{{cat.name}}</router-link>
              </template>

            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="category.html" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ads Categories</a>
            <div class="dropdown-menu" aria-labelledby="dropdown05">
              <template v-if='!adsCategories.length'>
                <a class="dropdown-item" href="#">No Ads Categoreis</a>
              </template>
              <template v-else>
                <router-link to="/ads_categories" class="dropdown-item">All Categoreis</router-link>
                <router-link :to="`/ads_categories/${ads_cat.id}`" class="dropdown-item"  v-for="ads_cat in adsCategories" :key="ads_cat.id">{{ads_cat.name}}</router-link>
              </template>
            </div>

          </li>
          <li class="nav-item">
          <router-link to="/about" class="nav-link">About</router-link>

          </li>
          <li class="nav-item">
            <router-link to="/contact" class="nav-link">Contact</router-link>
          </li>
        </ul>

      </div>
    </div>
  </nav>
</template>
<script>
  export default {
    data() {
      return {
        postsCategories: {},
        adsCategories: {},
      }
    },
    methods: {
      getPostsCategories() {
        axios.get('/api/general/categories')
        .then((response) => {
          if(response.data.status == true) {
            this.postsCategories = response.data.categories;
          }

        })
      },
      getAdsCategories() {
        axios.get('/api/general/acategories')
        .then((response) => {
          if(response.data.status == true) {
            this.adsCategories = response.data.ads_categories;
          }

        })
      },

    },
    created() {
      this.getPostsCategories();
      this.getAdsCategories();
    }
  }
</script>
