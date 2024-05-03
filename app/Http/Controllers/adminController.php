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
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\PractGroup;
use App\Models\Task;
use App\Models\PractCharacteristic;
use App\Models\PractProblem;
use App\Models\PractRemark;
use App\Models\PractStudent;



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

		$students = Student::all();
		$directors = director::all();
		$students_id = [];
		$directors_id = [];

		$users = [];
		$usersTemp = User::all();
		foreach ($students as $student) {
			array_push($students_id, $student->user_id);
		}
		foreach ($directors as $director) {
			array_push($directors_id, $director->user_id);
		}
		foreach ($usersTemp as $user) { {
				if (!in_array($user->id, $students_id) and  ($user->role == 0 or $user->role == 2)) {
					array_push($users, $user);
				}
			}
		}
		return view('admin', ['institutes' => $institutes, 'directiones' => $directiones, 'users' => $users, 'user_role' => $this->getRole($request)]);
	}

	public function getDirection($institute_id)
	{
		$directionsTemp = direction::where('institute_id', $institute_id)->get();
		$directions = [];
		foreach ($directionsTemp as $temp) {
			array_push($directions, ['value' => $temp->id, 'text' => $temp->name]);
		}
		return $directions;
	}


	public function getRole($request)
	{
		$token = explode(".", $request->cookie('Auth'));
		$user_role = json_decode(base64_decode($token[1]), true)['role'];
		return $user_role;
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
			$studentGroups = Student::where('director_id', $direction->director_id)->get();
			foreach ($studentGroups as $studentGroup) {
				$group_id = $studentGroup->id;
				PractGroup::where('group_id', $group_id)->delete();
				StudentGroup::where('id', $group_id)->delete();

				$students = Student::where('group_id', $group_id)->get();
				foreach ($students as $student) {
					$pract_student = PractStudent::where('student_id', $student->id)->get();
					foreach ($pract_student as $t) {
						Task::where('pract_student_id', $t->id)->delete();
						PractRemark::where('pract_id', $t->id)->delete();
						PractProblem::where('pract_id', $t->id)->delete();
						PractCharacteristic::where('pract_id', $t->id)->delete();
						$t->delete();
					}
					$student->delete();
				}
			}
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
					$count = director::where('user_id', $dir->user_id)->count();
					if ($count == 1) {
						User::where('id', $dir->user_id)->first()->setAttribute('role', 0)->save();
					}
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
