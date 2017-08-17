<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

microthemer_init();

function microthemer_init(){

	if ( class_exists( 'tvr_microthemer_frontend') or class_exists( 'tvr_microthemer_admin')) {

	//Adds a "Edit In microthemer" menu to adminbar
		$aps_which_option_is_selected = get_site_option('apspp_radio_microthemer');
		if ( ! empty ( $aps_which_option_is_selected[0] )){
			if ($aps_which_option_is_selected[0] == 'option1') {
				add_action( 'admin_bar_menu', 'apspp_microthemer', 998 );
				add_action('admin_head', 'apspp_microthemer_js', 10);
				add_action('wp_head', 'apspp_microthemer_js', 10);
				add_action('apspp_extra_styles', 'apspp_microthemer_extra_styles', 10);

				$opts = get_site_option("preferences_themer_loader");
				if ($opts['admin_bar_shortcut'] == "1")
				{
					$opts['admin_bar_shortcut'] = "0";
					update_site_option('preferences_themer_loader', $opts);
				}

			}
		}
	}
}

function apspp_microthemer( $wp_admin_bar ) {

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
		$menu_name = 'Microthemer',
		$menu_href = null,
		$menu_hover = null,


		$view_all_item_name = null,
		$view_all_item_href = null,

		$unique_slug = 'microthemer',
		$option_name = 'apspp_microthemer_name',

		$post_title_suffix = null,
		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid = $admin_url .'admin.php?page=tvr-microthemer.php'
		);
}





//javascript gets the page url from the menu and then applies a sessionStorage value which then whenever the iframe appears, it changes the href to the appropriate page.
function apspp_microthemer_js(){
	echo "<script>
	(function($){
		jQuery(document).ready(function(){
			var data = 1;
			var urikey = 1;
			jQuery('#wp-admin-bar-apspider_microthemer-default>li>a').on('click', function(e){
				urikey = jQuery(this).parent().find('.apspider_highlighted_view>a').attr('href');
				sessionStorage.setItem('urikey', urikey);
			});

			jQuery('#viframe').ready(function(){
				var data = sessionStorage.getItem('urikey');
				jQuery('#viframe').attr('src', data);
				jQuery('#viframe').attr('rel', data);
			});
		});
	})(jQuery);
</script>";
}

//Adds an edit pencil to the Edit Page menu item
function apspp_microthemer_extra_styles(){
	echo '#wp-admin-bar-apspider_microthemer>a:before, #wp-admin-bar-apspider_microthemer>div.ab-empty-item:before{content: "\f309"; top: 2px;}' ;
}