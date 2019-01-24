@extends('frontend::master')

@section('page_title')
    DreamGo - {{ $data['title'] }}
@endsection

@section('body_class', 'hoatdong')

@section('styles')
    <style>
        p.creat-date {
            font-style: italic;
            color: #888585;
        }
        p.shortdesc {
            font-style: italic;
            color: #797777;
            margin-bottom: 20px;
        }
        .other-news h3{font-size:20px;text-transform:uppercase;font-weight:600;margin:0 0 15px;}
        .other-news ul {
            padding-left:35px;
        }
    </style>
@endsection

@section('content')

    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ route('frontend.homepage') }}" title="Trang chủ">Trang chủ</a></li>
                <li><a href="{{ route('frontend.get.linhvuc', ['slug' => $data['linhvuc']['slug']]) }}">{{ $data['linhvuc']['title'] }}</a></li>

                <li class="active">{{ $data['title'] }}</li>
            </ol>
        </div>
    </div>
    <div id="content" class="news-content detail-content">
        <div class="container">
            <div class="title">
                <h1>{{ $data['title'] }}</h1>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="creat-date">Ngày đăng: {{ date_format(date_create($data['updated_at']), "d/m/Y") }}</p>

                    <p>Thiết kế : DreamHouse team.</p>
                    <p>Thi công : Công ty TNHH xây dựng kiến trúc và nội thất DreamHouse.</p>

                    {!! $data['content'] !!}

                    <p>&nbsp;</p>

                    <div class="share clearfix" style=" margin-top:20px">

                        <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox pull-right"></div>
                    </div>

                    <div class="same-product">
                        <h2>Tin tức khác</h2>
                        <ul class="slider">
                            @foreach($dataRelate as $item)
                                <li>
                                    <div class="img img-cover">
                                        <a href="{{ route('frontend.get.hoatdong', ['slug' => $item['slug']]) }}" title="{{ $item['title'] }}">
                                            <img src="{{ asset('/').$item['image']['url'] }}" alt="{{ $item['title'] }}" title="{{ $item['title'] }}" />
                                        </a>
                                    </div>
                                    <div class="desc">
                                        <h3>
                                            <a href="{{ route('frontend.get.hoatdong', ['slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a>
                                        </h3>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="sidebar">
                        <div class="hot-news">
                            <h2>Tin nổi bật</h2>
                            <ul>
                                @foreach($dataRelate as $item)
                                    @if($item['noibat'] == 1)
                                    <li class="news">
                                        <div class="img img-cover">
                                            <a href="{{ route('frontend.get.hoatdong', ['slug' => $item['slug']]) }}" title="{{ $item['title'] }}"><img src="{{ asset('/').$item['image']['url'] }}" title="{{ $item['title'] }}" alt="{{ $item['title'] }}" /></a>
                                        </div>
                                        <div class="desc">
                                            <h3><a href="{{ route('frontend.get.hoatdong', ['slug' => $item['slug']]) }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a></h3>
                                            <div class="time"><i>{{ date_format(date_create($data['updated_at']), "d/m/Y") }}</i></div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="video">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/iSizF8FgMfM" frameborder="0" gesture="media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        (function ( $ ) {

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
