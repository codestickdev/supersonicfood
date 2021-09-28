<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<div class="ssCheckout container" user-id="<?php echo get_current_user_id(); ?>">
    <div class="ssCheckout__gtmData" style="display: none !important;">
        <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
            $product = $cart_item['data'];
            $title = $product->get_title();
            $fullName = $product->name;
            $variantName = str_replace($title . ' - ', '', $fullName);
            $parentID = $cart_item['product_id'];
            $variantID = $cart_item['variation_id'];
            $price = round($product->price);
            $quantity = $cart_item['quantity'];
            
            $imageID = $product->image_id;
            $imageURL = wp_get_attachment_image_src($imageID);

            $productURL = get_permalink($parentID);
        ?>
            <div data-title="<?php echo $title; ?>" data-variant-name="<?php echo $variantName; ?>" data-variant-id="<?php echo $variantID; ?>" data-id="<?php echo $parentID; ?>" data-price="<?php echo $price; ?>" data-image="<?php echo $imageURL[0]; ?>" data-url="<?php echo $productURL; ?>" data-quantity="<?php echo $quantity; ?>"></div>
        <?php endforeach; ?>
    </div>
    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
        <div class="ssCheckout__form">
            <?php if ( $checkout->get_checkout_fields() ) : ?>
                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                <div class="col2-set" id="customer_details">
                    <div class="col-1">
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>

                    <div class="col-2">
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                </div>
                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            <?php endif; ?>
        </div>
        <div class="ssCheckout__sidebar">
            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                <h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
            <?php
                $taxes = WC()->cart->get_total_tax();
                foreach ( WC()->cart->get_coupons() as $code => $coupon ){
                   $couponCode = esc_attr( sanitize_title( $code ) );
                }
                global $woocommerce;
                $couponData = new WC_Coupon($couponCode);
            ?>
            <div id="order_review" class="woocommerce-checkout-review-order" data-order-total="<?php echo WC()->cart->cart_contents_total + $taxes ; ?>" data-coupon="<?php echo $couponCode; ?>" data-coupon-value="<?php echo $couponData->amount; ?>" data-coupon-type="<?php echo $couponData->discount_type; ?>">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </div>
    </form>
    <h1 class="testBtn">testuj</h1>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
