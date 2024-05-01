<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
	<title>Practic</title>
</head>
<body>
	<h1>Руководитель практики</h1>
	<div>
		<form action="addPractStudent" method="post" enctype="multipart/form-data">
			@csrf

			<h5>Практика</h5>
			<select id='select-practic' name="practic" placeholder="Практика">
				<option value=""></option>
				@foreach($practics as $practic)
			  		<option value="{{$practic->id}}">{{$practic->name}}</option>
					}
			  	@endforeach	
			</select>

			<h5>Выбрать студента</h5>
			<select id='select-student' name="student" placeholder="Студент">
				<option value=""></option>
				@foreach($students as $student)
			  		<option value="{{$student[0]->id}}">{{$student[0]->second_name}} {{$student[0]->first_name}} {{$student[0]->third_name}}</option>
			  	@endforeach	
			</select>

			<h5>Вид договора</h5>
			<select id='select-agreement' name="agreement" placeholder="Вид договора">
				<option value=""></option>
				@foreach($agreement as $type)
			  		<option value="{{$type->id}}">{{$type->name}}</option>
					}
			  	@endforeach	
			</select>

			<h5>Оплачиваемая ли</h5>
			<input type="checkbox" name="money">

			<h5>Прошел ли практику</h5>
			<input type="checkbox" name="complete">

			<h5>Причина(если не прошел практику)</h5>
			<select id='select-volume' name="reason" placeholder="Причина">
				<option value=""></option>
				@foreach($reasons as $reason)
			  		<option value="{{$reason->id}}">{{$reason->name}}</option>
					}
			  	@endforeach	
			</select>

			<h5>Оценка</h5>
			<select id='select-mark' name="mark" placeholder="Оценка">
				<option value=""></option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>

			<h5>Производственные задачи</h5>
			<input type="file" name="file">

			<h5>Качества</h5>
			<select id='select-characteristics' name="characteristics[]" placeholder="Качествва" multiple>
				<option value=""></option>
				@foreach($characteristics as $characteristic)
			  		<option value="{{$characteristic->id}}">{{$characteristic->charact}}</option>
					}
			  	@endforeach	
			</select>

			<h5>Объем выполнения</h5>
			<select id='select-volume' name="volume" placeholder="Объем">
				<option value=""></option>
				@foreach($volumes as $volume)
			  		<option value="{{$volume->id}}">{{$volume->volume}}</option>
					}
			  	@endforeach	
			</select>

			<h5>Замечания</h5>
			<select id='select-remarks' name="remarks[]" placeholder="Замечания" multiple>
				<option value=""></option>
				@foreach($remarks as $remark)
			  		<option value="{{$remark->id}}">{{$remark->remarks}}</option>
					}
			  	@endforeach	
			</select>

			<h5>Как справлялся с проблемами</h5>
			<select id='select-problem' name="problem[]" placeholder="Спавлялся с проблемами" multiple>
				<option value=""></option>
				@foreach($problems as $problem)
			  		<option value="{{$problem->id}}">{{$problem->name}}</option>
					}
			  	@endforeach	
			</select>

			<input type="submit">
		</form>
	</div>
	<script>
	 $(document).ready(function () {
	      $('select').selectize({
	          sortField: 'text'
	      });
	  });
	</script>
</body>
</html>