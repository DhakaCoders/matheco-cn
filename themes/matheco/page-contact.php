<?php 
/*
Template Name: Contact 
*/
get_header();
$thisID = get_the_ID(); 
get_template_part('templates/breadcrumbs');
  $intro = get_field('introsec', $thisID);
  $page_title = !empty($intro['titel']) ? $intro['titel'] : get_the_title();
?>
<section class="contact-info-sec-wrp">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="contact-info-wrp">
          <div class="contact-info-dsc">
            <?php 
              if( !empty($page_title) ) printf( '<h1 class="contact-info-dsc-title fl-h3">%s</h1>', $page_title );
              if( !empty($intro['beschrijving']) ) echo wpautop( $intro['beschrijving'] );
            ?>
          </div>
          <?php 
            $contactinfo = $intro['contact_info'];
            if( $contactinfo ):
          ?>
          <div class="contact-info-box-wrp">
            <ul class="clearfix reset-list">
              <?php foreach( $contactinfo as $cinfo ): ?>
              <li>
                <div class="contact-info-box-inr mHc">
                  <div class="contact-info-box-dsc">
                    <i><?php if( !empty($cinfo['icon']) ) echo cbv_get_image_tag($cinfo['icon']); ?></i>
                    <?php 
                      if( !empty($cinfo['titel']) ) printf( '<h4 class="fl-h4 mHc1">%s</h4>', $cinfo['titel'] );
                      if( !empty($cinfo['telefoon']) ) printf( '<a href="tel:%s">%s</a>', phone_preg($cinfo['telefoon']), $cinfo['telefoon'] );
                      if( !empty($cinfo['emailadres']) ) printf( '<a href="mailto:%s">%s</a>', $cinfo['emailadres'], $cinfo['emailadres'] );
                    ?>
                  </div>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php endif; ?>
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
      <?php
      $form = get_field('formsec', $thisID); 
      if(!empty($form['shortcode'])): 
      ?>
      <div class="contact-form-lft">
        <div class="contact-er-msg">
          <span>
            <i><svg class="error-icon-svg" width="18" height="18" viewBox="0 0 18 18" fill="#ffffff">
            <use xlink:href="#error-icon-svg"></use> </svg></i>
            Oh snap! Het formulier lijkt niet correct!</span>
        </div>
        <div class="contact-form-wrp clearfix">
          <div class="wpforms-container">
              <?php echo do_shortcode( $form['shortcode'] ); ?>
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
        $continfo = $form['contact_info'];
      ?>
      <div class="contact-form-rgt">
        <div class="contact-form-info-cntlr">
          <div class="contact-form-info">
            <i><img src="<?php echo THEME_URI; ?>/assets/images/contact-form-info-phn.svg"></i>
            <h4 class="fl-h4 contact-form-info-title"><?php _e( 'Contact Informatie', THEME_NAME ); ?></h4>
            <ul class="reset-list clearfix">
              <?php 
                if( !empty($continfo['adres']) ) {
                  $contmaplink = !empty($continfo['url'])?$continfo['url']: 'javascript:void()';
                  printf('<li><a href="%s" target="_blank">%s</a></li>', $contmaplink, $continfo['adres']);
                }
                else{
                  if( !empty($address) ) printf('<li><a href="%s" target="_blank">%s</a></li>', $gmaplink, $address);
                }
                if(!empty($continfo['telefoon'])){
                  printf('<li><a href="tel:%s">%s</a>', phone_preg($continfo['telefoon']),  $continfo['telefoon']);
                }else{
                  if( !empty($telefoon) ) printf('<li><a href="tel:%s">%s</a>', phone_preg($telefoon),  $telefoon);
                } 
                if(!empty($continfo['emailadres'])){
                  printf('<li><a href="mailto:%s">%s</a></li>', $continfo['emailadres'], $continfo['emailadres']);
                }else{
                  if( !empty($email) ) printf('<li><a href="mailto:%s">%s</a></li>', $email, $email);
                }
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