(function($) {
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

    function smoothScrollingTo(target) {
        $('html,body').animate({ scrollTop: $(target).offset().top -50 }, 500);
    }
    $('a[href*=\\#]').on('click', function (event) {
        event.preventDefault();
        smoothScrollingTo(this.hash);
    });
    $(document).ready(function () {
        smoothScrollingTo(location.hash);
    });

    /* ---- SITE HEADER ---- */

    $(document).ready(function(){
        var headerHeight = $('#masthead').height();
        $('body').css('margin-top', headerHeight + 'px');
        $('#masthead').addClass('siteHeader--float');
    });
    $(document).ready(function(){
        var dropdownLink = $('li.has-dropdown');
        $(dropdownLink).on('mouseover', function(){
            $('#menuDropdown').addClass('toggle');
        });
        $('#menuDropdown').on('mouseleave', function(){
            $(this).removeClass('toggle');
        });
    });

    /* ---- SITE HEADER MOBILE ---- */

    $(document).ready(function(){

        $('.siteHeader__mobileBtn').on('click', function(){
            $(this).toggleClass('siteHeader__mobileBtn--active');
            $('.mobileMenu').toggleClass('mobileMenu--active');
            $('main.ssfood').toggleClass('ssfood--menuToggle');
        });
    });

    $(document).ready(function(){
        $('.productFaq__categories .cat:first').find('p').addClass('active');
        $('.productFaq__content .questions:first').addClass('active');

        $('.categorySelect').on('click', function(){
            var data = $(this).attr('data');

            $('.categorySelect').removeClass('active');
            $(this).addClass('active');

            $('.productFaq__content').find('.questions').removeClass('active');
            $('.productFaq__content').find('.questions[data="' + data + '"]').addClass('active');
        });

        $('.questions__que').on('click', function(){
            var parent = $(this).parent();
            var ans = parent.find('.questions__ans');

            if ( parent.hasClass('toggle') ){
                parent.removeClass('toggle');
                ans.slideUp();
            }else{
                $('.questions__wrap').removeClass('toggle');
                $('.questions__ans').slideUp();
                parent.addClass('toggle');
                ans.slideDown();
            }
        });
    });

    /* CART */

    if ($(window).width() < 767) {
        $('.coupon__toshow').removeClass('coupon__toshow--toggle');

        $('.coupon-trigger').on('click', function(){
            var couponInput = $(this).parent().find('.coupon__toshow');

            if(couponInput.hasClass('coupon__toshow--toggle')){
                couponInput.removeClass('coupon__toshow--toggle');
                couponInput.slideUp();
            }else{
                couponInput.addClass('coupon__toshow--toggle');
                couponInput.slideDown();
            }
        });
    }else{
        $('.coupon-trigger').on('click', function(){
            $(this).parent().find('.coupon__toshow').toggleClass('coupon__toshow--toggle');
        });
    }

    // if ($(window).width() < 1630) {
    //     $('.blogCategory__wrap').find('.blogCategory__post').removeClass('blogCategory__post--full');
    // }
    if ($(window).width() < 600) {
        $('.blogCategory__wrap').find('.blogCategory__post').addClass('blogCategory__post--full');
    }

    /* Checkout form */
    $(document).ready(function(){
        // Error close
        $('.woocommerce-checkout').bind('DOMSubtreeModified', function(){
            $('.woocommerce-error').on('click', function(){
                $(this).css('display', 'none');
            });
        });
    });

    /* Checkout payment */
    // $('form.checkout').on('update change', function(){
    //     if($('input[name="payment_method"]').is(":checked")){
    //         $(this).parent().addClass('checked');
    //     }
    //     else if($('input[name="payment_method"]').is(":not(:checked)")){
    //         $(this).parent().removeClass('checked');
    //     }
    //     $('input[name="payment_method"]').on('click', function(){
    //         $('input[name="payment_method"]').parent().removeClass('checked');
    //         if($(this).is(":checked")){
    //             $(this).parent().addClass('checked');
    //         }
    //         else if($(this).is(":not(:checked)")){
    //             $(this).parent().removeClass('checked');
    //         }
    //     });
    // })
    // $(document.body).on('update_checkout init_payment_methods payment_method_selected', function(){
    //     if($('input[name="payment_method"]').is(":checked")){
    //         $(this).parent().addClass('checked');
    //     }
    //     else if($('input[name="payment_method"]').is(":not(:checked)")){
    //         $(this).parent().removeClass('checked');
    //     }
    //     $('input[name="payment_method"]').on('click', function(){
    //         $('input[name="payment_method"]').parent().removeClass('checked');
    //         if($(this).is(":checked")){
    //             $(this).parent().addClass('checked');
    //         }
    //         else if($(this).is(":not(:checked)")){
    //             $(this).parent().removeClass('checked');
    //         }
    //     });
    // });

    /* Currency load to span */
    $(document).ready(function(){
        var currenntcurrency = $('body').attr('currency');
        $('.currentCurrency').text(currenntcurrency);
    });

    /* Product flavours order */

    // Powder
    $(document).ready(function(){
        $('.vpe_table tr.vpe_row:eq(4)').insertBefore('.vpe_table tr:eq(0)');
        $('.vpe_table tr.vpe_row:eq(5)').insertBefore('.vpe_table tr:eq(2)');
        console.log('ready');
    });

    /* PRODUCT MODAL */

    var openModalbtn = $('a[href="http://openModal"');
    openModalbtn.removeAttr('href').addClass('frontpageModal');
    $('.frontpageModal').on('click', function(){
        $('body').addClass('modalActive');
        $('#productComponents').addClass('visible');
    });

    $('#openModal').on('click', function(){
        $('body').addClass('modalActive');
        $('#productComponents').addClass('visible');
    });

    $('#openModal').on('click', function(){
        $('body').addClass('modalActive');
        $('#productComponents').addClass('visible');
    });

    $('.closeModal').on('click', function(){
        $('body').removeClass('modalActive');
        $('#productComponents').removeClass('visible');
    });
    $(document).mouseup(function(e){
    var modal = $(".componentsModal__wrap");
    if (!modal.is(e.target) && modal.has(e.target).length === 0){
        modal.parent().removeClass('visible');
        $('body').removeClass('modalActive');
    }
    });

    $('.componentsModal__flavour .heading').on('click', function(){
        if($(this).parent().hasClass('active')){
            $(this).parent().removeClass('active');
            $(this).parent().find('.content').slideUp();
        }else{
            $('.componentsModal__flavours').removeClass('active');
            $('.componentsModal__flavour .content').slideUp();
            $(this).parent().addClass('active');
            $(this).parent().find('.content').slideDown();
        }
    });

    /* ---- CART MODAL ---- */

    $(document).ready(function(){
        if ($(window).width() < 991) {
            $('.user__cart').on('click', function(){
                $('.cartModal').addClass('cartModal--toggle');
            });
        }else{
            $('.user__cart').on('mouseover', function(){
                $('.cartModal').addClass('cartModal--toggle');
            });
        }
        $('.cartModal__wrap').mouseleave(function(){
            $(this).parent().removeClass('cartModal--toggle');
        });
        $(document).mouseup(function(e){
            var cartmodal = $(".cartModal__wrap");
            if (!cartmodal.is(e.target) && cartmodal.has(e.target).length === 0){
                cartmodal.parent().removeClass('cartModal--toggle');
            }
        });

        $('.cartModal__product').each(function(){
            var price = $(this).find('.amount').find('bdi').text();
            
            if(price == '0zł'){
                $(this).find('bdi').text('Gratis');
            }
            if(price == '0€'){
                $(this).find('bdi').text('Free');
            }
        });

        var addedToCart = getUrlParameter('cartModal');
        if(addedToCart == 'success'){
            $('.cartModal').addClass('cartModal--toggle');
        }
    });

    /* ---- TRIBE SUBPAGE ---- */

    $(document).ready(function(){
        $('.openHistory').on('click', function(){
            var historyID = $(this).parent().attr('history-id');
            $('.popupHistory').addClass('popupHistory--active');
            $('.history[history-id="'+ historyID +'"]').addClass('history--toggle');
            $('body').addClass('modalActive');
        });
        $('.closeModal').on('click', function(){
            $(this).parent().parent().removeClass('popupHistory--active');
            $(this).parent().removeClass('history--toggle');
            $('body').removeClass('modalActive');
        });
        $(document).mouseup(function(e){
            var history = $(".history");
            if (!history.is(e.target) && history.has(e.target).length === 0){
                history.parent().removeClass('popupHistory--active');
                history.removeClass('history--toggle');
                $('body').removeClass('modalActive');
            }
        });

        var youtubeThumb = $('.tribeYoutube__post').find('.thumb');
        $(youtubeThumb).on('click', function(){
            var videoID = $(this).parent().attr('video-id');
            $('.popupYoutube').addClass('popupYoutube--active');
            $('.popupYoutube__video[video-id="'+ videoID +'"]').addClass('popupYoutube__video--toggle');
            $('body').addClass('modalActive');
        });
        $('.popupYoutube__video').each(function(){
            $(this).find('iframe').addClass('videoIframe');
        });
        jQuery(".stopVideo").click(function() {
            var thisVideo = $(this).parent().find('iframe');
            $(thisVideo).attr('src', $(thisVideo).attr('src'));
            //return false;
        });
        $(document).mouseup(function(e){
            var youtubeVideo = $(".popupYoutube__video");
            if (!youtubeVideo.is(e.target) && youtubeVideo.has(e.target).length === 0){
                youtubeVideo.parent().removeClass('popupYoutube--active');
                youtubeVideo.removeClass('popupYoutube__video--toggle');
                $('body').removeClass('modalActive');
                $(this).find('.stopVideo').click();
            }
        });
    });

    /* ---- COOKIE BAR ---- */
    $('.cn-accept-cookie').on('click', function(){
        $('#cookie-notice').slideDown();
    });
})(jQuery);