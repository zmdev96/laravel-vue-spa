<template>
  <div class="">
    <section class="site-section py-sm">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Ads Categories</h2>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row">
                <div class="col-md-6 cat-content" v-for="cat in categories" :key="cat.id">
                  <div class="header">
                    <router-link :to="`/ads_categories/${cat.id}`">
                      <span class="cat-icon"><i class="fa fa-th-list fa-fw"></i></span>
                      <span class="cat-name">{{cat.name}}</span>
                      <span class="sub-count">Ads {{cat.child.length}}</span>
                    </router-link>
                  </div>
                  <div class="sub">
                      <ul>
                        <li v-for="child in cat.child" :key="child.id"><router-link :to="`/ads/${child.id}`">{{child.title}}</router-link></li>
                      </ul>
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
import LayoutPageSide from '../../layouts/LayoutPageSide.vue';

export default {
  name: 'ads_categories',
  metaInfo: {
    title: 'Categories'
  },
  components: {
    LayoutPageSide,
  },
  data() {
    return {
      categories: {},
    }
  },
  methods: {
    getCategories() {
      axios.get('/api/ads_categories')
      .then((response) => {
        if(response.data.status == true) {
          this.categories = response.data.ads_categories;
          console.log(response.data.ads_categories);
        }

      })
    }
  },
  created() {
    this.getCategories();
  }
}
</script>
