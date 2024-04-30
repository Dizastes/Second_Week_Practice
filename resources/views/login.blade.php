<!DOCTYPE html>
<html lang="en">

<head>
    <title>Авторизация</title>
</head>

<body>

    <main>
        <form action="login" method="post" class="register-form">
            @csrf
            @if (isset($mes))
                <h5 style="margin:1% auto">{{ $mes }}</h5>
            @endif
            <div class="container">
                <input class="row" type="text" name="login" placeholder="логин">
                @error('login')
                    {{ $message }}
                @enderror
                <input class="row" type="password" style="margin-top: 10px;" name="password" placeholder="пароль">
                @error('password')
                    {{ $message }}
                @enderror
                <input class="row" type="submit">
            </div>
            <div class="container text-center mt-3">
                <h2>еще нет аккаунта?</h2>
                <a href="register" class="link-btn">регистрация</a>
            </div>
        </form>
    </main>
</body>

</html>
