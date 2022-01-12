<template>
  <div class="settings-account profile">
    <div class="card">
      <div class="card-header">
        <div class="actions">
          <router-link class="btn btn-info btn-sm" :to="`/profile/ads/edit/${ad.id}`"><i class="fa fa-edit fa-fw"></i>Edit</router-link>
          <a class="btn btn-danger btn-sm" href="#" @click="confirmDelete"><i class="fa fa-trash fa-fw"></i>Delete</a>
          <a class="btn btn-success btn-sm" href="whatsapp://send?text=The text to share!" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i>WhatsApp </a>
            <iframe :src="'https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Famal.work%2Fposts%2F'+ad.id+'&layout=button_count&size=large&width=86&height=28&appId'" width="75" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

        </div>
      </div>
      <div class="card-body">
        <section class="site-section py-lg">
          <div class="container">
            <div class="row blog-entries ">
              <div class="col-md-12 col-lg-12 main-content">
                <img :src="'/storage/'+ad.image" alt="Image" class="img-fluid mb-5">
                 <div class="post-meta">
                   <template v-if="ad.user">
                       <span class="author mr-2"><img :src="'/storage/'+ad.user.profile.image" alt="member image">&nbsp;</span>
                   </template>
                   <template v-else>
                       <span class="author mr-2"><img :src="'/storage/'+ad.member.profile.image" alt="member image">&nbsp;</span>
                   </template>
                  <span class="mr-2">{{ ad.created_at | moment("MMMM D, YYYY") }}</span> &bullet;
                  <span class="ml-2"><span class="fa fa-eye"></span> {{ad.views}} </span>
                  <span class="status ml-2"  :class="ad.status">{{ ad.status}}</span>

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

            </div>
          </div>
        </section>

      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'profile.ads.show',
  data() {
    return {
      ad: {},
      ad_id: '',

    }
  },
  metaInfo() {
    return {
      title: 'Profile| Ads',
    }
  },
  methods: {
    getAd() {
      axios.get('/api/profile/ads/show/'+this.ad_id)
      .then((response) => {
        console.log(response);
        if(response.data.status == true) {
          this.ad = response.data.ad;
          console.log(response.data.ad);
        }
      })
    },

    confirmDelete() {
      var result = confirm("Are you sure to delete?");
      if (result) {
        axios.post('/api/profile/ads/delete', {ad_id: this.ad_id})
          .then(response => {
            if (response.data.status === true) {
              this.$router.push({ name: 'profile.ads.index' })
            }
          });
      }
    },
    jsUcfirst(string)
    {
      return string.charAt(0).toUpperCase() + string.slice(1);
    },
  },
  computed: {
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
