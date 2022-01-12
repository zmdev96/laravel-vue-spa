<template>
  <div class="wrap">
    <layout-header></layout-header>
    <layout-navbar></layout-navbar>
    <router-view></router-view>
    <layout-footer></layout-footer>

  </div>
</template>
<script type="text/javascript">
  import LayoutHeader from './LayoutHeader.vue';
  import LayoutNavbar from './LayoutNavbar.vue';
  import LayoutFooter from './LayoutFooter.vue';

  export default {
    name: 'layout-app',
    components: {
      LayoutHeader,
      LayoutNavbar,
      LayoutFooter,
    }
  }

</script>
