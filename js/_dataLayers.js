
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
    $(document).ready(function(){
        var utm_source_param = getUrlParameter('utm_source');
        var utm_medium_param = getUrlParameter('utm_medium');
        var utm_campaign_param = getUrlParameter('utm_campaign');
        var utm_content_param = getUrlParameter('utm_content');
        var utm_term_param = getUrlParameter('utm_term');
        var me_ad_id_param = getUrlParameter('me_ad_id');
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
    $(document).ready(function(){
        if($('body').hasClass('post-type-archive-product')){
            if($('.shopProdcuts').length){
                var country = $('body').attr('country');
                var items = [];
                var itemsUA = [];

                $('.productTile').each(function(){
                    var name = $(this).find('.productTile__title').text();
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
    $(document).ready(function(){
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

            items.push({ item_name: name, item_id: id, price: price, item_brand: 'SUPERSONIC', item_variant: false });
            itemsUA.push({ 'name': name, 'id': id, 'price': price, 'brand': 'SUPERSONIC', 'variant': false });
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
    });

    /*
     *  Add product to cart
     */
    $('.addedtrigger').on('click', function(){
        $('body').trigger('product-added-to-cart');
    });
    $('body').on('product-added-to-cart', function(){
        var country = $('body').attr('country');
        var getCurrency = $('body').attr('currency');
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

                    items.push({ item_name: name, item_id: id, price: price, item_brand: 'SUPERSONIC', item_variant: item_variant, quantity: quantity });
                    itemsUA.push({ 'name': name, 'id': id, 'price': price, 'brand': 'SUPERSONIC', 'variant': item_variant, 'variant_id': item_variant_id, 'quantity': quantity });
                }
            });
        }else{
            var name = $('.product_title.entry-title').text();
            var id = $('.product.type-product').attr('id').replace('product-', '');
            var price = $('.productPrice').attr('data-price');
            var quantity = $('form.cart').find('.quantity').find('input[type="number"]').val();

            items.push({ item_name: name, item_id: id, price: price, item_brand: 'SUPERSONIC', item_variant: false, quantity: quantity });
            itemsUA.push({ 'name': name, 'id': id, 'price': price, 'brand': 'SUPERSONIC', 'variant': false, 'variant_id': false, 'quantity': quantity });
        }
        console.log(items);

        // Send data to GTM
        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            event: "add_to_cart",
            currency: currency,
            ecommerce: {
                items: items,
            },
            cart_id: false,
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
            cart_id: false,
            countrySF: country
        });
    });

    /* 
     *  Add quantity in cart 
     */
    var quantityChanged;
    $(document).ready(function(){
        quantityChanged = false;

        var input = $('.quantity').find('input[type="number"]');
        var inputs = [];
        var products = [];
        var productsUA = [];

        $(input).each(function(){
            var parent = $(this).parent().parent().parent();
            var value = $(this).val();

            if(parent.attr('variantid').length){
                var id = parent.attr('variantid');
            }else{
                var id = parent.attr('productid');
            }
            
            inputs.push({input_id: id, input_value: value});
        });
        $(input).on('change', function(){
            var parent = $(this).parent().parent().parent();
            var name = parent.find('.product-name').attr('data-name');
            var id = parent.attr('productid');
            if(parent.attr('variantid').length){
                var variant_id = parent.attr('variantid');
            }else{
                var variant_id = false;
            }
            
            var price = parent.find('.product-price').attr('data-price');

            // variant name
            var productName = name + ' – ';
            var getVariant_name = parent.find('.product-name').find('a').text();
            var variant_name = getVariant_name.replace(productName, '');

            var quantity = $(this).val();

            var currentInputs = [];
            currentInputs.push({input_id: id, input_value: quantity});

            $(inputs).each(function(key, value) {
                var inputs_input_id = value['input_id'];
                var inputs_input_value = value['input_value'];

                $(currentInputs).each(function(key, value){
                    var currentInputs_input_id = value['input_id'];
                    var currentInputs_input_value = value['input_value'];

                    if(inputs_input_id == currentInputs_input_id){
                        if(inputs_input_value < currentInputs_input_value){
                            quantityChanged = true;
                            products.splice( $.inArray(inputs_input_id, products), 1);
                            productsUA.splice( $.inArray(inputs_input_id, products), 1);

                            products.push({item_name: name, item_id: id, price: price, item_brand: 'SUPERSONIC', item_variant: variant_name, quantity: quantity});
                            itemsUA.push({ 'name': name, 'id': id, 'price': price, 'brand': 'SUPERSONIC', 'variant': variant_name, 'variant_id': variant_id, 'quantity': quantity });
                        }else{
                            quantityChanged = false;
                            products.splice( $.inArray(inputs_input_id, products), 1);
                            productsUA.splice( $.inArray(inputs_input_id, products), 1);
                        }
                    }
                });
            });
            // console.log(inputs);
            // console.log(currentInputs);
            // console.log(products);
        });
        $(document.body).on('updated_cart_totals', function(){
            if($('.ssCart').length){
                if(quantityChanged == true){
                    var country = $('body').attr('country');
                    var getCurrency = $('body').attr('currency');
                    var currency;
                    if(getCurrency == 'zł'){
                        currency = 'PLN';
                    }else{
                        currency = 'EUR';
                    }
    
                    dataLayer.push({ ecommerce: null });
                    dataLayer.push({
                        event: "add_to_cart",
                        currency: currency,
                        ecommerce: {
                            items: products
                        },
                        cart_id: false,
                        countrySF: country
                    });
    
                    dataLayer.push({ ecommerce: null });
                    dataLayer.push({
                        'event': "add_to_cart_UA",
                        'ecommerce': {
                            'currencyCode': currency,
                            'add': {
                                'products': productsUA,
                            }
                        },
                        cart_id: false,
                        countrySF: country
                    });
                }
            }
        });
    });


    /*
     *  Usunięcie produktu z koszyka
     */
    function removeActionGTM(){
        console.log('ready');
        $('.product-remove a').on('click', function(){
            var country = $('body').attr('country');
            var getCurrency = $('body').attr('currency');
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
                var variantName = false;
                variantID = false;
            }
            
            var category = false;
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
                        cart_id: false,
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
                        cart_id: false,
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
    $('.wc-proceed-to-checkout a').on('click', function(e){
        var country = $('body').attr('country');
        var getCurrency = $('body').attr('currency');
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
                    var variantName = false;
                    variantID = false;
                }
                
                var category = false;
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
            cart_id: false,
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
            cart_id: false,
            countrySF: country
        });
    });


    /*
     *  Kupuję i płacę lub wybór PayPal
     */
    $(document).ready(function(){
        function sendCheckoutData(){
            var country = $('body').attr('country');
            var getCurrency = $('body').attr('currency');
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
                    item_category: false,
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
                    cart_id: false,
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
                cart_id: false,
                countrySF: country
            });
        }
        $('#place_order').on('click', function(){
            sendCheckoutData();
        });
        $('input[value="ppec_paypal"]').on('click', function(){
            sendCheckoutData();
        });
    });

    /*
     *  Payment info
     */
    function sendPaymentInfo(){
        var country = $('body').attr('country');
        var getCurrency = $('body').attr('currency');
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
            var variantID = $(this).attr('data-variant-id');
            if(variantID !== '0'){
                var variantName = $(this).attr('data-variant-name');
            }else{
                variantID = false;
                var variantName = false;
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
                item_category: false,
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
            discount: orderCouponValue,
            ecommerce: {
                payment_type: payment,
                items: items,
                user_id: userID,
                first_name: firstName,
                last_name: lastName,
                email: email,
                phone_number: phone,
                marketing_consent: marketing,
                cart_id: false,
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
            discount: orderCouponValue,
            'ecommerce': {
                'checkout': {
                    'actionField': {'step': 3, 'option': 'Add Payment Info'},
                    'products': items,
                }
            },
            user_id: userID,
            cart_id: false,
            countrySF: country
        });
        dataLayer.push({
            event: "sign_up",
            user_id: userID,
            first_name: firstName,
            last_name: lastName,
            email: email,
            phone_number: phone,
            marketing_consent: marketing,
            countrySF: country
        });
    }
    $('#place_order').on('click', function(){
        sendPaymentInfo();
    });
    var checkInreval = setInterval(function(){ 
        if($('#submit-button').length){
            clearInterval(checkInreval);

            $('#submit-button').on('click', function(){
                sendPaymentInfo();
            });
        }
    }, 5000);


    /*
     *  Udane zamówienie
     */
    $(document).ready(function(){
        if($('body').hasClass('woocommerce-order-received')){
            var country = $('body').attr('country');
            var getCurrency = $('body').attr('currency');
            var currency;
            if(getCurrency == 'zł'){
                currency = 'PLN';
            }else{
                currency = 'EUR';
            }
            var orderID = $('.woocommerce-order').attr('orderid');
            var value = $('.woocommerce-order').attr('orderamount');
            var tax = $('.woocommerce-order').attr('ordertax');
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
                    variantID = false;
                    var variantName = false;
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
                    item_category: false,
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
                    value: value,
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
                cart_id: false,
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
                            'revenue': value,
                            'tax': tax,
                            'shipping': shipping,
                            'coupon': coupon
                        },
                        'products': itemsUA
                    }
                },
                user_id: userid,
                cart_id: false,
                countrySF: country
            });
        }
    });

    /*
     *  Update user data
     */
    $(document).ready(function(){
        if($('button[name="save_address"]').length){
            $('button[name="save_address"]').on('click', function(){
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
}(jQuery))

