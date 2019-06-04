@extends('frontend::master')

@section('page_title')
    DreamGo - {{ $linhvuc['title'] }}
@endsection

@section('body_class', 'linhvuc')

@section('styles')

@endsection

@section('content')

    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ route('frontend.homepage') }}" title="Trang chủ">Trang chủ</a></li>

                <li class="active">{{ $linhvuc['title'] }}</li>
            </ol>
        </div>
    </div>
    <div id="content" class="news-content">
        <div class="container">
            <div class="title">
                <h1>{{ $linhvuc['title'] }}</h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="top-news">
                    <div class="top-news">
                        <ul class="slider">
                            @foreach($data as $item)
                                @if($item['noibat'] == 1)
                                    <li>
                                        <a href="{{ route('frontend.get.hoatdong', ['id' =>$item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">
                                            <div class="img img-cover">
                                                <img src="{{ asset('/').$item['image']['url'] }}" title="{{ $item['title'] }}" alt="{{ $item['title'] }}" />
                                            </div>
                                            <div class="desc">
                                                <h3>{{ $item['title'] }}</h3>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>

                    </div>
                    <div class="row" id="page-new">
                        <div class="news-list">
                            @foreach($data as $item)
                                <div class="col-sm-6 col-xs-12">
                                <div class="news">
                                    <div class="img img-cover">
                                        <a href="{{ route('frontend.get.hoatdong', ['id' =>$item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}">
                                            <img src="{{ asset('/').$item['image']['url'] }}" alt="{{ $item['title'] }}"/></a>
                                    </div>
                                    <div class="desc">
                                        <h3><a href="{{ route('frontend.get.hoatdong', ['id' =>$item['id'], 'slug' => $item['slug']]) }}" title="{{ $item['title'] }}" class="color-green">{{ $item['title'] }}</a>
                                        </h3>
                                        <div class="time">
                                            <i>{{ date_format(date_create($item['ngaythang']), "d/m/Y") }} </i>
                                            {{--// hin/--}}
                                        </div>
                                        <div class="short-desc">
                                            {!! mb_substr($item['content'], 0 , 120) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            {{--<ul class="pagination">--}}
                                {{--<li><a href="javascript:;" class="active">1</a></li><li><a href="Ajax/Content/PartialNewsa385.html?seolink=Cong-trinh-da-thuc-hien&amp;page=2">2</a></li><li><a href="Ajax/Content/PartialNewsa385.html?seolink=Cong-trinh-da-thuc-hien&amp;page=2"><i class="fa fa-angle-right"></i></a></li><li><a href="Ajax/Content/PartialNewsa385.html?seolink=Cong-trinh-da-thuc-hien&amp;page=2"><span class="fa fa-angle-double-right"></span></a></li>--}}
                            {{--</ul>--}}
                        </div>

                    </div>
                </div>

                {{ $data->links() }}

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        (function ( $ ) {
            $('#content.news-content ul.slider').lightSlider({
                item: 1,
                loop: true,
                slideMove: 2,
                easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
                speed: 600,
                mode: "fade",
                onBeforeStart: function () {
                    $('#banner ul>li').height($(window).width() * 0.4509516837481698);
                }
            });

        })(jQuery);
    </script>

@endsection
