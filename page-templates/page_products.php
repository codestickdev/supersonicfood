<?php
/*
*   Template name: Nasze produkty
*/

get_header(); ?>

<main class="ssfood ssfood--subpage pageProducts">
    <section class="productsHeader">
        <div class="productsHeader__content">
            <div class="wrap">
            <h1><?php the_field('productspage_heading_text'); ?></h1>
            <div class="content">
                <?php the_field('productspage_heading_content'); ?>
            </div>
            </div>
        </div>
        <div class="productsHeader__image">
            <img src="<?php the_field('productspage_heading_image'); ?>"/>
        </div>
    </section>
    <section class="productsInfo">
        <?php while(have_rows('productspage_products')): the_row();
            $position = get_sub_field('productspage_products_position');
            $title = get_sub_field('productspage_products_title');
            $content = get_sub_field('productspage_products_content');
            $link = get_sub_field('productspage_products_button');
            $color = get_sub_field('productspage_products_button_color');
            $image = get_sub_field('productspage_products_image');
        ?>
        <div class="productsInfo__section<?php if($position == 'left'): ?> productsInfo__section--imageleft<?php endif; ?>">
            <div class="content">
                <h2><?php echo $title; ?></h2>
                <div class="text">
                    <?php echo $content; ?>
                </div>
                <a href="<?php echo $link; ?>" class="btn btn--bigFont" style="background-color: <?php echo $color; ?>"><span>Sprawdź</span></a>
            </div>
            <div class="image">
                <img src="<?php echo $image; ?>"/>
            </div>
        </div>
        <?php endwhile; ?>
    </section>
</main>

<?php get_footer(); ?>