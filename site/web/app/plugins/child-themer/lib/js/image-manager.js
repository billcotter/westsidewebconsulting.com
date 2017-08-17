jQuery(document).ready(function($) {
	
	$('.child-themer-image-info-button').click(function() {
		var active_li = $(this).closest('li');
		
		active_li.find('.child-themer-listed-image-inner').toggleClass('child-themer-faded child-themer-not-faded');
		active_li.find('.child-themer-listed-image-info-inner').toggleClass('child-themer-faded child-themer-not-faded');
		active_li.find('.child-themer-listed-image-inner.child-themer-faded').toggle();
		active_li.find('.child-themer-listed-image-inner.child-themer-not-faded').fadeToggle();
		active_li.find('.child-themer-listed-image-info-inner.child-themer-faded').toggle();
		active_li.find('.child-themer-listed-image-info-inner.child-themer-not-faded').fadeToggle();
	});
	
	$('.child-themer-image-rename-button').click(function() {
		var answer = confirm ('Are you sure you want to rename this image?');
		if(answer) {
			$('#child-themer-image-file-control-form li').removeAttr('id');
			$(this).closest('li').attr('id', 'child-themer-child-theme-images-list-rename');
			$('#child-themer-image-file-control-form').submit();
		}
	});
	
	$('.child-themer-image-delete-button').click(function() {
		var answer = confirm ('Are you sure you want to delete this image?');
		if(answer) {
			$('#child-themer-image-file-control-form li').removeAttr('id');
			$(this).closest('li').attr('id', 'child-themer-child-theme-images-list-delete');
			$('#child-themer-image-file-control-form').submit();
		}
	});
	
	$('.child-themer-image-delete-all-button').click(function() {
		var answer = confirm ('Are you sure you want to delete ALL Child Theme images?');
		if(answer) {
			$('#child-themer-image-file-control-form li').removeAttr('id');
			$('.child-themer-image-delete-all-button-container').attr('id', 'child-themer-child-theme-images-list-delete-all');
			$('#child-themer-image-file-control-form').submit();
		}
	});
	
	function show_message(response, theme_type) {
		$('#child-themer-image-file-control-form #child-themer-child-theme-images-list-rename .child-themer-ajax-save-spinner').hide();
		$('#child-themer-image-file-control-form #child-themer-child-theme-images-list-rename .child-themer-saved').html(response).fadeIn('slow');
		$('#child-themer-image-file-control-form #child-themer-child-theme-images-list-delete .child-themer-ajax-save-spinner').hide();
		$('#child-themer-image-file-control-form #child-themer-child-theme-images-list-delete .child-themer-saved').html(response).fadeIn('slow');
		$('#child-themer-image-file-control-form #child-themer-child-theme-images-list-delete-all .child-themer-ajax-save-spinner').hide();
		$('#child-themer-image-file-control-form #child-themer-child-theme-images-list-delete-all .child-themer-saved').html(response).fadeIn('slow');
		window.setTimeout(function() {
			$('#child-themer-image-file-control-form .child-themer-saved').fadeOut('slow');
			if(response.substring(0, 5) != 'Error') {
				location.reload();
			}
		}, 2222);
	}
	
	$('#child-themer-image-file-control-form').on('submit', function() {
		$('#child-themer-image-file-control-form #child-themer-child-theme-images-list-rename .child-themer-ajax-save-spinner').show();
		$('#child-themer-image-file-control-form #child-themer-child-theme-images-list-delete .child-themer-ajax-save-spinner').show();
		$('#child-themer-image-file-control-form #child-themer-child-theme-images-list-delete-all .child-themer-ajax-save-spinner').show();
		
		if($('#child-themer-child-theme-images-list-rename').length != 0) {
			var action_type = 'rename';
			var name = $('#child-themer-child-theme-images-list-rename .child-themer-listed-image-name').attr('title');
			var new_name = $('#child-themer-child-theme-images-list-rename .child-themer-listed-image-name').val();
		} else if($('#child-themer-child-theme-images-list-delete').length != 0) {
			var action_type = 'delete';
			var name = $('#child-themer-child-theme-images-list-delete .child-themer-listed-image-name').attr('title');
			var new_name = '';
		} else if($('#child-themer-child-theme-images-list-delete-all').length != 0) {
			var action_type = 'delete_all';
			var name = '';
			var new_name = '';
		}
		var data = $(this).serialize()+'&action_type='+action_type+'&name='+name+'&new_name='+new_name;
		jQuery.post(ajaxurl, data, function(response) {
			if(response) {
				show_message(response);
			}
		});
		
		return false;
	});
	
});