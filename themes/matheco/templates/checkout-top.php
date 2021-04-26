<?php $cURL = wc_get_cart_url(); ?>
<?php if( is_checkout() && strpos($_SERVER['REQUEST_URI'], "order-received") !== false ): ?>
<section class="checkout-top-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="checkout-page-title clearfix">
				<div class="checkoutpt-left">
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="checkoutpt-right">
					<div class="progressbar-crtl">
					    <div class="n-checkout-progress-wrap">
					      <div class="checkout-progress-cntlr">
					        <div class="checkout-progress">
					          <div class="checkout-progress-bar">
					            <span class="ckour-pro-bar-active ckour-pro-bar-1"></span>
					            <span class="ckour-pro-bar-active ckour-pro-bar-2"></span>
					            <span class="ckour-pro-bar-active ckour-pro-bar-3 active"></span>
					          </div>
					          <div class="chckout-prgrs-col chckout-prgrs-col-1 ">
					            <strong class="chckout-prgrs-number">1</strong> 
					            <h6 class="chckout-prgrs-title">Winkelmandje</h6>
					          </div>

					          <div class="chckout-prgrs-col chckout-prgrs-col-2">
					            <strong class="chckout-prgrs-number">2</strong> 
					            <h6 class="chckout-prgrs-title">Klantgegevens <br>
					            en Betaling</h6>
					          </div>

					          <div class="chckout-prgrs-col chckout-prgrs-col-3 active">
					            <strong class="chckout-prgrs-number">3</strong> 
					            <h6 class="chckout-prgrs-title">Bevestiging</h6>
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
<?php else: ?>
<section class="checkout-backbtn-sec show-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="back-to-dashboard-btn-cntlr"><a class="backshop-cart" href="<?php echo $cURL; ?>">Terug naar winkelmandje</a></div>
			</div>	
		</div>
	</div>
</section>
<section class="checkout-top-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="checkout-page-title clearfix">
				<div class="checkoutpt-left">
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="checkoutpt-right">
					<div class="checkout-page-bar-crtl">
						<div class="progressbar-crtl">
							<div class="n-checkout-progress-wrap">
							  <div class="checkout-progress-cntlr">
							    <div class="checkout-progress">
							      <div class="checkout-progress-bar">
							        <span class="ckour-pro-bar-active ckour-pro-bar-1"></span>
							        <span class="ckour-pro-bar-active ckour-pro-bar-2 active"></span>
							        <span class="ckour-pro-bar-active ckour-pro-bar-3"></span>
							      </div>
							      <div class="chckout-prgrs-col chckout-prgrs-col-1 ">
							        <strong class="chckout-prgrs-number">1</strong> 
							        <h6 class="chckout-prgrs-title">Winkelmandje</h6>
							      </div>

							      <div class="chckout-prgrs-col chckout-prgrs-col-2 active">
							        <strong class="chckout-prgrs-number">2</strong> 
							        <h6 class="chckout-prgrs-title">Klantgegevens <br>
							        en Betaling</h6>
							      </div>

							      <div class="chckout-prgrs-col chckout-prgrs-col-3">
							        <strong class="chckout-prgrs-number">3</strong> 
							        <h6 class="chckout-prgrs-title">Bevestiging</h6>
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
	</div>
</section>
<?php endif; ?>