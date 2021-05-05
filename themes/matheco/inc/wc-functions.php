<?php
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

add_action('woocommerce_before_main_content', 'get_custom_wc_output_content_wrapper', 11);
add_action('woocommerce_after_main_content', 'get_custom_wc_output_content_wrapper_end', 9);
add_filter( 'woocommerce_show_page_title', '__return_false' );
function get_custom_wc_output_content_wrapper(){

    if(is_shop() OR is_product_category()){ 
        get_template_part('templates/breadcrumbs');
        echo '<section class="product-page-cntlr">';
        get_template_part('templates/shop', 'top');
        echo ' <div class="product-category"><div class="container"><div class="row"><div class="col-md-12"><div class="product-page-col-rgt">';
        get_sidebar('shop');
        echo '<div class="fl-products-cntlr">';
    }


}

function get_custom_wc_output_content_wrapper_end(){
  if(is_shop() OR is_product_category()){
    echo '</div>';
    echo '</div></div></div></div>';
    echo '</section>';
    get_template_part('templates/shop', 'bottom');
  }

}

function get_array( $string ){
    if( !empty( $string ) ){ 
        $str_arr = preg_split ("/\,/", $string);   
        return $str_arr;
    }
    return false;
}
/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
  function loop_columns() {
    return 3; // 3 products per row
  }
}
/*Loop Hooks*/


/**
 * Add loop inner details are below
 */

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action('woocommerce_shop_loop_item_title', 'add_shorttext_below_title_loop', 5);
if (!function_exists('add_shorttext_below_title_loop')) {
    function add_shorttext_below_title_loop() {
        global $product, $woocommerce, $post;
        $label  = __('MEER INFO', 'woocommerce');
        $sh_desc = $product->get_short_description();
        $gridtag = cbv_get_image_tag( get_post_thumbnail_id($product->get_id()), 'pgrid' );
        echo '<div class="fl-product-grd mHc">
        <div class="fl-product-grd-inr">';
        wc_get_template_part('loop/sale','flash');
        echo '<div class="fl-pro-grd-img-cntlr mHc1">
            <a href="'.get_permalink( $product->get_id() ).'" class="overlay-link"></a>
            '.$gridtag.'
          </div>
          <div class="fl-pro-grd-des mHc2">
            <h4 class="fl-h5 fl-pro-grd-title"><a href="'.get_permalink( $product->get_id() ).'">'.get_the_title().'</a></h4>
            <div class="fl-pro-grd-price">'.$product->get_price_html().'</div>';
        if( !empty($sh_desc) ) echo wpautop($sh_desc);
        echo '</div>';  
        echo '<div class="fl-pro-grd-btn">
            <a class="fl-trnsprnt-btn prdt-btn" href="'.get_permalink( $product->get_id() ).'">MEER INFO</a>
          </div>
        </div>
        </div>';
    }
}

function loop_qty_input(){

    global $product;
    $qty_input = woocommerce_quantity_input( array(
        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', product_min_qty(), $product ),
        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', product_max_qty(), $product ),
        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : product_min_qty(), // WPCS: CSRF ok, input var ok.
    ) );
    return $qty_input;
}

function wc_stock_manage(){
    global $product;
    $StockQ = $product->get_stock_quantity();
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
        echo '<span class="out-of-stock">Out of Stock</span>';
        
    } elseif( $StockQ < 1 ) {
        if ($product->backorders_allowed()){
            echo '<span class="backorders">Available on Backorder</span>';
        } elseif ( !$product->backorders_allowed() && $StockQ == 0 && ! $product->is_in_stock()){
            echo '<span class="out-of-stock">Out of Stock</span>';
        } elseif ( $product->is_on_backorder() ){
            echo '<span class="backorders">Available on Backorder</span>';
        }
    } 
}

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = 6;
  return $cols;
}


add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
$args['posts_per_page'] = 4; // 4 related products
return $args;
}



// change a number of the breadcrumb defaults.
add_filter( 'woocommerce_breadcrumb_defaults', 'cbv_woocommerce_breadcrumbs' );
if( !function_exists('cbv_woocommerce_breadcrumbs')):
function cbv_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<ul class="reset-list">',
            'wrap_after'  => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}
endif;

/*Remove Single page Woocommerce Hooks & Filters are below*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action('woocommerce_single_product_summary', 'add_custom_box_product_summary', 5);
if (!function_exists('add_custom_box_product_summary')) {
    function add_custom_box_product_summary() {
        global $product, $woocommerce, $post;
        $long_desc = $product->get_description();
        $extravalue = get_post_meta( $product->get_id(), 'product_extra', true );
        echo '<div class="summary-ctrl">';
        echo '<div class="summary-hdr">';
        echo '<h1 class="product_title entry-title hide-sm">'.$product->get_title().'</h1>';
        echo '<div class="qty-price-wrap">';
        echo '<span class="single-price-total">';
        echo $product->get_price_html();
        echo '</span>';
        echo '</div>';
        if( !empty($long_desc) ){
            echo '<div class="long-desc">';
            echo wpautop( $long_desc, true );
            echo '</div>';
        }
        echo '</div>';
        echo '<div class="export-file"><p>LOREM IPSUM DOLOR SIT AMET</p></div>';
        echo '<div class="meta-crtl">';
        echo '<ul>';
            echo '<li>';
            echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in"><strong>'.esc_html__( 'Categorie:', 'woocommerce' ). '</strong>', '</span>' );
            echo '</li>';
            if ( wc_product_sku_enabled() && !empty($product->get_sku()) && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) :
                echo '<li><span class="sku">';
                echo '<strong>';
                esc_html_e( 'SKU:', 'woocommerce' );
                echo '</strong>';
                echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' );
                echo '</span></li>';
            endif;
            if( !empty($extravalue) ) printf('<li><span class="extra"><strong>Extra:</strong>%s</span></li>', $extravalue);
        echo '</ul>';
        echo '</div>';
        echo '<div class="price-quentity-ctrl">';
          woocommerce_template_single_add_to_cart();
        echo '</div>';
        echo '</div>';
    }
}

add_action('woocommerce_before_add_to_cart_quantity', 'cbv_start_div_single_price', 99);
function cbv_start_div_single_price(){
    echo '<div class="cartbtn-wrap clearfix"><strong>Aantal</strong><div class="cart-btn-qty">';
    echo '<div class="quantity qty"><span class="minus">-</span>';
}
add_action('woocommerce_after_add_to_cart_quantity', 'cbv_get_single_price');
function cbv_get_single_price(){
    global $product;
    echo '<span class="plus">+</span></div>';
    echo '</div></div>';
}


// Change 'add to cart' text on single product page (only for product ID 386)
add_filter( 'woocommerce_product_single_add_to_cart_text', 'bryce_id_add_to_cart_text' );
function bryce_id_add_to_cart_text( $default ) {
        return __( 'BESTELLEN', THEME_NAME );
}

add_action('cbv_related_product', 'woocommerce_output_related_products', 1);
add_action('cbv_related_product', 'wc_product_single_faq', 5);

function wc_product_single_faq(){
    get_template_part('templates/product-single/bottom', 'section');
}
add_action( 'woocommerce_product_options_inventory_product_data', 'misha_adv_product_options');
function misha_adv_product_options(){
 
    echo '<div class="options_group">';
    woocommerce_wp_text_input( array(
        'id'      => 'product_extra',
        'value'   => get_post_meta( get_the_ID(), 'product_extra', true ),
        'label'   => __('Extra', 'woocommerce'),
        'desc_tip'    => 'true',
        'description' => __( 'Enter the extra value here.', 'woocommerce' ) 
    ));
    woocommerce_wp_text_input( array(
        'id'      => 'product_min_qty',
        'value'   => get_post_meta( get_the_ID(), 'product_min_qty', true ),
        'label'   => __('Product Min Quantity', 'woocommerce'),
        'type' => 'number',
        'custom_attributes' => array(
        'step' => 'any',
        'min' => '0'
        )
    ));
     woocommerce_wp_text_input( array(
        'id'      => 'product_max_qty',
        'value'   => get_post_meta( get_the_ID(), 'product_max_qty', true ),
        'label'   => __('Product Max Quantity', 'woocommerce'),
        'type' => 'number',
        'custom_attributes' => array(
        'step' => 'any',
        )
    ));
    echo '</div>';
 
}
 
 
add_action( 'woocommerce_process_product_meta', 'misha_save_fields', 10, 2 );
function misha_save_fields( $id, $post ){
    update_post_meta( $id, 'product_extra', $_POST['product_extra'] );
    update_post_meta( $id, 'product_min_qty', $_POST['product_min_qty'] );
    update_post_meta( $id, 'product_max_qty', $_POST['product_max_qty'] );
 
}


function product_min_qty($product_id = '', $_product = array()){
    global $product;
    if( !empty($product_id) ){
        $get_id = $product_id;
    }
    else{
        $get_id = $product->get_id();
    }
    if( !empty($_product) && $_product ){
        $product = $_product;
    }

    $minQty = get_post_meta( $get_id, 'product_min_qty', true );
    if( !empty($minQty) && $minQty > 0 ){
        $get_min_purchase_qty = $minQty;
    }else{
        $get_min_purchase_qty = $product->get_min_purchase_quantity();
    }
    return $get_min_purchase_qty;
}
function product_max_qty($product_id = '', $_product = array()){
    global $product;
    if( !empty($product_id) ){
        $get_id = $product_id;
    }
    else{
        $get_id = $product->get_id();
    }

    if( !empty($_product) && $_product ){
        $product = $_product;
    }
    
    $maxQty = get_post_meta( $get_id, 'product_max_qty', true );
    if( !empty($maxQty) && $maxQty > 0 ){
        $get_max_purchase_qty = $maxQty;
    }else{
        $get_max_purchase_qty = $product->get_max_purchase_quantity();
    }
    return $get_max_purchase_qty;
}
function projectnamespace_woocommerce_text( $translated, $text, $domain ) {
    if ( $domain === 'woocommerce' ) {
        $translated = str_replace(
            array(
                'Apply coupon',
                'Proceed to checkout',
                'Subtotal',
                'Total'
            ),
            array(
                'Verzilver',
                'ik ga bestellen',
                'Subtotaal',
                'Totaal'
            ),
            $translated
        );
    }
    return $translated;
}

add_filter( 'gettext', 'projectnamespace_woocommerce_text', 30, 3 );

function start_modify_html() {
   ob_start();
}

function end_modify_html() {
   $html = ob_get_clean();
   /*$html = str_replace( 'Kies een bedrag', 'Bedrag', $html );
   $html = str_replace( 'Message', 'Aangepast bericht', $html );
   $html = str_replace( 'Dit is een verplicht veld', 'Controleer dit veld', $html );*/
   echo $html;
}

add_action( 'wp_head', 'start_modify_html' );
add_action( 'wp_footer', 'end_modify_html' );

remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message');
add_action( 'woocommerce_cart_is_empty', 'woo_if_cart_empty' );
function woo_if_cart_empty(){
    echo '<div class="cart-is-emtpy">';
        echo '<div class="cie-icon"><img src="'.THEME_URI.'/assets/images/bag-icon.svg"/></div>';
        echo '<strong>'.__('Uw winkelwagen is leeg!', 'thelene').'</strong>';
        echo '<p>'.__('Je hebt geen artikelen in je winkelwagen.', 'thelene').'</p>';
    echo '</div>';
}

/**
 * @snippet       Display Coupon under Proceed to Checkout Button @ WooCommerce Cart
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=81542
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.1
 */
 
add_action( 'woocommerce_proceed_to_checkout', 'bbloomer_display_coupon_form_below_proceed_checkout', 10 );
 
function bbloomer_display_coupon_form_below_proceed_checkout() {
   ?> 
      <form class="woocommerce-coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
         <?php if ( wc_coupons_enabled() ) { ?>
            <div class="coupon under-proceed">
               <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Heb je een kortingscode?', 'woocommerce' ); ?>" style="width: 100%" /> 
               <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" style="width: 100%"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
            </div>
         <?php } ?>
      </form>
   <?php
}

add_filter('gettext', 'x_translated_text' );
function x_translated_text($translated) {
$your_translation = 'Insert your translation here';
$translated = str_ireplace("I’ve read and accept", $your_translation, $translated);
return $translated;
}
add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );
function misha_remove_my_account_links( $menu_links ){
 // we will hook "anyuniquetext123" later
    unset( $menu_links['gift-cards'] ); // Addresses
    unset( $menu_links['edit-address'] ); // Addresses
    unset( $menu_links['dashboard'] ); // Remove Dashboard
    unset( $menu_links['payment-methods'] ); // Remove Payment Methods
    unset( $menu_links['orders'] ); // Remove Orders
    unset( $menu_links['downloads'] ); // Disable Downloads
    unset( $menu_links['edit-account'] ); // Remove Account details tab
    unset( $menu_links['customer-logout'] ); // Remove Logout link

    $menu_links['orders'] = 'Bestellingen';
    $menu_links['winkelmandje'] = 'Winkelmandje';
    $menu_links['edit-account'] = 'ACCOUNT info';
    $menu_links['customer-logout'] = 'uitloggen';
    return $menu_links;
 
}


/**
    Set gift card category
*/
function assign_gift_card_cat(){
    $gift_cat = array('geschenken');
    if( !empty($gift_cat) )
        return $gift_cat;
    else
        return false;
}

/**
 * Exclude products from a particular category on the shop page
 */
function custom_pre_get_posts_query( $q ) {
    if ( ! $q->is_main_query() ) return;
    if ( ! $q->is_post_type_archive() ) return;

    if ( ! is_admin() && is_shop() && assign_gift_card_cat() ) {
        $tax_query = (array) $q->get( 'tax_query' );

        $tax_query[] = array(
               'taxonomy' => 'product_cat',
               'field' => 'slug',
               'terms' => assign_gift_card_cat(), // Don't display products in the clothing category on the shop page.
               'operator' => 'NOT IN'
        );


        $q->set( 'tax_query', $tax_query );
    }
}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );  

/**
    Myaccount body class
*/
add_filter( 'body_class', 'cbv_wc_custom_class' );
function cbv_wc_custom_class( $classes ) {
    global $woocommerce;
    if( strpos($_SERVER['REQUEST_URI'], "winkelmandje") !== false && is_account_page() && is_user_logged_in()){
        $classes[] = 'loggedin-winkelmandje-crtl';
    }elseif( is_account_page() && !is_user_logged_in() ){
        $classes[] = 'login-register';
    }elseif( is_account_page() && is_user_logged_in() && is_wc_endpoint_url( 'orders' ) ){
        $classes[] = 'woocommerce-orders';
    }elseif( is_account_page() && is_user_logged_in() &&  is_wc_endpoint_url( 'edit-account' )) {
        $classes[] = 'woocommerce-edit-account';
    }elseif( is_account_page() && is_user_logged_in() && !is_endpoint()) {
        $classes[] = 'loggedin-deshboard-crtl';
    }
    
    if( is_cart() && WC()->cart->cart_contents_count == 0){
        $classes[]='empty-cart';
    }
    if( is_checkout()){
        $classes[]='woocommerce-checkout';
    }
    if( isset($_GET['action']) && $_GET['action']=='registration'){
        $classes[]='hide-account-title';
    }
    return $classes;
}

function is_endpoint(){
    if( strpos($_SERVER['REQUEST_URI'], "winkelmandje") !== false || is_wc_endpoint_url( 'orders' ) || is_wc_endpoint_url( 'edit-account' )){
        return true;
    }
}

/**
    Tabel price display
*/
add_filter( 'woocommerce_cart_item_price', 'cbv__change_cart_table_price_display', 30, 3 );
function cbv__change_cart_table_price_display( $price, $values, $cart_item_key ) {
    $slashed_price = $values['data']->get_price_html();
    $is_on_sale = $values['data']->is_on_sale();
    if ( $is_on_sale ) {
        $price = $slashed_price;
    }
    return $price;
}

add_action( 'woocommerce_cart_calculate_fees','add_custom_surcharge', 10, 1 );
function add_custom_surcharge( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    $state = array('BE', 'NL');
    if ( in_array( WC()->customer->get_billing_country(), $state ) ) {
       if(WC()->cart->get_subtotal() >= 40){
        $surcharge  = 0;
       }else{
        $surcharge  = 6;
       }
       $cart->add_fee( 'Verzending', $surcharge, true );
    }else{
        $surcharge  = 6;
        $cart->add_fee( 'Verzending', $surcharge, true );
    }}


/**
    Empty cart items
*/
add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
    if ( isset( $_GET['clear-cart'] ) && esc_html($_GET['clear-cart']) == 'yes' ) {
        global $woocommerce;
        $woocommerce->cart->empty_cart();
        wp_redirect( esc_url( wc_get_cart_url() ) );
        exit();
    }
}

/**
Add a body class when cart is empty
*/
/*function tristup_body_classes( $classes ){
    global $woocommerce;
    if( is_cart() && WC()->cart->cart_contents_count == 0){
        $classes[]='empty-cart';
    }
    return $classes;
}
add_filter( 'body_class', 'tristup_body_classes' );*/

/**
 * Process the checkout
 **/

add_action('woocommerce_checkout_process', 'cw_custom_process_checkbox');
function cw_custom_process_checkbox() {
    global $woocommerce;
    if (!$_POST['accept_condition'])
        wc_add_notice( __( 'Please accept conditions to proceed with your order' ), 'error' );
}


add_action('woocommerce_checkout_update_order_meta', 'cw_checkout_order_meta');
function cw_checkout_order_meta( $order_id ) {
    if ($_POST['accept_condition']) update_post_meta( $order_id, 'Accept Condition', esc_attr($_POST['accept_condition']));
}

add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
    return '';
}

add_action('woocommerce_giftcard_form', 'cbv_wc_giftcard_form');

function cbv_wc_giftcard_form(){
    wc_get_template_part('templates/giftcard-form');
}

add_action('woocommerce_before_add_to_cart_form', 'selected_variation_price_replace_variable_price_range');
function selected_variation_price_replace_variable_price_range(){
    global $product;

    if( $product->is_type('variable') ):
        echo '<span id="variable_price" style="display:none;">'.$product->get_price_html().'</span>';
    ?><style> .woocommerce-variation-price {display:none;} </style>
    <script>
    jQuery(function($) {
        var p = '.woocommerce-variation-price span.price'
            q = $(p).html();
            defprice = $("#variable_price").html();

        $('form.cart').on('show_variation', function( event, data ) {

            if ( data.price_html ) {
                $(".single-price-total").html(data.price_html);
            }
        }).on('hide_variation', function( event ) {
            $(".single-price-total").html(defprice);
            $(p).html(q);
        });
    });
    </script>
    <?php
    endif;
}
add_filter( 'woocommerce_checkout_fields' , 'remove_postcode_validation', 99 );
function remove_postcode_validation( $fields ) {
    unset($fields['billing']['billing_postcode']['validate']);
    unset($fields['shipping']['shipping_postcode']['validate']);
    
    return $fields;
}
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action('cbv_wc_cross_sell_display', 'woocommerce_cross_sell_display');
include_once(THEME_DIR .'/inc/wc-manage-fields.php');