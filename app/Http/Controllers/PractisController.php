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

    	$agreement_type = AgreementType::all();

    	$practics = Practic::all();

    	$characteristics = Characteristics::all();

    	$volumes = Volume::all();

    	$remarks = Remarks::all();

    	$problems = Problem::all();

    	$reasons = Reason::all();

    	return view('practic', ['students' => $students_list, 'agreement' => $agreement_type, 'practics' => $practics, 'characteristics' => $characteristics, 'volumes' => $volumes, 'remarks' => $remarks, 'problems' => $problems, 'reasons' => $reasons]);
    }


    public function addPractStudent(Request $request) {
    	$practic_id = $request->input('practic');
    	$student_id = $request->input('student');
    	$agreement_id = $request->input('agreement');
    	$money = $request->input('money');
    	$complete = $request->input('complete');
    	$mark = $request->input('mark');
    	$characteristics_list = $request->input('characteristics');
    	$volume_id = $request->input('volume');
    	$remarks_list = $request->input('remarks');
    	$problem_list = $request->input('problem');
    	$reason = $request->input('reason');

    	$new_agreement = Agreement::create([
    		'type_id' => $agreement_id
    	]);

    	$new_pract_student = PractStudent::create([
    		'pract_id' => $practic_id,
	        'student_id' => $student_id,
	        'agreement_id' => $new_agreement->id,
	        'task_id' => null,
	        'volume_id' => $volume_id,
	        'mark' => $mark,
	        'money' => ($money == 'on') ? true : false,
	        'reason_id' => $reason,
	        'complete' => ($complete == 'on') ? true : false,
    	]);

    	foreach ($characteristics_list as $charact) {
    		PractCharacteristic::create([
    			'pract_id' => $new_pract_student->id,
    			'characteristic_id' => $charact
    		]);
    	}

    	foreach ($remarks_list as $remark) {
    		PractRemark::create([
    			'pract_id' => $new_pract_student->id,
    			'remark_id' => $remark
    		]);
    	}

    	foreach ($problem_list as $problem) {
    		PractProblem::create([
    			'pract_id' => $new_pract_student->id,
    			'problem_id' => $problem
    		]);
    	}
    }
}
