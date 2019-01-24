@extends('backend::layouts.main')
@section('page_title')
{{ $room->title ? $room->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.room.index') }}">Danh sách</a></li>
    <li class="active">{{ $room->title ? $room->title : "" }}</li>
</ul>
@endsection
@section('content')
{{--    <h1>{{ $room->title ? $room->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.room.destroy', $room->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.room.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.room.edit', $room->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $room->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $room->title }}</td></tr>
            <tr><th>Link</th><td>{!! $room->slug ? $room->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Giới thiệu</th><td>{!! $room->introduce ? $room->introduce : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $room->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $room->updated_at }}</p></td></tr>
            <tr><th>Hình ảnh</th>
                <td>
                    @foreach($room->images as $img)
                        <span class="image-room"><img src="{{ asset('/').$img->url }}" /></span>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

@endsection

@push('css')
    <style>
        .image-room {
            max-width: 160px;
            margin: 5px;
            display: inline-block;
        }
        .image-room img{
            width: 100%;
        }
    </style>
@endpush

@push('scripts')

@endpush
