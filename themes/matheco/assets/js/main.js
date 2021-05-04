(function($) {

/*Google Map Style*/
var CustomMapStyles  = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]

var windowWidth = $(window).width();
$('.navbar-toggle').on('click', function(){
  $('#mobile-nav').slideToggle(300);
});
  
  
//matchHeightCol
if($('.mHc').length){
  $('.mHc').matchHeight();
};
if($('.mHc1').length){
  $('.mHc1').matchHeight();
};
if($('.mHc2').length){
  $('.mHc2').matchHeight();
};
if($('.mHc3').length){
  $('.mHc3').matchHeight();
};
if($('.mHc4').length){
  $('.mHc4').matchHeight();
};
if($('.mHc5').length){
  $('.mHc5').matchHeight();
};


//$('[data-toggle="tooltip"]').tooltip();

//banner animation
$(window).scroll(function() {
  var scroll = $(window).scrollTop();
  $('.page-banner-bg').css({
    '-webkit-transform' : 'scale(' + (1 + scroll/2000) + ')',
    '-moz-transform'    : 'scale(' + (1 + scroll/2000) + ')',
    '-ms-transform'     : 'scale(' + (1 + scroll/2000) + ')',
    '-o-transform'      : 'scale(' + (1 + scroll/2000) + ')',
    'transform'         : 'scale(' + (1 + scroll/2000) + ')'
  });
});


if($('.fancybox').length){
$('.fancybox').fancybox({
    //openEffect  : 'none',
    //closeEffect : 'none'
  });

}


/**
Responsive on 767px
*/

// if (windowWidth <= 767) {
  $('.toggle-btn').on('click', function(){
    $(this).toggleClass('menu-expend');
    $('.toggle-bar ul').slideToggle(500);
  });


// }



// http://codepen.io/norman_pixelkings/pen/NNbqgG
// https://stackoverflow.com/questions/38686650/slick-slides-on-pagination-hover


/**
Slick slider
*/
if( $('.responsive-slider').length ){
    $('.responsive-slider').slick({
      dots: true,
      infinite: false,
      autoplay: true,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}


var swiper = new Swiper('.catagorySlider', {
    slidesPerView: 1,
    loop: true,
    navigation: {
      nextEl: '.catagorySlider-arrows .swiper-button-next',
      prevEl: '.catagorySlider-arrows .swiper-button-prev',
    },
    breakpoints: {
       639: {
        slidesPerView: 2,
        spaceBetween: 0,
      },
      991: {
        slidesPerView: 3,
        spaceBetween: 0,
      },
      1199: {
        loop: false,
        slidesPerView: 4,
        spaceBetween: 0,
      },
      1920: {
        loop: false,
        slidesPerView: 4,
        spaceBetween: 0,
      },
    }
  });

if( $('#mapID').length ){
var latitude = $('#mapID').data('latitude');
var longitude = $('#mapID').data('longitude');

var myCenter= new google.maps.LatLng(latitude,  longitude);
function initialize(){
    var mapProp = {
      center:myCenter,
      mapTypeControl:true,
      scrollwheel: false,
      zoomControl: true,
      disableDefaultUI: true,
      zoom:7,
      streetViewControl: false,
      rotateControl: true,
      mapTypeId:google.maps.MapTypeId.ROADMAP,
      styles: CustomMapStyles
      };

    var map= new google.maps.Map(document.getElementById('mapID'),mapProp);
    var marker= new google.maps.Marker({
      position:myCenter,
        //icon:'map-marker.png'
      });
    marker.setMap(map);
}
google.maps.event.addDomListener(window, 'load', initialize);

}



/* BS form Validator*/
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();



if (windowWidth <= 767) {
  $('.hambergar-icon').on('click', function(e){
    $('.hdr-menu').slideToggle(500);
    $(this).toggleClass('cross-icon');
  });

  $('li.menu-item-has-children > a').on('click', function(e){
    e.preventDefault();
    $(this).parent().toggleClass('sub-menu-arrow');
    $(this).next().slideToggle(300);

  });
}

if( $('.hm-banner-bdr').length ){
  var conWidth = $('.container').width();
  var OutConLft = (windowWidth - conWidth)/2;
  $('.hm-banner-bdr').css("right",OutConLft);
}
$(window).resize(function() { 
  var window2Width = $(window).outerWidth();
  var conWidth = $('.container').width();
  var OutConLft = (window2Width - conWidth)/2;
  $('.hm-banner-bdr').css("right",OutConLft);
});

if (windowWidth > 767){
  if( $('.ftball-bcwrd-img').length ){
    var conWidth = $('.container').outerWidth();
    var OutConLft = (windowWidth - conWidth)/2;
    var VclRtWidth = $('.ftball-bcwrd-desc-cntlr').outerWidth();
    var VclLefBgOuter = OutConLft + VclRtWidth;
    $('.ftball-bcwrd-img').css("width", VclLefBgOuter);
  }
}


$(window).resize(function() { 
  var window2Width = $(window).outerWidth();
  var conWidth = $('.container').outerWidth();
  var OutConLft = (window2Width - conWidth)/2;
  var VclRtWidth = $('.ftball-bcwrd-desc-cntlr').outerWidth();
  var VclLefBgOuter = OutConLft + VclRtWidth;
  $('.ftball-bcwrd-img').css("width", VclLefBgOuter);
});

// // if (windowWidth <= 767) {
//   if( $('.OurServicesSlider').length ){
//     $('.OurServicesSlider').slick({
//       dots: true,
//       infinite: false,
//       autoplay: false,
//       autoplaySpeed: 4000,
//       speed: 700,
//       slidesToShow: 1,
//       slidesToScroll: 1,
//     });
//   }
// // }
/**
Slick slider
*/
if( $('.OurServicesSlider').length ){
    $('.OurServicesSlider').slick({
      dots: false,
      arrows:false,
      infinite: true,
      autoplay: false,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: true
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}


  /*$('.mct-faq-accordion h5').on('click', function(){
     
   $(this).toggleClass('active');
    $(this).parents().siblings().find('h5').removeClass('active'); 
    $(this).parents().find('.mct-faq-accordion-des').slideToggle(300);
    $(this).parents().siblings().find('.mct-faq-accordion-des').slideUp(300);
    
  });*/

/*
  $('.mct-faq-accordion-title').on('click', function(){
    $(this).toggleClass('active');
    $(this).parent().siblings().find('h5').removeClass('active');
    $(this).parent().find('.mct-faq-accordion-des').slideToggle(300);
    $(this).parent().siblings().find('.mct-faq-accordion-des').slideUp(300);
  });*/


/*$('.mct-faq-accordion-title').click(function(){
    $(this).next().slideToggle(300);
    $(this).parent().siblings().find('.mct-faq-accordion-des').slideUp(300);
    $(this).toggleClass('active');
    $(this).parent().siblings().find('.mct-faq-accordion-title').removeClass('active');
});
*/


$('.mct-faq-accordion-title').click(function(){
    $(this).next().slideToggle(300);
    $(this).parent().siblings().find('.mct-faq-accordion-title').slideUp(300);
    $(this).toggleClass('active');
    $(this).parent().siblings().find('.mct-faq-accordion-title').removeClass('active');
});




/*start of Sabbir*/
if (windowWidth <= 767) {
if( $('.filter-prdt').length ){
$('.filter-prdt').click(function(){
  $('.filter-sidebar').slideToggle(400);
  $(this).toggleClass('filter-prdt-arw-rotate');
});
}
}

/**
Slick slider
*/
if( $('.hasRelatedProduct').length ){
    $('.hasRelatedProduct').slick({
      dots: false,
      arrows:false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: true
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}

/**
Slick slider
*/
if( $('.hm-product-grds').length ){
    $('.hm-product-grds').slick({
      dots: false,
      arrows:false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: true
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}

if( $('.main-img-crtl').length ){
 $('.main-img-crtl').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade: true,
  autoplay:true,
  asNavFor: '.thumbnails-cntlr .thumbnails',
   prevArrow: $('.fl-singgle-pro-prev'),
  nextArrow: $('.fl-singgle-pro-next'),
});
$('.thumbnails-cntlr .thumbnails').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.main-img-crtl',
  dots: false,
  arrows: true,
  autoplay:true,
  focusOnSelect: true
});
}

// if( $('.sidebar-widget ul li lable input').length ){
//   $(".sidebar-widget ul li lable input").on('click',function(){
//     $(this).parent().toggleClass('active-lable');
//   });

// }



$(".type-order-format .woocommerce-input-wrapper span").each(function(){
        $(this).append('<div class="radio-custom"></div>')
  });
$(".billing-address-wrap .same-as-shipping-address,.login-info p:first-child,.form-row .woocommerce-form__label-for-checkbox").each(function(){
        $(this).append('<div class="checkbox-custom"></div>')
  });


if( $('.TeamMemberSlider').length ){
    $('.TeamMemberSlider').slick({
      dots: false,
      infinite: false,
      autoplay: false,
      autoplaySpeed: 4000,
      speed: 700,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 639,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            dots:true
          }
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 2,
            dots: true,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
}

if( $('.ornare-lft-bg').length ){
  var conWidth = $('.container').width();

  var OutConLef = (windowWidth - conWidth)/2;
  var VclLftWidth = $('.ornare-dsc').outerWidth();
  var VclRtBgOuter = OutConRgt + VclLftWidth;
  var VclRtBg = windowWidth - VclRtBgOuter;
  $('.ornare-lft-bg').css("width",VclRtBg);
}

$(window).resize(function() { 
  var window2Width = $(window).width();
  var conWidth = $('.container').width();

  var OutConRgt = (window2Width - conWidth)/2;
  var VclLftWidth = $('.contat-frm-wrp').outerWidth();
  var VclRtBgOuter = OutConRgt + VclLftWidth;
  var VclRtBg = window2Width - VclRtBgOuter;
  $('.ornare-lft-bg').css("width",VclRtBg);
});

/*$('.contact-form-wrp .wpforms-container .wpforms-form .wpforms-submit-container button').on('click', function(){
  $(this).parents('.wpforms-field').addClass('wpforms-has-error');
});*/

// insert billing fields
$('.contact-form-wrp .wpforms-field-pagebreak .wpforms-clear button:hover, .contact-form-wrp .wpforms-container .wpforms-form .wpforms-submit-container button').on('click', function(){
  $('.wpforms-field.wpforms-field-email').addClass('wpforms-has-error');
});

$("#for_business").on('change', function(){
var html = '<p class="form-row form-row-wide" id="billing_btw_nummer_field">' +
        '<label for="billing_btw_nummer" class="">BTW-nummer</label>' +
        '<span class="woocommerce-input-wrapper">' +
          '<input type="text" class="input-text " name="billing_btw_nummer" id="billing_btw_nummer" placeholder="BTW-nummer" required>' +
        '</span>' +
      '</p>'+
      '<p class="form-row form-row-wide" id="billing_btw_nummer_field">' +
        '<label for="billing_reference" class="">Referentie</label>' +
        '<span class="woocommerce-input-wrapper">' +
          '<input type="text" class="input-text " name="billing_reference" id="billing_reference" placeholder="Referentie" required>' +
        '</span>' +
      '</p>';

  $("#extra_fields").html(html);
});
$("#private").on('change', function(){

var html = '';
  $("#extra_fields").empty(html);
})

// shipping field show/hide

$(".hide-account-title .show_shipping_fields input.input-text").prop('required', true);
$("#is_shipping_address").on('change',function(){
   var ischecked= $(this).is(':checked');
    if(ischecked){
      $(".hide-account-title .show_shipping_fields input.input-text").prop('required', false);
     $(".hide-account-title .show_shipping_fields").hide();
    }else{
      $(".hide-account-title .show_shipping_fields").show();
      $(".hide-account-title .show_shipping_fields input.input-text").prop('required', true);
    }
 }); 

// Registration form validation
$("#re_password").bind('blur keyup change', function(){
  $("#register_action_btn").attr('disabled','disabled');
  var pass = $('#re_password').val();
  //check the strings
  if(pass.length >= 8){
    $('.error-rel_password').text('');
    $(this).css({"border": "2px solid #F3F3F3", "color": "#9EA5AB"});
  }else{
    $('.error-rel_password').text('Wachtwoord zou moeten minimaal 8 karakters');
    $(this).css({"border": "2px solid #D17181", "color": "#D17181"});
    $("#register_action_btn").attr('disabled','disabled');
  }
});


$("#confirm_password").bind('blur keyup change click', function(){
  $("#register_action_btn").prop("disabled",false);
    var pass = $('#re_password').val();
    var confpass = $(this).val();
    //check the strings
    if(pass == confpass){
    //if both are same remove the error and allow to submit
    $('.error-confirm_password').text('');
    $(this).css({"border": "2px solid #F3F3F3", "color": "#9EA5AB"});
    $("#register_action_btn").prop("disabled",false);
    }else{
    //if not matching show error and not allow to submit
    $('.error-confirm_password').text('Wachtwoord komt niet overeen');
    $(this).css({"border": "2px solid #D17181", "color": "#D17181"});
    $("#register_action_btn").prop("disabled",true);
    }
});

/* Checkout field show/hide */
if ($("#billing_order_type_Zakelijk").is(":checked")) {
    $('#billing_company_field').addClass('show-company');
    $('#vat_number_field').addClass('show-vat_number');
    $('#billing_reference_field').addClass('show-reference');
}
$("#billing_order_type_Zakelijk").on('change', function(){
    if ($(this).is(":checked")) {
        $('#billing_company_field').addClass('show-company');
        $('#vat_number_field').addClass('show-vat_number');
        $('#billing_reference_field').addClass('show-reference');
    }
});
$("#billing_order_type_Particulier").on('change', function(){
    if ($(this).is(":checked")) {
        $('#billing_company_field').removeClass('show-company');
        $('#vat_number_field').removeClass('show-vat_number');
        $('#billing_reference_field').removeClass('show-reference');
    }
});

// Coupon code triger
$("#apply_coupon_code").click(function(){
    var couponCode = $('#coupon_code_enter').val();
    $("body .checkout_coupon.woocommerce-form-coupon input#coupon_code").val(couponCode)
    $(".checkout_coupon button").submit();

});

// category filter

$("#cat_filterform").on("change", "#cat_filter input:checkbox", function(){
  var url = $("#cat_filterform").data('url');
  var minMax = $("#minMaxPrice").data('minmax');
  var selected = new Array();  
  $('#cat_filter input:checkbox:checked').each(function () {
      selected.push(this.value);
  });
  if (selected.length > 0) {
      //var params = { filter_cats:selected.join(",") };
      var params = 'filter_cats='+selected.join(",");
      if(minMax){
        window.location.assign(url+'&'+params);
      }else{
        window.location.assign(url+'?'+params);
      }  
  }else{
    window.location.assign(url)
  }
  //$("#cat_filterform").submit();
});




//products counter
if( $('.qty').length ){
  $('.qty').each(function() {
    var spinner = $(this),
      input = spinner.find('input[type="number"]'),
      btnUp = spinner.find('.plus'),
      btnDown = spinner.find('.minus'),
      min = 1,
      max = input.attr('max');

    btnUp.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

    btnDown.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

  });

}

if( $('.qty1').length ){
  $('.qty1').each(function() {
    var spinner = $(this),
      input = spinner.find('input[type="number"]'),
      btnUp = spinner.find('.plus'),
      btnDown = spinner.find('.minus'),
      min = 1,
      max = input.attr('max');

    btnUp.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

    btnDown.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

  });

}

if (windowWidth <= 767) {
  $(window).scroll(function() {
      if ($(this).scrollTop()) {
          $('.to-top-btn-cntlr').fadeIn();
      } else {
          $('.to-top-btn-cntlr').fadeOut();
      }
  });
  }
if( $('.to-top-btn-cntlr').length ){
  $(".to-top-btn-cntlr").click(function() {
      $("html, body").animate({scrollTop: 0}, 1000);
   });
}
new WOW().init();


})(jQuery);