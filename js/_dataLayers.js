
(function($){
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
    
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
    
            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    /*
     * Virtual Page view
     */
    
    // Popup składniki, dodanie do koszyka
    $('.frontpageModal, #openModal').on('click', function(){
        var pageURL = window.location.pathname;
        var pageTitle = $(document).attr('title');
        var country = $('body').attr('country');

        dataLayer.push({
            event: "virtual_page_view",
            page: pageURL,
            pageTitle: pageTitle,
            countrySF: country
        });
        console.log(pageURL);
    });
    $('body').on('product-added-to-cart', function(){
        var pageURL = window.location.pathname;
        var pageTitle = $(document).attr('title');
        var country = $('body').attr('country');

        dataLayer.push({
            event: "virtual_page_view",
            page: pageURL,
            pageTitle: pageTitle,
            countrySF: country
        });
    });

    /*
     *  Page view
     */
    $('body').on('country_added', function(){
        if(getUrlParameter('utm_source') !== false){
            var utm_source_param = getUrlParameter('utm_source');
        }else{
            var utm_source_param = '';
        }

        if(getUrlParameter('utm_medium') !== false){
            var utm_medium_param = getUrlParameter('utm_medium');
        }else{
            var utm_medium_param = '';
        }

        if(getUrlParameter('utm_campaign') !== false){
            var utm_campaign_param = getUrlParameter('utm_campaign');
        }else{
            var utm_campaign_param = '';
        }

        if(getUrlParameter('utm_content') !== false){
            var utm_content_param = getUrlParameter('utm_content');
        }else{
            var utm_content_param = '';
        }

        if(getUrlParameter('utm_term') !== false){
            var utm_term_param = getUrlParameter('utm_term');
        }else{
            var utm_term_param = '';
        }

        if(getUrlParameter('me_ad_id') !== false){
            var me_ad_id_param = getUrlParameter('me_ad_id');
        }else{
            var me_ad_id_param = '';
        }
        
        var country = $('body').attr('country');
    
        dataLayer.push({
            event: "page_view",
            utm_source: utm_source_param,
            utm_medium: utm_medium_param,
            utm_campaign: utm_campaign_param,
            utm_content: utm_content_param,
            utm_term: utm_term_param,
            me_ad_id: me_ad_id_param,
            countrySF: country
        });
    });

    /*
     *  Product list event
     */
    $('body').on('country_added', function(){
        if($('body').hasClass('page-template-page_products')){
            if($('.productsList').length){
                var country = $('body').attr('country');
                var items = [];
                var itemsUA = [];

                $('.productsList__product').each(function(){
                    var name = $(this).find('p').text();
                    var id = $(this).attr('productid');

                    items.push({ item_name: name, item_id: id, item_brand: 'SUPERSONIC' });
                    itemsUA.push({ 'name': name, 'id': id, 'brand': 'SUPERSONIC' });
                });

                dataLayer.push({ ecommerce: null });
                dataLayer.push({
                    event: "view_item_list",
                    ecommerce: {
                        items: items
                    },
                    countrySF: country,
                });
                dataLayer.push({ ecommerce: null });
                dataLayer.push({
                    'event': "view_item_list_UA",
                    'ecommerce': {
                        'impressions': itemsUA
                    },
                    countrySF: country
                });
            }
        }
    });

    /*
     *  View product event
     */
    $('body').on('country_added', function(){
        if($('body').hasClass('single-product')){
            var country = $('body').attr('country');
            var items = [];
            var itemsUA = [];

            if($('#vpe_table').length){
                var name = $('.product_title.entry-title').text();
                var id = $('.product.type-product').attr('id').replace('product-', '');

                $('tr.vpe_row').each(function(){
                    var variant_name = $(this).find('.variation_title').text();
                    var price = $(this).find('input.variant-qty-input').attr('data-reg-price');

                    items.push({ item_name: name, item_id: id, price: price, item_brand: 'SUPERSONIC', item_variant: variant_name });
                    itemsUA.push({ 'name': name, 'id': id, 'price': price, 'brand': 'SUPERSONIC', 'variant': variant_name });
                });
            }else{
                var name = $('.product_title.entry-title').text();
                var id = $('.product.type-product').attr('id').replace('product-', '');
                var price = $('.productPrice').attr('data-price');

                items.push({ item_name: name, item_id: id, price: price, item_brand: 'SUPERSONIC', item_variant: "" });
                itemsUA.push({ 'name': name, 'id': id, 'price': price, 'brand': 'SUPERSONIC', 'variant': "" });
            }

            dataLayer.push({ ecommerce: null });
            dataLayer.push({
                event: "view_item",
                ecommerce: {
                    items: items,
                },
                countrySF: country,
            });

            dataLayer.push({ ecommerce: null });
            dataLayer.push({
                'event': "view_item_UA",
                'ecommerce': {
                    'detail': {
                        'products': itemsUA,
                    }
                },
                countrySF: country
            });
        }
    });

    /*
     *  Add product to cart
     */
    $('.addedtrigger').on('click', function(){
        $('body').trigger('product-added-to-cart');
    });
    $('body').on('product-added-to-cart', function(){
        $('body').on('cart-id-created', function(){
            var country = $('body').attr('country');
            var getCurrency = $('body').attr('currency');
            var cartid = $('body').attr('data-cartid');
            if (typeof cartid == 'undefined' && cartid == false) {
                cartid = $('body').attr('data-cartid');
            }
            var currency;
            if(getCurrency == 'zł'){
                currency = 'PLN';
            }else{
                currency = 'EUR';
            }

            var items = [];
            var itemsUA = [];

            if($('#vpe_table').length){
                var name = $('.product_title.entry-title').text();
                var id = $('.product.type-product').attr('id').replace('product-', '');

                $('tr.vpe_row').each(function(){
                    var input = $(this).find('input.variant-qty-input');
                    if(parseFloat(input.attr('value')) > 0){
                        var price = input.attr('data-reg-price');
                        var item_variant = $(this).find('.variation_title').text();
                        var item_variant_id = input.attr('data-variation-id');
                        var quantity = input.attr('value');
                        var imageUrl = $(this).find('.variation-image-id').attr('href');
                        var currentUrl = window.location.href;

                        items.push({ item_name: name, item_id: id, price: price, item_brand: 'SUPERSONIC', item_variant: item_variant, item_variant_id: item_variant_id, quantity: quantity, img_url: imageUrl, url: currentUrl });
                        itemsUA.push({ 'name': name, 'id': id, 'price': price, 'brand': 'SUPERSONIC', 'variant': item_variant, 'variant_id': item_variant_id, 'quantity': quantity });
                    }
                });
            }else{
                var name = $('.product_title.entry-title').text();
                var id = $('.product.type-product').attr('id').replace('product-', '');
                var price = $('.productPrice').attr('data-price');
                var quantity = $('form.cart').find('.quantity').find('input[type="number"]').val();

                items.push({ item_name: name, item_id: id, price: price, item_brand: 'SUPERSONIC', item_variant: "", quantity: quantity });
                itemsUA.push({ 'name': name, 'id': id, 'price': price, 'brand': 'SUPERSONIC', 'variant': "", 'variant_id': "", 'quantity': quantity });
            }

            // Send data to GTM
            dataLayer.push({ ecommerce: null });
            dataLayer.push({
                event: "add_to_cart",
                currency: currency,
                ecommerce: {
                    items: items,
                },
                cart_id: cartid,
                countrySF: country
            });

            dataLayer.push({ ecommerce: null });
            dataLayer.push({
                'event': "add_to_cart_UA",
                'ecommerce': {
                    'currencyCode': currency,
                    'add': {
                        'products': itemsUA,
                    }
                },
                cart_id: cartid,
                countrySF: country
            });
        });
    });

    /*
     *  Usunięcie produktu z koszyka
     */
    function removeActionGTM(){
        $('.product-remove a').on('click', function(){
            var country = $('body').attr('country');
            var getCurrency = $('body').attr('currency');
            var cartid = $('body').attr('data-cartid');
            if (typeof cartid == 'undefined' && cartid == false) {
                cartid = '';
            }
            var currency;
            if(getCurrency == 'zł'){
                currency = 'PLN';
            }else{
                currency = 'EUR';
            }

            var parent = $(this).parent().parent();
            var name = parent.find('.product-name').attr('data-name');
            var id = parent.attr('productid');
            var price = parent.find('.product-price').attr('data-price');

            // variant
            var variantID = parent.attr('variantid');

            if(variantID.length){
                var productName = name + ' – ';
                var getVariant_name = parent.find('.product-name').find('a').text();
                var variantName = getVariant_name.replace(productName, '');
            }else{
                var variantName = "";
                variantID = "";
            }
            
            var category = "";
            var quantityInput = parent.find('.product-quantity').find('input[type="number"]');
            var quantity;
            if(quantityInput.length){
                quantity = quantityInput.val();
            }else{
                quantity = 1;
            }

            var image = parent.find('.product-thumbnail').find('img').attr('src');
            var url = parent.find('.product-name').find('a').attr('href');

            var items = [];
            var itemsUA = [];
            items.push({
                item_name: name,
                item_id: id,
                price: price,
                item_brand: "SUPERSONIC",
                item_variant: variantName,
                item_variant_id: variantID,
                quantity: quantity,
                img_url: image,
                url: url,
            });
            itemsUA.push({
                'name': name,
                'id': id,
                'price': price,
                'brand': "SUPERSONIC",
                'variant': variantName,
                'variant_id': variantID,
                'quantity': quantity,
            })

            if(items.length !== 0){
                $(document.body).one('updated_cart_totals removed_from_cart wc_cart_emptied', function(){
                    dataLayer.push({ ecommerce: null });
                    dataLayer.push({
                        event: "remove_from_cart",
                        currency: currency,
                        ecommerce: {
                            items: items,
                        },
                        cart_id: cartid,
                        countrySF: country
                    });
                    
                    dataLayer.push({ ecommerce: null });
                    dataLayer.push({
                        'event': "remove_from_cart_UA",
                        'ecommerce': {
                            'remove': {
                                'products': itemsUA
                            }
                        },
                        cart_id: cartid,
                        countrySF: country
                    });
                });
            }
        });
    }
    $(document).one('ready', function(){
        removeActionGTM();
    });
    $(document.body).on('updated_cart_totals removed_from_cart wc_cart_emptied', function(){
        removeActionGTM();
    });


    /*
     *  Przejście do checkout'u
     */
    function beginCheckoutGTM(){
        $('.wc-proceed-to-checkout a').on('click', function(e){
            var country = $('body').attr('country');
            var getCurrency = $('body').attr('currency');
            var cartid = $('body').attr('data-cartid');
            if (typeof cartid == 'undefined' && cartid == false) {
                cartid = '';
            }
            var currency;
            if(getCurrency == 'zł'){
                currency = 'PLN';
            }else{
                currency = 'EUR';
            }
            var cartValue = $('.cart_totals').attr('data-total');
    
            var items = [];
            var itemsUA = [];
            $('.woocommerce-cart-form__cart-item').each(function(){
                if($(this).find('.product-price').attr('data-price') !== '0'){
                    var name = $(this).find('.product-name').attr('data-name');
                    var id = $(this).attr('productid');
                    var price = $(this).find('.product-price').attr('data-price');
    
                    // variant
                    var variantID = $(this).attr('variantid');
    
                    if(variantID !== undefined){
                        var productName = name + ' – ';
                        var getVariant_name = $(this).find('.product-name').find('a').text();
                        var variantName = getVariant_name.replace(productName, '');
                    }else{
                        var variantName = "";
                        variantID = "";
                    }
                    
                    var category = "";
                    var quantityInput = $(this).find('.product-quantity').find('input[type="number"]');
                    var quantity;
                    if(quantityInput.length){
                        quantity = quantityInput.val();
                    }else{
                        quantity = 1;
                    }
    
                    var image = $(this).find('.product-thumbnail').find('img').attr('src');
                    var url = $(this).find('.product-name').find('a').attr('href');
    
                    
                    items.push({
                        item_name: name,
                        item_id: id,
                        price: price,
                        item_brand: "SUPERSONIC",
                        item_variant: variantName,
                        item_variant_id: variantID,
                        quantity: quantity,
                        img_url: image,
                        url: url,
                    });
                    itemsUA.push({
                        'name': name,
                        'id': id,
                        'price': price,
                        'brand': "SUPERSONIC",
                        'variant': variantName,
                        'variant_id': variantID,
                        'quantity': quantity,
                    })
                }
            });
    
            dataLayer.push({ ecommerce: null });
            dataLayer.push({
                event: "begin_checkout",
                currency: currency,
                value: cartValue,
                ecommerce: {
                    items: items,
                },
                cart_id: cartid,
                countrySF: country,
            });
            dataLayer.push({ ecommerce: null });
            dataLayer.push({
                'event': "begin_checkout_UA",
                'ecommerce': {
                    'currencyCode': currency,
                    'checkout': {
                        'actionField': {'step': 1, 'option': 'Begin Checkout'},
                        'products': itemsUA
                    }
                },
                cart_id: cartid,
                countrySF: country
            });
        });
    }
    $(document).one('ready', function(){
        beginCheckoutGTM();
    });
    $(document.body).on('updated_cart_totals removed_from_cart', function(){
        beginCheckoutGTM();
    });


    /*
     *  Kupuję i płacę lub wybór PayPal
     */
    function sendCheckoutData(){
        var country = $('body').attr('country');
        var getCurrency = $('body').attr('currency');
        var cartid = $('body').attr('data-cartid');
        if (typeof cartid == 'undefined' && cartid == false) {
            cartid = '';
        }
        var currency;
        if(getCurrency == 'zł'){
            currency = 'PLN';
        }else{
            currency = 'EUR';
        }
        var orderTotal = $('#order_review').attr('data-order-total');
        var orderCoupon = $('#order_review').attr('data-coupon');
        var orderCouponValue = $('#order_review').attr('data-coupon-value');
        var orderCouponType = $('#order_review').attr('data-coupon-type');

        if(orderCouponType == 'percent'){
            orderCouponValue += '%';
        }else{
            orderCouponValue += ' ' + currency;
        }

        //  Products

        var items = [];
        var itemsUA = [];
        $('.ssCheckout__gtmData div').each(function(){
            var name = $(this).attr('data-title');
            var id = $(this).attr('data-id');
            var price = $(this).attr('data-price');
            var variantName = $(this).attr('data-variant-name');
            var variantID = $(this).attr('data-variant-id');
            var variantID = $(this).attr('data-variant-id');
            var quantity = $(this).attr('data-quantity');
            var image = $(this).attr('data-image');
            var url = $(this).attr('data-url');

            items.push({
                item_name: name,
                item_id: id,
                coupon: orderCoupon,
                discount: orderCouponValue,
                price: price,
                item_brand: "SUPERSONIC",
                item_variant: variantName,
                item_variant_id: variantID,
                item_category: '',
                quantity: quantity,
                img_url: image,
                url: url,
            });
            itemsUA.push({
                'name': name,
                'id': id,
                'price': price,
                'brand': "SUPERSONIC",
                'variant': variantName,
                'variant_id': variantID,
                'quantity': quantity,
            });
        });

        var userID = $('.ssCheckout').attr('user-id');
        var firstName = $('input[name="billing_first_name"]').val();
        var lastName = $('input[name="billing_last_name"]').val();
        var email = $('input[name="billing_email"]').val();
        var phone = $('input[name="billing_phone"]').val();
        
        if($('#gr_checkout_checkbox').is(':checked')){
            var marketing = true;
        }else if($('#gr_checkout_checkbox').is(":not(:checked)")){
            var marketing = false;
        }

        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            event: "add_shipping_info",
            currency: currency,
            value: orderTotal,
            coupon: orderCoupon,
            discount: orderCouponValue,
            ecommerce: {
                shipping_tier: "1",
                items: items,
                user_id: userID,
                first_name: firstName,
                last_name: lastName,
                email: email,
                phone_number: phone,
                marketing_consent: marketing,
                cart_id: cartid,
                countrySF: country,
            }
        });
        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            'event': "add_shipping_info_UA",
            'currencyCode': currency,
            value: orderTotal,
            coupon: orderCoupon,
            affiliation: "Online Store",
            discount: orderCouponValue,
            'ecommerce': {
                'checkout': {
                    'actionField': {'step': 2, 'option': 'Add Shipping Info'},
                    'products': itemsUA,
                }
            },
            user_id: userID,
            cart_id: cartid,
            countrySF: country
        });
        console.log('add_shipping_info');
    }
    
    // $(document.body).on('updated_cart_totals updated_checkout', function(){
    //     $('#place_order').off('click.gtm');
    //     $('#terms').off('click.gtm');

    //     if($('input[value="payu"]').is(":checked")){
    //         $('#place_order').on('click.gtm', sendCheckoutData);
            
    //     }else if($('input[value="payu"]').is(':not(:checked)')){
    //         $('#terms').on('click.gtm', function(){
    //             if($(this).is(":checked")){
    //                 console.log('sent');
    //                 sendCheckoutData();
    //             }
    //         });
    //     }

    //     $('input[name="payment_method"]').each(function(){            
    //         $(this).on('click', function(){
    //             $('#place_order').off('click.gtm');
    //             $('#terms').off('click.gtm');

    //             if($(this).attr('value') == 'payu'){
    //                 $('#place_order').on('click.gtm', sendCheckoutData);
    //             }else{
    //                 $('#terms').on('click.gtm', function(){
    //                     if($(this).is(":checked")){
    //                         console.log('sent');
    //                         sendCheckoutData();
    //                     }
    //                 });
    //             }
    //         });
    //     });
    // });

    /*
     *  Payment info
     */
    function sendPaymentInfo(){
        var country = $('body').attr('country');
        var getCurrency = $('body').attr('currency');
        var cartid = $('body').attr('data-cartid');
        if (typeof cartid == 'undefined' && cartid == false) {
            cartid = '';
        }
        var currency;
        if(getCurrency == 'zł'){
            currency = 'PLN';
        }else{
            currency = 'EUR';
        }
        var orderTotal = $('#order_review').attr('data-order-total');
        var orderCoupon = $('#order_review').attr('data-coupon');
        var orderCouponValue = $('#order_review').attr('data-coupon-value');
        var orderCouponType = $('#order_review').attr('data-coupon-type');
        var orderCouponAmount = $('#order_review').attr('data-coupon-total');

        if(orderCouponType == 'percent'){
            orderCouponValue += '%';
        }

        //  Products

        var items = [];
        var itemsUA = [];
        $('.ssCheckout__gtmData div').each(function(){
            var name = $(this).attr('data-title');
            var id = $(this).attr('data-id');
            var price = $(this).attr('data-price');
            var variantID = $(this).attr('data-variant-id');
            if(variantID !== '0'){
                var variantName = $(this).attr('data-variant-name');
            }else{
                variantID = "";
                var variantName = "";
            }
            var quantity = $(this).attr('data-quantity');
            var image = $(this).attr('data-image');
            var url = $(this).attr('data-url');

            items.push({
                item_name: name,
                item_id: id,
                coupon: orderCoupon,
                discount: orderCouponValue,
                price: price,
                item_brand: "SUPERSONIC",
                item_variant: variantName,
                item_variant_id: variantID,
                item_category: "",
                quantity: quantity,
                img_url: image,
                url: url,
            });
            itemsUA.push({
                'name': name,
                'id': id,
                'price': price,
                'brand': "SUPERSONIC",
                'variant': variantName,
                'variant_id': variantID,
                'quantity': quantity,
            });
        });

        var userID = $('.ssCheckout').attr('user-id');
        var firstName = $('input[name="billing_first_name"]').val();
        var lastName = $('input[name="billing_last_name"]').val();
        var email = $('input[name="billing_email"]').val();
        var phone = $('input[name="billing_phone"]').val();
        
        if($('#gr_checkout_checkbox').is(':checked')){
            var marketing = true;
        }else if($('#gr_checkout_checkbox').is(":not(:checked)")){
            var marketing = false;
        }

        if($('input[value="ppec_paypal"]').is(':checked')){
            var payment = 'PayPal';
        }else{
            var payment = 'PayU';
        }

        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            event: "add_payment_info",
            currency: currency,
            value: orderTotal,
            coupon: orderCoupon,
            discount: orderCouponAmount,
            ecommerce: {
                payment_type: payment,
                items: items,
                user_id: userID,
                first_name: firstName,
                last_name: lastName,
                email: email,
                phone_number: phone,
                marketing_consent: marketing,
                cart_id: cartid,
                countrySF: country
            }
        });
        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            'event': "add_payment_info_UA",
            'currencyCode': currency,
            value: orderTotal,
            coupon: orderCoupon,
            payment_type: payment,
            affiliation: "Online Store",
            discount: orderCouponAmount,
            'ecommerce': {
                'checkout': {
                    'actionField': {'step': 3, 'option': 'Add Payment Info'},
                    'products': items,
                }
            },
            user_id: userID,
            cart_id: cartid,
            countrySF: country
        });
        console.log('add_payment_info');
    }

    $(document.body).on('init_checkout update_checkout updated_checkout updated_cart_totals', function(){
        console.log('updated checkout');
        $('#place_order').off('click.gtm');
        $('#terms').off('click.gtm');

        if($('input[value="payustandard"]').is(":checked")){
            $('#place_order').on('click.gtm', function(){
                console.log('payu_sent');
                sendPaymentInfo();
                sendCheckoutData();
            });
        }else if($('input[value="payustandard"]').is(':not(:checked)')){
            $('#terms').on('click.gtm', function(){
                if($(this).is(":checked")){
                    console.log('other_sent');
                    sendPaymentInfo();
                    sendCheckoutData();
                }
            });
        }

        $('input[name="payment_method"]').each(function(){            
            $(this).on('click', function(){
                $('#place_order').off('click.gtm');
                $('#terms').off('click.gtm');

                if($(this).attr('value') == 'payustandard'){
                    $('#place_order').on('click.gtm', function(){
                        console.log('payu_sent');
                        sendPaymentInfo();
                        sendCheckoutData();
                    });
                }else{
                    $('#terms').on('click.gtm', function(){
                        if($(this).is(":checked")){
                            console.log('other_sent');
                            sendPaymentInfo();
                            sendCheckoutData();
                        }
                    });
                }
            });
        });
    });


    /*
     *  Udane zamówienie
     */
    function sendPurchaseInfo(id){
        var country = $('body').attr('country');
        var getCurrency = $('body').attr('currency');
        var cartid = $('body').attr('data-cartid');
        if (typeof cartid == 'undefined' && cartid == false) {
            cartid = '';
        }
        var currency;
        if(getCurrency == 'zł'){
            currency = 'PLN';
        }else{
            currency = 'EUR';
        }
        var value = parseFloat($('.woocommerce-order').attr('orderamount'));
        var orderID = id;
        var tax = parseFloat($('.woocommerce-order').attr('ordertax'));
        var valueBurtto = value + tax;
        var shipping = $('.woocommerce-order').attr('shippingcost');
        var coupon = $('.woocommerce-order').attr('couponcode');


        //  Products

        var items = [];
        var itemsUA = [];
        $('.thankyou__gtm div').each(function(){
            var name = $(this).attr('data-title');
            var id = $(this).attr('data-id');
            var price = $(this).attr('data-price');
            var variantID = $(this).attr('data-variant-id');
            if(variantID !== '0'){
                var variantName = $(this).attr('data-variant-name');
            }else{
                variantID = "";
                var variantName = "";
            }
            var quantity = $(this).attr('data-quantity');
            var image = $(this).attr('data-image');
            var url = $(this).attr('data-url');

            items.push({
                item_name: name,
                item_id: id,
                price: price,
                item_brand: "SUPERSONIC",
                item_variant: variantName,
                item_variant_id: variantID,
                item_category: "",
                quantity: quantity,
                img_url: image,
                url: url,
            });
            itemsUA.push({
                'name': name,
                'id': id,
                'price': price,
                'brand': "SUPERSONIC",
                'variant': variantName,
                'variant_id': variantID,
                'quantity': quantity,
            });
        });

        var userid = $('.thankyou__gtm').attr('userid');
        var firstname = $('.thankyou__gtm').attr('firstname');
        var lastname = $('.thankyou__gtm').attr('lastname');
        var email = $('.thankyou__gtm').attr('email');
        var phone = $('.thankyou__gtm').attr('phone');

        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            event: "purchase",
            ecommerce: {
                transaction_id: orderID,
                affiliation: "Online Store",
                value: valueBurtto,
                tax: tax,
                shipping: shipping,
                currency: currency,
                coupon: coupon,
                items: items,
            },
            user_id: userid,
            first_name: firstname,
            last_name: lastname,
            email: email,
            phone_number: phone,
            marketing_consent: false,
            cart_id: cartid,
            countrySF: country
        });
        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            'event': "purchase_UA",
            'ecommerce': {
                currencyCode: currency,
                'purchase': {
                    'actionField': {
                        'id': orderID,
                        'affiliation': 'Online Store',
                        'revenue': valueBurtto,
                        'tax': tax,
                        'shipping': shipping,
                        'coupon': coupon
                    },
                    'products': itemsUA
                }
            },
            user_id: userid,
            cart_id: cartid,
            countrySF: country
        });

        if(userid > 0){
            dataLayer.push({
                event: "sign_up",
                user_id: userid,
                first_name: firstname,
                last_name: lastname,
                email: email,
                phone_number: phone,
                marketing_consent: "",
                countrySF: country
            });
            console.log('user_sign_up');
        }
        $('body').trigger('purchase_event_sent');
    }
    $('body').on('country_added', function(){
        if($('body').hasClass('woocommerce-order-received')){
            var orderID = $('.woocommerce-order').attr('orderid');
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'gtm_purchase',
                    orderid: orderID,
                },
                success: function(data){
                    console.log(data);
                    if(data == 'new_order'){
                        sendPurchaseInfo(orderID);
                    }
                },
            })
        }
    });

    /*
     *  Update user data
     */
    $('body').on('country_added', function(){
        if($('button[name="save_address"]').length){
            $('button[name="save_address"]').on('click', function(e){
                var country = $('body').attr('country');
                var userid = $('body').attr('userid');

                if($('#shipping_first_name').length){
                    var firstname = $('#shipping_first_name').val();
                    var lastname = $('#shipping_last_name').val();
                    var email = $('body').attr('user-email');
                    var phone = $('body').attr('user-phone');
                }else{
                    var firstname = $('#billing_first_name').val();
                    var lastname = $('#billing_last_name').val();
                    var email = $('#billing_email').val();
                    var phone = $('#billing_phone').val();
                }
                
                dataLayer.push({
                    event: "user_data_changed",
                    user_id: userid,
                    first_name: firstname,
                    last_name: lastname,
                    email: email,
                    phone_number: phone,
                    marketing_consent: false,
                    countrySF: country
                });
            });
        }
    });

    /**
     * User register
     */
    $('form.woocommerce-form-register').on('submit', function(){
        var email = $(this).find('#reg_email').val();
        var pass = $(this).find('#reg_password').val();

        if(email !== '' && pass !== ''){
            var country = $('body').attr('country');

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'get_user_id',
                    email: email,
                },
                success: function(data_id){
                    dataLayer.push({
                        event: "sign_up",
                        user_id: data_id,
                        first_name: "",
                        last_name: "",
                        email: email,
                        phone_number: "",
                        marketing_consent: false,
                        countrySF: country,
                    });
                },
            });
        }
    });

    /**
     * Cart ID create
     */
    $(document).ready(function(){

        // Clear cart
        var clearcart = getUrlParameter('empty-cart');
        if(clearcart == 'clearcart'){
            localStorage.removeItem('cartid');
        }
        $(document.body).on('wc_cart_emptied', function(){
            localStorage.removeItem('cartid');
        });

        // Order received
        if($('body').hasClass('woocommerce-order-received')){
            $('body').on('purchase_event_sent', function(){
                localStorage.removeItem('cartid');
            });
        }
    });
    $(document).ready(function(){
        var cartID = localStorage.getItem('cartid');
        if (cartID !== null){
            console.log('localStorage - cartid has value - ' + cartID + ' added to parameter');
            $('body').attr('data-cartid', cartID);
            $('body').trigger('cart-id-added');
        }else{
            console.log('localStorage - cartid is empty - ' + cartID);
        }

        $('body').on('product-added-to-cart', function(){
            if (cartID !== null){
                console.log('localStorage - cartid has value - ' + cartID);
            }else{
                var random = Math.floor(Math.random() * (9999999 - 1000000 + 1)) + 1000000;
                localStorage.setItem('cartid', random);
                cartID = localStorage.getItem('cartid');
                console.log('setting - ' + cartID);
                $('body').attr('data-cartid', cartID);
                $('body').trigger('cart-id-created');
            }
        });
    });
}(jQuery))