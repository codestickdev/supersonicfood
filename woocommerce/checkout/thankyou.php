<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>
<div class="thankyou__gtm" userid="<?php echo get_current_user_id(); ?>" firstname="<?php echo $order->get_billing_first_name(); ?>" lastname="<?php echo $order->get_billing_last_name(); ?>" email="<?php echo $order->get_billing_email(); ?>" phone="<?php echo $order->get_billing_phone(); ?>">
	<?php // print_r($order); ?>
	<?php
		foreach ( $order->get_items() as $item_id => $item ):
		$fullName = $item['name'];
		$productID = $item['product_id'];
		$title = get_the_title($productID);
		$variantName = str_replace($title . ' - ', '', $fullName);
		$variantID = $item['variation_id'];
		$quantity = $item['quantity'];
		$price = round($item['subtotal'] + $item['subtotal_tax']) / $quantity;
		
		if($variantID !== 0){
			$product = new WC_Product_Variable($productID);
			$variations = $product->get_available_variations();
			foreach ( $variations as $variation ) {
				if($variation['variation_id'] == $variantID){
					$imageURL = wp_get_attachment_image_src($variation['image_id']);
				}
			}
		}else{
			$imageURL = wp_get_attachment_image_src(get_post_thumbnail_id($productID));
		}

		$productURL = get_permalink($productID);
	?>
		<div data-title="<?php echo $title; ?>" data-variant-name="<?php echo $variantName; ?>" data-variant-id="<?php echo $variantID; ?>" data-id="<?php echo $productID; ?>" data-price="<?php echo $price; ?>" data-image="<?php echo $imageURL[0]; ?>" data-url="<?php echo $productURL; ?>" data-quantity="<?php echo $quantity; ?>"></div>
	<?php endforeach; ?>
	<?php
		foreach( $order->get_coupon_codes() as $coupon_code ):
			$coupon = $coupon_code;
	?>
	<?php endforeach; ?>
</div>
<img src="https://smartmailings.go2cloud.org/aff_l?offer_id=1176&adv_sub=<?php echo $order->get_id(); ?>" width="1" height="1" />
<div class="woocommerce-order container" orderID="<?php echo $order->get_id(); ?>" orderAMOUNT="<?php $orderTax = $order->get_total_tax(); $orderValue = $order->get_total(); echo $orderValue - $orderTax;?>" ordertax="<?php echo $orderTax; ?>" shippingcost="<?php echo $order->get_shipping_total(); ?>" couponcode="<?php echo $coupon; ?>">

	<?php
	if ($order) :

		do_action('woocommerce_before_thankyou', $order->get_id());
	?>

		<?php if ($order->has_status('failed')) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
				<?php if (is_user_logged_in()) : ?>
					<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), $order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																											?></p>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php esc_html_e('Order number:', 'woocommerce'); ?>
					<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php esc_html_e('Date:', 'woocommerce'); ?>
					<strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></strong>
				</li>

				<?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php esc_html_e('Email:', 'woocommerce'); ?>
						<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php esc_html_e('Total:', 'woocommerce'); ?>
					<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></strong>
				</li>

				<?php if ($order->get_payment_method_title()) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e('Payment method:', 'woocommerce'); ?>
						<strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
					</li>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

		<?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
		<?php do_action('woocommerce_thankyou', $order->get_id()); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																										?></p>

	<?php endif; ?>

</div>
<script type="text/javascript">
	console.log(orderID + ', Kwota ' + orderAmount);
	var ttConversionOptions = ttConversionOptions || [];
	ttConversionOptions.push({
		type: 'sales',
		campaignID: '34066',
		productID: '53208',
		transactionID: '',
		transactionAmount: '',
		quantity: '1',
		descrMerchant: '',
		descrAffiliate: '',
		vc: '',
		currency: ''
	});
</script>
<noscript>
	<img src="//ts.tradetracker.net/?cid=34066&amp;pid=53208&amp;tid=ORDER_ID&amp;tam=ORDER_AMOUNT&amp;data=&amp;qty=1&amp;descrMerchant=&amp;descrAffiliate=&amp;event=sales&amp;currency=EUR&amp;vc=" alt="" />
</noscript>
<script type="text/javascript">
	// No editing needed below this line.
	(function(ttConversionOptions) {
		var campaignID = 'campaignID' in ttConversionOptions ? ttConversionOptions.campaignID : ('length' in ttConversionOptions && ttConversionOptions.length ? ttConversionOptions[0].campaignID : null);
		var tt = document.createElement('script');
		tt.type = 'text/javascript';
		tt.async = true;
		tt.src = '//tm.tradetracker.net/conversion?s=' + encodeURIComponent(campaignID) + '&t=m';
		var s = document.getElementsByTagName('script');
		s = s[s.length - 1];
		s.parentNode.insertBefore(tt, s);
	})(ttConversionOptions);
</script>

<script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>
<script>
	jQuery(document).ready(function(){
		jQuery('body').on('country_added', function(){
			var gcr_orderid = jQuery('.woocommerce-order').attr('orderid');
			var gcr_email = jQuery('.thankyou__gtm').attr('email');
			var gcr_country = jQuery('body').attr('country');

			var d = new Date();
			d.setHours(d.getHours() + 24);
			var month = d.getMonth()+1;
			var day = d.getDate();
			var gcr_delivery = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;

			window.renderOptIn = function() {
				window.gapi.load('surveyoptin', function() {
					window.gapi.surveyoptin.render({
						// REQUIRED FIELDS
						"merchant_id": 118481053,
						"order_id": gcr_orderid,
						"email": gcr_email,
						"delivery_country": gcr_country,
						"estimated_delivery_date": gcr_delivery,

						// OPTIONAL FIELDS
						// "products": [{"gtin":"GTIN1"}, {"gtin":"GTIN2"}]
					});
				});
			}
		});
	});
</script>