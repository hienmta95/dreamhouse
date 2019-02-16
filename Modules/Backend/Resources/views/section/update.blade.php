@extends('backend::layouts.main')
@section('page_title')
    Sửa thông tin: {{ $section->text1 ? $section->text1 : ''}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
        <li><a href="{{ route('backend.section.index', ['position'=>$position]) }}">Danh sach</a></li>
        <li><a href="{{ route('backend.section.show', ['position'=>$position, 'id'=>$section->id]) }}">{{ $section->text1 ? $section->text1 : ''}}</a></li>
        <li class="active">Update</li>
    </ul>
@endsection
@section('content')
    {{--    <h1>Sửa thông tin lĩnh vực: {{ $section->title ? $section->title : ''}}</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.section.update', ['position'=>$position, 'id'=>$section->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['text1']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Text đầu tiên</label>
                <input type="text" class="form-control{{ $errors->has('text1') ? ' has-error' : '' }}" name="text1" value="{{ $section->text1 }}">
                <div class="help-block">@if($errors->has('text1')) {{ $errors->first('text1') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['text2']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Text thứ 2</label>
                <input type="text" class="form-control{{ $errors->has('text2') ? ' has-error' : '' }}" name="text2" value="{{ $section->text2 }}">
                <div class="help-block">@if($errors->has('text2')) {{ $errors->first('text2') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['link']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Link </label>
                <input type="text" class="form-control{{ $errors->has('link') ? ' has-error' : '' }}" name="link" value="{{ $section->link }}">
                <div class="help-block">@if($errors->has('link')) {{ $errors->first('link') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <div>
                    <img class="show-images"  class="img-thumbnail" src="{!! $section->image ? asset('/').$section->image->url : ""!!}" alt="web_image" title="image">
                </div>
                <label class="control-label">Hình ảnh <span class="required">*</span></label>
                <input type="hidden" name="image_old" value="{{ $section->image_id  }}">
                <input id="input-b1" name="image" type="file" class="file" accept=".jpg,.gif,.png,.jpeg">
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
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
    <script> CKEDITOR.replace('content_section'); </script>

    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>

@endpush
