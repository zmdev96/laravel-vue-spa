<template>
  <div class="container settings">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            Settings
          </div>
          <div class="card-body">
            <ul class="nav flex-column nav-pills">
              <li class="nav-item">
                <router-link to="/settings/account" class="nav-link" active-class="active">
                  <i class="fa fa-user fa-fw"></i>Account
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/settings/general" class="nav-link" active-class="active">
                  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>General
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/settings/security" class="nav-link" active-class="active">
                  <i class="fa fa-lock fa-fw" aria-hidden="true"></i>Security
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
