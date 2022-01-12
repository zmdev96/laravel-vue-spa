@extends('front.layouts.app')
@section('content')

  <section class="site-section py-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4">Categories</h2>
        </div>
      </div>
      <div class="row blog-entries">
        <div class="col-md-12 col-lg-8 main-content">
          <div class="row">
            @foreach ($categories as $category)
              <div class="col-md-6 cat-content">
                <div class="header">
                  <a href="{{route('front.categories.singel',$category->id)}}">
                    <span class="cat-icon"><i class="fa fa-th-list fa-fw"></i></span>
                    <span class="cat-name">{{$category->name}}</span>
                    <span class="sub-count">Sub Categories {{$category->child->count()}}</span>
                  </a>
                </div>
                <div class="sub">
                  @foreach ($category->child as $child)
                    <ul>
                      <li><a href="{{route('front.categories.sub',[$category->id,$child->id] )}}">{{$child->name}}</a></li>

                    </ul>
                  @endforeach
                </div>
              </div>
            @endforeach
          </div>

        </div>

        <!-- END main-content -->
        @include('front.layouts.page_side')


      </div>
    </div>
  </section>
@endsection
