@extends('frontend::master')

@section('page_title', 'DreamGo')

@section('body_class', 'homepage')

@section('styles')

@endsection

@section('content')

    {{--slide--}}
    @if(isset($slides))
    <div id="banner">
        <ul>
            @foreach($slides as $key=>$item)
                <li class="img-cover">
                    <a title="{{ $item['tieude'] }}">
                        <img src="{{ $item['image'] }}" alt="{{ $item['tieude'] }}" />
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
    @endif
    {{--////--}}


    <div class="index-products product-choice">
        <div class="container">
            <div class="title">
                <h2>DreamGo - Lựa chọn đúng sản phẩm chất lượng</h2>
                <p>Giá thành phù hợp </p>

            </div>
        </div>
        <div class="grid" id="grid1">
            @foreach($section as $key=>$items)
                @if($key == 1)
                    $@foreach($items as $key2=>$item)
                         @if($key2 == 0)
                            <a class="grid-item grid-item-width2 video" f="#" title="Video" style="padding-bottom: 345px;">
                            <img src="{{ $item['image'] }}" alt="Liên hệ-1" title="Liên hệ-1" style="height: auto; width: 100%; min-height: 200px;">
                            </a>
                        @else
                            <a class="grid-item img-cover {{ $key2 == 6 ? "cover1" : "cover2" }}" href="{{ $item['link'] }}" title="Liên hệ">
                                <img src="{{ $item['image'] }}" alt="Liên hệ" title="Liên hệ" style="height: 345px;">
                                <div class="desc">
                                    <h3>
                                        <p><small>{{ $item['text1'] }}</small>{{ $item['text2'] }}</p>

                                    </h3>
                                    <span class="btn-detail">Xem thêm</span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{--<a class="grid-item grid-item-width2 video" f="#" title="Video" style="padding-bottom: 345px;">--}}
                {{--<img src="{{ asset('/').'images/sdsds.jpg' }}" alt="Liên hệ" title="Liên hệ" style="height: auto; width: 100%;">--}}
            {{--</a>--}}

            {{--<a class="grid-item img-cover cover1" href="{{ route('frontend.get.lienhe') }}" title="Liên hệ">--}}
                {{--<img src="{{ asset('/').'Uploads/images/go1.jpg' }}" alt="Liên hệ" title="Liên hệ" style="height: 345px;">--}}
                {{--<div class="desc">--}}
                    {{--<h3>--}}
                        {{--<p><small>Li&ecirc;n hệ</small>với DreamGo</p>--}}

                    {{--</h3>--}}
                    {{--<span class="btn-detail">Xem thêm</span>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a class="grid-item img-cover cover2" href="{{ route('frontend.get.page', ['id' => '1', 'slug' => $pageSlug[1]['slug'] ? $pageSlug[1]['slug'] : '']) }}" title="{{ $pageSlug[1]['title'] }}">--}}
                {{--<img src="{{ asset('/').'Uploads/images/Lien%20he%20voi%20chung%20toi.jpg' }}" alt="Nguyên liệu đảm bảo" title="Nguyên liệu đảm bảo" style="height: 345px;">--}}
                {{--<div class="desc">--}}
                    {{--<h3>--}}
                        {{--<p><small>Nguồn nguyên liệu</small>đảm bảo</p>--}}

                    {{--</h3>--}}
                    {{--<span class="btn-detail">Xem thêm</span>--}}
                {{--</div>--}}
            {{--</a>--}}
        </div>
    </div>
    <div class="index-products custom">
        <div class="container">
            <div class="title">
                <h2>Sản phẩm</h2>

                <p>C&aacute;c sản phẩm nội thất của DreamGo</p>


            </div>
        </div>
        <div class="container grid">
            @foreach($section as $key=>$items)
                @if($key == 2)
                @foreach($items as $item)
                    <a class="grid-item grid-item-width2 img-cover" href="{{ $item['link'] }}" title="{{ $item['text1'] . $item['text2'] }}">
                        @if(!empty($item['image']))
                            <img src="{{ $item['image'] }}" alt="{{ $item['text1'] . $item['text2'] }}">
                        @endif
                        <div class="desc">
                            <h3><p>{{ $item['text1'] }}<br />
                                    {{ $item['text2'] }}</p>
                            </h3>
                        </div>
                    </a>
                @endforeach
                @endif
            @endforeach

            {{--<a class="grid-item img-cover" href="{{ route('frontend.get.room', ['id' => '3', 'slug' => $roomSlug[3]['slug'] ? $roomSlug[3]['slug'] : '']) }}" title="1">--}}
                {{--<img src="{{ asset('/')."Uploads/images/banan.jpg" }}" alt="B&#224;n ăn gỗ tự nhi&#234;n">--}}
                {{--<div class="desc">--}}
                    {{--<h3><p>B&agrave;n ăn</p>--}}

                        {{--<p>hiện đại</p>--}}

                    {{--</h3>--}}
                {{--</div>--}}
            {{--</a>--}}

            {{--<a class="grid-item grid-item-width2 img-cover" href="{{ route('frontend.get.room', ['id' => '1', 'slug' => $roomSlug[1]['slug'] ? $roomSlug[1]['slug'] : '']) }}" title="2">--}}
                {{--<img src="{{ asset('/').'Uploads/images/phong-khach.jpg' }}" alt="Ph&#242;ng kh&#225;ch">--}}
                {{--<div class="desc">--}}
                    {{--<h3><p>Nội thất<br />--}}
                            {{--Ph&ograve;ng kh&aacute;ch</p>--}}

                    {{--</h3>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a class="grid-item grid-item-width2 img-cover" href="{{ route('frontend.get.room', ['id' => '2', 'slug' => $roomSlug[2]['slug'] ? $roomSlug[2]['slug'] : '']) }}" title="3">--}}
                {{--<img src="{{ asset('/').'Uploads/images/phong-ngu.jpg' }}" alt="Ph&#242;ng ngủ">--}}
                {{--<div class="desc">--}}
                    {{--<h3><p>Nội thất<br />--}}
                            {{--Ph&ograve;ng ngủ</p>--}}

                    {{--</h3>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a class="grid-item grid-item-width2 img-cover" href="{{ route('frontend.get.room', ['id' => '3', 'slug' => $roomSlug[3]['slug'] ? $roomSlug[3]['slug'] : '']) }}" title="4">--}}
                {{--<img src="{{ asset('/').'Uploads/images/phong-an.jpg' }}" alt="Bếp - Ph&#242;ng ăn">--}}
                {{--<div class="desc">--}}
                    {{--<h3><p>Nội thất<br />--}}
                            {{--Ph&ograve;ng ăn</p>--}}

                    {{--</h3>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a class="grid-item img-cover" href="{{ route('frontend.get.room', ['id' => '4', 'slug' => $roomSlug[4]['slug'] ? $roomSlug[4]['slug'] : '']) }}" title="5">--}}
                {{--<img src="{{ asset('/')."Uploads/images/treem1.jpg" }}" alt="B&#224;n ăn gỗ tự nhi&#234;n">--}}
                {{--<div class="desc">--}}
                    {{--<h3><p>Nội thất<br />--}}
                            {{--Ph&ograve;ng trẻ em</p>--}}

                    {{--</h3>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a class="grid-item grid-item-width2 img-cover" href="{{ route('frontend.get.room', ['id' => '1', 'slug' => $roomSlug[1]['slug'] ? $roomSlug[1]['slug'] : '']) }}" title="6">--}}
                {{--<img src="{{ asset('/').'Uploads/images/phong-lam-viec.jpg' }}" alt="Ph&#242;ng l&#224;m việc">--}}
                {{--<div class="desc">--}}
                    {{--<h3><p>Nội thất<br />--}}
                            {{--Ph&ograve;ng l&agrave;m việc</p>--}}

                    {{--</h3>--}}
                {{--</div>--}}
            {{--</a>--}}
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12" style="padding-top: 20px">
                <div id="index-news">
                    <h2><a href="{{ route('frontend.get.linhvuc', [ 'id' => $congtrinhdathuchien['linhvuc']['id'], 'slug' => $congtrinhdathuchien['linhvuc']['slug'] ]) }}" title="{{ $congtrinhdathuchien['linhvuc']['title'] }}">{{ $congtrinhdathuchien['linhvuc']['title'] }}</a></h2>
                    @if(isset($congtrinhdathuchien['list']))
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="news-big">
                                <div class="img img-cover">
                                    <a href="{{ route('frontend.get.hoatdong', ['id' =>$congtrinhdathuchien['list'][0]['id'], 'slug' => $congtrinhdathuchien['linhvuc']['slug'] ]) }}" title="{{ $congtrinhdathuchien['list'][0]['title'] }}">
                                        <img src="{{ $congtrinhdathuchien['list'][0]['image'] }}" alt="{{ $congtrinhdathuchien['list'][0]['title'] }}" />
                                    </a>
                                    <div class="time">{{ $congtrinhdathuchien['list'][0]['date'] }}</div>
                                </div>
                                <div class="desc">
                                    <h3><a href="{{ route('frontend.get.hoatdong', ['id' =>$congtrinhdathuchien['list'][0]['id'], 'slug' => $congtrinhdathuchien['linhvuc']['slug'] ]) }}" title="{{ $congtrinhdathuchien['list'][0]['title'] }}">{{ $congtrinhdathuchien['list'][0]['title'] }}</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <ul>
                                @foreach($congtrinhdathuchien['list'] as $key=>$item)
                                    @if($key > 0)
                                        <li>
                                            <div class="time">{{ $item['date'] }}</div>
                                            <h3><a href="{{ route('frontend.get.hoatdong', ['id' =>$item['id'], 'slug' => $item['slug']]) }}">{{ $item['title'] }}</a></h3>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 col-xs-12" style="padding-top: 20px">
                <div id="index-consult">
                    <h2><a href="{{ route('frontend.get.linhvuc', ['id' => $duandathietke['linhvuc']['id'], 'slug' => $duandathietke['linhvuc']['slug'] ]) }}" title="{{ $duandathietke['linhvuc']['title'] }}">{{ $duandathietke['linhvuc']['title'] }}</a></h2>

                    @if(isset($duandathietke['list']))
                    @foreach($duandathietke['list'] as $key=>$item)
                        <div class="consult">
                            <div class="img img-cover">
                                <a href="{{ route('frontend.get.hoatdong', ['id' =>$item['id'], 'slug' => $item['slug'] ]) }}" title="{{ $item['title'] }}">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" /></a>
                            </div>
                            <div class="desc">
                                <div class="time">{{ $item['date'] }}</div>
                                <h3><a href="{{ route('frontend.get.hoatdong', ['id' =>$item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                                <div class="text-right">
                                    <a href="{{ route('frontend.get.hoatdong', ['id' =>$item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}" class="btn-detail">Chi tiết</a>
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
            $('#banner ul').lightSlider({
                item: 1,
                loop: true,
                slideMove: 2,
                easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                speed: 400,
                auto: true,
                pause:3000,
                mode: "fade",
                onBeforeStart: function () {
                    $('#banner ul>li').height($(window).width() * 0.4509516837481698);
                }
            });

            var ratio = 0.25;
            if ($(window).width() <= 600) {
                var ratio = 1;
            } else if ($(window).width() <= 992) {
                var ratio = 0.3333333333333333;
            }
            var height = $(window).width() * 0.9532163742690058 * ratio;
            $('.index-products.list-products .grid-item').height(height);


            var ratio = 26 / 100;
            if ($(window).width() <= 600) {
                var ratio = 1;
            } else if ($(window).width() <= 992) {
                var ratio = 0.3333333333333333;
            }
            var height = $(window).width() * 0.7627118644067797 * ratio;
            $('.index-products.list-products .grid-item').height(height);
            var $grid = $('.grid').isotope({
                // set itemSelector so .grid-sizer is not used in layout
                itemSelector: '.grid-item',
                layoutMode: 'fitRows'
            });

        })(jQuery);

    </script>

@endsection
