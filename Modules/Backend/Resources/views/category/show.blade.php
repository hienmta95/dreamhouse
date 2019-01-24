@extends('backend::layouts.main')
@section('page_title')
{{ $category->title ? $category->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.category.index') }}">Danh sách loại sp</a></li>
    <li class="active">{{ $category->title ? $category->title : "" }}</li>
</ul>
@endsection
@section('content')
{{--    <h1>{{ $category->title ? $category->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.category.destroy', $category->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.category.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.category.edit', $category->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $category->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $category->title }}</td></tr>
            <tr><th>Link</th><td>{!! $category->slug ? $category->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Thuộc phòng</th><td>{{ $category->room->title }}</td></tr>
            <tr><th>Mô tả</th><td>{!! $category->content ? $category->content : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Hình ảnh</th><td>{!! $category->image ? "<img  class='show-images' src='".asset('/').$category->image->url."' alt=''>" : "<span class='not-set'>(not set)</span>"!!}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $category->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $category->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
