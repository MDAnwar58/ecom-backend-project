<?php

namespace App\Http\Controllers\Auth;

use App\Helper\JWTToken;
use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function signInPage(): View
    {
        return view('auth.sign-in');
    }
    function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:5',
        ]);

        $user = User::where('email', $request->email)->first();
        if (password_verify($request->password, $user->password)) {
            $token = JWTToken::createToken($user->id, $user->name, $user->email, 7);
            $data = [
                'token' => $token
            ];
            return Response::Out("sign in", "", $data, 200)->cookie('token', $token, 60 * 60 * 24 * 7);
            // return Response::Out("sign in", "", $data, 200);
        }
        return Response::Out("password_fail", "Passwords don't match!", "", 200);
    }
    function adminSignIn(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:5'
        ]);

        $user = User::where('email', $request->email)->first();
        if (password_verify($request->password, $user->password)) {
            $token = JWTToken::createToken($user->id, $user->name, $user->email, 7);
            return Response::Out("success", "", $token, 200);
        }

        return Response::Out("fail", "Password Don't Mass", "", 200);
    }
}
