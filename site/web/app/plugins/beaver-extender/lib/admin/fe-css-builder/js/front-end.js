jQuery(document).ready(function($) {
	
	$('body').addClass('beaver-extender-fe-css-builder');
	
	$('.beaver-extender-fe-css-builder-elements-select').each(function() {
		var menu_id = $(this).attr('id');
		this.menu_array = [];
		var menu_li = this;
		$('#'+menu_id+' optgroup option').each(function() {
			var option = $(this).text();
			menu_li.menu_array.push(option);
		});
		
		var menu_li_li = '';
		
		$.each(this.menu_array, function() {
			menu_li_li += '<li>'+this+'</li>';
		});
		
		var menu_optgroup = $('#'+menu_id+' optgroup').attr('label');
		
		var menu_li_open = '		<ul id="'+menu_id+'_ul" class="beaver-extender-fe-css-builder-elements-select-ul"> \
    <li> \
        <span>'+$('#'+menu_id).find('option:first').text()+'</span> \
        <ul>';
        
		var menu_li_close = '		</ul> \
    </li> \
</ul>';
			
		$(this).after(menu_li_open+'\n'+menu_li_li+'\n'+menu_li_close+'\n');
	});

	var beaver_extender_fe_css_builder_toggle_handler = function (event) {
		var clickCounter = $('#beaver-extender-fe-css-builder-css').data('clickCounter') || 0;
		
		if ( clickCounter == 0 ) {
			$('body').addClass('beaver-extender-fe-css-builder-active');
			$('#beaver-extender-fe-css-builder').animate({'height': 'show'}, { duration: 300 });
			var css_editor_h3_draggable_mouseenter = function() {
				$('#beaver-extender-fe-css-builder').draggable();
				$('#beaver-extender-fe-css-builder').draggable( 'enable' );
				$('#beaver-extender-fe-css-builder').draggable();
			};
			var css_editor_h3_draggable_mouseleave = function() {
				$('#beaver-extender-fe-css-builder').draggable();
				$('#beaver-extender-fe-css-builder').draggable( 'disable' );
				$('#beaver-extender-fe-css-builder').draggable();
			};
			$('#beaver-extender-fe-css-builder').addClass('beaver-extender-fe-css-builder-draggable');
			$('#beaver-extender-fe-css-builder h3').bind('mouseenter', css_editor_h3_draggable_mouseenter);
			$('#beaver-extender-fe-css-builder h3').bind('mouseleave', css_editor_h3_draggable_mouseleave);
			clickCounter = 1;
		} else {
			$('body').removeClass('beaver-extender-fe-css-builder-active');
			$('#beaver-extender-fe-css-builder').animate({'height': 'hide'}, { duration: 300 });
			clickCounter = 0;
		}
		
		$('#beaver-extender-fe-css-builder-css').data('clickCounter', clickCounter);
	};
	
	$('#beaver-extender-fe-css-builder-css').bind('click', beaver_extender_fe_css_builder_toggle_handler).one('click', beaver_extender_fe_css_builder_activate);
	$('#beaver-extender-fe-style-editor-css-builder-toggle-icon').one('click', beaver_extender_fe_css_builder_activate);

	function beaver_extender_fe_css_builder_activate() {
		
		function beaver_extender_fe_css_builder_string_between(string, start_needle, end_needle) {
			var start_pos = string.indexOf(start_needle) + 1;
			var end_pos = string.indexOf(end_needle,start_pos);
			var result = string.substring(start_pos,end_pos);
			return result;
		}
		
		if($('link[href*="//fonts.googleapis.com"][rel!="dns-prefetch"]').length) {
			$('#font_type').append($('<optgroup></optgroup>').attr('label','Available Google Fonts'));
			
			$('link[href*="//fonts.googleapis.com"][rel!="dns-prefetch"]').each(function() {
				var gfont_href = decodeURIComponent($(this).attr('href')).replace(/\+/g, ' ');
				var gfont = '';
				if(gfont_href.indexOf('&') > -1) {
					gfont = beaver_extender_fe_css_builder_string_between(gfont_href, '=', '&');
				} else {
					gfont = gfont_href.substr(gfont_href.indexOf('=') + 1);
				}
				var gfont_arr = gfont.split('|');
				
				$.each(gfont_arr, function( index, value ) {
					var gfont = value.substr(0, value.indexOf(':'));
					$('#font_type optgroup[label="Available Google Fonts"]').append($('<option></option>').attr('value','\''+gfont+'\', sans-serif').text(gfont));
				});
			});
		} else {
			$('#font_type').append($('<optgroup></optgroup>').attr('label','No Google Fonts Available'));
		}
		
		$('#beaver-extender-fe-css-builder').addClass('beaver-extender-fe-css-builder-element');
		$('#beaver-extender-fe-css-builder *').addClass('beaver-extender-fe-css-builder-element');
		
		$('.beaver-extender-fe-css-builder-elements-select-ul').dropit();
		
		$('#beaver-extender-fe-css-builder-container .beaver-extender-fe-css-builder-elements-select-ul li ul li').hover(function() {
			var menu_id = $(this).parent().parent().parent().attr('id').slice(0,-3);
			var menu_text = $(this).text();
			$('#'+menu_id+' option').filter(function(index) { return $(this).text() === menu_text; }).attr('selected', 'selected').trigger('change');
		});
		
		$('#beaver-extender-fe-css-builder-container .beaver-extender-fe-css-builder-elements-select-ul li ul li').click(function() {
			$($(this).parent().parent().find('span')).text($(this).text());
		});
		
		/* BB Theme Labels */
		function beaver_extender_fe_css_builder_bb_theme_element_labels_append() {
			$('.fl-page').css('position', 'relative').append('<span id="page-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title=".fl-page"></span>');
			$('.fl-page-bar').css('position', 'relative').append('<span id="top-bar-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".fl-page-bar"></span>');
			$('.fl-page-header').css('position', 'relative').append('<span id="header-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".fl-page-header"></span>');
			$('.fl-page-nav-wrap').css('position', 'relative').append('<span id="header-menu-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".fl-page-nav-wrap"></span>');
			$('.fl-page-content').css('position', 'relative').append('<span id="content-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".fl-page-content"></span>');
			$('.fl-post-header').css('position', 'relative').append('<span id="post-header-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title=".fl-post-header"></span>');
			$('.fl-post-content').css('position', 'relative').append('<span id="post-content-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".fl-post-content"></span>');
			$('.fl-post-meta-bottom').css('position', 'relative').append('<span id="post-meta-bottom-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title=".fl-post-meta-bottom"></span>');
			$('.fl-comments').css('position', 'relative').append('<span id="comments-label" class="element-labels element-label-right dashicons dashicons-admin-customizer" title=".fl-comments"></span>');
			$('.comment-respond').css('position', 'relative').append('<span id="comment-respond-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".comment-respond"></span>');
			$('.fl-sidebar').css('position', 'relative').append('<span id="sidebar-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".fl-sidebar"></span>');
			$('.fl-page-footer-wrap').css('position', 'relative').append('<span id="footer-label" class="element-labels element-label-left dashicons dashicons-admin-customizer" title=".fl-page-footer-wrap"></span>');
		};
		
		function beaver_extender_fe_css_builder_bb_theme_element_labels_disable() {
			$('.fl-page').css('position', '');
			$('.fl-page-bar').css('position', '');
			$('.fl-page-header').css('position', '');
			$('.fl-page-nav-wrap').css('position', '');
			$('.fl-page-content').css('position', '');
			$('.fl-post-header').css('position', '');
			$('.fl-post-content').css('position', '');
			$('.fl-post-meta-bottom').css('position', '');
			$('.fl-comments').css('position', '');
			$('.comment-respond').css('position', '');
			$('.fl-sidebar').css('position', '');
			$('.fl-page-footer-wrap').css('position', '');
		};
		
		var beaver_extender_fe_css_builder_element_selectors_enable_handler = function() {
			var clickCounter = $('#beaver-extender-fe-css-builder-element-selectors-icon').data('clickCounter') || 0;
			
			if ( clickCounter == 0 ) {
				$('#beaver-extender-fe-css-builder-element-selectors-icon').addClass('element_selectors_enabled');
				beaver_extender_fe_css_builder_bb_theme_element_labels_append();
				$('.element-labels').click(function() {
					$('.beaver-extender-fe-css-builder-elements-select').change();
					$('#beaver-extender-fe-css-builder-nav-open-close-elements').click();
					var element_label_id = $(this).attr('id');
					var element_label_id_select = element_label_id.replace(/-/g, '_').slice(0,-5);
					$('.all-labeled-elements').hide();
					$('#'+element_label_id_select+'elements').show();
					var value = $(this).attr('title') + ' {';
					var styles = ' background: #DDFFDD !important;';
					$('#beaver-extender-fe-css-builder-highlight-css').html('');
					$('#beaver-extender-fe-css-builder-highlight-css').html('<style type="text/css">' + value + styles + '}</style>');
					setTimeout(function(){
						$('#beaver-extender-fe-css-builder-highlight-css').html('');
					}, 1500);
				});
				clickCounter = 1;
			} else {
				$('#beaver-extender-fe-css-builder-element-selectors-icon').removeClass('element_selectors_enabled');
				beaver_extender_fe_css_builder_bb_theme_element_labels_disable();
				$('.element-labels').remove();
				clickCounter = 0;
			}
			
			$('#beaver-extender-fe-css-builder-element-selectors-icon').data('clickCounter', clickCounter);
		};
		
		$('#beaver-extender-fe-css-builder-element-selectors-icon').bind('click', beaver_extender_fe_css_builder_element_selectors_enable_handler);
		
		$('.labeled-elements-button').click(function() {
			element_selectors_enabled_check();
		});
		
		$('#font_unit').change(function() {
			var font_unit = $(this).val();
			var font_size = $('#font_size').val();
			if(font_unit == 'rem') {
				$('#font_size').val(font_size / 10 );
			} else {
				$('#font_size').val(font_size * 10);
			}
		});
		
		$('.beaver-extender-fe-css-builder-css-builder-nav-all').click(function() {
			var css_nav_id = $(this).attr('id');
			$('.beaver-extender-fe-css-builder-all-css-builder').hide();
			$('#'+css_nav_id+'-box').show();
			$('.beaver-extender-fe-css-builder-css-builder-nav-all').removeClass('beaver-extender-fe-css-builder-options-nav-active');
			$('#'+css_nav_id).addClass('beaver-extender-fe-css-builder-options-nav-active');
		});
		
		$('#beaver-extender-fe-css-builder-output-cut-button').click(function() {
			$('#beaver-extender-fe-css-builder-nav-open-close-elements').click();
			$('#beaver-extender-fe-css-builder-css').html('<span class="dashicons dashicons-sos"></span><style id="css-builder-editor-css-style" type="text/css"></style>');
		});
		
		$('.beaver-extender-fe-css-builder-elements-select').change(function () {
			var value = $(this).val() || [];
			var styles = ' background: #DDFFDD !important;';
			$('#beaver-extender-fe-css-builder-highlight-css').html('<style type="text/css">' + value + styles + '}</style>');
		});
		
		$('#beaver-extender-fe-css-builder-container').show();
	    $('#beaver-extender-fe-css-builder-style-editor-toggle-icon').click(function() {
	    	element_selectors_enabled_check();
	    	$('#beaver-extender-fe-css-builder-highlight-css').html('');
	    	$('#beaver-extender-fe-css-builder-container').hide();
	    	$('body').removeClass('beaver-extender-fe-css-builder-active');
	    	$('#beaver-extender-fe-style-editor-form').show();
	    	$('body').addClass('beaver-extender-fe-style-editor-active');
	    });
	    
		function element_selectors_enabled_check() {
			if ( $('#beaver-extender-fe-css-builder-element-selectors-icon').hasClass('element_selectors_enabled') ) {
				$('#beaver-extender-fe-css-builder-element-selectors-icon').click();
			} else if ( $('#beaver-extender-fe-css-builder-bb-theme-element-selectors-icon').hasClass('element_selectors_enabled') ) {
				$('#beaver-extender-fe-css-builder-bb-theme-element-selectors-icon').click();
			} else if ( $('#beaver-extender-fe-css-builder-twentysixteen-element-selectors-icon').hasClass('element_selectors_enabled') ) {
				$('#beaver-extender-fe-css-builder-twentysixteen-element-selectors-icon').click();
			}
		}
		
		function beaver_extender_fe_css_builder_css_change() {
			var css = $('#beaver-extender-fe-css-builder-output').val();
			$('#beaver-extender-fe-css-builder-highlight-css').html('');
			$('#beaver-extender-fe-css-builder-css').html('<span class="dashicons dashicons-sos"></span><style id="css-builder-editor-css-style" type="text/css">' + css + '</style>');
		}
		
		$('#beaver-extender-fe-css-builder-output').bind('keyup paste', function(e) {
			if (e.type == 'paste') {
				setTimeout(beaver_extender_fe_css_builder_css_change, 20);
			} else {
				beaver_extender_fe_css_builder_css_change();
			}
		});

		$('.beaver-extender-fe-css-builder-buttons').click(function() {
			beaver_extender_fe_css_builder_css_change();
			$('#beaver-extender-fe-css-builder-output-cut-button').show();
			$('#beaver-extender-fe-css-builder-output-copied-button').hide();
			$('.code-builder-output-cut').removeClass('code-builder-output-cut-copied');
		});
		
		$('.beaver-extender-fe-css-builder-elements-select').change(function() {
			var css = $('#beaver-extender-fe-css-builder-output').val();
			var new_css = css.replace(/\n\n}/g,'\n}');
			$('#beaver-extender-fe-css-builder-output').val(new_css);
		});
		
		$('.beaver-extender-fe-css-builder-button-elements').click(function() {
			var css_length = $('#beaver-extender-fe-css-builder-output').val().length;
			var css_cursor_position = css_length - 3;
			$('#beaver-extender-fe-css-builder-output').selectRange(css_cursor_position,css_cursor_position);
			$('#beaver-extender-fe-css-builder-output-cut-button').show();
			$('#beaver-extender-fe-css-builder-output-copied-button').hide();
		});
	}
	
	/***
		Genesis Hooks Map
							***/
	var show_hide_bb_hooks_map_toggle_handler = function (event) {
		var clickCounter = $(event.target).data('clickCounter') || 0;
		
		if ( clickCounter == 0 ) {
			$('.beaver-extender-mapped-hooks').addClass('beaver-extender-mapped-hooks-styles').each(function(i){
			    var mapped_hook_id = $(this).attr('id');
			    $(this).text('Hook: '+mapped_hook_id);
			});
			clickCounter = 1;
		} else {
			$('.beaver-extender-mapped-hooks').empty().removeClass('beaver-extender-mapped-hooks-styles');
			clickCounter = 0;
		}
		
		$(event.target).data('clickCounter', clickCounter);
	};
		
	$('#css-builder-hooks-map').bind('click', show_hide_bb_hooks_map_toggle_handler);
	/***
		END BB Theme Hooks Map
								***/
	
});