@extends('front.layouts.app')
@section('content')

  <section class="site-section pt-3 pb-5">
    <div class="container">
      @if (session()->has('registr_action'))
        <div class="row">
          <div class="col-md-12 ">
            <div class="alert alert-success">
              {{session()->get('message')}}
            </div>
          </div>
        </div>
      @endif
      @if (session()->has('is_verified'))
        <div class="row">
          <div class="col-md-12 ">
            <div class="alert alert-success">
              {{session()->get('is_verified')}}
              {{session()->forget('is_verified')}}
            </div>
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col-md-12">

          <div class="owl-carousel owl-theme home-slider">
            <div>
              <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('/assets/front/images/img_1.jpg'); ">
                <div class="text half-to-full">
                  <span class="category mb-5">Food</span>
                  <div class="post-meta">

                    <span class="author mr-2"><img src="/assets/front/images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;
                    <span class="mr-2">March 15, 2018 </span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> 3</span>

                  </div>
                  <h3>How to Find the Video Games of Your Youth</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>
                </div>
              </a>
            </div>
            <div>
              <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('/assets/front/images/img_2.jpg'); ">
                <div class="text half-to-full">
                  <span class="category mb-5">Travel</span>
                  <div class="post-meta">

                    <span class="author mr-2"><img src="/assets/front/images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;
                    <span class="mr-2">March 15, 2018 </span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> 3</span>

                  </div>
                  <h3>How to Find the Video Games of Your Youth</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>
                </div>
              </a>
            </div>
            <div>
              <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('/assets/front/images/img_3.jpg'); ">
                <div class="text half-to-full">
                  <span class="category mb-5">Sports</span>
                  <div class="post-meta">

                    <span class="author mr-2"><img src="/assets/front/images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;
                    <span class="mr-2">March 15, 2018 </span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> 3</span>

                  </div>
                  <h3>How to Find the Video Games of Your Youth</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>
                </div>
              </a>
            </div>
          </div>

        </div>
      </div>

    </div>


  </section>
  <!-- END slider -->

  <section class="site-section py-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4">Latest Posts</h2>
        </div>
      </div>
      <div class="row blog-entries">
        <div class="col-md-12 col-lg-8 main-content">
          <div class="row">
            @foreach ($posts as $post)
              <div class="col-md-6">
                <a href="blogs/{{$post->id}}" class="blog-entry element-animate" data-animate-effect="fadeIn">
                  <img src="{{Storage::url($post->image)}}" alt="Image placeholder">
                  <div class="blog-content-body">
                    <div class="post-meta">
                      <span class="author mr-2"><img src="{{Storage::url($post->user->profile->image)}}" alt="member image">&nbsp;{{$post->user->first_name}} {{$post->user->last_name}}</span>
                      <span class="mr-2">{{\DateTime::createFromFormat('Y-m-d H:i:s', $post->approved_at)->format('M j, Y')}}</span> &bullet;
                      <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                    </div>
                    <h2>{{$post->title}}</h2>
                  </div>
                </a>
              </div>
            @endforeach
          </div>

        </div>

        <!-- END main-content -->
        @include('front.layouts.page_side')


      </div>
    </div>
  </section>
  @section('js')

  @endsection
@endsection
