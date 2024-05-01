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

    	return view('practic', ['students' => $students_list, 'agreement' => $agreement_type, 'practics' => $practics, 'characteristics' => $characteristics, 'volumes' => $volumes, 'remarks' => $remarks, 'problems' => $problems]);
    }
}
