<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    // make some functions example function name get, store, status, edit, update, destroy
    // Banner Model column is image_url
    // and use in return that method return Response::Out("success", "Offer Deleted!", "", 200);
    // write functions
    public function get()
    {
        $data = [
            'banners' => Banner::latest()->get(),
        ];
        return Response::Out("", "", $data, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image_url' => 'required',
        ]);
        $banner = Banner::create($data);
        return Response::Out("success", "Banner Added!", $banner, 200);
    }

    public function status($id)
    {
        $banner = Banner::find($id);
        $banner->status = $banner->status === "active" ? "inactive" : "active";
        $banner->save();
        $banner_status = $banner->status === "active" ? "Active" : "InActive";
        return Response::Out("success", "Banner Status " . $banner_status . "!", $banner, 200);
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return Response::Out("success", "", $banner, 200);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image_url' => 'required',
        ]);
        $banner = Banner::find($id);
        $banner->update($data);
        return Response::Out("success", "Banner Updated!", $banner, 200);
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return Response::Out("success", "Banner Deleted!", "", 200);
    }

}
