<?php
/**
 * Builds the Settings Import/Export admin content.
 *
 * @package Extender
 */
?>

<div id="beaver-extender-settings-nav-import-export-box" class="beaver-extender-optionbox-outer-1col beaver-extender-all-options">
	
<?php	if ( ! empty( $_GET['notice'] ) ) {
			if ( $_GET['notice'] == 'import-error' ) {
?>				<div class="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin-bottom:15px;padding:5px;clear:both;"><strong><?php _e( 'Settings/Custom Import Error: Import File Must Be In .dat Format (ie. my_backup.dat)', 'extender' ); ?></strong></div>
<?php		} elseif ( $_GET['notice'] == 'import-complete' ) {
?>				<div class="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin-bottom:15px;padding:5px;clear:both;"><strong><?php _e( 'Settings/Custom Import Complete', 'extender' ); ?></strong></div>
<?php		}
		}
?>

	<div class="beaver-extender-optionbox-inner-1col">
		<h3 style="border:none; border-bottom:1px solid #F0F0F0; -webkit-box-shadow:none; box-shadow:none;"><?php _e( 'Beaver Extender Settings/Custom Import/Export', 'extender' ); ?> <a href="http://extenderdocs.cobaltapps.com/article/132-beaver-extender-settings-custom-import-export" class="tooltip-mark" target="_blank">[?]</a></h3>
		
		<div style="width:100%; float:left; padding:10px 10px 10px 0;">
			<div class="beaver-extender-optionbox-2col-left-wrap" style="padding: 0 10px;">
				<form method="post">
				<div class="bg-box" style="margin-right:0; margin-bottom:0;">
					<h4><?php _e( 'Export Settings/Custom Options', 'extender' ); ?><span style="float:right;">( <span id="settings-export-check-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Check', 'extender' ); ?></span> | <span id="settings-export-uncheck-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Uncheck', 'extender' ); ?></span> )</span></h4>
					<div class="beaver-extender-import-export-checkboxes-wrap">
						<p>
							<input class="settings-export-check" type="checkbox" id="export-settings" name="export_settings" value="1" checked /> <?php _e( 'Plugin Settings', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-css" name="export_css" value="1" checked /> <?php _e( 'Custom CSS', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-functions" name="export_functions" value="1" checked /> <?php _e( 'Custom Functions', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-js" name="export_js" value="1" checked /> <?php _e( 'Custom JS', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-templates" name="export_templates" value="1" checked /> <?php _e( 'Custom Templates', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-labels" name="export_labels" value="1" checked /> <?php _e( 'Custom Labels', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-conditionals" name="export_conditionals" value="1" checked /> <?php _e( 'Custom Conditionals', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-widgets" name="export_widgets" value="1" checked /> <?php _e( 'Custom Widget Areas', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-export-check" type="checkbox" id="export-hooks" name="export_hooks" value="1" checked /> <?php _e( 'Custom Hook Boxes', 'extender' ); ?>
						</p>
					</div>
					<p class="beaver-extender-import-export-action-fields">
						<input type="text" id="beaver-extender-export-name" class="default-text forbid-chars" name="beaver_extender_export_name" value="" title="Export File Name" style="width:100%;" />
					</p>
					<p class="beaver-extender-import-export-action-fields">
						<input type="submit" name="clicked_button" value="<?php _e( 'Export Extender Options', 'extender' ); ?>" class="button-highlighted beaver-extender-custom-fonts-button button rounded-button"/>
						<input type="hidden" name="action" value="beaver_extender_custom_export">
					</p>
				</div>
				</form>
			</div>
		
			<div class="beaver-extender-optionbox-2col-right-wrap" style="padding: 0 10px;">
				<form method="post" enctype="multipart/form-data">
				<div class="bg-box" style="margin-right:0; margin-bottom:0;">
					<h4><?php _e( 'Import Settings/Custom Options', 'extender' ); ?><span style="float:right;">( <span id="settings-import-check-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Check', 'extender' ); ?></span> | <span id="settings-import-uncheck-all" style="color:#21759B; cursor:pointer;"><?php _e( 'Uncheck', 'extender' ); ?></span> )</span></h4>
					<div class="beaver-extender-import-export-checkboxes-wrap">
						<p>
							<input class="settings-import-check" type="checkbox" id="import-settings" name="import_settings" value="1" checked /> <?php _e( 'Plugin Settings', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-css" name="import_css" value="1" checked /> <?php _e( 'Custom CSS', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-functions" name="import_functions" value="1" checked /> <?php _e( 'Custom Functions', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-js" name="import_js" value="1" checked /> <?php _e( 'Custom JS', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-templates" name="import_templates" value="1" checked /> <?php _e( 'Custom Templates', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-labels" name="import_labels" value="1" checked /> <?php _e( 'Custom Labels', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-conditionals" name="import_conditionals" value="1" checked /> <?php _e( 'Custom Conditionals', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-widgets" name="import_widgets" value="1" checked /> <?php _e( 'Custom Widget Areas', 'extender' ); ?>
						</p>
						<p>
							<input class="settings-import-check" type="checkbox" id="import-hooks" name="import_hooks" value="1" checked /> <?php _e( 'Custom Hook Boxes', 'extender' ); ?>
						</p>
					</div>
					<p class="beaver-extender-import-export-action-fields">
						<input style="width:100%;" name="custom_import_file" type="file" />
					</p>
					<p class="beaver-extender-import-export-action-fields">
						<input type="submit" name="clicked_button" value="<?php _e( 'Import Extender Options', 'extender' ); ?>" class="button-highlighted beaver-extender-custom-fonts-button button rounded-button"/>
						<input type="hidden" name="action" value="beaver_extender_custom_import">
					</p>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>