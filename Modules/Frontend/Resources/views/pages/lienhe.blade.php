@extends('frontend::master')

@section('page_title', 'DreamGo - Liên hệ')

@section('body_class', 'lien-he')

@section('styles')
    <style>
        #content  iframe {
            height: 414px !important;
        }
    </style>
@endsection

@section('content')

    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ route('frontend.homepage') }}" title="Trang chủ">Trang chủ</a></li>
                <li class="active">Li&#234;n hệ</li>
            </ol>
        </div>
    </div>
    <div id="content" class="contact-content">
        <div class="background-green" style="margin-top: -6px; padding: 20px 0; color: #fff; background-color: #407274 !important;">
            <div class="container text-center">
                <h1 style="font-size: 20px; margin: 0 0 15px; line-height: 1.4; text-transform: uppercase; font-weight: 600">CÔNG TY TNHH XÂY DỰNG KIẾN TRÚC VÀ NỘI THẤT DREAMHOUSE</h1>
                <br style="margin: 0">Cầu chui số 15 đại lộ Thăng Long, Ngọc Liệp, Quốc Oai, Hà Nội - Tel: 0222 248 2266 & 0986 681 583 - Hotline: 0919 379 799 </br>  Email: dreamgovn@gmail.com & noithatdreamhouse@gmail.com -  Website: http://dreamgo.vn</p>

            </div>
        </div>
        <hr />
        <div class="container">
            <div class="tbl">
                <div class="tbl-cell hidden-sm hidden-xs">
                    <div class="img-cover">
                        <img src="{{ asset('images/que.jpg') }}" width="100%"/>
                    </div>
                </div>
                <div class="tbl-cell">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8746.676400907558!2d105.60352312110231!3d21.000256644753392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345096d7fcbab1%3A0x493a01fbbddf1e83!2sTomeco+An+Khang!5e0!3m2!1svi!2s!4v1558372060597!5m2!1svi!2s" width="100%" height="230" frameborder="0" style="border:0" allowfullscreen></iframe>

                </div>
            </div>
        </div>
        <hr/>
        <div class="container">
            <form id="form-contact" method="post" action="{{ route('frontend.post.lienhe') }}">
                @csrf
                <h2>Hãy để lại thông tin. Chúng tôi sẽ liên hệ lại trong thời gian sớm nhất</h2>
                <table width="100%">
                    <tr>
                        <td>
                            <div class="input-wrap">
                                <input type="text" class="form-control" name="hoten" id="fullname"/>
                                <label>Họ tên <i class="color-red">*</i></label>
                            </div>
                        </td>
                        <td>
                            <div class="input-wrap">
                                <input type="text" class="form-control" name="diachi" id="address"/>
                                <label>Địa chỉ</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-wrap">
                                <input type="text" class="form-control" name="congty" id="company"/>
                                <label>Công ty</label>
                            </div>
                        </td>
                        <td>
                            <div class="input-wrap">
                                <input type="text" class="form-control" name="chude" id="title"/>
                                <label>Chủ đề</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-wrap">
                                <input type="number" class="form-control" name="dienthoai" id="phone"/>
                                <label>Điện thoại</label>
                            </div>
                        </td>
                        <td rowspan="3">
                            <div class="input-wrap">
                                <textarea class="form-control" name="noidung" id="content"></textarea>
                                <label>Nội dung <i class="color-red">*</i></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-wrap">
                                <input type="number" class="form-control" name="didong" id="mobile"/>
                                <label>Dị động <i class="color-red">*</i></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-wrap">
                                <input type="email" class="form-control" name="email" id="email"/>
                                <label>Email <i class="color-red">*</i></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="vertical-align: middle">
                            <div class="form-btn-group pull-right">
                                <button type="submit" class="btn btn-primary text-uppercase" id="btn-sendcontact" style="margin-right: 10px"><b>Gửi đi</b></button>
                                <button type="reset" class="btn btn-black text-uppercase"><b>Nhập lại</b></button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <br />
        <br />

    </div>

@endsection

@section('scripts')
    <script>
        (function ( $ ) {
            $('#content.contact-content .form-control').focus(function () {
                var $label = $(this).parent().children('label:last-child');
                if (!$label.hasClass('hidden')) {
                    $label.addClass('hidden');
                }
            });
            $('#content.contact-content .form-control').blur(function () {
                var $label = $(this).parent().children('label:last-child');
                if ($(this).val() == '') {
                    $label.removeClass('hidden');
                }
            });

            $("#form-contact").validate({
                rules: {
                    fullname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mobile: {
                        required: true,
                        number: true,
                        maxlength: 11,
                    },
                    content: {
                        required: true,
                    },
                    // txtRandom: {
                    //     required: true,
                    // },
                },
                messages: {
                    fullname: {
                        required: "Vui lòng nhập tên liên hệ !",
                    },
                    email: {
                        required: "Vui lòng nhập Email của bạn!",
                        email: "Email không đúng định dạng!"
                    },
                    mobile: {
                        required: "Vui lòng nhập điện thoại của bạn!",
                        number: "Chỉ được nhấp số!",
                        maxlength: "Tối đa 11 ký tự!",
                    },
                    content: {
                        required: "Vui lòng nhập nội dung liên hệ!",
                    },
                    // txtRandom: {
                    //     required: "Vui lòng nhập mã bảo vệ!",
                    //
                    // },

                },
                submitHandler: function () {
                    doSendContact();
                },
            });

            function doSendContact() {
                $("#form-contact").submit();

            }


        })(jQuery);

    </script>

@endsection
