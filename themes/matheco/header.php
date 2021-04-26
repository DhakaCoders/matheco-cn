<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
<head> 
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $favicon = get_theme_mod('favicon'); if(!empty($favicon)) { ?> 
  <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
  <?php } ?>

  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->  


  <svg style="display: none;">

    <!-- <svg class="id-name" width="16" height="16" viewBox="0 0 16 16" fill="#FF5C26">
      <use xlink:href="#id-name"></use> </svg> -->

  <!-- start of Noyon -->
  <symbol id="shopping-cart-icon" width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
    <path d="M24.2511 23.7783C22.2032 23.7783 20.5146 25.431 20.5146 27.5148C20.5146 29.5626 22.1673 31.2512 24.2511 31.2512C26.299 31.2512 27.9876 29.5986 27.9876 27.5148C27.9516 25.4669 26.299 23.7783 24.2511 23.7783Z"/>
    <path d="M30.8258 5.95824C30.754 5.95824 30.6462 5.92231 30.5384 5.92231H7.90406L7.54478 3.51517C7.32922 1.93436 5.96397 0.748749 4.34723 0.748749H1.4371C0.646696 0.748749 0 1.39544 0 2.18585C0 2.97626 0.646696 3.62295 1.4371 3.62295H4.34723C4.52687 3.62295 4.67058 3.76666 4.70651 3.9463L6.93402 19.1077C7.22144 21.0119 8.8741 22.449 10.8142 22.449H25.76C27.6283 22.449 29.245 21.1197 29.6402 19.2874L31.9755 7.61091C32.1192 6.85643 31.6162 6.10195 30.8258 5.95824Z" />
    <path d="M15.0896 27.3351C15.0177 25.3591 13.3651 23.7783 11.3891 23.7783C9.30526 23.8861 7.72445 25.6106 7.7963 27.6585C7.86816 29.6345 9.4849 31.2153 11.4609 31.2153H11.5328C13.5806 31.1075 15.1974 29.383 15.0896 27.3351Z"/>
  </symbol>

  <symbol id="external-icon" width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
    <path d="M10.8 6V10.8H1.2V1.2H6V0H0V12H12V6H10.8Z"/>
    <path d="M7.19997 0L8.92797 1.728L5.52637 5.1296L6.87037 6.4736L10.272 3.072L12 4.8V0H7.19997Z"/>
  </symbol>

  <symbol id="hdr-user-icon" width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
    <path d="M16.0022 16.6168C20.5736 16.6168 24.3106 12.8799 24.3106 8.3084C24.3106 3.73694 20.5736 0 16.0022 0C11.4307 0 7.69385 3.73694 7.69385 8.3084C7.69385 12.8799 11.4308 16.6168 16.0022 16.6168Z" />
    <path d="M30.2606 23.2562C30.0429 22.712 29.7527 22.2041 29.4262 21.7324C27.7572 19.2652 25.1813 17.6326 22.2788 17.2335C21.916 17.1973 21.517 17.2698 21.2267 17.4875C19.7029 18.6122 17.8888 19.1927 16.0022 19.1927C14.1155 19.1927 12.3015 18.6122 10.7776 17.4875C10.4874 17.2698 10.0883 17.1609 9.7255 17.2335C6.823 17.6326 4.21077 19.2652 2.57814 21.7324C2.25161 22.2041 1.96133 22.7483 1.74369 23.2562C1.63487 23.4739 1.67112 23.7279 1.77994 23.9456C2.07022 24.4535 2.433 24.9615 2.75953 25.3968C3.26744 26.0862 3.81168 26.703 4.42848 27.2834C4.9364 27.7914 5.51689 28.263 6.09744 28.7347C8.96362 30.8753 12.4104 32 15.9659 32C19.5215 32 22.9682 30.8752 25.8344 28.7347C26.4149 28.2993 26.9954 27.7914 27.5033 27.2834C28.0838 26.703 28.6643 26.0861 29.1723 25.3968C29.5351 24.9252 29.8617 24.4535 30.1519 23.9456C30.3332 23.7279 30.3695 23.4739 30.2606 23.2562Z"/>
  </symbol>

  <!-- start of Rannojit -->


  <!-- start of Shariful -->


  <!-- start of Sabbir -->


  <!-- start of Milon -->
  <symbol id="error-icon-svg" width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
    <path d="M10.2023 12.6818C10.0183 12.6989 9.83354 12.6574 9.67456 12.5631C9.55841 12.4439 9.50272 12.2783 9.52321 12.1131C9.5275 11.9756 9.54392 11.8387 9.57229 11.704C9.59975 11.5496 9.63522 11.3966 9.67864 11.2458L10.1614 9.58493C10.2112 9.42099 10.2441 9.25238 10.2596 9.08173C10.2596 8.89766 10.2841 8.77081 10.2841 8.6972C10.2944 8.36908 10.1543 8.05422 9.90364 7.8422C9.59536 7.60552 9.21145 7.48919 8.82364 7.51493C8.54573 7.51911 8.26997 7.5646 8.00545 7.64993C7.71636 7.73993 7.41226 7.84765 7.09318 7.97312L6.9541 8.51312C7.04818 8.48039 7.16275 8.44358 7.29364 8.40266C7.41852 8.36567 7.54796 8.34637 7.67818 8.34539C7.86085 8.32559 8.04472 8.37045 8.19772 8.4722C8.30164 8.59619 8.3504 8.75728 8.33272 8.91812C8.33226 9.05568 8.31718 9.19283 8.28772 9.3272C8.25907 9.47039 8.22226 9.62173 8.17726 9.78127L7.69045 11.4504C7.65122 11.6055 7.61982 11.7625 7.59637 11.9208C7.57725 12.0563 7.56768 12.193 7.56772 12.3299C7.56572 12.6603 7.71678 12.9729 7.9768 13.1767C8.28983 13.4171 8.67922 13.5362 9.07314 13.5122C9.35053 13.5179 9.62696 13.4778 9.89134 13.3935C10.1232 13.3144 10.4327 13.2012 10.82 13.054L10.9509 12.5385C10.846 12.582 10.738 12.6176 10.6277 12.6449C10.4883 12.6767 10.3451 12.6891 10.2023 12.6818Z"/>
    <path d="M10.7139 4.80694C10.4913 4.60247 10.1979 4.49247 9.89572 4.50013C9.5937 4.49331 9.30063 4.60321 9.07753 4.80694C8.66859 5.15956 8.62293 5.77694 8.97558 6.18591C9.00701 6.22237 9.04108 6.25643 9.07753 6.28786C9.54342 6.70457 10.248 6.70457 10.7139 6.28786C11.1228 5.93176 11.1657 5.31161 10.8096 4.90267C10.78 4.8686 10.748 4.83661 10.7139 4.80694Z"/>
    <path d="M9 0C4.02943 0 0 4.02943 0 9C0 13.9706 4.02943 18 9 18C13.9706 18 18 13.9706 18 9C18 4.02943 13.9706 0 9 0ZM9 17.1818C4.4813 17.1818 0.818191 13.5187 0.818191 9C0.818191 4.4813 4.4813 0.818191 9 0.818191C13.5187 0.818191 17.1818 4.4813 17.1818 9C17.1818 13.5187 13.5187 17.1818 9 17.1818Z"/>
    </svg>

  <symbol id="pro-thumb-lft-arrow" width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0)">
    <path d="M5.20376 20.1332C4.81626 19.7679 4.80183 19.1568 5.16616 18.7713L13.2136 10.2766L5.1662 1.78288C4.80088 1.39732 4.8163 0.787183 5.2038 0.420917C5.5903 0.0546509 6.20044 0.0710172 6.56671 0.457563L15.2416 9.61441C15.4171 9.79946 15.5057 10.0385 15.5057 10.2766C15.5057 10.5146 15.4171 10.7546 15.2416 10.9397L6.56671 20.0966C6.2004 20.4831 5.5903 20.4995 5.20376 20.1332Z"/>
    </g>
    <defs>
    <clipPath id="clip0">
    <rect width="20.241" height="20.241" fill="white" transform="matrix(4.37114e-08 1 1 -4.37114e-08 0.0839844 0.156616)"/>
    </clipPath>
    </defs>
  </symbol>

  <symbol id="pro-thumb-rgt-arrow" width="21" height="21" viewBox="0 0 21 21"  xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0)">
    <path d="M15.1205 20.1332C15.508 19.7679 15.5224 19.1568 15.1581 18.7713L7.11064 10.2766L15.158 1.78288C15.5233 1.39732 15.5079 0.787183 15.1204 0.420917C14.7339 0.0546509 14.1238 0.0710172 13.7575 0.457563L5.0826 9.61441C4.90716 9.79946 4.81849 10.0385 4.81849 10.2766C4.81849 10.5146 4.90716 10.7546 5.0826 10.9397L13.7575 20.0966C14.1238 20.4831 14.7339 20.4995 15.1205 20.1332Z"/>
    </g>
    <defs>
    <clipPath id="clip0">
    <rect width="20.241" height="20.241" fill="white" transform="translate(20.2402 0.156616) rotate(90)"/>
    </clipPath>
    </defs>
  </symbol>  

  </svg>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
$logoObj = get_field('hdlogo', 'options');
if( is_array($logoObj) ){
  $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
}else{
  $logo_tag = '';
}
?>  
<header class="header hm-header">
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="header-cntlr clearfix">
            <div class="hdr-lft">
            <?php if( !empty($logo_tag) ): ?>
            <div class="logo">
              <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php echo $logo_tag; ?>
              </a>
            </div>
            <?php endif; ?>
            </div>
            <div class="hdr-rgt">
              <div class="hdr-menu">
                <nav class="main-nav">
                <?php 
                  $menuOptions = array( 
                      'theme_location' => 'cbv_main_menu', 
                      'menu_class' => 'clearfix reset-list',
                      'container' => '',
                      'container_class' => ''
                    );
                  wp_nav_menu( $menuOptions ); 
                ?>
                </nav>
              </div>
              <div class="user-cart-cntlr">
                <div class="user">
                  <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                    <i><svg class="hdr-user-icon" width="32" height="32" viewBox="0 0 32 32" fill="#fff">
                      <use xlink:href="#hdr-user-icon"></use></svg></i>
                  </a>
                </div>
                <div class="shopping-cart">
                  <a href="<?php echo wc_get_cart_url(); ?>">
                  <?php 
                  if( WC()->cart->get_cart_contents_count() > 0 ){
                    echo sprintf ( '<span>%d</span>', WC()->cart->get_cart_contents_count() );
                  }else{
                    echo sprintf ( '<span>%d</span>', 0 );
                  }  
                  ?>
                    <i><svg class="shopping-cart-icon" width="32" height="32" viewBox="0 0 32 32" fill="#fff">
                      <use xlink:href="#shopping-cart-icon"></use></svg></i>
                  </a>
                </div>
              </div>
              <div class="xs-hambergar">
                <div class="hambergar-icon">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</header>