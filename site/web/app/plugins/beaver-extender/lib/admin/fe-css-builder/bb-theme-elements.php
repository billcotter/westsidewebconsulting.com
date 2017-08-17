<?php
/**
 * Builds the Beaver Builder Theme HTML elements arrays.
 *
 * @package Extender
 */

/**
 * Build HTML elements drop-down list.
 *
 * @since 1.1.0
 * @return HTML elements array.
 */
function beaver_extender_fe_css_builder_html_elements_array() {
	
	$elements_array = array(
		'page_elements' => array(
			'HTML' => '/* HTML */' . "\n" . 'html',
			'Body' => '/* Body */' . "\n" . 'body',
			'Page Container' => '/* Page Container */' . "\n" . '.fl-page',
			'Universal Link' => '/* Universal Link */' . "\n" . 'a',
			'Universal Link Hover' => '/* Universal Link Hover */' . "\n" . 'a:hover, a:focusS',
			'Universal Headings' => '/* Universal Headings */' . "\n" . 'h1, h2, h3, h4, h5, h6',
			'H1 Headings' => '/* H1 Headings */' . "\n" . 'h1',
			'H2 Headings' => '/* H2 Headings */' . "\n" . 'h2',
			'H3 Headings' => '/* H3 Headings */' . "\n" . 'h3',
			'H4 Headings' => '/* H4 Headings */' . "\n" . 'h4',
			'H5 Headings' => '/* H5 Headings */' . "\n" . 'h5',
			'H6 Headings' => '/* H6 Headings */' . "\n" . 'h6',
			'Universal Menus' => '/* Universal Menus */' . "\n" . '.fl-page-nav',
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
			'Post Format Image' => '/* Post Format Image */' . "\n" . '.post-format-image',
			'Input/Select/Textarea' => '/* Input/Select/Textarea */' . "\n" . 'input, select, textarea',
			'Input/Textarea Focus' => '/* Input/Textarea Focus */' . "\n" . 'input:focus, textarea:focus',
			'Buttons' => '/* Buttons */' . "\n" . 'button, input[type=&#34;button&#34;], input[type=&#34;reset&#34;], input[type=&#34;submit&#34;], .button',
			'Buttons Hover' => '/* Buttons Hover */' . "\n" . 'button:hover, input:hover[type=&#34;button&#34;], input:hover[type=&#34;reset&#34;], input:hover[type=&#34;submit&#34;], .button:hover, button:focus, input:focus[type=&#34;button&#34;], input:focus[type=&#34;reset&#34;], input:focus[type=&#34;submit&#34;], .button:focus',
			'Button Disabled' => '/* Button Disabled */' . "\n" . '.site-container button:disabled, .site-container button:disabled:hover, .site-container input:disabled, .site-container input:disabled:hover, .site-container input[type=&#34;button&#34;]:disabled, .site-container input[type=&#34;button&#34;]:disabled:hover, .site-container input[type=&#34;reset&#34;]:disabled, .site-container input[type=&#34;reset&#34;]:disabled:hover, .site-container input[type=&#34;submit&#34;]:disabled, .site-container input[type=&#34;submit&#34;]:disabled:hover',
			'Table' => '/* Table */' . "\n" . 'table',
			'Table Body' => '/* Table Body */' . "\n" . 'tbody',
			'Table Standard/Header Cells' => '/* Table Standard/Header Cells */' . "\n" . 'td, th',
			'Table Standard Cells' => '/* Table Standard Cells */' . "\n" . 'td',
			'Table Header Cells' => '/* Table Header Cells */' . "\n" . 'th',
			'Table Standard/Header Cells first-child' => '/* Table Standard/Header Cells first-child */' . "\n" . 'td:first-child, th:first-child'
		),
		'top_bar_elements' => array(
			'Tob Bar' => '/* Top Bar */' . "\n" . '.fl-page-bar',
			'Top Bar Container' => '/* Top Bar Container */' . "\n" . '.fl-page-bar-container',
			'Top Bar Row' => '/* Top Bar Row */' . "\n" . '.fl-page-bar-row',
			'Top Bar Text' => '/* Top Bar Text */' . "\n" . '.fl-page-bar-text',
			'Top Bar Menu' => '/* Top Bar Menu */' . "\n" . '.fl-page-bar-nav',
			'Top Bar Menu Page Link' => '/* Top Bar Menu Page Link */' . "\n" . '.fl-page-bar .navbar-nav > li > a',
			'Top Bar Menu Page Link Hover' => '/* Top Bar Menu Page Link Hover */' . "\n" . '.fl-page-bar .navbar-nav > li > a:hover, .fl-page-bar .navbar-nav > li > a:focus',
			'Top Bar Menu Current Page Link' => '/* Top Bar Menu Current Page Link */' . "\n" . '.fl-page-bar .navbar-nav > li.current-menu-item > a',
			'Top Bar Menu Page Link Hover/Current Page' => '/* Top Bar Menu Page Link Hover/Current Page */' . "\n" . '.fl-page-bar .navbar-nav > li > a:hover, .fl-page-bar .navbar-nav > li > a:focus,' . "\n" . '.fl-page-bar .navbar-nav > li.current-menu-item > a',
			'Top Bar Menu Sub-Menu' => '/* Top Bar Menu Sub-Menu */' . "\n" . '.fl-page-bar-nav > li > ul.sub-menu',
			'Top Bar Menu Sub-Menu Link' => '/* Top Bar Menu Sub-Menu Link */' . "\n" . '.fl-page-bar-nav > li > ul.sub-menu li a',
			'Top Bar Menu Sub-Menu Link Hover' => '/* Top Bar Menu Sub-Menu Link Hover */' . "\n" . '.fl-page-bar-nav > li > ul.sub-menu li a:hover'
		),
		'header_elements' => array(
			'Header' => '/* Header */' . "\n" . '.fl-page-header',
			'Header Wrap' => '/* Header Wrap */' . "\n" . '.fl-page-header-wrap',
			'Title Area' => '/* Title Area */' . "\n" . '.fl-page-header-logo-col',
			'Site Title' => '/* Site Title */' . "\n" . '.fl-page-header-logo',
			'Site Title Link' => '/* Site Title Link */' . "\n" . '.fl-page-header-logo a, .fl-page-header-logo a *',
			'Site Title Link Hover' => '/* Site Title Link Hover */' . "\n" . '.fl-page-header-logo a:hover, .fl-page-header-logo a:focus, .fl-page-header-logo a:hover *, .fl-page-header-logo a:focus *',
			'Site Description' => '/* Site Description */' . "\n" . '.fl-page-header-text',
			'Logo Image Area' => '/* Logo Image Area */' . "\n" . '.fl-page-header-logo',
			'Logo Image' => '/* Logo Image */' . "\n" . '.fl-logo-image',
			'Header Links' => '/* Header Links */' . "\n" . '.fl-page-header a, .fl-page-header a *, .fl-page-header a.fa',
			'Header Links Hover' => '/* Header Links Hover */' . "\n" . '.fl-page-header a:hover, .fl-page-header a:focus, .fl-page-header a:hover *, .fl-page-header a:focus *, .fl-page-header a.fa:hover, .fl-page-header a.fa:focus',
			'Header Social Icons' => '/* Header Social Icons */' . "\n" . '.fl-social-icons'
		),
		'header_menu_elements' => array(
			'Header Menu Wrap' => '/* Header Menu Wrap */' . "\n" . '.fl-page-nav-wrap',
			'Header Menu Container' => '/* Header Menu Container */' . "\n" . '.fl-page-nav-container',
			'Header Menu Nav' => '/* Header Menu Nav */' . "\n" . '.fl-page-nav',
			'Header Menu' => '/* Header Menu */' . "\n" . '.fl-page-nav .navbar-nav',
			'Header Menu Page Link' => '/* Header Menu Page Link */' . "\n" . '.fl-page-nav-wrap .navbar-nav > li > a',
			'Header Menu Page Link Hover' => '/* Header Menu Page Link Hover */' . "\n" . '.fl-page-nav-wrap .navbar-nav > li > a:hover',
			'Header Menu Current Page Link' => '/* Header Menu Current Page Link */' . "\n" . '.fl-page-nav-wrap .navbar-nav > li.current-menu-item > a',
			'Header Menu Page Link Hover/Current Page' => '/* Header Menu Page Link Hover/Current Page */' . "\n" . '.fl-page-nav-wrap .navbar-nav > li > a:hover,' . "\n" . '.fl-page-nav-wrap .navbar-nav > li.current-menu-item > a',
			'Header Menu Sub-Menu' => '/* Header Menu Sub-Menu */' . "\n" . '.fl-page-nav ul.sub-menu',
			'Header Menu Sub-Menu Link' => '/* Header Menu Sub-Menu Link */' . "\n" . '.fl-page-nav ul.sub-menu li a',
			'Header Menu Sub-Menu Link Hover' => '/* Header Menu Sub-Menu Link Hover */' . "\n" . '.fl-page-nav ul.sub-menu li a:hover',
			'Header Menu Right Search' => '/* Header Menu Right Search */' . "\n" . '.fl-page-nav-search',
			'Header Menu Right Search Form' => '/* Header Menu Right Search Form */' . "\n" . '.fl-page-nav-search form',
			'Header Menu Right Search Input' => '/* Header Menu Right Search Input */' . "\n" . '.fl-page-nav-search input'
		),
		'content_elements' => array(
			'Page Content' => '/* Page Content */' . "\n" . '.fl-page-content',
			'Content Container' => '/* Content Container */' . "\n" . '.fl-page-content .container',
			'Content' => '/* Content */' . "\n" . '.fl-content',
			'Content Article' => '/* Content Article */' . "\n" . '.fl-post',
			'Content Article Post' => '/* Content Article Post */' . "\n" . '.fl-post.post',
			'Content Article Page' => '/* Content Article Page */' . "\n" . '.fl-post.page'
		),
		'post_header_elements' => array(
			'Post Header' => '/* Post Header */' . "\n" . '.fl-post-header',
			'Post Title' => '/* Post Title */' . "\n" . '.fl-post-title',
			'Post Title Link' => '/* Post Title Link */' . "\n" . '.fl-post-title a',
			'Post Title Link Hover' => '/* Post Title Link Hover */' . "\n" . '.fl-post-title a:hover, .fl-post-title a:focus',
			'Post Meta Top' => '/* Post Meta Top */' . "\n" . '.fl-post-meta-top',
			'Post Meta Top Link' => '/* Post Meta Top Link */' . "\n" . '.fl-post-meta-top a',
			'Post Meta Top Link Hover' => '/* Post Meta Top Link Hover */' . "\n" . '.fl-post-meta-top a:hover, .fl-post-meta-top a:focus'
		),
		'post_content_elements' => array(
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
		),
		'post_meta_bottom_elements' => array(
			'Post Meta Bottom' => '/* Post Meta Bottom */' . "\n" . '.fl-post-meta-bottom',
			'Post Meta Bottom Link' => '/* Post Meta Bottom Link */' . "\n" . '.fl-post-meta-bottom a',
			'Post Meta Bottom Link Hover' => '/* Post Meta Bottom Link Hover */' . "\n" . '.fl-post-meta-bottom a:hover, .fl-post-meta-bottom a:focus'
		),
		'sidebar_elements' => array(
			'Sidebar' => '/* Sidebar */' . "\n" . '.fl-sidebar',
			'Sidebar Right' => '/* Sidebar Right */' . "\n" . '.fl-sidebar-right',
			'Sidebar Left' => '/* Sidebar Left */' . "\n" . '.fl-sidebar-left',
			'Sidebar Heading' => '/* Sidebar Heading */' . "\n" . '.fl-sidebar .fl-widget-title',
			'Sidebar Widget' => '/* Sidebar Widget */' . "\n" . '.fl-sidebar .fl-widget',
			'Sidebar Link' => '/* Sidebar Link */' . "\n" . '.fl-sidebar a',
			'Sidebar Link Hover' => '/* Sidebar Link Hover */' . "\n" . '.fl-sidebar a:hover, .fl-sidebar a:focus',
			'Sidebar UL/OL' => '/* Sidebar UL/OL */' . "\n" . '.fl-sidebar ul, .fl-sidebar ol',
			'Sidebar UL LI' => '/* Sidebar UL LI */' . "\n" . '.fl-sidebar ul li'
		),
		'comments_elements' => array(
			'Comments' => '/* Comments */' . "\n" . '.fl-comments',
			'Comment List' => '/* Comment List */' . "\n" . '.fl-comments-list',
			'Comments Title' => '/* Comments Title */' . "\n" . '.fl-comments-list-title',
			'Comment Meta' => '/* Comment Meta */' . "\n" . '.comment-meta',
			'Comment Avatar' => '/* Comment Avatar */' . "\n" . '.comment-avatar',
			'Comment Author Link' => '/* Comment Author Link */' . "\n" . '.comment-author-link',
			'Comment Date' => '/* Comment Date */' . "\n" . '.comment-date',
			'Comment Thread Even' => '/* Comment Thread Even */' . "\n" . '.fl-comments-list .even',
			'Comment Thread Odd' => '/* Comment Thread Odd */' . "\n" . '.fl-comments-list .odd'
		),
		'comment_respond_elements' => array(
			'Comment Respond' => '/* Comment Respond */' . "\n" . '.comment-respond',
			'Comment Reply Title' => '/* Comment Reply Title */' . "\n" . '.comment-reply-title',
			'Author/Email/URL Form' => '/* Author/Email/URL Form */' . "\n" . '.comment-respond input[type=text]',
			'Comment Form' => '/* Comment Form */' . "\n" . '.comment-respond textarea',
			'Comment Submit Button' => '/* Comment Submit Button */' . "\n" . '.comment-respond input[type=submit]',
			'Comment Submit Button Hover' => '/* Comment Submit Button Hover */' . "\n" . '.comment-respond input[type=submit]:hover'
		),
		'footer_elements' => array(
			'Footer Wrap' => '/* Footer Wrap */' . "\n" . '.fl-page-footer-wrap',
			'Footer' => '/* Footer */' . "\n" . '.fl-page-footer',
			'Footer Container' => '/* Footer Container */' . "\n" . '.fl-page-footer-container',
			'Footer Text' => '/* Footer Text */' . "\n" . '.fl-page-footer *, .fl-page-footer h1, .fl-page-footer h2, .fl-page-footer h3, .fl-page-footer h4, .fl-page-footer h5, .fl-page-footer h6',
			'Footer Link' => '/* Footer Link */' . "\n" . '.fl-page-footer a, .fl-page-footer a *, .fl-page-footer a.fa',
			'Footer Link Hover' => '/* Footer Link Hover */' . "\n" . '.fl-page-footer a:hover, .fl-page-footer a:focus, .fl-page-footer a:hover *, .fl-page-footer a:focus *, .fl-page-footer a.fa:hover, .fl-page-footer a.fa:focus',
			'Footer Menu' => '/* Footer Menu */' . "\n" . '.fl-page-footer-nav',
			'Footer Menu Page Link' => '/* Footer Menu Page Link */' . "\n" . '.fl-page-footer .navbar-nav > li > a',
			'Footer Menu Page Link Hover' => '/* Footer Menu Page Link Hover */' . "\n" . '.fl-page-footer .navbar-nav > li > a:hover, .fl-page-footer .navbar-nav > li > a:focus',
			'Footer Menu Current Page Link' => '/* Footer Menu Current Page Link */' . "\n" . '.fl-page-footer .navbar-nav > li.current-menu-item > a',
			'Footer Menu Page Link Hover/Current Page' => '/* Footer Menu Page Link Hover/Current Page */' . "\n" . '.fl-page-footer .navbar-nav > li > a:hover, .fl-page-footer .navbar-nav > li > a:focus,' . "\n" . '.fl-page-footer .navbar-nav > li.current-menu-item > a'
		)
	);
	
	return $elements_array;
	
}
