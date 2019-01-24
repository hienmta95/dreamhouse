@extends('backend::layouts.main')
@section('page_title')
{{ $linhvuc->title ? $linhvuc->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.linhvuc.index') }}">Danh sách lĩnh vực</a></li>
    <li class="active">{{ $linhvuc->title ? $linhvuc->title : "" }}</li>
</ul>
@endsection
@section('content')
{{--    <h1>{{ $linhvuc->title ? $linhvuc->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.linhvuc.destroy', $linhvuc->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.linhvuc.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.linhvuc.edit', $linhvuc->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $linhvuc->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $linhvuc->title }}</td></tr>
            <tr><th>Link</th><td>{!! $linhvuc->slug ? $linhvuc->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Giới thiệu</th><td>{!! $linhvuc->introduce ? $linhvuc->introduce : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $linhvuc->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $linhvuc->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
