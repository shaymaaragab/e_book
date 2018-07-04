@extends('master')
@section('content')
<div class="content">
	<form action="{{route('register')}}" method="post">
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
                     <h1 class="well text-center">send password reset link</h1>
              </td>
       </tr>  
       <tr>
              <td>Enter email address :</td>
              <td>
                     <input type="email" name="email"/>
              </td>
       </tr>
       <tr>
        <td colspan="2">
                     <button class="btn btn-default" type="submit" >send password reset link</button>
              </td>
       </tr>
       </table>
</form>
</div>
@stop