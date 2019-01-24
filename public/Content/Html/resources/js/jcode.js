$(document).ready(function () {
    //Select Price
    var urlLoadPartialProducts = "/Ajax/Content/PartialProducts";
    $("#select-order-price").change(function (e) {
        e.preventDefault();
        var type = $(this).val();
        var seoLink = $("#seolink-type").val();
        $.ajax({
            type: "POST",
            url: urlLoadPartialProducts,
            data: { page: 1, seoLink: seoLink, type: parseInt(type) },
            dataType: "text",
            success: function (data) {
                $("#page-pro").html(data);
                $('html, body').animate({ scrollTop: $('#page-pro').position().top - 60 }, 'slow');
            }
        });
    });
})