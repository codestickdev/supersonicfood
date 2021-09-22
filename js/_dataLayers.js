
/*
 * Virtual Page view
 */

// Składniki - strona główna
(function($){
    $('.frontpageModal').on('click', function(){
        var pageURL = window.location.href;
        var pageTitle = $(document).attr('title');
        var country = $('body').attr('country');
        dataLayer.push({
            event: "virtual_page_view",
            page: pageURL,
            pageTitle: pageTitle,
            countrySF: country
        });
    });
}(jQuery))
