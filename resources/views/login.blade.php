<!DOCTYPE html>
<html lang="en">

<head>
    <title>Авторизация</title>
    @include('templates.include')
    @include('templates.bootstrap')
</head>

<body>
    <main class="login-page">
        <form action="login" method="post">
            @csrf
            @if (isset($mes))
                <h5 style="margin:1% auto">{{ $mes }}</h5>
            @endif
            <div class="login-form">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input class="form-control" id="login" type="text" name="login" placeholder="писать здесь">
                    @error('login')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input class="form-control" id="password" type="password" style="margin-top: 10px;" name="password"
                        placeholder="пароль">
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-outline-secondary" type="submit"
                    style='display:block; margin-left:auto; margin-right:auto'>Вход</button>
            </div>
            <div class="container text-center mt-3">
                <h2>еще нет аккаунта?</h2>
                <a href="register" class="btn btn-outline-secondary">Регистрация</a>
            </div>
        </form>
    </main>
</body>

</html>
