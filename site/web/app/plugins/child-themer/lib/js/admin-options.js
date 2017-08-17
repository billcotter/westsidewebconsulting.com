// Forbid Chars
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(2($){$.c.f=2(p){p=$.d({g:"!@#$%^&*()+=[]\\\\\\\';,/{}|\\":<>?~`.- ",4:"",9:""},p);7 3.b(2(){5(p.G)p.4+="Q";5(p.w)p.4+="n";s=p.9.z(\'\');x(i=0;i<s.y;i++)5(p.g.h(s[i])!=-1)s[i]="\\\\"+s[i];p.9=s.O(\'|\');6 l=N M(p.9,\'E\');6 a=p.g+p.4;a=a.H(l,\'\');$(3).J(2(e){5(!e.r)k=o.q(e.K);L k=o.q(e.r);5(a.h(k)!=-1)e.j();5(e.u&&k==\'v\')e.j()});$(3).B(\'D\',2(){7 F})})};$.c.I=2(p){6 8="n";8+=8.P();p=$.d({4:8},p);7 3.b(2(){$(3).f(p)})};$.c.t=2(p){6 m="A";p=$.d({4:m},p);7 3.b(2(){$(3).f(p)})}})(C);',53,53,'||function|this|nchars|if|var|return|az|allow|ch|each|fn|extend||alphanumeric|ichars|indexOf||preventDefault||reg|nm|abcdefghijklmnopqrstuvwxyz|String||fromCharCode|charCode||alpha|ctrlKey||allcaps|for|length|split|1234567890|bind|jQuery|contextmenu|gi|false|nocaps|replace|numeric|keypress|which|else|RegExp|new|join|toUpperCase|ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('|'),0,{}));

jQuery(document).ready(function($) {
	
	$('#child-themer-ace-editor-theme').change( function() {
		var selection = $(this).val();
		$('#child-themer-ace-editor-theme-preview img').attr('src', child_themer_ace_editor_theme_image_url + selection + '.png');
	});
	
	$('#child-themer-ace-editor-theme').change();
	
	$('.wrap').on('keydown', '.forbid-chars', function() {
		if (!$(this).data('init')) {
			$(this).data('init', true);
			$(this).alphanumeric({allow:'_-.',nocaps:true});
			$(this).trigger('keydown');
		}
	}).on('paste', '.forbid-chars', function(event) { 
		var charCode = event.which;
		var keyChar = String.fromCharCode(charCode); 
		return /[*]/.test(keyChar); 
	});

	function default_text(selector) {
		var element = $(selector);
		var text = element.attr('title');
		if (element.val() == '') {
			element.val(text).addClass('default-text-active');
		}
		element.focus(function() {
			if (element.val() == text) {
				element.val('').removeClass('default-text-active');
			}
		}).blur(function() {
			if (element.val() == '') {
				element.val(text).addClass('default-text-active');
			}
		}).parents('form').submit(function() {
			$('.default-text.default-text-active').each(function() {
				$(this).val('').removeClass('default-text-active');
			});
		});
	}
	$('.default-text').each(function() {
		default_text('#'+$(this).attr('id'));
	});
	
	$('#child-themer-theme-creator-form').submit(function() {
		$('#child-themer-theme-creator-button-container .child-themer-ajax-save-spinner').show();
	});
	
	$('.child-themer-enable-parent-child-editor').change(function() {
		$('#child-themer-settings-save-button').addClass('parent-child-editor-option-change');
	});
	
	function show_message(response) {
		$('.child-themer-ajax-save-spinner').hide();
		$('.child-themer-saved').html(response).fadeIn('slow');
		window.setTimeout(function(){
			$('.child-themer-saved').fadeOut('slow'); 
		}, 2222);
	}
	
	$('form#child-themer-settings-form').submit(function() {
		$('.child-themer-ajax-save-spinner').show();
		var data = $(this).serialize();
		jQuery.post(ajaxurl, data, function(response) {
			if (response) {
				show_message(response);
			}
		});
		if ($('#child-themer-settings-save-button').hasClass('parent-child-editor-option-change')) {
			window.setTimeout(function(){
				location.reload(true);
			}, 1500);
		}
		return false;
	});
	
});