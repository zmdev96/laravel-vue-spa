<nav class="navbar navbar-expand-md  navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand d-none d-md-block" href="{{route('front.home')}}">Amal Blog</a>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link {{activeLink('front.home')}}" href="{{route('front.home')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{activeLink('front.posts.index')}}" href="{{route('front.posts.index')}}">Posts</a>
        </li>
        <!-- Blogs Categories -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{activeLink('front.categories.index')}} {{activeLink('front.categories.singel')}} {{activeLink('front.categories.sub')}}"
           href="category.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Posts Categories</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="{{route('front.categories.index')}}">All Categoreis</a>
            @foreach ($share_categories as $category)
              <a class="dropdown-item" href="{{route('front.categories.singel', $category->id)}}">{{$category->name}}</a>
            @endforeach
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="category.html" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ads Categories</a>
          <div class="dropdown-menu" aria-labelledby="dropdown05">
            @foreach ($share_ads_categories as $ads_category)
              <a class="dropdown-item" href="category.html">{{$ads_category->name}}</a>
            @endforeach
          </div>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact</a>
        </li>
      </ul>

    </div>
  </div>
</nav>
</header>
<!-- END header -->
