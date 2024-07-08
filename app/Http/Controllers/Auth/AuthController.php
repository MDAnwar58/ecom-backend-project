<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\JWTToken;
use App\Helper\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function authCheck(Request $request)
    {
        $find_token_info = JWTToken::ReadToken($request->token);
        $user = User::where('email', $find_token_info->userEmail)->first();
        return Response::Out("", "", $user, 200);
    }
}
