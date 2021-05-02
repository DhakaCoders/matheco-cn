<?php 
$thisID = get_the_ID();
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
<section class="faq-detials-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="faq-detials-sec-inr">
          <div class="sec-entry-hdr hm-faq-entry-hdr">
            <?php if( !empty($faq['titel']) ) 
              printf('<h2 class="mtc-faq-entry-title fl-h3">%s</h2>', $faq['titel']); 
            else
              printf('<h2 class="mtc-faq-entry-title fl-h3">%s</h2>', 'Gerelateerde FAQ'); 
            ?>
          </div>
          <div class="mct-faq-accordion-ctlr clearfix">
            <ul class="reset-list">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; wp_reset_postdata(); ?>
<?php endif; ?>