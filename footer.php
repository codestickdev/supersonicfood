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
			<h2>
			<?php
				if($lang == 'en-US'){
					echo "List of ingredients and nutritional values";
				}else{
					echo "Lista składników i wartości odżywczych";
				}
			?>
			</h2>
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
					<h2><?php if($lang == 'en-US'){echo "Flavour: ";}else{echo "Smak: ";}?><?php echo $flavour_name; ?></h2>
				</div>
				<div class="content">
					<div class="content__desc">
						<?php echo $flavour_desc; ?>
					</div>
					<?php if(get_sub_field('components_modal_tables_falvour_alegreninfo')): ?>
					<div class="content__alergik">
						<h3><?php if($lang == 'en-US'){echo "Allergens:";}else{echo "Informacja dla alergików:";}?></h3>
						<p><?php echo $alergik; ?></p>
					</div>
					<?php endif; ?>
					<?php if( have_rows('components_modal_tables_falvour_table_wartosciodzywcze', $productid) ): ?>
					<div class="content__wartosciodzywcze">
						<h3><?php if($lang == 'en-US'){echo "Nutritional values:";}else{echo "Wartości odżywcze:";}?></h3>
						<div class="componentsModal__tableWrap">
							<table border="1">
								<thead>
									<tr>
										<th><?php if($lang == 'en-US'){echo "Nutritional value";}else{echo "Wartość odżywcza:";}?></th>
										<th><?php if($lang == 'en-US'){echo "in 100g";}else{echo "w 100g";}?></th>
										<th><?php if($lang == 'en-US'){echo "%NRV";}else{echo "% RWS";}?></th>
										<th><?php if($lang == 'en-US'){echo "Full meal portion (104.5g)";}else{echo "Porcja pełnego posiłku (104,5g)";}?></th>
										<th><?php if($lang == 'en-US'){echo "%NRV*";}else{echo "% RWS*";}?></th>
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
						<h3><th><?php if($lang == 'en-US'){echo "Vitamins and minerals:";}else{echo "Witaminy i składniki mineralne:";}?></th></h3>
						<div class="componentsModal__tableWrap">
							<table border="1">
								<thead>
									<tr>
										<th><?php if($lang == 'en-US'){echo "Vitamins and minerals";}else{echo "Witaminy i składniki mineralne";}?></th>
										<th><?php if($lang == 'en-US'){echo "in 100g";}else{echo "w 100g";}?></th>
										<th><?php if($lang == 'en-US'){echo "%NRV";}else{echo "% RWS";}?></th>
										<th><?php if($lang == 'en-US'){echo "Full meal portion (104.5g)";}else{echo "Porcja pełnego posiłku (104,5g)";}?></th>
										<th><?php if($lang == 'en-US'){echo "%NRV*";}else{echo "% RWS*";}?></th>
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
						<h3><?php if($lang == 'en-US'){echo "Active ingredients:";}else{echo "Składniki aktywne:";}?></h3>
						<div class="componentsModal__tableWrap">
							<table border="1">
								<thead>
									<tr>
										<th><?php if($lang == 'en-US'){echo "Active ingredient";}else{echo "Składnik aktywny";}?></th>
										<th><?php if($lang == 'en-US'){echo "in 100g";}else{echo "w 100g";}?></th>
										<th><?php if($lang == 'en-US'){echo "Full meal portion (104.5g)";}else{echo "Porcja pełnego posiłku (104,5g)";}?></th>
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
			<img src="/wp-content/themes/supersonicfood/images/supersonic_logo.svg" />
		</div>
		<?php $lang = get_bloginfo("language"); ?>
		<?php if($lang == 'en-US'): ?>
		<div class="siteFooter__linksWrap">
			<div class="siteFooter__links">
				<a href="/en/produkt/supersonic-powder/" class="siteFooter__link">Products</a>
				<a href="/en/produkt/supersonic-powder/" class="siteFooter__link">Powder</a>
				<a href="/en/produkt/izotonik" class="siteFooter__link">Isotonic</a>
				<a href="/en/produkt/supersonic-shaker/" class="siteFooter__link">Shaker</a>
			</div>
			<div class="siteFooter__links">
				<a href="/en/about-us/" class="siteFooter__link">About us</a>
				<a href="/en/about-us/" class="siteFooter__link">History</a>
				<a href="https://www.instagram.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialig"></a>
				<a href="https://www.facebook.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialfb"></a>
			</div>
			<div class="siteFooter__links">
				<a href="https://m.me/supersonicfood" class="siteFooter__link">Customer service</a>
				<a href="https://m.me/supersonicfood" class="siteFooter__link">Contact</a>
				<a href="/en/shipping/" class="siteFooter__link">Shipping</a>
				<a href="https://supersonicfood.com/wp-content/uploads/2020/11/Regulamin-Supersonic-Food-2020.pdf" class="siteFooter__link">Terms and Conditions</a>
				<a href="https://supersonicfood.com/wp-content/uploads/2020/09/Polityka-Prywatnos%CC%81ci-Supersonic-Food.pdf" class="siteFooter__link">Privacy policy</a>
			</div>
		</div>
		<?php else: ?>
			<div class="siteFooter__linksWrap">
			<div class="siteFooter__links">
				<a href="/produkt/supersonic-powder" class="siteFooter__link">Produkty</a>
				<a href="/produkt/supersonic-powder" class="siteFooter__link">Powder</a>
				<a href="/produkt/izotonik" class="siteFooter__link">Isotonik</a>
				<a href="/produkt/supersonic-shaker" class="siteFooter__link">Shaker</a>
			</div>
			<div class="siteFooter__links">
				<a href="/about-us" class="siteFooter__link">O nas</a>
				<a href="/about-us" class="siteFooter__link">Historia</a>
				<a href="https://www.instagram.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialig"></a>
				<a href="https://www.facebook.com/supersonicfood/" target="_blank" class="siteFooter__link siteFooter__link--socialfb"></a>
			</div>
			<div class="siteFooter__links">
				<a href="https://m.me/supersonicfood" class="siteFooter__link">Obsługa klienta</a>
				<a href="https://m.me/supersonicfood" class="siteFooter__link">Kontakt</a>
				<a href="/wysylka" class="siteFooter__link">Wysyłka</a>
				<a href="<?php echo home_url('/regulamin'); ?>" class="siteFooter__link">Regulamin</a>
				<a href="<?php echo home_url('/polityka-prywatnosci'); ?>" class="siteFooter__link">Polityka Prywatności</a>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<div class="siteFooter__bottom">
		<div class="siteFooter__logos">
			<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/delivery/inpost.png" /></div>
			<div class="siteFooter__logosLogo"><img src="/wp-content/themes/supersonicfood/images/delivery/dpd.png" /></div>
			<div class="siteFooter__logosLogo siteFooter__logosLogo--divider"></div>
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
			<?php if($lang == 'en-US'): ?>
				<h2>The product has been added to the cart</h2>
				<p>Check out our other products or go to the cart.</p>
			<?php else: ?>
				<h2>Produkt został dodany do koszyka</h2>
				<p>Sprawdź nasze inne produkty lub przejdź do koszyka.</p>
			<?php endif; ?>
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

		<div class="modalAdded__continue">
			<a href="<?php 
				$obj_id = get_queried_object_id();
				$current_url = get_permalink( $obj_id );
				$redirect = $current_url . '?cartModal=success';
				echo $redirect;
			?>" class="continue">
				<?php if($lang == 'en-US'): ?>
					<span>Continue shopping</span>
				<?php else: ?>
					<span>Kontynuuj zakupy</span>
				<?php endif; ?>
			</a>
			<a href="<?php echo wc_get_cart_url(); ?>" class="btn">
				<?php if($lang == 'en-US'): ?>
					<span>Order and pay</span>
				<?php else: ?>
					<span>Zamów i zapłać</span>
				<?php endif; ?>
			</a>
		</div>
	</div>
</div>
<?php wp_footer(); ?>

</body>

</html>