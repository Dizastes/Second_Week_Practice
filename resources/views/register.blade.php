<!DOCTYPE html>
<html lang="en">


<head>
    <title>Регистрация</title>
</head>


<body>
    <main>
        <form action="register" method="post" class="register-form">
            @csrf
            <div class="container">
                <label class="row">логин</label>
                <input class="row" type="text" name="login" placeholder="">
                @error('login')
                    {{ $message }}
                @enderror
                <label class="row">имя</label>
                <input class="row" type="text" name="first_name" placeholder="">
                @error('first_name')
                    {{ $message }}
                @enderror
                <label class="row">фамилия</label>
                <input class="row" type="text" name="second_name" placeholder="">
                @error('second_name')
                    {{ $message }}
                @enderror
                <label class="row">Отчество</label>
                <input class="row" type="text" name="third_name" placeholder="">
                @error('third_name')
                    {{ $message }}
                @enderror
                <label class="row">пароль</label>
                <input class="row" type="password" name="password" placeholder="">
                @error('password')
                    {{ $message }}
                @enderror
                <label class="row">подтвердите пароль</label>
                <input class="row" type="password" name="c_password" placeholder="">
                @error('c_password')
                    {{ $message }}
                @enderror
                <input class="row" type="submit" value="регистрация">
            </div>
            <div class="container text-center mt-3">
                <h2>уже есть аккаунт?</h2>
                <a href="login" class="link-btn">вход</a>
            </div>
        </form>
    </main>
</body>


</html>
