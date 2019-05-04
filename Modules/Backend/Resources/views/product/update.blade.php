@extends('backend::layouts.main')
@section('page_title')
    Sửa thông tin sp: {{ $product->title ? $product->title : ''}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
        <li><a href="{{ route('backend.product.index') }}">Dreamhouse product</a></li>
        <li><a href="{{ route('backend.product.show', $product->id) }}">{{ $product->title ? $product->title : ''}}</a></li>
        <li class="active">Update</li>
    </ul>
@endsection
@section('content')
    {{--    <h1>Sửa thông tin phòng: {{ $product->title ? $product->title : ''}}</h1>--}}
    <div class="sp-push-form">
        <form action="{{ route('backend.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['category_id']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chọn loại sp<span class="required">*</span></label>
                <select class="form-control selectpicker" data-live-search="true" name="category_id" required>
                    @foreach ($category as $item)
                        @if(old('category_id'))
                            <option value="{{ $item->id }}" {{ old('category_id')==$item->id ? "selected" : "" }}>{{ $item->title }}</option>
                        @else
                            <option value="{{ $item->id }}" {{ $product->category->id==$item->id ? "selected" : "" }}>{{ $item->title }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="help-block">@if($errors->has('category_id')) {{ $errors->first('category_id') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên sản phẩm <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ $product->title }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên hiển thị trên link<span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" value="{{ $product->slug }}">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['masanpham']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Mã sản phẩm </label>
                <input type="text" class="form-control{{ $errors->has('masanpham') ? ' has-error' : '' }}" name="masanpham" value="{{ $product->masanpham }}">
                <div class="help-block">@if($errors->has('masanpham')) {{ $errors->first('masanpham') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['kichthuoc']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Kích thước </label>
                <input type="text" class="form-control{{ $errors->has('kichthuoc') ? ' has-error' : '' }}" name="kichthuoc" value="{{ $product->kichthuoc }}">
                <div class="help-block">@if($errors->has('kichthuoc')) {{ $errors->first('kichthuoc') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['baohanh']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Bảo hành</label>
                <input type="text" class="form-control{{ $errors->has('baohanh') ? ' has-error' : '' }}" name="baohanh" value="{{ $product->baohanh }}">
                <div class="help-block">@if($errors->has('baohanh')) {{ $errors->first('baohanh') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['price']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Giá bán</label>
                <input type="number" class="form-control{{ $errors->has('price') ? ' has-error' : '' }}" name="price" value="{{ $product->price }}">
                <div class="help-block">@if($errors->has('price')) {{ $errors->first('price') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['status']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Trạng thái</label>
                <input type="text" class="form-control{{ $errors->has('status') ? ' has-error' : '' }}" name="status" value="{{ $product->status }}">
                <div class="help-block">@if($errors->has('status')) {{ $errors->first('status') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Hình ảnh <span class="required">*</span></label>
                <input id="input-24" name="image[]" type="file" multiple>
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['chatlieu']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chất liệu</label>
                <textarea id="chatlieu_product" class="form-control{{ $errors->has('chatlieu') ? ' has-error' : '' }}" name="chatlieu" maxlength="255" rows="3">{{ $product->chatlieu }}</textarea>
                <script type="text/javascript">
                    var editor = CKEDITOR.replace('chatlieu_product',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('chatlieu')) {{ $errors->first('chatlieu') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['description']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Giới thiệu</label>
                <textarea id="description_product" class="form-control{{ $errors->has('description') ? ' has-error' : '' }}" name="description" maxlength="255" rows="3">{{ $product->description }}</textarea>
                <script type="text/javascript">
                    var editor = CKEDITOR.replace('description_product',{
                        language:'vi',
                        filebrowserBrowseUrl :'/js/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/js/ckfinder/ckfinder.html?type=Images',
                        filebrowserFlashBrowseUrl : '/js/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                    });
                </script>
                <div class="help-block">@if($errors->has('description')) {{ $errors->first('description') }} @endif</div>
            </div>

            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')

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
                    @foreach($product->images as $item)
                        "<img class='kv-preview-data file-preview-image' src='{{ asset('/').$item->url }}'>",

                    @endforeach
                ],
                initialPreviewConfig: [
                    @foreach($product->images as $item)
                        {caption: "{{ $item->name }}", width: "120px", url: "/admin/product/image/delete/{{ $product->id }}", key: {{ $item->id }} },
                    @endforeach
                ],
            });
        });
    </script>

@endpush
