@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h1>Create User</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{route('settings.users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h2>User Name</h2>
                                <input type="text" name="user_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <h2>User Email</h2>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <h2>User Password</h2>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <h2>User Role</h2>
                                <select name="role" id="" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <h2>User Groups</h2>
                                @foreach ($groups as $group)
                                    <label><input type="checkbox" name="groups[]" id="groups" value="{{$group->id}}">  {{$group->name}}</label>
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