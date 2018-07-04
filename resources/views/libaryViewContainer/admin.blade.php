@extends('master')
@section('content')

<div class="container">
  <script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
  <script type="text/javascript">
    $(function() {
       $('#errorMsg').hide();
      var files;
      $('input[name="image"]').change(function(e){
        files=e.target.files;
      });
      $('#createSection').submit(function(e){
        e.preventDefault();
        var _token=$('input[name="_token"]').val();
        var section_name=$('input[name="section_name"]').val();
        var data=new formData();
        data.append('_token',_token);
        data.append('section_name',section_name,);
        $.each(files,function(k,v){
          data.append('image',v);
         });
        $.ajax({
          url:'store',
          type:'post',
          data:data,
          contentType:"multipart/form-data",
          processData:false,
          success:function(data){
            alert('section created successfully!');
          },
          errors:function(data){
            $('#errorMsg').show();
            $('#errorMsg').html('');
            var errors=data.responseJSON;
            $.each(errors,function(k,v){
               $('#errorMsg').append(v+"<br/>");
            });
          }
        });
      });
   });
  </script>
  <a href="{{route('library.index')}}">library</a>
<div class="panel panel-default">
	<div class="panel-heading">magiration section</div>
    <div class="panel-body">
    	<h2><br/>creating new section</h2><hr/>
    	<div class="alert alert-danger" id="errorMsg"></div>
      @if(count($errors)>0)
      
          <div class="alert alert-danger">
            <ul>
             @foreach($errors->all() as $error)
             <li>{{$error}}</li>
             @endforeach  
            </ul>
                     </div>
       
       @endif
    	<!--create new section -->
    	<form action="{{route('library.store')}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
    		enter the name of the section :<input type="text" name="section_name"/><br/>
    		upload an image: <input type="file" name="image"/><br/>
    		<button class="btn btn-default" type="submit" >create</button>
    	</form>	
    </div>

   @if($sections !=null)
   <table class="table">
    <tr>
      <th><h3>section name</h3></th>
      <th><h3>total book</h3></th>
      <th><h3>update</h3></th>
      <th><h3>delete</h3></th>
    </tr>
    @foreach($sections as $section)
    @if($section->trashed())
    <tr style="background-color:#CA3C3C ">
      @else
      <tr style="background-color:#fff ">
        @endif
      <!--update existing item -->
      <form action="{{route('library.update',$section->id)}}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PATCH" />
        <td>
        <input type="text" name="section_name" value="{{$section->section_name}}">
       </td>
       <td>
         <span class="lable lable-default">{{$section->book_total}}</span>
       </td>
       <td>
        <button class="btn btn-default" type="submit" >Update</button>
        <!--<img src="{{asset('/image/download (5).jpg')}}" onclick="submit()"/>-->
       </td>
      </form>
      @if($section->trashed())
      <td>
        <form action="{{route('library.delete-forever',$section->id)}}" method="post">
        {!! csrf_field() !!}
        <button class="btn btn-default" type="submit" >delete-forever1</button>
      </form>
      </td>
      @else
      <td>
        <!--Delete sepeific section -->
       <form action="{{route('library.destroy',$section->id)}}" method="post">
          {!! csrf_field() !!}
          <input type="hidden" name="_method" value="DELETE" />
          <button class="btn btn-default" type="submit" >Delete</button>
          <!-- <img src="{{asset('/image/download (5).jpg')}}" onclick="submit()"/>-->
        </form>
      </td>
      <td>
        <a href="{{route('library.show',$section->id)}}" class="btn btn-default">Show</a>
      </td>
      @endif
      @if($section->trashed())
      <td>
        <form action="{{route('library.restore',$section->id)}}" method="post">
        {!! csrf_field() !!}
        <button class="btn btn-default" type="submit" >Restore</button>
      </form>
      </td>
      @endif
    </tr> 
    @endforeach
   </table>
  @endif

</div>
</div>
@stop