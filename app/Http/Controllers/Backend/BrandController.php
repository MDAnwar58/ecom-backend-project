<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Brand\StoreRequest;
use App\Http\Requests\Backend\Brand\UpdateRequest;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(): View
    {
        return view('admin.brand.index');
    }
    public function get(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        if (isset($search) && isset($status)) {
            if ($status === "1") {
                $brands = Brand::where('name', 'like', '%' . $search . '%')
                    ->where('status', 'active')
                    ->latest()
                    ->get();
            } else {
                $brands = Brand::where('name', 'like', '%' . $search . '%')
                    ->where('status', 'inactive')
                    ->latest()
                    ->get();
            }
        } elseif (isset($search)) {
            $brands = Brand::where('name', 'like', '%' . $search . '%')->latest()->get();
        } elseif (isset($status)) {
            if ($status === "1") {
                $brands = Brand::where('status', 'active')->latest()->get();
            } else {
                $brands = Brand::where('status', 'inactive')->latest()->get();
            }
        } else {
            $brands = Brand::latest()->get();
        }
        $data = [
            'brands' => $brands,
        ];
        return Response::Out("", "", $data, 200);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Brand::generateSlug($request->name);
        $brand->image_url = $request->image_url;
        $brand->save();
        return Response::Out("success", "Brand Created!", "", 200);
    }
    public function status($id): JsonResponse
    {
        $brand = Brand::find($id);
        if ($brand->status === 'active') {
            $brand->status = 'inactive';
            $brand->update();

            return Response::Out("success", $brand->name . " " . "Brand InActive!", "", 200);
        } else {
            $brand->status = 'active';
            $brand->update();

            return Response::Out("success", $brand->name . " " . "Brand Active!", "", 200);
        }
    }
    public function edit($id): JsonResponse
    {
        $brand = Brand::find($id);
        return Response::Out("", "", $brand, 200);
    }
    public function update(UpdateRequest $request): JsonResponse
    {
        $brand = Brand::find($request->id);
        $slug = Brand::generateSlugForUpdate($brand->name, $brand->slug, $request->name);

        $brand->name = $request->name;
        $brand->slug = $slug;
        if (!is_null($request->image_url)) {
            $brand->image_url = $request->image_url;
        }
        $brand->update();

        return Response::Out("success", "Brand Updated!", "", 200);
    }
    public function destroy($id): JsonResponse
    {
        $brand = Brand::find($id);
        $brand->delete();

        return Response::Out("success", "Brand Deleted!", "", 200);
    }
}
