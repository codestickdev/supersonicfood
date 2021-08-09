<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<?php $lang = get_bloginfo("language"); ?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <div class="productPage">
        <div class="productPage__main<?php if(get_field('product_main_position') == 'left'): ?> productPage__main--left<?php endif; ?>">
            <div class="productGallery">
                <?php $images = get_field('product_main_gallery'); ?>
                <div class="productGallery__main">
                    <?php if ($images) : ?>
                        <?php foreach ($images as $image) : ?>
                            <img src="<?php echo $image; ?>" />
                        <?php endforeach; ?>
                    <?php else: ?>
                        <img src="<?php the_field('product_main_image'); ?>" />
                    <?php endif; ?>
                </div>
                <?php if ($images) : ?>
                    <div class="productGallery__thumbs">
                        <?php foreach ($images as $image) : ?>
                            <div class="productGallery__thumb">
                                <img src="<?php echo $image; ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="productPage__content">
                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action('woocommerce_single_product_summary');
                ?>
            </div>
        </div>

        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        // do_action('woocommerce_after_single_product_summary');
        ?>

        <?php if( have_rows('logosList')): ?>
        <section id="morecontent" class="logosList">
            <div class="logosList__list container-lg">
                <?php while( have_rows('logosList') ): the_row();
                    $count = count(get_field('logosList'));
                    $logo = get_sub_field('logosList_logo');
                ?>
                <div class="logosList__logo">
                    <img src="<?php echo $logo; ?>"/>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
        <?php if(get_field('product_complexInfo_title')): ?>
        <section class="productSpecs">
            <div class="productSpecs__heading">
                <h2><?php the_field('product_complexInfo_title'); ?></h2>
            </div>
            <div class="productSpecs__wrap container-lg">
                <div class="productSpecs__icons">
                    <?php while(have_rows('product_complexInfo_icons')): the_row();
                        $icon = get_sub_field('product_complexInfo_icons_icon');
                        $iconTxt = get_sub_field('product_complexInfo_icons_title');
                    ?>
                    <div class="productSpecs__icon">
                        <img src="<?php echo $icon; ?>"/>
                        <p><?php echo $iconTxt; ?></p>
                    </div>
                    <?php endwhile; ?>
                </div>
                <div class="productSpecs__content">
                    <p><?php the_field('product_complexInfo_content'); ?></p>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php if(get_field('productTesVid_title')):  ?>
        <section class="productTesVid">
            <div class="productTesVid__wrap container-lg">
                <div class="productTesVid__content">
                    <h2><?php the_field('productTesVid_title'); ?></h2>
                    <p><?php the_field('productTesVid_content'); ?></p>
                </div>
                <div class="productTesVid__list">
                    <?php while(have_rows('productTesVid_video')): the_row();
                        $title = get_sub_field('productTesVid_video_title');
                        $position = get_sub_field('productTesVid_video_position');
                        $thumb = get_sub_field('productTesVid_video_thumb');
                        $video = get_sub_field('productTesVid_video_video');
                    ?>
                    <div class="productTesVid__video" data-id="video_0<?php echo get_row_index(); ?>">
                        <div class="thumb">
                            <img src="<?php echo $thumb; ?>"/>
                        </div>
                        <p><?php echo $title; ?></p>
                        <p class="position"><?php echo $position; ?></p>
                    </div>
                    <?php endwhile; ?>
                </div>
                <div class="productTesVid__modals">
                    <?php while(have_rows('productTesVid_video')): the_row();
                        $video = get_sub_field('productTesVid_video_video');
                    ?>
                    <div class="testiModal" data-id="video_0<?php echo get_row_index(); ?>">
                        <div class="testiModal__wrap">
                            <?php echo $video; ?>
                            <p class="stopVideo" style="display: none !important">stop</p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php if(get_field('product_components_sec_title')): ?>
        <section class="productComponents container-lg">
            <div class="productComponents__heading">
                <h2><?php the_field('product_components_sec_title'); ?></h2>
            </div>
            <div class="productComponents__list">
                <?php while(have_rows('product_components')): the_row();
                    $image = get_sub_field('product_components_img');
                    $title = get_sub_field('product_components_title');
                    $content = get_sub_field('product_components_content');
                    $count = count(get_field('product_components'));
                ?>
                <div class="productComponents__component productComponents__component--count0<?php echo $count; ?>">
                    <img src="<?php echo $image; ?>"/>
                    <p class="title"><?php echo $title; ?></p>
                    <p><?php echo $content; ?></p>
                </div>
                <?php endwhile; ?>
            </div>
            <a id="openModal" class="btn"><span><?php _e('See full Ingredients list', 'codestick') ?></span></a>
        </section>
        <?php endif; ?>

        <?php if(get_field('product_otherProduct_title') && has_term('keto-omega', 'product_tag')): ?>
        <section class="halfSection <?php if (get_field('product_otherProduct_position') == 'left'): ?>halfSection--leftContent<?php else: ?>halfSection--rightContent<?php endif; ?>">
            <div class="halfSection__content" style="background-color: #F7F6F4">
                <h2><?php the_field('product_otherProduct_title'); ?></h2>
                <p><?php the_field('product_otherProduct_content'); ?></p>
                <a href="<?php the_field('product_otherProduct_btnurl'); ?>" class="btn" style="background-color: <?php the_field('product_otherProduct_btncolor'); ?>"><span><?php the_field('product_otherProduct_btntext'); ?></span></a>
            </div>
            <div class="halfSection__image">
                <img src="<?php the_field('product_otherProduct_image'); ?>"/>
            </div>
        </section>
        <?php endif; ?>

        <?php if(get_field('product_expert_title')): ?>
        <section class="productExpert">
            <div class="productExpert__content">
                <h2><?php the_field('product_expert_title'); ?></h2>
                <p class="quote">"<?php the_field('product_expert_content'); ?>"</p>
                <h4 class="author"><?php the_field('product_expert_author'); ?></h4>
                <p class="authorInfo"><?php the_field('product_expert_author_desc'); ?></p>
                <a class="instagramAccount" href="<?php echo get_field('product_expert_author_btn')['url']; ?>" target="_blank">
                    <img src="/wp-content/themes/supersonicfood/images/icons/instagram_icon.png"/>
                    <p><?php echo esc_html(get_field('product_expert_author_btn')['title']); ?></p>
                </a>
            </div>
            <div class="productExpert__image">
                <img src="<?php the_field('product_expert_image'); ?>"/>
            </div>
        </section>
        <?php endif; ?>

        <?php if(get_field('product_otherProduct_title') && has_term( 'braincoffee', 'product_tag')): ?>
        <section class="halfSection <?php if (get_field('product_otherProduct_position') == 'left'): ?>halfSection--leftContent<?php else: ?>halfSection--rightContent<?php endif; ?>">
            <div class="halfSection__content" style="background-color: #F7F6F4">
                <h2><?php the_field('product_otherProduct_title'); ?></h2>
                <p><?php the_field('product_otherProduct_content'); ?></p>
                <a href="<?php the_field('product_otherProduct_btnurl'); ?>" class="btn" style="background-color: <?php the_field('product_otherProduct_btncolor'); ?>"><span><?php the_field('product_otherProduct_btntext'); ?></span></a>
            </div>
            <div class="halfSection__image">
                <img src="<?php the_field('product_otherProduct_image'); ?>"/>
            </div>
        </section>
        <?php endif; ?>

        <?php if(get_field('product_nutritional_sec_title')): ?>
        <section class="productNutritional">
            <div class="productNutritional__heading">
                <h2><?php the_field('product_nutritional_sec_title'); ?></h2>
            </div>
            <div class="productNutritional__wrap">
                <?php while(have_rows('product_nutritional_list')): the_row();
                    $name = get_sub_field('product_nutritional_list_name');
                    $value = get_sub_field('product_nutritional_list_value');
                ?>
                <div class="productNutritional__position">
                    <div class="values">
                        <p class="name"><?php echo $name; ?></p>
                        <p class="value"><?php echo $value; ?> g</p>
                    </div>
                    <div class="status">
                        <div class="status__current" style="width: <?php echo $value ?>%"></div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
        <?php if(get_field('product_infosections')): ?>
        <section class="productInfosections container-lg">
            <?php while(have_rows('product_infosections')): the_row();
                $position = get_sub_field('product_infosections_position');
                $image = get_sub_field('product_infosections_image');
                $title = get_sub_field('product_infosections_title');
                $content = get_sub_field('product_infosections_content');
            ?>
            <div class="productInfosections__section<?php if( $position == 'right'): ?> productInfosections__section--right<?php endif; ?>">
                <div class="productInfosections__image">
                    <img src="<?php echo $image; ?>"/>
                </div>
                <div class="productInfosections__content">
                    <h3><?php echo $title; ?></h3>
                    <p><?php echo $content; ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </section>
        <?php endif; ?>
        <?php if(get_field('product_ssvsff')): ?>
        <section class="productCompare">
            <h2>Supersonic vs fastfood</h2>
            <div class="productCompare__list">
                <?php while(have_rows('product_ssvsff')): the_row();
                    $icon = get_sub_field('product_ssvsff_icon');
                    $time = get_sub_field('product_ssvsff_time');
                    $price = get_sub_field('product_ssvsff_price');
                    $color = get_sub_field('product_ssvsff_color');
                ?>
                <div class="productCompare__position">
                    <div class="image">
                        <img src="<?php echo $icon; ?>"/>
                    </div>
                    <div class="info">
                        <div class="time">
                            <div class="status">
                                <div class="status__current" style="width: calc(<?php echo $time; ?>% + 10px); background-color: <?php echo $color; ?>"></div>
                            </div>
                            <div class="value">
                                <p><?php echo $time; ?> min</p>
                            </div>
                        </div>
                        <div class="price">
                            <div class="status">
                                <div class="status__current" style="width: calc(<?php echo $price; ?>% + 10px); background-color: <?php echo $color; ?>"></div>
                            </div>
                            <div class="value">
                                <p><?php echo $price; ?> <span class="currentCurrency"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
        <?php if(get_field('product_logos')): ?>
        <section class="productLogos container-lg">
            <h2><?php _e('They wrote about us', 'codestick'); ?></h2>
            <div class="productLogos__list">
                <?php while(have_rows('product_logos')): the_row();
                    $logo = get_sub_field('product_logos_logo');
                ?>
                <div class="productLogos__logo">
                    <img src="<?php echo $logo; ?>"/>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
        <?php if(get_field('product_reviews')): ?>
        <section class="productReviews container-lg">
            <h2><?php _e("Users' opinions", 'codestick'); ?></h2>
            <div class="productReviews__list">
                <?php while(have_rows('product_reviews')): the_row();
                    $author = get_sub_field('product_reviews_author');
                    $stars = get_sub_field('product_reviews_rate');
                    $quote = get_sub_field('product_reviews_quote');
                    $count = count(get_field('product_reviews'));
                ?>
                <div class="productReviews__review" style="width: calc(100% / <?php echo $count; ?>">
                    <p class="author"><?php echo $author; ?></p>
                    <div class="rate rate--star0<?php echo $stars; ?>">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <p class="quote">"<?php echo $quote; ?>"</p>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
        <?php if(get_field('product_faq')): ?>
        <section class="productFaq container-lg">
            <h2 class="sectitle">FAQ</h2>
            <div class="productFaq__categories">
                <?php while(have_rows('product_faq')): the_row();
                    $catname = get_sub_field('product_faq_catName');
                ?>
                <div class="cat">
                    <p class="categorySelect" data="cat_0<?php echo get_row_index(); ?>"><?php echo $catname; ?></p>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="productFaq__content">
                <?php while(have_rows('product_faq')): the_row();
                    $catname = get_sub_field('product_faq_catName');
                ?>
                <div class="questions" data="cat_0<?php echo get_row_index(); ?>">
                    <?php while(have_rows('product_faq_catList')): the_row();
                        $que = get_sub_field('product_faq_catlist_question');
                        $ans = get_sub_field('product_faq_catList_answer');
                    ?>
                    <div class="questions__wrap">
                        <div class="questions__que">
                            <h3><?php echo $que; ?></h3>
                            <span></span>
                        </div>
                        <div class="questions__ans">
                            <p><?php echo $ans; ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
    </div>
    <div id="productComponents" class="componentsModal">
        <div class="componentsModal__wrap">
            <div class="closeModal">
                <img src="/wp-content/themes/supersonicfood/images/icons/closemodal_ico.png"/>
            </div>
            <div class="componentsModal__openContent">
                <h2><?php _e('List of ingredients and nutritional values', 'codestick'); ?></h2>
                <?php the_field('components_modal_opencontent'); ?>
            </div>
            <div class="componentsModal__flavours">
                <?php while(have_rows('componentsModal_tables')): the_row();
                    $flavour_name = get_sub_field('componentsModal_tables_name');
                    $flavour_desc = get_sub_field('componentsModal_tables_desc');
                    $energetyczna_table = get_sub_field('componentsModal_tables_energetyczna');
                    $aktywne_table = get_sub_field('componentsModal_tables_aktywne');
                    $rws_wyjasnienie = get_sub_field('componentsModal_tables_rws_wyjasnienie');
                ?>
                <div class="componentsModal__flavour">
                    <div class="heading">
                        <h2><?php _e('Flavour', 'codestick'); ?>: <?php echo $flavour_name; ?></h2>
                    </div>
                    <div class="content">
                        <div class="content__desc">
                            <?php echo $flavour_desc; ?>
                        </div>
                        <?php if(have_rows('componentsModal_tables_energetyczna')): while( have_rows('componentsModal_tables_energetyczna')): the_row(); ?>
                        <div class="content__wartosciodzywcze">
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <?php while(have_rows('componentsModal_tables_energetyczna_headings')): the_row();
                                                $energetyczna_table_headings_name = get_sub_field('componentsModal_tables_energetyczna_headings_name')
                                            ?>
                                                <th><?php echo $energetyczna_table_headings_name; ?></th>
                                            <?php endwhile; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('componentsModal_tables_energetyczna_content')): the_row();
                                            $energetyczna_table_content_1 = get_sub_field('componentsModal_tables_energetyczna_content_1');
                                            $energetyczna_table_content_2 = get_sub_field('componentsModal_tables_energetyczna_content_2');
                                            $energetyczna_table_content_3 = get_sub_field('componentsModal_tables_energetyczna_content_3');
                                            $energetyczna_table_content_4 = get_sub_field('componentsModal_tables_energetyczna_content_4');
                                            $energetyczna_table_content_5 = get_sub_field('componentsModal_tables_energetyczna_content_5');
                                            $energetyczna_table_content_6 = get_sub_field('componentsModal_tables_energetyczna_content_6');
                                            $energetyczna_table_content_7 = get_sub_field('componentsModal_tables_energetyczna_content_7');
                                            $energetyczna_table_content_8 = get_sub_field('componentsModal_tables_energetyczna_content_8');
                                        ?>
                                            <tr>
                                            <?php if($energetyczna_table_content_1): ?>
                                                <td><?php echo $energetyczna_table_content_1; ?></td>
                                            <?php endif; ?>
                                            <?php if($energetyczna_table_content_2): ?>
                                                <td><?php echo $energetyczna_table_content_2; ?></td>
                                            <?php endif; ?>
                                            <?php if($energetyczna_table_content_3): ?>
                                                <td><?php echo $energetyczna_table_content_3; ?></td>
                                            <?php endif; ?>
                                            <?php if($energetyczna_table_content_4): ?>
                                                <td><?php echo $energetyczna_table_content_4; ?></td>
                                            <?php endif; ?>
                                            <?php if($energetyczna_table_content_5): ?>
                                                <td><?php echo $energetyczna_table_content_5; ?></td>
                                            <?php endif; ?>
                                            <?php if($energetyczna_table_content_6): ?>
                                                <td><?php echo $energetyczna_table_content_6; ?></td>
                                            <?php endif; ?>
                                            <?php if($energetyczna_table_content_7): ?>
                                                <td><?php echo $energetyczna_table_content_7; ?></td>
                                            <?php endif; ?>
                                            <?php if($energetyczna_table_content_8): ?>
                                                <td><?php echo $energetyczna_table_content_8; ?></td>
                                            <?php endif; ?>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endwhile; endif; ?>
                        <?php if(have_rows('componentsModal_tables_aktywne')): while( have_rows('componentsModal_tables_aktywne')): the_row(); ?>
                        <div class="content__aktywne">
                            <h3><?php _e('Active ingredients', 'codestick'); ?>:</h3>
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <?php while(have_rows('componentsModal_tables_aktywne_headings')): the_row();
                                                $aktywne_table_headings_name = get_sub_field('componentsModal_tables_aktywne_headings_name')
                                            ?>
                                                <th><?php echo $aktywne_table_headings_name; ?></th>
                                            <?php endwhile; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while(have_rows('componentsModal_tables_aktywne_content')): the_row();
                                            $aktywne_table_content_1 = get_sub_field('componentsModal_tables_aktywne_content_1');
                                            $aktywne_table_content_2 = get_sub_field('componentsModal_tables_aktywne_content_2');
                                            $aktywne_table_content_3 = get_sub_field('componentsModal_tables_aktywne_content_3');
                                            $aktywne_table_content_4 = get_sub_field('componentsModal_tables_aktywne_content_4');
                                            $aktywne_table_content_5 = get_sub_field('componentsModal_tables_aktywne_content_5');
                                            $aktywne_table_content_6 = get_sub_field('componentsModal_tables_aktywne_content_6');
                                            $aktywne_table_content_7 = get_sub_field('componentsModal_tables_aktywne_content_7');
                                            $aktywne_table_content_8 = get_sub_field('componentsModal_tables_aktywne_content_8');
                                        ?>
                                            <tr>
                                            <?php if($aktywne_table_content_1): ?>
                                                <td><?php echo $aktywne_table_content_1; ?></td>
                                            <?php endif; ?>
                                            <?php if($aktywne_table_content_2): ?>
                                                <td><?php echo $aktywne_table_content_2; ?></td>
                                            <?php endif; ?>
                                            <?php if($aktywne_table_content_3): ?>
                                                <td><?php echo $aktywne_table_content_3; ?></td>
                                            <?php endif; ?>
                                            <?php if($aktywne_table_content_4): ?>
                                                <td><?php echo $aktywne_table_content_4; ?></td>
                                            <?php endif; ?>
                                            <?php if($aktywne_table_content_5): ?>
                                                <td><?php echo $aktywne_table_content_5; ?></td>
                                            <?php endif; ?>
                                            <?php if($aktywne_table_content_6): ?>
                                                <td><?php echo $aktywne_table_content_6; ?></td>
                                            <?php endif; ?>
                                            <?php if($aktywne_table_content_7): ?>
                                                <td><?php echo $aktywne_table_content_7; ?></td>
                                            <?php endif; ?>
                                            <?php if($aktywne_table_content_8): ?>
                                                <td><?php echo $aktywne_table_content_8; ?></td>
                                            <?php endif; ?>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if($rws_wyjasnienie): ?>
                            <div class="rws_wyjasnienie">
                                <?php echo $rws_wyjasnienie; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>