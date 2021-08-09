<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Supersonicfood
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NGD9FV2');</script>
	<!-- End Google Tag Manager -->
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/design.css">
	
	<script type="text/javascript">
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>

	<?php wp_head(); ?>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NGD9FV2"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
</head>
<?php
$user_id = get_current_user_id();

if(is_user_logged_in()){
	$userCountry = get_user_meta($user_id, 'lang_country', true);
}else{
	$userCountry = $_COOKIE['user_country'];
}


$cart_items = WC()->cart->get_cart();
$productQuantity = 0;

foreach ($cart_items as $cart_item => $item){
	$productDataID = $item['product_id'];
	$getDataQuantity = $item['quantity'];

	if($productDataID == 2476){
		$productQuantity += $getDataQuantity;
	}
	if($productDataID == 103){
		$productQuantity += $getDataQuantity;
	}
}
?>
<body <?php body_class(); ?> powderItems="<?php echo $productQuantity; ?>" currency="<?php echo get_woocommerce_currency_symbol(); ?>" lang="<?php echo get_bloginfo('language'); ?>">
<?php wp_body_open(); ?>
<div class="langData" style="display: none !important">
		<div class="langData__lang" data-iso="default" data-flag="<?php echo get_template_directory_uri() . '/images/icons/europe_flag.png'; ?>"></div>
	<?php while(have_rows('langSelector', 11377)): the_row();	
		$flag = get_sub_field('langSelector_flag');
		$name = get_sub_field('langSelector_name');
		$iso = get_sub_field('langSelector_code');
	?>
		<div class="langData__lang" data-iso="<?php echo $iso; ?>" data-flag="<?php echo $flag; ?>" data-name="<?php echo $name; ?>"></div>
	<?php endwhile; ?>
</div>
<?php $lang = get_bloginfo("language"); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'supersonicfood' ); ?></a>

	<header id="masthead" class="siteHeader">
		<div class="siteHeader__menu">
			<div class="siteHeader__mobileBtn">
				<img class="open" src="/wp-content/themes/supersonicfood/images/icons/mobileBtn_ico.svg"/>
				<img class="close" src="/wp-content/themes/supersonicfood/images/icons/mobileBtn-close_ico.svg"/>
			</div>
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div>
		<div class="siteHeader__logo">
			<a href="<?php echo home_url(); ?>">
				<img src="/wp-content/themes/supersonicfood/images/supersonic_logo.svg"/>
			</a>
		</div>
		<div class="siteHeader__actions">
			<div class="language">

				<?php if(!is_cart() && !is_checkout()): ?>
					<div class="language__select" data-lang="<?php echo $userCountry; ?>">
						<p><?php _e('Country', 'codestick'); ?>: <span class="selectLang"></span></p>
					</div>
					<?php echo do_shortcode('[wpml_language_switcher type="custom" native=0][/wpml_language_switcher]'); ?>
				<?php else: ?>
					<?php if(current_user_can('administrator')): ?>
						<div class="language__select" data-lang="<?php echo $userCountry; ?>">
							<p><?php _e('Country', 'codestick'); ?>: <span class="selectLang"></span></p>
						</div>
						<?php echo do_shortcode('[wpml_language_switcher type="custom" native=0][/wpml_language_switcher]'); ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<div class="user">
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="user__account"><img src="<?php echo get_template_directory_uri() . '/images/icons/user_ico.svg' ?>"/></a>
				<a class="user__cart">
					<img src="<?php echo get_template_directory_uri() . '/images/icons/cart_ico.svg' ?>"/>
					<span class="count">
						<?php 
							global $woocommerce;
							$count = $woocommerce->cart->cart_contents_count;
							if($count > 0){
								echo $count;
							}
						?>
					</span>
				</a>
			</div>
		</div>
	</header><!-- #masthead -->

	<div class="langSelector" data-lang="<?php echo get_user_meta($user_id, 'lang_country', true); ?>">
		<div class="langSelector__wrap">
			<div class="langSelector__back"><?php _e('Back', 'codestick'); ?></div>
			<?php while(have_rows('langSelector', 11377)): the_row();
				$flag = get_sub_field('langSelector_flag');
				$iso = get_sub_field('langSelector_code');
				$name = get_sub_field('langSelector_name');
				$lang = get_sub_field('langSelector_lang');
			?>
			<div class="langSelector__country" data-lang="<?php echo $lang; ?>" data-iso="<?php echo $iso; ?>">
				<div class="image">
					<img src="<?php echo $flag; ?>"/>
				</div>
				<p class="name"><?php echo $name; ?></p>
			</div>
			<?php endwhile; ?>
		</div>
	</div>

	<div class="cartModalWrap">
		<?php include get_template_directory() . '/woocommerce/cart/cartModal.php'; ?>
	</div>
	
	<div class="mobileMenu">
		<div class="mobileMenu__actions">
			<?php if(!is_cart() && !is_checkout()): ?>
			<?php echo do_shortcode('[wpml_language_switcher type="custom" native=0][/wpml_language_switcher]'); ?>
			<?php endif; ?>
		</div>
		<div class="mobileMenu__menu">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'mobile-menu',
					)
				);
				?>
		</div>
	</div>
	<?php
		$lang = get_bloginfo("language");
		$productsEN = array(
			'posts_per_page' 	=> -1,
			'post_type' 		=> 'product',
			'orderby'			=> 'post__in',
			'post__in'			=> [2476, 11732, 20294, 29374, 29397, 11796, 9696, 2474],
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
			'post__in'			=> [21497, 21666, 21695, 29371, 29394, 34102, 34110],
			'meta_query' => array(
				array(
				  'key' => 'product_main_visible',
				  'value' => '1',
				)
			),
		);
		$productsPL = array(
			'posts_per_page' 	=> -1,
			'post_type' 		=> 'product',
			'orderby'			=> 'post__in',
			'post__in'			=> [103, 5942, 17250, 29368, 29391, 34100, 34108],
			'meta_query' => array(
				array(
				  'key' => 'product_main_visible',
				  'value' => '1',
				)
			),
		);
		if($lang == 'en-US'){
			$query = new WP_Query($productsEN);
			$shopURL = home_url('/en/shop');
		}else if ($lang == 'de-DE'){
			$query = new WP_Query($productsDE);
			$shopURL = home_url('/de/geschaeft/');
		}else{
			$query = new WP_Query($productsPL);
			$shopURL = home_url('/sklep');
		}
	?>
	<?php if ($query->have_posts()) : ?>
	<div id="menuDropdown" class="menuDropdown">
		<div class="menuDropdown__list">
    	<?php while ($query->have_posts()) : $query->the_post(); ?>
			<a class="menuDropdown__product" href="<?php the_permalink(); ?>" productID="<?php the_ID(); ?>">
				<div class="thumb">
					<img src="<?php the_field('product_main_image'); ?>"/>
				</div>
				<p><?php the_title(); ?></p>
			</a>
    	<?php endwhile; ?>
		</div>
		<div class="menuDropdown__more">
			<a href="<?php echo $shopURL; ?>"><span><?php _e('See all products', 'codestick'); ?></span></a>
		</div>
	</div>
    <?php wp_reset_postdata(); ?>
	<?php endif; ?>
	
