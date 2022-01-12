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
                <div class="col-md-4" v-for="ad in ads" :key="ad.id">
                  <router-link :to="`/profile/ads/${ad.id}`" class="blog-entry " >
                    <img :src="'/storage/'+ad.image"  alt="Image placeholder">
                    <div class="blog-content-body">
                      <div class="post-meta">
                        <span class="mr-2">{{ ad.created_at | moment("MMMM D, YYYY") }}</span>  
                     </div>
                      <div class="cat-info">
                        <span>{{ad.category.name}}</span>
                      </div>
                      <h2>{{ad.title}}</h2>
                      <div class="post-footer">
                        <span  :class="ad.status">{{ ad.status}}</span>
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
  name: 'profile.ads.index',
  data() {
    return {
      member_id: '',
      ads: {},

    }
  },
  metaInfo() {
    return {
      title: 'Profile| Ads',
    }
  },
  methods: {
    getAds() {
      axios.get('/api/profile/ads/'+ this.member_id)
      .then((response) => {
        if(response.data.status == true) {
          this.ads = response.data.ads;
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
    this.getAds();

  }

}
</script>
