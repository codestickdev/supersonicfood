<?php
/*
*   Template name: O nas
*/
get_header(); ?>

<main class="ssfood ssfood--subpage pageAbout">
    <?php while(have_rows('about_sections')): the_row();
        $color = get_sub_field('about_sections_color');
        $position = get_sub_field('about_sections_position');
        $lead = get_sub_field('about_sections_lead');
        $title = get_sub_field('about_sections_title');
        $content = get_sub_field('about_sections_content');
        $image = get_sub_field('about_sections_image');
    ?>
    <section class="aboutSection<?php if($position == 'right'): ?> aboutSection--right<?php endif; ?>">
        <div class="aboutSection__content" style="background-color: <?php echo $color; ?>;">
            <p class="lead"><?php echo $lead; ?></p>
            <h2><?php echo $title; ?></h2>
            <div class="content"><?php echo $content; ?></div>
        </div>
        <div class="aboutSection__image">
            <img src="<?php echo $image; ?>"/>
        </div>
    </section>
    <?php endwhile; ?>
    
    <?php include get_template_directory() . '/template-parts/_include_instagram.php'; ?>

    <?php include get_template_directory() . '/template-parts/_include_newsletter.php'; ?>

</main>

<?php get_footer(); ?>