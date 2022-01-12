<template>
  <div class="">
    <section class="site-section py-lg">
      <div class="container">
        <div class="row blog-entries ">
          <div class="col-md-12 col-lg-8 main-content">
            <img :src="'/storage/'+ad.image" alt="Image" class="img-fluid mb-5">
             <div class="post-meta">
               <template v-if="ad.user">
                   <span class="author mr-2"><img :src="'/storage/'+ad.user.profile.image" alt="member image">&nbsp;</span>
                   <span class="author mr-2"> {{ad.user.first_name}} {{ad.user.last_name}} &nbsp;</span>
               </template>
               <template v-else>
                   <span class="author mr-2"><img :src="'/storage/'+ad.member.profile.image" alt="member image">&nbsp;</span>
                   <span class="author mr-2"> {{ad.member.first_name}} {{ad.member.last_name}} &nbsp;</span>

               </template>
              <span class="mr-2">{{ ad.approved_at | moment("MMMM D, YYYY") }}</span> &bullet;
              <span class="ml-2"><span class="fa fa-eye"></span> {{ad.views}} </span>

            </div>
            <h1 class="mb-4">{{ad.title}}</h1>
            <a class="category mb-5" >{{ad.category.name}}</a>
            <ul class="ads-info">
              <li><i class="fa fa-map-marker fa-fw"></i><span>{{ad.address}}</span></li>
              <li><i class="fa fa-money fa-fw"></i><span>{{jsUcfirst(ad.purchase_type)}}</span></li>
              <li v-if="ad.purchase_type == 'paid'"><i class="fa fa-money fa-fw"></i><span>{{ad.price}} $</span></li>
            </ul>

            <div class="post-content-body" v-html="ad.content">
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
import LayoutPageSide from '../../layouts/LayoutPageSide.vue'

export default {
  name: 'posts.show',
  data() {
    return {
      ad: {},
      ad_id: '',
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
    getAd() {
      axios.get('/api/ads/show/'+this.ad_id)
      .then((response) => {

        if(response.data.status == true) {
          this.ad = response.data.ad;
          console.log(response.data.ad);
        }
      })
    },
    jsUcfirst(string)
    {
      return string.charAt(0).toUpperCase() + string.slice(1);
    },

  },
  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn
    },
    currentUser() {
      return this.$store.getters.currentUser
    },
  },
  created() {
    this.ad_id = this.$route.params.id;
    this.getAd();

  }

}
</script>
