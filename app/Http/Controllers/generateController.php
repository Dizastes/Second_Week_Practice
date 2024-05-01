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
use App\Models\PractRemark;
use function morphos\Russian\inflectName;
use morphos\Russian\GeographicalNamesInflection;

class generateController extends Controller
{
    public function getData($id)
    {

        $user = User::where('id', $id)->first();
        $student = Student::where('user_id', $id)->first();
        $practStudent = PractStudent::where('student_id', $student->id)->latest()->first();
        $pract_id = $practStudent->pract_id;
        $pract = Practic::where('id', $pract_id)->first();
        $place = Place::where('id', $pract->place_id)->first();
        $group_id = $student->group_id;
        $group = StudentGroup::where('id', $group_id)->first();

        $or_id = $pract->director_or_id;
        $or = director::where('user_id', $or_id)->first();
        $or_user = User::where('id', $or->user_id)->first();
        $ugu_id = $pract->director_ugu_id;
        $ugu = director::where('user_id', $ugu_id)->first();
        $ugu_user = User::where('id', $ugu->user_id)->first();

        $direction = direction::where('id', $group->direction_id)->first();
        $institute = institute::where('id', $direction->institute_id)->first();

        $date_begin = explode('-', $pract->date_begin);
        $date_end = explode('-', $pract->date_begin);
        $characteristic = '';
        $char = '';
        $howtocomplet = Volume::where('id', $practStudent->volume_id)->first()->volume;

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
        $info['tasks'] = $errors;
        $info['values'] = $values;
        $info['fullNameR'] = inflectName($info['fullName'], 'родительный');
        $info['fullNameD'] = inflectName($info['fullName'], 'дательный');
        $info['namePracticeV'] = inflectName($info['namePractice'], 'дательный');
        $info['practiceNameR'] = GeographicalNamesInflection::getCase($info['namePractice'], 'предложный');
        return $info;
    }

    public function getWord(Request $request)
    {
        // $token = explode(".", $request->cookie('Auth'));
        // $id = json_decode(base64_decode($token[1]), true)['id'];
        $info = $this->getData(1);
        $document = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('word\document.docx'));
        $phpWord = new PhpWord();
        $uploadDir = __DIR__;
        $output = 'Отчёт.docx';
        foreach ($info as $key => $value) {
            if ($key == 'errors' || $key == 'values' || $key == 'tasks') continue;
            else {
                $document->setValue($key, strval($value));
            }
        }

        $document->cloneRowAndSetValues('date', $info['values']);
        $document->cloneBlock('blocked', 0, true, false, $info['errors']);
        $document->cloneBlock('errors', 0, true, false, $info['errors']);
        $document->saveAs(storage_path($output));
        return response()->download(storage_path($output));
    }
}
