<?php 
  $shopID = get_option( 'woocommerce_shop_page_id' ); 
  $getcta = get_field('cta', $shopID);
  if( $getcta ):
?>
<section class="contacteer-ons">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="contacteer-bg">
          <div class="contacteer-inner">
            <i><img src="<?php echo THEME_URI; ?>/assets/images/contacteer-ons.png" alt=""></i>
            <?php 
              if( !empty($getcta['titel']) ) printf( '<h4 class="fl-h4 cont-ons-title">%s</h4>', $getcta['titel'] );
              if( !empty($getcta['beschrijving']) ) echo wpautop( $getcta['beschrijving'] );
              $knop = $getcta['knop'];
              if( is_array( $knop ) &&  !empty( $knop['url'] ) ){
                  printf('<a class="prdten-btn" href="%s" target="%s">%s</a>', $knop['url'], $knop['target'], $knop['title']);
              }
            ?>
          </div>
        </div>  
      </div>
    </div>
  </div>
</section>
<?php endif; ?>