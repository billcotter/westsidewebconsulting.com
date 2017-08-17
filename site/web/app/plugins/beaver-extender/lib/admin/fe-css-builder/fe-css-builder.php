<?php
/**
 * Builds the Beaver Extender FE CSS Builder.
 *
 * @package Extender
 */

add_action( 'beaver_extender_fe_style_editor_form', 'beaver_extender_fe_css_builder_build_form' );	
/**
 * Build and add_action the FE CSS Editor form.
 *
 * @since 2.0
 */
function beaver_extender_fe_css_builder_build_form() {
	
?>
	<div id="beaver-extender-fe-css-builder-container" style="display:none;">
		
		<div id="beaver-extender-fe-css-builder-nav">
			<ul>
				<li id="beaver-extender-fe-css-builder-nav-open-close-elements" class="beaver-extender-fe-css-builder-css-builder-nav-all beaver-extender-fe-css-builder-options-nav-active"><a>Elements</a></li>
				<li id="beaver-extender-fe-css-builder-nav-backgrounds" class="beaver-extender-fe-css-builder-css-builder-nav-all"><a>Backgrounds</a></li>
				<li id="beaver-extender-fe-css-builder-nav-borders" class="beaver-extender-fe-css-builder-css-builder-nav-all"><a>Borders</a></li>
				<li id="beaver-extender-fe-css-builder-nav-border-radius" class="beaver-extender-fe-css-builder-css-builder-nav-all"><a>Border Radius</a></li>
				<li id="beaver-extender-fe-css-builder-nav-margins" class="beaver-extender-fe-css-builder-css-builder-nav-all"><a>Margins</a></li>
				<li id="beaver-extender-fe-css-builder-nav-padding" class="beaver-extender-fe-css-builder-css-builder-nav-all"><a>Padding</a></li>
				<li id="beaver-extender-fe-css-builder-nav-fonts" class="beaver-extender-fe-css-builder-css-builder-nav-all"><a>Fonts</a></li>
				<li id="beaver-extender-fe-css-builder-nav-width-float" class="beaver-extender-fe-css-builder-css-builder-nav-all"><a>Width/Float</a></li>
				<li id="beaver-extender-fe-css-builder-nav-shadows" class="beaver-extender-fe-css-builder-css-builder-nav-all"><a class="beaver-extender-fe-css-builder-options-nav-last">Shadows</a></li>
				<span id="beaver-extender-fe-css-builder-element-selectors-icon" class="beaver-extender-fe-css-builder-icons dashicons dashicons-screenoptions"></span>
				<span id="beaver-extender-fe-css-builder-style-editor-toggle-icon" class="beaver-extender-fe-css-builder-icons dashicons dashicons-editor-code"></span>
			</ul>
		</div>
		
		<div id="beaver-extender-fe-css-builder-col-container">
			
			<form id="beaver-extender-fe-css-builder-form" name="beaver-extender-fe-css-builder-form">
			
				<div class="beaver-extender-fe-css-builder-col beaver-extender-fe-css-builder-col-left">
					
					<div id="beaver-extender-fe-css-builder-nav-open-close-elements-box" class="beaver-extender-fe-css-builder-all-css-builder beaver-extender-fe-css-builder-options-display">
						<p style="padding-top:5px; float:left;">
							
							<?php beaver_extender_fe_css_builder_display_labeled_elements(); ?>
							
							<p class="beaver-extender-fe-css-builder-info"><?php _e( 'Click ', 'extender' ); ?><span class="dashicons dashicons-screenoptions"></span><?php _e( ' to enable the element selector labels, then select and insert elements to be styled.', 'extender' ); ?></p>
							<p class="beaver-extender-fe-css-builder-info"><?php _e( 'Learn:', 'extender' ); ?> <a href="https://vimeo.com/200436020" target="_blank"><?php _e( 'How To Use The FE CSS Builder', 'extender' ); ?></a></p>
							<p class="beaver-extender-fe-css-builder-info"><?php _e( 'CSS Links: ', 'extender' ); ?><a href="http://www.w3schools.com/css/css_intro.asp" target="_blank"><?php _e( 'Intro', 'extender' ); ?></a> | <a href="http://www.w3schools.com/css/" target="_blank"><?php _e( 'Turorials', 'extender' ); ?></a> | <a href="http://www.w3schools.com/cssref/" target="_blank"><?php _e( 'References', 'extender' ); ?></a></p>
						</p>
					</div>
					
					<div id="beaver-extender-fe-css-builder-nav-backgrounds-box" class="beaver-extender-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="beaver-extender-fe-css-builder-options-box">
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" type="button" value="Insert Background Color" style="width:160px;margin:0 5px 10px 0 !important;float:left;" onclick="insertAtCaret(this.form.text, '\tbackground: #'+this.form.background_color.value+';\n')">
								<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" id="background_color" name="background_color" value="" style="width:90px;" /><br />
							</div>
							<div class="beaver-extender-fe-css-builder-options-box">
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" type="button" value="Insert Transparent Background CSS" onclick="insertAtCaret(this.form.text, '\tbackground: transparent;\n')"><br />
							</div>
						</p>
					</div>
					
					<div id="beaver-extender-fe-css-builder-nav-borders-box" class="beaver-extender-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Type', 'extender' ); ?>
								<select id="border_type" name="border_type" size="1" style="width:100px;margin-bottom:10px;">
									<option value="border"><?php _e( 'Full', 'extender' ); ?></option>
									<option value="border-top"><?php _e( 'Top', 'extender' ); ?></option>
									<option value="border-bottom"><?php _e( 'Bottom', 'extender' ); ?></option>
									<option value="border-left"><?php _e( 'Left', 'extender' ); ?></option>
									<option value="border-right"><?php _e( 'Right', 'extender' ); ?></option>
								</select>
								<?php _e( 'Thickness', 'extender' ); ?>
								<input type="text" id="border_thickness" name="border_thickness" value="0" style="width:35px;" /><?php _e( 'px', 'extender' ); ?><br />
								<?php _e( 'Style', 'extender' ); ?>
								<select id="border_style" name="border_style" size="1" style="width:100px;">
									<option value="solid"><?php _e( 'solid', 'extender' ); ?></option>
									<option value="dotted"><?php _e( 'dotted', 'extender' ); ?></option>
									<option value="dashed"><?php _e( 'dashed', 'extender' ); ?></option>
									<option value="double"><?php _e( 'double', 'extender' ); ?></option>
									<option value="groove"><?php _e( 'groove', 'extender' ); ?></option>
									<option value="ridge"><?php _e( 'ridge', 'extender' ); ?></option>
									<option value="inset"><?php _e( 'inset', 'extender' ); ?></option>
									<option value="outset"><?php _e( 'outset', 'extender' ); ?></option>
								</select>
								<?php _e( 'Color', 'extender' ); ?>
								<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="border_color" name="border_color" value="" /><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" type="button" value="Insert Border CSS" style="margin-top:10px;" onclick="insertAtCaret(this.form.text, '\t'+this.form.border_type.value+': '+this.form.border_thickness.value+'px '+this.form.border_style.value+' #'+this.form.border_color.value+';\n')"><br />
							</div>
							<div class="beaver-extender-fe-css-builder-options-box">
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" type="button" value="Insert Border Zero CSS" onclick="insertAtCaret(this.form.text, '\tborder: 0;\n')"><br />
							</div>
						</p>
					</div>
					
					<div id="beaver-extender-fe-css-builder-nav-border-radius-box" class="beaver-extender-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Tp-Lft', 'extender' ); ?>
								<input type="text" id="border_radius_top" name="border_radius_top" value="0" style="width:24px;" />
								<?php _e( 'Tp-Rt', 'extender' ); ?>
								<input type="text" id="border_radius_right" name="border_radius_right" value="0" style="width:24px;" />
								<?php _e( 'Btm-Rt', 'extender' ); ?>
								<input type="text" id="border_radius_bottom" name="border_radius_bottom" value="0" style="width:24px;" />
								<?php _e( 'Btm-Lft', 'extender' ); ?>
								<input type="text" id="border_radius_left" name="border_radius_left" value="0" style="width:24px;" /><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Border Radius CSS" onclick="insertAtCaret(this.form.text, '\t-webkit-border-radius: '+this.form.border_radius_top.value+'px '+this.form.border_radius_right.value+'px '+this.form.border_radius_bottom.value+'px '+this.form.border_radius_left.value+'px;\n\tborder-radius: '+this.form.border_radius_top.value+'px '+this.form.border_radius_right.value+'px '+this.form.border_radius_bottom.value+'px '+this.form.border_radius_left.value+'px;\n')">
							</div>
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Full', 'extender' ); ?>
								<input type="text" id="border_radius_full" name="border_radius_full" value="0" style="width:24px;" /><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Full Border Radius CSS" onclick="insertAtCaret(this.form.text, '\t-webkit-border-radius: '+this.form.border_radius_full.value+'px;\n\tborder-radius: '+this.form.border_radius_full.value+'px;\n')">
							</div>
						</p>
					</div>
					
					<div id="beaver-extender-fe-css-builder-nav-margins-box" class="beaver-extender-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Top', 'extender' ); ?>
								<input type="text" id="margin_top" name="margin_top" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Right', 'extender' ); ?>
								<input type="text" id="margin_right" name="margin_right" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Bottom', 'extender' ); ?>
								<input type="text" id="margin_bottom" name="margin_bottom" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Left', 'extender' ); ?>
								<input type="text" id="margin_left" name="margin_left" value="0" style="width:25px;" /><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_top.value+'px '+this.form.margin_right.value+'px '+this.form.margin_bottom.value+'px '+this.form.margin_left.value+'px;\n')"><br />
							</div>
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Top/Bottom', 'extender' ); ?>
								<input type="text" id="margin_top_bottom" name="margin_top_bottom" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Left/Right', 'extender' ); ?>
								<input type="text" id="margin_left_right" name="margin_left_right" value="0" style="width:25px;margin-right:5px;" /><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Top/Bottom Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_top_bottom.value+'px '+this.form.margin_left_right.value+'px;\n')"><br />
							</div>
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Full', 'extender' ); ?>
								<input type="text" id="margin_full" name="margin_full" value="0" style="width:25px;margin-right:5px;" /><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Full Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_full.value+'px;\n')"><br />
							</div>
						</p>
					</div>
					
					<div id="beaver-extender-fe-css-builder-nav-padding-box" class="beaver-extender-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Top', 'extender' ); ?>
								<input type="text" id="padding_top" name="padding_top" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Right', 'extender' ); ?>
								<input type="text" id="padding_right" name="padding_right" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Bottom', 'extender' ); ?>
								<input type="text" id="padding_bottom" name="padding_bottom" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Left', 'extender' ); ?>
								<input type="text" id="padding_left" name="padding_left" value="0" style="width:25px;" /><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_top.value+'px '+this.form.padding_right.value+'px '+this.form.padding_bottom.value+'px '+this.form.padding_left.value+'px;\n')">
							</div>
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Top/Bottom', 'extender' ); ?>
								<input type="text" id="padding_top_bottom" name="padding_top_bottom" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Left/Right', 'extender' ); ?>
								<input type="text" id="padding_left_right" name="padding_left_right" value="0" style="width:25px;margin-right:5px;" /><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Top/Bottom Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_top_bottom.value+'px '+this.form.padding_left_right.value+'px;\n')"><br />
							</div>
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Full', 'extender' ); ?>
								<input type="text" id="padding_full" name="padding_full" value="0" style="width:25px;margin-right:5px;" /><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Full Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_full.value+'px;\n')"><br />
							</div>
						</p>
					</div>
	
					<div id="beaver-extender-fe-css-builder-nav-fonts-box" class="beaver-extender-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<input id="font-type-button" class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Font Type" onclick="insertAtCaret(this.form.text, '\tfont-family: '+this.form.font_type.value+';\n')">
							<select id="font_type" class="beaver-extender-fe-css-builder-font-options-width-control" name="font_type" size="1">
								<optgroup label="Standard Fonts">
									<option value="Arial, sans-serif"><?php _e( 'Arial', 'extender' ); ?></option>
									<option value="'Arial Black', sans-serif"><?php _e( 'Arial Black', 'extender' ); ?></option>
									<option value="'Courier New', sans-serif"><?php _e( 'Courier New', 'extender' ); ?></option>
									<option value="Georgia, serif"><?php _e( 'Georgia', 'extender' ); ?></option>
									<option value="Helvetica, sans-serif"><?php _e( 'Helvetica', 'extender' ); ?></option>
									<option value="Impact, sans-serif"><?php _e( 'Impact', 'extender' ); ?></option>
									<option value="'Lucida Console', sans-serif"><?php _e( 'Lucida Console', 'extender' ); ?></option>
									<option value="'Lucida Sans Unicode', sans-serif"><?php _e( 'Lucida Sans Unicode', 'extender' ); ?></option>
									<option value="Tahoma, sans-serif"><?php _e( 'Tahoma', 'extender' ); ?></option>
									<option value="'Times New Roman', serif"><?php _e( 'Times New Roman', 'extender' ); ?></option>
									<option value="'Trebuchet MS', sans-serif"><?php _e( 'Trebuchet MS', 'extender' ); ?></option>
									<option value="Verdana, sans-serif"><?php _e( 'Verdana', 'extender' ); ?></option>
								</optgroup>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Font Size" onclick="insertAtCaret(this.form.text, '\tfont-size: '+this.form.font_size.value+this.form.font_unit.value+';\n')">
							<input type="text" id="font_size" name="font_size" value="12" style="width:35px;" />
							<select id="font_unit" name="font_unit" size="1" class="iewide" style="width:50px;">
								<option value="px"><?php _e( 'px', 'extender' ); ?></option>
								<option value="rem"><?php _e( 'rem', 'extender' ); ?></option>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Font Color" onclick="insertAtCaret(this.form.text, '\tcolor: #'+this.form.font_color.value+';\n')">
							<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box-150" style="width:110px;" id="font_color" name="font_color" value="" /><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Font Weight" onclick="insertAtCaret(this.form.text, '\tfont-weight: '+this.form.font_weight.value+';\n')">
							<select id="font_weight" name="font_weight" size="1" class="iewide beaver-extender-fe-css-builder-font-options-width-control">
								<option value="normal"><?php _e( 'Normal', 'extender' ); ?></option>
								<option value="bold"><?php _e( 'Bold', 'extender' ); ?></option>
								<option value="100"><?php _e( '100', 'extender' ); ?></option>
								<option value="200"><?php _e( '200', 'extender' ); ?></option>
								<option value="300"><?php _e( '300', 'extender' ); ?></option>
								<option value="400"><?php _e( '400', 'extender' ); ?></option>
								<option value="500"><?php _e( '500', 'extender' ); ?></option>
								<option value="600"><?php _e( '600', 'extender' ); ?></option>
								<option value="700"><?php _e( '700', 'extender' ); ?></option>
								<option value="800"><?php _e( '800', 'extender' ); ?></option>
								<option value="900"><?php _e( '900', 'extender' ); ?></option>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Font Style" onclick="insertAtCaret(this.form.text, '\tfont-style: '+this.form.font_style.value+';\n')">
							<select id="font_style" class="beaver-extender-fe-css-builder-font-options-width-control" name="font_style" size="1" class="iewide">
								<option value="normal"><?php _e( 'Normal', 'extender' ); ?></option>
								<option value="italic"><?php _e( 'Italic', 'extender' ); ?></option>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Text Align" onclick="insertAtCaret(this.form.text, '\ttext-align: '+this.form.text_align.value+';\n')">
							<select id="text_align" class="beaver-extender-fe-css-builder-font-options-width-control" name="text_align" size="1" class="iewide">
								<option value="left"><?php _e( 'Left', 'extender' ); ?></option>
								<option value="center"><?php _e( 'Center', 'extender' ); ?></option>
								<option value="right"><?php _e( 'Right', 'extender' ); ?></option>
								<option value="justify"><?php _e( 'Justify', 'extender' ); ?></option>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Transform" onclick="insertAtCaret(this.form.text, '\ttext-transform: '+this.form.font_caps.value+';\n')">
							<select id="font_caps" class="beaver-extender-fe-css-builder-font-options-width-control" name="font_caps" size="1" class="iewide">
								<option value="none"><?php _e( 'None', 'extender' ); ?></option>
								<option value="uppercase"><?php _e( 'Uppercase', 'extender' ); ?></option>
								<option value="lowercase"><?php _e( 'Lowercase', 'extender' ); ?></option>
								<option value="capitalize"><?php _e( 'Capitalize', 'extender' ); ?></option>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Letter Spacing" onclick="insertAtCaret(this.form.text, '\tletter-spacing: '+this.form.letter_spacing.value+';\n')">
							<select id="letter_spacing" class="beaver-extender-fe-css-builder-font-options-width-control" name="letter_spacing" size="1" class="iewide">
								<option value=".5px"><?php _e( '.5px', 'extender' ); ?></option>
								<option value="1px"><?php _e( '1px', 'extender' ); ?></option>
								<option value="1.5px"><?php _e( '1.5px', 'extender' ); ?></option>
								<option value="2px"><?php _e( '2px', 'extender' ); ?></option>
								<option value="2.5px"><?php _e( '2.5px', 'extender' ); ?></option>
								<option value="3px"><?php _e( '3px', 'extender' ); ?></option>
								<option value="3.5px"><?php _e( '3.5px', 'extender' ); ?></option>
								<option value="4px"><?php _e( '4px', 'extender' ); ?></option>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Line Height" onclick="insertAtCaret(this.form.text, '\tline-height: '+this.form.line_height.value+';\n')">
							<select id="line_height" class="beaver-extender-fe-css-builder-font-options-width-control" name="line_height" size="1" class="iewide">
								<option value="100%"><?php _e( '100%', 'extender' ); ?></option>
								<option value="110%"><?php _e( '110%', 'extender' ); ?></option>
								<option value="120%"><?php _e( '120%', 'extender' ); ?></option>
								<option value="130%"><?php _e( '130%', 'extender' ); ?></option>
								<option value="140%"><?php _e( '140%', 'extender' ); ?></option>
								<option value="150%"><?php _e( '150%', 'extender' ); ?></option>
								<option value="160%"><?php _e( '160%', 'extender' ); ?></option>
								<option value="170%"><?php _e( '170%', 'extender' ); ?></option>
								<option value="180%"><?php _e( '180%', 'extender' ); ?></option>
								<option value="190%"><?php _e( '190%', 'extender' ); ?></option>
								<option value="200%"><?php _e( '200%', 'extender' ); ?></option>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Txt Decoration" onclick="insertAtCaret(this.form.text, '\ttext-decoration: '+this.form.text_decoration.value+';\n')">
							<select id="text_decoration" class="beaver-extender-fe-css-builder-font-options-width-control" name="text_decoration" size="1" class="iewide">
								<option value="none"><?php _e( 'none', 'extender' ); ?></option>
								<option value="underline"><?php _e( 'underline', 'extender' ); ?></option>
								<option value="overline"><?php _e( 'overline', 'extender' ); ?></option>
								<option value="line-through"><?php _e( 'line-through', 'extender' ); ?></option>
								<option value="blink"><?php _e( 'blink', 'extender' ); ?></option>
								<option value="inherit"><?php _e( 'inherit', 'extender' ); ?></option>
							</select><br />
						</p>
					</div>
					
					<div id="beaver-extender-fe-css-builder-nav-width-float-box" class="beaver-extender-fe-css-builder-all-css-builder">
						<p style="float:left;">		
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert px Width CSS" onclick="insertAtCaret(this.form.text, '\twidth: '+this.form.width_px.value+'px;\n')">
							<input type="text" id="width_px" name="width_px" value="" style="width:40px;" /><?php _e( 'px', 'extender' ); ?><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert % Width CSS" onclick="insertAtCaret(this.form.text, '\twidth: '+this.form.width_percent.value+'%;\n')">
							<input type="text" id="width_percent" name="width_percent" value="" style="width:40px;" /><?php _e( '%', 'extender' ); ?><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert px Max Width CSS" onclick="insertAtCaret(this.form.text, '\tmax-width: '+this.form.max_width_px.value+'px;\n')">
							<input type="text" id="max_width_px" name="max_width_px" value="" style="width:40px;" /><?php _e( 'px', 'extender' ); ?><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert % Max Width CSS" onclick="insertAtCaret(this.form.text, '\tmax-width: '+this.form.max_width_percent.value+'%;\n')">
							<input type="text" id="max_width_percent" name="max_width_percent" value="" style="width:40px;" /><?php _e( '%', 'extender' ); ?><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Height CSS" onclick="insertAtCaret(this.form.text, '\theight: '+this.form.height.value+'px;\n')">
							<input type="text" id="height" name="height" value="" style="width:40px;" /><?php _e( 'px', 'extender' ); ?><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Float CSS" onclick="insertAtCaret(this.form.text, '\tfloat: '+this.form.float_direction.value+';\n')">
							<select id="float_direction" name="float_direction" size="1" class="iewide" style="width:110px;">
								<option value="none"><?php _e( 'None', 'extender' ); ?></option>
								<option value="left"><?php _e( 'Left', 'extender' ); ?></option>
								<option value="right"><?php _e( 'Right', 'extender' ); ?></option>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Position" onclick="insertAtCaret(this.form.text, '\tposition: '+this.form.position.value+';\n')">
							<select id="position" name="position" size="1" class="iewide" style="width:110px;">
								<option value="absolute"><?php _e( 'absolute', 'extender' ); ?></option>
								<option value="fixed"><?php _e( 'fixed', 'extender' ); ?></option>
								<option value="relative"><?php _e( 'relative', 'extender' ); ?></option>
								<option value="static"><?php _e( 'static', 'extender' ); ?></option>
								<option value="inherit"><?php _e( 'inherit', 'extender' ); ?></option>
							</select><br />
							<input class="beaver-extender-fe-css-builder-button beaver-extender-fe-css-builder-buttons" type="button" value="Insert Display" onclick="insertAtCaret(this.form.text, '\tdisplay: '+this.form.display.value+';\n')">
							<select id="display" name="display" size="1" class="iewide" style="width:110px;">
								<option value="none"><?php _e( 'none', 'extender' ); ?></option>
								<option value="block"><?php _e( 'block', 'extender' ); ?></option>
								<option value="inline"><?php _e( 'inline', 'extender' ); ?></option>
								<option value="inline-block"><?php _e( 'inline-block', 'extender' ); ?></option>
								<option value="inline-table"><?php _e( 'inline-table', 'extender' ); ?></option>
								<option value="list-item"><?php _e( 'list-item', 'extender' ); ?></option>
								<option value="run-in"><?php _e( 'run-in', 'extender' ); ?></option>
								<option value="table"><?php _e( 'table', 'extender' ); ?></option>
								<option value="table-caption"><?php _e( 'table-caption', 'extender' ); ?></option>
								<option value="table-cell"><?php _e( 'table-cell', 'extender' ); ?></option>
								<option value="table-column"><?php _e( 'table-column', 'extender' ); ?></option>
								<option value="table-column-group"><?php _e( 'table-column-group', 'extender' ); ?></option>
								<option value="table-footer-group"><?php _e( 'table-footer-group', 'extender' ); ?></option>
								<option value="table-header-group"><?php _e( 'table-header-group', 'extender' ); ?></option>
								<option value="table-row"><?php _e( 'table-row', 'extender' ); ?></option>
								<option value="table-row-group"><?php _e( 'table-row-group', 'extender' ); ?></option>
								<option value="inherit"><?php _e( 'inherit', 'extender' ); ?></option>
							</select>
						</p>
					</div>
					
					<div id="beaver-extender-fe-css-builder-nav-shadows-box" class="beaver-extender-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Lft-Rt', 'extender' ); ?>
								<input type="text" id="box_shadow_lr" name="box_shadow_lr" value="0" style="width:40px;" />
								<?php _e( 'Tp-Btm', 'extender' ); ?>
								<input type="text" id="box_shadow_tb" name="box_shadow_tb" value="0" style="width:40px;" /><br />
								<?php _e( 'Blur', 'extender' ); ?>
								<input type="text" id="box_shadow_blur" name="box_shadow_blur" value="0" style="width:30px; height:24px;" />
								<?php _e( 'Spread', 'extender' ); ?>
								<input type="text" id="box_shadow_spread" name="box_shadow_spread" value="0" style="width:30px; height:24px;" />
								<?php _e( 'Color', 'extender' ); ?>
								<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="box_shadow_color" name="box_shadow_color" value="" style="margin-bottom:10px;"/><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Box Shadow CSS (in pixels)" onclick="insertAtCaret(this.form.text, '\t-webkit-box-shadow: '+this.form.box_shadow_lr.value+'px '+this.form.box_shadow_tb.value+'px '+this.form.box_shadow_blur.value+'px '+this.form.box_shadow_spread.value+'px #'+this.form.box_shadow_color.value+';\n\tbox-shadow: '+this.form.box_shadow_lr.value+'px '+this.form.box_shadow_tb.value+'px '+this.form.box_shadow_blur.value+'px '+this.form.box_shadow_spread.value+'px #'+this.form.box_shadow_color.value+';\n')"><br />
							</div>
							<div class="beaver-extender-fe-css-builder-options-box">
								<?php _e( 'Lft-Rt', 'extender' ); ?>
								<input type="text" id="text_shadow_lr" name="text_shadow_lr" value="0" style="width:40px;" />
								<?php _e( 'Tp-Btm', 'extender' ); ?>
								<input type="text" id="text_shadow_tb" name="text_shadow_tb" value="0" style="width:40px;" /><br />
								<?php _e( 'Blur', 'extender' ); ?>
								<input type="text" id="text_shadow_blur" name="text_shadow_blur" value="0" style="width:30px; height:24px;" />
								<?php _e( 'Color', 'extender' ); ?>
								<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="text_shadow_color" name="text_shadow_color" value="" style="margin-bottom:10px;"/><br />
								<input class="beaver-extender-fe-css-builder-button-bgs beaver-extender-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Text Shadow CSS (in pixels)" onclick="insertAtCaret(this.form.text, '\ttext-shadow: '+this.form.text_shadow_lr.value+'px '+this.form.text_shadow_tb.value+'px '+this.form.text_shadow_blur.value+'px #'+this.form.text_shadow_color.value+';\n')">
							</div>
						</p>
					</div>
					
				</div><!-- END .beaver-extender-fe-css-builder-col-left -->
				
				<div class="beaver-extender-fe-css-builder-col beaver-extender-fe-css-builder-col-right">
					
					<textarea wrap="off" id="beaver-extender-fe-css-builder-output" class="code-builder-output" name="text"></textarea>					
					
				</div><!-- END .beaver-extender-fe-css-builder-col-right -->
			
			</form><!-- END #beaver-extender-fe-css-builder-form -->
	
		</div><!-- END .beaver-extender-fe-css-builder-col-container -->
		
		<button id="beaver-extender-fe-css-builder-output-cut-button" class="code-builder-output-cut" data-clipboard-action="cut" data-clipboard-target="#beaver-extender-fe-css-builder-output">Copy To Clipboard</button>
		<button style="display:none;" id="beaver-extender-fe-css-builder-output-copied-button" class="code-builder-output-cut">Copied!</button>
	
	</div><!-- END .beaver-extender-fe-css-builder-container -->
<?php
	
}

add_action( 'wp_head', 'beaver_extender_fe_css_builder', 15 );
/**
 * Add the Beaver Extender FE CSS Builder HTML to the <head> area.
 *
 * @since 2.0
 */
function beaver_extender_fe_css_builder() {

	echo '<span id="beaver-extender-fe-css-builder-css" style="display:none;"><span class="dashicons dashicons-sos"></span></span>' . "\n";
	echo '<span id="beaver-extender-fe-css-builder-highlight-css"></span>' . "\n";
	
	if ( PHP_VERSION >= 5.3 )
		echo '<span id="css-builder-hooks-map"><span class="dashicons dashicons-location-alt"></span></span>' . "\n";
	
}
