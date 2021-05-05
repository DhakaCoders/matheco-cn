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
		        <h3 class="fl-h3 chkout-title"><?php esc_html_e( 'Bedankt', 'woocommerce' ); ?> <span><?php echo $order->get_billing_first_name(); ?></span> <?php esc_html_e( 'voor je bestelling', 'woocommerce' ); ?></h3>
		        <p><?php esc_html_e( 'Bestelnummer', 'woocommerce' ); ?>:<span>#<?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></p>
		        <h6 class="fl-h6 chkout-subtitle"><?php esc_html_e( 'Een bevestigingsmail  komt zodadelijk jouw richting uit.', 'woocommerce' ); ?></h6> 
		      </div>
		      <div class="chkout-service">
		        <div class="srv-fea-img">
		          <a href="#"><img src="<?php echo THEME_URI; ?>/assets/images/checkout-page-img.jpg" alt=""></a>
		        </div>
				<?php 
	            	$smedias = get_field('social_media', 'options'); 
	            	$thankyou = get_field('orderthankyou', 'options'); 
	            ?>
		        <div class="srv-cont">
		          <?php if($thankyou): ?>
		          <div class="chk-acc">
		            <div class="chk-acc-bg">
		              <div class="chk-acc-hdr">
		                <?php if( !empty($thankyou['sec_titel']) ) printf('<h4 class="fl-h4 chk-acc-title">%s</h4>', $thankyou['sec_titel']); ?>
		              </div>
		              <?php if($blok1 = $thankyou['blok_1']): ?>
		              <div class="chk-acc-tp">
		                <img src="<?php echo THEME_URI; ?>/assets/images/srv&cont.svg" alt="">
		                <?php 
	                      	if( !empty($blok1['titel']) ) printf('<h6 class="fl-h6 chk-tp-title">%s</h6>', $blok1['titel']); 
	                      	if( !empty($blok1['beschrijving']) ) echo wpautop($blok1['beschrijving']); 
                        ?>
		              </div>
		          	  <?php endif; ?>
		          	  <?php if($blok2 = $thankyou['blok_2']): ?>
		              <div class="chk-acc-btm">
		                <img src="<?php echo THEME_URI; ?>/assets/images/srv&cont-2.svg" alt="">
                        <?php 
	                      	if( !empty($blok2['titel']) ) printf('<h6 class="fl-h6 chk-tp-title">%s</h6>', $blok2['titel']); 
	                      	if( !empty($blok2['beschrijving']) ) echo wpautop($blok2['beschrijving']); 
	                    ?>
		              </div>
		              <?php endif; ?>
		            </div>  
		          </div>
		          <div class="chkout-scl">
		            <div class="chkout-scl-bg">
		              <div class="chkout-scl-hdr">
		              	<?php 
		              		if( $socialinfo =  $thankyou['socialinfo'] ):
		              		if( !empty($socialinfo['titel']) ) printf('<h4 class="fl-h4 chk-scl-title">%s</h4>', $socialinfo['titel']);
		              		if( !empty($socialinfo['beschrijving']) ) echo wpautop($socialinfo['beschrijving']);
		              		endif;
		              	?>
		              </div>  
		              <?php if(!empty($smedias)):  ?>
		              <div class="chk-scl-blg">
		              	<?php if( !empty($smedias['facebook_url']) ): ?>
		                <div class="chk-scl-itm fb">
		                  <a href="<?php echo $smedias['facebook_url']; ?>" class="overlay-link"></a>
		                  <i class="fab fa-facebook-f"></i>
		                  <span><?php esc_html_e( 'facebook', 'woocommerce' ); ?></span>
		                </div>
		            	<?php endif; ?>
		            	<?php if( !empty($smedias['instagram_url']) ): ?>
		                <div class="chk-scl-itm inst">
		                  <a href="<?php echo $smedias['instagram_url']; ?>" class="overlay-link"></a>
		                  <i class="fab fa-instagram"></i>
		                  <span><?php esc_html_e( 'Instagram', 'woocommerce' ); ?></span>
		                </div>
		                <?php endif; ?>
		                <?php if( !empty($smedias['twitter_url']) ): ?>
		                <div class="chk-scl-itm twitter">
		                  <a href="<?php echo $smedias['twitter_url']; ?>" class="overlay-link"></a>
		                  <i class="fab fa-twitter"></i>
		                  <span><?php esc_html_e( 'Twitter', 'woocommerce' ); ?></span>
		                </div>
		                <?php endif; ?>
		                <?php if( !empty($smedias['linkedin_url']) ): ?>
		                <div class="chk-scl-itm linkedin">
		                  <a href="<?php echo $smedias['linkedin_url']; ?>" class="overlay-link"></a>
		                  <i class="fab fa-linkedin-in"></i>
		                  <span><?php esc_html_e( 'Linkedin', 'woocommerce' ); ?></span>
		                </div>
		                <?php endif; ?>
		              </div>
		              <?php endif; ?>
		            </div>
		          </div>
		      	  <?php endif; ?>
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
