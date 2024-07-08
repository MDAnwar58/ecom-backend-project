<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public function forgetPasswordPage(): View
    {
        return view('auth.forget-password');
    }
    function forgotPasswordSend(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = rand(10000, 99999);

        try {
            Mail::to($user->email)->send(new OTPMail($user, $otp));
            $data = [
                'email' => $user->email
            ];
            return Response::Out("success", "Please Check Your Email - ", $data, 200);
        } catch (\Exception $e) {
            return Response::Out("fail", "Please Again Try!", "", 200);
        }
    }
    function emailOTPVerifyForgotPassword(Request $request)
    {
        return $request->all();
    }
}
