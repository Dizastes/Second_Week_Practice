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

class confirmWord extends Controller
{
    public function getData(Request $request)
    {
        $token = explode(".", $request->cookie('Auth'));
        $user_role = json_decode(base64_decode($token[1]), true)['role'];

        $students_pract = PractStudent::all();
        $students = [];
        $prcticsName = [];
        foreach ($students_pract as $item) {
            $temp = Student::where('id', $item->student_id)->get();
            foreach ($temp as $student) {
                array_push($students, User::where('id', $student->user_id)->get());
            }
            array_push($prcticsName, Practic::where('id', $item->pract_id)->get());
        }
        return view('confirmWord', ['students_pract' => $students_pract, 'students' => $students, 'prcticsName' => $prcticsName, 'user_role' => $user_role]);
    }

    public function confirmDoc(Request $request)
    {
        $button = $request->confirm;
        if ($button == "Подтвердить") {
            if (PractStudent::where('id', $request->input('id'))->get()[0]->status == "Ожидает подтверждения") {
                PractStudent::where('id', $request->input('id'))->update(['status' => "Подтверждено"]);
            } else {
                PractStudent::where('id', $request->input('id'))->update(['status' => "Ожидает подтверждения"]);
            }
        } elseif ($button == "Отказать") {
            PractStudent::where('id', $request->input('id'))->update(['status' => "Отказано"]);
        } elseif ($button == "Запросить") {
            PractStudent::where('id', $request->input('pract_id'))->update(['status' => "Ожидает проверки"]);
            return redirect('student');
        }
        return redirect('confirmWord');
    }
}
