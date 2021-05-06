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
              if( !empty($page_title) ) printf('<strong class="dfp-promo-module-title fl-h3">%s</strong>', $page_title);
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
          <?php _e('Terug naar overzicht', 'matheco'); ?>
          <i>
            <svg class="dfp-back-btn-icon-svg" width="14" height="14" viewBox="0 0 14 14" fill="#707C88">
              <use xlink:href="#dfp-back-btn-icon-svg"></use>
            </svg>
          </i>
        </a>
      </div>
      
     
    </div>

  </article>
</section>
<?php 
$faq = get_field('faqsec', $thisID);
if($faq):
  $faqIDs = $faq['selecteer_faq'];
  if( !empty($faqIDs) ){
  $count = count($faqIDs);
  $faqQuery = new WP_Query(array(
  'post_type' => 'faqs',
  'posts_per_page'=> $count,
  'post__in' => $faqIDs,
  'orderby' => 'date',
  'order'=> 'asc',

  ));

  }else{
  $faqQuery = new WP_Query(array());
  }
?>
<?php if( $faqQuery->have_posts() ): ?>
<div class="diensten-details-ctlr">
  <section class="mtc-faq-sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mtc-faq-sec-inr">
            <div class="sec-entry-hdr hm-faq-entry-hdr">
              <?php if( !empty($faq['titel']) ) 
                printf('<h2 class="mtc-faq-entry-title fl-h3">%s</h2>', $faq['titel']); 
              else
                printf('<h2 class="mtc-faq-entry-title fl-h3">%s</h2>', __('FAQ', 'matheco') ); 
              ?>
            </div>
            <div class="mct-faq-accordion-ctlr clearfix">
              <ul class="reset-list clearfix">
                <?php 
                  while($faqQuery->have_posts()): $faqQuery->the_post(); 
                ?>
                <li>
                  <div class="mct-faq-accordion">
                    <h5 class="mct-faq-accordion-title"><?php the_title(); ?><span></span></h5>
                    <div class="mct-faq-accordion-des">
                      <?php echo cbv_get_excerpt(); ?>
                    </div>
                  </div>
                </li>
                <?php endwhile; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php endif; wp_reset_postdata(); ?>
<?php endif; ?>
<?php get_footer(); ?>