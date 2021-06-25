<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
get_header();

$lang = get_bloginfo("language");
$productsEN = array(
    'posts_per_page' 	=> -1,
    'post_type' 		=> 'product',
    'orderby'			=> 'post__in',
    'post__in'			=> [2476, 11732, 20294, 11796, 9696, 2474, 29374, 29397],
    'meta_query' => array(
        array(
            'key' => 'product_main_visible',
            'value' => '1',
        )
    ),
);
$productsDE = array(
    'posts_per_page' 	=> -1,
    'post_type' 		=> 'product',
    'orderby'			=> 'post__in',
    'post__in'			=> [21497, 21666, 21695, 29371, 29394, 21693, 21688, 21657],
    'meta_query' => array(
        array(
            'key' => 'product_main_visible',
            'value' => '1',
        )
    ),
);
$orderPL = [103, 5942, 17250, 29368, 29391, 11793, 9695, 1213];
$productsPL = array(
    'posts_per_page' 	=> -1,
    'post_type' 		=> 'product',
    'orderby'			=> 'menu_order',
    'post__not_in'		=> [1215],
    'meta_query' => array(
        array(
            'key' => 'product_main_visible',
            'value' => '1',
        )
    ),
);
if($lang == 'en-US'){
    $query = new WP_Query($productsEN);
}else if ($lang == 'de-DE'){
    $query = new WP_Query($productsDE);
}else{
    $query = new WP_Query($productsPL);
} ?>
<div class="shopPage">
    <section class="shopHeading">
        <div class="shopHeading__wrap">
            <h1>Supersonic Food</h1>
            <p>Zobacz nasze wszystkie produkty</p>
        </div>
    </section>
    <section class="shopProdcuts container-lg">
        <div class="shopProducts__wrap">
            <?php while ($query->have_posts()) : $query->the_post();
                $post_id = get_the_ID();
                $getTitle = get_the_title();
                $title = str_replace('SUPERSONIC', '', $getTitle);
            ?>
            <article class="productTile<?php if(strpos($title, 'Powder') !== false): ?> productTile--powder<?php endif; ?>" productid="<?php echo $post_id; ?>" >
                <a href="<?php the_permalink(); ?>" class="productTile__thumb">
                    <img src="<?php the_field('product_main_image'); ?>"/>
                </a>
                <div class="content">
                    <a href="<?php the_permalink(); ?>" class="productTile__title"><?php echo $title; ?></a>
                    <div class="content__usp">
                        <?php while(have_rows('product_list_usp')): the_row();
                            $pos = get_sub_field('product_list_usp_text');
                        ?>
                        <div class="pos">- <?php echo $pos; ?></div>
                        <?php endwhile; ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="btn btn--bigFont"><span><?php if(get_field('cta_btn_title')){ the_field('cta_btn_title'); }else{ _e('View product', 'codestick'); }; ?></span></a>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>