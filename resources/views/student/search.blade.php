@extends('student.admin')
@section('content')

<div class="row">
    
  
    
  
     
  @foreach ($courses as $course)
  <div class="col-md-4">
    <a class="black-text" href="/course/page/{{$course->id}}"
      data-size="1600x1067">
      <img alt="picture" src="{{asset('uploads/courses/'.$course->pic)}}"
        class="img-fluid" style="height: 200px; width: 400px">
      <h3 class="text-center my-3">{{$course->C_name}}</h3>
    </a>
  </div>
  @endforeach
      
      
      
          
  
  

  </div>
@endsection