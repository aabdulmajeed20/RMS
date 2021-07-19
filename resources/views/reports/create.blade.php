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
                        @include('message-block')
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{route('report.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h2>Report Name</h2>
                                <input type="text" name="report_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <h2>Report Group</h2>
                                <select name="group_id" id="" class="form-control" required>
                                    @foreach ($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group">
                                <h2>Content</h2>
                                <textarea name="content" id="" cols="30" rows="10" class="form-control" required></textarea>
                            </div>

                            <div class="form-group tags">
                                <h2>tags</h2>
                                @foreach ($tags as $tag)
                                    <label><input type="checkbox" name="tags[]" value="{{$tag->id}}" id="tags">  {{$tag->name}}</label>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <h2>Files</h2>
                                <label for=""><input type="file" name="files[]" id="" multiple> (You can add multiple files)</label>
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