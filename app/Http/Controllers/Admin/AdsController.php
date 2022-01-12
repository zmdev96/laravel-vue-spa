<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Ad;
use App\Models\AdsCategory;

use Carbon\Carbon;
use Storage;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ads = Ad::with(['user', 'member', 'category', 'approved_by'])->get();
      return view('admin.ads.index', ['title' => 'Ads Manage', 'ads' => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $ads_categories = AdsCategory::where('status', 'enabled')->get();
      return view('admin.ads.create', ['title' => 'Ads| Create', 'ads_categories' => $ads_categories]);

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
        'address'   => 'required|string|between:3,60',
        'cat_id'    => 'required|numeric',
        'desc'      => 'required|string|between:3,100',
        'image'     => 'required|image|mimes:jpg,png,jpeg',
        'purchase_type'  => 'required|string',
        'price'     => 'required_if:purchase_type,paid',
        'content'   => 'required|string',
      ],[],[
        'title'     => 'Title',
        'address'   => 'Address',
        'cat_id'    => 'Category',
        'desc'      => 'Discription',
        'image'     => 'Image',
        'purchase_type' => 'Purchase type',
        'price'     => 'Price',
        'content'   => 'Content',
      ]);

      $ad = new Ad;
      $ad->title = request('title');
      $ad->description = request('desc');
      $ad->ads_category_id = request('cat_id');
      $ad->user_id = admin()->user()->id;
      $ad->purchase_type = request('purchase_type');
      $ad->price = request()->has('purchase_type') && request('purchase_type') == 'paid' ? request('price') : null;
      $ad->image = request()->file('image')->store('images/ads');
      $ad->address = request('address');
      $ad->content = request('content');
      if ($ad->save()) {
        return redirect(route('admin.ads.index'))->with(['status' => 'success' , 'message' => 'Ads created successfuly']);
      }else {
        return redirect(route('admin.ads.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
      $ad = Ad::with(['user', 'category', 'approved_by'])->find($id);
      if ($ad) {
        return view('admin.ads.show', ['title' => 'Ads| Show', 'ad' => $ad]);
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
      $ad = Ad::find($id);
      if ($ad->status == 'published') {
        return redirect(route('admin.ads.index'))->with(['status' => 'danger' ,'message' => 'Ad already Published!']);
      }else {
        $ad->status = 'published';
        $ad->approved_at = Carbon::now();
        $ad->approved_by = admin()->user()->id;
        if ($ad->save()) {
          return redirect(route('admin.ads.index'))->with(['status' => 'success' , 'message' => 'Ad published successfuly']);
        }else {
          return redirect(route('admin.ads.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
      $ads_categories = AdsCategory::all();
      $ad = Ad::with(['user', 'category', 'approved_by'])->find($id);
      if ($ad) {
        return view('admin.ads.edit', ['title' => 'Ads Edit', 'ad' => $ad, 'ads_categories' => $ads_categories]);
      }else {
        return redirect()->back();
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
        'address'   => 'required|string|between:3,60',
        'cat_id'    => 'required|numeric',
        'desc'      => 'required|string|between:3,100',
        'image'     => 'sometimes|nullable|mimes:jpg,png,jpeg',
        'purchase_type'  => 'required|string',
        'price'     => 'required_if:purchase_type,paid',
        'content'   => 'required|string',
      ],[],[
        'title'     => 'Title',
        'address'   => 'Address',
        'cat_id'    => 'Category',
        'desc'      => 'Discription',
        'image'     => 'Image',
        'purchase_type' => 'Purchase type',
        'price'     => 'Price',
        'content'   => 'Content',
      ]);

      $ad = Ad::find($id);
      $ad->title = request('title');
      $ad->description = request('desc');
      $ad->ads_category_id = request('cat_id');
      $ad->user_id = admin()->user()->id;
      $ad->purchase_type = request('purchase_type');
      $ad->price = request()->has('purchase_type') && request('purchase_type') == 'paid' ? request('price') : null;
      if (request()->hasFile('image')) {
        $ad->image !== null ? Storage::delete($ad->image) : '';
        $ad->image = request()->file('image')->store('images/ads');
      }
      $ad->address = request('address');
      $ad->content = request('content');
      if ($ad->save()) {
        return redirect(route('admin.ads.index'))->with(['status' => 'success' , 'message' => 'Ads updated successfuly']);
      }else {
        return redirect(route('admin.ads.index'))->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
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
      $ad = Ad::find($id);
      $ad->image !== null ? Storage::delete($ad->image) : '';
      if ($ad->delete()) {
         return redirect()->back()->with(['status' => 'success' ,'message' => 'Ad deleted successfuly']);
      }else {
         return redirect()->back()->with(['status' => 'danger' ,'message' => 'Something went wrong! Please try again']);
      }
    }
}
