<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

?>
<p class="form-row form-row-first coupon-full-width">
	<input type="text" name="coupon_code_enter" class="input-text" placeholder="<?php esc_attr_e( 'Heb je een kortingscode?', 'woocommerce' ); ?>" id="coupon_code_enter" value="" />
</p>

<p class="form-row form-row-last">
	<button type="button" class="button" name="apply_coupon_code" id="apply_coupon_code" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
</p>

<div class="clear"></div>
