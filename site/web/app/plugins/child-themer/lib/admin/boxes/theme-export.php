<?php
/**
 * Builds the Child Theme Export admin content.
 *
 * @package Child Themer
 */
?>

<div id="child-themer-settings-nav-export-box" class="child-themer-optionbox-outer-1col child-themer-all-options child-themer-options-display">
<?php	if ( ! empty( $_GET['notice'] ) ) {
			if ( $_GET['notice'] == 'theme-no-folder-name-error' ) {
?>				<div class="notice-box"><strong><?php _e( 'Folder Name Missing Error: You must fill in the "Theme Folder Name" field to create a Child Theme.', 'child-themer' ); ?></strong></div>
<?php		} elseif ( $_GET['notice'] == 'theme-exists-error' ) {
?>				<div class="notice-box"><strong><?php _e( 'Theme Creation Error: A theme folder with this name already exists in your /wp-content/themes/ direcotory.', 'child-themer' ); ?></strong></div>
<?php		} elseif ( $_GET['notice'] == 'screenshot-upload-error' ) {
?>				<div class="notice-box"><strong><?php _e( 'Screenshot Upload Error: There was a problem uploading your screenshot image. Make sure it is a .png image file and no more than 2mb in size.', 'child-themer' ); ?></strong></div>
<?php		} elseif ( $_GET['notice'] == 'theme-creation-success' ) {
?>				<div class="notice-box"><strong><?php _e( 'Child Theme successfully created! You may now activate it', 'child-themer' ); ?> <a href="<?php echo admin_url() ?>themes.php"><?php _e( 'HERE', 'child-themer' ); ?></a>.</strong></div>
<?php		} elseif ( $_GET['notice'] == 'theme-creation-success-mu' ) {
?>				<div class="notice-box"><strong><?php _e( 'Child Theme successfully created! To activate it you must first Network Enable it', 'child-themer' ); ?> <a href="<?php echo network_admin_url() ?>themes.php" target="_blank"><?php _e( 'HERE', 'child-themer' ); ?></a> <?php _e( 'and then you may activate it', 'child-themer' ); ?> <a href="<?php echo admin_url() ?>themes.php"><?php _e( 'HERE', 'child-themer' ); ?></a>.</strong></div>
<?php		} elseif ( $_GET['notice'] == 'child-themer-unwritable' ) {
?>				<div class="notice-box"><strong><?php _e( 'It appears that some of your files/folders are unwritable to Child Themer. Please refer to', 'child-themer' ); ?> <a href="http://themerdocs.cobaltapps.com/article/122-does-child-themer-have-any-special-file-permissions-requirements-or-recommendations" target="_blank"><?php _e( 'THIS KNOWLEDGEABLE ARTICLE', 'child-themer' ); ?></a> <?php _e( 'for a possible solution.', 'child-themer' ); ?></strong></div>
<?php		}
		}
?>	
	<div class="child-themer-optionbox-inner-1col" style="border: 1px solid #DFDFDF; -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05); box-shadow: 0 1px 2px rgba(0,0,0,.05);">
		<h3 style="border:0;"><?php _e( 'Child Theme Creator', 'child-themer' ); ?></h3>
		
		<div class="child-themer-child-theme-export-wrap" style="padding:10px 10px 10px 0; border-top:1px solid #F0F0F0; background:#FFFFFF;">
			<div class="child-themer-child-theme-export-2col-left">
				<div id="readme-box" style="margin-right:0; margin-bottom:0;">
					<p style="font-size:16px;">
						<?php _e( 'This tool creates a new Child Theme based on the currently active Parent Theme and the content of these form fields, and then places it in', 'child-themer' ); ?>
						<a href="<?php echo admin_url() ?>themes.php"><?php _e( 'Appearance > Themes', 'child-themer' ); ?></a>.
					</p>
					<p style="font-size:16px;">
						<?php _e( 'All that is required is that you fill in the "Theme Folder Name" field and then click the "Create Child Theme" button. Any other fields that are not filled in will simply use the default values.', 'child-themer' ); ?>
					</p>
					<p style="font-size:16px;">
						<?php _e( 'Note that if you select the option to clone the currently active Child Theme then all the files inside that Child Theme will be included with your new Child Theme. Otherwise a stock Child Theme will be created.', 'child-themer' ); ?>
					</p>
					<p style="font-size:16px;">
						<?php _e( 'Also note that if you do not select a custom screenshot image to be included with your custom Child Theme then a default one will be used. (Image must be in .png format, and no larger than 2mb in size.)', 'child-themer' ); ?>
					</p>
					<p style="font-size:16px; font-style:italic; color:#888;">
						<?php _e( '* = Required fields.', 'child-themer' ); ?>
					</p>
				</div>
			</div>
			
			<div class="child-themer-child-theme-export-2col-right">
				<div class="bg-box" style="margin-right:0; margin-bottom:0;">
				<form id="child-themer-theme-creator-form" method="post" enctype="multipart/form-data">
					<p>
						<input type="text" class="forbid-chars default-text" id="theme-folder-name" name="theme_folder_name" value="" title="<?php _e( 'example-folder-name', 'child-themer' ); ?>" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Theme Folder Name *', 'child-themer' ); ?><br />
						<input type="text" class="default-text" id="theme-name" name="theme_name" value="" title="<?php _e( $active_theme->get( 'Name' ), 'child-themer' ); ?>" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Theme Name', 'child-themer' ); ?><br />
						<input type="text" class="default-text" id="theme-uri" name="theme_uri" value="" title="<?php _e( $active_theme->get( 'ThemeURI' ), 'child-themer' ); ?>" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Theme URI', 'child-themer' ); ?><br />
						<input type="text" class="default-text" id="theme-description" name="theme_description" value="" title="<?php _e( $active_theme->get( 'Description' ), 'child-themer' ); ?>" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Description', 'child-themer' ); ?><br />
						<input type="text" class="default-text" id="theme-author" name="theme_author" value="" title="<?php _e( $active_theme->get( 'Author' ), 'child-themer' ); ?>" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Author', 'child-themer' ); ?><br />
						<input type="text" class="default-text" id="theme-author-uri" name="theme_author_uri" value="" title="<?php _e( $active_theme->get( 'AuthorURI' ), 'child-themer' ); ?>" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Author URI', 'child-themer' ); ?><br />
						<input type="text" class="default-text" id="theme-version-number" name="theme_version_number" value="" title="<?php _e( $active_theme->get( 'Version' ), 'child-themer' ); ?>" style="width:190px; margin-bottom:5px;" /> <?php _e( 'Version #', 'child-themer' ); ?><br />
						<input type="text" class="default-text" id="theme-tags" name="theme_tags" value="" title="<?php _e( implode( ', ', $active_theme->get( 'Tags' ) ), 'child-themer' ); ?>" style="width:190px;" /> <?php _e( 'Tags', 'child-themer' ); ?><br /><br />
						
						<?php if ( is_child_theme() ) { ?>
							<input type="checkbox" id="clone-theme" name="clone_theme" value="1" > <?php _e( 'Clone the currently active Child Theme?', 'child-themer' ); ?><br />
						<?php } ?>
						
						<div id="child-themer-screenshot-image-upload-container">
						    <span><?php _e( 'Select Screenshot Image:', 'child-themer' ); ?></span><br />
						    <input type="file" name="screenshot_upload" id="screenshot_upload">							
						</div><br />
						
						<div id="child-themer-theme-creator-button-container">
							<input type="submit" name="clicked_button" value="<?php _e( 'Create Child Theme', 'child-themer' ); ?>" class="button-highlighted child-themer-settings-button button rounded-button"/>
							<input type="hidden" name="action" value="child_themer_theme_create">
							<img class="child-themer-ajax-save-spinner" src="<?php echo site_url() . '/wp-admin/images/spinner-2x.gif'; ?>" />							
						</div>
					</p>
				</form>
				</div>
			</div>
		</div>
	</div>
	<div class="child-themer-optionbox-inner-1col" style="border: 1px solid #DFDFDF; -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05); box-shadow: 0 1px 2px rgba(0,0,0,.05);">
		<h3 style="border:0;"><?php _e( 'Child Theme Export', 'child-themer' ); ?></h3>
				
		<div class="child-themer-child-theme-export-wrap" style="padding:10px 10px 10px 0; border-top:1px solid #F0F0F0; background:#FFFFFF;">
			<div class="child-themer-child-theme-export-2col-left">
				<div id="readme-box" style="margin-right:0; margin-bottom:0;">
					<p>
						<?php _e( 'This feature simply zips up the currently active Child Theme and then downloads it to your computer. Ideal for backup or transferring to a new WordPress installation.', 'child-themer' ); ?>
					</p>
				</div>
			</div>
			
			<div class="child-themer-child-theme-export-2col-right">
				<div class="bg-box" style="margin-right:0; margin-bottom:0;">
				<form id="child-themer-theme-export-form" method="post" enctype="multipart/form-data">
					<p>
						<input type="submit" name="clicked_button" value="<?php _e( 'Download Child Theme', 'child-themer' ); ?>" class="button-highlighted child-themer-settings-button button rounded-button"/>
						<input type="hidden" name="action" value="child_themer_theme_export">
					</p>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>