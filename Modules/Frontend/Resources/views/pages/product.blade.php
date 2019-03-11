@extends('frontend::master')

@section('page_title')
    DreamGo - {{ $data['title'] }}
@endsection

@section('body_class', 'product-page')

@section('styles')
    <link href="{{ asset('/') }}Content/Html/resources/css/jquery.fancybox.min.css" rel="stylesheet" />
@endsection

@section('content')

    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ route('frontend.homepage') }}">Trang chủ</a></li>
                <li><a href="{{ route('frontend.get.room', ['id' => $data['category']['room']['id'], 'slug' => $data['category']['room']['slug']]) }}">{{ $data['category']['room']['title'] }}</a></li>
                <li><a href="{{ route('frontend.get.category', ['id' => $data['category']['id'], 'slug' => $data['category']['slug']]) }}">{{ $data['category']['title'] }}</a></li>

                <li class="active">{{ $data['title'] }}</li>
            </ol>
        </div>
    </div>
    <div id="content" class="product-content detail-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <div id="productGallery">
                        <ul class="slider">
                            @foreach($data['images'] as $key=>$image)
                            <li class="img-cover {{ $key == 0 ? "active" : "" }}">
                                <a href="#" title="">
                                    <div class="img img-cover">
                                        <img src="{{ asset('/').$image['url'] }}" title="" alt="" />
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="slider-action">
                            <a href="javascript:void(0)" class="prev"></a>
                            <a href="javascript:void(0)" class="next"></a>
                        </div>

                    </div>
                    <div id="productThumb">
                        <ul class="slider">
                            @foreach($data['images'] as $key=>$image)
                                <li class="img-cover">
                                <a href="#" title="">
                                    <div class="img img-cover">
                                        <img src="{{ asset('/').$image['url'] }}" title="" alt="" />
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="slider-action">
                            <a href="javascript:void(0)" class="prev"></a>
                            <a href="javascript:void(0)" class="next"></a>
                        </div>

                    </div>

                    <div class="same-product">
                        <h2>Sản phẩm khác cùng loại</h2>
                        <ul class="slider">
                            @foreach($dataRelate as $item)
                                <li>
                                <div class="img img-cover">
                                    <a href="{{ route('frontend.get.product', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">
                                        <img src="{{ asset('/').$item['images'][0]['url'] }}" alt="{{ $item['title'] }}" title="{{ $item['title'] }}" />
                                    </a>
                                </div>
                                <div class="desc">
                                    <h3>
                                        <a href="{{ route('frontend.get.product', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a>
                                    </h3>
                                    <div class="new-price color-green">Liên hệ</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{--<div class="product-info">--}}
                        {{--<h2>L&#253; do lựa chon DreamGo</h2>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">--}}
                                {{--<div class="info">--}}
                                    {{--<div class="img img-cover">--}}
                                        {{--<img src="{{ asset('/').'Uploads/images/Lydo/giaxuat.jpg' }}" alt="Gi&#225; Xuất Xưởng" title="Gi&#225; Xuất Xưởng">--}}
                                    {{--</div>--}}

                                    {{--<div class="desc">--}}
                                        {{--<h3><a href="/gia-xuat-xuong">Gi&#225; Xuất Xưởng</a></h3>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">--}}
                                {{--<div class="info">--}}
                                    {{--<div class="img img-cover">--}}
                                        {{--<img src="{{ asset('/').'Uploads/images/Lydo/nguyenlieu.jpg' }}" alt="Nguy&#234;n liệu chọn lọc" title="Nguy&#234;n liệu chọn lọc">--}}
                                    {{--</div>--}}

                                    {{--<div class="desc">--}}
                                        {{--<h3><a href="/nguon-nguyen-lieu">Nguy&#234;n liệu chọn lọc</a></h3>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">--}}
                                {{--<div class="info">--}}
                                    {{--<div class="img img-cover">--}}
                                        {{--<img src="{{ asset('/').'Uploads/images/Lydo/tuvan.jpg' }}" alt="Tư vấn ph&#249; hợp nhu cầu" title="Tư vấn ph&#249; hợp nhu cầu">--}}
                                    {{--</div>--}}

                                    {{--<div class="desc">--}}
                                        {{--<h3><a href="/tu-van-phu-hop-nhu-cau">Tư vấn ph&#249; hợp nhu cầu</a></h3>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">--}}
                                {{--<div class="info">--}}
                                    {{--<div class="img img-cover">--}}
                                        {{--<img src="{{ asset('/').'Uploads/images/Lydo/baohanh.jpg' }}" alt="Chế độ bảo h&#224;nh tận t&#226;m" title="Chế độ bảo h&#224;nh tận t&#226;m">--}}
                                    {{--</div>--}}

                                    {{--<div class="desc">--}}
                                        {{--<h3><a href="/che-do-bao-hanh-tan-tam">Chế độ bảo h&#224;nh tận t&#226;m</a></h3>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}


                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <h1>{{ $data['title'] }}</h1>
                    <div class="product-code">Mã sản phẩm : <b>{{ $data['masanpham'] }}</b></div>

                    <ul style="box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; color: rgb(65, 65, 65); font-size: 14px;">
                        <li style="box-sizing: border-box;">Bảo hành : <strong>{{ $data['baohanh'] }}</strong><span style="box-sizing: border-box; font-weight: 700;"></span></li>
                        <li style="box-sizing: border-box;">Bảo trì : <span style="box-sizing: border-box; font-weight: 700;">Trọn đời</span></li>
                        <li style="box-sizing: border-box;">Thời gian đặt hàng : <span style="box-sizing: border-box; font-weight: 700;">20-25 ngày</span></li>
                        <li style="box-sizing: border-box;"><span style="box-sizing: border-box;">Chất liệu : <span style="font-weight: 700;"></span><b>{!! $data['chatlieu'] !!}</b></span></li>
                        <li style="box-sizing: border-box;">Kích thước : <span style="box-sizing: border-box; font-weight: 700;">{{ $data['kichthuoc'] }}</span></li>
                    </ul>

                    <div class="product-total">
                        <span id="total-price-add">Liên hệ</span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <a href="{{ route('frontend.get.lienhe') }}" title="Đặt hàng" class="btn-add-cart">Đặt hàng</a><br />
                        </div>

                    </div>
                    <ul class="criteria">
                        <li>
                            <span class="icon"><i class="fa fa-check"></i></span>
                            <span>Cam kết chất lượng</span>
                        </li>
                        <li>
                            <span class="icon"><i class="fa fa-truck"></i></span>
                            <span>Giao hàng tận nơi</span>
                        </li>
                        <li>
                            <span class="icon"><i class="fa fa-home"></i></span>
                            <span>Thanh toán tại nhà</span>
                        </li>
                    </ul>
                    <hr />
                    <div class="description">
                        <h2>Mô tả: </h2>
                        <div class="text-wrap">
                            {!! $data['description'] !!}

                            <p style="box-sizing: border-box; margin: 0px 0px 10px; color: rgb(65, 65, 65); font-size: 14px;">Hình ảnh sản phẩm thuộc bản quyền của DreamGo, ảnh thực tế tại showroom của DreamGo.</p>

                        </div>
                        {{--<div class="fb-comment">--}}
                            {{--<div class="fb-comments" data-href="http://DreamGo.com/sofa-go/sofa-go-oc-cho-nhap-khau-s-113" data-numposts="5"></div>--}}
                        {{--</div>--}}
                        <div class="ads-share">
                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox_hi7k"></div>

                        </div>
                        <hr />
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{--<script src="../Content/Html/resources/js/jquery.fancybox.min.js"></script>--}}
    <script>
        (function ( $ ) {

            var $gallery = $('#productGallery .slider').lightSlider({
                mode: 'fade',
                item: 1,
                thumbItem: 9,
                controls: false,
                slideMargin: 0,
                enableDrag: false,
                auto: true,
                pause: 4000,
                loop: true,
                pager: false,
                onBeforeSlide: function (el) {
                    $thumb.stop(0).goToSlide(el.getCurrentSlideCount() - 1);
                },
                onBeforeStart: function () {
                    $('#productGallery .slider>li .img').height($('#productGallery').width() * 0.5952380952380952380952380952381);
                }
            });
            $(document).on('click', '#content.product-content .slider-action > a.prev', function (e) {
                $gallery.stop(0).goToPrevSlide();
            });
            $(document).on('click', '#content.product-content .slider-action > a.next', function (e) {
                $gallery.stop(0).goToNextSlide();
            });

            var $thumb = $('#productThumb .slider').lightSlider({
                item: 8,
                slideMove: 1,
                slideMargin: 10,
                enableDrag: false,
                controls: false,
                pager: false,
                responsive: [
                    {
                        breakpoint: 1280,
                        settings: {
                            item: 7,
                            slideMove: 1
                        }
                    }, {
                        breakpoint: 1024,
                        settings: {
                            item: 6,
                            slideMove: 1
                        }
                    }, {
                        breakpoint: 992,
                        settings: {
                            item: 5,
                            slideMove: 1
                        }
                    }, {
                        breakpoint: 768,
                        settings: {
                            item: 4,
                            slideMove: 1
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            item: 3,
                            slideMove: 1
                        }
                    }, {
                        breakpoint: 320,
                        settings: {
                            item: 2,
                            slideMove: 1
                        }
                    }
                ]
            });
            $(document).on('click', '#productThumb .slider>li>a', function (e) {
                e.preventDefault();
                $gallery.stop(0).goToSlide($(this).parent().index() + 1);
            });

            $('.same-product .slider').lightSlider({
                item: 4,
                slideMargin: 18,
                enableDrag: false,
                pager: false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            item: 3
                        }
                    }, {
                        breakpoint: 768,
                        settings: {
                            item: 2
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            item: 1
                        }
                    }
                ]
            });

        })(jQuery);
    </script>

@endsection
