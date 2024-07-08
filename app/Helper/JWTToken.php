<?php
namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    static public function createToken($user_id, $user_name, $user_email, $expriy_days)
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'organichatt',
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24 * $expriy_days,
            'userId' => $user_id,
            'userName' => $user_name,
            'userEmail' => $user_email,
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
    static public function ReadToken($token)
    {
        try {
            if ($token == null) {
                return "unauthorized";
            } else {
                $key = env('JWT_KEY');
                return JWT::decode($token, new Key($key, 'HS256'));
            }
        } catch (\Throwable $th) {
            return "unauthorized";
        }
    }
}