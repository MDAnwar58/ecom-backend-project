<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\GalleryCategory\UpdateRequest;
use App\Http\Requests\Backend\GalleryCategory\StoreRequest;
use App\Models\GalleryCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryCategoryController extends Controller
{
    public function galleryGet(): JsonResponse
    {
        $gallery_categories = GalleryCategory::latest()->get();
        return Response::Out("", "", $gallery_categories, 200);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $gallery_category = new GalleryCategory();
        $gallery_category->name = $request->name;
        $gallery_category->save();

        return Response::Out("success", "Gallery Category Created!", "", 200);
    }
    public function edit($id): JsonResponse
    {
        $gallery_category = GalleryCategory::find($id);
        return Response::Out("", "", $gallery_category, 200);
    }
    public function update(UpdateRequest $request, $id)
    {
        $gallery_category = GalleryCategory::find($id);
        $gallery_category->name = $request->name;
        $gallery_category->update();

        return Response::Out("success", "Gallery Category Updated!", "", 200);
    }
    public function destroy($id)
    {
        $gallery_category = GalleryCategory::find($id);
        $gallery_category->delete();

        return Response::Out("success", "Gallery Category Deleted!", "", 200);
    }
}
