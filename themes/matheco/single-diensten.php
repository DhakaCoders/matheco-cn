<?php 
get_header();
$thisID = get_the_ID(); 
get_template_part('templates/breadcrumbs');
?>
<section class="innerpage-con-wrap">
  <article class="default-page-con" id="dienstenDetails">
    <div class="block-955">
      <?php if(have_rows('inhoud')){  ?>
      <?php while ( have_rows('inhoud') ) : the_row();  ?>
        <?php 
        if( get_row_layout() == 'introductietekst' ){ 
        $title = get_sub_field('titel');
        $afbeelding = get_sub_field('afbeelding');
        ?>
        <div class="dfp-promo-module clearfix">
          <div class="dfp-promo-module-hdr">
            <div class="dfp-promo-icon">
              <i><img src="<?php echo THEME_URI; ?>/assets/images/dfp-promo-icon.svg"></i>
            </div>
            <?php 
              $page_title = !empty($title) ? $title : get_the_title();
              if( !empty($page_title) ) printf('<strong class="dfp-promo-module-title fl-h1">%s</strong>', $page_title);
            ?>
          </div>
          <?php 
            if( !empty($afbeelding) ){
              echo '<div class="dfp-plate-one-img-bx">'. cbv_get_image_tag($afbeelding).'</div>';
            }
          ?>
        </div>
        <?php 
        }elseif( get_row_layout() == 'teksteditor' ){ 
          $beschrijving = get_sub_field('fc_teksteditor');
        ?>
        <div class="dfp-text-module clearfix">
        <?php if( !empty( $beschrijving ) ) echo wpautop($beschrijving); ?>
        </div>
        <?php }elseif( get_row_layout() == 'galerij' ){ 
        $galleries = get_sub_field('fc_afbeeldingen');
        $lightbox = get_sub_field('lightbox');
        $kolom = get_sub_field('kolom');
        if( $galleries ): 
        ?>
        <div class="gallery-wrap clearfix">
        <div class="gallery gallery-columns-<?php echo $kolom; ?>">
        <?php foreach( $galleries as $image ): ?>
        <figure class="gallery-item">
          <div class="gallery-icon portrait">
            <?php 
              if( $lightbox ){
                $imgSrc = cbv_get_image_src( $image );
                echo "<a data-fancybox='gallery' href='".$imgSrc."'>";
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
        <?php endif; ?>
        <?php } ?> 
      <?php endwhile; ?>
      <?php } ?>
      <div class="dfp-back-btn">
        <a href="javascript:history.go(-1)">
          Terug naar overzicht
          <i>
            <svg class="dfp-back-btn-icon-svg" width="8" height="14" viewBox="0 0 8 14" fill="#707C88">
              <use xlink:href="#dfp-back-btn-icon-svg"></use>
            </svg>
          </i>
        </a>
      </div>
      
     
    </div>

  </article>
</section>

<div class="diensten-details-ctlr">
  <section class="mtc-faq-sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mtc-faq-sec-inr">
            <div class="sec-entry-hdr hm-faq-entry-hdr">
              <h2 class="mtc-faq-entry-title fl-h3">FAQ</h2>
            </div>
            <div class="mct-faq-accordion-ctlr clearfix">
              <ul class="reset-list clearfix">
                <li>
                  <div class="mct-faq-accordion">
                    <h5 class="mct-faq-accordion-title">Dolor augue ut tempus, non in quis diam aenean morbi.<span></span></h5>
                    <div class="mct-faq-accordion-des">
                      <p>Purus consequat sed egestas. Nunc purus molestie sed tincidunt tellus adipiscing. Vestibulum, eu purus sapien mi sit. Interdum porttitor at praesent auctor diam. Purus gravida nulla amet.</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="mct-faq-accordion">
                    <h5 class="mct-faq-accordion-title">Dolor augue ut tempus, non in quis diam aenean morbi.<span></span></h5>
                    <div class="mct-faq-accordion-des">
                      <p>Purus consequat sed egestas. Nunc purus molestie sed tincidunt tellus adipiscing. Vestibulum, eu purus sapien mi sit. Interdum porttitor at praesent auctor diam. Purus gravida nulla amet.</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="mct-faq-accordion">
                    <h5 class="mct-faq-accordion-title">Dolor augue ut tempus, non in quis diam aenean morbi.<span></span></h5>
                    <div class="mct-faq-accordion-des">
                      <p>Purus consequat sed egestas. Nunc purus molestie sed tincidunt tellus adipiscing. Vestibulum, eu purus sapien mi sit. Interdum porttitor at praesent auctor diam. Purus gravida nulla amet.</p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="mct-faq-accordion">
                    <h5 class="mct-faq-accordion-title">Dolor augue ut tempus, non in quis diam aenean morbi.<span></span></h5>
                    <div class="mct-faq-accordion-des">
                      <p>Purus consequat sed egestas. Nunc purus molestie sed tincidunt tellus adipiscing. Vestibulum, eu purus sapien mi sit. Interdum porttitor at praesent auctor diam. Purus gravida nulla amet.</p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>