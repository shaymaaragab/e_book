@extends('master')
@section('content')
<div class="container">
	<h1>{{$section->section_name}}</h1><br/>
    <table class="table">
    	<form action="{{route('book.store')}}" method="post">
            <!--
                one to many
            -->
             {!! csrf_field() !!}
    		<input type="hidden" name="section_id" value="{{$section->id}}" />
    		<tr>
    			<td>enter the title of the book :</td>
    			<td><input type="text" name="book_title"/></td>
    		</tr>
    		<tr>
    			<td>enter the edition number :</td>
    			<td><input type="text" name="book_edition"/></td>
    		</tr>
    		<tr>
    			<td>Describe the book :</td>
    			<td><input type="textarea" name="book_dscription"/></td>
    		</tr>
            <tr>
                <td>Another author :</td>
                <td><input type="text" name="another_author"/></td>
            </tr>
    		<tr>
    			<td><button class="btn btn-default" type="submit" >Add</button></td>
    		</tr>
    	</form>
    </table>


	<table class="table">
		<tr>
			<th><h3>book title</h3></th>
			<th><h3>book edition</h3></th>
			<th><h3>book descreption</h3></th>
			<th></th>
			<th></th>
		</tr>
        <?php $i=0; ?>
		@foreach($all_books as $book)
		<tr>
            <form action="{{route('book.update',$book->id)}}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PATCH" />
        <input type="hidden" name="section_id" value="{{$section->id}}" />
			<td><input type="text" name="book_title" value="{{$book->book_title}}"/></td>
			<td><input type="text" name="book_edition" value="{{$book->book_edition}}" /></td>
        <td><input type="textarea" name="book_dscription" value="{{$book->book_dscription}}" /></td>
        <td>
            <?php $authors=$array_of_author[$i]; ?>
            @foreach($authors as $author)
            <a href="#"><span class="label label-info">{{$author->first_name}}</span></a>
            @endforeach
            <?php $i=$i+1; ?>
        </td>
			<td><button class="btn btn-default" type="submit" >Update</button></td>
         </form>
			<td>
                 <form action="{{route('book.destroy',$book->id)}}" method="post">
                   {!! csrf_field() !!}
                <input type="hidden" name="_method" value="Delete" />
                <input type="hidden" name="section_id" value="{{$section->id}}" />
             <button class="btn btn-default" type="submit" >Delete</button>
               </form>
            </td>
		</tr>
		@endforeach
	</table>
</div>
@stop
