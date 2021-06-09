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

        <?php if( have_rows('logosList', 11377) && $lang == 'pl-PL'  ): ?>
        <section id="morecontent" class="logosList">
            <div class="logosList__list container-lg">
                <?php while( have_rows('logosList', 11377) ): the_row();
                    $count = count(get_field('logosList', 11377));
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
        <?php if( current_user_can('editor') || current_user_can('administrator') ):  ?>
        <section class="productTesVid">
            <div class="productTesVid__wrap container-lg">
                <div class="productTesVid__content">
                    <h2>Lorem ipsum dolor sit amet</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="productTesVid__list">
                    <div class="productTesVid__video">
                        <div class="thumb">
                            <img src="<?php echo get_template_directory_uri() . '/images/testedthumb.jpeg'; ?>"/>
                        </div>
                        <p>Jan</p>
                    </div>
                    <div class="productTesVid__video">
                        <div class="thumb">
                            <img src="<?php echo get_template_directory_uri() . '/images/testedthumb.jpeg'; ?>"/>
                        </div>
                        <p>Tomasz</p>
                    </div>
                    <div class="productTesVid__video">
                        <div class="thumb">
                            <img src="<?php echo get_template_directory_uri() . '/images/testedthumb.jpeg'; ?>"/>
                        </div>
                        <p>Dawid</p>
                    </div>
                    <div class="productTesVid__video">
                        <div class="thumb">
                            <img src="<?php echo get_template_directory_uri() . '/images/testedthumb.jpeg'; ?>"/>
                        </div>
                        <p>Jarosław</p>
                    </div>
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
            <?php if(get_field('components_rodzaj_produktu') == 'powder'): ?>
            <div class="componentsModal__flavours">
                <?php while( have_rows('components_modal_tables') ): the_row(); 
                    $flavour_name = get_sub_field('components_modal_tables_flavour_name');
                    $flavour_desc = get_sub_field('components_modal_tables_falvour_desc');
                    $alergik = get_sub_field('components_modal_tables_falvour_alegreninfo');
                    $rws_wyjasnienie = get_sub_field('components_modal_tables_falvour_rws_wyjasnienie');
                ?>
                <div class="componentsModal__flavour">
                    <div class="heading">
                        <h2><?php _e('Flavour', 'codestick'); ?>: <?php echo $flavour_name; ?></h2>
                    </div>
                    <div class="content">
                        <div class="content__desc">
                            <?php echo $flavour_desc; ?>
                        </div>
                        <?php if(get_sub_field('components_modal_tables_falvour_alegreninfo')): ?>
                        <div class="content__alergik">
                            <h3><?php _e('Allergens', 'codestick'); ?>:</h3>
                            <p><?php echo $alergik; ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if( have_rows('components_modal_tables_falvour_table_wartosciodzywcze') ): ?>
                        <div class="content__wartosciodzywcze">
                            <h3><?php _e('Nutritional values', 'codestick'); ?>:</h3>
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                        <th><?php _e('Nutritional value', 'codestick'); ?></th>
										<th><?php _e('in 100g', 'codestick'); ?></th>
										<th><?php _e('%NRV', 'codestick'); ?></th>
										<th><?php _e('Full meal portion (104.5g)', 'codestick'); ?></th>
										<th><?php _e('%NRV*', 'codestick'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( have_rows('components_modal_tables_falvour_table_wartosciodzywcze') ): the_row(); 
                                            $wartoscodzywcza = get_sub_field('components_modal_tables_falvour_table_wartosciodzywcze_wartosc_odzywcza');
                                            $w100g = get_sub_field('components_modal_tables_falvour_table_wartosciodzywcze_w100g');
                                            $rws = get_sub_field('components_modal_tables_falvour_table_wartosciodzywcze_rws');
                                            $porcja = get_sub_field('components_modal_tables_falvour_table_wartosciodzywcze_porcja');
                                            $rwsstar = get_sub_field('components_modal_tables_falvour_table_wartosciodzywcze_rwsstar');
                                        ?>
                                        <tr>
                                            <td><?php echo $wartoscodzywcza; ?></td>
                                            <td><?php echo $w100g; ?></td>
                                            <td><?php echo $rws; ?></td>
                                            <td><?php echo $porcja; ?></td>
                                            <td><?php echo $rwsstar; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if(get_sub_field('components_modal_tables_falvour_rws_wyjasnienie')): ?>
                            <div class="rws_wyjasnienie">
                                <?php echo $rws_wyjasnienie; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php if( have_rows('components_modal_tables_falvour_table_witaminy') ): ?>
                        <div class="content__witaminy">
                            <h3><th><?php _e('Vitamins and minerals', 'codestick'); ?></th></h3>
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th><?php _e('Vitamins and minerals', 'codestick'); ?></th>
                                            <th><?php _e('in 100g', 'codestick'); ?></th>
                                            <th><?php _e('%NRV', 'codestick'); ?></th>
                                            <th><?php _e('Full meal portion (104.5g)', 'codestick'); ?></th>
                                            <th><?php _e('%NRV*', 'codestick'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( have_rows('components_modal_tables_falvour_table_witaminy') ): the_row(); 
                                            $wartoscodzywcza = get_sub_field('components_modal_tables_falvour_table_witaminy_wartosc_odzywcza');
                                            $w100g = get_sub_field('components_modal_tables_falvour_table_witaminy_w100g');
                                            $rws = get_sub_field('components_modal_tables_falvour_table_witaminy_rws');
                                            $porcja = get_sub_field('components_modal_tables_falvour_table_witaminy_porcja');
                                            $rwsstar = get_sub_field('components_modal_tables_falvour_table_witaminy_rwsstar');
                                        ?>
                                        <tr>
                                            <td><?php echo $wartoscodzywcza; ?></td>
                                            <td><?php echo $w100g; ?></td>
                                            <td><?php echo $rws; ?></td>
                                            <td><?php echo $porcja; ?></td>
                                            <td><?php echo $rwsstar; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if( have_rows('components_modal_tables_falvour_table_aktywne') ): ?>
                        <div class="content__aktywne">
                            <h3><?php _e('Active ingredients', 'codestick'); ?></h3>
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th><?php _e('Active ingredient', 'codestick'); ?></th>
                                            <th><?php _e('in 100g', 'codestick'); ?></th>
                                            <th><?php _e('Full meal portion (104.5g)', 'codestick'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( have_rows('components_modal_tables_falvour_table_aktywne') ): the_row(); 
                                            $skladnikaktywny = get_sub_field('components_modal_tables_falvour_table_aktywne_component');
                                            $w100g = get_sub_field('components_modal_tables_falvour_table_aktywne_w100g');
                                            $porcja = get_sub_field('components_modal_tables_falvour_table_aktywne_portion');
                                        ?>
                                        <tr>
                                            <td><?php echo $skladnikaktywny; ?></td>
                                            <td><?php echo $w100g; ?></td>
                                            <td><?php echo $porcja; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php elseif(get_field('components_rodzaj_produktu') == 'beauty'): ?>
            <div class="componentsModal__flavours">
                <?php while( have_rows('beauty_components_modal_tables') ): the_row(); 
                    $flavour_name = get_sub_field('beauty_components_modal_tables_flavour_name');
                    $flavour_desc = get_sub_field('beauty_components_modal_tables_falvour_desc');
                    $rws_wyjasnienie = get_sub_field('beauty_components_modal_tables_falvour_rws_wyjasnienie');
                ?>
                <div class="componentsModal__flavour">
                    <div class="heading">
                        <h2><?php _e('Flavour', 'codestick'); ?>: <?php echo $flavour_name; ?></h2>
                    </div>
                    <div class="content">
                        <div class="content__desc">
                            <?php echo $flavour_desc; ?>
                        </div>
                        <?php if( have_rows('beauty_components_modal_tables_falvour_table_energetyczna') ): ?>
                        <div class="content__wartosciodzywcze">
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><?php _e('Per daily portion (20 g)', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per daily portion (20 g)', 'codestick'); ?></th>
                                            <th><?php _e('Per 100 g', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per 100 g', 'codestick'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( have_rows('beauty_components_modal_tables_falvour_table_energetyczna') ): the_row(); 
                                            $dziennaporcja = get_sub_field('beauty_components_modal_tables_falvour_table_energetyczna_portion');
                                            $rwsdziennaporcja = get_sub_field('beauty_components_modal_tables_falvour_table_energetyczna_rwsportion');
                                            $w100g = get_sub_field('beauty_components_modal_tables_falvour_table_energetyczna_w100g');
                                            $rwsw100g = get_sub_field('beauty_components_modal_tables_falvour_table_energetyczna_rwsw100g');
                                        ?>
                                        <tr>
                                            <td><?php _e('Nutritional value', 'codestick'); ?></td>
                                            <td><?php echo $dziennaporcja; ?></td>
                                            <td><?php echo $rwsdziennaporcja; ?></td>
                                            <td><?php echo $w100g; ?></td>
                                            <td><?php echo $rwsw100g; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if( have_rows('beauty_components_modal_tables_falvour_table_aktywne') ): ?>
                        <div class="content__aktywne">
                            <h3><?php _e('Active ingredients', 'codestick'); ?>:</h3>
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th><?php _e('Active ingredients', 'codestick'); ?></th>
                                            <th><?php _e('Per daily portion (20 g)', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per daily portion (20 g)', 'codestick'); ?></th>
                                            <th><?php _e('Per 100 g', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per 100 g', 'codestick'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( have_rows('beauty_components_modal_tables_falvour_table_aktywne') ): the_row(); 
                                            $skladnikaktywny = get_sub_field('beauty_components_modal_tables_falvour_table_aktywne_component');
                                            $dziennaporcja = get_sub_field('beauty_componenets_modal_tables_flavour_table_aktywne_portion');
                                            $rwsdziennaporcja = get_sub_field('beauty_components_modal_tables_falvour_table_aktywne_rwsportion');
                                            $w100g = get_sub_field('beauty_components_modal_tables_falvour_table_aktywne_w100g');
                                            $rwsw100g = get_sub_field('beauty_components_modal_tables_falvour_table_aktywne_rwsw100g');
                                        ?>
                                        <tr>
                                            <td><?php echo $skladnikaktywny; ?></td>
                                            <td><?php echo $dziennaporcja; ?></td>
                                            <td><?php echo $rwsdziennaporcja; ?></td>
                                            <td><?php echo $w100g; ?></td>
                                            <td><?php echo $rwsw100g; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if(get_sub_field('beauty_components_modal_tables_falvour_rws_wyjasnienie')): ?>
                            <div class="rws_wyjasnienie">
                                <?php echo $rws_wyjasnienie; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php elseif(get_field('components_rodzaj_produktu') == 'calmcacao'): ?>
            <div class="componentsModal__flavours">
                <?php while( have_rows('calmcacao_components_modal_tables') ): the_row(); 
                    $flavour_name = get_sub_field('calmcacao_components_modal_tables_flavour_name');
                    $flavour_desc = get_sub_field('calmcacao_components_modal_tables_falvour_desc');
                    $rws_wyjasnienie = get_sub_field('calmcacao_components_modal_tables_falvour_rws_wyjasnienie');
                ?>
                <div class="componentsModal__flavour">
                    <div class="heading">
                        <h2><?php _e('Flavour', 'codestick'); ?>: <?php echo $flavour_name; ?></h2>
                    </div>
                    <div class="content">
                        <div class="content__desc">
                            <?php echo $flavour_desc; ?>
                        </div>
                        <?php if( have_rows('calmcacao_components_modal_tables_falvour_table_energetyczna') ): ?>
                        <div class="content__wartosciodzywcze">
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><?php _e('Per daily portion (18 g)', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per (18 g)', 'codestick'); ?></th>
                                            <th><?php _e('Per 100 g', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per 100 g', 'codestick'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( have_rows('calmcacao_components_modal_tables_falvour_table_energetyczna') ): the_row(); 
                                            $dziennaporcja = get_sub_field('calmcacao_components_modal_tables_falvour_table_energetyczna_portion');
                                            $rwsdziennaporcja = get_sub_field('calmcacao_components_modal_tables_falvour_table_energetyczna_rwsportion');
                                            $w100g = get_sub_field('calmcacao_components_modal_tables_falvour_table_energetyczna_w100g');
                                            $rwsw100g = get_sub_field('calmcacao_components_modal_tables_falvour_table_energetyczna_rwsw100g');
                                        ?>
                                        <tr>
                                            <td><?php _e('Nutritional value', 'codestick'); ?></td>
                                            <td><?php echo $dziennaporcja; ?></td>
                                            <td><?php echo $rwsdziennaporcja; ?></td>
                                            <td><?php echo $w100g; ?></td>
                                            <td><?php echo $rwsw100g; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if( have_rows('calmcacao_components_modal_tables_falvour_table_aktywne') ): ?>
                        <div class="content__aktywne">
                            <h3><?php _e('Active ingredients', 'codestick'); ?>:</h3>
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th><?php _e('Active ingredients', 'codestick'); ?></th>
                                            <th><?php _e('Per daily portion (18 g)', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per (18 g)', 'codestick'); ?></th>
                                            <th><?php _e('Per 100 g', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per 100 g', 'codestick'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( have_rows('calmcacao_components_modal_tables_falvour_table_aktywne') ): the_row(); 
                                            $skladnikaktywny = get_sub_field('calmcacao_components_modal_tables_falvour_table_aktywne_component');
                                            $dziennaporcja = get_sub_field('calmcacao_componenets_modal_tables_flavour_table_aktywne_portion');
                                            $rwsdziennaporcja = get_sub_field('calmcacao_components_modal_tables_falvour_table_aktywne_rwsportion');
                                            $w100g = get_sub_field('calmcacao_components_modal_tables_falvour_table_aktywne_w100g');
                                            $rwsw100g = get_sub_field('calmcacao_components_modal_tables_falvour_table_aktywne_rwsw100g');
                                        ?>
                                        <tr>
                                            <td><?php echo $skladnikaktywny; ?></td>
                                            <td><?php echo $dziennaporcja; ?></td>
                                            <td><?php echo $rwsdziennaporcja; ?></td>
                                            <td><?php echo $w100g; ?></td>
                                            <td><?php echo $rwsw100g; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if(get_sub_field('calmcacao_components_modal_tables_falvour_rws_wyjasnienie')): ?>
                            <div class="rws_wyjasnienie">
                                <?php echo $rws_wyjasnienie; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php elseif(get_field('components_rodzaj_produktu') == 'braincoffee'): ?>
            <div class="componentsModal__flavours">
                <?php while( have_rows('braincoffee_components_modal_tables') ): the_row(); 
                    $flavour_name = get_sub_field('braincoffee_components_modal_tables_flavour_name');
                    $flavour_desc = get_sub_field('braincoffee_components_modal_tables_falvour_desc');
                    $rws_wyjasnienie = get_sub_field('braincoffee_components_modal_tables_falvour_rws_wyjasnienie');
                ?>
                <div class="componentsModal__flavour">
                    <div class="heading">
                        <h2><?php _e('Flavour', 'codestick'); ?>: <?php echo $flavour_name; ?></h2>
                    </div>
                    <div class="content">
                        <div class="content__desc">
                            <?php echo $flavour_desc; ?>
                        </div>
                        <?php if( have_rows('braincoffee_components_modal_tables_falvour_table_energetyczna') ): ?>
                        <div class="content__wartosciodzywcze">
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><?php _e('Per daily portion (18 g)', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per (18 g)', 'codestick'); ?></th>
                                            <th><?php _e('Per 100 g', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per 100 g', 'codestick'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( have_rows('braincoffee_components_modal_tables_falvour_table_energetyczna') ): the_row(); 
                                            $dziennaporcja = get_sub_field('braincoffee_components_modal_tables_falvour_table_energetyczna_portion');
                                            $rwsdziennaporcja = get_sub_field('braincoffee_components_modal_tables_falvour_table_energetyczna_rwsportion');
                                            $w100g = get_sub_field('braincoffee_components_modal_tables_falvour_table_energetyczna_w100g');
                                            $rwsw100g = get_sub_field('braincoffee_components_modal_tables_falvour_table_energetyczna_rwsw100g');
                                        ?>
                                        <tr>
                                            <td><?php _e('Nutritional value', 'codestick'); ?></td>
                                            <td><?php echo $dziennaporcja; ?></td>
                                            <td><?php echo $rwsdziennaporcja; ?></td>
                                            <td><?php echo $w100g; ?></td>
                                            <td><?php echo $rwsw100g; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if( have_rows('braincoffee_components_modal_tables_falvour_table_aktywne') ): ?>
                        <div class="content__aktywne">
                            <h3><?php _e('Active ingredients', 'codestick'); ?>:</h3>
                            <div class="componentsModal__tableWrap">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th><?php _e('Active ingredients', 'codestick'); ?></th>
                                            <th><?php _e('Per daily portion (18 g)', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per (18 g)', 'codestick'); ?></th>
                                            <th><?php _e('Per 100 g', 'codestick'); ?></th>
                                            <th><?php _e('% RI* per 100 g', 'codestick'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( have_rows('braincoffee_components_modal_tables_falvour_table_aktywne') ): the_row(); 
                                            $skladnikaktywny = get_sub_field('braincoffee_components_modal_tables_falvour_table_aktywne_component');
                                            $dziennaporcja = get_sub_field('braincoffee_componenets_modal_tables_flavour_table_aktywne_portion');
                                            $rwsdziennaporcja = get_sub_field('braincoffee_components_modal_tables_falvour_table_aktywne_rwsportion');
                                            $w100g = get_sub_field('braincoffee_components_modal_tables_falvour_table_aktywne_w100g');
                                            $rwsw100g = get_sub_field('braincoffee_components_modal_tables_falvour_table_aktywne_rwsw100g');
                                        ?>
                                        <tr>
                                            <td><?php echo $skladnikaktywny; ?></td>
                                            <td><?php echo $dziennaporcja; ?></td>
                                            <td><?php echo $rwsdziennaporcja; ?></td>
                                            <td><?php echo $w100g; ?></td>
                                            <td><?php echo $rwsw100g; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if(get_sub_field('braincoffee_components_modal_tables_falvour_rws_wyjasnienie')): ?>
                            <div class="rws_wyjasnienie">
                                <?php echo $rws_wyjasnienie; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>