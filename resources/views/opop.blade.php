<!DOCTYPE html>
<html lang="en">

<head>
    @include('templates.include')
</head>

<body>
    @include('templates.header')
    <main class="main_admin">
        <div>
            <div class="section">
                <h1>Руководитель ОПОП</h1>
            </div>
            <div class="container_admin">
                <form action="createGroup" method='post' class="form_admin">
                    @csrf
                    <h2>Добавить группу</h2>
                    <select id='select-state' name="direction" placeholder="программа">
                        <option value=""></option>
                        @foreach ($directiones as $direction)
                        <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name='name' placeholder="номер группы">
                    <button type="submit">+</button>
                </form>
            </div>
            <div class="container_admin">
                <form action="giveCourse" method='post' class="form_admin">
                    @csrf
                    <h2>Курс</h2>
                    <select id='select-state' name="group" placeholder="группа">
                        <option value=""></option>
                        @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
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
            </div>
            <div class="container_admin">
                <form action="studentToGroup" method='post' class="form_admin">
                    @csrf
                    <h2>Добавить студента</h2>
                    <select id='select-state' name="group" placeholder="группа">
                        <option value=""></option>
                        @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <select id='select-state' name="user" placeholder="Пользователь">
                        <option value=""></option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name }}
                        </option>
                        @endforeach
                    </select>

                    <button type="submit">+</button>
                </form>
            </div>
            <div>
                <form action="createPract" method='post'>
                    @csrf
                    <div class="section">
                        <h1>Практика группы</h1>
                        <select id='select-state' name="group" style="margin:0" placeholder="группа">
                            <option value=""></option>
                            @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="section">
                        <input type="text" name='pract_name' placeholder="Наименование">
                        <select id='select-state' name="type" placeholder="тип">
                            <option value=""></option>
                            @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <select id='select-state' name="view" style="margin:0" placeholder="вид">
                            <option value=""></option>
                            @foreach ($views as $view)
                            <option value="{{ $view->id }}">{{ $view->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="container_admin">
                        <h2>Вид договора</h2>
                        <select id='select-agreement' name="agreement" placeholder="Вид договора">
                            <option value=""></option>
                            @foreach ($agreement as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="container_admin">
                        <h2>Оплачиваемая ли</h2>
                        <input type="checkbox" name="money">
                    </div>
                    <div class="section more_info" style="margin-top:2.5%">
                        <input type="text" name='year' placeholder="Год">
                        <div class="small_info">
                            <input type="date" name='begin'>
                            <small>дата начала практики</small>
                        </div>
                        <div class="small_info">
                            <input type="date" name='end'>
                            <small>дата окончания практики</small>
                        </div>
                        <div class="small_info">
                            <input type="date" name='date'>
                            <small>дата приказа</small>
                        </div>
                        <input type="text" name='order' placeholder="Номер приказа" style="margin:0">
                    </div>
                    <div class="section">
                        <h1>Место практики</h1>
                    </div>
                    <div class="section">
                        <input type="text" name='name' placeholder="Наименование">
                        <input type="text" name='city' placeholder="Город">
                        <input type="text" name='address' placeholder="Адрес">
                    </div>
                    <div class="section">
                        <h1>Руководители</h1>
                    </div>
                    <div class="direct">
                        <div class="container_admin">
                            <h2>Руководитель от ВУЗа</h2>
                            <select id='select-state' name="dir_university">
                                <option value=""></option>
                                @foreach ($directors as $director)
                                <option value="{{ $director['id'] }}">{{ $director['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container_admin">
                            <h2>Руководитель от предприятия</h2>
                            <select id='select-state' name="dir_p">
                                <option value=""></option>
                                @foreach ($directors as $director)
                                <option value="{{ $director['id'] }}">{{ $director['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container_admin">
                            <h2>Руководитель от организации</h2>
                            <select id='select-state' name="dir_o">
                                <option value=""></option>
                                @foreach ($directors as $director)
                                <option value="{{ $director['id'] }}">{{ $director['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container_admin">
                            <h2>Руководитель практики</h2>
                            <select id='select-state' name="dir_practise">
                                <option value=""></option>
                                @foreach ($directors as $director)
                                <option value="{{ $director['id'] }}">{{ $director['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="section">
                        <button type='submit' class="btn btn-primary">Сохранить практику</button>
                    </div>
                </form>
            </div>
    </main>
</body>
<script>
    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>

</html>