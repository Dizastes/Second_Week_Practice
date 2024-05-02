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
                <h4>{{ $group[0]->name }}</h4>
            </div>
            <div class="container_admin">
                <h3>Программа обучения</h3>
                <h4>{{ $direction[0]->name }}</h4>
            </div>
        </div>
        <hr>
        <div>
            <div class="section">
                <h2 style="margin:0">Отчеты</h2>
            </div>
            @foreach ($practics as $practic)
                <div class="section">
                    <form action="uploadfile" method="post" enctype="multipart/form-data" class="form_admin">
                        @csrf
                        <p class="practicData">Практика "{{ $practic->name }}"
                            {{ preg_replace('/-/', '.', $practic->date_begin) }}-{{ preg_replace('/-/', '.', $practic->date_end) }}
                        </p>
                        <input type="hidden" value="{{ $practic->id }}" name="pract">
                        <label class="input-file">
                            <span class="input-file-text" type="text"></span>
                            <input type="file" name="file">
                            <span class="input-file-btn">Выберите файл</span>
                        </label>
                        <input type="submit" class="mybtn" style="width:max-content; height:max-content"
                            value="Загрузить">
                    </form>
                    <form action="download" method="post">
                        @csrf
                        <input type="hidden" value="{{ $practic->id }}" name="pract_id">
                        <input type="submit" style="width:max-content; height:max-content" class="mybtn"
                            value="скачать">
                    </form>
                    <h5>{{ $practic->status }}</h5>
                </div>
            @endforeach
        </div>
    </main>
</body>
<script>
    $('.input-file input[type=file]').on('change', function() {
        let file = this.files[0];
        $(this).closest('.input-file').find('.input-file-text').html(file.name);
    });

    function openDocx() {
        fetch('/Otchet')
            .then(response => response.blob())
            .then(blob => {
                var url = URL.createObjectURL(blob);
                window.open(url, '_blank');
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
    }
</script>

</html>
