<?php
/*
*   Template name: Kalkulator kalorii
*/

get_header(); ?>

<main class="ssfood ssfood--subpage pageCalculator">
    <section class="calculatorContent container-lg">
        <div class="calculatorContent__left">
            <h2><?php the_field('calculator_title_left'); ?></h2>
            <p><?php the_field('calculator_content_left'); ?></p>
        </div>
        <div class="calculatorContent__right">
            <h2><?php the_field('calculator_title_right'); ?></h2>
            <p><?php the_field('calculator_content_right'); ?></p>
        </div>
        <a href="#calcSection" class="scroll"><img src="/wp-content/themes/supersonicfood/images/icons/scrolldown_ico.svg"/></a>
    </section>
    <section id="calcSection" class="calculator">
        <div class="calculator__wrap">
        <h2><?php _e('Caloric demand calculator', 'codestick'); ?></h2>
        <?php echo do_shortcode('[calorie_calculator show_firstname_only="true" show_email_field="false" send_to_email="false" unit="metricunit" template="general"]'); ?>
        </div>
    </section>
    
    <?php include get_template_directory() . '/template-parts/_include_instagram.php'; ?>

    <?php include get_template_directory() . '/template-parts/_include_newsletter.php'; ?>
</main>

<?php get_footer(); ?>