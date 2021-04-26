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

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :
		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
		<section class="checkout-sec">
		<div class="container">
		<div class="row">
		  <div class="col-md-12">
		    <div class="checkout-cntrl">
		      <div class="checkout-hdr">
		        <div class="chkout-logo">
		          <img src="<?php echo THEME_URI; ?>/assets/images/checkout-logo.png" alt="">
		        </div>
		        <h3 class="fl-h3 chkout-title">Bedankt <span><?php echo $order->get_billing_first_name(); ?></span> voor je bestelling</h3>
		        <p>Bestelnummer:<span>#<?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></p>
		        <h6 class="fl-h6 chkout-subtitle">Een bevestigingsmail  komt zodadelijk jouw richting uit.</h6> 
		      </div>
		      <div class="chkout-service">
		        <div class="srv-fea-img">
		          <a href="#"><img src="<?php echo THEME_URI; ?>/assets/images/checkout-page-img.jpg" alt=""></a>
		        </div>
		        <div class="srv-cont">
		          <div class="chk-acc">
		            <div class="chk-acc-bg">
		              <div class="chk-acc-hdr">
		                <h4 class="fl-h4 chk-acc-title">Service & contact</h4>
		              </div>
		              <div class="chk-acc-tp">
		                <img src="<?php echo THEME_URI; ?>/assets/images/srv&cont.svg" alt="">                    
		                <h6 class="fl-h6 chk-tp-title">Snel regelen in je account</h6>
		                <p>Volg je bestelling, betaal<br> facturen of retourneer een<br> artikel.</p>
		              </div>
		              <div class="chk-acc-btm">
		                <img src="<?php echo THEME_URI; ?>/assets/images/srv&cont-2.svg" alt="">
		                <h6 class="fl-h6 chk-tp-title">Heb je ons nodig?</h6>
		                <p>We helpen je graag. Onze<br> klantenservice is dag en nacht<br> open.</p>
		              </div>
		            </div>  
		          </div>
		          <div class="chkout-scl">
		            <div class="chkout-scl-bg">
		              <div class="chkout-scl-hdr">
		                <h4 class="fl-h4 chk-scl-title">social media</h4>
		                <p>Wil je ons volgen?</p>
		              </div>  
		              <div class="chk-scl-blg">
		                <div class="chk-scl-itm fb">
		                  <a href="#" class="overlay-link"></a>
		                  <i class="fab fa-facebook-f"></i>
		                  <span>facebook</span>
		                </div>
		                <div class="chk-scl-itm inst">
		                  <a href="#" class="overlay-link"></a>
		                  <i class="fab fa-instagram"></i>
		                  <span>Instagram</span>
		                </div>
		                <div class="chk-scl-itm twitter">
		                  <a href="#" class="overlay-link"></a>
		                  <i class="fab fa-twitter"></i>
		                  <span>Twitter</span>
		                </div>
		                <div class="chk-scl-itm linkedin">
		                  <a href="#" class="overlay-link"></a>
		                  <i class="fab fa-linkedin-in"></i>
		                  <span>Linkedin</span>
		                </div>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
		</div>
		</section>


		<?php endif; ?>

	<?php else : ?>

	<?php endif; ?>

</div>
