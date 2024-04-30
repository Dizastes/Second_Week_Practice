
<!DOCTYPE html>
<html lang="en">

<body>
	<style>
		table, th, td {
		  border:1px solid black;
		}
	</style>
	<table>
		@foreach ($info as $items)
			@foreach ($items as $key => $item)
				<tr>
					<th>{{$key}}</th>
				</tr>
				@foreach($item as $mini_item)
					<tr>
						<td>{{$mini_item->name}}</td>
					</tr>
				@endforeach
			@endforeach
		@endforeach
	</table>
</body>
</html>
