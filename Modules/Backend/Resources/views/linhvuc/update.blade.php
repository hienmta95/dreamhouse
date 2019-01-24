@extends('backend::layouts.main')
@section('page_title')
    Sửa thông tin: {{ $linhvuc->title ? $linhvuc->title : ''}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
        <li><a href="{{ route('backend.linhvuc.index') }}">Dreamhouse linh vuc</a></li>
        <li><a href="{{ route('backend.linhvuc.show', $linhvuc->id) }}">{{ $linhvuc->title ? $linhvuc->title : ''}}</a></li>
        <li class="active">Update</li>
    </ul>
@endsection
@section('content')
    <h1>Sửa thông tin lĩnh vực: {{ $linhvuc->title ? $linhvuc->title : ''}}</h1>
    <div class="sp-push-form">
        <form action="{{ route('backend.linhvuc.update', $linhvuc->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên lĩnh vực <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ $linhvuc->title }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên hiển thị trên link <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" value="{{ $linhvuc->slug }}">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['introduce']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Giới thiệu</label>
                <textarea id="introduce_linhvuc" class="form-control{{ $errors->has('introduce') ? ' has-error' : '' }}" name="introduce" maxlength="255" rows="3">{{ $linhvuc->introduce }}</textarea>
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
    <script> CKEDITOR.replace('introduce_linhvuc'); </script>

@endpush



