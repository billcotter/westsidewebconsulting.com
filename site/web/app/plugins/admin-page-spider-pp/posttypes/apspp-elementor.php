<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

apspp_elementor_pages_init();

function apspp_elementor_pages_init(){
	if ( class_exists( 'Elementor\Plugin' )){
	//The elementor_dl menu
		$aps_which_option_is_selected = get_site_option('apspp_radio_elementor_pg');
		if ( $aps_which_option_is_selected[0] == 'option1') {
			add_action( 'admin_bar_menu', 'apspp_elementor_pgs', 998 );

		add_action('apspp_extra_styles', 'apspp_elementor_extra_styles', 10);
		}

	}
}

//Adds a "elementor_dl Templates" menu to adminbar
function apspp_elementor_pgs( $wp_admin_bar ) {
	global $admin_url;

	if (!isset($page_list)){
		global $page_list;
		global $newquery;
			$page_list = apspider_get_list_of_pages(
							$post_type_slug = 'page',
							$order_by = 'post_parent ASC, menu_order',
							$sort = 'ASC');
			$newquery = null;
	}

	apspider_create_menu(
		$wp_admin_bar,
		$page_list,
		$menu_name = 'Elementor Pages',

		$menu_href = null,
		$menu_hover = null,

		$view_all_item_name = __( 'View All Pages' , 'admin-page-spider' ),
		$view_all_item_href = $admin_url. 'edit.php?post_type=page',

		$unique_slug = 'elementor_pg',
		$option_name = 'apspp_elementor_pg_name',

		$post_title_suffix = null,
		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid = 'adminpgspiderurl'. 'adminpagespiderparam_marker_type' . 'elementor'
		);

}

//Hides the default menu
function apspp_elementor_extra_styles(){

	echo '#wp-admin-bar-elementor_edit_page{display: none;}
	#wp-admin-bar-apspider_elementor_pg>a:before,
	#wp-admin-bar-apspider_elementor_pg>div.ab-empty-item:before{content: "\f116";top: 2px;}' ;

}