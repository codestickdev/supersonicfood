<?php
/*
*   Template name: O nas
*/
get_header(); ?>

<main class="ssfood ssfood--about">
    <section class="aboutHeader">
        <div class="aboutHeader__wrap container-md">
            <h1><?php _e('O SUPERSONIC Food', 'supersonicfood'); ?></h1>
            <img class="foods" src="<?php echo get_template_directory_uri() . '/images/about/aboutHeader.png'; ?>"/>
        </div>
    </section>
    <section class="aboutContent">
        <div class="aboutContent__wrap container-md">
            <div class="aboutContent__text">
                <h2><?php the_field('firstsec_title'); ?></h2>
                <p class="lead"><?php the_field('firstsec_lead') ?></p>
                <p><?php the_field('firstsec_content') ?></p>
            </div>
            <div class="aboutContent__image">
                <div class="wrap">
                    <img src="<?php the_field('firstsec_image'); ?>"/>
                </div>
            </div>
        </div>
    </section>
    <section class="aboutProducts">
        <div class="aboutProducts__heading">
            <h2><?php _e('Co oferują nasze produkty?', 'supersonicfood'); ?></h2>
        </div>
        <div class="aboutProducts__wrap container-md">
            <?php while(have_rows('productInfo_boxes')): the_row();
                $icon = get_sub_field('productInfo_boxes_icon');
                $title = get_sub_field('productInfo_boxes_title');
                $text = get_sub_field('productInfo_boxes_text');
            ?>
                <div class="aboutProducts__box">
                    <div class="icon">
                        <img src="<?php echo $icon; ?>"/>
                    </div>
                    <h3><?php echo $title; ?></h3>
                    <p><?php echo $text; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        <a href="<?php echo get_permalink(icl_object_id(19751, 'page', true)); ?>" class="btn btn--bigFont"><span><?php _e('Poznaj produkty', 'supersonicfood'); ?></span></a>
    </section>
    <section class="aboutParts">
        <div class="aboutParts__wrap container-md">
            <div class="aboutParts__box">
                <div class="content">
                    <h2><?php the_field('secsec_title'); ?></h2>
                    <p class="lead"><?php the_field('secsec_lead'); ?></p>
                    <p><?php the_field('secsec_content'); ?></p>
                </div>
                <img class="image" src="<?php echo get_template_directory_uri() . '/images/about/aboutParts.png'; ?>"/>
                <img class="image image--mobile" src="<?php echo get_template_directory_uri() . '/images/about/aboutParts_mobile.png'; ?>"/>
            </div>
        </div>
    </section>
    <section class="aboutContent aboutContent--reverse">
        <div class="aboutContent__wrap container-md">
            <div class="aboutContent__text">
                <h2><?php the_field('thirdsec_text'); ?></h2>
                <p class="lead"><?php the_field('thirdsec_lead'); ?></p>
                <p><?php the_field('thirdsec_content'); ?></p>
            </div>
            <div class="aboutContent__image aboutContent__image--map">
                <div class="wrap">
                    <img src="<?php the_field('thirdsec_image'); ?>"/>
                </div>
            </div>
        </div>
    </section>
    <section class="aboutContent">
        <div class="aboutContent__wrap container-md">
            <div class="aboutContent__text">
                <h2><?php the_field('foursec_title'); ?></h2>
                <p class="lead"><?php the_field('foursec_lead'); ?></p>
                <p><?php the_field('foursec_content'); ?></p>
            </div>
            <div class="aboutContent__image">
                <div class="wrap">
                    <img src="<?php the_field('foursec_image'); ?>"/>
                </div>
            </div>
        </div>
    </section>
    <section class="aboutLead">
        <h2>Food and Drink of the Future.<br/>Today!</h2>
    </section>
</main>

<?php get_footer(); ?>