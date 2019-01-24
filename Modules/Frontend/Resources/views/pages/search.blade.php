@extends('frontend::master')

@section('page_title', 'DreamGo - Tìm kiếm')

@section('body_class', 'tim-kiem')

@section('styles')

@endsection

@section('content')

    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ route('frontend.homepage') }}">Trang chủ</a></li>
                <li class="active">Kết quả tìm kiếm: {{ $keyword }}</li>
            </ol>
        </div>
    </div>
    <div id="content" class="product-content">
        <div class="container">
            <div class="title">
                <div class="tbl">
                    <div class="tbl-cell title-h1">
                        <h1>Kết quả tìm kiếm: {{ $keyword }}</h1>
                    </div>
                    <div class="tbl-cell total-product"></div>
                    <div class="tbl-cell filter">
                    </div>
                </div>
            </div>
            <div class="product-list" id="page-pro">
                <div class="row">
                    @foreach($data as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="product">
                            <div class="img img-cover">
                                <img src="{{ asset('/').$item['images'][0]['url'] }}"/>
                                <div class="overlay">
                                    <a href="{{ route('frontend.get.product', ['slug' => $item['slug']]) }}" title="{{ $item['title'] }}" class="overlay-link">{{ $item['title'] }}</a>
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="social-share">
                                                    <a href="javascript:void(0)" class="btn btn-default btn-sm"><i class="fa fa-share-alt"></i></a>
                                                    <div class="social">
                                                        <ul>

                                                            <li><a class="share" data-network="facebook" href="https://www.facebook.com/sharer/sharer.php?app_id=113869198637480&sdk=joey&u={{ route('frontend.get.product', ['slug' => $item['slug']]) }}&display=popup&ref=plugin&src=share_button"><i class="fa fa-facebook"></i> Facebook</a></li>
                                                            <li><a class="share" data-network="twitter" href="https://twitter.com/intent/tweet?hashtags=&original_referer=https%3A%2F%2Fdev.twitter.com%2Fweb%2Ftweet-button&ref_src=twsrc%5Etfw&related=twitterapi%2Ctwitter&text=&tw_p=tweetbutton&url={{ route('frontend.get.product', ['slug' => $item['slug']]) }}"><i class="fa fa-twitter"></i> Twitter</a></li>
                                                            <li><a class="share" data-network="google" href="https://plus.google.com/share?url={{ route('frontend.get.product', ['slug' => $item['slug']]) }}"><i class="fa fa-google-plus"></i> Google+</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><a href="{{ route('frontend.get.product', ['slug' => $item['slug']]) }}" title="{{ $item['title'] }}" class="btn btn-default btn-sm btn-success">Chi tiết</a></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="short-desc">
                                                    {!! $item['description'] !!}
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="desc">
                                <h3>
                                    <a href="{{ route('frontend.get.product', ['slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a>
                                </h3>
                                <div class="price">
                                    <span class="new color-green">Liên hệ</span><span class="old"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{ $data->links() }}

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        (function ( $ ) {

        })(jQuery);
    </script>
@endsection
