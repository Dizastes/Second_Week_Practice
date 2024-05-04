<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('templates.include')
    @include('templates.bootstrap')
    <title>Student</title>
</head>

<body>
    @include('templates.admin')
    <main>
        <div class="section">
            <h1 style="margin:0">Студент</h1>
        </div>
        <div class="container student_info">
            <div class="container_admin">
                <h3>ФИО</h3>
                <h4>{{ $user[0]->second_name }} {{ $user[0]->first_name }} {{ $user[0]->third_name }}</h4>
            </div>
            <div class="container_admin">
                <h3>Группа</h3>
                @if ($group != null)
                    <h4>{{ $group[0]->name }}</h4>
                @else
                    <h4>{{ 'Не имеется' }}</h4>
                @endif
            </div>
            <div class="container_admin">
                <h3>Программа обучения</h3>
                @if ($direction != null)
                    <h4>{{ $direction[0]->name }}</h4>
                @else
                    <h4>{{ 'Не имеется' }}</h4>
                @endif

            </div>
        </div>
        <hr>
        <div>
            <div class="section">
                <h2 style="margin:0">Отчеты</h2>
            </div>

            @for ($i = 0; $i < count($practics); $i++)
                @if ($students[$i]->complete == 1)
                    <div class="section" style="justify-content:initial">
                        <form action="uploadfile" method="post" enctype="multipart/form-data" class="form_admin">
                            @csrf
                            <p class="practicData">Практика "{{ $practics[$i]->name }}"
                                {{ preg_replace('/-/', '.', $practics[$i]->date_begin) }}-{{ preg_replace('/-/', '.', $practics[$i]->date_end) }}
                            </p>
                            <input type="hidden" value="{{ $practics[$i]->id }}" name="pract">
                            @if ($students[$i]->status == 'Отказано' || $students[$i]->status == '')
                                <label class="input-file">
                                    <span class="input-file-text" type="text"></span>
                                    <input type="file" name="file">
                                    <span class="input-file-btn">Выберите файл</span>
                                </label>
                                <input type="submit" class="mybtn" style="width:max-content; height:max-content"
                                    value="Загрузить">
                            @endif
                        </form>
                        <h5>{{ $students[$i]->status }}</h5>
                        @if ($students[$i]->status == 'Подтверждено')
                            <form action="Otchet" method="get">
                                @csrf
                                <input type="hidden" value="{{ $practics[$i]->id }}" name="pract_id">
                                <input type="submit" style="width:max-content; height:max-content" class="mybtn"
                                    value="скачать">
                            </form>
                        @elseif ($students[$i]->status == '' || $students[$i]->status == 'Отказано')
                            <form action="confirm" method="post">
                                @csrf
                                <input type="hidden" value="{{ $students[$i]->id }}" name="pract_id">
                                <input type="submit" style="width:max-content; height:max-content" class="mybtn"
                                    value="Запросить" name="confirm">
                            </form>
                        @endif
                    </div>
                @endif
            @endfor
        </div>
    </main>
</body>
<script>
    $('.input-file input[type=file]').on('change', function() {
        let file = this.files[0];
        $(this).closest('.input-file').find('.input-file-text').html(file.name);
    });
</script>

</html>
