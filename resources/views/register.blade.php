<!DOCTYPE html>
<html lang="en">
<head>
	@include('templates.include')
	<title>Регистрация</title>
</head>
<body>
	<header class="header-rest register">
		<img src="{{ asset('images/logo.png') }}" class="logo">
		<div class="rest-name">
			<h1>
				Delivery Gang
			</h1>
			<p>
				Asian Сuisine
			</p>
		</div>
	</header>
	<main>
		<form action="register" method="post" class="register-form">
			@csrf
			<div class="container">
				<label class="row">логин</label>
				<input class="row" type="text" name="login" placeholder="">
				<label class="row">имя</label>
				<input class="row" type="text" name="name" placeholder="">
				<label class="row">e-mail</label>
				<input class="row" type="text" name="email" placeholder="">
				<label class="row">пароль</label>
				<input class="row" type="text" name="password" placeholder="">
				<label class="row">подтвердите пароль</label>
				<input class="row" type="text" name="c_password" placeholder="">
				<input class="row" type="submit" value="регистрация">
			</div>
			<div class="container text-center mt-3">
				<h2>уже есть аккаунт?</h2>
				<a href="login" class="link-btn">вход</a>
			</div>
		</form>
	</main>
	@include('templates.footer')
</body>
</html>