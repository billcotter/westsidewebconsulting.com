<?php
?>
( function ( $ ) {
$(document).ready(function(){


	function aps_builder_js() {

			$('.admin-page-spider').append('<?php

//The array of pages
	$query = new WP_Query( array(
		'post_type'     => 'page',
		'orderby'       => 'name',
		'posts_per_page' => '-1',
		'order'       => 'ASC'
		));

	global $wp_rewrite;
	global $prefix;

	//Create the menu
	foreach( $query->posts as $post )
	{
		$link_name = htmlspecialchars($post->post_title, ENT_QUOTES);

		if (get_the_ID() == $post->ID)
		{
			$edit_link = get_page_link( $post->ID ) . '?fl_builder" selected="1';
		}
		else
		{
			$edit_link = get_page_link( $post->ID ) . '?fl_builder';
		}

		echo '<option value="'.$edit_link.'">' . $link_name . '</option>';
	}
?>');
		}



		// Make sure the FLBuilderModel exists before calling anything
		if ( typeof FLBuilderModel != undefined ) {


			$.bbAddPanel({
				location: 'bar',
				html: '' ,
				style: 'select',
				class: 'admin-page-spider'
			});

			// Add the delegates
			//$('body').delegate('.admin-page-spider', 'click', aps_builder_js() );

			$('.admin-page-spider').on('change',function(e){
				$navigateto = $('.admin-page-spider').val();
				$url = $navigateto;

				$(".admin-page-spider").val(lastSel_val);
				console.log(lastSel_val);


				window.open($url, '_blank');


			});
			aps_builder_js();

			var lastSel_val = $(".admin-page-spider").val();

		}




});




			$.extend ({
			bbAddPanel: function ( options ) {
		        // DEFAULT OPTIONS
		        var settings = $.extend({
		            html: null,					// the html to insert or button text
		            location: 'panel',			// panel (to the left) | bar (top)
		            position: 'after',			// determine where to add the html or button
		            target: null,				//
		            style: 'section',
		            class: ''					// button
		        }, options );

		        // return early when nothing to insert
		        if (settings.html == null || settings.location == '' ) {
		        	return this;
		        }
		        if ( settings.location == 'panel' ) {

		        	// if target not set in options base it on location
		        	if ( !settings.target ) settings.target = 'div.fl-builder-panel-content';

		        } else if ( settings.location == 'bar' ) {

		        	// if target not set in options base it on location
		        	if ( !settings.target ) settings.target = '.fl-builder-bar-title';
		        	// reset position to insert after
		        	settings.position = 'insertafter';
		        }

		        // if style is set to button change the behavior and asume the html is the button text
		        if ( settings.style == 'button' )
		        {
		        	settings.html = '<span class="'+ settings.class + ' fl-builder-button">' + settings.html + '</span>';
		        }
		        else if (settings.style == 'section' )
		        {
		        	settings.html = '<div class="fl-builder-panel-info fl-builder-blocks-section"><div class="fl-builder-blocks-section-title custom-section">' +
		        	settings.html + '</div></div>';
		        }
		        else if (settings.style == 'select')
		        {
		        	settings.html = '<select style="margin: 0 5px 0 5px; font-size: 14px; background-color: #32373c;color: #fff;width: auto;" class="'+ settings.class + ' ">' + settings.html + '</select>';
		        }



		        if ( settings.position == 'after' ) {
			        $( settings.target ).append(settings.html  );
		        } else if (settings.position == 'before' ) {
			        $( settings.target ).prepend(settings.html);
		        } else if (settings.position == 'insertafter' ) {
		        	$ (settings.target ).append(settings.html);
		        }
		        return this;

			}
		});

} ( jQuery ));


<?php

?>