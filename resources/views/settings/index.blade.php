@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h1>Settings</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{route('settings.users.index')}}" class="btn btn-outline-primary btn-lg" style="width: 100%">Users</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('settings.groups.index')}}" class="btn btn-outline-primary btn-lg" style="width: 100%">Groups</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('settings.tags.index')}}" class="btn btn-outline-primary btn-lg" style="width: 100%">Tags</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection