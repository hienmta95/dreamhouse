@extends('backend::layouts.main')
@section('page_title')
Update slide: {{ $slide->name ? $slide->name : ''}}
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.slide.index') }}">Dreamhouse slide</a></li>
    <li><a href="{{ route('backend.slide.show', $slide->id) }}">{{ $slide->name ? $slide->name : ''}}</a></li>
    <li class="active">Update</li>
</ul>
@endsection
@section('content')
    <h1>Update slide: {{ $slide->name ? $slide->name : ''}}</h1>
    <div class="sp-push-form">
        <form action="{{ route('backend.slide.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <div>
                    <img class="show-images"  class="img-thumbnail" src="{!! $slide->image ? asset('/').$slide->image->url : ""!!}" alt="web_image" title="image">
                </div>
                <label class="control-label">Hình ảnh <span class="required">*</span></label>
                <input type="hidden" name="image_old" value="{{ $slide->image_id  }}">
                <input id="input-b1" name="image" type="file" class="file" accept=".jpg,.gif,.png,.jpeg">
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <div class="form-group  @if (count($errors->all())) {{$errors->has(['name']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="role-name">Tiêu đề</label>
                <input id="role-name" class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" name="name" type="text" value="{{ $slide->name }}">
                <div class="help-block">@if($errors->has('name')) {{ $errors->first('name') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['link']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label" for="role-link">Link</label>
                <textarea id="role-link" class="form-control{{ $errors->has('link') ? ' has-error' : '' }}" name="link" maxlength="255" rows="3">{{ $slide->link }}</textarea>
                <div class="help-block">@if($errors->has('link')) {{ $errors->first('link') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['active']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Hiển thị hay không <span class="required">*</span></label>
                <div>
                    <label class="radio-inline"><input type="radio" name="active" value="0" required @if($slide->active == 0) {{ "checked" }} @endif><strong>Không</strong></label>
                    <label class="radio-inline"><input type="radio" name="active" value="1" required @if($slide->active == 1) {{ "checked" }} @endif><strong>Có</strong></label>
                </div>
                <div class="help-block">@if($errors->has('active')) {{ $errors->first('active') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('backend/bower_components/bootstrap-fileinput/css/fileinput-rtl.css')?>" type="text/css">
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/plugins/piexif.js') !!}"></script>
    <script src="{!! asset('backend/bower_components/bootstrap-fileinput/js/fileinput.js') !!}"></script>
@endpush
