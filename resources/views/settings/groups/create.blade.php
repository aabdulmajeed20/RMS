@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h1>Create Group</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{route('settings.groups.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h2>Group Name</h2>
                                <input type="text" name="group_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <h2>Group's Users</h2>
                                @foreach ($users as $user)
                                    <label><input type="checkbox" name="users[]" id="users" value="{{$user->id}}">  {{$user->name}}</label>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection