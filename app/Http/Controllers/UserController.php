<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function redirectUser(Request $request) {

    	$token = explode(".", $request->cookie('Auth'));
        $user_role = json_decode(base64_decode($token[1]), true)['role'];

        if ($user_role == 3) {
        	return redirect('admin');
        }
        else if ($user_role == 2) {
        	return redirect('opop');
        }
        else if ($user_role == 1) {
        	return redirect('practic');
        }
        else {
        	return redirect('student');
        }
    }
}
