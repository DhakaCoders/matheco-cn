<?php
defined( 'ABSPATH' ) || exit;
if(! empty($_GET['pageno']) && is_numeric($_GET['pageno']) ){
    $paged = $_GET['pageno'];
}else{
    $paged = 1;
}
$posts_per_page = 3;

$all_orders = get_posts(
apply_filters(
  'woocommerce_my_account_my_orders_query',
  array(
    'numberposts' => -1,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => wc_get_order_types( 'view-orders' ),
    'post_status' => array_keys( wc_get_order_statuses() )
  )
)
);

//how many total posts are there?
$order_count = count($all_orders);

//how many pages do we need to display all those posts?
$num_pages = ceil($order_count / $posts_per_page);

//let's make sure we don't have a page number that is higher than we have posts for
if($paged > $num_pages || $paged < 1){
    $paged = $num_pages;
}


$customer_orders = get_posts(
apply_filters(
  'woocommerce_my_account_my_orders_query',
  array(
    'numberposts' => $posts_per_page,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => wc_get_order_types( 'view-orders' ),
    'post_status' => array_keys( wc_get_order_statuses() ),
        'paged'       => $paged
  )
)
);
?>
<div class="customer-order-details">
<?php
if ( $customer_orders ) :
?>
<div class="faq-accordion-wrp cbvmyaccount">
    <ul class="clearfix reset-list orders-list">
        <?php
    foreach ( $customer_orders as $customer_order ) :
      $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
      $item_count = $order->get_item_count();
    ?>
        <li>
        <div class="orders-crtl">
        <time class="my-ac-time" datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created(), 'd F Y' ) ); ?></time>
      <div class="code-text">
        <?php echo __('Bestelnummer', 'woocommerce' ) . ' '.$order->get_order_number(); ?>
      </div>
          <span></span>
          <div class="order-details">
            <?php 
              $order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
              if( $order_items ):
            ?>
            <div class="myac-pro-grds">
                <?php 
                foreach ( $order_items as $item_id => $item ) {
                $product = $item->get_product();
                $itemImgID = get_post_thumbnail_id($product->get_id());
                if( empty($itemImgID) ){
                    $itemImgID = get_post_thumbnail_id($product->get_parent_id());
                }
                $order_img = cbv_get_image_tag( $itemImgID, 'thumbnail' );
                    $qty = $item->get_quantity();
                $refunded_qty = $order->get_qty_refunded_for_item( $item_id );
                if ( $refunded_qty ) {
                  $qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
                } else {
                  $qty_display = esc_html( $qty );
                }
                $formatted_meta_data = $item->get_formatted_meta_data( '_', true );
                ?>
              <div class="myac-pro-grd-item">
                <div class="myac-pro-grd-item-inr">
                  <div class="myac-pro-grd-img">
                    <?php echo $order_img; ?>
                  </div>
                  <div class="order-items-desc">
                  <h5>
                  	<?php
            						$exp_title = explode('-', $item->get_name());
            						if(!empty($exp_title)){
            							$cart_title = $exp_title[0];
            						}else{
            							$cart_title = $item->get_name();
            						}
                  	    echo $cart_title; ?>
                    </h5>
                    <div class="order-comment">
                      <p>Volutpat sagittis, consequat nibh.</p>
                    </div>
                  <?php 
                  if ($formatted_meta_data) :
                  echo '<div class="formateted-meta"><ul>';
                      foreach ($formatted_meta_data as $key => $data) :
                        echo '<li><strong>'.$data->display_key.':</strong> <span>'.$data->display_value.'</span></li>';
                    endforeach;
                    echo '</ul></div>';
                  endif;
                  ?>
                  <div class="product-price">
                    <?php echo $product->get_price_html(); ?>
                  </div>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <?php endif; ?>
			<?php 
			echo "<div class='order-status color-green'>";
			echo "<label>Status:</label> ";
			echo esc_html( wc_get_order_status_name( $order->get_status() ) );
			echo "</div>";
			?>
          </div>
          <div class="contact-info">
          	<i></i>
          	<div>
          		<a class="order-contact-btn" href="<?php echo get_link_by_page_template( 'page-contact.php' ); ?>" target="_blank">CONTACT</a>
          	</div>
          </div>
        </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<div class="fl-pagi-cntlr order-pagi-crtl">
<?php
    //we need to display some pagination if there are more total posts than the posts displayed per page
    if($order_count > $posts_per_page ){

        echo '<ul class="reset-list page-numbers">';

        if($paged > 1){
            echo '<li><a class="prev page-numbers" href="?pageno=1">←</a></li>';
        }else{
            echo '<li><span>←</span></li>';
        }

        for($p = 1; $p <= $num_pages; $p++){
            if ($paged == $p) {
                echo '<li><span class="page-numbers current">'.$p.'</span></li>';
            }else{
                echo '<li><a class="page-numbers" href="?pageno='.$p.'">'.$p.'</a></li>';
            }
        }

        if($paged < $num_pages){
            echo '<li><a class="next page-numbers" href="?pageno='.$num_pages.'">→</a></li>';
        }else{
            echo '<li><span>→</span></li>';
        }

        echo '</ul>';
    }
?>
</div>
<?php else: ?>
  <div class="no-results"><p>Geen bestellingen.</p></div>
<?php endif; ?>
</div>