@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                {{$report->name}}
                            </div>
                            <div class="col-md-6" style="text-align: end;">
                                @can('update', $report)
                                <button class="btn btn-primary">Update Report</button>
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

                        <h2>Content</h2>
                        <p class="content">{{$report->content}}</p>
                        <hr>
                        <h3>Files</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection