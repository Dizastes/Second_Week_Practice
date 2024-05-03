<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\direction;
use App\Models\PractStudent;
use App\Models\Practic;
use App\Models\Task;

class StudentController extends Controller
{
	public function getData(Request $request)
	{

		$token = explode(".", $request->cookie('Auth'));
		$user_id = json_decode(base64_decode($token[1]), true)['id'];
        $user_role = json_decode(base64_decode($token[1]), true)['role'];
        if ($user_role != 0) {
        	return redirect('/');
        }

		$student = Student::where('user_id', $user_id)->get();
		$group_id = $student[0]->group_id;

		$user = User::where('id', $user_id)->get();
		$group = StudentGroup::where('id', $group_id)->get();

		$direction_id = $group[0]->direction_id;
		$direction = direction::where('id', $direction_id)->get();

		$student_practics = PractStudent::where('student_id', $student[0]->id)->get();
		$practics = [];
		foreach ($student_practics as $student_practic) {
			$pract_id = $student_practic->pract_id;
			$practics[] = Practic::where('id', $pract_id)->get()[0];
		}

		return view('student', ['user' => $user, 'group' => $group, 'direction' => $direction, 'practics' => $practics, 'students' => $student_practics]);
	}

	public function uploadFile(Request $request)
	{

		$token = explode(".", $request->cookie('Auth'));
		$user_id = json_decode(base64_decode($token[1]), true)['id'];
		$practic_id = $request->input('pract');
		$student_id = Student::where('user_id', $user_id)->get()[0]->id;
		$pract_student = PractStudent::where('pract_id', $practic_id)->where('student_id', $student_id)->get()[0];

		Task::where('pract_student_id', $pract_student->id)->where('pract_id', $practic_id)->delete();

		$file = $request->file('file');
		$handle = fopen($file->path(), "r");
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
				'pract_student_id' => $pract_student->id,
				'pract_id' => $practic_id
			]);
		}
		return redirect()->route('student');
	}
}
