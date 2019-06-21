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
<div class="embed-responsive embed-responsive-21by9">
    
     {{-- {{dd(explode('=',$videos->video))}}  --}}
<iframe width="560" height="315" src="https://www.youtube.com/embed/{{$video_id[0][1]}}" 
    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <!----------------------tabs--------------------------------------->
  <nav class="nav nav-pills nav-fill">
  <ul class="nav nav-tabs">
        <li class="nav-item nav-link"><a href="#tab1" data-toggle="tab">comment</a></li>
        <li class="nav-item nav-link"><a href="#tab3" data-toggle="tab">Question</a></li>
    </ul>
</nav>
    <div class="tab-content">
        <div class="tab-pane" id="tab1">
         <form method="POST">
            @csrf
             <input type="hidden" value="comment" name="com_hid">
             <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Your Comment</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
                  </div>
                   <br>
                  <input type="submit" class="btn btn-primary btn-lg btn-block" value="submit">

         </form>
        </div>

        <!--------------------------------------Question Div------------------->
        <div class="tab-pane" id="tab3">
                <form method="POST">
                  @csrf
                        <input type="hidden" value="Question" name="com_hid">
                        <div class="input-group">
                               <div class="input-group-prepend">
                                 <span class="input-group-text">Your Question</span>
                               </div>
                               <textarea class="form-control" aria-label="With textarea" name="question"></textarea>
                             </div>
                              <br>
                              <input type="submit" class="btn btn-primary btn-lg btn-block" value="submit">           
                    </form>
                   </div>
    </div>
</div>
        </div>
    </div>


    <!-------script of tabs------------------>
    <script>
         $('.btnNext').click(function(){
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
});

  $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});
        </script>
@endsection