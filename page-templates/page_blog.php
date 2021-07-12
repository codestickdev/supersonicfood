<?php
/*
*   Template name: Poradnik
*/
get_header(); ?>

<?php $lang = get_bloginfo("language"); ?>
<main class="ssfood ssfood--subpage">
    <section class="blogHeading container-lg">
        <h1><?php _e('Guide', 'codestick'); ?></h1>
        <div class="blogHeading__select">
        <?php
            $categories = get_categories( array(
                'orderby'       =>  'name',
                'hide_empty'    =>  true,
                'order'         =>  'ASC',
            ) );

            foreach( $categories as $category ) {
                echo '<a href="#goto_' . $category->cat_ID . '">' . $category->name . '</a>';   
            }
        ?>
        </div>
    </section>
    <?php
    $popularPosts = get_field('blogpage_bestposts');
    $newestPosts = array(
        'posts_per_page'	=> 3,
        'post_type'			=> 'post',
        'post_status'       => 'publish',
    );
    $newestquery = new WP_Query($newestPosts);
    if($popularPosts): ?>
    <section class="blogNav container-lg">
        <div class="blogNav__wrap">
            <div class="blogNav__side">
                <h3><?php _e('Popular articles', 'codestick'); ?>:</h3>
                <ul>
                <?php foreach( $popularPosts as $post ): ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endforeach;
                wp_reset_postdata(); ?>
                </ul>
            </div>
            <div class="blogNav__side">
                <h3><?php _e('Recent articles', 'codestick'); ?>:</h3>
                <ul>
                <?php while( $newestquery->have_posts() ) : $newestquery->the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile;
                wp_reset_query(); ?>
                </ul>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php
        $categories = get_categories( array(
            'orderby'       =>  'name',
            'hide_empty'    =>  true,
            'order'         =>  'ASC'
        ));
    foreach( $categories as $category ):?>
    <section id="goto_<?php echo $category->cat_ID; ?>" class="blogCategory">
        <div class="blogCategory__container">
            <div class="blogCategory__title container-lg">
                <h2><?php echo $category->name; ?></h2>
            </div>
            <div class="blogCategory__wrap container-lg">
                <?php 
                $args = array(
                    'posts_per_page'	=> 1,
                    'post_type'		    => 'post',
                    'cat'               => $category->cat_ID,
                );
                $the_query = new WP_Query( $args ); ?>
                <?php if( $the_query->have_posts() ): ?>
                <div class="blogCategory__posts blogCategory__posts--full">
                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <div class="blogCategory__post blogCategory__post--full">
                            <div class="thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
                                </a>
                            </div>
                            <div class="content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="date"><?php echo get_the_date('j F Y'); ?></p>
                                <p>
                                    <?php
                                    $text = strip_shortcodes( $post->post_content );
                                    $text = apply_filters( 'the_content', $text );
                                    $text = str_replace(']]>', ']]&gt;', $text);
                                    $excerpt_length = apply_filters( 'excerpt_length', 35 );
                                    $excerpt_more = apply_filters( 'excerpt_more', '...' );
                                    $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

                                    echo $text;
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
                <?php wp_reset_query();	?>
                <?php 
                $args = array(
                    'posts_per_page'	=> 3,
                    'offset'            => 1,
                    'post_type'		    => 'post',
                    'cat'               => $category->cat_ID,
                );
                $argscontinue = array(
                    'posts_per_page'	=> 3,
                    'offset'            => 4,
                    'post_type'		    => 'post',
                    'cat'               => $category->cat_ID,
                );
                $the_query = new WP_Query( $args );
                $the_querycontinue = new WP_Query( $argscontinue ); ?>
                <?php if( $the_query->have_posts() ): ?>
                <div class="blogCategory__posts blogCategory__posts--sidebar">
                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <div class="blogCategory__post">
                            <div class="thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
                                </a>
                            </div>
                            <div class="content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="date"><?php echo get_the_date('j F Y'); ?></p>
                                <p>
                                    <?php
                                    $text = strip_shortcodes( $post->post_content );
                                    $text = apply_filters( 'the_content', $text );
                                    $text = str_replace(']]>', ']]&gt;', $text);
                                    $excerpt_length = apply_filters( 'excerpt_length', 35 );
                                    $excerpt_more = apply_filters( 'excerpt_more', '...' );
                                    $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

                                    echo $text;
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <p class="otherPosts"><?php _e('More articles', 'codestick') ?></p>
                    <?php while( $the_querycontinue->have_posts() ) : $the_querycontinue->the_post(); ?>
                        <div class="blogCategory__post--small">
                            <h3>
                                <p class="date"><?php echo get_the_date('j F Y'); ?></p>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
                <?php wp_reset_query();	?>
            </div>
            <div class="blogCategory__all container-lg">
                <a href="<?php echo get_category_link($category->cat_ID); ?>">
                    <span><?php _e('See more articles', 'codestick'); ?> >></span>
                </a>
            </div>
        </div>
    </section>
    <?php endforeach; ?>
</main>

<?php get_footer(); ?>