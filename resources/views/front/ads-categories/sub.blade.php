@extends('front.layouts.app')
@section('content')

  <section class="site-section py-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4">{{ $category->name }} | {{ $sub_category->name }}</h2>
        </div>
      </div>
      <div class="row blog-entries">
        <div class="col-md-12 col-lg-8 main-content">
          <div class="row">
            @foreach ($sub_category->posts as $post)
              <div class="col-md-6">
                <a href="{{route('front.posts.show', $post->id)}}" class="blog-entry element-animate" data-animate-effect="fadeIn">
                  <img src="{{Storage::url($post->image)}}" alt="Image placeholder">
                  <div class="blog-content-body">
                    <div class="post-meta">
                      <span class="author mr-2"><img src="{{Storage::url($post->user->profile->image)}}" alt="member image">&nbsp;{{$post->user->first_name}} {{$post->user->last_name}}</span>
                      <span class="mr-2">{{\DateTime::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('M j, Y')}}</span> &bullet;
                      <span class="ml-2"><span class="fa fa-comments"></span> {{ $post->comments->count()}}</span>
                    </div>
                    <div class="cat-info">
                      <span>{{$post->sub->name}}</span>
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
