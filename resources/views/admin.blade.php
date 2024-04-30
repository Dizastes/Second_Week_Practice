<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>
<body>
	<div class="main">
		<div>
			<h5>Добавление учебного подразделения</h5>
			<form action="createInstitute" method='post'>
				@csrf
				<input type="text" name='name'>
				<button>+</button>
			</form>
		</div>
		<div>
			<h5>Добавить образовательную программу</h5>
			<form action="createDirection" method='post'>
				@csrf
				<select id='select-state' name="institute" placeholder="подразделение">
					<option value=""></option>
					@foreach($institutes as $institute)
				  		<option value="{{$institute->id}}">{{$institute->name}}</option>
				  	@endforeach	
				</select>
				<input type="text" name='name' placeholder="наименование">
				<input type="text" name='code' placeholder="код направления">
				<button>+</button>
			</form>
		</div>
		<div>
			<h5>Удалить образовательную программу</h5>
			<form action="deleteDirection" method='post'>
				@csrf
				<select id='select-state' name="direction" placeholder="наименование">
					<option value=""></option>
					@foreach($directiones as $direction)
				  		<option value="{{$direction->id}}">{{$direction->name}}</option>
				  	@endforeach	
				</select>
				<button>-</button>
			</form>
		</div>
		<div>
			<h5>Добавить руководителя ОПОП</h5>
			<form action="createOPOP" method='post'>
				@csrf
				<select id='select-state' name="institute" placeholder="подразделение">
					<option value=""></option>
					@foreach($institutes as $institute)
				  		<option value="{{$institute->id}}">{{$institute->name}}</option>
				  	@endforeach	
				</select>		
				<select id='select-state' name="direction" placeholder="программа">
					<option value=""></option>
					@foreach($directiones as $direction)
				  		<option value="{{$direction->id}}">{{$direction->name}}</option>
				  	@endforeach	
				</select>
				<select id='select-state' name="user" placeholder="Пользователь">
					<option value=""></option>
					@foreach($users as $user)
				  		<option value="{{$user->id}}">{{$user->second_name . ' ' . $user->first_name . ' ' . $user->third_name}}</option>
				  	@endforeach	
				</select>	
				<button>+</button>
			</form>
		</div>
	</div>
	
</body>
<script>
 $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>

</html>