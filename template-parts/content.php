<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Supersonicfood
 */

?>

<article id="post-<?php the_ID(); ?>" class="contentPost">
	<header class="postHeading">
		<div class="postHeading__content">
			<a href="<?php echo home_url('/blog') ?>"><?php _e('Back to all articles', 'codestick'); ?></a>
			<h1><?php the_title(); ?></h1>
			<p class="date"><?php echo get_the_date('j F Y'); ?></p>
		</div>
		<div class="postHeading__thumb">
			<img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
		</div>
	</header>

	<section class="postContent">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'supersonicfood' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supersonicfood' ),
				'after'  => '</div>',
			)
		);
		?>
	</section>
	<section class="postProducts">
		<?php
			$lang = get_bloginfo("language");
			$href = '';

			if($lang == 'en-US'){
				$href = '/en/our-products/';
			}else if($lang == 'de-DE'){
				$href = '/de/unsere-produkte/';
			}else{
				$href = '/nasze-produkty/';
			}
		?>
		<h3><?php _e('Learn more about our products!', 'codestick'); ?></h3>
		<a href="<?php echo home_url($href); ?>" class="btn"><span><?php _e('learn more', 'codestick') ?></span></a>
	</section>
	<footer class="postFooter">
		<?php
			$previous = get_previous_post();
			$next = get_next_post();
		?>

		<?php if ( get_previous_post() ) { ?>
			  <a href="<?php the_permalink($previous) ?>" class="postFooter__prev postFooter__navlink">Poprzedni artykuł</a>
		<?php } ?>

		<?php if ( get_next_post() ) { ?>
			  <a href="<?php the_permalink($next) ?>" class="postFooter__next postFooter__navlink">Następny artykuł</a>
		<?php } ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
