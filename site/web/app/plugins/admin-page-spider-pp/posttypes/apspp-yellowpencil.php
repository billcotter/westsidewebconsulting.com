<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


function apspp_yellowpencil_is_active() {
	if ( apspp_plugin_is_active('waspthemes-yellow-pencil', 'yellow-pencil') ||
		apspp_plugin_is_active('yellow-pencil-visual-theme-customizer', 'yellow-pencil')){
		apspp_yellowpencil_init();
	}
}
add_action( 'wp_loaded', 'apspp_yellowpencil_is_active',99);


function apspp_yellowpencil_init(){
	//Adds a "Edit In yellowpencil" menu to adminbar
	$aps_which_option_is_selected = get_site_option('apspp_radio_yellowpencil_pg');
	if ( ! empty ( $aps_which_option_is_selected[0] )){
		if ($aps_which_option_is_selected[0] == 'option1') {
			add_action( 'admin_bar_menu', 'apspp_yellowpencil', 998 );
			add_action('apspp_extra_styles', 'apspp_yellowpencil_extra_styles', 10);
		}
	}
}


function apspp_yellowpencil( $wp_admin_bar ) {

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

		$menu_name = 'Yellow Pencil Pages',
		$menu_href = null,
		$menu_hover = null,

		$view_all_item_name = __( 'View All Pages' , 'admin-page-spider' ),
		$view_all_item_href = $admin_url . 'edit.php?post_type=page',

		$unique_slug = 'yellowpencil',
		$option_name = 'apspp_yellowpencil_pg_name',

		$post_title_suffix = null,

		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid =  $admin_url . "admin.php?page=yellow-pencil-editor&href=". 'adminpgspiderurl'
		);

}

//Adds an edit pencil to the Edit Page menu item
function apspp_yellowpencil_extra_styles(){
	echo '#wp-admin-bar-apspider_yellowpencil>a:before, #wp-admin-bar-apspider_yellowpencil>div.ab-empty-item:before{content: "\f309"; top: 2px;}' ;
}