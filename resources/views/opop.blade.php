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
            <div class="section mb-5">
                <h1>Руководитель ОПОП</h1>
            </div>
            <div class="container_admin mb-3">
                <form action="checkStatus" method='post' class="form_admin">
                    @csrf
                    <h4 class="practicData">Получить отчет по группе</h4>
                    <select id='practiceSelect' name="pract_id" placeholder="руководитель">
                        <option value=""></option>
                        @foreach ($practics as $practic)
                            <option value="{{ $practic['id'] }}">{{ $practic['order'] }}</option>
                        @endforeach
                    </select>
                    <select name="group_id" id="groupSelect" placeholder="группа">
                    </select>
                    <input type="submit" value="Получить" style="display: none" id="getStatus">
                </form>
                @if (isset($download) and $download)
                    <form action="groupWord" method='post'>
                        @csrf
                        <input type="hidden" name="pract_id" value="{{ $pract_id }}">
                        <input type="hidden" name="group_id" value="{{ $group_id }}">
                        <button class="mybtn" style="width: max-content; padding: 0 10px !important">Скачать
                            отчет</button>
                    </form>
                @elseif(isset($download) and !$download)
                    <h5>Отчет еще не сформирован</h5>
                @endif
            </div>
            <div>
                <form action="addDirector" method="post" class="form_admin">
                    @csrf
                    <h4 class="practicData">Добавить руководителя</h4>
                    <select id='select-state' name="user" placeholder="руководитель">
                        <option value=""></option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name }}</option>
                        @endforeach
                    </select>
                    <input type="text" placeholder="Должность" name='post' id="post" style="display:none">
                    <button type="submit" id="worker-send" style="display:none">+</button>
                </form>

            </div>
            <div class="mt-3">
                <form action="Pract" method='post' class="form_admin">
                    @csrf
                    <h4 class="practicData">Изменить практику</h4>
                    <select id='select-pract' name="pract" placeholder="номер приказа">
                        <option value=""></option>
                        @foreach ($practics as $practic)
                            <option value="{{ $practic['id'] }}">{{ $practic['order'] }}</option>
                        @endforeach
                    </select>
                    <input type='submit' class="myBtn" id="send-pract"
                        style="width:max-content; padding: 0 10px; display:none">
                </form>
                <form action="createPract" method='post'>
                    @csrf
                    <div class="section">
                        <h1>Практика группы</h1>
                    </div>
                    <div class="section">
                        <div class="small_info">
                            <input type="text" name='pract_name' placeholder="Наименование">
                            <small>Название практики</small>
                        </div>
                        <div class="small_info">
                            <select id='select-state' name="type" placeholder="тип">
                                <option value=""></option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <small>Тип практики</small>
                        </div>
                        <div class="small_info">
                            <select id='select-state' name="view" style="margin:0" placeholder="вид">
                                <option value=""></option>
                                @foreach ($views as $view)
                                    <option value="{{ $view->id }}">{{ $view->name }}</option>
                                @endforeach
                            </select>
                            <small>Вид практики</small>
                        </div>
                    </div>
                    <div class="container_admin mt-5">
                        <div class="practicData">
                            <h4>Вид договора</h4>
                        </div>
                        <select id='select-agreement' name="agreement" placeholder="Вид договора" class="ml-3">
                            <option value=""></option>
                            @foreach ($agreement as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="container_admin mt-5">
                        <h4>Оплачиваемая ли</h4>
                        <input type="checkbox" name="money">
                    </div>
                    <div class="section more_info" style="margin-top:2.5%">
                        <div class="small_info">
                            <input type="text" name='year' placeholder="Год">
                            <small>год практики</small>
                        </div>
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
                        <div class="small_info">
                            <input type="text" name='order' placeholder="Номер приказа" style="margin:0">
                            <small>номер приказа</small>
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
        var practiceSelectize = $('#practiceSelect').selectize();
        var groupSelectize = $('#groupSelect').selectize();

        var practiceSelectizeInstance = practiceSelectize[0].selectize;
        var groupSelectizeInstance = groupSelectize[0].selectize;

        practiceSelectizeInstance.on('change', function(value) {
            var practiceId = value;

            groupSelectizeInstance.clearOptions();

            $.ajax({
                url: '/get-groups/' + practiceId,
                type: 'GET',
                success: function(data) {
                    groupSelectizeInstance.addOption(data);
                }
            });
        });
    });

    @if (isset($pract_id))
        var $select = $('#practiceSelect').selectize();
        var selectize = $select[0].selectize;
        selectize.setValue('{{ $pract_id }}');

        var selectgroup = $('#groupSelect').selectize();
        var selecgrouptInstance = selectgroup[0].selectize;

        $.ajax({
            url: '/get-groups/' + '{{ $pract_id }}',
            type: 'GET',
            success: function(data) {
                selecgrouptInstance.addOption(data);
                selecgrouptInstance.setValue('{{ $group_id }}');
            }
        });
    @endif

    let getStatus = document.getElementById('getStatus');

    $("#groupSelect").change(function() {
        var tempMark = $(this).val();
        if (tempMark !== '') {
            getStatus.style.display = 'block';
        } else {
            getStatus.style.display = 'none';
        }
    });
    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });

    let inputPost = document.getElementById('post');
    let practBtn = document.getElementById('send-pract');

    $("#select-state").change(function() {
        var tempMark = $(this).val();
        if (tempMark !== '') {
            inputPost.style.display = 'block';
        } else {
            inputPost.style.display = 'none';
        }
    });

    $("#select-pract").change(function() {
        var tempMark = $(this).val();
        if (tempMark !== '') {
            practBtn.style.display = 'block';
        } else {
            practBtn.style.display = 'none';
        }
    });

    let buttonWorker = document.getElementById('worker-send');

    inputPost.addEventListener('input', function() {
        if (inputPost.value !== '') {
            buttonWorker.style.display = 'block';
        } else {
            buttonWorker.style.display = 'none';
        }
    })
</script>

</html>
