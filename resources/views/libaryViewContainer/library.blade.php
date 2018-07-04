@extends('master')
@section('content')

		<div class="container" style="opacity: 0.9">
			<div class="row">
				<a href="{{route('admin')}}">sad</a>
				@foreach($sections as $section)
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="{{asset('/')}}{{$section->image_name}}">
						<h1><a class="btn btn-primary">{{$section->section_name}}</a></h1>
					</div>
				</div>
			</div>
       @endforeach
@stop