
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
    $('body').on('product-added-to-cart', function(){
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

        console.log(utm_source_param);

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
}(jQuery))


