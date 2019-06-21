@extends('teacher.admin-panel')
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
{{-- {{dd($comments)}} --}}
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">User Name</th>
        <th scope="col">comments</th>
        <th scope="col">course</th>
        <th scope="col">unit</th>
        <th scope="col">lesson</th>
        <th scope="col">Reply</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($questions as $question)
        <tr>
                <th scope="row">.</th>
                <td>{{$question->name}}</td>
                 <td>{{$question->question}}</td>
                <td>{{$question->C_name}}</td>
                <td>{{$question->U_name}}</td>
                <td>{{$question->L_name}}</td>
                <td><a href="/answer/{{$question->Q_id}}"><button type="button" class="btn btn-primary">Answer</button>
                </a></td>
              </tr>
        @endforeach
      
     
    </tbody>
  </table>
@endsection