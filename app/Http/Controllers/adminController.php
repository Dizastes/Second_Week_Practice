<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\institute;
use App\Models\direction;
use App\Models\director;
use App\Models\User;

class adminController extends Controller
{

	public function getData()
	{
		$institutes = institute::all();
		$directiones = direction::all();
		$users = User::all();
		// dd($institutes);
		return view('admin',['institutes' => $institutes,'directiones'=>$directiones,'users'=>$users]);
	}
    

    public function createInstitute(Request $request) 
    {
    	$name = $request->input('name');
    	institute::create(['name'=> $name]);
    	return redirect('admin');
    }

    public function createDirection(Request $request)
    {
    	$name = $request->input('name');
    	$institute = $request->input('institute');
    	$code = $request->input('code');

    	direction::create(['name'=>$name,'institute_id'=>$institute ,'code'=>$code]);
    	return redirect('admin');
    }

    public function deleteDirection(Request $request) 
    {
    	$id = $request->input('direction');
    	$direction = direction::where('id',$id)->first();
    	if ($direction->director_id != null) { 
    		director::where('id',$direction->director_id)->delete();
    	}
    	$direction->delete();
    	return redirect('admin');
    }

    public function OPOP(Request $request)
    {
    	$user = $request->input('user');
    	$institute = $request->input('institute');
    	$direction = $request->input('direction');
  		$temp = direction::where('id',$direction)->where('institute_id',$institute)->first();
  		if($temp != null) {
  			if($temp->director_id != null) {
  				director::where('id',$temp->director_id)->delete();
  			}
  			$director = director::create(['user_id'=>$user]);
			$temp->setAttribute('director_id',$director->id)->save();
  
	    	User::where('id',$user)->first()->setAttribute('role',2)->save();
  		}

    	return redirect('admin');
    }

    public function getList() {
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
