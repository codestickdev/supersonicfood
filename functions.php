<?php
/**
 * Supersonicfood functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Supersonicfood
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'supersonicfood_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function supersonicfood_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Supersonicfood, use a find and replace
		 * to change 'supersonicfood' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'supersonicfood', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'supersonicfood' ),
				'menu-2' => esc_html__( 'Mobile', 'supersonicfood' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'supersonicfood_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'supersonicfood_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function supersonicfood_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'supersonicfood_content_width', 640 );
}
add_action( 'after_setup_theme', 'supersonicfood_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function supersonicfood_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'supersonicfood' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'supersonicfood' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'supersonicfood_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function supersonicfood_scripts() {
	wp_enqueue_style( 'supersonicfood-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'supersonicfood-style', 'rtl', 'replace' );

	wp_enqueue_script( 'supersonicfood-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'supersonicfood_scripts' );


/**
 * Custom files
 */
function theme_styles(){
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/plugins/slick/slick-theme.css' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/plugins/slick/slick.css' );
}
add_action('wp_enqueue_scripts', 'theme_styles');

function theme_scripts() {
	wp_register_script('slick-script', get_template_directory_uri() . '/plugins/slick/slick.min.js', array('jquery'), true);
	wp_enqueue_script('slick-script');
	
    wp_register_script('custom_script', get_template_directory_uri() . '/js/custom.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('custom_script');

	wp_register_script('product-page', get_template_directory_uri() . '/js/product-page.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('product-page');
	
	wp_register_script('sliders-script', get_template_directory_uri() . '/js/sliders.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('sliders-script');
} 

add_action( 'wp_enqueue_scripts', 'theme_scripts', 999 ); 


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/* ACF JSON */
 
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}

/* Product functions */

// Minimum quantity for products
function wc_get_product_min_limit( $product_id ) {
    $qty = get_post_meta( $product_id, '_custom_product_number_field_min', true );
    if ( empty( $qty ) ) {
        $limit = false;
    } else {
        $limit = (int) $qty;
    }
    return $limit;
}

function wc_qty_get_cart_qty( $product_id ) {
    global $woocommerce;
    $running_qty = 0;

    foreach($woocommerce->cart->get_cart() as $other_cart_item_keys => $values ) {
        if ( $product_id == $values['product_id'] ) {				
            $running_qty += (int) $values['quantity'];
        }
    }

    return $running_qty;
}

function wc_qty_update_cart_validation( $passed, $cart_item_key, $values, $quantity ) {
    $product_min = wc_get_product_min_limit( $values['product_id'] );

    if ( ! empty( $product_min ) ) {
        if ( false !== $product_min ) {
            $new_min = $product_min;
        } else {
            return $passed;
        }
    }

    $product = wc_get_product( $values['product_id'] );
    $already_in_cart = wc_qty_get_cart_qty($values['product_id']);

    if ( isset( $new_min) && ($already_in_cart + $quantity - $values['quantity']) < $new_min ) {
        wc_add_notice( printf( __( 'You should have minimum %1$s of %2$s. Add minimum 2 other taste of this meal and then remove this one.', 'translate' ), $new_min, $product->get_title()));
        $passed = false;
    }

    return $passed;
}
add_filter( 'woocommerce_update_cart_validation', 'wc_qty_update_cart_validation', 1, 4 );

function remove_link( $link, $cart_item_key ){
    if(WC()->cart->find_product_in_cart( $cart_item_key ) ){
        $cart_item = WC()->cart->cart_contents[ $cart_item_key ];
        $product = wc_get_product( $cart_item['product_id'] );
        $product_min = wc_get_product_min_limit( $cart_item['product_id'] );

        if ( ! empty( $product_min ) ) {
            if ( false !== $product_min ) {
                $new_min = $product_min;
            } else {
                return $passed;
            }
        }

        $already_in_cart = wc_qty_get_cart_qty($cart_item['product_id']);
        if( isset($new_min) && $already_in_cart - $cart_item['quantity'] < $new_min && !($cart_item['quantity'] == $already_in_cart)){
            $link = '';
        }
    }
    return $link;
}
add_filter( 'woocommerce_cart_item_remove_link', 'remove_link', 10, 2 );


add_action( 'woocommerce_product_options_inventory_product_data', 'wc_rations_qty_add_product_field' );

function wc_rations_qty_save_product_field( $post_id ) {
    $val_min = trim( get_post_meta( $post_id, '_wc_rations_qty', true ) );
    $new_min = sanitize_text_field( $_POST['_wc_rations_qty'] );
    $val_rations_name = trim( get_post_meta( $post_id, '_wc_rations_name', true ) );
    $new_rations_name = sanitize_text_field( $_POST['_wc_rations_name'] );
    $val_submeal_name = trim( get_post_meta( $post_id, '_wc_submeal_name', true ) );
    $new_submeal_name = sanitize_text_field( $_POST['_wc_submeal_name'] );
    $val_submeal_ratio = trim( get_post_meta( $post_id, '_wc_submeal_ratio', true ) );
    $new_submeal_ratio = sanitize_text_field( $_POST['_wc_submeal_ratio'] );
    $val_grammage = trim( get_post_meta( $post_id, '_wc_grammage', true ) );
    $new_grammage = sanitize_text_field( $_POST['_wc_grammage'] );
    if ( $val_min != $new_min ) {
        update_post_meta( $post_id, '_wc_rations_qty', $new_min );
    }
    if ( $val_rations_name != $new_rations_name ) {
        update_post_meta( $post_id, '_wc_rations_name', $new_rations_name );
    }
    if ( $val_submeal_name != $new_submeal_name ) {
        update_post_meta( $post_id, '_wc_submeal_name', $new_submeal_name );
    }
    if ( $val_submeal_ratio != $new_submeal_ratio ) {
        update_post_meta( $post_id, '_wc_submeal_ratio', $new_submeal_ratio );
    }
    if ( $val_grammage != $new_grammage ) {
        update_post_meta( $post_id, '_wc_grammage', $new_grammage );
    }
}

// Rations field for product
function wc_rations_qty_add_product_field() {
    echo '<div class="options_group">';
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_wc_rations_qty', 
            'label'       => __( 'Rations Quantity', 'translate' ), 
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => __( 'Enter a number, 1 or greater.', 'translate' ) 
        )
    );
    echo '</div>';
    echo '<div class="options_group">';
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_wc_rations_name', 
            'label'       => __( 'Rations name', 'translate' ), 
            'placeholder' => '',
        )
    );
    echo '</div>';
    echo '<div class="options_group">';
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_wc_submeal_name', 
            'label'       => __( 'Submeals Name', 'translate' ), 
            'placeholder' => '',
        )
    );
    echo '</div>';
    echo '<div class="options_group">';
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_wc_submeal_ratio', 
            'label'       => __( 'How many submeals ration contains? Let it empty to not showing submeals quantity', 'translate' ), 
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => __( 'Enter a number, 1 or greater.', 'translate' ) 
        )
    );
    echo '</div>';
    echo '<div class="options_group">';
    woocommerce_wp_text_input( 
        array( 
            'id'          => '_wc_grammage', 
            'label'       => __( 'Custom field for product', 'translate' ), 
            'placeholder' => '',
            'description' => __( 'This will be displayed in cart', 'translate' ) 
        )
    );
    echo '</div>';
}

add_action( 'woocommerce_process_product_meta', 'wc_rations_qty_save_product_field' );

function wc_rations_view() {
    global $post;
    $rations_name = trim( get_post_meta( $post->ID, '_wc_rations_name', true ) );
    $submeal_name = trim( get_post_meta( $post->ID, '_wc_submeal_name', true ) );
    $submeal_ratio = trim( get_post_meta( $post->ID, '_wc_submeal_ratio', true ) );
    $quantity = trim( get_post_meta( $post->ID, '_custom_product_number_field_min', true ) );
    $lang = get_bloginfo("language");?>

    <div class="rations-price" data-submeal-ratio="<?php echo $submeal_ratio; ?>"> 
        <div class="rations">
            <span>0</span> <?php echo $rations_name; ?> <?php if(!empty($submeal_ratio)) echo '(<span>0</span> '. $submeal_name . ')'; ?>
        </div>
        <div class="price-container">
            <div class="reg-price">
                <span>0</span> <?php echo get_woocommerce_currency_symbol(); ?>
            </div>
            <div class="sale-price">
                <span>0</span> <?php echo get_woocommerce_currency_symbol(); ?>
            </div>
            <div class="sum"><?php _e('Suma', 'barbet-theme'); ?>:</div>
        </div>
    </div>
    <div class="productDiscount" qty="0" postID="<?php echo $post->ID; ?>">
        <p><?php _e('Product quantity', 'codestick'); ?> <span class="productQty">0</span> - <?php _e('discount', 'codestick'); ?> <span><span class="rabatValue">0</span>%</span></p>
        <p><span><span class="afterPrice">0</span><?php if($lang == 'pl-PL'): ?> zł<?php else: ?> €<?php endif; ?></span></p>
    </div>

    <div class="info-container ic-desktop">
        <?php if($quantity > 1): ?>
            <p class="form-title minimumQuantity"><?php _e('The minimum order is '. $quantity .' packages', 'codestick'); ?></p>
        <?php endif; ?>
        <p class="free-shipping"><?php _e('Free delivery from 30€ in Poland', 'codestick'); ?></p>
    </div>
    <?php
}
add_action( 'wqcmv_table_after', 'wc_rations_view' );


function wc_rations_mobile_view() {
    $lang = get_bloginfo("language");
    if (is_product()) { ?>
    <div class="rations-price mobile">
        <div class="reg-price">
            <span>0</span> <?php echo get_woocommerce_currency_symbol(); ?>
        </div>
        <div class="sale-price">
            <span>0</span> <?php echo get_woocommerce_currency_symbol(); ?>
        </div>
    </div>
    <div class="info-container ic-mobile">
        <?php if($quantity > 1): ?>
            <p class="form-title"><?php _e('The minimum order is '. $quantity .' packages', 'codestick'); ?></p>
        <?php endif; ?>
        <p class="free-shipping"><?php _e('Free delivery from 180zł in Poland', 'codestick'); ?></p>
    </div>
    <?php }
}
add_action( 'wqcmv_table_button_after', 'wc_rations_mobile_view' );

function langCode() {
    if (is_product()) { ?>
        <script type="text/javascript">
            var langCode = '<?php echo apply_filters( 'wpml_current_language', NULL );  ?>';
            var siteUrl = '<?php echo bloginfo("wpurl"); ?>';
        </script>
    <?php }
}
add_action( 'wp_footer', 'langCode' );

add_filter( 'get_the_archive_title', 'replaceCategoryName'); 
   function replaceCategoryName ($title) {

   $title =  single_cat_title( '', false );
   return $title; 
}

/* Disable YoasSEO admin columns */
add_filter( 'manage_edit-post_columns', 'yoast_seo_admin_remove_columns', 10, 1 );
add_filter( 'manage_edit-page_columns', 'yoast_seo_admin_remove_columns', 10, 1 );
add_filter( 'manage_edit-product_columns', 'yoast_seo_admin_remove_columns', 10, 1 );

function yoast_seo_admin_remove_columns( $columns ) {
  unset($columns['wpseo-score']);
  unset($columns['wpseo-score-readability']);
  unset($columns['wpseo-title']);
  unset($columns['wpseo-metadesc']);
  unset($columns['wpseo-focuskw']);
  unset($columns['wpseo-links']);
  unset($columns['wpseo-linked']);
  unset($columns['wqcmv_product_type']);
  return $columns;
}

add_action('wp_footer','custom_jquery_add_to_cart_script');
function custom_jquery_add_to_cart_script(){
    ?>
        <script type="text/javascript">
            // Ready state
            (function($){ 

                $( document.body ).on( 'added_to_cart', function(){
                    console.log('EVENT: added_to_cart');
                });

            })(jQuery); // "jQuery" Working with WP (added the $ alias as argument)
        </script>
    <?php
}