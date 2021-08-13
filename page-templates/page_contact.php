<?php
    /*
     *  Template Name: Kontakt
     */
get_header(); ?>

<main class="ssfood ssfood--contact">

    <?php if(get_field('contactHeader_bg')): ?>
    <section class="contactHeader" style="background-image: url('<?php the_field('contactHeader_bg'); ?>');">
        <div class="contactHeader__content">
            <div class="wrap">
                <h1><?php the_field('contactHeader_title'); ?></h1>
                <div class="content">
                    <?php the_field('contactHeader_content'); ?>
                </div>
            </div>
        </div>
        <div class="contactHeader__image">
            <img src="<?php the_field('contactHeader_bg_mobile'); ?>"/>
        </div>
    </section>
    <?php endif; ?>

    <section class="contactContent">
        <div class="contactContent__wrap container">
            <h1><?php the_title(); ?></h1>
            <div class="content">
                <?php the_field('contactContent'); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>