@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Create Report</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{route('report.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <h2>Report Name</h2>
                                <input type="text" name="report_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <h2>Report Group</h2>
                                <select name="group_id" id="" class="form-control">
                                    @foreach ($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group">
                                <h2>Content</h2>
                                <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <hr>
                            <h3>Files</h3>
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