<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\Ad;
use App\Models\AdsCategory;
use App\Models\Category;
use App\Models\SubCategory;

use Storage;
use Carbon\Carbon;

class MemberprofileContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $posts = Post::with(['member.profile', 'comments', 'sub'])->where('member_id', $id)->get();
        return response()->json(['status' => true, 'posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request('request_type') == 'getCategoreis') {
            $categories = Category::all();
            $sub_categories = SubCategory::all();
            if ($categories) {
                return response()->json(['status' => true, 'categories' => $categories,  'sub_categories' => $sub_categories ]);
            }
        } elseif (request('request_type') == 'getSubCategoreis') {
            $sub_categories = SubCategory::where('category_id', request('category_id'))->get();
            if ($sub_categories) {
                return response()->json(['status' => true, 'sub_categories' => $sub_categories ]);
            }
        }
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
        'category'    => 'required|numeric',
        'sub_category'    => 'required|numeric',
        'desc'      => 'required|string|between:3,100',
        'content'   => 'required|string',
      ], [], [
        'title'      => 'Title',
        'category'    => 'Category',
        'sub_category'    => 'Sub Category',
        'desc'      => 'Discription',
        'content'   => 'Content',
      ]);

        $post = new Post;
        $post->title = request('title');
        $post->description = request('desc');
        $post->sub_category_id = request('sub_category');
        $post->member_id = request('id');
        $post->status = 'pending';
        $post->content = request('content');
        if ($post->save()) {
            return response()->json([
                'status' => true,
                'message' => 'Post created successfuly. Waiting for admin approval!',
                'post_id' => $post->id,
            ]);
        } else {
            return response()->json([
              'status' => false,
              'message' => 'Something went wrong! Please try again',
          ]);
        }
    }

    /**
     * Create the Post Image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imageUpload(Request $request)
    {
        $this->validate(request(), [
              'image'         => 'required|image|mimes:jpg,png,jpeg',
            ], [], [
              'image'       => 'Image',
            ]);
        $post = Post::where('id', request('id'))->first();
        if (request()->hasFile('image')) {
            $post->image !== null ? Storage::delete($post->image) : '';
            $post->image = request()->file('image')->store('images/blogs');
            if ($post->save()) {
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong! Please try again']);
        }
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
      ->where(['sub_category_id' => $post->sub_category_id])
      ->orderBy('approved_at', 'DESC')
      ->limit(3)
      ->get();
        if ($post) {
            return response()->json(['status' => true, 'post' => $post, 'related' =>$related_posts]);
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
        $post = Post::with(['member.profile', 'sub.parent'])->find($id);
        if ($post) {
            return response()->json(['status' => true, 'post' => $post]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate(request(), [
        'title'     => 'required|string|between:3,60',
        'category'    => 'required|numeric',
        'sub_category'    => 'required|numeric',
        'desc'      => 'required|string|between:3,100',
        'content'   => 'required|string',
      ], [], [
        'title'      => 'Title',
        'category'    => 'Category',
        'sub_category'    => 'Sub Category',
        'desc'      => 'Discription',
        'content'   => 'Content',
      ]);

        $post  = Post::find(request('post_id'));
        $post->title = request('title');
        $post->description = request('desc');
        $post->sub_category_id = request('sub_category');
        $post->status = 'pending';
        $post->content = request('content');
        if ($post->save()) {
            return response()->json(['status' => true, 'message' => 'Post updated successfuly']);
        } else {
            return response()->json(['status' => false ,'message' => 'Something went wrong! Please try again']);
        }
    }
    /**
     * Create the Post Image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imageUpdate(Request $request)
    {
        $this->validate(request(), [
              'image'         => 'required|image|mimes:jpg,png,jpeg',
            ], [], [
              'image'       => 'Image',
            ]);
        $post = Post::where('id', request('id'))->first();
        if (request()->hasFile('image')) {
            $post->image !== null ? Storage::delete($post->image) : '';
            $post->image = request()->file('image')->store('images/blogs');
            if ($post->save()) {
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong! Please try again']);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        // delete the post image in the first
        $post = Post::find(request('post_id'));
        $post->image !== null ? Storage::delete($post->image) : '';
        if ($post->delete()) {
            return response()->json(['status' => true]);
        } else {
            return redirect()->back()->with(['status' => false]);
        }
    }






    /**
     * Ads Profile Actions
     *
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adsIndex($id)
    {
        $ads = Ad::with(['member.profile', 'category'])->where('member_id', $id)->get();
        return response()->json(['status' => true, 'ads' => $ads]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adsCreate()
    {
        $categories = AdsCategory::all();
        if ($categories) {
            return response()->json(['status' => true, 'categories' => $categories]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adsStore(Request $request)
    {
        //return response()->json(['status' => true, 'data' => request()->all()]);
        $this->validate(request(), [
         'title'     => 'required|string|between:3,60',
         'category'    => 'required|numeric',
         'desc'      => 'required|string|between:3,100',
         'address'      => 'required|string|between:4,100',
         'purchase_type'   => 'required|string|between:4,100',
         'price'      => 'sometimes|nullable|numeric|min:1',
         'content'   => 'required|string',
       ], [], [
         'title'      => 'Title',
         'category'    => 'Category',
         'sub_category'    => 'Sub Category',
         'desc'      => 'Discription',
         'address'      => 'Address',
         'purchase_type'      => 'Purchase type',
         'price'      => 'Price',
         'content'   => 'Content',
       ]);

        $ad = new Ad;
        $ad->title = request('title');
        $ad->description = request('desc');
        $ad->ads_category_id = request('category');
        $ad->member_id = request('id');
        $ad->status = 'pending';
        $ad->purchase_type = request('purchase_type');
        if (request('purchase_type') == 'paid') {
            $ad->price = request('price');
        }
        $ad->address = request('address');
        $ad->content = request('content');
        if ($ad->save()) {
            return response()->json([
                 'status' => true,
                 'message' => 'Ad created successfuly. Waiting for admin approval!',
                 'ad_id' => $ad->id,
             ]);
        } else {
            return response()->json([
               'status' => false,
               'message' => 'Something went wrong! Please try again',
           ]);
        }
    }

    /**
     * Create the Post Image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adsImageUpload(Request $request)
    {
        $this->validate(request(), [
               'image'         => 'required|image|mimes:jpg,png,jpeg',
             ], [], [
               'image'       => 'Image',
             ]);
        $ad = Ad::where('id', request('id'))->first();
        if (request()->hasFile('image')) {
            $ad->image !== null ? Storage::delete($ad->image) : '';
            $ad->image = request()->file('image')->store('images/ads');
            if ($ad->save()) {
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong! Please try again']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adsShow($id)
    {
        $ad = Ad::with(['user.profile', 'member.profile', 'category'])->find($id);

        if ($ad) {
            return response()->json(['status' => true, 'ad' => $ad]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adsEdit($id)
    {
        $ad = Ad::with(['member.profile', 'category'])->find($id);
        if ($ad) {
            return response()->json(['status' => true, 'ad' => $ad]);
        } else {
            return response()->json(['status' => false]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adsUpdate(Request $request)
    {
        //return response()->json(['status' => true, 'data' => request()->all()]);
        $this->validate(request(), [
                 'title'     => 'required|string|between:3,60',
                 'category'    => 'required|numeric',
                 'desc'      => 'required|string|between:3,100',
                 'address'      => 'required|string|between:4,100',
                 'purchase_type'   => 'required|string|between:4,100',
                 'price'      => 'sometimes|nullable|numeric|min:1',
                 'content'   => 'required|string',
               ], [], [
                 'title'      => 'Title',
                 'category'    => 'Category',
                 'sub_category'    => 'Sub Category',
                 'desc'      => 'Discription',
                 'address'      => 'Address',
                 'purchase_type'      => 'Purchase type',
                 'price'      => 'Price',
                 'content'   => 'Content',
               ]);

        $ad  = Ad::find(request('ad_id'));
        $ad->title = request('title');
        $ad->description = request('desc');
        $ad->ads_category_id = request('category');
        $ad->status = 'pending';
        $ad->purchase_type = request('purchase_type');
        if (request('purchase_type') == 'paid') {
            $ad->price = request('price');
        }
        $ad->address = request('address');
        $ad->content = request('content');
        if ($ad->save()) {
            return response()->json([
                         'status' => true,
                         'message' => 'Ad Updated successfuly. Waiting for admin approval!',

                     ]);
        } else {
            return response()->json([
                       'status' => false,
                       'message' => 'Something went wrong! Please try again',
                   ]);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adsDestroy()
    {
        // delete the ad image in the first
        $ad = Ad::find(request('ad_id'));
        $ad->image !== null ? Storage::delete($ad->image) : '';
        if ($ad->delete()) {
            return response()->json(['status' => true]);
        } else {
            return redirect()->back()->with(['status' => false]);
        }
    }
}
