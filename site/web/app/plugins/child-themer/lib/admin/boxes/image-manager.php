<?php
/**
 * Builds the Child Theme Image Manager admin content.
 *
 * @package Child Themer
 */
?>

<div id="child-themer-settings-nav-export-box" class="child-themer-optionbox-outer-1col child-themer-all-options child-themer-options-display">
	<div class="child-themer-optionbox-inner-1col" style="border: 1px solid #DFDFDF; -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05); box-shadow: 0 1px 2px rgba(0,0,0,.05);">
		<h3 style="border:0;"><?php _e( 'Child Theme Image Uploader', 'child-themer' ); ?></h3>
		
		<div class="child-themer-child-theme-export-wrap" style="padding:10px 10px 10px 0; border-top:1px solid #F0F0F0; background:#FFFFFF;">

			<div class="bg-box" style="margin-right:0; margin-bottom:0;">
				<form id="child-themer-image-file-upload-form" method="POST" enctype="multipart/form-data">
				    <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
				    <input type="file" name="images"/>
				    <input class="button rounded-button button-highlighted" type="submit" value="upload"/>
					<?php
					if ( is_dir( $child_images ) ) {
						
						$image = new Bulletproof\Image($_FILES);
						$image_upload_name = isset( $_FILES['images']['name'] ) ? $_FILES['images']['name'] : 'temp-image-name';
						$image_upload_name = substr( $image_upload_name, 0, strrpos( $image_upload_name, '.' ) );
						$image->setName($image_upload_name);
						$image->setSize(100, 5000000);
						$image->setLocation( $child_images );
						
						if ( $image['images'] ) {
						
							$upload = $image->upload(); 
							
							echo '<div class="child-themer-image-file-upload-status">';
							
							if( $upload )
								echo '<span class="dashicons dashicons-yes"></span>Image Upload Successful!';
							else
								echo '<span class="dashicons dashicons-warning"></span>' . $image['error'];
								
							echo '</div>';
						
						}						
						
					} else {
						
						echo 'test';
						
					}
					?>
				</form>
			</div>
		</div>
	</div>
	
	<div class="child-themer-optionbox-inner-1col" style="border: 1px solid #DFDFDF; -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05); box-shadow: 0 1px 2px rgba(0,0,0,.05);">
		<h3 style="border:0;"><?php _e( 'Child Theme Images', 'child-themer' ); ?></h3>
		
		<div class="child-themer-child-theme-export-wrap" style="padding:10px 10px 10px 0; border-top:1px solid #F0F0F0; background:#FFFFFF;">

			<div class="bg-box" style="margin-right:0; margin-bottom:0;">
				<form action="/" id="child-themer-image-file-control-form" name="child-themer-image-file-control-form">
					<input type="hidden" name="action" value="child_themer_image_file_control_save" />
					<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'child-themer-image-file-control' ); ?>" />
					
					<ul class="child-themer-child-theme-images-list">
						<?php
							foreach( glob( $child_images . '/*' ) as $filename ) {
								
								$image_size = getimagesize( $filename );
								
								echo '<li class="child-themer-child-theme-images-list-item">';
								echo '<div class="child-themer-listed-image-header">';
								echo '<input class="child-themer-listed-image-name" type="text" name="themer[image_name]" value="' . basename( $filename ) . '" title="' . basename( $filename ) . '">';
								echo '<span class="child-themer-image-rename-button"/>' . __( 'Rename', 'child-themer' ) . '</span>';
								echo '</div>';
								echo '<div class="child-themer-listed-image-inner child-themer-not-faded">';
								echo '<a href="' . $child_images_url . '/' . substr( $filename, strrpos( $filename, '/' ) + 1 ) . '" target="_blank"><img class="child-themer-listed-image" height="100" width="10" src="' . $child_images_url . '/' . substr( $filename, strrpos( $filename, '/' ) + 1 ) . '"></a>';
								echo '<img class="child-themer-ajax-save-spinner" src="' . site_url() . '/wp-admin/images/spinner-2x.gif" />';
								echo '<span class="child-themer-saved"></span>';
								echo '</div>';
								echo '<div class="child-themer-listed-image-info-inner child-themer-faded">';
								echo '<span class="child-themer-image-info-item-heading"><span class="dashicons dashicons-info"></span>' . __( 'Image Info', 'child-themer' ) . '</span>';
								echo '<span class="child-themer-image-info-item"><span class="dashicons dashicons-admin-links"></span><a href="' . $child_images_url . '/' . substr( $filename, strrpos( $filename, '/' ) + 1 ) . '" target="_blank">' . basename( $filename ) . '</span></a>';
								echo '<span class="child-themer-image-info-item"><span class="dashicons dashicons-format-image"></span>' . __( 'W: ', 'child-themer' ) . $image_size[0] . 'px' .  __( ' H: ', 'child-themer' ) . $image_size[1] . 'px' . '</span>';
								echo '<span class="child-themer-image-info-item"><span class="dashicons dashicons-format-image"></span>' . __( 'Filesize: ', 'child-themer' ) . child_themer_format_size_units( filesize( $filename ) ) . '</span>';
								echo '</div>';
								echo '<div class="child-themer-listed-image-footer">';
								echo '<span class="child-themer-image-info-button dashicons dashicons-editor-help"/></span>';
								echo '<span class="child-themer-image-delete-button dashicons dashicons-no"/></span>';
								echo '</div>';
								echo '</li>';
							    
							}
						?>
					</ul>
					
					<div class="child-themer-image-delete-all-button-container">
						<span class="button rounded-button button-highlighted child-themer-image-delete-all-button"/><?php _e( 'Delete ALL Images', 'child-themer' ); ?></span>
						<img class="child-themer-ajax-save-spinner" src="<?php echo site_url(); ?>/wp-admin/images/spinner-2x.gif" />
						<span class="child-themer-saved"></span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>