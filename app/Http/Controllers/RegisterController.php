<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\DTO\registerDTO;
use App\Models\User;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $userData = $request->createDTO();

        $user = User::create([
            'first_name' => $userData->f_name,
            'second_name' => $userData->s_name,
            'third_name' => $userData->t_name,
            'password' => bcrypt($userData->password),
            'login' => $userData->login
        ]);

        return redirect('/login');
    }
}
