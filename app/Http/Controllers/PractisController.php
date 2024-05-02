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


    public function addPractStudent(Request $request) {
    	$practic_id = $request->input('practic');
    	$student_id = $request->input('student');
    	$complete = $request->input('complete');
    	$mark = $request->input('mark');
    	$characteristics_list = $request->input('characteristics');
    	$volume_id = $request->input('volume');
    	$remarks_list = $request->input('remarks');
    	$problem_list = $request->input('problem');
    	$reason = $request->input('reason');

    	$new_pract_student = PractStudent::create([
    		'pract_id' => $practic_id,
	        'student_id' => $student_id,
	        'task_id' => null,
	        'volume_id' => $volume_id,
	        'mark' => $mark,
	        'reason_id' => $reason,
	        'complete' => ($complete == 'on') ? true : false,
    	]);

    	$file = $request->file('file');
		$handle = fopen($file, "r");
		// Получаем заголовки столбцов
		$headers = fgetcsv($handle, 1000, ",");
		if ($handle !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    // $data содержит массив значений строки CSV
		    // Создаем ассоциативный массив, используя заголовки столбцов
		    $row = array_combine($headers, $data);
		    // Делайте что-то с $row, например, добавляйте его в другой массив
		    $csvRows[] = $row;
		  }
		  fclose($handle);
		}
		// $csvRows теперь содержит все строки CSV в виде массива ассоциативных массивов
		foreach ($csvRows as $row) {
		  	$subject = $row['Subject'];
		  	$date = $row['Start date'];

		  	$date = str_replace(' ', '', $date);
			$date = str_replace('/', '', $date);

			$dateFormat = "dmY";
			$date = \DateTime::createFromFormat($dateFormat, $date);

		  	Task::create([
		  		'task' => $subject,
		  		'date' => $date->format('Y-m-d'),
		  		'pract_student_id' => $new_pract_student->id,
		  		'pract_id' => $practic_id
		  	]);
		}

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
