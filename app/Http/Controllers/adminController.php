<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\institute;
use App\Models\direction;
use App\Models\director;
use App\Models\User;
use App\Http\Requests\InstituteRequest;
use App\Http\Requests\DirectionRequest;
use App\Http\Requests\DeleteDirectionRequest;
use App\Http\Requests\OPOPRequest;

class adminController extends Controller
{

	public function getData(Request $request)
	{
		$token = explode(".", $request->cookie('Auth'));
        $user_role = json_decode(base64_decode($token[1]), true)['role'];
        if ($user_role != 3) {
        	return redirect('/');
        }

		$institutes = institute::all();
		$directiones = direction::all();
		$users = User::all();
		// dd($institutes);
		return view('admin', ['institutes' => $institutes, 'directiones' => $directiones, 'users' => $users]);
	}


	public function createInstitute(InstituteRequest $request)
	{
		$name = $request->input('name');
		institute::create(['name' => $name]);
		return redirect('admin');
	}

	public function createDirection(DirectionRequest $request)
	{
		$name = $request->input('name');
		$institute = $request->input('institute');
		$code = $request->input('code');

		direction::create(['name' => $name, 'institute_id' => $institute, 'code' => $code]);
		return redirect('admin');
	}

	public function deleteDirection(DeleteDirectionRequest $request)
	{
		$id = $request->input('direction');
		$direction = direction::where('id', $id)->first();
		if ($direction->director_id != null) {
			director::where('id', $direction->director_id)->delete();
		}
		$direction->delete();
		return redirect('admin');
	}

	public function OPOP(OPOPRequest $request)
	{
		$user = $request->input('user');
		$institute = $request->input('institute');
		$direction = $request->input('direction');
		$post = $request->input('post');
		$temp = direction::where('id', $direction)->where('institute_id', $institute)->first();
		if ($temp != null) {
			if ($temp->director_id != null) {
				$dir = director::where('id', $temp->director_id)->first();
				if ($dir !== null) {
					User::where('id', $dir->user_id)->first()->setAttribute('role', 0)->save();
					$dir->delete();
				}
			}
			$director = director::create(['user_id' => $user, 'post' => $post]);
			$temp->setAttribute('director_id', $director->id)->save();

			User::where('id', $user)->first()->setAttribute('role', 2)->save();
		}

		return redirect('admin');
	}

	public function getList()
	{
		$institute_list = institute::all();
		$result = [];

		foreach ($institute_list as $key => $institute) {
			$institute_id = $institute->id;
			$direction_list = direction::where('institute_id', $institute_id)->get();
			// dd($direction_list);
			$result[$key][$institute->name] = $direction_list;
		}

		return view('actualTable', ['info' => $result]);
	}
}
