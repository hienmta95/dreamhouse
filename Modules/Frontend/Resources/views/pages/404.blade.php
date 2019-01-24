@extends('frontend::master')

@section('page_title', 'DreamGo - Errors')

@section('body_class', '404')

@section('styles')
    <style>

        .error-page-container { width: 80%; height:250px; margin: 0 auto; }
        .error-box { padding: 30px 40px; }
        .error-box { clear: both; overflow: hidden; }

        .error-page-content { text-align: center; }
        .error-page-mess { margin-top: 20px; font-size: 24px; }
        .error-page-link { margin-top: 10px; }
        .error-search-box { text-align:center; margin-top:22px; }

        .error-page-search { width:60%; border:1px solid #ccc; padding:6px 4px; }

    </style>
@endsection

@section('content')

    <div class="error-page-container">

        <div class="error-page-content">

            <div class="error-page-mess">Không tìm thấy đường dẫn này</div>

            <div class="error-page-link">Bạn có thể truy cập vào <a href="{{ route('frontend.homepage') }}" rel="home"><b>Trang chủ</b></a> hoặc sử dụng ô dưới đây để tìm kiếm.</div>
        </div>

        <div class="error-search-box">
            <form id="frm_search_error" action="{{ route('frontend.search') }}">
                <input type="text" name="keyword" class="error-page-search">
                <input type="submit" class="form_button btn btn-primary btn-sm" value="Tìm kiếm">
            </form>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        (function ( $ ) {

        })(jQuery);

    </script>
@endsection
