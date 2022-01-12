<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\AdsCategory;



class GeneralController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function categories()
  {
      $categories = Category::with('child')->where('status', 'enabled')->get();
      return response()->json(['status' => true, 'categories' => $categories ]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function popularPosts()
  {
      $posts = Post::where('status', 'published')->orderBy('views', 'desc')->limit(3)->get();
      return response()->json(['status' => true, 'posts' => $posts ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function acategories()
   {
       $categories = AdsCategory::with('child')->where('status', 'enabled')->get();
       return response()->json(['status' => true, 'ads_categories' => $categories ]);
   }
  /**
   * Store the image from CKEditor
   *
   * @return string
   */
  public function CKEditor(Request $request)
  {
    if($request->hasFile('upload')) {
        //get filename with extension
        $filenamewithextension = $request->file('upload')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('upload')->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;

        //Upload File
        $request->file('upload')->storeAs('images/blogs/blogs_content', $filenametostore);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('storage/images/blogs/blogs_content/'.$filenametostore);
        $msg = 'Image successfully uploaded';
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        // Render HTML output
        @header('Content-type: text/html; charset=utf-8');
        echo $re;
    }
  }
  /**
   * Store the image from CKEditor
   *
   * @return string
   */
  public function CKEditorAds(Request $request)
  {
    if($request->hasFile('upload')) {
        //get filename with extension
        $filenamewithextension = $request->file('upload')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('upload')->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;

        //Upload File
        $request->file('upload')->storeAs('images/ads/ads_content', $filenametostore);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('storage/images/ads/ads_content/'.$filenametostore);
        $msg = 'Image successfully uploaded';
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        // Render HTML output
        @header('Content-type: text/html; charset=utf-8');
        echo $re;
    }
  }
}
