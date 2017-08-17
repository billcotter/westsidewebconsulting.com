<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

apspp_woo_init();

function apspp_woo_init(){

	if ( class_exists( 'WooCommerce' )){

	$count_posts = wp_count_posts('product');
	$published_posts = $count_posts->publish;
	if ( $published_posts > 0 ){
		//The woo_dl menu
		$aps_which_option_is_selected = get_site_option('apspp_radio_woo');
		if ( $aps_which_option_is_selected[0] == 'option1') {
			add_action( 'admin_bar_menu', 'apspp_woocom', 998 );
			add_action('apspp_extra_styles', 'apspp_woo_pg_extra_styles', 10);

		}
	}
	}
}

function apspp_woocom( $wp_admin_bar ) {

global $admin_url;


	if (!isset($wooproduct_list)){
			global $wooproduct_list;
			global $newquery;
			$wooproduct_list = apspider_get_list_of_pages(
							$post_type_slug = 'product',
							$order_by = 'post_date',
							$sort = 'DESC',
							$parent_heirarchy = 'false');
			$newquery = null;
		}




	apspider_create_menu(
		$wp_admin_bar,
		$wooproduct_list,
		$menu_name = 'WooProducts',
		$menu_href = null,
		$menu_hover = null,


		$view_all_item_name = __( 'View All Products' , 'admin-page-spider' ),
		$view_all_item_href = $admin_url . 'edit.php?post_type=product',

		$unique_slug = 'apspp_woo_pg',
		$option_name = 'apspp_woo_name',

		$post_title_suffix = 'date',

		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid = $admin_url . 'post.php?post=' . 'adminpgspiderID' . '&action=edit'
		);
}



//Adds an edit pencil to the Edit Page menu item
function apspp_woo_pg_extra_styles(){
	echo '#wp-admin-bar-apspider_apspp_woo_pg>a:before, #wp-admin-bar-apspider_apspp_woo_pg>div.ab-empty-item:before{content: "\e03d"; font-family: WooCommerce !important; top: 2px;}' ;
}