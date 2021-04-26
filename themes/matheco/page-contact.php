<?php 
/*
Template Name: Contact 
*/
get_header();
$thisID = get_the_ID(); 
get_template_part('templates/breadcrumbs');
  $intro = get_field('formsec', $thisID);
  $page_title = !empty($intro['titel']) ? $intro['titel'] : get_the_title();
?>
<section class="contact-info-sec-wrp">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="contact-info-wrp">
          <div class="contact-info-dsc">
            <?php 
              if( !empty($page_title) ) printf( '<h1 class="contact-info-dsc-title fl-h1">%s</h1>', $page_title );
              if( !empty($intro['beschrijving']) ) echo wpautop( $intro['beschrijving'] );
            ?>
          </div>
          <div class="contact-info-box-wrp">
            <ul class="clearfix reset-list">
              <li>
                <div class="contact-info-box-inr mHc">
                  <div class="contact-info-box-dsc">
                    <i><img src="<?php echo THEME_URI; ?>/assets/images/phone-book-icon.svg"></i>
                    <h4 class="fl-h4 mHc1">Sales</h4>
                    <a href="tel:02 454 58 51">02 454 58 51</a>
                    <a href="mailto:info@matheco-cooling.be">info@matheco-cooling.be</a>
                  </div>
                </div>
              </li>
              <li>
                <div class="contact-info-box-inr mHc">
                  <div class="contact-info-box-dsc">
                    <i><img src="<?php echo THEME_URI; ?>/assets/images/phone-book-icon.svg"></i>
                    <h4 class="fl-h4 mHc1">Diesnt na verkoop</h4>
                    <a href="tel:02 454 58 51">02 454 58 51</a>
                    <a href="mailto:info@matheco-cooling.be">info@matheco-cooling.be</a>
                  </div>
                </div>
              </li>
              <li>
                <div class="contact-info-box-inr mHc">
                  <div class="contact-info-box-dsc">
                    <i><img src="<?php echo THEME_URI; ?>/assets/images/phone-book-icon.svg"></i>
                    <h4 class="fl-h4 mHc1">Secretariaat</h4>
                    <a href="tel:02 454 58 51">02 454 58 51</a>
                    <a href="mailto:info@matheco-cooling.be">info@matheco-cooling.be</a>
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

<section class="contact-form-sec-wrp">
 <div class="container">
  <div class="row">
    <div class="col-md-12">
    <div class="contact-form-block clearfix">
      <?php if(!empty($intro['shortcode'])): ?>
      <div class="contact-form-lft">
        <div class="contact-er-msg">
          <span>
            <i><svg class="error-icon-svg" width="18" height="18" viewBox="0 0 18 18" fill="#ffffff">
            <use xlink:href="#error-icon-svg"></use> </svg></i>
            Oh snap! Het formulier lijkt niet correct!</span>
        </div>
        <div class="contact-form-wrp clearfix">
          <div class="wpforms-container">
              <?php echo do_shortcode( $intro['shortcode'] ); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php 
        $address = get_field('address', 'options');
        $gmurl = get_field('url', 'options');
        $telefoon = get_field('telefoon', 'options');
        $email = get_field('emailadres', 'options');
        $gmaplink = !empty($gmurl)?$gmurl: 'javascript:void()';
        $bwt = get_field('btw', 'options');
      ?>
      <div class="contact-form-rgt">
        <div class="contact-form-info-cntlr">
          <div class="contact-form-info">
            <i><img src="<?php echo THEME_URI; ?>/assets/images/contact-form-info-phn.svg"></i>
            <h4 class="fl-h4 contact-form-info-title"><?php _e( 'Contact Informatie', THEME_NAME ); ?></h4>
            <ul class="reset-list clearfix">
              <?php 
                if( !empty($address) ) printf('<li><a href="%s" target="_blank">%s</a></li>', $gmaplink, $address);
                if( !empty($telefoon) ) printf('<li><a href="tel:%s">%s</a>', phone_preg($telefoon),  $telefoon);  
                if( !empty($email) ) printf('<li><a href="mailto:%s">%s</a></li>', $email, $email); 
                if( !empty($bwt) ) printf('<li><span>BTW: %s</span></li>', $bwt);
              ?>
              </ul>
            </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<?php  
  $gmap = get_field('gmap', $thisID);
  if($gmap):
?>
<section class="contact-map-sec-wrp show-sm">
  <?php if( !empty($gmap['map_embedded']) ): ?>
  <div class="contact-google-map">
   <?php echo $gmap['map_embedded']; ?>
  </div>
  <?php endif; ?>
</section>
<?php endif; ?>
<?php get_footer(); ?>