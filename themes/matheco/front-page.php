<?php get_header(); ?>
<?php  
  $hbanner = get_field('home_banner', HOMEID);
  if($hbanner):
    $bannerposter = !empty($hbanner['afbeelding'])? cbv_get_image_src( $hbanner['afbeelding'], 'hmbanner' ): '';
?>
<section class="hm-banner">
  <div class="hm-banner-cntlr clearfix">
    <div class="hm-banner-bdr clearfix"></div>
      <div class="hm-banner-img inline-bg" style="background-image: url('<?php echo $bannerposter; ?>');">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="hm-banner-inr">
                <div class="hm-banner-desc">
                  <?php 
                    if( !empty($hbanner['titel']) ) printf( '<h1 class="hm-banner-title fl-h1">%s</h1>', $hbanner['titel'] );
                    if( !empty($hbanner['beschrijving']) ) echo wpautop($hbanner['beschrijving']);
                    $hbknop = $hbanner['knop'];
                    if( is_array( $hbknop ) &&  !empty( $hbknop['url'] ) ){
                        printf('<a href="%s" target="%s">%s</a>', $hbknop['url'], $hbknop['target'], $hbknop['title']); 
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
<?php endif; ?>
<?php  
  $showhide_intro = get_field('showhide_intro', HOMEID);
  if($showhide_intro): 
    $intro = get_field('intro', HOMEID);
    if($intro):
?>
<section class="our-services">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="our-services-cntlr">
          <div class="section-entry-hdr sec-entry-hdr">
            <?php 
              if( !empty($intro['titel']) ) printf( '<h2 class="our-services-title fl-h2">%s</h2>', $intro['titel'] );
              if( !empty($intro['beschrijving']) ) echo wpautop( $intro['beschrijving'] );
            ?>
          </div>
          <?php 
          $dienstIDS = $intro['selecteer_diensten'];
          if( !empty($dienstIDS) ){
            $query = new WP_Query(array(
              'post_type' => 'diensten',
              'posts_per_page'=> 4,
              'post__in' => $dienstIDS,
              'orderby' => 'date',
              'order'=> 'asc',

            ));
                
          }else{
            $query = new WP_Query(array(
              'post_type' => 'diensten',
              'posts_per_page'=> 4,
              'orderby' => 'date',
              'order'=> 'desc',

            ));
          }
          if( $query->have_posts() ):
          ?>
          <div class="our-services-grid-cntlr">
            <div class="our-services-grid OurServicesSlider">
              <?php 
                  while($query->have_posts()): $query->the_post(); 
                  global $post;
                  $imgID = get_post_thumbnail_id(get_the_ID());
                  $imgtag = !empty($imgID)? cbv_get_image_tag($imgID): '';
              ?>
              <div class="our-services-item-wrap mHc">
                <div class="our-services-item-cnlr">
                  <div class="our-services-item">
                    <div class="our-srvcs-icon">
                      <i><?php echo $imgtag; ?></i>
                    </div>
                    <div class="our-services-hding mHc1">
                      <h4 class="our-services-item-title fl-h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>
                    <div class="our-services-item-desc">
                      <?php the_excerpt(); ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php endwhile; ?>
            </div>
          </div>
          <?php endif; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php  
  $showhide_qknops = get_field('showhide_qknops', HOMEID);
  if($showhide_qknops): 
    $producten = get_field('producten_knop', HOMEID);
    $login = get_field('login_knop', HOMEID); 
?>
<section class="hm-box-grd-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="hm-box-grd-sec-cntlr clearfix">
          <?php if($producten): ?>
          <div class="hm-box-grd-col hm-product-box-cntlr">
            <div>
              <div>
                <div class="hm-box-grd-icon">
                  <i><img src="<?php echo THEME_URI; ?>/assets/images/shopping-cart.svg" alt=""></i>
                </div>
                <?php 
                  if( !empty($producten['titel']) ) printf( '<h4 class="product-item-title fl-h4">%s</h4>', $producten['titel'] );
                  if( !empty($producten['beschrijving']) ) echo wpautop( $producten['beschrijving'] );
                  $prodknop = $producten['knop'];
                  if( is_array( $prodknop ) &&  !empty( $prodknop['url'] ) ){
                      printf('<a href="%s" target="%s">%s</a>', $prodknop['url'], $prodknop['target'], $prodknop['title']); 
                  }else{
                    printf('<a href="%s">PRODUCTEN</a>', get_permalink(get_option( 'woocommerce_shop_page_id' )));
                  }
                ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php if($login): ?>
          <div class="hm-box-grd-col hm-login-box-cntlr">
            <div>
              <div>
                <div class="hm-box-grd-icon">
                  <i><img src="<?php echo THEME_URI; ?>/assets/images/user-icon.svg" alt=""></i>
                </div>
                <?php 
                  if( !empty($login['titel']) ) printf( '<h4 class="product-item-title fl-h4">%s</h4>', $login['titel'] );
                  if( !empty($login['beschrijving']) ) echo wpautop( $login['beschrijving'] );
                  $logknop = $login['knop'];
                  if( is_array( $logknop ) &&  !empty( $logknop['url'] ) ){
                      printf('<div class="ftball-bcwrd-btn"><a href="%s" target="%s"><span>%s</span><i><svg class="external-icon" width="12" height="12" viewBox="0 0 12 12" fill="#fff">
                    <use xlink:href="#external-icon"></use></svg></i></a></div>', $logknop['url'], $logknop['target'], $logknop['title']); 
                  }else{
                    printf('<a class="login-icon" href="%s">
                      <span>LOGIN</span>
                      <i><svg class="external-icon" width="12" height="12" viewBox="0 0 12 12" fill="#fff">
                        <use xlink:href="#external-icon"></use></svg></i>
                    </a>', get_permalink(get_option( 'woocommerce_myaccount_page_id' )));
                  }
                ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php  
  $showhide_overons = get_field('showhide_overons', HOMEID);
  if($showhide_overons): 
    $overons = get_field('overonssec', HOMEID);
    if($overons):
      $overonsimg = !empty($overons['afbeelding'])? cbv_get_image_src( $overons['afbeelding'], 'hmoverons' ): ''; 
?>
<section class="football-backyard">
  <div class="football-backyard-cntlr">
    <div class="ftball-bcwrd-img inline-bg" style="background: url('<?php echo $overonsimg; ?>');">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="football-backyard-inr">
            <div class="ftball-bcwrd-desc-cntlr">
              <div class="ftball-bcwrd-desc">
                <?php 
                  if( !empty($overons['titel']) ) printf( '<h3 class="ftball-bcwrd-title fl-h3">%s</h3>', $overons['titel'] );
                  if( !empty($overons['beschrijving']) ) echo wpautop( $overons['beschrijving'] );
                  $overknop = $overons['knop'];
                  if( is_array( $overknop ) &&  !empty( $overknop['url'] ) ){
                      printf('<div class="ftball-bcwrd-btn"><a href="%s" target="%s">%s</a></div>', $overknop['url'], $overknop['target'], $overknop['title']); 
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php  
  $showhide_faq = get_field('showhide_faq', HOMEID);
  if($showhide_faq): 
    $faq = get_field('faqsec', HOMEID);
    if($faq):
?>
<section class="mtc-faq-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="mtc-faq-sec-inr">
          <div class="sec-entry-hdr hm-faq-entry-hdr">
          <?php 
            if( !empty($faq['titel']) ) printf( '<h2 class="mtc-faq-entry-title fl-h3">%s</h2>', $faq['titel'] );
            if( !empty($faq['beschrijving']) ) echo wpautop( $faq['beschrijving'] );
          ?>
          </div>
          <?php 
          $faqIDS = $faq['selecteer_faq'];
          if( !empty($faqIDS) ){
            $faqQuery = new WP_Query(array(
              'post_type' => 'faqs',
              'posts_per_page'=> 3,
              'post__in' => $faqIDS,
              'orderby' => 'date',
              'order'=> 'asc',

            ));
                
          }else{
            $faqQuery = new WP_Query(array(
              'post_type' => 'faqs',
              'posts_per_page'=> 3,
              'orderby' => 'date',
              'order'=> 'desc',

            ));
          }
          if( $faqQuery->have_posts() ):
          ?>
          <div class="mct-faq-accordion-ctlr clearfix">
            <ul class="reset-list clearfix">
              <?php 
                while($faqQuery->have_posts()): $faqQuery->the_post(); 
              ?>
              <li>
                <div class="mct-faq-accordion">
                  <h5 class="mct-faq-accordion-title fl-h5"><?php the_title(); ?><span></span></h5>
                  <div class="mct-faq-accordion-des">
                   <?php echo cbv_get_excerpt(); ?>
                  </div>
                </div>
              </li>
              <?php endwhile; ?>
            </ul>
          </div>
          <?php 
            $faqknop = $faq['knop'];
            if( is_array( $faqknop ) &&  !empty( $faqknop['url'] ) ){
              printf('<div class="mtc-faq-btn"><a href="%s" target="%s">%s</a></div>', $overknop['url'], $faqknop['target'], $faqknop['title']); 
            }else{
              printf('<div class="mtc-faq-btn"><a href="%s">ONTDEK MEER</a></div>', get_link_by_page_template('page-faq.')); 
            }
          ?>
          <?php endif; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>