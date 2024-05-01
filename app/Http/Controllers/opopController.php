<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\institute;
use App\Models\direction;
use App\Models\director;
use App\Models\User;
use App\Models\StudentGroup;
use App\Models\Student;
use App\Models\Type;
use App\Models\View;
use App\Models\Place;
use App\Models\Practic;
use App\Models\Order;
use Illuminate\Support\Arr;

class opopController extends Controller
{
    public function getData(Request $request)
    {
        $directiones = direction::all();
        $groups = StudentGroup::all();
        $usersTemp = User::all();
        $students = Student::all();
        $directorsTemp = director::all();
        $types = Type::all();
        $views = View::all();
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
        foreach($directorsTemp as $director) {
            $user = User::where('id',$director->user_id)->first();
            $name = $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name;
            array_push($directors,['id'=>$director->id,'name'=>$name]);
        }

        return view('opop', ['types'=>$types,'views'=>$views,'directiones' => $directiones, 'groups' => $groups,'users'=>$users,'directors'=>$directors]);
    }

    public function createGroup(Request $request)
    {
        $direction = $request->input('direction');
        $name = $request->input('name');

        if ($direction != null and $name != null) {
            StudentGroup::create(['direction_id' => $direction, 'name' => $name]);
        }
        return redirect('opop');
    }

    public function giveCourse(Request $request)
    {
        $id = $request->input('group');
        $course = $request->input('course');

        if ($id != null and $course != null) {
            StudentGroup::where('id', $id)->first()->setAttribute('course', $course)->save();
        }

        return redirect('opop');
    }

    public function studentToGroup(Request $request)
    {
        $group = $request->input('group');
        $user = $request->input('user');

        if ($group != null and $user != null) {
           Student::create(['user_id'=>$user,'group_id'=>$group]);
        }

        return redirect('opop');
    }

    public function createPract(Request $request)
    {
        $order_date = $request->input('date');
        $order_id = $request->input('order');
        $order = Order::create(['number'=>$order_id,'date'=>$order_date]);

        $name = $request->input('name');
        $city = $request->input('city');
        $address = $request->input('address');
        $place = Place::create(['name'=>$name,'city'=>$city,'address'=>$address]);

        $dir_university = $request->input('dir_university');
        $dir_p = $request->input('dir_p');
        $dir_o = $request->input('dir_o');
        $dir_practise = $request->input('dir_practise');
        $director_id = director::where('id', $dir_university)->first()->setAttribute('responsibillity', 0)->save();
        $director_pr_id = director::where('id', $dir_p)->first()->setAttribute('responsibillity', 1)->save();
        $director_or_id = director::where('id', $dir_o)->first()->setAttribute('responsibillity', 2)->save();
        $director_ugu_id = director::where('id', $dir_practise)->first()->setAttribute('responsibillity', 3)->save();

        $group = $request->input('group');
        $pract_name = $request->input('pract_name');
        $type = $request->input('type');
        $view = $request->input('view');
        $year = $request->input('year');
        $begin = $request->input('begin');
        $end = $request->input('end');
        Practic::create(['name'=>$pract_name,'type_id'=>$type,'view_id'=>$view,'group_id'=>$group,'year'=>$year,
    'place_id'=>$place->id,'date_begin'=>$begin,'date_end'=>$end,'order_id'=>$order->id,'director_id'=>$director_id,'director_ugu_id'=>$director_ugu_id,
    'director_pr_id'=>$director_pr_id,'director_or_id'=>$director_or_id]);
        
        return redirect('opop');
    }
}
