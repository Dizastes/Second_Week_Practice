<!DOCTYPE html>
<html lang="en">


<head>
    <title>Регистрация</title>
    @include('templates.include')
    @include('templates.bootstrap')
</head>


<body>
    <main class="login-page">
        <form action="register" method="post" class="login-form">
            @csrf
            <div class="container">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input class="form-control" id="login" type="text" name="login" placeholder="писать здесь">
                    @error('login')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for='name'>Имя</label>
                    <input class="form-control" id = "name" type="text" name="first_name"
                        placeholder="писать здесь">
                    @error('first_name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for='surname'>Фамилия</label>
                    <input class="form-control" type="text" id="surname" name="second_name"
                        placeholder="писать здесь">
                    @error('second_name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for='thirdname'>Отчество</label>
                    <input class="form-control"type="text" id='thirdname' name="third_name" placeholder="писать здесь">
                    @error('third_name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input class="form-control" type="password" id="password" name="password"
                        placeholder="писать здесь">
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="c_password">Подтвердите пароль</label>
                    <input class="form-control" type="password" id= "c_password" name="c_password"
                        placeholder="писать здесь">
                    @error('c_password')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-secondary"
                    style='display:block; margin-left:auto; margin-right:auto'>Регистрация</button>
            </div>
            <div class="container text-center mt-3">
                <h2>уже есть аккаунт?</h2>
                <a href="login" class="btn btn-outline-secondary">Вход</a>
            </div>
        </form>
    </main>
</body>


</html>
