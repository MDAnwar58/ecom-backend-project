<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Offer\StoreRequest;
use App\Http\Requests\Backend\Offer\UpdateRequest;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    // make some functions as like get, store, edit, update and delete
    // when go to this store and update functions then same process store column number
    public function get(Request $request)
    {
        $status = $request->status;
        $search = $request->search;
        if (isset($search) && isset($status)) {
            if ($status == "1") {
                $offers = Offer::where('name', 'like', '%' . $search . '%')
                    ->where('status', 'active')
                    ->latest()
                    ->with('brand', 'category', 'sub_category', 'product')
                    ->get();
            } else {
                $offers = Offer::where('name', 'like', '%' . $search . '%')
                    ->where('status', 'deactive')
                    ->latest()
                    ->with('brand', 'category', 'sub_category', 'product')
                    ->get();
            }
        } else if (isset($search)) {
            $offers = Offer::where('name', 'like', '%' . $search . '%')->latest()->with('brand', 'category', 'sub_category', 'product')->get();
        } else if (isset($status)) {
            if ($status == "1") {
                $offers = Offer::where('status', 'active')->latest()->with('brand', 'category', 'sub_category', 'product')->get();
            } else {
                $offers = Offer::where('status', 'deactive')->latest()->with('brand', 'category', 'sub_category', 'product')->get();
            }
        } else {
            $offers = Offer::latest()->with('brand', 'category', 'sub_category', 'product')->get();
        }
        $data = [
            'offers' => $offers,
        ];
        return Response::Out("", "", $data, 200);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $offer = new Offer();
        $offer->brand_id = $request->brand_id;
        $offer->category_id = $request->category_id;
        $offer->sub_category_id = $request->sub_category_id;
        $offer->product_id = $request->product_id;
        $offer->name = $request->name;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
        $offer->percents = $request->percents;
        if ($request->image_url) {
            $offer->image_url = $request->image_url;
        }
        $offer->save();

        return Response::Out("success", "Offer Created!", "", 200);
    }
    // status function for active and deactive
    public function status($id): JsonResponse
    {
        $offer = Offer::find($id);
        $offer->status = $offer->status === 'active' ? 'deactive' : 'active';
        $offer->update();

        $status = $offer->status === 'active' ? 'Active' : 'Deactive';
        return Response::Out("success", "This Offer Status " . $status, "", 200);
    }
    public function edit($id): JsonResponse
    {
        $offer = Offer::where('id', $id)->with('brand', 'category', 'sub_category', 'product')->first();
        return Response::Out("", "", $offer, 200);
    }
    public function update(UpdateRequest $request): JsonResponse
    {
        $offer = Offer::find($request->id);
        $offer->brand_id = $request->brand_id;
        $offer->category_id = $request->category_id;
        $offer->sub_category_id = $request->sub_category_id;
        $offer->product_id = $request->product_id;
        $offer->name = $request->name;
        $offer->percents = $request->percents;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
        if ($request->image_url) {
            $offer->image_url = $request->image_url;
        }
        $offer->update();

        return Response::Out("success", "Offer Updated!", "", 200);
    }
    public function destroy($id): JsonResponse
    {
        $offer = Offer::find($id);
        $offer->delete();

        return Response::Out("success", "Offer Deleted!", "", 200);
    }
}
