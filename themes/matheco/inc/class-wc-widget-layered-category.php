<?php
/**
 * Layered nav widget
 *
 * @package WooCommerce\Widgets
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Widget layered nav class.
 */
class WC_Widget_Layered_Category extends WC_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_layered_nav woocommerce-widget-layered-nav';
		$this->widget_description = __( 'Display a list of category to filter products in your store.', 'woocommerce' );
		$this->widget_id          = 'test_woocommerce_layered_nav';
		$this->widget_name        = __( 'Test Filter Products by Category', 'woocommerce' );
		parent::__construct();
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * @see WP_Widget->update
	 *
	 * @param array $new_instance New Instance.
	 * @param array $old_instance Old Instance.
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$this->init_settings();
		return parent::update( $new_instance, $old_instance );
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @see WP_Widget->form
	 *
	 * @param array $instance Instance.
	 */
	public function form( $instance ) {
		$this->init_settings();
		parent::form( $instance );
	}

	/**
	 * Init settings after post types are registered.
	 */
	public function init_settings() {
		$attribute_array      = array();
		$std_attribute        = '';

		$this->settings = array(
			'title'        => array(
				'type'  => 'text',
				'std'   => __( 'Filter by', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' ),
			),
			'attribute'    => array(
				'type'    => 'select',
				'std'     => 'Product Category',
				'label'   => __( 'Category', 'woocommerce' ),
				'options' => array('product_cat'=>'Product Category'),
			),
		);
	}

	/**
	 * Get this widgets taxonomy.
	 *
	 * @param array $instance Array of instance options.
	 * @return string
	 */
	protected function get_instance_taxonomy( $instance ) {
		return 'product_cat';
	}

	/**
	 * Get this widgets query type.
	 *
	 * @param array $instance Array of instance options.
	 * @return string
	 */
	protected function get_instance_query_type( $instance ) {
		return isset( $instance['query_type'] ) ? $instance['query_type'] : 'and';
	}

	/**
	 * Get this widgets display type.
	 *
	 * @param array $instance Array of instance options.
	 * @return string
	 */
	protected function get_instance_display_type( $instance ) {
		return isset( $instance['display_type'] ) ? $instance['display_type'] : 'list';
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args Arguments.
	 * @param array $instance Instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! is_shop() && ! is_product_taxonomy() ) {
			return;
		}
		$taxonomy           = $this->get_instance_taxonomy( $instance );
		$query_type         = $this->get_instance_query_type( $instance );
		$display_type       = $this->get_instance_display_type( $instance );

		if ( ! taxonomy_exists( $taxonomy ) ) {
			return;
		}

		$terms = get_terms( $taxonomy, array( 'hide_empty' => '1' ) );

		if ( 0 === count( $terms ) ) {
			return;
		}

		ob_start();

		$this->widget_start( $args, $instance );

		$found = $this->layered_nav_list( $terms, $taxonomy, $query_type );

		$this->widget_end( $args );

		if ( ! $found ) {
			ob_end_clean();
		} else {
			echo ob_get_clean(); // @codingStandardsIgnoreLine
		}
	}

	/**
	 * Return the currently viewed taxonomy name.
	 *
	 * @return string
	 */
	protected function get_current_taxonomy() {
		return is_tax() ? get_queried_object()->taxonomy : '';
	}

	/**
	 * Return the currently viewed term ID.
	 *
	 * @return int
	 */
	protected function get_current_term_id() {
		return absint( is_tax() ? get_queried_object()->term_id : 0 );
	}

	/**
	 * Return the currently viewed term slug.
	 *
	 * @return int
	 */
	protected function get_current_term_slug() {
		return absint( is_tax() ? get_queried_object()->slug : 0 );
	}


	/**
	 * Wrapper for WC_Query::get_main_tax_query() to ease unit testing.
	 *
	 * @since 4.4.0
	 * @return array
	 */
	protected function get_main_tax_query() {
		return WC_Query::get_main_tax_query();
	}

	/**
	 * Wrapper for WC_Query::get_main_search_query_sql() to ease unit testing.
	 *
	 * @since 4.4.0
	 * @return string
	 */
	protected function get_main_search_query_sql() {
		return WC_Query::get_main_search_query_sql();
	}

	/**
	 * Wrapper for WC_Query::get_main_search_queryget_main_meta_query to ease unit testing.
	 *
	 * @since 4.4.0
	 * @return array
	 */
	protected function get_main_meta_query() {
		return WC_Query::get_main_meta_query();
	}

	/**
	 * Show list based layered nav.
	 *
	 * @param  array  $terms Terms.
	 * @param  string $taxonomy Taxonomy.
	 * @param  string $query_type Query Type.
	 * @return bool   Will nav display?
	 */
	protected function layered_nav_list( $terms, $taxonomy, $query_type ) {
		// List display.
		$base_link = $this->get_current_page_url();
		echo '<form id="cat_filterform" data-url="'.$base_link.'"><ul id="cat_filter">';
		$filter_name = 'filter_cats';
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array();
		$current_filter = array_map( 'sanitize_title', $current_filter );
		$min_max = isset( $_GET['min_price'] ) ? true : false;
		$found = true;
		
		if( $min_max ){
			echo '<span style="display:none;" id="minMaxPrice" data-minmax="1"></span>';
		}
		foreach ( $terms as $term ) {
			$checked = (in_array($term->term_id, $current_filter))?'checked':'';
			$active_class = (in_array($term->term_id, $current_filter))?' class="term-active"':'';
			echo '<li'.$active_class.'><lable for="term_'.$term->slug.'"><input '.$checked.' type="checkbox" id="term_'.$term->slug.'" name="filter_cats" value="' . $term->term_id . '"> '.$term->name.'</label></li>';
		}

		echo '</ul></form>';

		return $found;
	}
}

function cbv_wc_category_Layered_widget() {
    register_widget( 'WC_Widget_Layered_Category' );
}
add_action( 'widgets_init', 'cbv_wc_category_Layered_widget' );