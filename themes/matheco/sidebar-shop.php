<div class="product-page-sidebar">
  <div class="sidebar-content">
    <div class="filter-prdt">
      <h6 class="fl-h6 fltr-prdt-title"><?php esc_html_e( 'FILTER PRODUCTEN', 'woocommerce' ); ?></h6>
    </div>
    <div class="filter-sidebar">
      <?php if ( is_active_sidebar( 'shop-widget' ) ) : ?>
        <?php dynamic_sidebar( 'shop-widget' ); ?>
      <?php endif; ?>
    </div>
  </div>
</div> 