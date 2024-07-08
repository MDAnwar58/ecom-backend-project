<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $find_user_token = JWTToken::ReadToken($token);
        if ($find_user_token === "unauthorized") {
            return redirect('/sign-in');
        } else {
            $request->headers->set('email', $find_user_token->userEmail);
            $request->headers->set('id', $find_user_token->userId);
            return $next($request);
        }
    }
}
