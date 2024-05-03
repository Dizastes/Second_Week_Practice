<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\institute;
use App\Models\direction;
use App\Models\director;
use App\Models\User;
use App\Models\StudentGroup;
use App\Models\Student;
use App\Models\Type;
use App\Models\View;
use PhpOffice\PhpWord\PhpWord;
use App\Models\Place;
use App\Models\PractStudent;
use App\Models\PractCharacteristic;
use App\Models\Characteristics;
use App\Models\Volume;
use App\Models\Problem;
use App\Models\Task;
use App\Models\PractProblem;
use App\Models\Remarks;
use App\Models\Practic;
use App\Models\Order;
use App\Models\Reason;
use App\Models\PractRemark;
use function morphos\Russian\inflectName;
use morphos\Russian\GeographicalNamesInflection;
use PHPUnit\Framework\Attributes\Group;

class generateController extends Controller
{
    public function getData($id, $pract_id)
    {

        $user = User::where('id', $id)->first();
        $student = Student::where('user_id', $id)->first();
        $practStudent = PractStudent::where('student_id', $student->id)->where('pract_id', $pract_id)->latest()->first();
        $pract = Practic::where('id', $pract_id)->first();
        $place = Place::where('id', $pract->place_id)->first();
        $group_id = $student->group_id;
        $group = StudentGroup::where('id', $group_id)->first();

        $or_id = $pract->director_or_id;
        $or = director::where('id', $or_id)->first();
        $or_user = User::where('id', $or->user_id)->first();
        $ugu_id = $pract->director_ugu_id;
        $ugu = director::where('id', $ugu_id)->first();
        $ugu_user = User::where('id', $ugu->user_id)->first();

        $direction = direction::where('id', $group->direction_id)->first();
        $institute = institute::where('id', $direction->institute_id)->first();

        $date_begin = explode('-', $pract->date_begin);
        $date_end = explode('-', $pract->date_end);
        $characteristic = '';
        $char = '';
        $howtocomplet = Volume::where('id', $practStudent->volume_id)->first()->volume;

        $tasks = [];
        $tasksTemp = explode(',', $practStudent->tasks);
        foreach ($tasksTemp as $task) {
            array_push($tasks, ['item'=>$task]);
        }

        $characteristicId = PractCharacteristic::where('pract_id', $practStudent->id)->get();
        foreach ($characteristicId as $temp) {
            $tmp = Characteristics::where('id', $temp->characteristic_id)->first()->charact;

            if ($characteristic == '') {
                $characteristic = $tmp;
            } else {
                $characteristic .= ', ' . $tmp;
            }
        }

        $charId = PractProblem::where('pract_id', $practStudent->id)->get();
        foreach ($charId as $temp) {
            $tmp = Problem::where('id', $temp->problem_id)->first()->charact;

            if ($char == '') {
                $char = $tmp;
                $char .= ', ' . $tmp;
            }
        }

        $errors = [];
        $errorsId = PractRemark::where('pract_id', $practStudent->id)->get();
        foreach ($errorsId as $error) {
            array_push($errors, ['item' => Remarks::where('id', $error->remark_id)->first()->remarks]);
        }
        $values = [];
        $valuesTemp = Task::where('pract_student_id', $practStudent->id)->get();
        foreach ($valuesTemp as $value) {
            $t = explode('-', $value->date);
            array_push($values, ['date' => $t[2] . '.' . $t[1] . '.' . $t[0], 'userWork' => $value->task]);
        }

        $info['fullName'] = $user->second_name . ' ' .  $user->first_name . ' ' . $user->third_name;
        $info['course'] = $group->course;
        $info['group'] = $group->name;
        $info['orCutName'] = $or_user->second_name . ' ' .  mb_substr($or_user->first_name, 0, 1, 'UTF-8') . '.' . mb_substr($or_user->third_name, 0, 1, 'UTF-8') . '.';
        $info['orPost'] = $or->post;
        $info['UguCutName'] = $ugu_user->second_name . ' ' .  mb_substr($ugu_user->first_name, 0, 1, 'UTF-8') . '.' . mb_substr($ugu_user->third_name, 0, 1, 'UTF-8') . '.';
        $info['UguPost'] = $ugu->post;
        $info['year'] = $pract->year;
        $info['institute'] = $institute->name;
        $info['practiceName'] = $place->name;
        $info['date_begin'] = $date_begin[2] . '.' . $date_begin[1] . '.' . $date_begin[0];
        $info['date_end'] = $date_end[2] . '.' . $date_end[1] . '.' . $date_end[0];
        $info['CutName'] = $user->second_name . ' ' .  mb_substr($user->first_name, 0, 1, 'UTF-8') . '.' . mb_substr($user->third_name, 0, 1, 'UTF-8') . '.';
        $info['direction'] = $direction->name;
        $info['namePractice'] = $pract->name;
        $info['practiceAddress'] = $place->address;
        $info['character'] = $characteristic;
        $info['char'] = $char;
        $info['howtocomplet'] = $howtocomplet;
        $info['marks'] = $practStudent->mark;
        $info['errors'] = $errors;
        $info['tasks'] = $tasks;
        $info['values'] = $values;
        $info['fullNameR'] = inflectName($info['fullName'], 'родительный');
        $info['fullNameD'] = inflectName($info['fullName'], 'дательный');
        $info['namePracticeV'] = inflectName($info['namePractice'], 'дательный');
        $info['practiceNameR'] = GeographicalNamesInflection::getCase($info['namePractice'], 'предложный');
        return $info;
    }

    public function getDataForSecondWord($pract_id, $group_id)
    {
        $pract = Practic::where('id', $pract_id)->first();
        $group = StudentGroup::where('id', $group_id)->first();
        $direction = direction::where('id', $group->direction_id)->first();
        $institute = institute::where('id', $direction->institute_id)->first();
        $place = Place::where('id', $pract->place_id)->first();
        $date_begin = explode('-', $pract->date_begin);
        $date_end = explode('-', $pract->date_end);
        $order = Order::where('id', $pract->order_id)->first();
        $order_date = explode('-', $order->date);
        $pract_student_complete = PractStudent::where('pract_id', $pract_id)->where('complete', 1)->get();

        $pract_student_uncomplete = PractStudent::where('pract_id', $pract_id)->where('complete', 0)->get();
        $or_id = $pract->director_or_id;
        $or = director::where('id', $or_id)->first();
        $or_user = User::where('id', $or->user_id)->first();
        $orCutName = $or_user->second_name . ' ' .  mb_substr($or_user->first_name, 0, 1, 'UTF-8') . '.' . mb_substr($or_user->third_name, 0, 1, 'UTF-8') . '.';

        $opop_id = $direction->director_id;
        $opop = director::where('id', $opop_id)->first();
        $opop_user = User::where('id', $opop->user_id)->first();
        $opopCutName = $opop_user->second_name . ' ' .  mb_substr($opop_user->first_name, 0, 1, 'UTF-8') . '.' . mb_substr($opop_user->third_name, 0, 1, 'UTF-8') . '.';



        $info['institute'] = $institute->name;
        $info['PracticView'] = View::where('id', $pract->view_id)->first()->name;
        $info['PracticType'] = Type::where('id', $pract->type_id)->first()->name;
        $info['yearOld'] = $pract->year - 1;
        $info['year'] = $pract->year;
        $info['GroupCode'] = $direction->code;
        $info['SpecialName'] = $direction->name;
        $info['Course'] = $group->course;
        $info['Group'] = $group->name;
        $info['City'] = $place->city;
        $info['date_begin'] = $date_begin[2] . '.' . $date_begin[1] . '.' . $date_begin[0];
        $info['date_end'] = $date_end[2] . '.' . $date_end[1] . '.' . $date_end[0];
        $info['NumberOrder'] = $order->number;
        $info['OrderDate'] = $order_date[2] . '.' . $order_date[1] . '.' . $order_date[0];
        $info['CountComplete'] = count($pract_student_complete);
        $info['CountunComplete'] = count($pract_student_uncomplete) == null ? '0 ' : count($pract_student_uncomplete);
        $info['completeStudents'] = [];
        $count = 1;
        foreach ($pract_student_complete as $t) {
            $student = Student::where('id', $t->student_id)->first();
            $user = User::where('id', $student->user_id)->first();
            $fullname = $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name;
            array_push($info['completeStudents'], [
                'count' => $count, 'fullname' => $fullname, 'place' => $place->name, 'city' => $place->city, 'contractType' => '-',
                'money' => '-', 'orCutName' => $orCutName
            ]);
            $count++;
        }
        $info['uncompleteStudents'] = [];
        $count = 1;
        if ($info["CountunComplete"] == 0) {
            array_push($info['uncompleteStudents'], ['Uncount' => 1, 'fullname' => " ", 'resonce' => " "]);
        } else {
            foreach ($pract_student_uncomplete as $tmp) {
                $student = Student::where('id', $tmp->student_id)->first();
                $user = User::where('id', $student->user_id)->first();
                $fullname = $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name;
                $reason = Reason::where('id', $tmp->reason_id)->first()->name;
                array_push($info['uncompleteStudents'], ['Uncount' => $count, 'fullname' => $fullname, 'resonce' => $reason]);
                $count++;
            }
        }
        $info['orCutName'] = $orCutName;
        $info['opopCutName'] = $opopCutName;

        return $info;
    }

    public function getWord(Request $request)
    {
        $token = explode(".", $request->cookie('Auth'));
        $id = 0;
        if ($request->getMethod() == "GET") {
            $id = json_decode(base64_decode($token[1]), true)['id'];
        } else {
            $id = $request->input('student_id');
        }
        $pract_id = $request->input('pract_id');
        $info = $this->getData($id, $pract_id);
        $document = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('word\document.docx'));
        $phpWord = new PhpWord();
        $uploadDir = __DIR__;
        $output = $info['CutName'] . '.docx';
        foreach ($info as $key => $value) {
            if ($key == 'errors' || $key == 'values' || $key == 'tasks') continue;
            else {
                $document->setValue($key, strval($value));
            }
        }

        $document->cloneRowAndSetValues('date', $info['values']);
        $document->cloneBlock('blocked', 0, true, false, $info['tasks']);
        $document->cloneBlock('errors', 0, true, false, $info['errors']);
        $document->saveAs(storage_path($output));
        return response()->download(storage_path($output))->deleteFileAfterSend(true);
    }

    public function getGroupWord(Request $request)
    {
        $pract_id = $request->input('pract_id');
        $group_id = $request->input('group_id');
        $infoWord = $this->getDataForSecondWord(6, 3);
        $document = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('word\group.docx'));
        $phpWord = new PhpWord();
        $uploadDir = __DIR__;
        $output = $infoWord['Group'] . '.docx';
        foreach ($infoWord as $key => $value) {
            if ($key == "completeStudents" || $key == "uncompleteStudents") {
                continue;
            } else {
                $document->setValue($key, strval($value));
            }
        }
        $document->cloneRowAndSetValues('count', $infoWord['completeStudents']);
        $document->cloneRowAndSetValues('Uncount', $infoWord['uncompleteStudents']);
        $document->saveAs(storage_path($output));
        return response()->download(storage_path($output))->deleteFileAfterSend(true);
    }
}
