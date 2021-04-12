<?php
/*
*   Template name: Strona główna
*/

get_header(); ?>
<?php $lang=get_bloginfo("language"); ?>
<main class="ssfood ssfood--frontpage">
    <section class="homeHeader" style="background-image: url('<?php the_field('home_header_image_desktop'); ?>')">
        <div class="container-lg">
            <div class="homeHeader__content">
                <h2><?php the_field('home_header_title'); ?></h2>
                <div class="homeHeader__mobileWrap">
                    <div class="content">
                        <?php the_field('home_header_content'); ?>
                    </div>
                    <a href="<?php the_field('home_header_btn_link') ?>" class="btn btn--bigFont"><span><?php the_field('home_header_btn_text'); ?></span></a>
                </div>
            </div>
        </div>
        <div class="homeHeader__mobilebg">
            <img src="<?php the_field('home_header_image_mobile'); ?>"/>
        </div>
    </section>
    <?php if( have_rows('home_boxes') ): ?>
    <section class="homeBoxes container-lg">
        <?php while( have_rows('home_boxes') ): the_row(); 
            $icon = get_sub_field('home_boxes_icon');
            $title = get_sub_field('home_boxes_title');
            $text = get_sub_field('home_boxes_content');
            $count = count(get_field('home_boxes'));
        ?>
        <div class="homeBoxes__box" style="width: calc(100% / <?php echo $count; ?> - 70px)">
            <img class="homeBoxes__icon" src="<?php echo $icon; ?>"/>
            <p class="homeBoxes__title"><?php echo $title; ?></p>
            <p class="homeBoxes__content"><?php echo $text; ?></p>
        </div>
        <?php endwhile; ?>
    </section>
    <?php endif; ?>
    <?php if( have_rows('halfSections_one') ): ?>
    <?php while( have_rows('halfSections_one') ): the_row(); 
        $title = get_sub_field('halfSections_one_title');
        $text = get_sub_field('halfSections_one_content');
        $btn_txt = get_sub_field('halfSections_one_button_txt');
        $btn_link = get_sub_field('halfSections_one_button_link');
        $btn_color = get_sub_field('halfSections_one_button_color');
        $image = get_sub_field('halfSections_one_image');
        $position = get_sub_field('halfSections_one_position');
        $color = get_sub_field('halfSections_one_bg');
    ?>
    <section class="halfSection <?php if ($position == 'left'): ?>halfSection--leftContent<?php else: ?>halfSection--rightContent<?php endif; ?>">
        <div class="halfSection__content" style="background-color: <?php echo $color; ?>">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $text; ?></p>
            <a href="<?php echo $btn_link; ?>" class="btn" style="background-color: <?php echo $btn_color; ?>"><span><?php echo $btn_txt; ?></span></a>
        </div>
        <div class="halfSection__image">
            <img src="<?php echo $image; ?>"/>
        </div>
    </section>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php if( have_rows('homeInfoTiles') ): ?>
    <section class="homeInfoTile container-lg">
        <h2 class="ssfood__secHeading">
        <?php
        if ($lang == 'en-US') {
            echo 'What is your goal?';
        }else{
            echo 'Jaki jest Twój cel?';
        }
        ?>   
        </h2>
        <div class="homeInfoTile__wrap">
            <?php while( have_rows('homeInfoTiles') ): the_row(); 
                $image = get_sub_field('homeInfoTiles_image');
                $title = get_sub_field('homeInfoTiles_title');
                $content = get_sub_field('homeInfoTiles_content');
            ?>
            <div class="homeInfoTile__tile">
                <div class="homeInfoTile__thumb">
                    <img src="<?php echo $image; ?>"/>
                </div>
                <p class="homeInfoTile__title"><?php echo $title; ?></p>
                <p class="homeInfoTile__content"><?php echo $content; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; ?>
    <?php if( have_rows('halfSections_two') ): ?>
    <?php while( have_rows('halfSections_two') ): the_row(); 
        $title = get_sub_field('halfSections_two_title');
        $text = get_sub_field('halfSections_two_content');
        $btn_txt = get_sub_field('halfSections_two_button_txt');
        $btn_link = get_sub_field('halfSections_two_button_link');
        $btn_color = get_sub_field('halfSections_two_button_color');
        $image = get_sub_field('halfSections_two_image');
        $position = get_sub_field('halfSections_two_position');
        $color = get_sub_field('halfSections_two_bg');
    ?>
    <section class="halfSection <?php if ($position == 'left'): ?>halfSection--leftContent<?php else: ?>halfSection--rightContent<?php endif; ?>">
        <div class="halfSection__content" style="background-color: <?php echo $color; ?>">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $text; ?></p>
            <a href="<?php echo $btn_link; ?>" class="btn" style="background-color: <?php echo $btn_color; ?>"><span><?php echo $btn_txt; ?></span></a>
        </div>
        <div class="halfSection__image">
            <img src="<?php echo $image; ?>"/>
        </div>
    </section>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php if( have_rows('testimonials') ): ?>
    <section class="testimonials">
        <h2 class="ssfood__secHeading">
        <?php
        if ($lang == 'en-US') {
            echo 'Expert opinions';
        }else{
            echo 'Opinie ekspertów';
        }
        ?>
        </h2>
        <div class="testimonials__list">
            <?php while( have_rows('testimonials') ): the_row();
                $image = get_sub_field('testimonials_image');
                $quote = get_sub_field('testimonials_quote');
                $author = get_sub_field('testimonials_author');
                $position = get_sub_field('testimonials_position');
            ?>
            <div class="testimonials__tile">
                <div class="testimonials__image">
                    <img src="<?php echo $image; ?>"/>
                </div>
                <p class="testimonials__quote"><?php echo $quote; ?></p>
                <p class="testimonials__author"><?php echo $author; ?></p>
                <p class="testimonials__position"><?php echo $position; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; ?>
    <?php if( have_rows('logosList') ): ?>
    <section class="logosList container-lg">
        <h2 class="ssfood__secHeading">
        <?php
        if ($lang == 'en-US') {
            echo 'They wrote about us';
        }else{
            echo 'Napisali o nas';
        }
        ?>
        </h2>
        <div class="logosList__list">
            <?php while( have_rows('logosList') ): the_row();
                $count = count(get_field('logosList'));
                $logo = get_sub_field('logosList_logo');
            ?>
            <div class="logosList__logo" style="width: calc(100% / <?php echo $count; ?>)">
                <img src="<?php echo $logo; ?>"/>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; ?>
    <?php if( get_field('fullImage_img') ): ?>
    <section class="fullImage">
        <img src="<?php the_field('fullImage_img'); ?>"/>
    </section>
    <?php endif; ?>

    <?php include get_template_directory() . '/template-parts/_include_instagram.php'; ?>

    <?php include get_template_directory() . '/template-parts/_include_newsletter.php'; ?>
</main>

<?php get_footer(); ?>