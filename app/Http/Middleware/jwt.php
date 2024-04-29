<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;


class jwt
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = explode(".", $request->cookie('Auth'));
        if (count($token) < 3)
            return redirect()->route('login');
    	$data = json_decode(base64_decode($token[1]), true);

        $expirationTime = $data['exp'];

        $currentTimestamp = time(); 

        if ($currentTimestamp >= $expirationTime) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
