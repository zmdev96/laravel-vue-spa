@extends('front.layouts.app')
@section('content')

  <section class="site-section py-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4">Ads Categories</h2>
        </div>
      </div>
      <div class="row blog-entries">
        <div class="col-md-12 col-lg-8 main-content">
          <div class="row">
            @foreach ($ads_categories as $category)
              <div class="col-md-6 cat-content">
                <div class="header">
                  <a href="{{route('front.categories.singel',$category->id)}}">
                    <span class="cat-icon"><i class="fa fa-th-list fa-fw"></i></span>
                    <span class="cat-name">{{$category->name}}</span>
                    <span class="sub-count">Ads {{$category->child->count()}}</span>
                  </a>
                </div>
                <div class="sub">
                  <?php $count = 1;?>
                  @foreach ($category->child as $child)
                    <ul>
                      <li><a href="{{route('front.ads-categories.singel',[$category->id,$child->id] )}}">{{$child->title}}</a></li>
                    </ul>
                   <?php if($count++ == 5) break ?>
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
