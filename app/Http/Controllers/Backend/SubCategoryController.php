<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Subcategory\StoreRequest;
use App\Http\Requests\Backend\Subcategory\UpdateRequest;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.sub-category.index');
    }
    public function get(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        $sort_by_dir = $request->sort_by_dir;
        $sort_by = $request->sort_by;
        if (isset($search) && isset($status) && isset($sort_by_dir) && isset($sort_by)) {
            if ($status === "1") {
                $subCategories = SubCategory::where('name', 'like', '%' . $search . '%')
                    ->where('status', 'active')
                    ->orderBy($sort_by_dir, $sort_by)
                    ->get();
            } else {
                $subCategories = SubCategory::where('name', 'like', '%' . $search . '%')
                    ->where('status', 'inactive')
                    ->orderBy($sort_by_dir, $sort_by)
                    ->get();
            }
        }
        if (isset($search) && isset($status)) {
            if ($status === "1") {
                $subCategories = SubCategory::where('name', 'like', '%' . $search . '%')
                    ->where('status', 'active')
                    ->orderBy('created_at', $sort_by)
                    ->get();
            } else {
                $subCategories = SubCategory::where('name', 'like', '%' . $search . '%')
                    ->where('status', 'inactive')
                    ->orderBy('created_at', $sort_by)
                    ->get();
            }
        } elseif (isset($sort_by_dir) && isset($sort_by) && isset($status)) {
            if ($status === "1") {
                $subCategories = SubCategory::where('status', 'active')
                    ->orderBy($sort_by_dir, $sort_by)
                    ->get();
            } elseif ($status === "2") {
                $subCategories = SubCategory::where('status', 'inactive')
                    ->orderBy($sort_by_dir, $sort_by)
                    ->get();
            }
        } elseif (isset($sort_by_dir) && isset($sort_by) && isset($search)) {
            $subCategories = SubCategory::where('name', 'like', '%' . $search . '%')
                ->orderBy($sort_by_dir, $sort_by)
                ->get();
        } elseif (isset($search)) {
            $subCategories = SubCategory::where('name', 'like', '%' . $search . '%')
                ->orderBy('created_at', $sort_by)
                ->get();
        } elseif (isset($status)) {
            if ($status === "1") {
                $subCategories = SubCategory::where('status', 'active')
                    ->orderBy('created_at', $sort_by)
                    ->get();
            } elseif ($status === "2") {
                $subCategories = SubCategory::where('status', 'inactive')
                    ->orderBy('created_at', $sort_by)
                    ->get();
            }
        } elseif (isset($sort_by_dir) && isset($sort_by)) {
            $subCategories = SubCategory::orderBy($sort_by_dir, $sort_by)
                ->get();
        } else {
            $subCategories = SubCategory::orderBy('created_at', $sort_by)
                ->get();
        }
        $data = [
            'sub_categories' => $subCategories,
        ];
        return Response::Out("", "", $data, 200);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->slug = SubCategory::generateSlug($request->name);
        $subCategory->image_url = $request->image_url;
        $subCategory->category_id = $request->category_id;
        $subCategory->save();

        return Response::Out("success", "Sub Category Added!", "", 200);
    }

    public function bannerStoreOrUpdate(Request $request, $id)
    {
        $sub_category = SubCategory::find($id);
        $sub_category->banner_url = $request->banner_url;
        $sub_category->update();

        if (!is_null($sub_category->banner_url)) {
            return Response::Out("success", "Sub Category Banner Stored!", "", 200);
        } else {
            return Response::Out("success", "Sub Category Banner Remove!", "", 200);
        }
    }
    public function status($id): JsonResponse
    {
        $subCategory = SubCategory::find($id);
        $subCategory->status = $subCategory->status == 'active' ? 'inactive' : 'active';
        $subCategory->save();

        $status = $subCategory->status == 'active' ? 'Active' : 'InActive';
        return Response::Out("success", "Sub Category Status $status!", "", 200);
    }
    public function edit($id): JsonResponse
    {
        $subCategory = SubCategory::find($id);
        return Response::Out("", "", $subCategory, 200);
    }
    public function update(UpdateRequest $request, $id): JsonResponse
    {
        $subCategory = SubCategory::find($id);
        $slug = SubCategory::generateSlugForUpdate($subCategory->name, $subCategory->slug, $request->name);

        $subCategory->name = $request->name;
        $subCategory->slug = $slug;
        $subCategory->image_url = $request->image_url;
        $subCategory->category_id = $request->category_id;
        $subCategory->update();

        return Response::Out("success", "Sub Category Updated!", "", 200);
    }
    public function destroy($id): JsonResponse
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();

        return Response::Out("success", "Sub Category Deleted!", "", 200);
    }
}
