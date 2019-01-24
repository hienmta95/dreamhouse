@extends('backend::layouts.main')
@section('page_title')
    Sửa thông tin phòng: {{ $room->title ? $room->title : ''}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
        <li><a href="{{ route('backend.room.index') }}">Danh sách</a></li>
        <li><a href="{{ route('backend.room.show', $room->id) }}">{{ $room->title ? $room->title : ''}}</a></li>
        <li class="active">Update</li>
    </ul>
@endsection
@section('content')
    <h1>Sửa thông tin phòng: {{ $room->title ? $room->title : ''}}</h1>
    <div class="sp-push-form">
        <form action="{{ route('backend.room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên phòng<span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ $room->title }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên hiển thị trên link<span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" value="{{ $room->slug }}">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Hình ảnh </label>
                <input id="input-24" name="image[]" type="file" multiple>
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['introduce']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Giới thiệu</label>
                <textarea id="introduce_room" class="form-control{{ $errors->has('introduce') ? ' has-error' : '' }}" name="introduce" maxlength="255" rows="3">{{ $room->introduce }}</textarea>
                <div class="help-block">@if($errors->has('introduce')) {{ $errors->first('introduce') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')

    <script src="{!! asset('/backend/bower_components/ckeditor/ckeditor.js') !!}"></script>
    <script> CKEDITOR.replace('introduce_room'); </script>
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">

    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/sortable.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/purify.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>

    <script>
        $(document).on('ready', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#input-24").fileinput({
                // uploadUrl: "/upload",
                maxFileCount: 10,
                validateInitialCount: true,
                overwriteInitial: false,
                allowedFileExtensions: ["jpg", "png", "gif", "jpeg"],
                initialPreview: [
                    @foreach($room->images as $item)
                        "<img class='kv-preview-data file-preview-image' src='{{ asset('/').$item->url }}'>",

                    @endforeach
                ],
                initialPreviewConfig: [
                    @foreach($room->images as $item)
                        {caption: "{{ $item->name }}", width: "120px", url: "/admin/room/image/delete/{{ $room->id }}", key: {{ $item->id }} },
                    @endforeach
                ],
            });
        });
    </script>

@endpush



