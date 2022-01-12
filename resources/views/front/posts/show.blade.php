@extends('front.layouts.app')
@section('content')
  <section class="site-section py-lg">
    <div class="container">

      <div class="row blog-entries element-animate">

        <div class="col-md-12 col-lg-8 main-content">
          <img src="{{Storage::url($post->image)}}" alt="Image" class="img-fluid mb-5">
           <div class="post-meta">
            <span class="author mr-2"><img src="{{Storage::url($post->user->profile->image)}}" alt="{{$post->user->username}}" class="mr-2"> {{$post->user->first_name}} {{$post->user->last_name}}</span>&bullet;
            <span class="mr-2">{{\DateTime::createFromFormat('Y-m-d H:i:s', $post->approved_at)->format('M j, Y')}}</span> &bullet;
            <span class="ml-2"><span class="fa fa-comments"></span> {{ $post->comments->count()}}</span>
            <span class="ml-2"><span class="fa fa-eye"></span> {{ $post->views}}</span>

          </div>
          <h1 class="mb-4">{{$post->title}}</h1>
          <a class="category mb-5" href="{{route('front.categories.singel', $post->sub->parent->id)}}">{{$post->sub->parent->name}}</a> <a class="category mb-5" href="{{route('front.categories.sub',[$post->sub->parent->id, $post->sub->id] )}}"> {{$post->sub->name}} </a>

          <div class="post-content-body">
            {!!$post->content!!}
          </div>

          <div class="pt-3">
            <p>Categories: <a class="category mb-5" href="{{route('front.categories.singel', $post->sub->parent->id)}}">{{$post->sub->parent->name}}</a> <a class="category mb-5" href="{{route('front.categories.sub',[$post->sub->parent->id, $post->sub->id] )}}"> {{$post->sub->name}} </a></p>
          </div>

          <div class="pt-3">
            <h3 class="mb-3" id="comments_count"></h3>
            <div class="total-comments">
              @foreach ($post->comments as $comment)
                <ul class="comment-list">
                  <li class="comment">
                    <div class="vcard">
                      <img src="/assets/front/images/person_1.jpg" alt="Image placeholder">
                    </div>
                    <div class="comment-body">
                      <h3>{{ $post->comments->first()->member->first_name }} {{ $post->comments->first()->member->last_name }}</h3>
                      <div class="meta">{{\DateTime::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('M j, Y : H:i')}}</div>
                      <p>{{$comment->comment}}</p>
                    </div>
                  </li>
                </ul>
              @endforeach
            </div>
            <!-- END comment-list -->

            <div class="comment-form-wrap pt-5">
              <h3 class="mb-2">Leave a comment</h3>
              @guest('web')
                  <a href="{{route('login')}}">Login to write a Comment</a>
              @else
                <div class="comment-form">
                  <form id="comment_form" action="#" class="p-2 bg-light" method="post">
                    <input type="hidden" class="post_id" name="post_id" value="{{$post->id}}">
                    <input type="hidden" class="member_id" name="member_id" value="{{web()->user()->id}}">

                    <div class="form-group">
                      <label for="message">Comment</label>
                      <textarea name="comment" id="comment"  cols="30" rows="5" class="form-control comment" placeholder="Write Your Comment Hier!"></textarea>
                      <span class="comment-error"></span>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Send Comment" class="btn btn-primary comment_submit disabled" disabled>
                    </div>
                  </form>
                </div>
              @endguest
            </div>
          </div>

        </div>

        <!-- END main-content -->
        @include('front.layouts.page_side')




      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mb-3 ">Related Post</h2>
      </div>
    </div>
    <div class="row">
      @foreach ($related as $rel)
        <div class="col-md-6 col-lg-4">
          <a href="{{route('front.posts.show', $rel->id)}}" class="a-block sm d-flex align-items-center height-md" style="background-image: url({{Storage::url($rel->image)}}); ">
            <div class="text">
              <div class="post-meta">
                <span class="category">{{$rel->sub->parent->name}}</span>
                <span class="mr-2">{{\DateTime::createFromFormat('Y-m-d H:i:s', $post->approved_at)->format('M j, Y')}} </span> &bullet;
                <span class="ml-2"><span class="fa fa-comments"></span> {{$rel->comments->count()}}</span>
              </div>
              <h3>{{$rel->title}}</h3>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
  </section>
<!-- END section -->
  @section('js')
    <script type="text/javascript">
      $(document).ready(function (){
        // init getCommtens function
        getComments();
        // Check key up submit button
        $("#comment").keyup(function() {
          var my_comment = $('#comment').val();
          if (my_comment !== '') {
            $('.comment_submit').removeClass('disabled');
            $('.comment_submit').prop("disabled", false);
          }else {
            $('.comment_submit').addClass('disabled');
            $('.comment_submit').prop("disabled", true);
          }
        });
        // submition the comment form
        $('#comment_form').submit(function (e){
          e.preventDefault();
          var comment = $('#comment').val();
          var member_id = $('.member_id').val();
          var post_id = $('.post_id').val();
          var token   = $('meta[name="csrf-token"]').attr('content');
          if (comment.length < 15) {
            $('#comment_form textarea').css('border-color', '#dc3545');
            $('#comment_form label').css('color', '#dc3545');
            $('#comment_form .comment-error').css('color', '#dc3545');
            $('#comment_form .comment-error').html('comment must be more than 15 leeter');
          }else {
            $.ajax({
              url: "{{route('front.posts.comments')}}",
              type: 'post',
              data:{comment:comment, member_id:member_id, post_id:post_id, action:'create_comment'},
              headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success:function(data){
                $('.comment_submit').addClass('disabled');
                $('.comment_submit').prop("disabled", true);
                $('#comment').val('');
                $('#comment_form textarea').css('border-color', '#6c757d');
                $('#comment_form label').css('color', '#6c757d');
                $('#comment_form .comment-error').css('color', 'green');
                $('#comment_form .comment-error').html(data.message);
                if (data.status == true) {
                  $('.total-comments').append("<ul class='comment-list'>"
                  + "<li class='comment'>"
                  + "<div class='vcard'>"
                  + "<img src='/assets/front/images/person_1.jpg' />"
                  + "</div>"
                  + "<div class='comment-body'>"
                  + "<h3>{{\Auth::guard('web')->check()? web()->user()->first_name : ''}} {{\Auth::guard('web')->check()? web()->user()->last_name : ''}}</h3>"
                  + "<div class='meta'>"+ data.date +"</div>"
                  + "<p>"+ comment +"</p>"
                  + "</div>"
                  +"</li>"
                  +"</ul>");
                  getComments();
                }
              }
            });
          }
        });
        // Get the post comments count
        function getComments(){
          var post_id = $('.post_id').val();
          var token   = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url: "{{route('front.posts.comments')}}",
            type: 'post',
            data:{post_id:post_id, action:'get_count'},
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (data)
            {
              $('#comments_count').html(data.message + ' Comments');
            },
          });
        };
      });
    </script>
  @endsection
@endsection
