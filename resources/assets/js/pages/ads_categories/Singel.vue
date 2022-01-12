<template>
  <div class="">
    <section class="site-section py-sm">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Ads Categories| {{category.name}}</h2>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row">
              <template v-if="category.child.length">
              <div class="col-md-6" v-for="ads in category.child" :key="ads.id">
                <router-link  :to="`/ads/${ads.id}`" class="blog-entry " >
                  <img :src="'/storage/'+ads.image"  alt="Image placeholder">
                  <div class="blog-content-body">
                    <div class="post-meta">
                      <template v-if="ads.user">
                          <span class="author "><img :src="'/storage/'+ads.user.profile.image" alt="member image"> </span>
                          <span class="author">{{ads.user.first_name}} {{ads.user.last_name}},</span>

                      </template>
                      <template v-else>
                          <span class="author mr-2"><img :src="'/storage/'+ads.member.profile.image" alt="member image"> </span>
                          <span class="author">{{post.member.first_name}} {{post.member.last_name}},</span>

                      </template>
                      <span class="">{{ ads.approved_at | moment("MMMM D,YYYY") }}</span> &bullet;
                      <h2 class="mt-2"><span class="fa fa-map-marker"></span> {{ads.address}}</h2>

                    </div>
                    <h2>{{ads.title}}</h2>
                    <div class="cat-info">
                      <template v-if="ads.price">
                        <span>{{ads.price}} $</span>
                      </template>
                      <template v-else>
                       <span>Free</span>
                      </template>
                    </div>
                  </div>
                </router-link>
              </div>
              </template>
              <template v-else>
                <h2>No Ads</h2>
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
  name: 'ads_categories.singel',
  data() {
    return {
      category: {},
      cat_id: '',
    }
  },
  metaInfo() {
    return {
      title:`Ads Categories| ${this.category.name} `,
    }
  },
  components: {
    LayoutPageSide,
  },
  methods: {
    getAds() {
      axios.get('/api/ads_categories/singel/'+this.cat_id)
      .then((response) => {
        if(response.data.status == true) {
          this.category = response.data.ads_category;
          console.log(response.data);
        }

      })
    }
  },
  created() {
    this.cat_id = this.$route.params.id
    this.getAds();
  }
}
</script>
