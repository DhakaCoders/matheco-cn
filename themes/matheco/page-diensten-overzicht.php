<?php 
/*
Template Name: Diensten overzicht 
*/
get_header();
$thisID = get_the_ID(); 
get_template_part('templates/breadcrumbs');
?>

<section class="diensten-overzicht-page-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="sec-entry-hdr dops-cntlr">
          <h1 class="our-services-title fl-h3">Onze diensten</h1>
          <p>Vitae quis leo a massa. Ut vulputate suscipit amet, urna nulla tristique. Eu enim non ullamcorper.</p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="dops-grds-cntlr">
          <div class="our-services-grid-cntlr">
            <div class="our-services-grid OurServicesSlider">
              <div class="our-services-item-wrap mHc">
                <div class="our-services-item-cnlr">
                  <div class="our-services-item">
                    <div class="our-srvcs-icon">
                      <i><img src="<?php echo THEME_URI; ?>/assets/images/our-services-item-icon-001.svg" alt=""></i>
                    </div>
                    <div class="our-services-hding mHc1">
                      <h4 class="our-services-item-title fl-h4"><a href="#">Toonbanken</a></h4>
                    </div>
                    <div class="our-services-item-desc">
                      <p>Vitae quis leo a massa. Ut vulputate suscipit amet, urna nulla tristique. Eu enim non ullamcorper.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="our-services-item-wrap mHc">
                <div class="our-services-item-cnlr">
                  <div class="our-services-item">
                    <div class="our-srvcs-icon">
                      <i><img src="<?php echo THEME_URI; ?>/assets/images/our-services-item-icon-002.svg" alt=""></i>
                    </div>
                    <div class="our-services-hding mHc1">
                      <h4 class="our-services-item-title fl-h4"><a href="#">Airco <br>
                      en warmtepompen</a></h4>
                    </div>
                    <div class="our-services-item-desc">
                      <p>Vitae quis leo a massa. Ut vulputate suscipit amet, urna nulla tristique. Eu enim non ullamcorper.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="our-services-item-wrap mHc">
                <div class="our-services-item-cnlr">
                  <div class="our-services-item">
                    <div class="our-srvcs-icon">
                      <i><img src="<?php echo THEME_URI; ?>/assets/images/our-services-item-icon-003.svg" alt=""></i>
                    </div>
                    <div class="our-services-hding mHc1">
                      <h4 class="our-services-item-title fl-h4"><a href="#">Verkoop <br>
                      koelinstallatie</a></h4>
                    </div>
                    <div class="our-services-item-desc">
                      <p>Vitae quis leo a massa. Ut vulputate suscipit amet, urna nulla tristique. Eu enim non ullamcorper.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="our-services-item-wrap mHc">
                <div class="our-services-item-cnlr">
                  <div class="our-services-item">
                    <div class="our-srvcs-icon">
                      <i><img src="<?php echo THEME_URI; ?>/assets/images/our-services-item-icon-004.svg" alt=""></i>
                    </div>
                    <div class="our-services-hding mHc1">
                      <h4 class="our-services-item-title fl-h4"><a href="#"> Na <br>
                      verkoop</a></h4>
                    </div>
                    <div class="our-services-item-desc">
                      <p>Vitae quis leo a massa. Ut vulputate suscipit amet, urna nulla tristique. Eu enim non ullamcorper.</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="diensten-overzicht-page-btm-grds">
        <div class="dopbg-col">
          <P>Maecenas faucibus eget vitae phasellus. Odio mauris venenatis dolor diam. Phasellus sollicitudin lectus pharetra volutpat sed. Tellus turpis sit purus purus elementum pretium. Magna molestie mi elit sit. Placerat phasellus aliquet metus phasellus a. Tortor amet in purus magna aliquam. Sed et egestas nisl purus. Neque mi amet dui, nec est. Morbi dui leo quam dui feugiat ipsum. Pellentesque aenean molestie ultrices feugiat pellentesque. Sit amet, magna eros, etiam aliquet ridiculus sed lorem. Id nisi ornare eros, lectus nunc, ac est eget habitant.<br>
          Eu amet porta vestibulum malesuada nunc morbi tempus. Amet egestas pellentesque arcu facilisi enim sapien. Maecenas felis, et velit, sed imperdiet at scelerisque tellus etiam. Maecenas velit at eget turpis. Bibendum quam eget imperdiet blandit lorem cursus amet posuere augue.</P>
        </div>
        <div class="dopbg-col">
          <P>Mi, feugiat enim viverra mattis arcu, amet aenean enim. Imperdiet nibh enim blandit varius purus amet. At turpis pulvinar feugiat quisque mollis risus posuere. Massa velit, aliquet viverra pharetra pharetra. Platea massa, sagittis netus in pretium quis feugiat pretium in. Ipsum luctus mi ultrices non porttitor. Purus vestibulum risus interdum nunc, at in felis. Nibh commodo ac diam viverra.</P>

          <p>Facilisi imperdiet eu viverra vivamus nullam velit lectus fermentum in. Ullamcorper facilisis vulputate.</P>
        </div>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>