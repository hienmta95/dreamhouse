//-------------------------------------------------------//
//-------------------------------------------------------//
//--------------------Chi tiet sp------------------------//
//-------------------------------------------------------//
//-------------------------------------------------------//
//Function duyet tung element spinner
//Tinh tong va add text vao goalElement
function initCountTotal(eachElement, goalElement) {
    var tong = 0;
    eachElement.each(function () {
        var onePrice = parseInt($(this).data("price"));
        var countThis = parseInt($(this).val());
        var temp = onePrice * countThis;
        tong = tong + temp;
    });
    goalElement.text(tong).mask('000.000.000.000.000', { reverse: true }).append("đ");
};
//Check so luong
//Return true neu so luong con trong data-quantity
//Warning neu so luong vuot qua data-quantity
//Su kien cua input so luong
//Check so luong
//Check gia
$(".wan-spinner input").keypress(function (e) {
    if (e.which < 48 || e.which > 57) {
        e.preventDefault();
    }
});
//keydown
$(".wan-spinner-detail-pro .total-mask").keydown(function (e) {
    var $input = $(this);
    switch (e.which) {
        case 38: // up
            upInputVal($input);
            e.preventDefault();
            break;
        case 40: // down
            downInputVal($input);
            e.preventDefault();
            break;
    }

});


//Click nut "-" va "+" //----------------------//
function upInputVal($input) {
    if ($.isNumeric($input.val())) {
        $input.val(parseInt($input.val()) + 1);
    } else if ($input.val() == "") {
        $input.val(1);
    }
}
//----------------------//
function downInputVal($input) {
    if ($.isNumeric($input.val()) && $input.val() > 0) {
        $input.val(parseInt($input.val()) - 1);
    } else if ($input.val() == "") {
        $input.val(1);
    }
}

$(document).ready(function () {
    $(".wan-spinner input").focus(function () {
        $(this).select();
    });
    //Click nut "+" tang +1 //----------------------//
    $('.wan-spinner #plus').click(function () {
        var $input = $(this).prev('input');
        upInputVal($input);
        initCountTotal($(".total-mask"), $("#total-price-add"));
    });
    //Click nut "-" tang -1//----------------------//
    $('.wan-spinner #minus').click(function () {
        var $input = $(this).next('input');
        downInputVal($input);
        initCountTotal($(".total-mask"), $("#total-price-add"));
    });
    //Change //----------------------//
    $(".wan-spinner-detail-pro .total-mask").change(function () {
        initCountTotal($(".total-mask"), $("#total-price-add"));
    });
    //Su kien click nut add-to-cart //======================//
    $("#add-to-cart").click(function (e) {
        e.preventDefault();
        var resultCheck = initCheckInputCount($(".total-mask"));
        if (resultCheck != true) {
            var cookieUrlCallBack = $(this).data("modulenameascii");
            setCartUrlBack(cookieUrlCallBack);
            $(".total-mask").each(function () {
                var productSubId = $(this).data("idsub");
                var namePro = $(this).data("namesub");
                var quantity = $(this).val();
                if (quantity != "0") {
                    addToCartRedirect(productSubId, quantity, namePro);
                };
            });
        } else {
            noty({
                text: '<h4>Thông báo</h4><p>Bạn chưa nhập số lượng!</p>',
                type: 'error',
                theme: 'metroui',
                layout: 'topRight',
                timeout: 3000,
                progressBar: true, killer: true,
                animation: {
                    open: 'animated fadeIn',
                    close: 'animated fadeOut',
                    speed: 200
                }
            });
        }
    });
    //Click nut "+" tang +1
    $('.wan-spinner #plus-cart').click(function () {
        debugger
        var $input = $(this).prev('input');
        var oldQuantity = parseInt($input.val(), 10);
        upInputVal($input);
        var idpro = $input.data("idsub");
        var namepro = $input.data("namesub");
        updateCart(idpro, oldQuantity, namepro);
    });
    //Click nut "-" tang -1
    $('.wan-spinner #minus-cart').click(function () {
        var $input = $(this).next('input');
        var oldQuantity = parseInt($input.val(), 10);
        downInputVal($input);
        var idpro = $input.data("idsub");
        var namepro = $input.data("namesub");
        updateCart(idpro, oldQuantity, namepro);
    });
    //keydown
    $(".wan-spinner-cart .total-mask").keydown(function (e) {
        var $input = $(this);
        switch (e.which) {
            case 38: // up
                upInputVal($input);
                e.preventDefault();
                break;
            case 40: // down
                downInputVal($input);
                e.preventDefault();
                break;
        }
        var idpro = $input.data("idsub");
        var namepro = $input.data("namesub");
        var oldQuantity = $input.data("quantity");
        updateCart(idpro, oldQuantity, namepro);
    });
    $(".wan-spinner-cart .total-mask").change(function () {
        var idpro = $input.data("idsub");
        var namepro = $input.data("namesub");
        var oldQuantity = $input.data("quantity");
        updateCart(idpro, oldQuantity, namepro);
    });
});

//=========================================================================================//
//=========================================================================================//
//=======================================Cart==============================================//
//=========================================================================================//
//=========================================================================================//
// check Browser Enable Cookie
function checkBrowserEnableCookie() {
    var cookieEnabled = (navigator.cookieEnabled) ? true : false
    //if not IE4+ nor NS6+
    if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled) {
        document.cookie = "testcookie"
        cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false
    }

    if (cookieEnabled) return true;
    else return false;
}
//create Cookie
function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}
//read Cookie
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return "";
}
// delete Cookie 
function eraseCookie(name) {
    createCookie(name, "", -1);
}
//dem so phan tu trong cart
function countShoppingCart(name) {
    if (readCookie(name) == "") {
        return 0;
    } else {
        var current_cart = readCookie(name);
        var ca = current_cart.split('%2c');
        var number_product = 0;
        for (var i = 1; i < ca.length; i++) {
            var ele = ca[i].split('-');
            number_product = number_product + parseInt(ele[1]);
        }
        return number_product;
    }
}

function initCheckInputCount(eachElementCheck) {
    var result = true;
    eachElementCheck.each(function () {
        if ($(this).val() != 0)
            result = false;
    });
    return result;
};

//them sp vao gio hang
function addToCartRedirect(productSubId, quantity, namePro) {
    if (readCookie('shopping_cart') == null) {
        createCookie('shopping_cart', '', 1);
    }
    var current_cart = readCookie('shopping_cart');
    var keySearchOldProduct = '%2c' + productSubId + '-';
    if (current_cart.search(keySearchOldProduct) == -1) {
        var new_cart = current_cart + '%2c' + productSubId + '-' + quantity;
        createCookie('shopping_cart', new_cart, 1);
        noty({
            text: '<h4>Thành công</h4><p>Sản phẩm ' + namePro + ' đã được thêm vào giỏ hàng!</p>',
            type: 'success',
            theme: 'metroui',
            layout: 'topRight',
            timeout: 3000,
            progressBar: true
        });
        
    } else {
        var strCurrrentCart = "";
        var lstStr = current_cart.split('%2c');
        for (i = 1; i <= lstStr.length - 1 ; i++) {
            eleChild = lstStr[i];
            var eleSplitChild = eleChild.split('-');
            var proSubIDToCookie = eleSplitChild[0];
            var countProSubIDToCookie = eleSplitChild[1];
            if (proSubIDToCookie == productSubId) {
                countProSubIDToCookie = parseInt(countProSubIDToCookie) + parseInt(quantity);
            }
            strCurrrentCart = strCurrrentCart + '%2c' + proSubIDToCookie + '-' + countProSubIDToCookie;
        }
        createCookie('shopping_cart', strCurrrentCart, 1);
        noty({
            text: '<h4>Không thành công</h4><p>Sản phẩm ' + namePro + ' đã có trong giỏ hàng!</p>',
            type: 'error',
            theme: 'metroui',
            layout: 'topRight',
            timeout: 3000,
            progressBar: true, killer: true,
            animation: {
                open: 'animated fadeIn',
                close: 'animated fadeOut',
                speed: 200
            }
        });

    }
}
//them sp vao gio hang - no warning 
function addToCartRedirectNotWarning(productSubId, quantity) {
    if (readCookie('shopping_cart') == null) {
        createCookie('shopping_cart', '', 1);
    }
    var current_cart = readCookie('shopping_cart');
    var keySearchOldProduct = '%2c' + productSubId + '-';
    if (current_cart.search(keySearchOldProduct) == -1) {
        var new_cart = current_cart + '%2c' + productSubId + '-' + quantity;
        createCookie('shopping_cart', new_cart, 1);
        window.location.reload();
    } else {
        var strCurrrentCart = "";
        var lstStr = current_cart.split('%2c');
        for (i = 1; i <= lstStr.length - 1 ; i++) {
            eleChild = lstStr[i];
            var eleSplitChild = eleChild.split('-');
            var proSubIDToCookie = eleSplitChild[0];
            var countProSubIDToCookie = eleSplitChild[1];
            if (proSubIDToCookie == productSubId) {
                countProSubIDToCookie = parseInt(countProSubIDToCookie) + parseInt(quantity);
            }
            strCurrrentCart = strCurrrentCart + '%2c' + proSubIDToCookie + '-' + countProSubIDToCookie;
        }
        createCookie('shopping_cart', strCurrrentCart, 1);
        window.location.reload();
    }
}
//Xóa 1 sp trong giỏ hàng, id pro, so luong va ten
function deleteFromCart(productId, quantity, namePro) {
    noty({
        text: 'Bạn có muốn xóa sản phẩm ' + namePro + ' trong giỏ hàng?',
        theme: 'metroui',
        layout: 'center',
        timeout: 3000,
        progressBar: true, killer: true,
        modal: true,
        animation: {
            open: 'animated fadeIn',
            close: 'animated fadeOut',
            speed: 200
        },
        buttons: [{
            addClass: 'btn btn-primary', text: 'Có', onClick: function ($noty) {
                console.log($noty.$bar.find('input#example').val());
                var current_cart = readCookie('shopping_cart');
                new_cart = current_cart.replace("%2c" + productId + '-' + quantity, "");
                new_cart = new_cart.replace("%2c" + productId + '-', "0");
                createCookie('shopping_cart', new_cart, 1);
                noty({
                    text: '<h4>Thành công</h4><p>Sản phẩm ' + namePro + ' đã bị xóa khỏi giỏ hàng!</p>',
                    type: 'success',
                    theme: 'metroui',
                    layout: 'topRight',
                    timeout: 3000,
                    progressBar: true, killer: true,
                    animation: {
                        open: 'animated fadeIn',
                        close: 'animated fadeOut',
                        speed: 200
                    }
                });
                setInterval(function () {
                    window.location.href = "/gio-hang";
                }, 500);
            }
        }, {
            addClass: 'btn btn-danger', text: 'Không', onClick: function ($noty) {
                noty({
                    text: 'Sản phẩm ' + namePro + ' chưa bị xóa, hãy tiếp tục mua hàng!',
                    type: 'information',
                    theme: 'metroui',
                    layout: 'topRight',
                    timeout: 3000,
                    progressBar: true, killer: true,
                    animation: {
                        open: 'animated fadeIn',
                        close: 'animated fadeOut',
                        speed: 200
                    }
                });
            }
        }]
    });
}
//update cart
function updateCart(productId, quantity, namePro) {
    debugger
    var elementThis = "#item_" + productId;
    var newquantity = $(elementThis).val();
    newquantity = parseInt(newquantity);
    if (newquantity < 1) {
        noty({
            text: 'Nếu số lượng <= 0, sản phẩm ' + namePro + ' sẽ bị xóa khỏi giỏ hàng!',
            theme: 'metroui',
            layout: 'center',
            timeout: 3000,
            progressBar: true, killer: true,
            modal: true,
            animation: {
                open: 'animated fadeIn',
                close: 'animated fadeOut',
                speed: 200
            },
            buttons: [{
                addClass: 'btn btn-primary', text: 'Có', onClick: function ($noty) {
                    console.log($noty.$bar.find('input#example').val());
                    $noty.close();
                    var current_cart = readCookie('shopping_cart');
                    new_cart = current_cart.replace("%2c" + productId + '-' + quantity, "");
                    new_cart = new_cart.replace("%2c" + productId + '-', "0");
                    createCookie('shopping_cart', new_cart, 1);
                    noty({
                        text: '<h4>Thành công</h4><p>Sản phẩm ' + namePro + ' đã bị xóa khỏi giỏ hàng!</p>',
                        type: 'success',
                        theme: 'metroui',
                        layout: 'topRight',
                        timeout: 3000,
                        progressBar: true, killer: true,
                        animation: {
                            open: 'animated fadeIn',
                            close: 'animated fadeOut',
                            speed: 200
                        }
                    });
                    setInterval(function () {
                        window.location.href = "/gio-hang";
                    }, 500);
                }
            }, {
                addClass: 'btn btn-danger', text: 'Không', onClick: function ($noty) {
                    $noty.close();
                    noty({
                        text: 'Sản phẩm ' + namePro + ' chưa bị xóa, hãy tiếp tục mua hàng!',
                        type: 'information',
                        theme: 'metroui',
                        layout: 'topRight',
                        timeout: 3000,
                        progressBar: true, killer: true,
                        animation: {
                            open: 'animated fadeIn',
                            close: 'animated fadeOut',
                            speed: 200
                        }
                    });
                    newquantity = quantity;
                    window.location.reload();
                }
            }]
        });
    } else {
        if (newquantity > 999) {
            newquantity = 999;
            noty({
                text: '<h4>Không thành công</h4><p>Bạn chỉ được phép mua tối đa số lượng 999 cho mỗi sản phẩm</p>',
                type: 'warning',
                theme: 'metroui',
                layout: 'topRight',
                timeout: 3000,
                progressBar: true,
                killer: true,
                animation: {
                    open: 'animated fadeIn',
                    close: 'animated fadeOut',
                    speed: 200
                }
            });
        } else {
            var current_cart = readCookie('shopping_cart');
            new_cart = current_cart.replace("%2c" + productId + '-' + quantity, "%2c" + productId + '-' + newquantity);
            createCookie('shopping_cart', new_cart, 1);
            setInterval(function () {
                window.location.reload();
            }, 1500);
        }

    }
}
//Delete cart not warning
function deleteFromCartNoWarning(productId, quantity) {
    var current_cart = readCookie('shopping_cart');
    new_cart = current_cart.replace("%2c" + productId + '-' + quantity, "");
    new_cart = new_cart.replace("%2c" + productId + '-', "0");
    createCookie('shopping_cart', new_cart, 1);
    window.location.href = "/gio-hang";
}
//Input Quantity Cart Page
//Click nut "+" tang +1
$('.wan-spinner #plus-cart').click(function () {
    debugger
    var $input = $(this).prev('input');
    var oldQuantity = parseInt($input.val(), 10);
    upInputVal($input);
    var idpro = $input.data("idsub");
    var namepro = $input.data("namesub");
    updateCart(idpro, oldQuantity, namepro);
});
//Click nut "-" tang -1
$('.wan-spinner #minus-cart').click(function () {
    var $input = $(this).next('input');
    var oldQuantity = parseInt($input.val(), 10);
    downInputVal($input);
    var idpro = $input.data("idsub");
    var namepro = $input.data("namesub");
    updateCart(idpro, oldQuantity, namepro);
});
//keydown
$(".wan-spinner-cart .total-mask").keydown(function (e) {
    var $input = $(this);
    switch (e.which) {
        case 38: // up
            upInputVal($input);
            e.preventDefault();
            break;
        case 40: // down
            downInputVal($input);
            e.preventDefault();
            break;
    }
    var idpro = $input.data("idsub");
    var namepro = $input.data("namesub");
    var oldQuantity = $input.data("quantity");
    updateCart(idpro, oldQuantity, namepro);
});
$(".wan-spinner-cart .total-mask").change(function () {
    var idpro = $input.data("idsub");
    var namepro = $input.data("namesub");
    var oldQuantity = $input.data("quantity");
    updateCart(idpro, oldQuantity, namepro);
});
//Update select sub cart page
var oldIdToDelete;
var oldQuantityToDelete;
$(".select-pro-cart").on('focus', function () {
    oldIdToDelete = this.value;
    oldQuantityToDelete = $(this).parents("tr").find(".total-mask").val();
}).change(function () {
    var thisVal = $(this).val();
    deleteFromCartNoWarning(oldIdToDelete, oldQuantityToDelete);
    addToCartRedirectNotWarning(thisVal, 1, "");
});

function deleteAllCart() {
    Lobibox.confirm({
        title: "Xóa tất cả giỏ hàng",
        msg: "Bạn có muốn xóa tất cả sản phẩm trong giỏ hàng?",
        callback: function ($this, type, ev) {
            if (type === 'yes') {
                $.removeCookie('shopping_cart');
                window.location.reload();
            } else if (type === 'no') {
                noty({
                    text: 'Giỏ hàng của bạn chưa bị xóa, hãy tiếp tục mua hàng!',
                    type: 'information',
                    theme: 'metroui',
                    layout: 'topRight',
                    timeout: 3000,
                    progressBar: true, killer: true,
                    animation: {
                        open: 'animated fadeIn',
                        close: 'animated fadeOut',
                        speed: 200
                    }
                });
            }
        }
    });
}



function setCartUrlBack(url) {
    $.cookie('CartUrlBack', url, { expires: 1, path: '/' });
}

$("#add-to-cart-to-payment").click(function (e) {
    e.preventDefault();
    var linkPayment = $(this).data("link");
    var resultCheck = initCheckInputCount($(".total-mask"));
    if (resultCheck != true) {
        var cookieUrlCallBack = $(this).data("modulenameascii");
        setCartUrlBack(cookieUrlCallBack);
        $(".total-mask").each(function () {
            var productSubId = $(this).data("idsub");
            var quantity = $(this).val();
            if (quantity != "0") {
                addToCartRedirect(productSubId, quantity);
            };
        });
        window.location.href = linkPayment;
    } else {
        noty({
            text: '<h4>Không thành công</h4><p>Bạn chưa nhập số lượng!</p>',
            type: 'error',
            theme: 'metroui',
            layout: 'topRight',
            timeout: 3000,
            progressBar: true, killer: true,
            animation: {
                open: 'animated fadeIn',
                close: 'animated fadeOut',
                speed: 200
            }
        });
        $('#cart-small>span:last-child label').html(countShoppingCart("shopping_cart"));
    }
});
//========================================================================================//
//========================================================================================//
//======================================Send Order========================================//
//========================================================================================//
//========================================================================================//

//Function gui don hang 
function doSendOrder() {
    $("#btn-send-order").unbind("click").text("Đang gửi...");
    var d = $("#form-send-order").serialize();
    var url = $("#form-send-order").attr("action");
    $.post(url, d, function (data) {
        if (data.errorcode == 1) {
            $.cookie("shopping_cart", null, { path: '/', expires: -5 });
            window.location.href = data.urlreturn;
        }
        else {
            alert(data.errormessage);
            $("#btn-send-order").bind("click", doSendOrder);
        }
    }, "json");
}
//Validate form order

function frm_send_order() {
    $("#btn-send-order").click(function (e) {
        e.preventDefault();
        $("#form-send-order").submit();
    });
    var v = $("#form-send-order").validate({
        rules: {
            paymentsurname: { required: true },
            paymentname: { required: true },
            paymentemail: { required: true, email: true },
            paymentmobile: { required: true, number: true },
            paymentaddress: { required: true },
        },
        messages: {
            paymentsurname: { required: "Nhập họ của bạn !" },
            paymentname: { required: "Nhập tên của bạn !" },
            paymentemail: { required: "Nhập Email !", email: "Sai định dạng Email !" },
            paymentaddress: { required: "Nhập địa chỉ !" },
            paymentmobile: { required: "Nhập số điện thoại !", number: "Số điện thoại là chữ số !" },
        },
        submitHandler: function () {
            doSendOrder();
        }
    });
}

//Distict by City
$("#paymentcity").change(function () {
    var urlCitybyDistrict = "/Ajax/Payment/DistrictByCity";
    var cityId = $(this).val();
    $.ajax({
        type: "POST",
        url: urlCitybyDistrict,
        data: { cityId: parseInt(cityId) },
        success: function (data) {
            $("#paymentdistric").html(data);
        }
    });
});
//Transport Fee By District ID
$("#paymentdistric").change(function () {
    var urlLogisticFee = "/Ajax/Payment/GetLogisticFee";
    var districtId = $(this).val();
    $.ajax({
        type: "POST",
        url: urlLogisticFee,
        data: { districtId: parseInt(districtId) },
        success: function (data) {
            $("#LogisticFeePayment").text(data).mask('000.000.000.000.000', { reverse: true }).append(" VNĐ");
            $("#spTotal").text(parseInt($("#spTotal").data("total")) + parseInt(data)).mask('000.000.000.000.000', { reverse: true }).append(" VNĐ");
        }
    });
});
$(document).ready(function () {
    $("#count_shopping_cart").text(countShoppingCart("shopping_cart") + " sản phẩm");
    frm_send_order();
})