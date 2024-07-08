<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignOutController extends Controller
{
    public function signOut()
    {
        return redirect()->route('sign.in')->cookie("token", null, -1);
    }
}
