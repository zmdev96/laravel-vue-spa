<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;


class PostsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $posts = Post::with(['user.profile', 'member.profile', 'comments', 'sub'])->where('status', 'published')->get();
      return response()->json(['status' => true, 'posts' => $posts]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $post = Post::with(['user.profile', 'member.profile', 'sub.parent', 'comments.member'])->find($id);
    $related_posts = Post::with(['user.profile', 'member.profile', 'sub', 'comments'])
    ->where(['sub_category_id' => $post->sub_category_id , 'status' => 'published'])
    ->orderBy('approved_at', 'DESC')
    ->limit(3)
    ->get();
    if ($post && $post->status == 'published') {
      return response()->json(['status' => true, 'post' => $post, 'related' =>$related_posts]);
    }

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function comments($id)
  {
    $comments = PostComment::with('member.profile')->where('post_id',$id)->get();

    if ($comments) {
      return response()->json(['status' => true, 'comments' => $comments]);
    }

  }

  /**
   * Store the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function storeComment()
  {
    $this->validate(request(), [
      'comment'      => 'required|string|between:8,120',
      'member_id'      => 'required',
      'post_id'      => 'required',
    ],[],[
      'comment'      => 'Comment',
    ]);
    $comment = new PostComment;
    $comment->comment = request('comment');
    $comment->member_id = request('member_id');
    $comment->post_id = request('post_id');
    if ($comment->save()) {
      return response()->json(['status' => true, 'message' => 'Comment added successfuly']);
    }else {
      return response()->json(['status' => false, 'message' => 'Something went wrong! Please try again']);
    }
  }
}
