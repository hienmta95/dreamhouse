@extends('backend::layouts.main')
@section('page_title')
Tạo mới sản phẩm
@endsection
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('backend.dashboard') }}">Home</a></li>
    <li><a href="{{ route('backend.product.index') }}">Danh sách sp</a></li>
    <li class="active">Tạo mới sản phẩm</li>
</ul>
@endsection
@section('content')
    {{--<h1>Create product</h1>--}}
    <div class="sp-push-form">
        <form id="product_create" action="{{ route('backend.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group @if (count($errors->all())) {{$errors->has(['room_id']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chọn phòng</label>
                <select id="room_id" class="form-control selectpicker" data-live-search="true" name="room_id">
                    <option value="">Chọn</option>
                    @foreach ($room as $item)
                        <option value="{{ $item->id }}" {{ old('room_id')==$item->id ? "selected" : "" }}>{{ $item->title }}</option>
                    @endforeach
                </select>
                <div class="help-block">@if($errors->has('room_id')) {{ $errors->first('room_id') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['category_id']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chọn loại sản phẩm<span class="required">*</span></label>
                <select id="category_id" class="form-control" data-live-search="true" name="category_id" required>
                    <option value="">Chọn</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}" {{ old('category_id')==$item->id ? "selected" : "" }}>{{ $item->title }}</option>
                    @endforeach
                </select>
                <div class="help-block">@if($errors->has('category_id')) {{ $errors->first('category_id') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['title']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên sản phẩm<span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('title') ? ' has-error' : '' }}" name="title" value="{{ old('title') }}">
                <div class="help-block">@if($errors->has('title')) {{ $errors->first('title') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['slug']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Tên hiển thị trên link <span class="required">*</span></label>
                <input type="text" class="form-control{{ $errors->has('slug') ? ' has-error' : '' }}" name="slug" value="{{ old('slug') }}" placeholder="do-go-noi-that">
                <div class="help-block">@if($errors->has('slug')) {{ $errors->first('slug') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['masanpham']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Mã sản phẩm </label>
                <input type="text" class="form-control{{ $errors->has('masanpham') ? ' has-error' : '' }}" name="masanpham" value="{{ old('masanpham') }}">
                <div class="help-block">@if($errors->has('masanpham')) {{ $errors->first('masanpham') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['kichthuoc']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Kích thước </label>
                <input type="text" class="form-control{{ $errors->has('kichthuoc') ? ' has-error' : '' }}" name="kichthuoc" value="{{ old('kichthuoc') }}">
                <div class="help-block">@if($errors->has('kichthuoc')) {{ $errors->first('kichthuoc') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['baohanh']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Bảo hành</label>
                <input type="text" class="form-control{{ $errors->has('baohanh') ? ' has-error' : '' }}" name="baohanh" value="{{ old('baohanh') }}">
                <div class="help-block">@if($errors->has('baohanh')) {{ $errors->first('baohanh') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['price']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Giá bán</label>
                <input type="number" class="form-control{{ $errors->has('price') ? ' has-error' : '' }}" name="price" value="{{ old('price') }}">
                <div class="help-block">@if($errors->has('price')) {{ $errors->first('price') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['status']) ? 'has-error' : 'has-success'}} @endif" >
                <label class="control-label">Trạng thái</label>
                <input type="text" class="form-control{{ $errors->has('status') ? ' has-error' : '' }}" name="status" value="{{ old('status') }}">
                <div class="help-block">@if($errors->has('status')) {{ $errors->first('status') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['image']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Hình ảnh <span class="required">*</span></label>
                <input id="input-24" name="image[]" type="file" multiple>
                <div class="help-block">@if($errors->has('image')) {{ $errors->first('image') }} @endif</div>
            </div>

            <div class="form-group @if (count($errors->all())) {{$errors->has(['chatlieu']) ? 'has-error' : 'has-success'}} @endif">
                <label class="control-label">Chất liệu </label>
                <textarea id="chatlieu" class="form-control{{ $errors->has('chatlieu') ? ' has-error' : '' }}" name="chatlieu" maxlength="255" rows="3">{{ old('chatlieu') }}</textarea>
                <script type="text/javascript">
                    var editor = CKEDITOR.replace('chatlieu',{
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
                <label class="control-label">Giới thiệu </label>
                <textarea id="description" class="form-control{{ $errors->has('description') ? ' has-error' : '' }}" name="description" maxlength="255" rows="3">{{ old('description') }}</textarea>
                <script type="text/javascript">
                    var editor = CKEDITOR.replace('description',{
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
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')

    <script>
        $( document ).ready(function() {

            $('#room_id').change(function (e) {
                e.preventDefault();
                var formData = {
                    room_id: $(this).val(),
                };
                $.ajax({
                    type: 'GET',
                    url: '{!! route('backend.category.ajax') !!}',
                    dataType: 'html',
                    data: formData,
                    success: function (data) {
                        var result = jQuery.parseJSON(data);
                        console.log(result.response);
                        $('#category_id').html(result.response);
                    }
                });

            });

        });
    </script>
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
                    // "<img class='kv-preview-data file-preview-image' src='https://placeimg.com/800/460/nature'>",
                    // "<img class='kv-preview-data file-preview-image' src='https://placeimg.com/800/460/nature'>",
                ],
                initialPreviewConfig: [
                    // {caption: "Nature-1.jpg", size: 628782, width: "120px", url: "/admin/image/delete", key: 1},
                    // {caption: "Nature-2.jpg", size: 982873, width: "120px", url: "/admin/image/delete", key: 2},
                ],
            });
        });
    </script>
@endpush
