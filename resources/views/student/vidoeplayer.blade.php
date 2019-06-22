@extends('student.admin')
@section('content')
<!---image of course -->
<h1>{{$course->C_name}}</h1>
<img src="{{asset('uploads/courses/'.$course->pic)}}" class="img-fluid" alt="Responsive image" 
style="width:1200px;height: 300px">
<h1>
  Content:
</h1>
<!--content of course-->
<!--define the -->
@php
  $i=0;
  $len=count($content);
@endphp
@foreach ($content as $course_content)


<div class="col-md bg-light">
  @if($i>$len)
  @break
  @endif
 
  @if ($content[$i]->unit_id==$content[$i++]->unit_id )
<li class="nav-item">
    <a class="nav-link " href="#" data-toggle="collapse" data-target="#course{{$course_content->L_id}}" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-bookmark"></i>
    <span>chapter: {{$course_content->U_name}}</span>
    </a>
    
    {{-- {{dd($content[0]->name)}} --}}
  <div id="course{{$course_content->L_id}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header" href="buttons.html">Lessons:</h6>
      <a class="collapse-item" href="/course/video/{{$course_content->L_id}}">{{$course_content->L_name}}</a>
      </div>
    </div>


  </li>

</div>


  @endif
@endforeach
{{-- <script src="{{ asset('js/bootstrap.js') }}" defer></script>
<script>
  // Echo.channel('my-channel')
  //   .listen('my-event', (e) => {
  //       console.log(e);
  //   });
  window.Echo.channel('my-channel')
    .listen('my-event', (e) => {
        console.log(e);
    });
  </script> --}}
@endsection