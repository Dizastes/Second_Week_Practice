<!DOCTYPE html>
<html lang="en">

<head>
    @include('templates.include')
    @include('templates.bootstrap')
</head>

<body>
    @include('templates.admin')
    <header>
        <h1>Администратор учебных частей</h1>
    </header>
    <main class="main_admin">
        <div class="container_admin">
            <h2>Добавление учебного подразделения</h2>
            <form action="createInstitute" method='post' class="form_admin">
                @csrf
                <input type="text" name='name' placeholder="наименование">
                <button>+</button>
            </form>
        </div>
        <hr>
        <div class="container_admin">
            <h2>Добавить образовательную программу</h2>
            <form action="createDirection" method='post' class="form_admin">
                @csrf
                <select id='select-state' name="institute" placeholder="подразделение">
                    <option value=""></option>
                    @foreach ($institutes as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                    @endforeach
                </select>
                <input type="text" name='name' placeholder="наименование">
                <input type="text" name='code' placeholder="код направления">
                <button>+</button>
            </form>
        </div>
        <hr>
        <div class="container_admin">
            <h2>Удалить образовательную программу</h2>
            <form action="deleteDirection" method='post' class="form_admin">
                @csrf
                <select id='select-institute2' placeholder="подразделение">
                    <option value=""></option>
                    @foreach ($institutes as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                    @endforeach
                </select>
                <select id='select-direction2' name="direction" placeholder="наименование">
                    <option value=""></option>
                    @foreach ($directiones as $direction)
                        <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                    @endforeach
                </select>
                <button>-</button>
            </form>
        </div>
        <hr>
        <div class="container_admin">
            <h2>Добавить руководителя ОПОП</h2>
            <form action="createOPOP" method='post' class="form_admin">
                @csrf
                <select id='select-institute' name="institute" placeholder="подразделение">
                    <option value=""></option>
                    @foreach ($institutes as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                    @endforeach
                </select>
                <select id='select-direction' name="direction" placeholder="программа">

                </select>
                <select id='select-state' name="user" placeholder="Пользователь">
                    <option value=""></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->second_name . ' ' . $user->first_name . ' ' . $user->third_name }}</option>
                    @endforeach
                </select>
                <input type="text" name = 'post' placeholder="Должность">
                <button>+</button>
            </form>
        </div>
        <hr>
    </main>

</body>
<script>
    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });

    $(document).ready(function() {
        var instituteSelectize = $('#select-institute').selectize();
        var directionSelectize = $('#select-direction').selectize();

        var instituteSelectizeInstance = instituteSelectize[0].selectize;
        var directionSelectizeInstance = directionSelectize[0].selectize;

        instituteSelectizeInstance.on('change', function(value) {
            var institute_id = value;

            directionSelectizeInstance.clearOptions();

            $.ajax({
                url: '/get-direction/' + institute_id,
                type: 'GET',
                success: function(data) {
                    directionSelectizeInstance.addOption(data);
                }
            });
        });

        var instituteSelectize2 = $('#select-institute2').selectize();
        var directionSelectize2 = $('#select-direction2').selectize();

        var instituteSelectizeInstance2 = instituteSelectize2[0].selectize;
        var directionSelectizeInstance2 = directionSelectize2[0].selectize;

        instituteSelectizeInstance2.on('change', function(value) {
            var institute_id = value;

            directionSelectizeInstance2.clearOptions();

            $.ajax({
                url: '/get-direction/' + institute_id,
                type: 'GET',
                success: function(data) {
                    directionSelectizeInstance2.addOption(data);
                }
            });
        });
    });
</script>

</html>
