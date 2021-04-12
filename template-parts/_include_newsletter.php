<section class="newsletter">
    <div class="newsletter__wrap">
        <?php $lang=get_bloginfo("language"); ?>
        <h2><?php 
        if ($lang == 'en-US') {
            echo 'Sign up to our newsletter to receive information about news and valuable news about diet, nutrition and wellbeing from us.';
        }else{
            echo 'Zostaw swój adres, by dostawać od nas informacje o nowościach oraz wartościowe newsy dotyczące diety, odżywiania i wellbeing.';
        }
        ?></h2>
        <div class="newsletterForm">
        <?php
            if ($lang == 'en-US') {
                echo do_shortcode('[contact-form-7 id="11765" title="Newsletter ENG"]');
            }else{
                echo do_shortcode('[contact-form-7 id="11485" title="Newsletter"]');
            }
        ?>
        </div>
    </div>
</section>

