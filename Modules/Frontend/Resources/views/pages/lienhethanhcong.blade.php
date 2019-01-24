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

        <br />
        <br />
        <br />
        <br />
        <br />

        <div class="background-green" style="margin-top: -6px; padding: 20px 0; color: #fff; background-color: #407274 !important;">
            <div class="container text-center">
                <h2>Liên hệ của bạn đã được gửi đi, chúng tôi sẽ liên hệ lại với bạn sớm nhất có thể.</h2>
                <h2>Trân trọng cám ơn.</h2>

            </div>
        </div>

        <br />
        <br />
        <br />
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
