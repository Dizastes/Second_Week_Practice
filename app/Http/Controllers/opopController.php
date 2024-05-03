<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\institute;
use App\Models\direction;
use App\Models\director;
use App\Models\User;
use App\Models\StudentGroup;
use App\Models\AgreementType;
use App\Models\Student;
use App\Models\Type;
use App\Models\View;
use App\Models\Place;
use App\Models\Practic;
use App\Models\PractGroup;
use App\Models\Order;
use App\Models\Task;
use App\Models\Agreement;
use App\Models\PractCharacteristic;
use App\Models\PractProblem;
use App\Models\PractRemark;
use App\Models\PractStudent;
use Illuminate\Support\Arr;
use App\Http\Requests\AddDirectorRequest;
use App\Http\Requests\PractRequest;
use App\Http\Requests\CreatePractRequest;
use App\Http\Requests\ChangePractRequest;

class opopController extends Controller
{
    public function getData(Request $request)
    {
        $token = explode(".", $request->cookie('Auth'));
        $user_role = json_decode(base64_decode($token[1]), true)['role'];
        if ($user_role != 2) {
            return redirect('/');
        }

        $practicsTemp = Practic::all();
        $practics = [];
        foreach ($practicsTemp as $temp) {
            $t = Order::where('id', $temp->order_id)->get()->first();
            array_push($practics, ['id' => $temp->id, 'order' => $t->number]);
        }


        $directiones = direction::all();
        $groups = StudentGroup::all();
        $usersTemp = User::all();
        $students = Student::all();
        $agreement_type = AgreementType::all();
        $directors = director::all();
        $types = Type::all();
        $views = View::all();
        $users = [];
        $students_id = [];
        $directors_id = [];

        foreach ($students as $student) {
            array_push($students_id, $student->user_id);
        }
        foreach ($directors as $director) {
            array_push($directors_id, $director->user_id);
        }
        foreach ($usersTemp as $user) {
            if (!in_array($user->id, $students_id) and !in_array($user->id, $directors_id)) {
                array_push($users, $user);
            }
        }

        $pract_id = $request->session()->pull('pract_id');
        $download = $request->session()->pull('download');
        $group_id = $request->session()->pull('group_id');

        return view('opop', ['pract_id' => $pract_id, 'group_id' => $group_id, 'download' => $download, 'practics' => $practics, 'agreement' => $agreement_type, 'types' => $types, 'views' => $views, 'directiones' => $directiones, 'groups' => $groups, 'users' => $users, 'user_role' => $this->getRole($request)]);
    }

    public function getDataForWord(Request $request)
    {
        $pract_id = $request->input('pract_id');
        $group_id = $request->input('group_id');

        $countStudents = Student::where('group_id', $group_id)->count();
        $studentsWord = Student::where('group_id', $group_id)->get();
        $countWord = 0;
        foreach ($studentsWord as $t) {
            $pract_studentWord = PractStudent::where('student_id', $t->id)->where('pract_id', $pract_id)->first();
            if ($pract_studentWord != null) {
                if ($pract_studentWord->complete != null) {
                    $countWord++;
                }
            }
        }
        $download = false;
        if ($countWord == $countStudents and $countWord != 0) {
            $download = true;
        }

        session()->put('download', $download);
        session()->put('pract_id', $pract_id);
        session()->put('group_id', $group_id);

        return  redirect('opop');
    }

    public function getRole($request)
    {
        $token = explode(".", $request->cookie('Auth'));
        $user_role = json_decode(base64_decode($token[1]), true)['role'];
        return $user_role;
    }

    public function getGroups($practiceId)
    {
        $groups = PractGroup::where('pract_id', $practiceId)->get();

        $data = [];

        foreach ($groups as $group) {
            $group = StudentGroup::where('id', $group->group_id)->first();
            array_push($data, ['value' => $group->id, 'text' => $group->name]);
        }

        return response()->json($data);
    }

    public function getDataForGroup(Request $request)
    {
        $token = explode(".", $request->cookie('Auth'));
        $user_role = json_decode(base64_decode($token[1]), true)['role'];
        if ($user_role != 2) {
            return redirect('/');
        }
        
        $directiones = direction::all();
        $groups = StudentGroup::all();
        $usersTemp = User::all();
        $students = Student::all();
        $directors = director::all();
        $users = [];
        $students_id = [];
        $directors_id = [];

        foreach ($students as $student) {
            array_push($students_id, $student->user_id);
        }
        foreach ($directors as $director) {
            array_push($directors_id, $director->user_id);
        }
        foreach ($usersTemp as $user) {
            if (!in_array($user->id, $students_id) and !in_array($user->id, $directors_id)) {
                array_push($users, $user);
            }
        }

        return view('groups', ['directiones' => $directiones, 'groups' => $groups, 'users' => $users, 'user_role' => $this->getRole($request)]);
    }

    public function getDataForChangePract(PractRequest $request)
    {
        $pract_id = $request->input('pract');

        $pract = Practic::where('id', $pract_id)->first();

        $selected['name'] = $pract->name;
        $selected['type'] = $pract->type_id;
        $selected['view'] = $pract->view_id;
        $selected['year'] = $pract->year;
        $selected['begin'] = $pract->date_begin;
        $selected['end'] = $pract->date_end;
        $selected['money'] = $pract->money;
        $selected['agreement'] = Agreement::where('id', $pract->agreement_id)->first()->type_id;
        $order = Order::where('pract_id', $pract_id)->first();
        $selected['order_number'] = $order->number;
        $selected['date'] = $order->date;
        $selected['groups'] = [];
        $place = Place::where('id', $pract->place_id)->first();
        if (!isset($place->name)) {
            $selected['n'] = '';
            $selected['city'] = '';
            $selected['address'] = '';
            $selected['director_1'] = '';
            $selected['director_2'] = '';
            $selected['director_3'] = '';
            $selected['director_4'] = '';
        } else {
            $selected['n'] = $place->name;
            $selected['city'] = $place->city;
            $selected['address'] = $place->address;
            $selected['director_1'] = $pract->director_id;
            $selected['director_2'] = $pract->director_ugu_id;
            $selected['director_3'] = $pract->director_pr_id;
            $selected['director_4'] = $pract->director_or_id;
        }

        $groupTemp = PractGroup::where('pract_id', $pract->id)->get();
        foreach ($groupTemp as $t) {
            array_push($selected['groups'], $t->group_id);
        }

        $agreement_type = AgreementType::all();
        $types = Type::all();
        $views = View::all();
        $groups = StudentGroup::all();
        $students = Student::all();
        $usersTemp = User::all();
        $directorsTemp = director::all();
        $users = [];
        $students_id = [];
        foreach ($students as $student) {
            array_push($students_id, $student->user_id);
        }
        foreach ($usersTemp as $user) {
            if (!in_array($user->id, $students_id)) {
                array_push($users, $user);
            }
        }
        $directors = [];
        foreach ($directorsTemp as $director) {
            $user = User::where('id', $director->user_id)->first();
            $name = $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name;
            array_push($directors, ['id' => $director->id, 'name' => $name]);
        }


        return view('changePract', ['pract_id' => $pract_id, 'agreement_id' => $pract->agreement_id, 'selected' => $selected, 'agreement' => $agreement_type, 'types' => $types, 'views' => $views, 'groups' => $groups, 'users' => $users, 'directors' => $directors, 'user_role' => $this->getRole($request)]);
    }

    public function createGroup(Request $request)
    {
        $direction = $request->input('direction');
        $name = $request->input('name');

        if ($direction != null and $name != null) {
            StudentGroup::create(['direction_id' => $direction, 'name' => $name]);
        }
        return redirect('groups');
    }

    public function deleteGroup(Request $request)
    {
        $group_id = $request->input('group');
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

        return redirect('groups');
    }

    public function giveCourse(Request $request)
    {
        $id = $request->input('group');
        $course = $request->input('course');

        if ($id != null and $course != null) {
            StudentGroup::where('id', $id)->first()->setAttribute('course', $course)->save();
        }

        return redirect('groups');
    }

    public function studentToGroup(Request $request)
    {
        $group = $request->input('group');
        $user = $request->input('user');

        if ($group != null and $user != null) {
            $student = Student::updateOrCreate(['user_id' => $user], ['user_id' => $user, 'group_id' => $group]);
            $stud_group = PractGroup::where('group_id', $group)->get();
            foreach ($stud_group as $t) {
                PractStudent::updateOrCreate(['pract_id' => $t->pract_id, 'student_id' => $student->id], ['pract_id' => $t->pract_id, 'student_id' => $student->id]);
            }
        }

        return redirect('groups');
    }

    public function addDirector(AddDirectorRequest $request)
    {
        $user = $request->input('user');
        $post = $request->input('post');

        director::updateOrCreate(['user_id' => $user], ['user_id' => $user, 'post' => $post]);

        return redirect('admin');
    }

    public function createPract(CreatePractRequest $request)
    {
        $order_date = $request->input('date');
        $order_id = $request->input('order');
        $order = Order::create(['number' => $order_id, 'date' => $order_date]);

        $money = $request->input('money');
        $agreement_id = $request->input('agreement');

        $new_agreement = Agreement::create([
            'type_id' => $agreement_id
        ]);

        $pract_name = $request->input('pract_name');
        $type = $request->input('type');
        $view = $request->input('view');
        $year = $request->input('year');
        $begin = $request->input('begin');
        $end = $request->input('end');
        $pract = Practic::create([
            'name' => $pract_name, 'agreement_id' => $new_agreement->id, 'money' => ($money == 'on') ? true : false, 'type_id' => $type, 'view_id' => $view, 'year' => $year,
            'date_begin' => $begin, 'date_end' => $end, 'order_id' => $order->id
        ]);

        $order->update(['pract_id' => $pract->id]);

        return redirect('opop');
    }

    public function changePract(ChangePractRequest $request)
    {
        $number = $request->input('pract');

        $pract = Practic::where('id', $number)->first();
        $old_director_id = $pract->director_id;

        $order_date = $request->input('date');
        $order_id = $request->input('order');
        $order = Order::updateOrCreate(['id' => $pract->order_id], ['number' => $order_id, 'date' => $order_date]);

        $name = $request->input('name');
        $city = $request->input('city');
        $address = $request->input('address');

        $place = Place::updateOrCreate(['id' => $pract->place_id], ['name' => $name, 'city' => $city, 'address' => $address]);
        $dir_university = $request->input('dir_university');
        $dir_p = $request->input('dir_p');
        $dir_o = $request->input('dir_o');
        $dir_practise = $request->input('dir_practise');
        $director_id = director::where('id', $dir_practise)->first()->setAttribute('responsibillity', 3);
        $director_id->save();

        $dir_user_id = $director_id->user_id;
        $user = User::where('id', $dir_user_id)->first();
        if ($user->role != 2) {
            User::where('id', $dir_user_id)->first()->setAttribute('role', 1)->save();
        }
        $director_pr_id = director::where('id', $dir_p)->first()->setAttribute('responsibillity', 1);
        $director_pr_id->save();
        $director_or_id = director::where('id', $dir_o)->first()->setAttribute('responsibillity', 2);
        $director_or_id->save();
        $money = $request->input('money');
        $agreement_id = $request->input('agreement');
        $director_ugu_id = director::where('id', $dir_university)->first()->setAttribute('responsibillity', 0);
        $director_ugu_id->save();
        $new_agreement = Agreement::updateOrCreate([
            'id' => $pract->agreement_id
        ], [
            'type_id' => $agreement_id
        ]);

        $groups = $request->input('group');
        $pract_name = $request->input('pract_name');
        $type = $request->input('type');
        $view = $request->input('view');
        $year = $request->input('year');
        $begin = $request->input('begin');
        $end = $request->input('end');
        $pract->update([
            'name' => $pract_name, 'agreement_id' => $new_agreement->id, 'money' => ($money == 'on') ? true : false, 'type_id' => $type, 'view_id' => $view, 'year' => $year,
            'place_id' => $place->id, 'date_begin' => $begin, 'date_end' => $end, 'order_id' => $order->id, 'director_id' => $director_id->id, 'director_ugu_id' => $director_ugu_id->id,
            'director_pr_id' => $director_pr_id->id, 'director_or_id' => $director_or_id->id
        ]);

        $count = Practic::where('director_id',$old_director_id)->count();
        
        if ($count == 0) {
            $user_id_t = director::where('id',$old_director_id)->first()->user_id;
            User::where('id', $user_id_t)->first()->setAttribute('role', 0)->save();        
        }

        $gr_temp = PractGroup::where('pract_id', $pract->id)->get();
        foreach ($gr_temp as $t) {
            if (!in_array($t->group_id, $groups === null ? [] : $groups)) {
                $t->delete();
            }
        }
        if ($groups !== null) {
            foreach ($groups as $group) {
                $students = Student::where('group_id', $group)->get();
                foreach ($students as $student) {
                    PractStudent::updateOrCreate(
                        ['pract_id' => $pract->id, 'student_id' => $student->id],
                        ['pract_id' => $pract->id, 'student_id' => $student->id]
                    );
                }
                PractGroup::updateOrCreate(
                    ['pract_id' => $pract->id, 'group_id' => $group],
                    ['pract_id' => $pract->id, 'group_id' => $group]
                );
            }
        }


        return redirect('opop');
    }
}
