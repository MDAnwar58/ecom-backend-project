<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Collection\StoreRequest;
use App\Http\Requests\Backend\Collection\UpdateRequest;
use App\Models\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $search = $request->search;
        $status = $request->status;
        if (isset($search) && isset($status)) {
            if ($status === "1") {
                $collections = Collection::where('status', 'active')
                    ->where('name', 'like', '%' . $search . '%')
                    ->latest()
                    ->get();
            } else {
                $collections = Collection::where('status', 'inactive')
                    ->where('name', 'like', '%' . $search . '%')
                    ->latest()
                    ->get();
            }
        } elseif (isset($search)) {
            $collections = Collection::where('name', 'like', '%' . $search . '%')->latest()->get();
        } elseif (isset($status)) {
            if ($status === "1") {
                $collections = Collection::where('status', 'active')
                    ->latest()
                    ->get();
            } else {
                $collections = Collection::where('status', 'inactive')
                    ->latest()
                    ->get();
            }
        } else {
            $collections = Collection::latest()->get();
        }
        $data = [
            'collections' => $collections
        ];
        return Response::Out("", "", $data, 200);
    }
    public function status($id): JsonResponse
    {
        $collection = Collection::find($id);
        if ($collection->status === "active") {
            $collection->status = "inactive";
            $collection->save();

            return Response::Out("success", $collection->name . " " . "Collection InActive!", "", 200);
        } else {
            $collection->status = "active";
            $collection->save();

            return Response::Out("success", $collection->name . " " . "Collection Active!", "", 200);
        }
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $collection = new Collection();
        $collection->name = $request->name;
        $collection->save();
        return Response::Out("success", "Collection Created!", "", 200);
    }
    public function edit($id): JsonResponse
    {
        $collection = Collection::find($id);
        return Response::Out("", "", $collection, 200);
    }
    public function update(UpdateRequest $request, $id): JsonResponse
    {
        $collection = Collection::find($id);
        $collection->name = $request->name;
        $collection->update();
        return Response::Out("success", "Collection Updated!", "", 200);
    }
    public function destroy($id): JsonResponse
    {
        $collection = Collection::find($id);
        $collection->delete();
        return Response::Out("success", "Collection Deleted!", "", 200);
    }
}
