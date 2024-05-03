<!DOCTYPE html>
<html lang="en">

<head>
    @include('templates.include')
</head>

<body>
    @include('templates.header')
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
                <select id='select-state' name="direction" placeholder="наименование">
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
                <select id='select-state' name="institute" placeholder="подразделение">
                    <option value=""></option>
                    @foreach ($institutes as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                    @endforeach
                </select>
                <select id='select-state' name="direction" placeholder="программа">
                    <option value=""></option>
                    @foreach ($directiones as $direction)
                        <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                    @endforeach
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
</script>

</html>
