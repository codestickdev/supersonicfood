<section class="newsletter">
    <div class="newsletter__wrap">
        <?php $lang=get_bloginfo("language"); ?>
        <h2><?php _e('Sign up to our newsletter to receive information about news and valuable news about diet, nutrition and wellbeing from us.', 'codestick'); ?></h2>
        <div class="newsletterForm">
        <?php
            if ($lang == 'en-US') {
                echo do_shortcode('[contact-form-7 id="11765" title="Newsletter ENG"]');
            }else if ($lang == 'de-DE'){
                echo do_shortcode('[contact-form-7 id="11485" title="Newsletter"]');
            }else if ($lang == 'pl-PL'){
                echo do_shortcode('[contact-form-7 id="11485" title="Newsletter"]');
            }
        ?>
        </div>
    </div>
</section>

