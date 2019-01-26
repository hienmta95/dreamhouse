@extends('frontend::master')

@section('page_title')
    DreamGo - {{ $data['title'] }}
@endsection

@section('body_class', 'category-page')

@section('styles')

@endsection

@section('content')

    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ route('frontend.homepage') }}">Trang chủ</a></li>
                <li><a href="{{ route('frontend.get.room', ['id' => $data['room']['id'], 'slug' => $data['room']['slug']]) }}">{{ $data['room']['title'] }}</a></li>

                <li class="active">{{ $data['title'] }}</li>
            </ol>
        </div>
    </div>
    <div id="content" class="product-content">
        <div class="container">
            <div class="title">
                <div class="tbl">
                    <div class="tbl-cell title-h1">
                        <h1>{{ $data['title'] }}</h1>
                    </div>
                    <div class="tbl-cell total-product"><span class="total-count">Tìm thấy {{ count($data['product']) }} sản phẩm</span></div>
                    {{--<div class="tbl-cell filter">--}}
                        {{--<select class="form-control" id="select-order-price">--}}
                            {{--<option>Sắp xếp theo</option>--}}
                            {{--<option value="1"><a href="/22">Mới cập nhật</a></option>--}}
                            {{--<option value="2">Giá tăng dần</option>--}}
                            {{--<option value="3">Giá giảm dần</option>--}}
                        {{--</select>--}}
                        {{--<input type="hidden" id="seolink-type" value="{{ $data['slug'] }}"/>--}}
                    {{--</div>--}}
                </div>
                <div class="text-wrap"style="margin-top: 10px">
                    <p>{!! $data['content'] !!}</p>

                </div>
            </div>
            <div class="product-list" id="page-pro">
                <div class="row">

                    @foreach($data['product'] as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="product">
                                <div class="img img-cover">
                                    <img src="{{ asset('/').$product['images'][0]['url'] }}" />
                                    <div class="overlay">
                                        <a href="{{ route('frontend.get.product', ['id' => $product['id'], 'slug' => $product['slug']]) }}" title="{{ $product['title'] }}" class="overlay-link">{{ $product['title'] }}</a>
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="social-share">
                                                        <a href="javascript:void(0)" class="btn btn-default btn-sm"><i class="fa fa-share-alt"></i></a>
                                                        <div class="social">
                                                            <ul>

                                                                <li><a class="share" data-network="facebook" href="https://www.facebook.com/sharer/sharer.php?app_id=113869198637480&amp;sdk=joey&amp;u={{ route('frontend.get.product', ['id' => $product['id'], 'slug' => $product['slug']]) }}&amp;display=popup&amp;ref=plugin&amp;src=share_button"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                                <li><a class="share" data-network="twitter" href="https://twitter.com/intent/tweet?hashtags=&amp;original_referer=https%3A%2F%2Fdev.twitter.com%2Fweb%2Ftweet-button&amp;ref_src=twsrc%5Etfw&amp;related=twitterapi%2Ctwitter&amp;text=&amp;tw_p=tweetbutton&amp;url={{ route('frontend.get.product', ['id' => $product['id'], 'slug' => $product['slug']]) }}"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                                <li><a class="share" data-network="google" href="https://plus.google.com/share?url={{ route('frontend.get.product', ['id' => $product['id'], 'slug' => $product['slug']]) }}"><i class="fa fa-google-plus"></i>Google+</a></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="{{ route('frontend.get.product', ['id' => $product['id'], 'slug' => $product['slug']]) }}" title="{{ $product['title'] }}" class="btn btn-success btn-sm btn-detail">Chi tiết</a></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="short-desc">
                                                        {!! $product['description'] !!}
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h3>
                                        <a href="{{ route('frontend.get.product', ['id' => $product['id'], 'slug' => $product['slug']]) }}" title="{{ $product['title'] }}">{{ $product['title'] }}</a>
                                    </h3>
                                    <div class="price">
                                        <span class="new color-green">Liên hệ</span>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                <ul class="pagination">

                </ul>


            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        (function ( $ ) {

            String.prototype.getParamFromUrl = String.prototype.getParamFromUrl || function (name) {
                var temp = "[\?&#]" + name + "=([^&#]*)";
                var regex = new RegExp(temp);
                var results = regex.exec(this);
                if (!results)
                    return "";
                else
                    return results[1];
            };

        })(jQuery);
    </script>

@endsection
