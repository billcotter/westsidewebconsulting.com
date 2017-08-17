<?php
/**
 * Builds the Custom PHP Builder admin content.
 *
 * @package Extender
 */
?>

<div style="display:none;" id="beaver-extender-custom-php-builder" class="beaver-extender-optionbox-outer-1col">
	<div class="beaver-extender-optionbox-inner-1col">
		<h3 style="width:805px; border-bottom:0;"><?php _e( 'Custom PHP Builder', 'extender' ); ?> <a href="http://extenderdocs.cobaltapps.com/article/98-custom-php-builder" class="tooltip-mark" target="_blank">[?]</a></h3>

		<div id="beaver-extender-custom-php-builder-wrap">
		<form name="form">
			<div id="beaver-extender-custom-php-builder-wrap-inner" class="bg-box">
				<div id="beaver-extender-custom-php-builder-options">
					<p style="width:48%; float:left;">
						<select id="wa_shortcodes" class="php-builder-elements-select" name="wa_shortcodes" size="1" style="width:150px;">
						<?php beaver_extender_list_wa_shortcode_options(); ?>
						</select>
						<input id="build_defined_wa_shortcode_php" class="button" type="button" value="Create Widget Area Shortcode" onclick="insertAtCaret(this.form.text, '['+this.form.wa_shortcodes.value+']\n')">
					</p>
					<p style="width:46%; float:right;">
						<select id="hb_shortcodes" class="php-builder-elements-select" name="hb_shortcodes" size="1" style="width:150px;">
						<?php beaver_extender_list_hb_shortcode_options(); ?>
						</select>
						<input id="build_defined_hb_shortcode_php" class="button" type="button" value="Create Hook Box Shortcode" onclick="insertAtCaret(this.form.text, '['+this.form.hb_shortcodes.value+']\n')">
					</p>
					<p style="width:48%; margin-top:0; float:left;">
						<select id="bb_templates_shortcodes" class="php-builder-elements-select" name="bb_templates_shortcode" size="1" style="width:150px;">
						<?php beaver_extender_list_bb_templates_shortcode_options(); ?>
						</select>
						<input id="build_defined_bb_templates_shortcode_php" class="button" type="button" value="Create BB Templates Shortcode" onclick="insertAtCaret(this.form.text, '[fl_builder_insert_layout slug=&#34;'+this.form.bb_templates_shortcode.value+'&#34; type=&#34;fl-builder-template&#34;]\n')">
					</p>
					<p style="width:48%; margin-top:0; float:right;">
						<select id="forced_layouts" class="php-builder-elements-select" name="bb_template_code" size="1">
						<?php beaver_extender_list_bb_template_code_options(); ?>
						</select>
						<input id="build_bb_template_code_php" class="button" type="button" value="Insert BB Theme Template Code" onclick="insertAtCaret(this.form.text, this.form.bb_template_code.value+'\n')">
					</p>
					<p style="margin-top:0; float:left;">
						<span style="float:left;">
							<?php _e( 'Code Snippets', 'dynamik' ); ?>
							<select id="code_snippets" class="php-builder-elements-select" name="code_snippets" size="1">
							<?php beaver_extender_list_code_snippets(); ?>
							</select>
						</span>
						<input id="build_code_snippets_php" class="button" style="margin-left:5px !important; float:left !important;" type="button" value="Insert Code Snippet" onclick="insertAtCaret(this.form.text, this.form.code_snippets.value+'\n')">
					</p>
					<p style="width:48%; margin-top:0; float:right;">
						<input id="wrap_in_php_tags" class="button" type="button" value="&#60;?php Wrap Code ?&#62;">
						<input id="build_new_line_php" class="button" type="button" value="Add New Line (\n)" title="New Line" onclick="insertAtCaret(this.form.text, '\n')">
					</p>
				</div>

				<div id="php-builder-output-wrap">
					<textarea wrap="off" id="php-builder-output" class="beaver-extender-tabby-textarea code-builder-output" name="text"></textarea>
				</div>
			</div>
		</form>
		<button id="php-builder-output-cut-button" class="code-builder-output-cut" data-clipboard-action="cut" data-clipboard-target="#php-builder-output">Copy To Clipboard</button>
		<button style="display:none;" id="php-builder-output-copied-button" class="code-builder-output-cut">Copied!</button>
		</div>
	</div>
</div>