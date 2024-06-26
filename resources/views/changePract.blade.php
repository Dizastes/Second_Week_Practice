<!DOCTYPE html>
<html lang="en">

<head>
    @include('templates.include')
    @include('templates.bootstrap')
</head>

<body>
    @include('templates.admin')
    <main class="main_admin">
        <div>
            <div class="section">
                <h1>Руководитель ОПОП</h1>
            </div>
            <div>
                <form action="changePract" method='post'>
                    @csrf
                    <input type="hidden" name="pract" value='{{ $pract_id }}'>
                    <input type="hidden" name="agreement_change" value='{{ $agreement_id }}'>
                    <div class="section">
                        <h1>Практика группы</h1>
                        <div class="small_info">
                            <select multiple id='select-group' name="group[]" style="margin:0" placeholder="группа">
                                <option value=""></option>
                                @foreach ($groups as $group)
                                    <option {{ in_array($group->id, $selected['groups']) ? 'selected' : '' }}
                                        value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                            <small>Выберите группы</small>
                        </div>
                    </div>
                    <div class="section">
                        <div class="small_info"> <input type="text" name='pract_name' placeholder="Наименование"
                                value="{{ $selected['name'] }}">
                            <small>Название практики</small>
                        </div>
                        <div class="small_info">
                            <select id='select-type' name="type" placeholder="тип">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <small>Тип практики</small>
                        </div>
                        <div class="small_info">
                            <select id='select-view' name="view" style="margin:0" placeholder="вид">
                                <option value=""></option>
                                @foreach ($views as $view)
                                    <option value="{{ $view->id }}">{{ $view->name }}</option>
                                @endforeach
                            </select>
                            <small>Вид практики</small>
                        </div>
                    </div>
                    <div class="container_admin mt-5 mb-5">
                        <h2>Вид договора</h2>
                        <select id='select-agreement' name="agreement" placeholder="Вид договора">
                            <option value=""></option>
                            @foreach ($agreement as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="container_admin mb-5">
                        <h2>Оплачиваемая ли</h2>
                        <input type="checkbox" name="money" {{ $selected['money'] ? 'checked' : '' }}>
                    </div>
                    <div class="section more_info" style="margin-top:2.5%">
                        <div class="small_info">
                            <input type="text" name='year' placeholder="Год" value='{{ $selected['year'] }}'>
                            <small>год практики</small>
                        </div>
                        <div class="small_info">
                            <input type="date" name='begin' value='{{ $selected['begin'] }}'>
                            <small>дата начала практики</small>
                        </div>
                        <div class="small_info">
                            <input type="date" name='end' value='{{ $selected['end'] }}'>
                            <small>дата окончания практики</small>
                        </div>
                        <div class="small_info">
                            <input type="date" name='date' value='{{ $selected['date'] }}'>
                            <small>дата приказа</small>
                        </div>
                        <div class="small_info">
                            <input type="text" name='order' placeholder="Номер приказа"
                                value='{{ $selected['order_number'] }}' style="margin:0">
                            <small>номер приказа</small>
                        </div>

                    </div>
                    <div class="section">
                        <h1>Место практики</h1>
                    </div>
                    <div class="section">
                        <div class="small_info">
                            <input type="text" name='name' placeholder="Наименование"
                                value="{{ $selected['n'] }}">
                            <small>Наименование</small>
                        </div>
                        <div class="small_info">
                            <input type="text" name='city' placeholder="Город" value="{{ $selected['city'] }}">
                            <small>Город</small>
                        </div>
                        <div class="small_info">
                            <input type="text" name='address' placeholder="Адрес"
                                value="{{ $selected['address'] }}">
                            <small>Адрес</small>
                        </div>
                    </div>
                    <div class="section">
                        <h1>Руководители</h1>
                    </div>
                    <div class="direct">
                        <div class="container_admin mb-3">
                            <h2>Руководитель от ВУЗа</h2>
                            <select id='select-dir-1' name="dir_university">
                                <option value=""></option>
                                @foreach ($directors as $director)
                                    <option value="{{ $director['id'] }}">{{ $director['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container_admin mb-3">
                            <h2>Руководитель от предприятия</h2>
                            <select id='select-dir-2' name="dir_p">
                                <option value=""></option>
                                @foreach ($directors as $director)
                                    <option value="{{ $director['id'] }}">{{ $director['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container_admin mb-3">
                            <h2>Руководитель от организации</h2>
                            <select id='select-dir-3' name="dir_o">
                                <option value=""></option>
                                @foreach ($directors as $director)
                                    <option value="{{ $director['id'] }}">{{ $director['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container_admin mb-3">
                            <h2>Руководитель практики</h2>
                            <select id='select-dir-4' name="dir_practise">
                                <option value=""></option>
                                @foreach ($directors as $director)
                                    <option value="{{ $director['id'] }}">{{ $director['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="section">
                        <button type="submit" class="mybtn">Сохранить практику</button>
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
    var $select = $('#select-type').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{ $selected['type'] }}');

    var $select = $('#select-view').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{ $selected['view'] }}');


    var $select = $('#select-agreement').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{ $selected['agreement'] }}');

    var $select = $('#select-dir-1').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{ $selected['director_2'] }}');

    var $select = $('#select-dir-2').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{ $selected['director_3'] }}');

    var $select = $('#select-dir-3').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{ $selected['director_4'] }}');

    var $select = $('#select-dir-4').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{ $selected['director_1'] }}');
</script>

</html>
