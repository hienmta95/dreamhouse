@extends('backend::layouts.main')
@section('page_title')
Quản lý lĩnh vực
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li class="active">Quản lý lĩnh vực</li>
</ul>
@endsection
@section('content')
<div class="sp-push-index">
    {{--<h1>Dreamhouse quản lý Admin</h1>--}}
    <p>
        <a class="btn btn-success" href="{{ route('backend.linhvuc.create') }}">Tạo mới lĩnh vực</a>
    </p>
    <div class="grid-view" id="w0">
        <div class="summary">
            <table class="table table-striped table-bordered table-style" id="linhvuc-table">
                <thead>
                    <tr>
                        <th class="un-orderable-col">#</th>
                        <th class="orderable-col">ID</th>
                        <th class="un-orderable-col">Tên lĩnh vực</th>
                        <th class="un-orderable-col">Tên trên link</th>
                        <th class="un-orderable-col">Giới thiệu</th>
                        <th class="orderable-col">Số hoạt động</th>
                        <th class="orderable-col">Ngày lập</th>
                        <th class="un-orderable-col">Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var table = $('#linhvuc-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        pageLength: 20,
        lengthChange: false,
        lengthMenu: [10, 20, 50, 100],
        ajax: '{!! route('backend.linhvuc.indexData') !!}',
        dom: '<"top"i>rt<"bottom"p><"clear">',
        order: [ [1, "desc"] ],
        language: {
            paginate: {
                previous: "«",
                next: "»"
            }
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', orderable: false},
            {data: 'slug', name: 'slug', orderable: false},
            {data: 'introduce', name: 'introduce', orderable: false},
            {data: 'count', name: 'count'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "initComplete": function () {
            $('#linhvuc-table_paginate').css({"float": "left"});
            var r = $('#linhvuc-table tfoot tr');
            $('#linhvuc-table thead').append(r);
            this.api().columns().every(function (i) {
                if (i != 0 && i != 7 && i != 12) {
                    var column = this;
                    var table = $('#linhvuc-table').DataTable();
                    var input = document.createElement("input");
                    input.className = "form-control";
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val() ? $(this).val() : '', false, false,true).draw();
                        });
                    $('#linhvuc-table thead tr th input').css({"width": "100%", "margin": "0px 0px 0px 0px"});
                }
            });

        },
    });
</script>
@endpush