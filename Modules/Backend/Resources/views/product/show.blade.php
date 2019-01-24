@extends('backend::layouts.main')
@section('page_title')
{{ $product->title ? $product->title : "" }}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.product.index') }}">Danh sách sp</a></li>
    <li class="active">{{ $product->title ? $product->title : "" }}</li>
</ul>
@endsection
@section('content')
{{--    <h1>{{ $product->title ? $product->title : "" }}</h1>--}}
    <p>
        {!! Form::open(['route'=>['backend.product.destroy', $product->id], 'method'=>'DELETE']) !!}
        <a class="btn btn-success" href="{{ route('backend.product.create') }}">Tạo mới</a>
        <a class="btn btn-primary" href="{{ route('backend.product.edit', $product->id) }}">Sửa</a>
        {!! Form::submit('Xoá',['class'=>'btn btn-danger confirm','onclick'=>'return confirm("Are you sure you want to delete this item?");']) !!}
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <tr><th>ID</th><td>{{ $product->id }}</td></tr>
            <tr><th>Tiêu đề</th><td>{{ $product->title }}</td></tr>
            <tr><th>Link</th><td>{!! $product->slug ? $product->slug : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Thuộc loại sp</th><td>{{ $product->category->title }}</td></tr>
            <tr><th>Mã sản phẩm</th><td>{!! $product->masanpham ? $product->masanpham : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Kích thước </th><td>{!! $product->kichthuoc ? $product->kichthuoc : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Bảo hành</th><td>{!! $product->baohanh ? $product->baohanh : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Giá bán</th><td>{!! $product->price ? $product->price : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Trạng thái</th><td>{!! $product->status ? $product->status : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Chất liệu </th><td>{!! $product->chatlieu ? $product->chatlieu : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Giới thiệu </th><td>{!! $product->description ? $product->description : "<span class='not-set'>(not set)</span>"  !!}</td></tr>
            <tr><th>Ngày tạo</th><td><p class="c_timezone">{{ $product->created_at }}</p></td></tr>
            <tr><th>Ngày sửa</th><td><p class="c_timezone">{{ $product->updated_at }}</p></td></tr>
            <tr><th>Hình ảnh</th>
                <td>
                    @foreach($product->images as $img)
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
