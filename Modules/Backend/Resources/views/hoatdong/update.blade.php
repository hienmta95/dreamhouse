@extends('backend::layouts.main')
@section('page_title')
    Sửa thông tin: {{ $hoatdong->title ? $hoatdong->title : ''}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
        <li><a href="{{ route('backend.hoatdong.index') }}">Danh sach</a></li>
        <li><a href="{{ route('backend.hoatdong.show', $hoatdong->id) }}">{{ $hoatdong->title ? $hoatdong->title : ''}}</a></li>
        <li class="active">Update</li>
    </ul>
@endsection
@section('content')
    {{--    <h1>Sửa thông tin lĩnh vực: {{ $hoatdong->title ? $hoatdong->title : ''}}</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.hoatdong.update', $hoatdong->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['linhvuc_id']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chọn lĩnh vực <span class="required">*</span></label>
                <select class="form-control selectpicker" data-live-search="true" name="linhvuc_id" required>
                    @foreach ($linhvuc as $item)
                        @if(old('linhvuc_id'))
                            <option value="{{ $item->id }}" {{ old('linhvuc_id')==$item->id ? "selected" : "" }}>{{ $item->title }}</option>
                        @else
                            <option value="{{ $item->id }}" {{ $hoatdong->linhvuc->id==$item->id ? "selected" : "" }}>{{ $item->title }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block">@if($errors->has('linhvuc_id')) {{ $errors->first('linhvuc_id') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên sản phẩm <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ $hoatdong->title }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên hiển thị trên link <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" value="{{ $hoatdong->slug }}">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <div>
                    <img class="show-images"  class="img-thumbnail" src="{!! $hoatdong->image ? asset('/').$hoatdong->image->url : ""!!}" alt="web_image" title="image">
                </div>
                <label class="control-label">Hình ảnh <span class="required">*</span></label>
                <input type="hidden" name="image_old" value="{{ $hoatdong->image_id  }}">
                <input id="input-b1" name="image" type="file" class="file" accept=".jpg,.gif,.png,.jpeg">
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['ngaythang']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Ngày lập <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('ngaythang') ? ' has-error' : '' }}" name="ngaythang" value="{{ $hoatdong->ngaythang }}">
                <div class="help-block">@if($errors->has('ngaythang')) {{ $errors->first('ngaythang') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['content']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Giới thiệu</label>
                <textarea id="content_hoatdong" class="form-control{{ $errors->has('content') ? ' has-error' : '' }}" name="content" maxlength="255" rows="3">{{ $hoatdong->content }}</textarea>
                <div class="help-block">@if($errors->has('content')) {{ $errors->first('content') }} @endif</div>
            </div>

            <div class="form-group">
                <label class="control-label">Nổi bật</label>
                <div>
                    <label class="radio-inline"><input type="radio" name="noibat" value="1" {{ $hoatdong->noibat == 1 ? "checked" : "" }}>Yes</label>
                    <label class="radio-inline"><input type="radio" name="noibat" value="0" {{ $hoatdong->noibat == 0 ? "checked" : "" }}>No</label>
                </div>
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
    <script> CKEDITOR.replace('content_hoatdong'); </script>

    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>

@endpush
