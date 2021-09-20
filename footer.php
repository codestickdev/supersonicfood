<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Supersonicfood
 */

?>


<?php
	$lang = get_bloginfo("language");
	$produtid = 0;
	if($lang == 'en-US'){
		$productid = 2476;
	}else if($lang == 'de-DE'){
		$productid = 21497;
	}else{
		$productid = 103;
	}
?>
<?php if(is_front_page()): ?>
<div id="productComponents" class="componentsModal">
	<div class="componentsModal__wrap">
		<div class="closeModal">
			<img src="/wp-content/themes/supersonicfood/images/icons/closemodal_ico.png"/>
		</div>
		<div class="componentsModal__openContent">
			<h2><?php _e('List of ingredients and nutritional values', 'codestick'); ?></h2>
			<?php the_field('components_modal_opencontent', $productid); ?>
		</div>
		<div class="componentsModal__flavours">
			<?php while( have_rows('components_modal_tables', $productid) ): the_row(); 
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
					<?php if( have_rows('components_modal_tables_falvour_table_wartosciodzywcze', $productid) ): ?>
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
									<?php while( have_rows('components_modal_tables_falvour_table_wartosciodzywcze', $productid) ): the_row(); 
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
					<?php if( have_rows('components_modal_tables_falvour_table_witaminy', $productid) ): ?>
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
									<?php while( have_rows('components_modal_tables_falvour_table_witaminy', $productid) ): the_row(); 
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
					<?php if( have_rows('components_modal_tables_falvour_table_aktywne', $productid) ): ?>
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
									<?php while( have_rows('components_modal_tables_falvour_table_aktywne', $productid) ): the_row(); 
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
	</div>
</div>
<?php endif; ?>
<footer id="colophon" class="siteFooter">
	<div class="siteFooter__top">
		<div class="siteFooter__logo">
			<img src="/wp-content/themes/supersonicfood/images/claim_footer.svg" />
		</div>
		<?php $lang = get_bloginfo("language"); ?>
		<?php if($lang == 'en-US'): ?>
		<div class="siteFooter__linksWrap">
			<div class="siteFooter__links">
				<a href="/en/our-products/" class="siteFooter__link">Our Products</a>
			</div>
			<div class="siteFooter__links">
				<a href="/en/about-us/" class="siteFooter__link">About us</a>
				<a href="/en/about-us/" class="siteFooter__link">History</a>
				<a href="https://www.instagram.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialig"></a>
				<a href="https://www.facebook.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialfb"></a>
			</div>
			<div class="siteFooter__links">
				<a href="https://m.me/supersonicfood" class="siteFooter__link">Customer service</a>
				<a href="/en/contact-us/" class="siteFooter__link">Contact</a>
				<a href="/en/shipping/" class="siteFooter__link">Shipping</a>
				<a href="<?php the_field('regulamin_link', 11701); ?>" target="_blank" class="siteFooter__link">Terms and Conditions</a>
				<a href="<?php the_field('privacy_policy_link', 11701); ?>" target="_blank" class="siteFooter__link">Privacy policy</a>
			</div>
		</div>
		<?php elseif($lang == 'de-DE'): ?>
		<div class="siteFooter__linksWrap">
			<div class="siteFooter__links">
				<a href="/de/unsere-produkte/" class="siteFooter__link">Unsere Produkte</a>
			</div>
			<div class="siteFooter__links">
				<a href="/de/about-us" class="siteFooter__link">Über uns</a>
				<a href="/de/about-us" class="siteFooter__link">Geschichte</a>
				<a href="https://www.instagram.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialig"></a>
				<a href="https://www.facebook.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialfb"></a>
			</div>
			<div class="siteFooter__links">
				<a href="https://m.me/supersonicfood" class="siteFooter__link">Kundendienst</a>
				<a href="/de/kontakt/" class="siteFooter__link">Kontakt</a>
				<a href="/de/wysylka" class="siteFooter__link">Sendung</a>
				<a href="<?php the_field('regulamin_link', 11377); ?>" target="_blank" class="siteFooter__link">Vorschriften</a>
				<a href="<?php the_field('privacy_policy_link', 11377); ?>" target="_blank" class="siteFooter__link">Datenschutz-Bestimmungen</a>
			</div>
		</div>
		<?php else: ?>
		<div class="siteFooter__linksWrap">
			<div class="siteFooter__links">
				<a href="/nasze-produkty/" class="siteFooter__link">Nasze Produkty</a>
			</div>
			<div class="siteFooter__links">
				<a href="/about-us" class="siteFooter__link">O nas</a>
				<a href="/about-us" class="siteFooter__link">Historia</a>
				<a href="https://www.instagram.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialig"></a>
				<a href="https://www.facebook.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialfb"></a>
			</div>
			<div class="siteFooter__links">
				<a href="https://m.me/supersonicfood" class="siteFooter__link">Obsługa klienta</a>
				<a href="/kontakt" class="siteFooter__link">Kontakt</a>
				<a href="/wysylka" class="siteFooter__link">Wysyłka</a>
				<a href="<?php the_field('regulamin_link', 11377); ?>" target="_blank" class="siteFooter__link">Regulamin</a>
				<a href="<?php the_field('privacy_policy_link', 11377); ?>" target="_blank" class="siteFooter__link">Polityka Prywatności</a>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<div class="siteFooter__bottom">
		<div class="siteFooter__logos">
			<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/delivery/inpost.png" /></div>
			<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/delivery/dpd.png" /></div>
			<div class="siteFooter__logosLogo siteFooter__logosLogo--divider"></div>
			<?php if($lang == 'de-DE'): ?>
				<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/payment/paypal.webp" /></div>
			<?php endif; ?>
			<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/payment/payu.png" /></div>
			<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/payment/visa.png" /></div>
			<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/payment/mastercard.png" /></div>
			<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/payment/gpay.png" /></div>
			<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/payment/applepay.png" /></div>
		</div>
	</div>
	<div class="siteFooter__copyrights">
		<p>© Supersonic Food Company Ltd, London, United Kingdom | Dev by <a href="https://codestick.pl/" target="_blank">Codestick</a></p>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<div id="modalAdded" class="modalAdded">
	<div class="modalAdded__wrap">
		<div class="modalAdded__heading">
			<h2><?php _e('The product has been added to the cart', 'codestick'); ?></h2>
			<p><?php _e('Check out our other products or go to the cart.', 'codestick'); ?></p>
		</div>
		<?php
			$post_objects = get_field('modalAdded_products');
		if( $post_objects ): ?>
		<div class="modalAdded__productsWrap">
			<div class="modalAdded__products">
				<?php foreach( $post_objects as $post_object):
					$product = wc_get_product($post_object->ID);
					if ($product->is_type( 'simple' )) {
						$regular_price  =  $product->get_regular_price();
					}
					elseif($product->is_type('variable')){
						$regular_price  =  $product->get_variation_regular_price( 'max', true );
					}
				?>
				<div class="modalAdded__product">
					<a href="<?php the_permalink( $post_object->ID ); ?>">
						<div class="thumb">
							<img src="<?php echo get_the_post_thumbnail_url( $post_object->ID ); ?>"/>
						</div>
						<h3><?php echo get_the_title($post_object->ID); ?></h3>
						<p class="price"><?php echo wc_price($regular_price); ?></p>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif;?>
		<?php
			$cartURL = '';
			if($lang == 'en-US'){
				$cartURL = home_url('/cart/');
			}else if($lang == 'de-DE'){
				$cartURL = home_url('/korb/');
			}else{
				$cartURL = home_url('/koszyk/');
			}
		?>
		<div class="modalAdded__continue">
			<a href="<?php 
				$obj_id = get_queried_object_id();
				$current_url = get_permalink( $obj_id );
				$redirect = $current_url . '?cartModal=success';
				echo $redirect;
			?>" class="continue"><span><?php _e('Continue shopping', 'codestick'); ?></span></a>
			<a href="<?php echo $cartURL; ?>" class="btn"><span><?php _e('Go to cart', 'codestick'); ?></span></a>
		</div>
	</div>
</div>
<?php wp_footer(); ?>

</body>

</html>