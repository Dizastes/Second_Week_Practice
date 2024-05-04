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
		if (!$token = Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
			return view('login', ['mes' => 'Неверный логин или пароль']);
		}
		return $this->respondWithToken($token);
	}

	public function user()
	{
		return response()->json(Auth::user());
	}

	public function logout()
	{
		// Auth::logout();
		return redirect('/login')->withCookie(Cookie::forget('Auth'));
		// return $this->json(['message' => 'Successfuly logged out']);
	}

	public function refresh(Request $request)
	{
		return $this->respondWithToken(Auth::refresh());
	}

	protected function respondWithToken($token)
	{
		$minutes = \Config::get('jwt.ttl') * 24 * 7;
		Cookie::queue('Auth', $token, $minutes);
		
		return redirect('/');
	}

	public function me(Request $request)
	{
		$token = explode(".", $request->cookie('Auth'));
		$data = json_decode(base64_decode($token[1]), true);
		//$tkn = $request->cookie('Auth');
		return response()->json($data);
	}
}
