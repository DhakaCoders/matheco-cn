<?php 
  $logoObj = get_field('ftlogo', 'options');
  if( is_array($logoObj) ){
    $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
  }else{
    $logo_tag = '';
  }
  $address = get_field('address', 'options');
  $gmurl = get_field('url', 'options');
  $telefoon = get_field('telefoon', 'options');
  $email = get_field('emailadres', 'options');
  $bwt = get_field('btw', 'options');
  $gmaplink = !empty($gmurl)?$gmurl: 'javascript:void()';
  $smedias = get_field('social_media', 'options');
  $copyright_text = get_field('copyright_text', 'options');
?>

<div class="to-top-btn-cntlr">
  <div class="to-top-btn">
    <i>
      <svg class="to-top-btn-arrow-icon" width="14" height="9" viewBox="0 0 14 9" fill="#fff">
      <use xlink:href="#to-top-btn-arrow-icon"></use> </svg>
    </i>
  </div>
</div>
<footer class="footer">
  <div class="ftr-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="ftr-top-inr clearfix">
              <?php if( !empty($logo_tag) ): ?>
              <div class="ftr-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                  <?php echo $logo_tag; ?>
                </a>
              </div>
              <?php endif; ?>
            <div class="ftr-menu ftr-col-1">
              <h6 class="ftr-menu-title fl-h6 hide-sm"><?php _e( 'NAVIGATIE', THEME_NAME ); ?></h6>
              <?php 
                $fmenuOptions1 = array( 
                    'theme_location' => 'cbv_fta_menu', 
                    'menu_class' => 'reset-list',
                    'container' => '',
                    'container_class' => ''
                  );
                wp_nav_menu( $fmenuOptions1 );
              ?> 
            </div>
            <div class="ftr-menu ftr-col-2 hide-sm">
              <h6 class="ftr-menu-title fl-h6 hide-sm"><?php _e( 'Diensten', THEME_NAME ); ?></h6>
              <?php 
                $fmenuOptions2 = array( 
                    'theme_location' => 'cbv_ftb_menu', 
                    'menu_class' => 'reset-list',
                    'container' => '',
                    'container_class' => ''
                  );
                wp_nav_menu( $fmenuOptions2 );
              ?>
            </div>
            <div class="ftr-menu ftr-col-3">
              <h6 class="ftr-menu-title fl-h6 hide-sm"><?php _e( 'Contact', THEME_NAME ); ?></h6>
              <?php 
                if( !empty($address) ) printf('<div class="ftr-location"><a href="%s" target="_blank">%s</a></div>', $gmaplink, $address);
                if( !empty($telefoon) ) printf('<div class="ftr-phone"><a href="tel:%s">%s</a></div>', phone_preg($telefoon),  $telefoon); 
                if( !empty($email) ) printf('<div class="ftr-email"><a href="mailto:%s">%s</a></div>', $email, $email); 
                if( !empty($bwt) ) printf('<div class="ftr-vat"><span>BTW: %s</span></div>', $bwt); 
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ftr-btm">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="ftr-btm-inr">
            <div class="ftr-copywrite">
              <?php if( !empty( $copyright_text ) ) printf( '<span>%s</span>', $copyright_text); ?> 
            </div>
            <div class="ftr-btm-menu">
              <?php 
                $copyrightmenu = array( 
                    'theme_location' => 'cbv_copyright_menu', 
                    'menu_class' => 'reset-list',
                    'container' => '',
                    'container_class' => ''
                  );
                wp_nav_menu( $copyrightmenu );
              ?>
            </div>
            <div class="ftr-btm-designby">
              <span>Website laten maken door <a href="#">Conversal</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>