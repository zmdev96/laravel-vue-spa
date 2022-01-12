<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;

use Storage;
use Carbon\Carbon;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::with(['user', 'member', 'sub'])->get();
      return view('admin.posts.index', ['title' => 'Posts Manage' , 'posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // get the sub categor< with ajax
      if (request()->ajax()) {
        $sub_categories = SubCategory::where('category_id', request('cat_id'))->get();
        if ($sub_categories) {
          return response()->json(['status'=> true, 'sub_cat' => $sub_categories]);
        }else {
          return response()->json(['status'=> false]);
        }
      }

      $categories = Category::all();
      $sub_categories = SubCategory::all();

      return view('admin.posts.create', [
         'title' => 'Posts| Create',
         'categories' => $categories,
       ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate(request(), [
        'title'     => 'required|string|between:3,60',
        'cat_id'    => 'required|numeric',
        'sub_id'    => 'required|numeric',
        'desc'      => 'required|string|between:3,100',
        'image'     => 'required|image|mimes:jpg,png,jpeg',
        'content'   => 'required|string',
      ],[],[
        'title'      => 'Title',
        'cat_id'    => 'Category',
        'sub_id'    => 'Sub Category',
        'desc'      => 'Discription',
        'image'     => 'Image',
        'content'   => 'Content',
      ]);

      $post = new Post;
      $post->title = request('title');
      $post->description = request('desc');
      $post->sub_category_id = request('sub_id');
      $post->user_id = admin()->user()->id;
      $post->image = request()->file('image')->store('images/blogs');
      $post->content = request('content');
      if ($post->save()) {
        return redirect(route('admin.posts.index'))->with(['status' => 'success' , 'message' => 'Post created successfuly']);
      }else {
        return redirect(route('admin.posts.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
      }
    }


    /*
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::with(['user', 'member', 'sub', 'approved_by'])->find($id);
      $parent     = Category::where('id',$post->sub->category_id)->first();
      //dd($post);
      if ($post) {
        return view('admin.posts.show', ['title' => 'Posts| Show' , 'post' => $post, 'parent' => $parent]);
      }else {
        return redirect()->back();
      }

    }


    /**
     * Approve the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
      $post = Post::find($id);

      if ($post->status == 'published') {
        return redirect(route('admin.posts.index'))->with(['status' => 'danger' ,'message' => 'Post already Published!']);
      }else {
        $post->status = 'published';
        $post->approved_at = Carbon::now();
        $post->approved_by = admin()->user()->id;
        if ($post->save()) {
          return redirect(route('admin.posts.index'))->with(['status' => 'success' , 'message' => 'Post published successfuly']);
        }else {
          return redirect(route('admin.posts.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
        }
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $categories = Category::all();
      $post       = Post::with(['user', 'member', 'sub'])->find($id);
      $parent     = Category::where('id',$post->sub->category_id)->first();

      // get the sub categor< with ajax
      if (request()->ajax()) {
        $sub_categories = SubCategory::where('category_id', request('cat_id'))->get();
        $current_sub = $post->sub->id;

        if ($sub_categories) {
          return response()->json(['status'=> true, 'sub_cat' => $sub_categories, 'current' => $current_sub]);
        }else {
          return response()->json(['status'=> false]);
        }
      }

      if ($post) {
        return view('admin.posts.edit', [
           'title' => 'Posts| Edit',
           'categories' => $categories,
           'parent' => $parent,
           'post' => $post,
         ]);
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate(request(), [
        'title'     => 'required|string|between:3,60',
        'cat_id'    => 'required|numeric',
        'sub_id'    => 'required|numeric',
        'desc'      => 'required|string|between:3,100',
        'image'     => 'sometimes|nullable|image|mimes:jpg,png,jpeg',
        'status'    => 'required|string',
        'content'   => 'required|string',
      ],[],[
        'title'      => 'Title',
        'cat_id'    => 'Category',
        'sub_id'    => 'Sub Category',
        'desc'      => 'Discription',
        'image'     => 'Image',
        'status'    => 'Status',
        'content'   => 'Content',
      ]);

      $post  = Post::find($id);
      $post->title = request('title');
      $post->description = request('desc');
      $post->sub_category_id = request('sub_id');
      $post->status = request('status');
      if (request()->hasFile('image')) {
          $post->image !== null ? Storage::delete($post->image) : '';
          $post->image = request()->file('image')->store('images/blogs');
      }
      $post->content = request('content');
      if ($post->save()) {
        return redirect(route('admin.posts.index'))->with(['status' => 'success' , 'message' => 'Post Updated successfuly']);
      }else {
        return redirect(route('admin.posts.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // delete the post image in the first
      $post = Post::find($id);
      $post->image !== null ? Storage::delete($post->image) : '';
      if ($post->delete()) {
         return redirect()->back()->with(['status' => 'success' ,'message' => 'Post deleted successfuly']);
      }else {
         return redirect()->back()->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
      }
    }
}
