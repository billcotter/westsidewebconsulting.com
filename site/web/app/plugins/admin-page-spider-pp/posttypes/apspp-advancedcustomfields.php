<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


function apspp_acf_is_active() {
	if ( class_exists('acf')){
		apspp_acf_init();
	}
}
add_action( 'wp_loaded', 'apspp_acf_is_active',99);


function apspp_acf_init(){
	//Adds a "Edit In acf" menu to adminbar
	$aps_which_option_is_selected = get_site_option('apspp_radio_acf_pg');
	if ( ! empty ( $aps_which_option_is_selected[0] )){
		if ($aps_which_option_is_selected[0] == 'option1') {
			add_action( 'admin_bar_menu', 'apspp_acf', 998 );
			add_action('apspp_extra_styles', 'apspp_acf_extra_styles', 10);
		}
	}
}


function apspp_acf( $wp_admin_bar ) {

	global $admin_url;


	if (!isset($apspp_acf_list)){
			global $newquery;
			global $apspp_acf_list;
			$apspp_acf_list = apspider_get_list_of_pages(
							$post_type_slug = 'acf-field-group\' OR post_type = \'acf',
							$order_by = 'post_date',
							$sort = 'DESC',
							$parent_heirarchy = 'false');
			$newquery = null;
		}



	apspider_create_menu(
		$wp_admin_bar,
		$apspp_acf_list,

		$menu_name = 'ACF',
		$menu_href = null,
		$menu_hover = null,

		$view_all_item_name = __( 'View All' , 'admin-page-spider' ),
		$view_all_item_href = $admin_url . 'edit.php?post_type=acf',

		$unique_slug = 'acf',
		$option_name = 'apspp_acf_name',

		$post_title_suffix = 'date',

		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid =  $admin_url . 'post.php?post='. 'adminpgspiderID'.'&action=edit'
		);

}

//Adds an edit pencil to the Edit Page menu item
function apspp_acf_extra_styles(){
	echo '#wp-admin-bar-apspider_acf>a:before, #wp-admin-bar-apspider_acf>div.ab-empty-item:before{content: "\f111"; top: 2px;}' ;
}