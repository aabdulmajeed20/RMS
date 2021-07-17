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
                        <form action="{{route('report.importExcel')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h2>Template File</h2>
                                <a href="{{asset('/Templates/reports.xlsx')}}">Excel Template</a>
                            </div>
                            <div class="form-group">
                                <h2>Import Reports</h2>
                                <label for=""><input type="file" name="excel" id="" accept="xlsx"> Import Excel File (.xlsx)</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary">Upload</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection