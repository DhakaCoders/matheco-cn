<?php 
get_header(); 
$thisID = get_the_ID(); 
if( !is_cart() ) get_template_part('templates/breadcrumbs');
?>
<?php if( is_checkout() ){ get_template_part('templates/checkout', 'top'); } ?>
<section class="innerpage-con-wrap">
    <?php if(have_rows('inhoud')){  ?>
    <article class="default-page-con">
    <?php while ( have_rows('inhoud') ) : the_row();  ?>
    <?php 
    if( get_row_layout() == 'introductietekst' ){ 
    $title = get_sub_field('titel');
    $afbeelding = get_sub_field('afbeelding');
    ?>
    <div class="block-955">
      <div class="dfp-promo-module clearfix">
        <?php 
          if( !empty($title) ) printf('<div><strong class="dfp-promo-module-title fl-h1">%s</strong></div>', $title); 
          if( !empty($afbeelding) ){
            echo '<div class="dfp-plate-one-img-bx">'. cbv_get_image_tag($afbeelding).'</div>';
          }
        ?>
      </div>
    </div>
    <?php 
    }elseif( get_row_layout() == 'teksteditor' ){ 
    $beschrijving = get_sub_field('fc_teksteditor');
    ?>
    <div class="block-955">
      <div class="dfp-text-module clearfix">
        <?php if( !empty( $beschrijving ) ) echo wpautop($beschrijving); ?>
      </div>
    </div>
    <?php }elseif( get_row_layout() == 'afbeelding_tekst' ){ 
      $fc_afbeelding = get_sub_field('fc_afbeelding');
      $imgsrc = cbv_get_image_src($fc_afbeelding, 'dfpageg1');
      $fc_tekst = get_sub_field('fc_tekst');
      $positie_afbeelding = get_sub_field('positie_afbeelding');
      $imgposcls = ( $positie_afbeelding == 'right' ) ? ' fl-dft-rgtimg-lftdes' : '';
      ?>
      <div class="block-955">
      <div class="fl-dft-overflow-controller">
        <div class="fl-dft-lftimg-rgtdes clearfix<?php echo $imgposcls; ?>">
          <div class="fl-dft-lftimg-rgtdes-lft mHc" style="background-image: url(<?php echo $imgsrc; ?>);"></div>
          <div class="fl-dft-lftimg-rgtdes-rgt mHc">
            <?php echo wpautop($fc_tekst); ?>
          </div>
        </div>
      </div>
      </div>
    <?php }elseif( get_row_layout() == 'galerij' ){ 
    $galleries = get_sub_field('fc_afbeeldingen');
    $lightbox = get_sub_field('lightbox');
    $kolom = get_sub_field('kolom');
    if( $galleries ): 
    ?>
    <div class="block-955">
      <div class="gallery-wrap clearfix">
        <div class="gallery gallery-columns-<?php echo $kolom; ?>">
        <?php foreach( $galleries as $image ): ?>
        <figure class="gallery-item">
          <div class="gallery-icon portrait">
            <?php 
              if( $lightbox ){
                echo "<a data-fancybox='gallery' href='{$image['url']}'>";
                echo cbv_get_image_tag( $image, 'dfpageg1' );
                echo "</a>";
              }else{
                echo cbv_get_image_tag( $image, 'dfpageg1' );
              }
            ?>
          </div>
        </figure>
        <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php }elseif( get_row_layout() == 'poster' ){     
    $poster = get_sub_field('afbeeldingen');
    $video_url = get_sub_field('fc_videourl');
    $postersrc = !empty($poster)? cbv_get_image_src($poster, 'dft_poster'): '';
    ?> 
    <div class="block-955">
      <div class="ac-fancy-module" >
      <div class="fancy-img inline-bg" style="background-image: url(<?php echo $postersrc; ?>);"></div>
      <?php if( $video_url ): ?>
      <a class="overlay-link" data-fancybox href="<?php echo $video_url; ?>"></a>
      <div class="fancy-border"></div>
      <span class="ms-video-play-cntlr">
        <i><img src="<?php echo THEME_URI; ?>/assets/images/play-icon.svg" alt=""></i>
      </span>
      <?php endif; ?>
      </div>
    </div>

    <?php }elseif( get_row_layout() == 'quick_knops' ){ 
    $fc_producten = get_sub_field('fc_producten');
    $fc_login = get_sub_field('fc_login');
    ?>
    <div class="block-1440">
      <div class="dfp-box-grd-module">
        <div class="hm-box-grd-sec-cntlr clearfix">
          <?php if($fc_producten): ?>
          <div class="hm-box-grd-col hm-product-box-cntlr">
            <div>
              <div>
                <div class="hm-box-grd-icon">
                  <i><img src="<?php echo THEME_URI; ?>/assets/images/shopping-cart.svg" alt=""></i>
                </div>
                <?php 
                  if( !empty($fc_producten['fc_titel']) ) printf( '<h4 class="product-item-title fl-h4">%s</h4>', $fc_producten['fc_titel'] );
                  if( !empty($fc_producten['fc_tekst']) ) echo wpautop( $fc_producten['fc_tekst'] );
                  $prodknop = $fc_producten['knop'];
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
          <?php if($fc_login): ?>
          <div class="hm-box-grd-col hm-login-box-cntlr">
            <div>
              <div>
                <div class="hm-box-grd-icon">
                  <i><img src="<?php echo THEME_URI; ?>/assets/images/user-icon.svg" alt=""></i>
                </div>
                <?php 
                  if( !empty($fc_login['fc_titel']) ) printf( '<h4 class="product-item-title fl-h4">%s</h4>', $fc_login['fc_titel'] );
                  if( !empty($fc_login['fc_tekst']) ) echo wpautop( $fc_login['fc_tekst'] );
                  $logknop = $fc_login['knop'];
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
    <?php }elseif( get_row_layout() == 'cta' ){ 
    $fc_titel = get_sub_field('fc_titel');
    $fc_tekst = get_sub_field('fc_tekst');
    $fc_knop = get_sub_field('fc_knop');
    ?>
    <div class="block-955">
      <div class="dfp-cta-module clearfix">
        <div class="cta-ctlr">
        <?php 
          if( !empty($fc_titel) ) printf('<h4 class="cta-title fl-h4">%s</h4>', $fc_titel);
          if( !empty($fc_tekst) ) echo wpautop( $fc_tekst );

          if( is_array( $fc_knop ) &&  !empty( $fc_knop['url'] ) ){
            printf('<div class="cta-btn"><a class="fl-trnsprnt-btn" href="%s" target="%s">%s</a></div>', $fc_knop['url'], $fc_knop['target'], $fc_knop['title']); 
          }
        ?>
        </div>
      </div>
    </div>
    <?php }elseif( get_row_layout() == 'faq' ){
    $fc_titel = get_sub_field('fc_titel');
    $faqIDS = get_sub_field('fc_faq');
    if( !empty($faqIDS) ){
    $count = count($faqIDS);
    $faqQuery = new WP_Query(array(
    'post_type' => 'faqs',
    'posts_per_page'=> $count,
    'post__in' => $faqIDS,
    'orderby' => 'date',
    'order'=> 'asc',

    ));

    }else{
    $faqQuery = new WP_Query(array());
    }
    ?>
    <div class="block-955">
    <div class="dfp-faq-module">
      <div class="mct-faq-accordion-ctlr clearfix">
      <?php if( !empty($fc_titel) ) printf('<h4 class="mct-faq-title fl-h4">%s</h4>', $fc_titel); ?>
      <?php if( $faqQuery->have_posts() ): ?>
      <ul class="reset-list clearfix">
      <?php 
        while($faqQuery->have_posts()): $faqQuery->the_post(); 
      ?>
      <li>
        <div class="mct-faq-accordion">
          <h5 class="mct-faq-accordion-title"><?php the_title(); ?><span></span></h5>
          <div class="mct-faq-accordion-des">
            <?php the_excerpt(); ?>
          </div>
        </div>
      </li>
      <?php endwhile; ?>
      </ul>
      <?php endif; wp_reset_postdata(); ?>
      </div>
    </div>
    </div>
    <?php }elseif( get_row_layout() == 'diensten' ){
    $dienIDS = get_sub_field('fc_diensten');
    if( !empty($dienIDS) ){
    $diecount = count($dienIDS);
    $dieQuery = new WP_Query(array(
    'post_type' => 'diensten',
    'posts_per_page'=> $diecount,
    'post__in' => $dienIDS,
    'orderby' => 'date',
    'order'=> 'asc',

    ));

    }else{
    $dieQuery = new WP_Query(array());
    }
    if( $dieQuery->have_posts() ):
    ?>
    <div class="block-1440">
      <div class="dfp-our-service-module">
        <div class="our-services-grid-cntlr">
          <div class="our-services-grid OurServicesSlider">
            <?php 
              while($dieQuery->have_posts()): $dieQuery->the_post(); 
                $imgID = get_post_thumbnail_id(get_the_ID());
                $imgtag = !empty($imgID)? cbv_get_image_tag($imgID): '';
            ?>
            <div class="our-services-item-wrap">
              <div class="our-services-item-cnlr">
                <div class="our-services-item">
                  <div class="our-srvcs-icon">
                    <i><?php echo $imgtag; ?></i>
                  </div>
                  <div class="our-services-hding mHc">
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
      </div>
    </div>
    <?php endif; wp_reset_postdata(); ?>
    <?php }elseif( get_row_layout() == 'producten' ){
    $productIDS = get_sub_field('selecteer_producten');
    if( !empty($productIDS) ){
    $pcount = count($productIDS);
    $pQuery = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page'=> $pcount,
    'post__in' => $productIDS,
    'orderby' => 'date',
    'order'=> 'asc',

    ));

    }else{
    $pQuery = new WP_Query(array());
    }
    if( $pQuery->have_posts() ):
    ?>
    <div class="block-1440">
    <div class="hm-product-module hm-product-module hide-sm">
    <div class="hm-product-grds clearfix">
    <?php 
      while($pQuery->have_posts()): $pQuery->the_post(); 
      global $product, $woocommerce, $post;
      $label  = __('MEER INFO', 'woocommerce');
      $seller_flash = get_field('seller_flash', $product->get_id());
      $sh_desc = $product->get_short_description();
      $gridtag = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'pgrid' );
    ?>
      <div class="hmProdctGrdsSlideItme">
        <?php 
        echo '<div class="fl-product-grd mHc">
        <div class="fl-product-grd-inr">
          <div class="fl-pro-grd-img-cntlr mHc1">
            <a href="'.get_permalink( $product->get_id() ).'" class="overlay-link"></a>
            '.$gridtag.'
          </div>
          <div class="fl-pro-grd-des mHc2">
            <h4 class="fl-h5 fl-pro-grd-title"><a href="'.get_permalink( $product->get_id() ).'">'.get_the_title().'</a></h4>
            <div class="fl-pro-grd-price">'.$product->get_price_html().'</div>';
          if( !empty($sh_desc) ) echo wpautop($sh_desc);
          echo '</div>';  
          echo '<div class="fl-pro-grd-btn">
            <a class="fl-trnsprnt-btn prdt-btn" href="'.get_permalink( $product->get_id() ).'">MEER INFO</a>
          </div>
        </div>
        </div>';
        ?>
      </div>
    <?php endwhile; ?>
    </div>
    </div>
    </div>
    <?php endif; wp_reset_postdata(); ?>
    <?php }elseif( get_row_layout() == 'table' ){
    $fc_table = get_sub_field('fc_tafel');
    $fc_titel = !empty(get_sub_field('fc_titel'))?get_sub_field('fc_titel'):'';
    echo '<div class="block-955">';
    cbv_table($fc_table, $fc_titel);
    echo '</div>';
    ?>
    <?php }elseif( get_row_layout() == 'gap' ){
    $fc_gap = get_sub_field('fc_gap');
    ?>
    <div class="block-955">
    <div style="height:<?php echo $fc_gap; ?>px"></div>
    </div>
    <?php }elseif( get_row_layout() == 'horizontal_line' ){ ?>
    <div class="block-955">
    <hr>
    </div>
    <?php } ?>
    <?php endwhile; ?>
    </article>
    <?php }else{ ?>  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <article class="default-page-con">
            <?php if( is_account_page() && !is_user_logged_in()){ ?>
            <div class="page-title">
            <h1>Jouw account</h1>
            </div>
            <?php }elseif( !is_account_page() && !is_checkout()){ ?>
            <div class="page-title">
            <h1><?php the_title(); ?></h1>
            </div>
            <?php } ?>
            <?php the_content(); ?>
          </article>
        </div>
      </div>
    </div>
    <?php } ?>
</section>
<?php get_footer(); ?>