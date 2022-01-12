<template>
  <div class="">

      <section class="site-section py-sm">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2 class="mb-4">Contact us</h2>
            </div>
          </div>
          <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
              <div class=" py-3 pt-3">
                <div class="row ">


                  <div class="col-12  ">
                    <form class="form-horizontal"  >
                      <div class="row py-2">
                        <div class="col">
                          <label for="First_name" class="">First name</label>
                          <input id="First_name" type="text" class="form-control" name="first_name"    value="" autofocus>
                        </div>
                        <div class="col">
                          <label for="Last_name" class="">Last name </label>
                          <input id="Last_name" type="text" class="form-control" name="last_name"    value="">
                       </div>
                      </div>
                      <div class="row py-2">
                        <div class="col">
                          <label for="First_name" class="">E-Mail</label>
                          <input id="First_name" type="email" class="form-control" name="first_name"    value="" autofocus>
                        </div>
                     </div>
                     <div class="row py-2">
                       <div class="col">
                         <label for="First_name" class="">Message</label>
                         <textarea name="name" class="form-control" rows="8" cols="80"></textarea>
                       </div>
                    </div>
                    </form>
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
import LayoutPageSide from '../layouts/LayoutPageSide.vue';

export default {
  name: 'contact',
  metaInfo: {
    title: 'Contact'
  },
  components: {
    LayoutPageSide,
 },
  data() {
  },
  methods: {

  },
  created() {
   }
}
</script>
