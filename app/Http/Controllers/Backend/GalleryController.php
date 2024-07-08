<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Gallery\StoreRequest;
use App\Http\Requests\Backend\Gallery\UpdateRequest;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    function get(Request $request)
    {
        $search = $request->search;
        if (isset($request->gallery_category_id) && isset($search)) {
            $gallery_category = GalleryCategory::find($request->gallery_category_id);
            $galleries = Gallery::where('image_name', 'like', '%' . $search . '%')
                ->where('gallery_category_id', $gallery_category->id)
                ->latest()
                ->get();
        } elseif (isset($search)) {
            $galleries = Gallery::where('image_name', 'like', '%' . $search . '%')->latest()->get();
        } elseif (isset($request->gallery_category_id)) {
            $gallery_category = GalleryCategory::find($request->gallery_category_id);
            $galleries = Gallery::where('gallery_category_id', $gallery_category->id)->latest()->get();
        } else {
            $galleries = Gallery::latest()->get();
        }
        $data = [
            'galleries' => $galleries,
        ];
        return Response::Out("", "", $data, 200);
    }
    function store(StoreRequest $request)
    {
        $extention = Gallery::fileExtention($request->hasFile('image'), $request->file('image'));
        $size = Gallery::fileSize($request->hasFile('image'), $request->file('image'));
        $file = Gallery::fileStore($request->hasFile('image'), $request->file('image'), $request->image_name, "");
        $file_type = Gallery::fileType($request->hasFile('image'), $request->file('image'));
        $gallery = new Gallery();
        $gallery->gallery_category_id = $request->gallery_category_id;
        $gallery->image_name = $request->image_name;
        $gallery->image_extention = $extention != null ? $extention : null;
        $gallery->image_size = $size != null ? $size : null;
        $gallery->url = $file != null ? $file : null;
        $gallery->file_type = $file_type != null ? $file_type : null;
        $gallery->save();

        return Response::Out("success", "Gallery's File Created!", "", 200);
    }
    function storeGalleryWithGalleryCategory(Request $request, $gallery_category_id)
    {
        $request->validate([
            'image_name' => 'required',
            'image' => 'required|image',
        ]);
        $galleryCategory = GalleryCategory::find($gallery_category_id);
        if ($galleryCategory) {
            $extention = Gallery::fileExtention($request->hasFile('image'), $request->file('image'));
            $size = Gallery::fileSize($request->hasFile('image'), $request->file('image'));
            $file = Gallery::fileStore($request->hasFile('image'), $request->file('image'), $request->image_name, "");
            $file_type = Gallery::fileType($request->hasFile('image'), $request->file('image'));
            $gallery = new Gallery();
            $gallery->gallery_category_id = $galleryCategory->id;
            $gallery->image_name = $request->image_name;
            $gallery->image_extention = $extention != null ? $extention : null;
            $gallery->image_size = $size != null ? $size : null;
            $gallery->url = $file != null ? $file : null;
            $gallery->file_type = $file_type != null ? $file_type : null;
            $gallery->save();

            return Response::Out("success", "Gallery's File Created!", "", 200);
        } else {
            return Response::Out("fail", "Something went wrong!", "", 500);
        }
    }
    function infoOrEdit($id): JsonResponse
    {
        $gallery = Gallery::find($id);
        return Response::Out("", "", $gallery, 200);
    }
    function update(UpdateRequest $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->gallery_category_id = $request->gallery_category_id;
        $gallery->image_name = $request->image_name;
        $file = Gallery::fileUpdate($request->image_name, $gallery->url);
        $gallery->url = $file;
        $gallery->update();

        return Response::Out("success", "Gallery's File Updated!", "", 200);
    }
    function destroy($id): JsonResponse
    {
        $gallery = Gallery::find($id);
        $gallery->delete();

        return Response::Out("success", "Gallery's File Deleted!", "", 200);
    }
    function multipleDestroy(Request $request)
    {
        // multiple destroy press
        $ids = $request->ids;
        Gallery::destroy($ids);

        return Response::Out("success", "Multiple Gallery's Images Deleted!", "", 200);
    }

    function getRestore(?Request $request)
    {
        $galleryCategoryId = $request->gallery_category_id;
        $search = $request->search;
        if (isset($search) && isset($galleryCategoryId)) {
            $galleries = Gallery::onlyTrashed()
                ->where('image_name', 'like', '%' . $search . '%')
                ->where('gallery_category_id', $galleryCategoryId)
                ->latest()
                ->get();
        } elseif (isset($search)) {
            $galleries = Gallery::onlyTrashed()
                ->where('image_name', 'like', '%' . $search . '%')
                ->latest()
                ->get();
        } elseif (isset($galleryCategoryId)) {
            $galleries = Gallery::onlyTrashed()
                ->where('gallery_category_id', $galleryCategoryId)
                ->latest()
                ->get();
        } else {
            $galleries = Gallery::onlyTrashed()->latest()->get();
        }
        $data = [
            'galleries' => $galleries,
        ];
        return Response::Out("", "", $data, 200);
    }
    function restore($id): JsonResponse
    {
        $gallery = Gallery::onlyTrashed()->find($id);
        $gallery->restore();

        return Response::Out("success", "Gallery's File Restored!", "", 200);
    }
    function forseDestroy($id): JsonResponse
    {
        $gallery = Gallery::onlyTrashed()->find($id);
        $fileName = basename($gallery->url);
        $file_path = public_path() . '/upload/images/galleries/' . $fileName;

        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $gallery->forceDelete();

        return Response::Out("success", "Gallery's File Permanently Deleted!", "", 200);
    }
    function multipleRestore(Request $request)
    {
        $ids = $request->ids;
        // multiple restore process
        Gallery::onlyTrashed()->whereIn('id', $ids)->restore();

        return Response::Out("success", "Multiple Gallery's File Restored!", "", 200);
    }
    function multipleForseDestroy(Request $request): JsonResponse
    {
        $ids = $request->ids;
        // multiple gallery forse destroy with image remove in public path process
        $galleries = Gallery::onlyTrashed()->whereIn('id', $ids)->get();
        foreach ($galleries as $gallery) {
            $fileName = basename($gallery->url);
            $file_path = public_path() . '/upload/images/galleries/' . $fileName;

            if (File::exists($file_path)) {
                File::delete($file_path);
            }
            $gallery->forceDelete();
        }
        // Gallery::withTrashed()->forceDelete($ids);

        return Response::Out("success", "Multiple Gallery's File Permanently Deleted!", "", 200);
    }
    function imageDownload($id)
    {
        $gallery = Gallery::find($id);
        return Gallery::Download($gallery->url);
    }
    // function multipleForseDestroyInRestore(Request $request)
    // {
    //     $ids = $request->ids;
    //     // multiple gallery forse destroy with image remove in public path process
    //     $galleries = Gallery::withTrashed()->whereIn('id', $ids)->get();
    //     foreach ($galleries as $gallery) {
    //         $fileName = basename($gallery->url);
    //         $file_path = public_path() . '/upload/images/galleries/' . $fileName;

    //         if (File::exists($file_path)) {
    //             File::delete($file_path);
    //         }
    //         $gallery->forceDelete();
    //     }
    //     // Gallery::withTrashed()->forceDelete($ids);

    //     return Response::Out("success", "Multiple Gallery's File Permanently Deleted!", "", 200);
    // }
}
