<?php 
/*
Template Name: FAQ 
*/
get_header();
  $thisID = get_the_ID(); 
  get_template_part('templates/breadcrumbs');
  $intro = get_field('introsec', $thisID);
  $page_title = !empty($intro['titel']) ? $intro['titel'] : get_the_title();
  $terms = get_terms( 'cat_faq', array(
      'hide_empty' => false,
  ) );
?>
<section class="faq-overzicht-entry-hdr-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="faq-overzicht-entry-hdr-sec-inr">
          <div class="sec-entry-hdr hm-faq-entry-hdr">
            <?php 
              if( !empty($page_title) ) printf( '<h2 class="mtc-faq-entry-title fl-h3">%s</h2>', $page_title );
              if( !empty($intro['beschrijving']) ) echo wpautop( $intro['beschrijving'] );
            ?>
            <?php 
              if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            ?>
            <div class="faq-entry-hdr-btn">
              <ul class="reset-list">
                <?php 
                  $i = 1; foreach ( $terms as $term ) { 
                ?>
                  <?php 
                    if( $i == 1  ): 
                    $active_term_id = $term->term_id; 
                  ?>
                   <li class="active"><a href="<?php echo get_permalink($thisID); ?>"><?php echo $term->name; ?></a></li>
                  <?php else: ?>
                  <li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo $term->name; ?></a></li>
                  <?php endif; ?>
                <?php $i++; } ?>
              </ul>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$query = new WP_Query(array(
  'post_type' => 'faqs',
  'posts_per_page'=> PERPAGE_FAQ,
  'paged' => $paged,
  'orderby' => 'date',
  'order'=> 'desc',
  'tax_query' => array(
      array(
          'taxonomy' => 'cat_faq',
          'field'    => 'term_id',
          'terms'    => array( $active_term_id ),
      ),
  ),

));
if( $query->have_posts() ):
?>
<section class="faq-overzicht-sec">
  <div class="container-sm">
    <div class="row">
      <div class="col-md-12">
        <div class="faq-overzicht-sec-inr">
          <div class="mct-faq-accordion-ctlr clearfix">
            <ul class="reset-list">
              <?php 
                while($query->have_posts()): $query->the_post(); 
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
<?php 
if( $query->max_num_pages > 1 ): 
?>
<section class="fl-pagination-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="fl-pagination-ctlr">
          <?php
            $big = 999999999; // need an unlikely integer
            $query->query_vars['paged'] > 1 ? $current = $query->query_vars['paged'] : $current = 1;

            echo paginate_links( array(
              'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'type'      => 'list',
              'prev_next' => false,
              'prev_text' => __(''),
              'next_text' => __(''),
              'format'    => '?paged=%#%',
              'current'   => $current,
              'total'     => $query->max_num_pages
            ) );
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php else: ?>
<?php endif; wp_reset_postdata(); ?>
<?php get_footer(); ?>