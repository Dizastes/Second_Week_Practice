<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student</title>
</head>
<body>
	<div>
		<h5>ФИО</h5>
		<p>{{$user[0]->second_name}} {{$user[0]->first_name}} {{$user[0]->third_name}}</p>
	</div>
	<div>
		<h5>Группа</h5>
		<p>{{$group[0]->name}}</p>
	</div>
	<div>
		<h5>Программа обучения</h5>
		<p>{{$direction[0]->name}}</p>
	</div>
	<div>
		<h3>Отчеты</h3>
			@foreach ($practics as $practic)
			<form action="uploadfile" method="post" enctype="multipart/form-data">
				@csrf
				<p>{{$practic->name}} {{$practic->date_begin}} {{$practic->date_end}}</p>
				<input type="hidden" value="{{$practic->id}}" name="pract">
				<input type="file" name="file">
				<input type="submit" value="подтвердить">
			</form>
			<form action="download" method="post">
				@csrf
				<input type="hidden" value="{{$practic->id}}" name="pract_id">
				<input type="submit" value="скачать">
			</form>
			@endforeach
	</div>
</body>
</html>