@extends('frontend::master')

@section('page_title')
    DreamGo - {{ $data['title'] }}
@endsection

@section('body_class', 'room-page')

@section('styles')

@endsection

@section('content')

    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ route('frontend.homepage') }}">Trang chủ</a></li>

                <li class="active">{{ isset($data['title']) ? $data['title'] : ""}}</li>
            </ol>
        </div>
    </div>
    <div id="content" class="product-content">
        @if(isset($data['images']))
        <div id="productGallery">
            <ul class="slider">
                @foreach($data['images'] as $key=>$item)
                    <li class="img-cover {{ $key == 0 ? "active" : "" }}">
                        <a href="javascript:void(0)" title="{{ $data['title'] }}">
                            <div class="img img-cover">
                                <img src="{{ asset('/').$item['url'] }}" alt="{{ $data['title'] }}" title="{{ $data['title'] }}" />
                            </div>
                            <div class="desc">
                                <div class="container">
                                    <h3>{{ $data['title'] }}</h3>
                                    <p>{!! $data['introduce'] !!}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="slider-action">
                <a href="#" class="prev"></a>
                <a href="#" class="next"></a>
            </div>

        </div>
        <div id="productThumb">
            <div class="container">
                <ul class="slider">
                    @foreach($data['images'] as $key=>$item)
                        <li class="img-cover {{ $key == 0 ? "active" : "" }}">
                            <a href="#" title="{{ $data['title'] }}">
                                <div class="img img-cover">
                                    <img src="{{ asset('/').$item['url'] }}" alt="{{ $data['title'] }}" title="{{ $data['title'] }}" />
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

        </div>
        @endif

        <div class="product-short-desc">
            <div class="container">
                <div class="title">
                    <h1 class="text-uppercase">{{ $data['title'] }}</h1>
                </div>
                <div class="text-wrap">
{{--                    <p style="text-align: justify;">{!! $data['introduce'] !!}</p>--}}

                    <p style="text-align: justify;">&nbsp;</p>

                </div>
            </div>
        </div>

        <div class="product-list">
            <div class=" container">
                <div class="row">
                    @if(isset($data['category']))
                    @foreach($data['category'] as $key=>$item)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="product">
                                <div class="img img-cover">
                                    <img src="{{ $item['image'] }}" />
                                    <div class="overlay">
                                        <a href="{{ route('frontend.get.category', ['id'=>$item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}" class="overlay-link">{{ $item['title'] }}</a>
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="social-share">
                                                        <a href="javascript:void(0)" class="btn btn-default btn-sm"><i class="fa fa-share-alt"></i></a>
                                                        <div class="social">
                                                            <ul>

                                                                <li><a class="share" data-network="facebook" href="https://www.facebook.com/sharer/sharer.php?app_id=113869198637480&amp;sdk=joey&amp;u={{ route('frontend.get.category', ['id' => $item['id'], 'slug' => $item['slug']]) }}&amp;display=popup&amp;ref=plugin&amp;src=share_button"><i class="fa fa-facebook"></i> Facebook</a></li>
                                                                <li><a class="share" data-network="twitter" href="https://twitter.com/intent/tweet?hashtags=&amp;original_referer=https%3A%2F%2Fdev.twitter.com%2Fweb%2Ftweet-button&amp;ref_src=twsrc%5Etfw&amp;related=twitterapi%2Ctwitter&amp;text=&amp;tw_p=tweetbutton&amp;url={{ route('frontend.get.category', ['id' => $item['id'], 'slug' => $item['slug']]) }}"><i class="fa fa-twitter"></i> Twitter</a></li>
                                                                <li><a class="share" data-network="google" href="https://plus.google.com/share?url={{ route('frontend.get.category', ['id' => $item['id'], 'slug' => $item['slug']]) }}"><i class="fa fa-google-plus"></i> Google+</a></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="{{ route('frontend.get.category', ['id' => $item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}" class="btn btn-success btn-sm btn-detail">Chi tiết</a></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="desc">
                                    <h3 style="margin-bottom: 0">
                                        <a href="{{ route('frontend.get.category', ['id'=>$item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
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
                    $('#productGallery .slider>li .img').height($(window).width() * 0.4502196193265007);
                }
            });
            $(document).on('click', '#content.product-content .slider-action > a.prev', function (e) {
                e.preventDefault();
                $gallery.stop(0).goToPrevSlide();
            });
            $(document).on('click', '#content.product-content .slider-action > a.next', function (e) {
                e.preventDefault();
                $gallery.stop(0).goToNextSlide();
            });

            var $thumb = $('#productThumb .slider').lightSlider({
                item: 10,
                slideMove: 1,
                slideMargin: 10,
                enableDrag: false,
                controls: false,
                pager: false,
                responsive: [
                    {
                        breakpoint: 1280,
                        settings: {
                            item: 8,
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
        })(jQuery);
    </script>

@endsection
