<template>
  <header role="banner">
    <div class="top-bar">
      <div class="container">
        <div class="row">
          <div class="col-12  col-md-9 search-top">
            <!-- <a href="#"><span class="fa fa-search"></span></a> -->
            <form action="#" class="search-top-form">
              <span class="icon fa fa-search"></span>
              <input type="text" id="s" placeholder="Type keyword to search...">
            </form>
          </div>
          <div class="col-3 info text-right d-none d-md-block">
            <div v-if="!isLoggedIn">
              <router-link  to="/login" class="btn btn-top-c"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Login</router-link>
              <router-link  to="/register" class="btn btn-top-c"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Register</router-link>
            </div>
            <div v-else>
              <ul class="nav nav-pills text-right">
                <li class="nav-item dropdown ">
                  <a class="nav-link dropdown-toggle btn-top-c" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="username">{{currentUser.username}}</span>
                    <span v-if="currentUser.image == null">
                      <img src="/assets/front/images/defualts-images/avatar.png" class="avatar img-responsive">
                    </span>
                    <span v-else>
                      <img :src="'/storage/'+currentUser.image" alt="Member Image" class="avatar img-responsive">
                    </span>

                  </a>
                  <div class="dropdown-menu">
                    <router-link to="/settings" class="dropdown-item">Settings</router-link>
                    <router-link to="/profile" class="dropdown-item">Profile</router-link>


                    <a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>

                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container logo-wrap">
      <div class="row ">
        <div class="col-12 text-right">
          <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>

          <div v-if="!isLoggedIn">
            <router-link  to="/login" class=" d-md-none btn btn-top-c"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Login</router-link>
            <router-link  to="/register" class=" d-md-none btn btn-top-c"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Register</router-link>
          </div>
          <div v-else>
            <ul class="nav nav-pills text-right d-md-none">
              <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle btn-top-c" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  {{currentUser.username}}
                </a>
                <div class="dropdown-menu">
                  <router-link to="/settings" class="dropdown-item">Settings</router-link>
                  <router-link to="/profile" class="dropdown-item">Profile</router-link>

                  <a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
<script>

  export default {
    name: 'layout-header',
    data() {
      return {
        member_image: '',
      }
    },
    methods: {
      logout() {
        this.$store.commit('logout');
        this.$router.push('/');
      }
    },
    computed: {
      isLoggedIn() {
        return this.$store.getters.isLoggedIn
      },
      currentUser() {
        return this.$store.getters.currentUser
      }
    },
    created() {
    }
  }
</script>
