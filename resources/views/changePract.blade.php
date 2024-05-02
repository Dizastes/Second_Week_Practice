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
            <div>
                <form action="changePract" method='post' >
                    @csrf
                    <input type="hidden" name="pract" value='{{$pract_id}}'>
                    <input type="hidden" name="agreement_change" value='{{$agreement_id}}'>
                    <div class="section">
                        <h1>Практика группы</h1>
                        <select multiple id='select-group' name="group[]" style="margin:0" placeholder="группа">
                            <option value=""></option>
                            @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="section">
                        <input type="text" name='pract_name' placeholder="Наименование" value="{{$selected['type']}}">
                        <select id='select-type' name="type" placeholder="тип">
                            @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <select id='select-view' name="view" style="margin:0" placeholder="вид">
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
                        <input type="checkbox" name="money" {{$selected['money'] ? 'checked' : ''}}>
                    </div>
                    <div class="section more_info" style="margin-top:2.5%">
                        <input type="text" name='year' placeholder="Год" value='{{$selected['year']}}'>
                        <div class="small_info">
                            <input type="date" name='begin' value='{{$selected['begin']}}'>
                            <small>дата начала практики</small>
                        </div>
                        <div class="small_info">
                            <input type="date" name='end' value='{{$selected['begin']}}'>
                            <small>дата окончания практики</small>
                        </div>
                        <div class="small_info">
                            <input type="date" name='date' value='{{$selected['date']}}'>
                            <small>дата приказа</small>
                        </div>
                        <input type="text" name='order' placeholder="Номер приказа" value='{{$selected['order_number']}}' style="margin:0">
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
    var $select = $('#select-type').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{$selected['type']}}');

    var $select = $('#select-view').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{$selected['view']}}');


    var $select = $('#select-agreement').selectize();
    var selectize = $select[0].selectize;
    selectize.setValue('{{$selected['agreement']}}');

</script>

</html>