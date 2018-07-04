@extends('master')
@section('content')
<div class="container">
	<h1 class="well text_center">library sumaary</h1>
	<table class="table">
		<tr>
			<th style="width: 25%">Section name</th>
			<th style="width: 25%">Book title</th>
			<th style="width: 25%">Book description</th>
			<th style="width: 25%">Authors</th>
		</tr>
		@foreach($results as $bookModel)
		<tr>
			<td>
				<a href="{{route('library.show',$bookModel->section->id)}}">
					<span class="label label_info">{{$bookModel->section->section_name}}</span>
				</a>
			</td>
			<td>
				{{$bookModel->book_title}}
			</td>
			<td>
				{{$bookModel->book_description}}
			</td>
			
				
		</tr>
		@endforeach
	</table>
</div>
@stop
