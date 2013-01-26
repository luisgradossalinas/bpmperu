<?php 
add_action('wp_head', 'themezee_css_colors');
function themezee_css_colors() {
	
	$options = get_option('themezee_options');
	
	if ( isset($options['themeZee_color_activate']) and $options['themeZee_color_activate'] == 'true' ) {
		
		echo '<style type="text/css">';
		echo '
			a, a:link, a:visited, .comment-reply-link, .post-title, .page-title, .post-title a:link, 
			.post-title a:visited, .arh, #comments h3, #respond h3, #sidebar a:link, #sidebar a:visited {
				color: #'.esc_attr($options['themeZee_colors_full']).';
			}
			#header, #footer, #slide_panel, .postcomments, #sidebar .widgettitle {
				background-color: #'.esc_attr($options['themeZee_colors_full']).';
			}
		';
		echo '</style>';
	}
}