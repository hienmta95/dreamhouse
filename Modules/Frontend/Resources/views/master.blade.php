<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="#" rel="shortcut icon" type="image/x-icon">
    <meta http-equiv="content-language" content="vi">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>
            @yield('page_title')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sofa gỗ &#243;c ch&#243;, b&#224;n ăn gỗ &#243;c ch&#243;, giường ngủ gỗ &#243;c ch&#243;, Tủ bếp đẹp, ph&#242;ng ngủ đẹp, tủ thờ hiện đại, Đồ gỗ &#243;c ch&#243;, kệ tivi, tủ quần &#225;o,">
    <meta name="keywords" content="Sofa gỗ &#243;c ch&#243;, b&#224;n ăn gỗ &#243;c ch&#243;, giường ngủ gỗ &#243;c ch&#243;, Tủ bếp đẹp, ph&#242;ng ngủ đẹp, tủ thờ hiện đại, Đồ gỗ &#243;c ch&#243;, kệ tivi, tủ quần &#225;o,">
    <meta name="robots" content="noodp,index,follow">
    <meta name="revisit-after" content="1 days">
    <meta property="og:image">
    <meta property="og:title" content="Sofa gỗ &#243;c ch&#243;, b&#224;n ăn gỗ &#243;c ch&#243;, giường ngủ gỗ &#243;c ch&#243;, Tủ bếp đẹp, ph&#242;ng ngủ đẹp, tủ thờ hiện đại, Đồ gỗ &#243;c ch&#243;, kệ tivi, tủ quần &#225;o,">
    <meta property="og:description" content="Sofa gỗ &#243;c ch&#243;, b&#224;n ăn gỗ &#243;c ch&#243;, giường ngủ gỗ &#243;c ch&#243;, Tủ bếp đẹp, ph&#242;ng ngủ đẹp, tủ thờ hiện đại, Đồ gỗ &#243;c ch&#243;, kệ tivi, tủ quần &#225;o,">
    <meta property="og:site_name" content="Dreamgo">
    <meta property="og:url" content="">
    <meta property="og:type" content="article">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=vietnamese" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset("images/favicon.ico")}}" />

    <link href="{{ asset('Content/Html/resources/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('Content/Html/resources/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('Content/Html/resources/css/lightslider.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('Content/Html/resources/css/sweetalert.css') }}" rel="stylesheet" />
    <link href="{{ asset('Content/Html/resources/css/mainfc2b.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body class="@yield('body_class')">
<div id="conainer">
    <header>
        <div class="container">
            <div class="tbl">
                <div class="tbl-cell logo">
                    <a href="{{ route('frontend.homepage') }}" title="CÔNG TY TNHH XÂY DỰNG KIẾN TRÚC VÀ NỘI THẤT DREAMHOUSE">
                        <img src="{{ asset('images/logodreamgo.png') }}" title="CÔNG TY TNHH XÂY DỰNG KIẾN TRÚC VÀ NỘI THẤT DREAMHOUSE" alt="CÔNG TY TNHH XÂY DỰNG KIẾN TRÚC VÀ NỘI THẤT DREAMHOUSE" class="hidden-1024"/>
                        <img src="{{ asset('images/logodreamgo.png') }}" title="CÔNG TY TNHH XÂY DỰNG KIẾN TRÚC VÀ NỘI THẤT DREAMHOUSE" alt="CÔNG TY TNHH XÂY DỰNG KIẾN TRÚC VÀ NỘI THẤT DREAMHOUSE" class="visible-1024"/>
                    </a>
                </div>
                <div class="tbl-cell text-center hidden-1024">
                    <a class="hot-event" href="{{ route('frontend.get.page', ['id' => '1', 'slug' => $pageSlug[1]['slug'] ? $pageSlug[1]['slug'] : '']) }}" title="{{ $pageSlug[1]['title'] }}">
                        <div class="img">
                            <img src="{{ asset('images/xanh1.png') }}" title="100% NGUY&#202;N LIỆU AN TO&#192;N" alt="100% NGUY&#202;N LIỆU AN TO&#192;N">
                        </div>
                        <div class="desc">
                            <h3>
                                <span style="color: #fff !important;" class="color-green">100% Nguồn nguyên liệu</span>
                            </h3>
                            <h4 style="margin: 0px;">
                                <span style="color: #fff !important;" class="color-green">chất lượng đảm bảo, xuất xứ rõ ràng.</span>
                            </h4>
                        </div>
                    </a>
                </div>

                <div class="tbl-cell top-nav hidden-1024">
                    <ul class="top">
                        <li><a href="javascript:void(0);" title=""><img style="max-width: 25px;" src="{{ asset('/images/en.jpg') }}" /></a></li>
                        <li><a href="javascript:void(0);" title=""><img style="max-width: 25px;" src="{{ asset('/images/vi.jpg') }}" /></a></li>
                        <li id="search-form">
                            <form action="{{ route('frontend.search') }}">
                                <input type="text" name="keyword" placeholder="Search" />
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </li>
                    </ul>
                    <ul class="bottom">
                        <li><a href="{{ route('frontend.get.page', ['id' => '2', 'slug' => $pageSlug[2]['slug'] ? $pageSlug[2]['slug'] : '']) }}" title="{{ $pageSlug[2]['title'] }}">{{ $pageSlug[2]['title'] }}</a></li>
                        <li><a href="{{ route('frontend.get.linhvuc', ['id' => '4', 'slug' => $linhvucSlug[4]['slug'] ? $linhvucSlug[4]['slug'] : '']) }}" title="C&#244;ng tr&#236;nh đ&#227; thực hiện">Công trình đã thực hiện</a></li>
                        <li><a href="{{ route('frontend.get.lienhe') }}" title="Li&#234;n hệ">Liên hệ</a></li>
                        <li id="hotline"><a href="tel:0919 379 799">0919 379 799</a></li>
                    </ul>
                </div>

                <div class="tbl-cell top-nav block-mobile hidden-1024">
                    <ul class="bottom">
                        <li id="hotline"><a href="tel:0919 379 799">0919 379 799</a></li>
                    </ul>
                </div>
                <a class="navbar-toggle visible-1024-table-cell" id="btn-show-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
            </div>
        </div>
    </header>

    <div id="sticker">
        <div class="container">
            <div id="sticker-content">
                <ul class="main-menu">
                    <li id="m-search-form" class="visible-1024">
                        <form action="{{ route('frontend.search') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Search" />
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </form>
                    </li>

                    <li><a href="{{ route('frontend.homepage') }}" title="Trang chủ">Trang chủ</a></li>

                    <li class="visible-1024">
                        <a href="{{ route('frontend.get.page', ['id' => '2', 'slug' => $pageSlug[2]['slug'] ? $pageSlug[2]['slug'] : '']) }}" title="{{ $pageSlug[2]['title'] }}">{{ $pageSlug[2]['title'] }}</a>
                    </li>
                    <li class="visible-1024">
                        <a href="{{ route('frontend.get.linhvuc', ['id' => '4', 'slug' => $linhvucSlug[4]['slug'] ? $linhvucSlug[4]['slug'] : '']) }}" title="C&#244;ng tr&#236;nh đ&#227; thực hiện">Công trình đã thực hiện</a>
                    </li>
                    <li class="visible-1024">
                        <a href="{{ route('frontend.get.lienhe') }}" title="Li&#234;n hệ">Liên hệ</a>
                    </li>

                    <li>
                        <a href="/#" title="Lĩnh vực hoạt động">Lĩnh vực hoạt động</a><span class="fa visible-1024 fa-angle-down"></span>
                        <ul class="subMenu">
                            @if(isset($linhvucSlug))
                            @foreach($linhvucSlug as $key=>$item)
                                <li><a href="{{ route('frontend.get.linhvuc', ['id' => $key, 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </li>

                    {{--Start phòng--}}
                    @foreach($roomMenu as $key=>$item)
                        <li>
                            <a href="{{ route('frontend.get.room', ['id' =>$item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a><span class="fa visible-1024 fa-angle-down"></span>
                            <ul class="subMenu">
                                @if(isset($item['category']))
                                    @foreach($item['category'] as $key2=>$item2)
                                        <li><a href="{{ route('frontend.get.category', ['id' => $item2['id'], 'slug' => $item2['slug']]) }}" title="{{ $item2['title'] }}" title="{{ $item2['title'] }}">{{ $item2['title'] }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    @endforeach
                    {{--End--}}

                    <li>
                        <a href="/#" title="Th&#244;ng tin">Thông tin</a><span class="fa visible-1024 fa-angle-down"></span>
                        <ul class="subMenu">
                            <li><a href="{{ route('frontend.get.lienhe') }}" title="Li&#234;n hệ">Li&#234;n hệ</a></li>
                            @foreach($pageSlug as $key => $page)
                                <li><a href="{{ route('frontend.get.page', ['id' => $key, 'slug' => $page['slug'] ? $page['slug'] : '']) }}" title="{{ $page['title'] }}">{{ $page['title'] }}</a></li>
                            @endforeach
                            {{--<li><a href="{{ route('frontend.get.page', ['id' => '4', 'slug' => $pageSlug[4] ? $pageSlug[4] : '']) }}" title="Tin tức">Tin tức</a></li>--}}
                            {{--<li><a href="{{ route('frontend.get.page', ['id' => '2', 'slug' => $pageSlug[2] ? $pageSlug[2] : '']) }}" title="Giới thiệu">Giới thiệu</a></li>--}}
                            {{--<li><a href="{{ route('frontend.get.page', ['id' => '3', 'slug' => $pageSlug[3] ? $pageSlug[3] : '']) }}" title="Quy tr&#236;nh thiết kế - B&#225;o gi&#225;">Quy tr&#236;nh thiết kế - B&#225;o gi&#225;</a></li>--}}
                            {{--<li><a href="{{ route('frontend.get.page', ['id' => '1', 'slug' => $pageSlug[1] ? $pageSlug[1] : '']) }}" title="Nguồn nguy&#234;n liệu">Nguồn nguy&#234;n liệu</a></li>--}}
                            {{--<li><a href="{{ route('frontend.get.page', ['id' => '5', 'slug' => $pageSlug[5] ? $pageSlug[5] : '']) }}" title="Ch&#237;nh s&#225;ch bảo h&#224;nh">Ch&#237;nh s&#225;ch bảo h&#224;nh</a></li>--}}
                            {{--<li><a href="{{ route('frontend.get.page', ['id' => '6', 'slug' => $pageSlug[6] ? $pageSlug[6] : '']) }}" title="Nội thất  đương đại">Nội thất  đương đại</a></li>--}}
                        </ul>
                    </li>
                    {{--<li class="lang visible-1024"><a href="javascript:void(0);" onclick="changeLang($(this))" title="VN">VN</a> | <a href="javascript:void(0);" onclick="changeLang($(this))" title="EN">EN</a></li>--}}
                </ul>
            </div>
        </div>
    </div>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <h3>CÔNG TY TNHH XÂY DỰNG KIẾN TRÚC VÀ NỘI THẤT DREAMHOUSE</h3>
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td><img src="{{ asset('Content/Html/resources/img/footer-ico5.png') }}" /></td>
                            <td><a href="{{ route('frontend.homepage') }}" title="">http://dreamgo.vn</a></td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('Content/Html/resources/img/footer-ico4.png') }}" /></td>
                            <td><a href="mailto:dreamgovn@gmail.com" title="">dreamgovn@gmail.com</a></td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('Content/Html/resources/img/footer-ico4.png') }}" /></td>
                            <td><a href="mailto:noithatdreamhouse@gmail.com" title="">noithatdreamhouse@gmail.com</a></td>
                        </tr>

                        <tr>
                            <td><img src="{{ asset('Content/Html/resources/img/footer-ico6.png') }}" /></td>
                            <td>7h30 - 17h30 tất cả c&aacute;c ng&agrave;y trong tuần</td>
                        </tr>

                        <tr>
                            <td colspan="2">Copyright &copy; 2019 DreamGo. All Rights Reserved.</td>
                        </tr>
                        </tbody>
                    </table>

                </div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <h3>Thông tin</h3>
                    <ul>
                        <li><a href="{{ route('frontend.homepage') }}" title="Trang chủ">Trang chủ</a></li>
                        <li><a href="{{ route('frontend.get.page', ['id' => '2', 'slug' => $pageSlug[2]['slug'] ? $pageSlug[2]['slug'] : '']) }}" title="{{ $pageSlug[2]['title'] }}">{{ $pageSlug[2]['title'] }}</a></li>
                        <li><a href="{{ route('frontend.get.page', ['id' => '1', 'slug' => $pageSlug[1]['slug'] ? $pageSlug[1]['slug'] : '']) }}" title="{{ $pageSlug[1]['title'] }}">{{ $pageSlug[1]['title'] }}</a></li>
                        <li><a href="{{ route('frontend.get.page', ['id' => '5', 'slug' => $pageSlug[5]['slug'] ? $pageSlug[5]['slug'] : '']) }}" title="{{ $pageSlug[5]['title'] }}">{{ $pageSlug[5]['title'] }}</a></li>
                        <li><a href="{{ route('frontend.get.page', ['id' => '6', 'slug' => $pageSlug[6]['slug'] ? $pageSlug[6]['slug'] : '']) }}" title="{{ $pageSlug[6]['title'] }}">{{ $pageSlug[6]['title'] }}</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <h3>Google Map</h3>
                    {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.834648675476!2d105.62943611545623!3d20.99926428601441!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313450e67277115f%3A0x39285f7fa6acf67b!2sDreamGo+Workshop!5e0!3m2!1svi!2s!4v1490326755177" width="100%" height="230" frameborder="0" style="border:0" allowfullscreen=""></iframe>--}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8746.676400907558!2d105.60352312110231!3d21.000256644753392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345096d7fcbab1%3A0x493a01fbbddf1e83!2sTomeco+An+Khang!5e0!3m2!1svi!2s!4v1558372060597!5m2!1svi!2s" width="100%" height="230" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <h3>LIÊN HỆ VỚI CHÚNG TÔI</h3>
                    <table width="100%">
                        <tbody>

                        <tr>
                            <td><img src="{{ asset('Content/Html/resources/img/footer-ico3.png') }}" /></td>
                            <td> <b>0919 379 799</b></td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('Content/Html/resources/img/footer-ico2.png') }}" /></td>
                            <td> 0222 248 2266 - 0986 681 583</td>
                        </tr>

                        <tr>
                            <td><img src="{{ asset('Content/Html/resources/img/footer-ico1.png') }}" /></td>
                            <td> Showroom & xưởng sản xuất: Cầu chui số 15 đại lộ Thăng Long, Ngọc Liệp, Quốc Oai, Hà Nội.</td>
                        </tr>

                        <tr>
                            <td><img src="{{ asset('Content/Html/resources/img/footer-ico1.png') }}" /></td>
                            <td> Văn phòng đại diện tỉnh: Số 300 Nguyễn Trãi, phường Võ Cường, tp Bắc Ninh.</td>
                        </tr>

                        </tbody>
                    </table>

                </div>

                {{--<div class="col-md-3 col-sm-12 col-xs-12">--}}
                    {{--<h3>Kết nối ch&#250;ng t&#244;i qua Facebook</h3>--}}
                    {{--<div class="facebook">--}}
                        {{--<div class="fb-page" data-href="https://www.facebook.com/dogohiendai" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/dogohiendai" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/dogohiendai">Facebook</a></blockquote></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </footer>

</div>

<div id="overlay" class="hidden"></div>
<a href="javascript:void(0)" id="btn-to-top">Lên đầu trang</a>
<div id="fixed-icon">
    <ul>
        {{--<li><a href="{{ route('frontend.homepage') }}" class="cart"><i class="fa fa-shopping-cart"></i></a></li>--}}
        <li><a href="https://www.facebook.com/noithatdreamhouse.hn/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>

        {{--<li><a href="https://www.youtube.com/" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a></li>--}}
        <li><a href="tel:0919 379 799" class="phone"><i class="fa fa-phone"></i></a></li>
    </ul>
</div>



    <script src="{{ asset('Content/Html/resources/js/jquery-1.12.1.min.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/lightslider.min.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/jquery.noty.packaged.min.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('Content/Publishing/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/cart.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/main.js') }}"></script>
    <script src="{{ asset('Content/Html/resources/js/jcode.js') }}"></script>

    <script>
        (function ( $ ) {

            $('.main-menu li a').each(function () {
                if (this.href.trim() == window.location)
                    $(this).parent('li').addClass('active');
            });

            $('.subMenu li a').each(function () {
                if (this.href.trim() == window.location) {
                    $(this).parents('.main-menu li').addClass('active');
                }
            });

        })(jQuery);
    </script>

<script type="text/javascript">
    jQuery(function($) {
        $('body').append('<a style="display:none;" class="callus" href="tel:0919379799">0919 379 799</a>');
        var lastScrollTop = 0;
        $(window).scroll(function(event){
            var st = $(this).scrollTop();
            if (st > lastScrollTop){
                // downscroll code
                $('a.callus').removeClass('display');
            } else {
                $('a.callus').addClass('display');
            }
            lastScrollTop = st;
        });
    });
</script>

<style type="text/css" media="screen and (max-width:767px)">
    a.callus {
        display: block !important;
        position: fixed;
        z-index: 9999;
        bottom: 20px;
        left: 20px;
        background: #4a6f72 url(http://statics.vietmoz.info/img/ico/glyphicons/earphone-white.png) no-repeat;
        background-position: 10px center;
        background-size: 20px;
        border-radius: 1000px;
        padding: 5px 10px 5px 40px;
        font-weight: 700;
        font-size: 18px;
        line-height: 30px;
        color: #fff;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        -moz-transform: scale(0);
        -webkit-transform: scale(0);
        -o-transform: scale(0);
        -ms-transform: scale(0);
        transform: scale(0);
    }
    a.display.callus {
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        -moz-transform: scale(1);
        -webkit-transform: scale(1);
        -o-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }
</style>

    @yield('scripts')

</body>
</html>
