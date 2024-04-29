<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
	// public function __construct()
	// {
	// 	$this->middleware('auth.api')->except('login');
	// }

    public function login(LoginRequest $request)
    {
    	// $userData = $request->only(['login', 'password']);
    	if(!$token = Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
    		return response()->json(['error' => 'Unauthorized'], 401);
    	}
    	return $this->respondWithToken($token);
    }

    public function user()
    {
    	return response()-> json(Auth::user());
    }

    public function logout()
    {
    	// Auth::logout();
        return redirect('/')->withCookie(Cookie::forget('Auth'));
    	// return $this->json(['message' => 'Successfuly logged out']);
    }

    public function refresh()
    {
    	return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token) {
		$minutes = \Config::get('jwt.ttl') * 24 * 7;
		Cookie::queue('Auth', $token, $minutes);
    	return response()->json([
    		'access_token' => $token,
    		'type' => 'Bearer',
    		'expires_in' => \Config::get('jwt.ttl') 
    	]);
    }

    public function me(Request $request) {
    	$token = explode(".", $request->cookie('Auth'));
    	$data = json_decode(base64_decode($token[1]), true);
		//$tkn = $request->cookie('Auth');
    	return response()->json($data);
    }
}
