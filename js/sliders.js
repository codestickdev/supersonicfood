(function($) {
  $(document).ready(function(){
    $('.testimonials__list').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        centerMode: true,
        variableWidth: true,
        dots: true,
    });

    /* ---- Product page ---- */

    $('.productGallery__main').slick({
        slidesToShow: 1,
        infinite: true,
        adaptiveHeight: true,
        focusOnSelect: false,
        draggable: false,
    });
    $('.productGallery__thumbs').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        focusOnSelect: true,
        infinite: false,
        variableWidth: true,
        asNavFor: '.productGallery__main',
    });

    /* Napisali o nas */

    $('.productLogos__list').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        infinite: true,
        draggable: false,
        responsive:[
            {
            breakpoint: 767,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows: false,
            }
          }
        ]
    });

    /* Tribe persons */

    $('.tribePersons').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        responsive:[
            {
            breakpoint: 991,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows: false,
              dots: true,
              centerMode: true,
              variableWidth: true,
            }
          }
        ]
    });

    /* Our products */
    if($(window).width() < 991){
      $('.productsList__list').slick({
        slidesToShow: 1,
        variableWidth: true,
        centerMode: true,
        dots: true,
      });
    }
  });
})(jQuery);