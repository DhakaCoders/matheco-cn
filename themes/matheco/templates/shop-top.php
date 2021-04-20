
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="product-page-col-cntlr clearfix">
        <div class="sec-entry-hdr product-entry-hdr">   
          <?php 
            if(is_shop()):
              $thisID = woocommerce_get_page_id('shop');
              $titel = get_field('titel', $thisID);
              $beschrijving = get_field('beschrijving', $thisID); 
              if( !empty($titel) ){
                printf('<h2 class="mtc-faq-entry-title fl-h3">%s</h2>', $titel);
              }else{
                printf('<h2 class="mtc-faq-entry-title fl-h3">%s</h2>', get_the_title());
              }
              if( !empty($beschrijving) ) echo wpautop( $beschrijving );
            ?>
            <?php 
            elseif(is_product_category()): 
              $term = get_queried_object();
              $beschrijving = get_field('beschrijving', $term);
              if( !empty($term->name) ) printf('<h2 class="mtc-faq-entry-title fl-h3">%s</h2>', $term->name);
              if( !empty($beschrijving) ) echo wpautop( $beschrijving );
            endif;
          ?>                         
        </div>
        <div class="secrh-select-cntlr">
          <div class="fl-secrh-cntlr">
            <div class="fl-secrh">
              <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="text" placeholder="Zoeken" name="s" value="<?php echo get_search_query(); ?>">
                <button>
                  <i><svg class="search-icon" width="21" height="21" viewBox="0 0 21 21" fill="#31304F">
                    <use xlink:href="#search-icon"></use> </svg></i>
                  </button>
                  <input type="hidden" name="post_type" value="product" />
                </form>
              </div>
          </div>
        </div>                                    
      </div>
    </div>
  </div>
</div>