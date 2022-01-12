<div class="col-md-12 col-lg-4 sidebar">
  <div class="sidebar-box">
    <h3 class="heading">Popular Posts</h3>
    <div class="post-entry-sidebar">
      <ul>

        @foreach ($share_pupular_posts as $pupular)
          <li>
            <a href="{{route('front.posts.show',$pupular->id)}}">
              <img src="{{Storage::url($pupular->image)}}" alt="Image placeholder" class="mr-4">
              <div class="text">
                <h4>{{$pupular->title}}</h4>
                <div class="post-meta">
                  <span class="mr-2">{{\DateTime::createFromFormat('Y-m-d H:i:s', $pupular->approved_at)->format('M j, Y')}} </span>
                </div>
              </div>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <!-- END sidebar-box -->

  <div class="sidebar-box">
    <h3 class="heading">Categories</h3>
    <ul class="categories">
      <li><a href="#">Food <span>(12)</span></a></li>
      <li><a href="#">Travel <span>(22)</span></a></li>
      <li><a href="#">Lifestyle <span>(37)</span></a></li>
      <li><a href="#">Business <span>(42)</span></a></li>
      <li><a href="#">Adventure <span>(14)</span></a></li>
    </ul>
  </div>
  <!-- END sidebar-box -->

  <div class="sidebar-box">
    <h3 class="heading">Sub Categories</h3>
    <ul class="tags">
      <li><a href="#">Travel</a></li>
      <li><a href="#">Adventure</a></li>
      <li><a href="#">Food</a></li>
      <li><a href="#">Lifestyle</a></li>
      <li><a href="#">Business</a></li>
      <li><a href="#">Freelancing</a></li>
      <li><a href="#">Travel</a></li>
      <li><a href="#">Adventure</a></li>
      <li><a href="#">Food</a></li>
      <li><a href="#">Lifestyle</a></li>
      <li><a href="#">Business</a></li>
      <li><a href="#">Freelancing</a></li>
    </ul>
  </div>
</div>
<!-- END sidebar -->
