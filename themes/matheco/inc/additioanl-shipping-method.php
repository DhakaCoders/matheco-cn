<?php

// Customizing Woocommerce checkout radio form field
add_action( 'woocommerce_form_field_radio', 'custom_form_field_radio', 20, 4 );
function custom_form_field_radio( $field, $key, $args, $value ) {
    if ( ! empty( $args['options'] ) && is_checkout() ) {
        $field = str_replace( '</label><input ', '</label><br><input ', $field );
        $field = str_replace( '<label ', '<label style="display:inline;margin-left:8px;" ', $field );
    }
    return $field;
}

// Add a custom radio fields for packaging selection
add_action( 'woocommerce_review_order_after_shipping', 'checkout_shipping_form_delivery_addition', 20 );
function checkout_shipping_form_delivery_addition(){
    $domain = 'wocommerce';


        __('Delivery options', $domain);

        $chosen = WC()->session->get('chosen_delivery');
        $chosen = empty($chosen) ? WC()->checkout->get_value('delivery') : $chosen;
        $chosen = empty($chosen) ? 'regular' : $chosen;
        $price = wc_price(2);
        // Add a custom checkbox field
        woocommerce_form_field( 'radio_delivery', array(
            'type' => 'radio',
            'class' => array( 'form-row-wide' ),
            'options' => array(
                'regular' => __('Regular', $domain),
                'premium' => __('Premium + 2', $domain),
            ),
            'default' => $chosen,
        ), $chosen );


}

// jQuery - Ajax script
add_action( 'wp_footer', 'checkout_delivery_script' );
function checkout_delivery_script() {
    // Only checkout page
    if ( ! is_checkout() ) return;
    ?>
    <script type="text/javascript">
    jQuery( function($){
        if (typeof wc_checkout_params === 'undefined')
            return false;

        $('form.checkout').on('change', 'input[name=radio_delivery]', function(e){
            e.preventDefault();
            var d = $(this).val();
            $.ajax({
                type: 'POST',
                url: wc_checkout_params.ajax_url,
                data: {
                    'action': 'delivery',
                    'delivery': d,
                },
                success: function (result) {
                    $('body').trigger('update_checkout');
                    console.log(result); // just for testing | TO BE REMOVED
                },
                error: function(error){
                    console.log(error); // just for testing | TO BE REMOVED
                }
            });
        });
    });
    </script>
    <?php

}

// Get Ajax request and saving to WC session
add_action( 'wp_ajax_delivery', 'wc_get_delivery_ajax_data' );
add_action( 'wp_ajax_nopriv_delivery', 'wc_get_delivery_ajax_data' );
function wc_get_delivery_ajax_data() {
    if ( isset($_POST['delivery']) ){
        WC()->session->set('chosen_delivery', sanitize_key( $_POST['delivery'] ) );
        echo json_encode( $delivery ); // Return the value to jQuery
    }
    die();
}

// Add a custom dynamic delivery fee
add_action( 'woocommerce_cart_calculate_fees', 'add_packaging_fee', 20, 1 );
function add_packaging_fee( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    // Only for targeted shipping method

    if( WC()->session->get( 'chosen_delivery' ) == 'premium' )
        $cart->add_fee( __( 'Delivery fee', 'woocommerce' ), 2.00 );
}



///

add_action( 'woocommerce_review_order_before_payment', 'bbloomer_checkout_radio_choice' );
  
function bbloomer_checkout_radio_choice() {
     
   $chosen = WC()->session->get( 'radio_chosen' );
   $chosen = empty( $chosen ) ? WC()->checkout->get_value( 'radio_choice' ) : $chosen;
   $chosen = empty( $chosen ) ? '0' : $chosen;
        
   $args = array(
   'type' => 'radio',
   'class' => array( 'form-row-wide', 'update_totals_on_change' ),
   'options' => array(
      '0' => 'No Option',
      '10' => 'Option 1 ($10)',
      '30' => 'Option 2 ($30)',
   ),
   'default' => $chosen
   );
     
   echo '<div id="checkout-radio">';
   echo '<h3>Customize Your Order!</h3>';
   woocommerce_form_field( 'radio_choice', $args, $chosen );
   echo '</div>';
     
}
  
// Part 2 
// Add Fee and Calculate Total
   
add_action( 'woocommerce_cart_calculate_fees', 'bbloomer_checkout_radio_choice_fee', 20, 1 );
  
function bbloomer_checkout_radio_choice_fee( $cart ) {
   
   if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    
   $radio = WC()->session->get( 'radio_chosen' );
     
   if ( $radio ) {
      $cart->add_fee( 'Option Fee', $radio );
   }
   
}
  
// Part 3 
// Add Radio Choice to Session
  
add_action( 'woocommerce_checkout_update_order_review', 'bbloomer_checkout_radio_choice_set_session' );
  
function bbloomer_checkout_radio_choice_set_session( $posted_data ) {
    parse_str( $posted_data, $output );
    if ( isset( $output['radio_choice'] ) ){
        WC()->session->set( 'radio_chosen', $output['radio_choice'] );
    }
}