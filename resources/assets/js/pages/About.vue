<template>
  <div class="">

      <section class="site-section py-sm">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2 class="mb-4">About us</h2>
            </div>
          </div>
          <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
              <h4>Amal Blog</h4>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
              <div class="">
                <ul>
                  <li><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>amal@blog.com</li>
                  <li><i class="fa fa-phone fa-fw" aria-hidden="true"></i>+963125346678</li>
                  <li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>Syria, Homs</li>
                </ul>
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

export default {
  name: 'about',
  metaInfo: {
    title: 'About'
  },
  components: {
    LayoutPageSide,
 },
  data() {
    return {
      posts: {},
    }
  },
  methods: {

  },
  created() {
   }
}
</script>
