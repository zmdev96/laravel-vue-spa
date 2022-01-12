<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilemanagerController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin.filemanager.index', ['title' => 'File Manager']);

  }


  /**
   * Upload the Post image from ckeditor
   *
   * @return string
   */
   public function blog_upload(Request $request)
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
    * Upload the Post image from ckeditor
    *
    * @return string
    */
    public function ads_upload(Request $request)
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
