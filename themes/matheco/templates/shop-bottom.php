  <?php 
  $btm_desc = '';
  if(is_shop()):
    $thisID = woocommerce_get_page_id('shop');
    $btm_desc = get_field('btm_beschrijving', $thisID); 
  ?>
  <?php 
  elseif(is_product_category()): 
    $term = get_queried_object();
    $btm_desc = get_field('btm_des', $term); 
  endif;
  if( isset($btm_desc) && ( !empty($btm_desc['text_2']) || !empty( $btm_desc['text_1'] ) ) ):
  ?>
<section class="two-grid-module">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="two-grid-module-cntlr">
          <div class="two-grid-module-wrap">
            <?php 
            if( empty($btm_desc['text_2']) ){
              if( !empty($btm_desc['text_1']) ) printf('<div class="one-grid-module-desc">%s</div>', wpautop( $btm_desc['text_1'] ));
            }else{
              if( !empty($btm_desc['text_1']) ) printf('<div class="two-grid-module-desc">%s</div>', wpautop( $btm_desc['text_1'] ));
              if( !empty($btm_desc['text_2']) ) printf('<div class="two-grid-module-desc">%s</div>', wpautop( $btm_desc['text_2'] ));
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>