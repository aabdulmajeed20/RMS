@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Groups</h2>
                            </div>
                            <div class="col-md-6" style="text-align: end;">
                                <a class="btn btn-primary" href="{{route('settings.groups.create')}}">Create Group</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <td>{{$group->id}}</td>
                                        <td>{{$group->name}}</td>
                                        <td><a href="{{route('settings.groups.edit', ['id' => $group->id])}}" class="btn btn-warning">Edit</a></td>
                                        <td><a href="{{route('settings.groups.destroy', ['id' => $group->id])}}" class="btn btn-danger">Remove</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection