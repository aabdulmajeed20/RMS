@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Reports List</h2>
                        </div>
                        <div class="col-md-6" style="text-align: end;">
                            <a class="btn btn-primary" href="{{route('report.create')}}">Create Report</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover" id="reports">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 10%">#</th>
                                <th style="width: 20%">Report Name</th>
                                <th style="width: 20%">Report Uploader</th>
                                <th style="width: 15%">
                                    <select id="groups">
                                            <option value="Group">Group</option>
                                            @foreach($groups as $group)
                                                <option value="{{$group->name}}">{{$group->name}}</option>
                                            @endforeach
                                    </select>
                                </th>
                                <th style="width: 15%">
                                    <select id="tags">
                                            <option value="Tags">Tags</option>
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->name}}">{{$tag->name}}</option>
                                            @endforeach
                                    </select>
                                </th>
                                <th style="width: 20%">Creation Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dataTable')
<script type="text/javascript">
    
    $(function () {
       var table =  $('#reports').DataTable(
            {
                pageLength: 50,
                lengthMenu: [ 25, 50, 75, 100],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('report.reportsJSON') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "report_name" },
                    { "data": "report_uploader" },
                    { "data": "report_group" },
                    { "data": "tags" },
                    { "data": "creation_date" }
                ],
                "columnDefs": [
                    { "orderable": false, "targets": 4 },
                    { "orderable": false, "targets": 3 },
                    { "orderable": false, "targets": 1 } 
                ],
                "order": [[ 0, "desc" ]]
            });
        // $("select").select2();
        $("#groups").change(function() {
            table
                .columns(3)
                .search($(this).val())
                .draw();
        });
        $("#tags").change(function() {
            table
                .columns(4)
                .search($(this).val())
                .draw();
        });
    });
</script>
@endsection
