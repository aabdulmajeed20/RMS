@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h1>{{$report->name}}</h1>
                            </div>
                            <div class="col-md-4">
                                <h1>Group: {{$report->group->name}}</h1>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                @can('update', $report)
                                <a class="btn btn-primary" href="{{route('report.edit', ['id' => $report->id])}}">Update Report</a>
                                @endcan
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                @can('delete', $report)
                                <a class="btn btn-danger" href="{{route('report.destroy', ['id' => $report->id])}}">Delete Report</a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <h2>Content</h2>
                            <p class="content">{{$report->content}}</p>
                        </div>

                        <div class="form-group tags">
                            <h2>tags</h2>
                            @foreach ($report->tags as $tag)
                                <label>{{$tag->name}}</label>
                            @endforeach
                        </div>
                        <div class="form-group files">
                            <h2>Files</h2>
                            @foreach ($report->files as $file)
                                <label><a href="{{asset($file->path)}}">{{$file->name}}</a></label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection