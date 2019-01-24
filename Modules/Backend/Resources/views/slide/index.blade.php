@extends('backend::layouts.main')
@section('page_title')
Dreamhouse slide
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li class="active">Dreamhouse slide</li>
</ul>
@endsection
@section('content')
<div class="sp-push-index">
    <h1>Dreamhouse slide</h1>
    <p>
        <a class="btn btn-success" href="{{ route('backend.slide.create') }}">Create slide</a>
    </p>
    <div class="grid-view" id="w0">
        <div class="summary">
            <table class="table table-striped table-bordered table-style" id="slide-table">
                <thead>
                    <tr>
                        <th class="un-orderable-col">#</th>
                        <th class="orderable-col">ID</th>
                        <th class="un-orderable-col">Hình ảnh</th>
                        <th class="un-orderable-col">Tiêu đề</th>
                        <th class="un-orderable-col">Link</th>
                        <th class="un-orderable-col">Hiển thị</th>
                        <th class="orderable-col">Created At</th>
                        <th class="un-orderable-col">Action</th>
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
    var table = $('#slide-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        pageLength: 20,
        lengthChange: false,
        lengthMenu: [10, 20, 50, 100],
        ajax: '{!! route('backend.slide.indexData') !!}',
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
            {data: 'image', name: 'image', orderable: false},
            {data: 'name', name: 'name', orderable: false},
            {data: 'link', name: 'link', orderable: false},
            {data: 'active', name: 'active', orderable: false},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "initComplete": function () {
            $('#slide-table_paginate').css({"float": "left"});
            var r = $('#slide-table tfoot tr');
            $('#slide-table thead').append(r);
            this.api().columns().every(function (i) {
                if (i != 0 && i != 7 && i != 12) {
                    var column = this;
                    var table = $('#slide-table').DataTable();
                    var input = document.createElement("input");
                    input.className = "form-control";
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val() ? $(this).val() : '', false, false,true).draw();
                        });
                    $('#slide-table thead tr th input').css({"width": "100%", "margin": "0px 0px 0px 0px"});
                }
            });
            $(".c_timezone").each(function () {
                var date = new Date($(this).text().replace(/-/g, "/") + " GMT+0000");
                if (date) {
                    $(this).text(moment(date.getTime()).format("YYYY-MM-DD HH:mm:ss"));
                }
            });

        },
    });
</script>
@endpush
