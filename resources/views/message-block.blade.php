@if(count($errors) > 0)
        <div class="col-md-12  alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
@endif
@if(Session::has('message'))
        <div class="col-md-12 alert alert-success">
            {{Session::get('message')}}
        </div>
@endif
@if(Session::has('error_message'))
        <div class="col-md-12  alert alert-danger ">
            {{Session::get('error_message')}}
        </div>
@endif