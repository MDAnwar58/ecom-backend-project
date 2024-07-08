<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Size\UpdateRequest;
use App\Http\Requests\Backend\Size\StoreRequest;
use App\Models\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $search = $request->search;
        if (isset($search)) {
            $sizes = Size::where('name', 'like', '%' . $search . '%')->latest()->get();
        } else {
            $sizes = Size::latest()->get();
        }
        $data = [
            'sizes' => $sizes,
        ];
        return Response::Out("", "", $data, 200);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $size = new Size();
        $size->name = $request->name;
        $size->save();

        return Response::Out("success", "Size Created!", "", 200);
    }
    public function edit($id): JsonResponse
    {
        $size = Size::find($id);
        return Response::Out("", "", $size, 200);
    }
    public function update(UpdateRequest $request): JsonResponse
    {
        $size = Size::find($request->id);
        $size->name = $request->name;
        $size->update();

        return Response::Out("success", "Size Updated!", "", 200);
    }
    // then destroy function
    public function destroy($id): JsonResponse
    {
        $size = Size::find($id);
        $size->delete();

        return Response::Out("success", "Size Deleted!", "", 200);
    }
}
