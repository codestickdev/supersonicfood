<div id="cartModal" class="cartModal">
    <div class="cartModal__wrap">
        <h2 class="cartModal__title"><?php _e('My cart', 'codestick'); ?></h2>
        <?php
        global $woocommerce;
        $count = $woocommerce->cart->cart_contents_count;
        if ($count == 0) : ?>
            <div class="cartModal__emptycart">
                <p><?php _e('Your cart is empty', 'codestick'); ?></p>
                <a href="<?php echo home_url(); ?>" class="btn"><span><?php _e('Go to shop', 'codestick'); ?></span></a>
            </div>
        <?php else : ?>

            <div class="cartModal__products">
                <div class="cartModal__productsList">
                    <?php
                    global $woocommerce;
                    $items = WC()->cart->get_cart();
                    $cart_items = WC()->cart->get_cart();
                    $productQuantityEN = 0;
                    $productQuantityPL = 0;

                    foreach ($cart_items as $cart_item => $item){
                        $productDataID = $item['product_id'];
                        $getDataQuantity = $item['quantity'];

                        if($productDataID == 2476){
                            $productQuantityEN += $getDataQuantity;
                        }
                        if($productDataID == 103){
                            $productQuantityPL += $getDataQuantity;
                        }
                    }

                    foreach ($items as $item => $values) :
                        $_product =  wc_get_product($values['data']->get_id());
                        $_productData = $values['data'];
                        $_removeURL = wc_get_cart_remove_url($item);
                        $productID = $values['product_id'];
                        $getQuantity = $values['quantity'];
                        $attributes = $_product->get_attributes();
                        $price = WC()->cart->get_product_price($_productData);
                    ?>
                        <div class="cartModal__product" id="<?php echo $productID; ?>" quantity="<?php if($productQuantityEN > 0 ){ echo $productQuantityEN; }else{ echo $productQuantityPL;}; ?>">
                            <div class="cartModal__thumb">
                                <?php $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); echo $thumbnail; ?>
                            </div>
                            <div class="cartModal__content">
                                <p class="title"><?php echo $_product->get_title() ?></p>
                                <p class="variant">
                                    <?php if ($attributes) : ?>
                                        <?php foreach ($attributes as $key => $value) {
                                            $valuename = str_replace('-', ' ', $value);
                                            if ($lang == 'en-US') {
                                                echo 'Flavour: <span>' . ucfirst($valuename) . '</span>';
                                            } else {
                                                echo 'Smak: <span>' . ucfirst($valuename) . '</span>';
                                            };
                                        } ?>
                                    <?php endif; ?>
                                </p>
                                <?php if ($lang == 'en-US') : ?>
                                    <p class="quantity">Quantity: <span><?php echo $getQuantity; ?></span></p>
                                    <p class="price">Price: <?php echo $price; ?></p>
                                    <?php if($productID !== 2476 && $productID !== 2488 && $productID !== 2474): ?>
                                        <p class="delete"><a href="<?php echo $_removeURL . '&cartModal=success'; ?>">Remove this product</a></p>
                                    <?php endif; ?>
                                    <?php if($productID == 2476): ?>
                                        <?php if($productQuantityEN > 1): ?>
                                            <?php if($getQuantity > 1): ?>
                                                <p class="delete"><a href="<?php echo $_removeURL . '&cartModal=success'; ?>">Remove this product</a></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <p class="quantity">Ilość: <span><?php echo $getQuantity; ?></span></p>
                                    <p class="price">Koszt: <?php echo $price; ?></p>
                                    <?php if($productID !== 103 && $productID !== 1215 && $productID !== 1213): ?>
                                        <p class="delete"><a href="<?php echo $_removeURL . '&cartModal=success'; ?>">Usuń produkt</a></p>
                                    <?php endif; ?>
                                    <?php if($productID == 103): ?>
                                        <?php if($productQuantityPL > 1): ?>
                                            <?php if($getQuantity > 1): ?>
                                                <p class="delete"><a href="<?php echo $_removeURL . '&cartModal=success'; ?>">Usuń produkt</a></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="cartModal__summary">
                    <table>
                    <?php
                    global $woocommerce;
                    $country = $woocommerce->customer->get_shipping_country();
                    $price = WC()->cart->total;
                    if (!is_user_logged_in()) : ?>
                        <tr>
                            <td><?php _e('Shipping', 'codestick'); ?></td>
                            <td style="font-size: 12px; line-height: 14px;"><?php _e('Shipping costs will be calculated when ordering.', 'codestick'); ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td><?php _e('Shipping', 'codestick'); ?></td>
                            <?php if ($price >= 180 && $country == 'PL'): ?>
                                <td><?php _e('Free!', 'codestick'); ?></td>
                            <?php else: ?>
                                <td><?php _e('From 5€', 'codestick'); ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                        <tr>
                            <td>Total</td>
                            <td><?php echo wc_price(WC()->cart->total); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="cartModal__actions">
                    <a href="<?php echo wc_get_cart_url(); ?>" class="btn"><span><?php _e('Proceed to checkout', 'codestick'); ?></span></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>