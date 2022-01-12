<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{{settings()->name}}</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="/app-admin">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>


  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-users"></i>
      <span>Users</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('admin.users.index')}}">Users</a>
        <a class="collapse-item" href="{{route('admin.usersgroups.index')}}">Users Groups</a>
        <a class="collapse-item" href="{{route('admin.privileges.index')}}">Privileges</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Categories Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseCat" aria-expanded="true" aria-controls="collapseCat">
      <i class="fas fa-th-list"></i>
      <span>Categories</span>
    </a>
    <div id="collapseCat" class="collapse" aria-labelledby="headingCat" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('admin.categories.index')}}">Categories</a>
        <a class="collapse-item" href="{{route('admin.sub-categories.index')}}">Sub Categories</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Posts Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePosts" aria-expanded="true" aria-controls="collapsePosts">
      <i class="fas fa-newspaper"></i>
      <span>Posts</span>
    </a>
    <div id="collapsePosts" class="collapse" aria-labelledby="headingPosts" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('admin.posts.index')}}">Posts</a>
        <a class="collapse-item" href="{{route('admin.posts.index')}}">Published</a>
        <a class="collapse-item" href="{{route('admin.posts.index')}}">Pending</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Ads Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseAds" aria-expanded="true" aria-controls="collapseAds">
      <i class="fab fa-adversal"></i>
      <span>Ads</span>
    </a>
    <div id="collapseAds" class="collapse" aria-labelledby="headingAds" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('admin.ads-categories.index')}}">Ads Categories</a>
        <a class="collapse-item" href="{{route('admin.ads.index')}}">Ads</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Filemanager -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('admin.filemanager.index')}}">
      <i class="fas fa-fw fa-folder "></i>
      <span>File Manager</span></a>
  </li>

  <!-- Nav Item - Settings -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('admin.settings.index')}}">
      <i class="fas fa-fw fa-cogs "></i>
      <span>Settings</span></a>
  </li>

  <!-- Nav Item - VistWebsite -->
  <li class="nav-item">
    <a class="nav-link" target="_blank" href="/">
      <i class="fas fa-fw fa-globe "></i>
      <span>Visit Website</span></a>
  </li>
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
