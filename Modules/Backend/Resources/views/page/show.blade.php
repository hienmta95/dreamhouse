@extends('backend::layouts.main')
@section('page_title')
{{ $page->title ? $page->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.page.index') }}">Danh sách</a></li>
    <li class="active">{{ $page->title ? $page->title : "" }}</li>
</ul>
@endsection
@section('content')
{{--    <h1>{{ $page->title ? $page->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.page.destroy', $page->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.page.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.page.edit', $page->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $page->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $page->title }}</td></tr>
            <tr><th>Link</th><td>{!! $page->slug ? $page->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Mô tả</th><td>{!! $page->content ? $page->content : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Kích hoạt</th><td>{{ $page->kichhoat == 1 ? "yes" : "no" }}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $page->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $page->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
