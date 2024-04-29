<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\DTO\registerDTO;
use App\Models\User;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request) {

    	$userData = $request->createDTO();

    	$user = User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'password' => bcrypt($userData->password),
            'login' => $userData->login,
        ]);

        return response()->json($user, Response::HTTP_CREATED);
    }
}
