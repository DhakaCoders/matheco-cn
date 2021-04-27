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
            <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){ ?>
            <div class="faq-entry-hdr-btn">
              <ul class="reset-list">
                <?php foreach ( $terms as $term ) { ?>
                <li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo $term->name; ?></a></li>
                <?php } ?>
              </ul>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="faq-overzicht-sec">
  <div class="container-sm">
    <div class="row">
      <div class="col-md-12">
        <div class="faq-overzicht-sec-inr">
          <div class="mct-faq-accordion-ctlr clearfix">
            <ul class="reset-list">
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
                  <h5 class="mct-faq-accordion-title">Dolor augue ut tempus, non in quis diam aenean morbi<span></span></h5>
                  <div class="mct-faq-accordion-des">
                    <p>Purus consequat sed egestas. Nunc purus molestie sed tincidunt tellus adipiscing. Vestibulum, eu purus sapien mi sit. Interdum porttitor at praesent auctor diam. Purus gravida nulla amet.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="mct-faq-accordion">
                  <h5 class="mct-faq-accordion-title">Dolor augue ut tempus, non in quis diam aenean morbi<span></span></h5>
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

<section class="fl-pagination-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="fl-pagination-ctlr">
          <ul class="reset-list page-numbers">
            <li><span class="page-numbers current">1</span></li>
            <li><a class="page-numbers" href="#">2</a></li>
            <li><a class="page-numbers" href="#">3</a></li>
            <li><a class="page-numbers" href="#">4</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>