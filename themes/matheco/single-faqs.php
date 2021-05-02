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
              Terug naar overzicht
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


<section class="innerpage-con-wrap">
  <article class="default-page-con" id="faq-details">
    <div class="block-955">
      <div class="dfp-promo-module clearfix">
        <div>
          <strong class="dfp-promo-module-title fl-h3">dignissim ut odio egestas commodo?</strong>
          <a href="#">Categorie</a>
        </div>
        <div class="dfp-plate-one-img-bx">
          <img src="<?php echo THEME_URI; ?>/assets/images/dfp-img-01.jpg">
        </div>
      </div>

      <div class="dfp-text-module clearfix">
        <p>Purus consequat sed egestas. Nunc purus molestie sed tincidunt tellus adipiscing. Vestibulum, eu purus sapien mi sit. Interdum porttitor at praesent auctor diam. Purus gravida nulla amet.</p>
        <ul>
          <li>Nunc purus molestie sed tincidunt tellus.</li>
          <li>Dictum mi facilisi elementum aliquam.</li>
          <li>Lectus fames a nibh faucibus malesuada. Sit.</li>
        </ul>
        <p>Vestibulum, eu purus sapien mi sit. Interdum porttitor at praesent auctor diam. Purus gravida nulla amet.</p>
      </div>

      <div class="dfp-back-btn-module">
        <div class="dfp-back-btn">
          <a href="javascript:history.go(-1)">
            Terug naar overzicht
            <i>
              <svg class="dfp-back-btn-icon-svg" width="8" height="14" viewBox="0 0 8 14" fill="#707C88">
                <use xlink:href="#dfp-back-btn-icon-svg"></use>
              </svg>
            </i>
          </a>
        </div>
        <div class="dfp-social-media">
          <span>Delen op:</span>
          <ul class="reset-list">
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
          </ul>
        </div>
      </div>


     
    </div>
    
    </div>
  </article>
</section>


<section class="faq-detials-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="faq-detials-sec-inr">
          <div class="sec-entry-hdr hm-faq-entry-hdr">
            <h2 class="mtc-faq-entry-title fl-h3">Meer vragen?</h2>
          </div>
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
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>