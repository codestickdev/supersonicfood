<?php
/*
*   Template name: TRIBE
*/
get_header(); ?>

<main class="ssfood ssfood--subpage pageTribe">
    <section class="tribeHero" style="background-image: url('<?php the_field('tribeHeading_bg'); ?>');">
        <img src="<?php the_field('tribeHeading_bg_mobile'); ?>" class="imageMobile"/>
        <div class="tribeHero__content container-lg">
            <div class="wrap">
                <h1><?php the_field('tribeHeading_title'); ?></h1>
                <p><?php the_field('tribeHeading_desc'); ?></p>
            </div>
        </div>
    </section>
    <section class="tribePersons container-lg">
        <?php while( have_rows('tribePersons') ): the_row(); 
            $image = get_sub_field('tribePersons_image');
            $name = get_sub_field('tribePersons_name');
            $pos = get_sub_field('tribePersons_pos');
            $excerpt = get_sub_field('tribePersons_excerpt');
        ?>
        <div class="tribePersons__person" history-id="id_0<?php echo get_row_index(); ?>">
            <div class="thumb">
                <img src="<?php echo $image; ?>"/>
            </div>
            <p class="name"><?php echo $name; ?></p>
            <p class="pos"><?php echo $pos; ?></p>
            <p class="excerpt"><?php echo $excerpt; ?></p>
            <p class="openHistory">Zobacz więcej</p>
        </div>
        <?php endwhile; ?>
    </section>
    <section class="tribeYoutube container-lg">
        <div class="tribeYoutube__heading">
            <h2><?php the_field('tribeYoutube_title'); ?></h2>
            <p><?php the_field('tribeYoutube_desc'); ?></p>
        </div>
        <div class="tribeYoutube__list">
            <?php while( have_rows('youtubeList') ): the_row(); 
                $image = get_sub_field('youtubeList_image');
                $name = get_sub_field('youtubeList_name');
                $pos = get_sub_field('youtubeList_pos');
                $desc = get_sub_field('youtubeList_desc');
            ?>
            <div class="tribeYoutube__post" video-id="id_0<?php echo get_row_index(); ?>">
                <div class="thumb">
                    <img src="<?php echo $image; ?>"/>
                    <div class="thumb__cover">
                        <img src="/wp-content/themes/supersonicfood/images/icons/playbtn.svg"/>
                    </div>
                </div>
                <div class="content">
                    <h3><?php echo $name; ?></h3>
                    <p class="pos"><?php echo $pos; ?></p>
                    <p class="desc"><?php echo $desc; ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <section class="popupHistory">
        <?php while( have_rows('tribePersons') ): the_row(); 
            $name = get_sub_field('tribePersons_name');
            $pos = get_sub_field('tribePersons_pos');
            $history = get_sub_field('tribePersons_history');
        ?>
            <div class="history" history-id="id_0<?php echo get_row_index(); ?>">
                <div class="closeModal">
                    <img src="/wp-content/themes/supersonicfood/images/icons/closemodal_ico.png"/>
                </div>
                <div class="history__wrap">
                    <h3><?php echo $name; ?></h3>
                    <p class="pos"><?php echo $pos; ?></p>
                    <div class="history__content">
                        <?php echo $history; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </section>
    <section class="popupYoutube">
        <?php while( have_rows('youtubeList') ): the_row(); 
            $video = get_sub_field('youtubeList_videolink');
        ?>
        <div class="popupYoutube__video" video-id="id_0<?php echo get_row_index(); ?>">
            <?php echo $video; ?>
            <button class="stopVideo" style="opacity: 0; display: none"></button>
        </div>
        <?php endwhile; ?>
    </section>
</main>

<?php get_footer(); ?>