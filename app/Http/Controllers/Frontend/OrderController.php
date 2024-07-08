<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $id = $request->header('id');
        $user = User::find($id);
        return view('pages.order-place.order-place', compact('user'));
    }
}
