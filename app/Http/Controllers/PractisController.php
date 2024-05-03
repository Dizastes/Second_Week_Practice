<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\AgreementType;
use App\Models\Practic;
use App\Models\Characteristics;
use App\Models\Volume;
use App\Models\Remarks;
use App\Models\Problem;
use App\Models\PractStudent;
use App\Models\Agreement;
use App\Models\Reason;
use App\Models\PractCharacteristic;
use App\Models\PractRemark;
use App\Models\PractProblem;
use App\Models\Task;

class PractisController extends Controller
{
	public function getData(Request $request)
	{
		$students = Student::all();
		$students_list = [];

		foreach ($students as $value) {
			$uid = $value->user_id;

			$student = User::where('id', $uid)->get();
			$students_list[] = $student;
		}

		$practics = Practic::all();

		$characteristics = Characteristics::all();

		$volumes = Volume::all();

		$remarks = Remarks::all();

		$problems = Problem::all();

		$reasons = Reason::all();

		return view('practic', ['students' => $students_list, 'practics' => $practics, 'characteristics' => $characteristics, 'volumes' => $volumes, 'remarks' => $remarks, 'problems' => $problems, 'reasons' => $reasons]);
	}


	public function addPractStudent(Request $request)
	{
		$practic_id = $request->input('practic');
		$user_id = $request->input('student');
		$student_id = Student::where('user_id', $user_id)->get()[0];
		$complete = $request->input('complete');
		$mark = $request->input('mark');
		$characteristics_list = $request->input('characteristics');
		$volume_id = $request->input('volume');
		$remarks_list = $request->input('remarks');
		$problem_list = $request->input('problem');
		$reason = $request->input('reason');

		$pract_student = PractStudent::where('pract_id', $practic_id)->where('student_id', $student_id->id)->get()[0];
		
		$pract_student->volume_id = $volume_id;
		$pract_student->mark = $mark;
		$pract_student->complete = ($complete == 'on') ? true : false;
		$pract_student->reason_id = $reason;
		$pract_student->save();

		PractCharacteristic::where('pract_id', $pract_student->id)->delete();
		foreach ($characteristics_list as $charact) {
			PractCharacteristic::create([
				'pract_id' => $pract_student->id,
				'characteristic_id' => $charact
			]);
		}

		PractRemark::where('pract_id', $pract_student->id)->delete();
		foreach ($remarks_list as $remark) {
			PractRemark::create([
				'pract_id' => $pract_student->id,
				'remark_id' => $remark
			]);
		}

		PractProblem::where('pract_id', $pract_student->id)->delete();
		foreach ($problem_list as $problem) {
			PractProblem::create([
				'pract_id' => $pract_student->id,
				'problem_id' => $problem
			]);
		}

		return redirect('practic');
	}
}
