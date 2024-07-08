<?php

namespace App\Http\Controllers\Auth;

use App\Helper\JWTToken;
use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function signUpPage(): View
    {
        return view('auth.sign-up');
    }
    function signUp(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|ends_with:gmail.com',
            // 'phone_number' => 'nullable',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|min:5|same:password',
        ]);

        if ($request->email !== null) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $token = JWTToken::createToken($user->id, $user->name, $user->email, 7);
            $data = [
                'token' => $token,
            ];
            // return Response::Out('success', 'Your Account Created With Email', "", 200)->cookie('token', $token, 60 * 60 * 240);
            return Response::Out('success', 'Your Account Created With Email', $data, 200);
        } else {
            if ($request->phone_number !== null) {
                $request->validate([
                    'phone_number' => 'required|unique:users,phone_number|min:11|max:11',
                ]);

                $user = new User();
                $user->name = $request->name;
                $user->phone_number = $request->phone_number;
                $user->password = bcrypt($request->password);
                $user->save();

                return Response::Out('success', 'Your Account Created With Phone Number', "", 200);
            } else {
                return Response::Out('success', 'Something Wrong', "", 200);
            }
        }
    }
}
