<!DOCTYPE html>
<html lang="en">

<head>
    <title>Подтверждение</title>
    @include('templates.include')
    @include('templates.bootstrap')
</head>

<body>
    @include('templates.admin')
    <main class="main_admin">
        <div class="section">
            <h1>Студенты ожидающие проверку</h1>
        </div>
        @for ($i = 0; $i < count($students_pract); $i++)
            @if ($students_pract[$i]->status == ($user_role == 1 ? 'Ожидает проверки' : 'Ожидает подтверждения'))
                <div class="container_admin mb-3 justify-content-center p-2"
                    style="background-color: #DAE2F8;  border-radius: 10px">
                    <form action="download" method="post">
                        @csrf
                        <input type="hidden" value="{{ $students[$i][0]->id }}" name="user_id">
                        <input type="tehiddenxt" value="{{ $students_pract[$i]->pract_id }}" name="pract_id">
                        <input type="submit" class="mybtn" style="width:max-content; padding: 0 20px !important;"
                            value="скачать">
                    </form>
                    <form action="confirm" method="post" class="form_admin">
                        @csrf
                        <input type="hidden" value="{{ $students_pract[$i]->id }}" name="id">
                        <input type="hidden" value="{{ $students_pract[$i]->student_id }}" name="student_id">
                        <input type="hidden" value="{{ $students_pract[$i]->pract_id }}" name="pract_id">
                        <div class="practicData">{{ $students[$i][0]->second_name }} {{ $students[$i][0]->first_name }}
                            {{ $students[$i][0]->third_name }} "{{ $prcticsName[$i][0]->name }}"</div>
                        <input type="submit" class="mybtn" style="width:max-content; padding: 0 20px !important;"
                            value="Подтвердить" name="confirm">
                        <input type="submit" class="mybtn" style="width:max-content; padding: 0 20px !important;"
                            value="Отказать" name="confirm">
                        <div>{{ $students_pract[$i]->status }}</div>
                    </form>
                </div>
            @endif
        @endfor
    </main>
</body>

</html>
