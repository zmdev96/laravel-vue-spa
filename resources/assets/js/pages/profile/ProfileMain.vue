<template>
  <div class="container settings">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            Profile
          </div>
          <div class="card-body">
            <ul class="nav flex-column nav-pills">
              <li class="nav-item">
                <router-link to="/profile/posts/index" class="nav-link" active-class="active">
                  <i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i> All Posts
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/profile/posts/create" class="nav-link" active-class="active">
                  <i class="fa fa-plus fa-fw" aria-hidden="true"></i> New post
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/profile/ads/index" class="nav-link" active-class="active">
                  <i class="fa fa-adn fa-fw" aria-hidden="true"></i> All Ads
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/profile/ads/create" class="nav-link" active-class="active">
                  <i class="fa fa-plus fa-fw" aria-hidden="true"></i> New Ads
                </router-link>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-9 contnet">
        <router-view />

      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
