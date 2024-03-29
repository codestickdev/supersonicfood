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
$productsFood = array(
    'posts_per_page'    => -1,
    'post_type'         => 'product',
    'orderby'           => 'menu_order',
    'meta_query'        => array(
        'relation'  => 'AND',
        array(
            'key'   => 'product_shopPage_visibility',
            'value' => '1',
        ),
        array(
            'key'   => 'product_shopPage_category',
            'value' => 'food',
        )
    ),
);
$productsAccessories = array(
    'posts_per_page'    => -1,
    'post_type'         => 'product',
    'meta_query'        => array(
        'relation'  => 'AND',
        array(
            'key'   => 'product_shopPage_visibility',
            'value' => '1',
        ),
        array(
            'key'   => 'product_shopPage_category',
            'value' => 'accessories',
        )
    ),
);
$queryFood = new WP_Query($productsFood);
$queryAccessories = new WP_Query($productsAccessories);
?>

<div class="shopPage">
    <section class="shopHeading">
        <div class="shopHeading__wrap">
            <h1><?php _e('See all our products', 'codestick'); ?></h1>
        </div>
    </section>
    <section class="shopProdcuts container-lg">
        <div class="shopProducts__heading">
            <h2>Food and Drink</h2>
        </div>
        <div class="shopProducts__wrap">
            <?php while ($queryFood->have_posts()) : $queryFood->the_post();
                $post_id = get_the_ID();
                $product = wc_get_product($post_id);
                $getTitle = get_the_title();
                $title = str_replace('SUPERSONIC ', '', $getTitle);
                
                if($product->is_type('variable')){
                    $available_variations = $product->get_available_variations();
                    foreach ( $available_variations as $variation ){
                        $price = $variation['display_price'];         
                    }
                }else{
                    $price = $product->get_price();
                }
            ?>
            <article class="productTile" productid="<?php echo $post_id; ?>" >
                <a href="<?php the_permalink(); ?>" class="productTile__thumb">
                    <img src="<?php the_field('product_main_image'); ?>"/>
                </a>
                <div class="content">
                    <a href="<?php the_permalink(); ?>" class="productTile__title"><?php echo $title; ?></a>
                    <p class="productTile__price"><?php echo wc_price($price); ?></p>
                    <div class="content__usp">
                        <?php while(have_rows('product_list_usp')): the_row();
                            $pos = get_sub_field('product_list_usp_text');
                        ?>
                        <div class="pos"><?php echo $pos; ?></div>
                        <?php endwhile; ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="btn btn--bigFont"><span><?php if(get_field('cta_btn_title')){ the_field('cta_btn_title'); }else{ _e('View product', 'codestick'); }; ?></span></a>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <div class="shopProducts__heading">
            <h2><?php _e('Accessories', 'codestick'); ?></h2>
        </div>
        <div class="shopProducts__wrap">
            <?php while ($queryAccessories->have_posts()) : $queryAccessories->the_post();
                $post_id = get_the_ID();
                $getTitle = get_the_title();
                $title = str_replace('SUPERSONIC ', '', $getTitle);
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
                        <div class="pos"><?php echo $pos; ?></div>
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