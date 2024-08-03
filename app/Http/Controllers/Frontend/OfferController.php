<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request): View
    {
        $id = $request->header('id');
        $user = User::find($id);
        return view('pages.offer.offer', compact('user'));
    }
    function get()
    {
        return Offer::select('id', 'name', 'image_url')->where('status', 'active')->latest()->get();
    }
    public function offerGet(Request $request)
    {
        return Offer::select('id', 'name', 'image_url')->where('status', 'active')->latest()->get();
    }
}
