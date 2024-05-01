<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>

<body>
    <div>
        <form action="createGroup" method='post'>
            @csrf
            <p>Добавить группу</p>
            <select id='select-state' name="direction" placeholder="программа">
                <option value=""></option>
                @foreach($directiones as $direction)
                <option value="{{$direction->id}}">{{$direction->name}}</option>
                @endforeach
            </select>
            <input type="text" name='name' placeholder="номер группы">
            <button type="submit">+</button>
        </form>
        <form action="giveCourse" method='post'>
            @csrf
            <p>Курс</p>
            <select id='select-state' name="group" placeholder="группа">
                <option value=""></option>
                @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
            </select>
            <select id='select-state' name="course" placeholder="курс">
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            <button type="submit">+</button>
        </form>
        <form action="studentToGroup" method='post'>
            @csrf
            <p>Добавить студента</p>
            <select id='select-state' name="group" placeholder="группа">
                <option value=""></option>
                @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
            </select>
            <select id='select-state' name="user" placeholder="Пользователь">
                <option value=""></option>
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->second_name . ' ' . $user->first_name . ' ' . $user->third_name}}</option>
                @endforeach
            </select>

            <button type="submit">+</button>
        </form>
    </div>
    <div>
        <form action="createPract" method='post'>
            @csrf
        <h1>Практика группы</h1>
        <select id='select-state' name="group" placeholder="группа">
            <option value=""></option>
            @foreach($groups as $group)
            <option value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
        </select>
        <input type="text" name='pract_name' placeholder="Наименование">
        <select id='select-state' name="type" placeholder="тип">
            <option value=""></option>
            @foreach($types as $type)
            <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
        <select id='select-state' name="view" placeholder="вид">
            <option value=""></option>
            @foreach($views as $view)
            <option value="{{$view->id}}">{{$view->name}}</option>
            @endforeach
        </select>
        <input type="text" name='year' placeholder="Год">
        <input type="date" name='begin' placeholder="Дата начала">
        <input type="date" name='end' placeholder="Дата окончания">
        <input type="date" name='date' placeholder="Дата приказа">
        <input type="text" name='order' placeholder="Номер приказа">
        <h1>Место практики</h1>
        <input type="text" name='name' placeholder="Наименование">
        <input type="text" name='city' placeholder="Город">
        <input type="text" name='address' placeholder="Адрес">
        <h1>Руководители</h1>
        <p>Руководитель от ВУЗа</p>
        <select id='select-state' name="dir_university">
            <option value=""></option>
            @foreach($directors as $director)
            <option value="{{$director['id']}}">{{$director['name']}}</option>
            @endforeach
        </select>
        <p>Руководитель от предприятия</p>
        <select id='select-state' name="dir_p">
            <option value=""></option>
            @foreach($directors as $director)
            <option value="{{$director['id']}}">{{$director['name']}}</option>
            @endforeach
        </select>
        <p>Руководитель от организации</p>
        <select id='select-state' name="dir_o">
            <option value=""></option>
            @foreach($directors as $director)
            <option value="{{$director['id']}}">{{$director['name']}}</option>
            @endforeach
        </select>
        <p>Руководитель практики</p>
        <select id='select-state' name="dir_practise">
            <option value=""></option>
            @foreach($directors as $director)
            <option value="{{$director['id']}}">{{$director['name']}}</option>
            @endforeach
        </select>
        <button type='submit'>Сохранить практику</button>
        </form>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>

</html>