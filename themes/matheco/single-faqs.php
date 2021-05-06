<?php 
get_header();
$thisID = get_the_ID(); 
get_template_part('templates/breadcrumbs');
?>
<section class="xs-faq-details show-sm">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="xs-faq-details-inr">
          <div class="dfp-back-btn">
            <a href="javascript:history.go(-1)">
              <?php _e('Terug naar overzicht', 'matheco'); ?>
              <i>
                <svg class="dfp-back-btn-icon-svg" width="8" height="14" viewBox="0 0 8 14" fill="#707C88">
                  <use xlink:href="#dfp-back-btn-icon-svg"></use>
                </svg>
              </i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 
  $imgID = get_post_thumbnail_id(get_the_ID());
  $imgtag = !empty($imgID)? cbv_get_image_tag($imgID): '';

  $categories = get_the_terms( $thisID, 'cat_faq' );
  $term_name = $termid = $termlink = '';
  if ( ! empty( $categories ) ) {
      foreach( $categories as $category ) {
         $term_name = $category->name; 
         $termlink = get_term_link($category);
         $termid = $category->term_id;
      }
  }
?>

<section class="innerpage-con-wrap">
  <article class="default-page-con" id="faq-details">
    <div class="block-955">
      <div class="dfp-promo-module clearfix">
        <div>
          <strong class="dfp-promo-module-title fl-h3"><?php the_title(); ?></strong>
          <?php if( !empty($term_name) ) printf('<a href="%s">%s</a>', $termlink, $term_name); ?>
        </div>
        <?php if( !empty($imgtag) ): ?>
        <div class="dfp-plate-one-img-bx">
          <?php echo $imgtag; ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="dfp-text-module clearfix">
        <?php the_content(); ?>
      </div>

      <div class="dfp-back-btn-module">
        <div class="dfp-back-btn">
          <a href="javascript:history.go(-1)">
            <?php _e('Terug naar overzicht', 'matheco'); ?>
            <i>
              <svg class="dfp-back-btn-icon-svg" width="8" height="14" viewBox="0 0 8 14" fill="#707C88">
                <use xlink:href="#dfp-back-btn-icon-svg"></use>
              </svg>
            </i>
          </a>
        </div>
        <div class="dfp-social-media">
          <span><?php _e('Delen op', 'matheco'); ?>:</span>
          <ul class="reset-list">
            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>&text=<?php the_title(); ?>"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>"><i class="fab fa-linkedin-in"></i></a></li>
          </ul>
        </div>
      </div>


     
    </div>
    
    </div>
  </article>
</section>

<?php 
if( !empty($termid) ): 
$query = new WP_Query(array(
  'post_type' => 'faqs',
  'posts_per_page'=> 4,
  'orderby' => 'rand',
  'post__not_in' => array($thisID),
  'tax_query' => array(
      array(
          'taxonomy' => 'cat_faq',
          'field'    => 'term_id',
          'terms'    => array( $termid ),
      ),
  ),

));
if( $query->have_posts() ):
?>

<section class="faq-detials-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="faq-detials-sec-inr">
          <div class="sec-entry-hdr hm-faq-entry-hdr">
            <h2 class="mtc-faq-entry-title fl-h3"><?php _e('Meer vragen?', 'matheco'); ?></h2>
          </div>
          <div class="mct-faq-accordion-ctlr clearfix">
            <ul class="reset-list">
              <?php while($query->have_posts()): $query->the_post(); ?>
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
<?php endif; wp_reset_postdata(); ?>
<?php endif; ?>
<?php get_footer(); ?>