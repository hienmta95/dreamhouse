@extends('backend::layouts.main')
@section('page_title')
{{ $hoatdong->title ? $hoatdong->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.hoatdong.index') }}">Danh sách</a></li>
    <li class="active">{{ $hoatdong->title ? $hoatdong->title : "" }}</li>
</ul>
@endsection
@section('content')
{{--    <h1>{{ $hoatdong->title ? $hoatdong->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.hoatdong.destroy', $hoatdong->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.hoatdong.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.hoatdong.edit', $hoatdong->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $hoatdong->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $hoatdong->title }}</td></tr>
            <tr><th>Link</th><td>{!! $hoatdong->slug ? $hoatdong->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Thuộc lĩnh vực </th><td>{{ $hoatdong->linhvuc->title }}</td></tr>
            <tr><th>Mô tả</th><td>{!! $hoatdong->content ? $hoatdong->content : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Nổi bật</th><td>{{ $hoatdong->noibat == 1 ? "yes" : "no" }}</td></tr>
            <tr><th>Hình ảnh</th><td>{!! $hoatdong->image ? "<img  class='show-images' src='".asset('/').$hoatdong->image->url."' alt=''>" : "<span class='not-set'>(not set)</span>"!!}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $hoatdong->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $hoatdong->updated_at }}</p></td></tr>
        </tbody>
    </table>

@endsection

@push('scripts')

@endpush
