@extends('backend::layouts.main')
@section('page_title')
Tạo mới phần gồm 3 hình ảnh ở trang chủ
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.section.index', ['position'=>$position]) }}">Danh sách</a></li>
    <li class="active">Tạo mới phần gồm 3 hình ảnh ở trang chủ</li>
</ul>
@endsection
@section('content')
    {{--<h1>Create section</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.section.store', ['position'=>$position]) }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="form-group @if (count($errors->all())) {{$errors->has(['text1']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Text dòng đầu tiên</label>
                <input type="text" class="form-control{{ $errors->has('text1') ? ' has-error' : '' }}" name="text1" value="{{ old('text1') }}">
                <div class="help-block">@if($errors->has('text1')) {{ $errors->first('text1') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['text2']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Text dòng thứ 2</label>
                <input type="text" class="form-control{{ $errors->has('text2') ? ' has-error' : '' }}" name="text2" value="{{ old('text2') }}">
                <div class="help-block">@if($errors->has('text2')) {{ $errors->first('text2') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['link']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Link</label>
                <input type="text" class="form-control{{ $errors->has('link') ? ' has-error' : '' }}" name="link" value="{{ old('link') }}">
                <div class="help-block">@if($errors->has('link')) {{ $errors->first('link') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Hình ảnh <span class="required">*</span></label>
                <input id="input-b1" name="image" type="file" class="file" accept=".jpg,.gif,.png,.jpeg">
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')

    <script src="{!! asset('/backend/bower_components/ckeditor/ckeditor.js') !!}"></script>
    <script> CKEDITOR.replace('content_section'); </script>

    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>

@endpush
