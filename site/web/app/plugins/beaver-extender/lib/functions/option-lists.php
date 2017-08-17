<?php
/**
 * Builds many of the admin options drop-down lists.
 *
 * @package Extender
 */

/**********
CSS Builder Elements
           **********/

/**
 * Build main Elements Selector option list.
 *
 * @since 1.0.0
 * @return main Elements Selector option array.
 */
function beaver_extender_css_builder_elements_array() {
	
	$beaver_extender_css_builder_elements = array(
		'Page Elements' => 'page',
		'Containers' => 'inner',
		'Top Bar' => 'top_bar',
		'Header' => 'header',
		'Header Menu' => 'header_menu',
		'Main Content' => 'main_content',
		'Sidebar' => 'sidebar',
		'Comments' => 'comments',
		'Comments Respond' => 'comment_respond',
		'Custom Widget Areas' => 'custom_widget_areas',
		'Footer' => 'footer',
		'Images/Alignment' => 'images_alignment'
	);
	
	return $beaver_extender_css_builder_elements;
	
}

/**
 * Build main Elements Selector option menu.
 *
 * @since 1.0.0
 */
function beaver_extender_build_css_builder_elements_menu( $selected = '' ) {
	
	$beaver_extender_css_builder_elements_array = beaver_extender_css_builder_elements_array();
	
	foreach( $beaver_extender_css_builder_elements_array as $element_type => $elements ) {
		
		$option = '<option value="' . $elements . '"';
			
		if ( $elements == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $element_type . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build Page CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Page CSS elements array.
 */
function beaver_extender_page_elements_array() {
	
	$beaver_extender_page_elements_array = array(
		'-- Page Elements --' => array(
			'Body' => '/* Body */' . "\n" . 'body',
			'Universal Link' => '/* Universal Link */' . "\n" . 'a',
			'Universal Link Hover' => '/* Universal Link Hover */' . "\n" . 'a:hover, a:focusS',
			'Universal Headings' => '/* Universal Headings */' . "\n" . 'h1, h2, h3, h4, h5, h6',
			'Universal Menus' => '/* Universal Menus */' . "\n" . '.fl-page-nav',
			'Page Container' => '/* Page Container */' . "\n" . '.fl-page'
		)
	);
	
	return $beaver_extender_page_elements_array;
	
}

/**
 * Build Top Bar CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Top Bar CSS elements array.
 */
function beaver_extender_top_bar_elements_array() {
	
	$beaver_extender_top_bar_elements_array = array(
		'-- Top Bar --' => array(
			'Tob Bar' => '/* Top Bar */' . "\n" . '.fl-page-bar',
			'Top Bar Container' => '/* Top Bar Container */' . "\n" . '.fl-page-bar-container',
			'Top Bar Row' => '/* Top Bar Row */' . "\n" . '.fl-page-bar-row',
			'Top Bar Text' => '/* Top Bar Text */' . "\n" . '.fl-page-bar-text',
			'Top Bar Menu' => '/* Top Bar Menu */' . "\n" . '.fl-page-bar-nav',
			'Top Bar Menu Page Link' => '/* Top Bar Menu Page Link */' . "\n" . '.fl-page-bar .navbar-nav > li > a',
			'Top Bar Menu Page Link Hover' => '/* Top Bar Menu Page Link Hover */' . "\n" . '.fl-page-bar .navbar-nav > li > a:hover, .fl-page-bar .navbar-nav > li > a:focus',
			'Top Bar Menu Current Page Link' => '/* Top Bar Menu Current Page Link */' . "\n" . '.fl-page-bar .navbar-nav > li.current-menu-item > a',
			'Top Bar Menu Sub-Page' => '/* Top Bar Menu Sub-Page */' . "\n" . '.fl-page-bar-nav > li > ul.sub-menu',
			'Top Bar Menu Sub-Page Link' => '/* Top Bar Menu Sub-Page Link */' . "\n" . '.fl-page-bar-nav > li > ul.sub-menu li a',
			'Top Bar Menu Sub-Page Link Hover' => '/* Top Bar Menu Sub-Page Link Hover */' . "\n" . '.fl-page-bar-nav > li > ul.sub-menu li a:hover'
		)
	);
	
	return $beaver_extender_top_bar_elements_array;
	
}

/**
 * Build Header CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Header CSS elements array.
 */
function beaver_extender_header_elements_array() {
	
	$beaver_extender_header_elements_array = array(
		'-- Header --' => array(
			'Header' => '/* Header */' . "\n" . '.fl-page-header',
			'Header Wrap' => '/* Header Wrap */' . "\n" . '.fl-page-header-wrap',
			'Title Area' => '/* Title Area */' . "\n" . '.fl-page-header-logo-col',
			'Site Title' => '/* Site Title */' . "\n" . '.fl-page-header-logo',
			'Site Title Link' => '/* Site Title Link */' . "\n" . '.fl-page-header a, .fl-page-header a *, .fl-page-header a.fa',
			'Site Title Link Hover' => '/* Site Title Link Hover */' . "\n" . '.fl-page-header a:hover, .fl-page-header a:focus, .fl-page-header a:hover *, .fl-page-header a:focus *, .fl-page-header a.fa:hover, .fl-page-header a.fa:focus',
			'Site Tagline' => '/* Site Tagline */' . "\n" . '.fl-page-header-text',
			'Logo Image Area' => '/* Logo Image Area */' . "\n" . '.fl-page-header-logo',
			'Logo Image' => '/* Logo Image */' . "\n" . '.fl-logo-image',
			'Header Social Icons' => '/* Header Social Icons */' . "\n" . '.fl-social-icons'
		)
	);
	
	return $beaver_extender_header_elements_array;
	
}

/**
 * Build Header Menu CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Header Menu CSS elements array.
 */
function beaver_extender_header_menu_elements_array() {
	
	$beaver_extender_header_menu_elements_array = array(
		'-- Header Menu --' => array(
			'Header Menu Wrap' => '/* Header Menu Wrap */' . "\n" . '.fl-page-nav-wrap',
			'Header Menu Container' => '/* Header Menu Container */' . "\n" . '.fl-page-nav-container',
			'Header Menu Nav' => '/* Header Menu Nav */' . "\n" . '.fl-page-nav',
			'Header Menu' => '/* Header Menu */' . "\n" . '.fl-page-nav .navbar-nav',
			'Header Menu Page Link' => '/* Header Menu Page Link */' . "\n" . '.fl-page-nav-wrap .navbar-nav > li > a',
			'Header Menu Page Link Hover' => '/* Header Menu Page Link Hover */' . "\n" . '.fl-page-nav-wrap .navbar-nav > li > a:hover',
			'Header Menu Current Page Link' => '/* Header Menu Current Page Link */' . "\n" . '.fl-page-nav-wrap .navbar-nav > li.current-menu-item > a',
			'Header Menu Sub-Page' => '/* Header Menu Sub-Page */' . "\n" . '.fl-page-nav ul.sub-menu',
			'Header Menu Sub-Page Link' => '/* Header Menu Sub-Page Link */' . "\n" . '.fl-page-nav ul.sub-menu li a',
			'Header Menu Sub-Page Link Hover' => '/* Header Menu Sub-Page Link Hover */' . "\n" . '.fl-page-nav ul.sub-menu li a:hover',
			'Header Menu Right Search' => '/* Header Menu Right Search */' . "\n" . '.fl-page-nav-search'
		)
	);
	
	return $beaver_extender_header_menu_elements_array;
	
}

/**
 * Build Main Content CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Main Content CSS elements array.
 */
function beaver_extender_main_content_elements_array() {
	
	$beaver_extender_main_content_elements_array = array(
		'-- Main Content --' => array(
			'Page Content' => '/* Page Content */' . "\n" . '.fl-page-content',
			'Content Container' => '/* Content Container */' . "\n" . '.fl-page-content .container',
			'Content' => '/* Content */' . "\n" . '.fl-content',
			'Content Article' => '/* Content Article */' . "\n" . '.fl-post',
			'Content Article Post' => '/* Content Article Post */' . "\n" . '.fl-post.post',
			'Content Article Page' => '/* Content Article Page */' . "\n" . '.fl-post.page',
			'Post Header' => '/* Content Header */' . "\n" . '.fl-post-header',
			'Post Title' => '/* Post Title */' . "\n" . '.fl-post-title',
			'Post Title Link' => '/* Post Title Link */' . "\n" . '.fl-post-title a',
			'Post Title Link Hover' => '/* Post Title Link Hover */' . "\n" . '.fl-post-title a:hover, .fl-post-title a:focus',
			'Post Meta Top' => '/* Post Meta Top */' . "\n" . '.fl-post-meta-top',
			'Post Meta Top Link' => '/* Post Meta Top Link */' . "\n" . '.fl-post-meta-top a',
			'Post Meta Top Link Hover' => '/* Post Meta Top Link Hover */' . "\n" . '.fl-post-meta-top a:hover, .fl-post-meta-top a:focus',
			'Post Content' => '/* Post Content */' . "\n" . '.fl-post-content',
			'Content Paragraph' => '/* Content Paragraph */' . "\n" . '.fl-post-content p',
			'Content Lists' => '/* Content Lists */' . "\n" . '.fl-post-content ul li, .fl-post-content ol li',
			'Content Link' => '/* Content Link */' . "\n" . '.fl-post-content a',
			'Content Link Hover' => '/* Content Link Hover */' . "\n" . '.fl-post-content a:hover, .fl-post-content a:focus',
			'Content Blockquote' => '/* Content Blockquote */' . "\n" . '.fl-post-content blockquote',
			'Content Blockquote Paragraph' => '/* Content Blockquote Paragraph */' . "\n" . '.fl-post-content blockquote p',
			'Content Blockquote Link' => '/* Content Blockquote Link */' . "\n" . '.fl-post-content blockquote a',
			'Content Blockquote Link Hover' => '/* Content Blockquote Link Hover */' . "\n" . '.fl-post-content blockquote a:hover, .fl-post-content blockquote a:focus',
			'Content Post H1' => '/* Content Post H1 */' . "\n" . '.fl-post-content h1',
			'Content Post H2' => '/* Content Post H2 */' . "\n" . '.fl-post-content h2',
			'Content Post H3' => '/* Content Post H3 */' . "\n" . '.fl-post-content h3',
			'Content Post H4' => '/* Content Post H4 */' . "\n" . '.fl-post-content h4',
			'Content Post H5' => '/* Content Post H5 */' . "\n" . '.fl-post-content h5',
			'Content Post H6' => '/* Content Post H6 */' . "\n" . '.fl-post-content h6',
			'Post Meta Bottom' => '/* Post Meta Bottom */' . "\n" . '.fl-post-meta-bottom',
			'Post Meta Bottom Link' => '/* Post Meta Bottom Link */' . "\n" . '.fl-post-meta-bottom a',
			'Post Meta Bottom Link Hover' => '/* Post Meta Bottom Link Hover */' . "\n" . '.fl-post-meta-bottom a:hover, .fl-post-meta-bottom a:focus',
			'Post Navigation' => '/* Post Navigation */' . "\n" . '.fl-post-page-nav',
			'Post Navigation Link' => '/* Post Navigation Link */' . "\n" . '.fl-post-page-nav a',
			'Post Navigation Link Hover' => '/* Post Navigation Link Hover */' . "\n" . '.fl-post-page-nav a:hover, .fl-post-page-nav a:focus'
		)
	);
	
	return $beaver_extender_main_content_elements_array;
	
}

/**
 * Build Sidebar CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Sidebar CSS elements array.
 */
function beaver_extender_sidebar_elements_array() {
	
	$beaver_extender_sidebar_elements_array = array(
		'-- Sidebar --' => array(
			'Sidebar' => '/* Sidebar */' . "\n" . '.fl-sidebar',
			'Sidebar Right' => '/* Sidebar Right */' . "\n" . '.fl-sidebar-right',
			'Sidebar Left' => '/* Sidebar Left */' . "\n" . '.fl-sidebar-left',
			'Sidebar Heading' => '/* Sidebar Heading */' . "\n" . '.fl-sidebar .fl-widget-title',
			'Sidebar Widget' => '/* Sidebar Widget */' . "\n" . '.fl-sidebar .fl-widget',
			'Sidebar Link' => '/* Sidebar Link */' . "\n" . '.fl-sidebar a',
			'Sidebar Link Hover' => '/* Sidebar Link Hover */' . "\n" . '.fl-sidebar a:hover, .fl-sidebar a:focus',
			'Sidebar UL/OL' => '/* Sidebar UL/OL */' . "\n" . '.fl-sidebar ul, .fl-sidebar ol',
			'Sidebar UL LI' => '/* Sidebar UL LI */' . "\n" . '.fl-sidebar ul li'
		)
	);
	
	return $beaver_extender_sidebar_elements_array;
	
}

/**
 * Build Comments CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Comments CSS elements array.
 */
function beaver_extender_comments_elements_array() {
	
	$beaver_extender_comments_elements_array = array(
		'-- Comments --' => array(
			'Comments' => '/* Comments */' . "\n" . '.fl-comments',
			'Comment List' => '/* Comment List */' . "\n" . '.fl-comments-list',
			'Comments Title' => '/* Comments Title */' . "\n" . '.fl-comments-list-title',
			'Comment Meta' => '/* Comment Meta */' . "\n" . '.comment-meta',
			'Comment Avatar' => '/* Comment Avatar */' . "\n" . '.comment-avatar',
			'Comment Author Link' => '/* Comment Author Link */' . "\n" . '.comment-author-link',
			'Comment Date' => '/* Comment Date */' . "\n" . '.comment-date',
			'Comment Thread Even' => '/* Comment Thread Even */' . "\n" . '.fl-comments-list .even',
			'Comment Thread Odd' => '/* Comment Thread Odd */' . "\n" . '.fl-comments-list .odd'
		)
	);
	
	return $beaver_extender_comments_elements_array;
	
}

/**
 * Build Comments Respond CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Comments Respond CSS elements array.
 */
function beaver_extender_comment_respond_elements_array() {
	
	$beaver_extender_comment_respond_elements_array = array(
		'-- Comment Respond --' => array(
			'Comment Respond' => '/* Comment Respond */' . "\n" . '.comment-respond',
			'Comment Reply Title' => '/* Comment Reply Title */' . "\n" . '.comment-reply-title',
			'Author/Email/URL Form' => '/* Author/Email/URL Form */' . "\n" . '.comment-respond input[type=text]',
			'Comment Form' => '/* Comment Form */' . "\n" . '.comment-respond textarea',
			'Comment Submit Button' => '/* Comment Submit Button */' . "\n" . '.comment-respond input[type=submit]',
			'Comment Submit Button Hover' => '/* Comment Submit Button Hover */' . "\n" . '.comment-respond input[type=submit]:hover'
		)
	);
	
	return $beaver_extender_comment_respond_elements_array;
	
}

/**
 * Build Custom Widget Areas CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Custom Widget Areas CSS elements array.
 */
function beaver_extender_custom_widget_areas_elements_array() {
	
	$beaver_extender_custom_widget_areas_elements_array = array(
		'-- Custom Widgets Areas --' => array(
			'Custom Widget Area' => '/* Custom Widget Area */' . "\n" . '.beaver-extender-widget-area',
			'Custom Widget Area H4' => '/* Custom Widget Area H4 */' . "\n" . '.beaver-extender-widget-area h4',
			'Custom Widget Area Link' => '/* Custom Widget Area Link */' . "\n" . '.beaver-extender-widget-area a, .beaver-extender-widget-area a:visited',
			'Custom Widget Area Link Hover' => '/* Custom Widget Area Link Hover */' . "\n" . '.beaver-extender-widget-area a:hover'
		)
	);
	
	return $beaver_extender_custom_widget_areas_elements_array;
	
}

/**
 * Build Footer CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Footer CSS elements array.
 */
function beaver_extender_footer_elements_array() {
	
	$beaver_extender_footer_elements_array = array(
		'-- Footer --' => array(
			'Footer Wrap' => '/* Footer Wrap */' . "\n" . '.fl-page-footer-wrap',
			'Footer' => '/* Footer */' . "\n" . '.fl-page-footer',
			'Footer Container' => '/* Footer Container */' . "\n" . '.fl-page-footer-container',
			'Footer Text' => '/* Footer Text */' . "\n" . '.fl-page-footer *, .fl-page-footer h1, .fl-page-footer h2, .fl-page-footer h3, .fl-page-footer h4, .fl-page-footer h5, .fl-page-footer h6',
			'Footer Link' => '/* Footer Link */' . "\n" . '.fl-page-footer a, .fl-page-footer a *, .fl-page-footer a.fa',
			'Footer Link Hover' => '/* Footer Link Hover */' . "\n" . '.fl-page-footer a:hover, .fl-page-footer a:focus, .fl-page-footer a:hover *, .fl-page-footer a:focus *, .fl-page-footer a.fa:hover, .fl-page-footer a.fa:focus',
			'Footer Menu' => '/* Footer Menu */' . "\n" . '.fl-page-footer-nav',
			'Footer Menu Page Link' => '/* Footer Menu Page Link */' . "\n" . '.fl-page-footer .navbar-nav > li > a',
			'Footer Menu Page Link Hover' => '/* Footer Menu Page Link Hover */' . "\n" . '.fl-page-footer .navbar-nav > li > a:hover, .fl-page-footer .navbar-nav > li > a:focus',
			'Footer Menu Current Page Link' => '/* Footer Menu Current Page Link */' . "\n" . '.fl-page-footer .navbar-nav > li.current-menu-item > a'
		)
	);
	
	return $beaver_extender_footer_elements_array;
	
}

/**
 * Build Images / Alignment CSS elements drop-down list.
 *
 * @since 1.0.0
 * @return Images / Alignment CSS elements array.
 */
function beaver_extender_images_alignment_elements_array() {
	
	$beaver_extender_images_alignment_elements_array = array(
		'-- Images / Alignment --' => array(
			'Image Align None' => '/* Image Align None */' . "\n" . 'img.alignnone',
			'Image Align Left' => '/* Image Align Left */' . "\n" . 'img.alignleft',
			'Image Align Center' => '/* Image Align Center */' . "\n" . 'img.centered',
			'Image Align Right' => '/* Image Align Right */' . "\n" . 'img.alignright',
			'Image WP Smiley' => '/* Image WP Smiley */' . "\n" . 'img.wp-smiley, img.wp-wink',
			'Align Left' => '/* Align Left */' . "\n" . '.alignleft',
			'Align Center' => '/* Align Center */' . "\n" . '.aligncenter',
			'Align Right' => '/* Align Right */' . "\n" . '.alignright',
			'WP Caption' => '/* WP Caption */' . "\n" . '.wp-caption',
			'WP Caption Text' => '/* WP Caption Text */' . "\n" . 'p.wp-caption-text',
			'Thumbnail Image' => '/* Thumbnail Image */' . "\n" . '.attachment-thumbnail',
			'Post Format Image' => '/* Post Format Image */' . "\n" . '.post-format-image'
		)
	);
	
	return $beaver_extender_images_alignment_elements_array;
	
}

/**
 * Build the CSS Builder select menu.
 *
 * @since 1.0.0
 */
function beaver_extender_build_css_builder_select_menu( $elements_array = array(), $selected = '' ) {
	
	foreach( $elements_array as $element_type => $elements ) {
		
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data ) {
			
			$option = '<option value="' . $element_data . ' {"';
				
			if ( $element_data == $selected )
				$option .= ' selected="selected"';

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
			
		}
		echo '</optgroup>';
		
	}
	
}

/**********
General Option Arrays
           **********/
           
/**
 * Build font options list.
 *
 * @since 1.0.0
 */
function beaver_extender_list_font_options( $selected = '' ) {
	
	$beaver_extender_font_options = array(
		"Arial" => "Arial, sans-serif",
		"Arial Black" => "'Arial Black', sans-serif",
		"Courier New" => "'Courier New', sans-serif",
		"Georgia" => "Georgia, serif",
		"Helvetica" => "Helvetica, sans-serif",
		"Impact" => "Impact, sans-serif",
		"Lucida Console" => "'Lucida Console', sans-serif",
		"Lucida Sans Unicode" => "'Lucida Sans Unicode', sans-serif",
		"Tahoma" => "Tahoma, sans-serif",
		"Times New Roman" => "'Times New Roman', serif",
		"Trebuchet MS" => "'Trebuchet MS', sans-serif",
		"Verdana" => "Verdana, sans-serif"
	);
	
	foreach( $beaver_extender_font_options as $font_key => $font_name ) {
		
		$option = '<option value="' . $font_name . '"';
			
		if ( $font_name == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $font_key . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build main background options list.
 *
 * @since 1.0.0
 */
function beaver_extender_list_bg_options( $selected = '' ) {
	
	$beaver_extender_bg_options = array(
		'color' => 'Color',
		'transparent' => 'Transparent',
		'top left no-repeat' => 'No-Repeat Image (Left)',
		'top center no-repeat' => 'No-Repeat Image (Center)',
		'top right no-repeat' => 'No-Repeat Image (Right)',
		'top left repeat-x' => 'Horizontal-Repeat Image (Left)',
		'top center repeat-x' => 'Horizontal-Repeat Image (Center)',
		'top right repeat-x' => 'Horizontal-Repeat Image (Right)',
		'top left repeat-y' => 'Vertical-Repeat Image (Left)',
		'top center repeat-y' => 'Vertical-Repeat Image (Center)',
		'top right repeat-y' => 'Vertical-Repeat Image (Right)',
		'top repeat' => 'Horizontal & Vertical-Repeat Image'
	);
	
	foreach( $beaver_extender_bg_options as $bg_key => $bg_name ) {
		
		$option = '<option value="' . $bg_key . '"';
			
		if ( $bg_key == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $bg_name . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build border options list.
 *
 * @since 1.0.0
 */
function beaver_extender_list_borders( $selected = '' ) {
	
	$beaver_extender_border_options = array( 'solid', 'dotted', 'dashed', 'double', 'groove', 'ridge', 'inset', 'outset' );

	foreach ( $beaver_extender_border_options as $border_option ) {
		
		$option = '<option value="' . $border_option . '"';
		
		if ( $border_option == $selected )
			$option .= ' selected="selected"';
		
		$option .= '>' . $border_option . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build "Custom Widget Area Shortcode" options list.
 *
 * @since 1.0.1
 */
function beaver_extender_list_wa_shortcode_options( $selected = '' ) {
	
	$beaver_extender_custom_widget_areas = get_option( 'beaver_extender_custom_widget_areas' );
	asort( $beaver_extender_custom_widget_areas );
	$beaver_extender_wa_shortcode_options = array();

	if ( ! empty( $beaver_extender_custom_widget_areas ) ) {
		
		foreach( $beaver_extender_custom_widget_areas as $key => $value ) {
			
			$beaver_extender_wa_shortcode_options[$key] = $value['widget_name'];
			
		}
		
	}
	
	foreach( $beaver_extender_wa_shortcode_options as $wa_shortcode_key => $wa_shortcode_name ) {
		
		$option = '<option value="' . $wa_shortcode_key . '"';
			
		if ( $wa_shortcode_key == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $wa_shortcode_name . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build "Custom Hook Box Shortcode" options list.
 *
 * @since 1.0.1
 */
function beaver_extender_list_hb_shortcode_options( $selected = '' ) {
	
	$beaver_extender_custom_hook_boxes = get_option( 'beaver_extender_custom_hook_boxes' );
	asort( $beaver_extender_custom_hook_boxes );
	$beaver_extender_hb_shortcode_options = array();

	if ( ! empty( $beaver_extender_custom_hook_boxes ) ) {
		
		foreach( $beaver_extender_custom_hook_boxes as $key => $value ) {
			
			$beaver_extender_hb_shortcode_options[$key] = $value['hook_name'];
			
		}
		
	}
	
	foreach( $beaver_extender_hb_shortcode_options as $hb_shortcode_key => $hb_shortcode_name ) {
		
		$option = '<option value="' . $hb_shortcode_key . '"';
			
		if ( $hb_shortcode_key == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $hb_shortcode_name . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build "BB Templates Shortcode" options list.
 *
 * @since 1.0.1
 */
function beaver_extender_list_bb_templates_shortcode_options( $selected = '' ) {
	
	global $post;
	$query = new WP_Query( array(
	
		'post_type' => 'fl-builder-template',
		'post_status' => 'publish',
		'posts_per_page' => -1
	
	) );
	
	$post_names = array();
	while ( $query->have_posts() ) {
	
		$query->the_post();
		$post_names[get_the_title()] = $post->post_name;
		
	}
	
	wp_reset_query();

	asort( $post_names );
	
	foreach( $post_names as $post_name => $post_slug ) {
		
		$option = '<option value="' . $post_slug . '"';
			
		if ( $post_name == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $post_name . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build the specified BB template code.
 *
 * @since 1.0.3
 * @return the specified BB template code.
 */
function beaver_extender_bb_template_code( $file ) {
	
	$code = beaver_extender_file_to_menu_converter( get_template_directory() . '/' . $file );

	return $code;
	
}

/**
 * Build "BB Template Code" options list.
 *
 * @since 1.0.1
 */
function beaver_extender_list_bb_template_code_options( $selected = '' ) {
	
	$beaver_extender_bb_template_code_options = array(
		beaver_extender_bb_template_code( 'index.php' ) => "index.php",
		beaver_extender_bb_template_code( 'single.php' ) => "single.php",
		beaver_extender_bb_template_code( 'page.php' ) => "page.php",
		beaver_extender_bb_template_code( '404.php' ) => "404.php",
		beaver_extender_bb_template_code( 'content.php' ) => "content.php",
		beaver_extender_bb_template_code( 'content-single.php' ) => "content-single.php",
		beaver_extender_bb_template_code( 'content-page.php' ) => "content-page.php",
		beaver_extender_bb_template_code( 'content-no-results.php' ) => "content-no-results.php"
	);
	
	foreach( $beaver_extender_bb_template_code_options as $bb_template_code_key => $bb_template_code_name ) {
		
		$option = '<option value="' . $bb_template_code_key . '"';
			
		if ( $bb_template_code_key == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $bb_template_code_name . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build "Code Snippets" list.
 *
 * @since 1.0.1
 */
function beaver_extender_list_code_snippets( $selected = '' ) {
	
	$beaver_extender_code_snippets = array(
		"// Your PHP comment text goes here" => "Add Simple Comment",
		"/**\n * Your PHP comment text goes here\n */" => "Add Complex Comment"
	);
	
	foreach( $beaver_extender_code_snippets as $code_snippet_key => $code_snippet_name ) {
		
		$option = '<option value="' . $code_snippet_key . '"';
			
		if ( $code_snippet_key == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $code_snippet_name . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Build PHP "actions" drop-down list.
 *
 * @since 1.0.0
 * @return PHP "actions" array.
 */
function beaver_extender_php_actions_array() {
	
	$beaver_extender_php_actions_array = array(
		"-- Document <head> --" => array(
			"Doctype" => "( 'genesis_doctype', 'genesis_do_doctype' );",
			"WP Title" => "( 'genesis_title', 'wp_title' );",
			"Doc Head Control" => "( 'get_header', 'genesis_doc_head_control' );",
			"SEO Meta Description" => "( 'genesis_meta', 'genesis_seo_meta_description' );",
			"SEO Meta Keywords" => "( 'genesis_meta', 'genesis_seo_meta_keywords' );",
			"Robots Meta" => "( 'genesis_meta', 'genesis_robots_meta' );",
			"Responsive Viewport" => "( 'genesis_meta', 'genesis_responsive_viewport' );",
			"Load Favicon" => "( 'wp_head', 'genesis_load_favicon' );",
			"Meta Pingback" => "( 'wp_head', 'genesis_do_meta_pingback' );",
			"Canonical" => "( 'wp_head', 'genesis_canonical', 5 );",
			"Rel Author" => "( 'wp_head', 'genesis_rel_author' );",
			"Header Scripts" => "( 'wp_head', 'genesis_header_scripts' );",
			"Custom Header" => "( 'after_setup_theme', 'genesis_custom_header' );",
			"Custom Header Style" => "( 'wp_head', 'genesis_custom_header_style' );",
			"Load Stylesheet" => "( 'genesis_meta', 'genesis_load_stylesheet' );",
			"Feed Redirect" => "( 'template_redirect', 'genesis_feed_redirect' );",
			"Create Initial Layouts" => "( 'genesis_init', 'genesis_create_initial_layouts', 0 );",
			"SEO Compatibility Check" => "( 'after_setup_theme', 'genesis_seo_compatibility_check', 5 );",
			"HTML5 IE Fix" => "( 'wp_head', 'genesis_html5_ie_fix' );"
		),
		"-- Header --" => array(
			"Header Markup Open" => "( 'genesis_header', 'genesis_header_markup_open', 5 );",
			"Header" => "( 'genesis_header', 'genesis_do_header' );",
			"Header Markup Close" => "( 'genesis_header', 'genesis_header_markup_close', 15 );",
			"Site Title" => "( 'genesis_site_title', 'genesis_seo_site_title' );",
			"Site Description" => "( 'genesis_site_description', 'genesis_seo_site_description' );"
		),
		"-- Menus --" => array(
			"Register Nav Menus" => "( 'after_setup_theme', 'genesis_register_nav_menus' );",
			"Primary Navbar" => "( 'genesis_after_header', 'genesis_do_nav' );",
			"Secondary Navbar" => "( 'genesis_after_header', 'genesis_do_subnav' );"
		),
		"-- Misc. Before Loop --" => array(
			"Breadcrumbs" => "( 'genesis_before_loop', 'genesis_do_breadcrumbs' );",
			"Taxonomy Title/Description" => "( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );",
			"Author Box Archive" => "( 'genesis_before_loop', 'genesis_do_author_box_archive', 15 );",
			"CPT Archive Title/Description" => "( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );",
			"Search Title" => "( 'genesis_before_loop', 'genesis_do_search_title' );",
			"example_text" => "( 'genesis_loop_else', 'genesis_do_noposts' );"
		),
		"-- Misc. Loop --" => array(
			"Loop" => "( 'genesis_loop', 'genesis_do_loop' );",
			"'No Posts' Text" => "( 'genesis_loop_else', 'genesis_do_noposts' );",
			"Posts Nav" => "( 'genesis_after_endwhile', 'genesis_posts_nav' );",
			"404 Content" => "( 'genesis_loop', 'genesis_404' );"
		),
		"-- HTML5 Loop --" => array(
			"Post Format Image" => "( 'genesis_entry_header', 'genesis_do_post_format_image', 5 );",
			"Entry Header Markup Open" => "( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );",
			"Entry Header Markup Close" => "( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );",
			"Post Title" => "( 'genesis_entry_header', 'genesis_do_post_title' );",
			"Post Image" => "( 'genesis_entry_content', 'genesis_do_post_image', 8 );",
			"Post Format Image" => "( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );",
			"Post Content" => "( 'genesis_entry_content', 'genesis_do_post_content' );",
			"Post Permalink" => "( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );",
			"Post Content Nav" => "( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );",
			"Post Info" => "( 'genesis_entry_header', 'genesis_post_info', 12 );",
			"Entry Footer Markup Open" => "( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );",
			"Entry Footer Markup Close" => "( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );",
			"Post Meta" => "( 'genesis_entry_footer', 'genesis_post_meta' );",
			"Author Box Single" => "( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );",
			"Grid Loop Content" => "( 'genesis_entry_content', 'genesis_grid_loop_content' );",
			"Add ID To Global Exclude" => "( 'genesis_after_entry', 'genesis_add_id_to_global_exclude' );",
			"Page Archive Content" => "( 'genesis_entry_content', 'genesis_page_archive_content' );"
		),
		"-- Pre-HTML5 Loop --" => array(
			"Post Format Image" => "( 'genesis_before_post_title', 'genesis_do_post_format_image' );",
			"Post Title" => "( 'genesis_post_title', 'genesis_do_post_title' );",
			"Post Image" => "( 'genesis_post_content', 'genesis_do_post_image', 8 );",
			"Post Format Image" => "( 'genesis_before_post_title', 'genesis_do_post_format_image' );",
			"Post Content" => "( 'genesis_post_content', 'genesis_do_post_content' );",
			"Post Permalink" => "( 'genesis_post_content', 'genesis_do_post_permalink' );",
			"Post Content Nav" => "( 'genesis_post_content', 'genesis_do_post_content_nav' );",
			"Post Info" => "( 'genesis_before_post_content', 'genesis_post_info', 12 );",
			"Post Meta" => "( 'genesis_after_post_content', 'genesis_post_meta' );",
			"Author Box Single" => "( 'genesis_after_post', 'genesis_do_author_box_single' );",
			"Grid Loop Content" => "( 'genesis_post_content', 'genesis_grid_loop_content' );",
			"Add ID To Global Exclude" => "( 'genesis_after_post', 'genesis_add_id_to_global_exclude' );",
			"Page Archive Content" => "( 'genesis_post_content', 'genesis_page_archive_content' );",
			"Author Box Single" => "( 'genesis_after_post', 'genesis_do_author_box_single' );"
		),
		"-- Comments --" => array(
			"Comments Template (HTML5)" => "( 'genesis_after_entry', 'genesis_get_comments_template' );",
			"Comments Template (Pre-HTML5)" => "( 'genesis_after_post', 'genesis_get_comments_template' );",
			"Comments" => "( 'genesis_comments', 'genesis_do_comments' );",
			"Pings" => "( 'genesis_pings', 'genesis_do_pings' );",
			"Default List Comments" => "( 'genesis_list_comments', 'genesis_default_list_comments' );",
			"Default List Pings" => "( 'genesis_list_pings', 'genesis_default_list_pings' );",
			"Comment Form" => "( 'genesis_comment_form', 'genesis_do_comment_form' );"
		),
		"-- Sidebar --" => array(
			"Build Primary Sidebar" => "( 'genesis_after_content', 'genesis_get_sidebar' );",
			"Build Secondary Sidebar" => "( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );",
			"Get Primary Sidebar" => "( 'genesis_sidebar', 'genesis_do_sidebar' );",
			"Get Secondary Sidebar" => "( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );",
			"Load Widgets" => "( 'widgets_init', 'genesis_load_widgets' );",
			"Remove Default Header Right Widgets" => "( 'load-themes.php', 'genesis_remove_default_widgets_from_header_right' );"
		),
		"-- Footer --" => array(
			"Footer Markup Open" => "( 'genesis_footer', 'genesis_footer_markup_open', 5 );",
			"Footer" => "( 'genesis_footer', 'genesis_do_footer' );",
			"Footer Markup Close" => "( 'genesis_footer', 'genesis_footer_markup_close', 15 );",
			"Footer Widget Areas" => "( 'genesis_before_footer', 'genesis_footer_widget_areas' );",
			"Footer Scripts" => "( 'wp_footer', 'genesis_footer_scripts' );"
		)
	);
	
	return $beaver_extender_php_actions_array;
	
}

/**
 * Build the PHP Builder "actions" menu.
 *
 * @since 1.0.0
 */
function beaver_extender_build_php_actions_menu( $selected = '' ) {
	
	$beaver_extender_php_actions_array = beaver_extender_php_actions_array();
	
	foreach( $beaver_extender_php_actions_array as $action_type => $actions ) {
		
		echo '<optgroup label="' . $action_type . '">';
		foreach( $actions as $action_slug => $action_data ) {
			
			$option = '<option value="' . $action_data . '"';
				
			if ( $action_data == $selected )
				$option .= ' selected="selected"';

			$option .= '>' . $action_slug . '</option>';
			
			echo $option;
			
		}
		echo '</optgroup>';
		
	}
	
}

/**
 * Build PHP "filters" drop-down list.
 *
 * @since 1.0.0
 * @return PHP "filters" array.
 */
function beaver_extender_php_filters_array() {
	
	$beaver_extender_php_filters_array = array(
		'-- Header Section --' => array(
			'SEO Title' => 'genesis_seo_title',
			'SEO Description' => 'genesis_seo_description',
			'Pre-load Favicon' => 'genesis_pre_load_favicon',
			'Header Scripts' => 'genesis_header_scripts'
		),
		'-- Menus --' => array(
			'Nav Default Args' => 'genesis_nav_default_args',
			'Pre Nav' => 'genesis_pre_nav',
			'Nav Home Text' => 'genesis_nav_home_text',
			'Nav Items' => 'genesis_nav_items',
			'Nav' => 'genesis_nav'
		),
		'-- The Loop --' => array(
			'Custom Loop Args' => 'genesis_custom_loop_args',
			'Post Title Text' => 'genesis_post_title_text',
			'Post Title Output' => 'genesis_post_title_output',
			'"No Posts" Text' => 'genesis_noposts_text',
			'Post Info' => 'genesis_post_info',
			'Post Meta' => 'genesis_post_meta',
			'Author Box Gravatar Size' => 'genesis_author_box_gravatar_size',
			'Author Box Title' => 'genesis_author_box_title'
		),
		'-- Post Shortcodes --' => array(
			'Post Date' => 'genesis_post_date_shortcode',
			'Post Time' => 'genesis_post_time_shortcode',
			'Post Author Link' => 'genesis_post_author_link_shortcode',
			'Post Author' => 'genesis_post_author_shortcode',
			'Post Comment' => 'genesis_post_comments_shortcode',
			'Post Tags' => 'genesis_post_tags_shortcode',
			'Post Categories' => 'genesis_post_categories_shortcode',
			'Post Edit' => 'genesis_post_edit_shortcode'
		),
		'-- Comment Section --' => array(
			'Title Comments' => 'genesis_title_comments',
			'No Comments Text' => 'genesis_no_comments_text',
			'Comments Closed Text' => 'genesis_comments_closed_text',
			'Title Pings' => 'genesis_title_pings',
			'No Pings Text' => 'genesis_no_pings_text',
			'Comment List Args' => 'genesis_comment_list_args',
			'Ping List Args' => 'genesis_ping_list_args',
			'Author Says Text' => 'comment_author_says_text',
			'Comment Form Args' => 'genesis_comment_form_args'
		),
		'-- Misc. --' => array(
			'Breadcrumb Args' => 'genesis_breadcrumb_args',
			'Breadcrumb Home Link' => 'genesis_breadcrumb_homelink',
			'Breadcrumb Blog Link' => 'genesis_breadcrumb_bloglink',
			'Gravatar Sizes' => 'genesis_gravatar_sizes'
		),
		'-- Search Form --' => array(
			'Search Query' => 'the_search_query',
			'Search Text' => 'genesis_search_text',
			'Search Button Text' => 'genesis_search_button_text',
			'Search Form' => 'genesis_search_form'
		),
		'-- Images --' => array(
			'Get Image Default Args' => 'genesis_get_image_default_args',
			'Pre Get Image' => 'genesis_pre_get_image',
			'Get Image' => 'genesis_get_image'
		),
		'-- Footer Section --' => array(
			'"Back To Top" Text' => 'genesis_footer_backtotop_text',
			'Footer Creds Text' => 'genesis_footer_creds_text',
			'Footer Output' => 'genesis_footer_output',
			'Footer Scripts' => 'genesis_footer_scripts'
		),
		'-- Footer Shortcodes --' => array(
			'Footer "Back To Top"' => 'genesis_footer_backtotop_shortcode',
			'Footer Copyright' => 'genesis_footer_copyright_shortcode',
			'Footer Child Theme Link' => 'genesis_footer_childtheme_link_shortcode',
			'Footer Genesis Link' => 'genesis_footer_genesis_link_shortcode',
			'Footer StudioPress Link' => 'genesis_footer_studiopress_link_shortcode',
			'Footer WordPress Link' => 'genesis_footer_wordpress_link_shortcode',
			'Footer Login/out' => 'genesis_footer_loginout_shortcode'
		)
	);
	
	return $beaver_extender_php_filters_array;
	
}

/**
 * Build the PHP Builder "filters" menu.
 *
 * @since 1.0.0
 */
function beaver_extender_build_php_filters_menu( $selected = '' ) {
	
	$beaver_extender_php_filters_array = beaver_extender_php_filters_array();
	
	foreach( $beaver_extender_php_filters_array as $filter_type => $filters ) {
		
		echo '<optgroup label="' . $filter_type . '">';
		foreach( $filters as $filter_slug => $filter_data ) {
			
			$option = '<option value="' . $filter_data . '"';
				
			if ( $filter_data == $selected )
				$option .= ' selected="selected"';

			$option .= '>' . $filter_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
		
	}
	
}

/**
 * Build an options list of Genesis hooks.
 *
 * @since 1.0.0
 */
function beaver_extender_list_hooks( $selected = '' ) {
	
	$genesis_hooks = array(
		'-- <head> Hooks --' => array(
			'fl_head_open',
			'fl_head',
			'wp_head'	
		),
		'-- Page Hooks --' => array(
			'fl_body_open',
			'fl_body_close',
			'fl_page_open',
			'fl_page_close',
			'fl_before_top_bar',
			'fl_after_top_bar',
			'fl_top_bar_col1_open',
			'fl_top_bar_col1_close',
			'fl_top_bar_col2_open',
			'fl_top_bar_col2_close'
		),
		'-- Header Hooks --' => array(
			'fl_before_header',
			'fl_after_header',
			'fl_header_content_open',
			'fl_header_content_close'
		),
		'-- Content Hooks --' => array(
			'fl_before_content',
			'fl_after_content',
			'fl_content_open',
			'fl_content_close',
			'fl_post_top_meta_open',
			'fl_post_top_meta_close',
			'fl_post_bottom_meta_open',
			'fl_post_bottom_meta_close'
		),
		'-- Comment Hooks --' => array(
			'fl_comments_open',
			'fl_comments_close'
		),
		'-- Sidebar Hooks --' => array(
			'fl_sidebar_open',
			'fl_sidebar_close'
		),
		'-- Footer Hooks --' => array(
			'fl_footer_wrap_open',
			'fl_footer_wrap_close',
			'fl_before_footer_widgets',
			'fl_after_footer_widgets',
			'fl_before_footer',
			'fl_after_footer',
			'fl_footer_col1_open',
			'fl_footer_col1_close',
			'fl_footer_col2_open',
			'fl_footer_col2_close'
		)
	);
	
	foreach( $genesis_hooks as $optgroup => $options ) {
		
		echo '<optgroup style="font-size:14px;color:#57A18D;" label="' . $optgroup . '">';
		foreach( $options as $option ) {
			
			$output = '<option style="color:#000000;" value="' . $option . '"';
				
			if ( $option == $selected )
				$output .= ' selected="selected"';

			$output .= '>' . $option . '</option>';
			
			echo $output;
		}
		echo '</optgroup>';
		
	}
	
}

/**
 * Build Custom Conditional Examples options list.
 *
 * @since 1.0.0
 */
function beaver_extender_list_conditional_examples( $selected = '' ) {
	
	$beaver_extender_conditional_examples = array(
		'examples' => 'Examples:',
		'is_page|is_page()' => 'Is Page',
		'is_not_page|! is_page()' => 'Is NOT Page',
		'is_page_template|is_page_template()' => 'Is Page Template',
		'is_not_page_template|! is_page_template()' => 'Is NOT Page Template',
		'is_single_post|is_single()' => 'Is Single Post',
		'is_not_single_post|! is_single()' => 'Is NOT Single Post',
		'is_front_page|is_front_page()' => 'Is Front Page',
		'is_not_front_page|! is_front_page()' => 'Is NOT Front Page',
		'is_archive|is_archive()' => 'Is Archive',
		'is_not_archive|! is_archive()' => 'Is NOT Archive',
		'is_category|is_category()' => 'Is Category',
		'is_not_category|! is_category()' => 'Is NOT Category',
		'is_tag|is_tag()' => 'Is Tag',
		'is_not_tag|! is_tag()' => 'Is NOT Tag',
		'is_author|is_author()' => 'Is Author',
		'is_not_author|! is_author()' => 'Is NOT Author',
		'has_label_example|beaver_extender_has_label(&#39;example&#39;)' => 'Has Extender Label'
	);
	
	foreach( $beaver_extender_conditional_examples as $conditional_examples_key => $conditional_examples_name ) {
		
		$option = '<option value="' . $conditional_examples_key . '"';
			
		if ( $conditional_examples_key == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $conditional_examples_name . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Convert file contents into option menu compatible content.
 *
 * @since 1.0.3
 * @return option menu compatible content.
 */
function beaver_extender_file_to_menu_converter( $file ) {
	
	if( file_exists( $file ) ) {
		
		$file_contents = file_get_contents( $file );
		$file_contents = str_replace( '<', '&#60;', $file_contents );
		$file_contents = str_replace( '>', '&#62;', $file_contents );
		$file_contents = str_replace( '?', '&#63;', $file_contents );
		$file_contents = str_replace( '\'', '&#39;', $file_contents );
		$file_contents = str_replace( '"', '&#34;', $file_contents );		
		
	} else {
		
		$file_contents = '** File Does Not Exist **';
		
	}
	
	return $file_contents;
	
}
