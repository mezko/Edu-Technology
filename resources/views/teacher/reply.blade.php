@extends('teacher.admin-panel')
@section('content')
<table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">User Name</th>
            <th scope="col">comments</th>
            <th scope="col">course</th>
            <th scope="col">unit</th>
            <th scope="col">lesson</th>
         
          </tr>
        </thead>
        <tbody>
          
            <tr>
                    <th scope="row">.</th>
                    <td>{{$comments->name}}</td>
                     <td>{{$comments->comment}}</td>
                    <td>{{$comments->C_name}}</td>
                    <td>{{$comments->U_name}}</td>
                    <td>{{$comments->L_name}}</td>
               
                    </a></td>
                  </tr>
            
          
         
        </tbody>
      </table>
      <hr>
      <div class="tab-content">
           
             <form method="POST">
                @csrf
                <input type="hidden" value="{{$comments->id}}" name="user_id">
                 <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Your Relpy</span>
                        </div>
                        <textarea class="form-control" aria-label="With textarea" name="reply"></textarea>
                      </div>
                       <br>
                      <input type="submit" class="btn btn-primary btn-lg btn-block" value="submit">
    
             </form>
            </div>
@endsection