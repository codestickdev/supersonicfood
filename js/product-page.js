jQuery(document).ready(function($){
    $(".variations_form.cart input[type='number']").attr('readonly', true);
    $('.vpe_table').on( 'click', 'button.plus, button.minus', function() {
        var qty = $( this ).closest('td').find('.variant-qty-input');
        var val  = parseFloat(qty.val());
        var max = parseFloat(qty.attr( 'max' ));
        var min = parseFloat(qty.attr( 'min' ));
        var step = 1;

        if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
                qty.attr('value', max);
                $('.variant-qty-input').trigger('change');
            } else {
                qty.attr('value', val + step);
                $('.variant-qty-input').trigger('change');
            }
        } else {
            if ( min && ( min >= val ) ) {
                qty.attr('value', min);
                $('.variant-qty-input').trigger('change');
            } else if ( val > 0 ) {
                qty.attr('value', val - step);
                $('.variant-qty-input').trigger('change');
            }
        }
        validateVariantsQty();
        calculatePriceAndRations();
    });

    $('.cartModal__product').each(function(){
        var attr = $(this).attr('id');
        if (typeof attr !== typeof undefined && attr !== false && attr == '103') {
            $('body').addClass('thisProductinCart');
        }
    });

    function validateVariantsQty() {
        let fields = $('.variations_form.cart').serializeArray();
        let minQtyFromBackend = 1;
        let variantsQty = 0;
        var discountWrap = $('.productDiscount');
        var discountWrap_postid = $('.productDiscount').attr('postid');
        let powderItems = $('body').attr('powderitems');

        if($('.variations_form.cart').data('min-qty'))
            if($('body').hasClass('thisProductinCart')){
                minQtyFromBackend = 0;
            }else{
                minQtyFromBackend = $('.variations_form.cart').data('min-qty');
            }
        for(var i = 0 ; i < fields.length ; i++){
            variantsQty = variantsQty + parseInt(fields[i].value);
        }
        if (discountWrap_postid == '103' || discountWrap_postid == '2476'){
            if(powderItems <= 1){
                if (variantsQty >= 1 && variantsQty >= minQtyFromBackend) {
                    $('.vpe_single_add_to_cart_button').attr("disabled", false);
                    $('.form-title.minimumQuantity').addClass('active');
                    $('.mobile-shop-info').addClass('active');
                } else {
                    $('.vpe_single_add_to_cart_button').attr("disabled", true);
                    $('.form-title.minimumQuantity').removeClass('active');
                    $('.mobile-shop-info').removeClass('active');
                }
            }else{
                $('.form-title.minimumQuantity').addClass('active');
            }
        }
        
        discountWrap.attr('qty', variantsQty);
        discountWrap.find('.productQty').text(variantsQty);
        if (discountWrap_postid == '103' || discountWrap_postid == '2476'){
            if(variantsQty < 3){
                discountWrap.fadeOut().removeClass('productDiscount--active');
                discountWrap.find('.rabatValue').text('0');
            }else if(variantsQty == 3){
                discountWrap.fadeIn().addClass('productDiscount--active');
                discountWrap.find('.rabatValue').text('3');
            }else if(variantsQty == 4){
                discountWrap.find('.rabatValue').text('6');
            }else if(variantsQty == 5){
                discountWrap.find('.rabatValue').text('9');
            }else if(variantsQty >= 6){
                discountWrap.find('.rabatValue').text('12');
            }
        }
    }

    function amountScrolled() {
        if($(window).scrollTop() >= $('.variations_form.cart').offset().top + $('.variations_form.cart').outerHeight() - window.innerHeight + 80) {
            $('.mobile-shop-info').addClass('scrolled');
        } else {
            $('.mobile-shop-info').removeClass('scrolled');
        }
    }

    function calculatePriceAndRations() {
        let fields = $('.variations_form.cart').serializeArray();
        let rationsQty = $('.variations_form.cart').data('rations');
        let inputs = $('.variations_form.cart input[type="number"]');
        let rations = 0, regPrice = 0, salePrice = 0;
        let submealRatio = $('.rations-price').data('submeal-ratio');
        let discountValue = $('.productDiscount').find('.rabatValue').text();

        for(var i = 0 ; i < fields.length ; i++) {
            rations = rations + (rationsQty * parseInt(fields[i].value));
            regPrice = regPrice + ($(inputs[i]).data('reg-price') * parseInt(fields[i].value));
            salePrice = salePrice + ($(inputs[i]).data('sale-price') > 0 ? $(inputs[i]).data('sale-price') * parseInt(fields[i].value) : $(inputs[i]).data('reg-price') * parseInt(fields[i].value));
        }
        $('.rations-price .rations span:nth-child(1)').text(rations);
        if (submealRatio);
            $('.rations-price .rations span:nth-child(2)').text(rations * submealRatio);
        $('.rations-price .reg-price span').text(regPrice);
        if (parseInt(regPrice) > parseInt(salePrice)) {
            $('.rations-price .reg-price').addClass('line-through');
            $('.rations-price .sale-price span').text(salePrice);
            $('.rations-price .sale-price').fadeIn();
            $('.mobile-shop-info .price span').text(salePrice);
        } else {
            $('.rations-price .reg-price').removeClass('line-through');
            $('.mobile-shop-info .price span').text(regPrice);
            $('.rations-price .sale-price').fadeOut();
        }
        if (discountValue >= 3){
            $('.rations-price .reg-price').addClass('line-through');

            var priceCalculation = regPrice * discountValue/100;
            var priceParse = parseInt(priceCalculation)
            var updatedPrice = regPrice - priceParse;
            $('.productDiscount').find('.afterPrice').text(updatedPrice);
        }
    }

    validateVariantsQty();
    calculatePriceAndRations();
    $(window).on("scroll", function() {
        amountScrolled();
    });
    $('.mobile-shop-info').on('click', function(){
        $('.vpe_single_add_to_cart_button').click();
    })
});