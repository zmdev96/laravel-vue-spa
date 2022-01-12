<template>
  <div class="">
    <section class="site-section py-sm">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Ads</h2>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row">
                <div class="col-md-6" v-for="ad in ads" :key="ad.id">
                  <router-link :to="`/ads/${ad.id}`" class="blog-entry " >
                    <img :src="'/storage/'+ad.image"  alt="Image placeholder">
                    <div class="blog-content-body">
                      <div class="post-meta">
                        <template v-if="ad.user">
                            <span class="author mr-2"><img :src="'/storage/'+ad.user.profile.image" alt="member image">&nbsp;</span>
                        </template>
                        <template v-else>
                            <span class="author mr-2"><img :src="'/storage/'+ad.member.profile.image" alt="member image">&nbsp;</span>
                        </template>
                        <span class="mr-2">{{ ad.approved_at | moment("MMMM D, YYYY") }}</span> &bullet;
                        <template v-if="ad.price">
                          <h2 class="ads-price">{{ad.price}} $</h2>
                        </template>
                        <template v-else>
                         <h2 class="ads-price">Free</h2>
                        </template>
                    </div>
                      <div class="cat-info">
                        <span>{{ad.category.name}}</span>
                      </div>
                      <h2>{{ad.title}}</h2>
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
  name: 'ads.index',
  data() {
    return {
      ads: {},
    }
  },
  metaInfo() {
    return {
      title: 'Ads',
    }
  },
  components: {
    LayoutPageSide,
  },
  methods: {
    getAds() {
      axios.get('/api/ads')
      .then((response) => {
        if(response.data.status == true) {
          this.ads = response.data.ads;
          console.log(response.data.ads);
        }
      })
    }
  },
  created() {
    this.getAds();
  }
}
</script>
