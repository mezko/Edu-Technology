@extends('student.admin')
@section('content')
@if(Session::has('success-message'))
<div class="alert alert-success"> 
    <button type="button" 
        class="close" 
        data-dismiss="alert" 
        aria-hidden="true">&times;</button>
    {!! session()->get('success-message') !!} 
</div>
@endif
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
   
        <th scope="col">comments</th>
        <th scope="col">course</th>
        <th scope="col">unit</th>
        <th scope="col">lesson</th>
        <th scope="col">Replied</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
        <tr>
                <th scope="row">.</th>
            
                 <td>{{$comment->comment}}</td>
                <td>{{$comment->C_name}}</td>
                <td>{{$comment->U_name}}</td>
                <td>{{$comment->L_name}}</td>
                <td>{{$comment->text}}
                </a></td>
              </tr>
        @endforeach
      
     
    </tbody>
  </table>
@endsection