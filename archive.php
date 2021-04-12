<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Supersonicfood
 */

get_header();
?>

<main id="primary" class="site-main blogArchive">

<?php if ( have_posts() ) : ?>
	<header class="blogArchive__title container-lg">
		<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		?>
	</header><!-- .page-header -->
	<section class="blogArchive__wrap container-lg">
	<?php while ( have_posts() ) :
		the_post();

		include get_template_directory() . '/template-parts/_include_news.php';

	endwhile;
	the_posts_navigation(); ?>
	</section>
<? else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>

<?php include get_template_directory() . '/template-parts/_include_instagram.php'; ?>

<?php include get_template_directory() . '/template-parts/_include_newsletter.php'; ?>

</main><!-- #main -->

<?php
get_footer();
