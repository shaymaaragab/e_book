@extends('master')
@section('content')
<div class="content">
	<form action="{{route('login')}}" method="post">
              {!! csrf_field() !!}
       <table class="table" style="width: 50% ; margin: 0 auto;">
       @if(count($errors)>0)
       <tr>
       	<td colspan="2">
       		<div class="alert alert-danger">
       			<ul>
       			 @foreach($errors->all() as $error)
       			 <li>{{$error}}</li>
       			 @endforeach	
       			</ul>
       		</div>
       	</td>
       </tr>
       @endif
       <tr>
       	<td colspan="2">
       		<h1 class="well text-center">login form</h1>
       	</td>
       </tr>   
       <tr>
       	<td>Enter email address :</td>
       	<td>
       		<input type="email" name="email"/>
       	</td>
       </tr>
       <tr>
       	<td>Enter password :</td>
       	<td>
       		<input type="password" name="password"/>
       	</td>
       </tr>
       
       <tr>
       	<td>Remember me?</td>
       	<td>
       		<input type="checkbox" name="remember"/>
       	</td>
       </tr>
       <tr>
        <td colspan="2">
       		<button class="btn btn-default" type="submit" >Login</button>
       	</td>
              <td>
                     <a href="{{route('password.email')}}">forget your password</a>
              </td> 
       </tr>
	</table>
</form>
</div>
@stop