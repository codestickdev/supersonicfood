<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}
$lang = get_bloginfo("language");
?>

<?php if(get_field('productRating')): ?>
	<div class="ratingStars">
		<div class="ratingStars__stars" data-rate="<?php the_field('productRating'); ?>">
			<i class="star star--none fas fa-star"></i>
			<i class="star star--none fas fa-star"></i>
			<i class="star star--none fas fa-star"></i>
			<i class="star star--none fas fa-star"></i>
			<i class="star star--none fas fa-star"></i>
			
			<i class="star star--none fas fa-star-half"></i>
		</div>
		<div class="ratingStars__count">(<?php the_field('productRating_count'); ?>)</div>
	</div>
	<div class="ratingModal">
		<div class="ratingModal__wrap">
			<p><?php _e('Rating based on the results of NPS survey conducted among all the SUPERSONIC clients.', 'codestick'); ?></p>
		</div>
	</div>
<?php endif; ?>

<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>
<?php if (get_field('product_complexInfo_title')): ?>
    <a href="#morecontent" class="contentHref"><?php _e('Read more', 'codestick'); ?></a>
<?php endif; ?>