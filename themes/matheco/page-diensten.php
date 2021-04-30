<?php 
/*
Template Name: Diensten 
*/
get_header();
$thisID = get_the_ID(); 
get_template_part('templates/breadcrumbs');
$intro = get_field('intro', $thisID);
$page_title = !empty($intro['titel']) ? $intro['titel'] : get_the_title();
?>
<section class="our-services services-overview">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="our-services-cntlr">
          <div class="section-entry-hdr sec-entry-hdr">
            <?php 
              if( !empty($page_title) ) printf( '<h2 class="our-services-title fl-h2">%s</h2>', $page_title );
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
          <div class="our-services-grid-cntlr so-grid-cntlr">
            <div class="our-services-grid services-overview-grid">
              <?php 
                  while($query->have_posts()): $query->the_post(); 
                  global $post;
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
          <?php endif; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php  
  $showhide_tekst = get_field('showhide_tekst', $thisID);
  if($showhide_tekst): 
    $tekst = get_field('tekstsec', $thisID);
    if($tekst):
?>
<section class="two-grid-module">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="two-grid-module-cntlr">
          <div class="two-grid-module-wrap">
            <div class="two-grid-module-desc">
             <?php if( !empty($tekst['tekst_1']) ) echo wpautop( $tekst['tekst_1'] ); ?>
            </div>
            <div class="two-grid-module-desc">
              <?php if( !empty($tekst['tekst_2']) ) echo wpautop( $tekst['tekst_2'] ); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>