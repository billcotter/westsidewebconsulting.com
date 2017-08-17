<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

apspp_edd_downloads_init();

function apspp_edd_downloads_init(){
	if ( class_exists( 'Easy_Digital_Downloads' )){
	$count_posts = wp_count_posts('download');
	$published_posts = $count_posts->publish;
	if ( $published_posts > 0 ){

	//The edd_dl menu
		$aps_which_option_is_selected = get_site_option('apspp_radio_edd_downloads');
		if ( $aps_which_option_is_selected[0] == 'option1') {
			add_action( 'admin_bar_menu', 'apspp_edd_dls', 998 );
			add_action('apspp_extra_styles', 'apspp_edd_extra_styles', 10);

		}
	}
	}
}

//Adds a "edd_dl Templates" menu to adminbar
function apspp_edd_dls( $wp_admin_bar ) {

global $admin_url;

	if (!isset($downloads_list)){
			global $downloads_list;
			global $newquery;
			$downloads_list = apspider_get_list_of_pages(
							$post_type_slug = 'download',
							$order_by = 'post_date',
							$sort = 'DESC',
							$parent_heirarchy = 'false');
			$newquery = null;
		}



	apspider_create_menu(
		$wp_admin_bar,
		$downloads_list,
		$menu_name = 'Downloads',
		$menu_href = null,
		$menu_hover = null,

		$view_all_item_name = __( 'View All Downloads' , 'admin-page-spider' ),
		$view_all_item_href = $admin_url . 'edit.php?post_type=download',

		$unique_slug = 'apspp_edd_pg',
		$option_name = 'apspp_edd_downloads_name',

		$post_title_suffix = 'date',

		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid = $admin_url . 'post.php?post=' . 'adminpgspiderID' . '&action=edit'
		);
}


//Adds an edit pencil to the Edit Page menu item
function apspp_edd_extra_styles(){
	echo '#wp-admin-bar-apspider_apspp_edd_pg>a:before, #wp-admin-bar-apspider_apspp_edd_pg>div.ab-empty-item:before{content: "\f316"; top: 2px;}' ;
}