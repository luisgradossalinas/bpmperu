<?php

add_action( 'admin_init', 'Rbox_theme_options_init' );
add_action( 'admin_menu', 'Rbox_theme_options_add_page' );

/**
 * Init plugin options to white list our options
*/
function Rbox_theme_options_init(){
	register_setting( 'Rbox_options', 'Rbox_theme_options', 'Rbox_theme_options_validate' );
	wp_enqueue_style("rbox", get_template_directory_uri()."/panel/css/admin.css", false, "1.0", "all");
	
}

/**
 * Load up the menu page
*/
function Rbox_theme_options_add_page() {
	add_theme_page( 'Rbox Theme Options', 'Rbox Theme Options', 'edit_theme_options', 'Rbox_theme_options', 'Rbox_theme_options_do_page' );
}

/**
 * Create the options page
*/
function Rbox_theme_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	<div class="wrap">
	
	<div class="logo_tz"><a href="http://www.themeszen.com">logo</a></div>
<div id="go_pro"><h2>Go for Pro Version!</h2>This is a free version of Rbox. Get your own copy of professional version if you need to setup your theme like a website with homepage and get FORUM support. <a href="http://www.themeszen.com">Click Here to Learn More Now</a></div>
		<?php screen_icon(); echo "<h2>" . get_current_theme() . " Theme Options</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong>Options saved.</strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php" style="float: left; width: 70%;">
			<?php settings_fields( 'Rbox_options' ); ?>
			<?php $options = get_option( 'Rbox_theme_options' ); ?>

			<table class="form-table">
				<tr valign="top">
					<td colspan="2">
						<h2>Footer</h2>
					</td>
				</tr>
				<tr valign="top"><th scope="row">Footer copyright text</th>
					<td>
						<input id="Rbox_theme_options[Rbox_footer_text]" class="regular-text" type="text" name="Rbox_theme_options[Rbox_footer_text]" value="<?php esc_attr_e(stripslashes($options['Rbox_footer_text'])); ?>" />
					</td>
				</tr>
				<tr valign="top"><th scope="row">Google Analytics Code</th>
					<td>
						<textarea id="Rbox_theme_options[Rbox_analytics]" class="large-text" cols="50" rows="3" name="Rbox_theme_options[Rbox_analytics]"><?php echo esc_attr(stripslashes($options['Rbox_analytics'])); ?></textarea>
					</td>
				</tr>
				
				<tr valign="top"><th scope="row">RSS url</th>
					<td>
						<input id="Rbox_theme_options[Rbox_rss]" class="regular-text" type="text" name="Rbox_theme_options[Rbox_rss]" value="<?php esc_attr_e(stripslashes($options['Rbox_rss'])); ?>" />
					</td>
				</tr>
				
					<tr valign="top"><th scope="row">Facebook url</th>
					<td>
						<input id="Rbox_theme_options[Rbox_facebook]" class="regular-text" type="text" name="Rbox_theme_options[Rbox_facebook]" value="<?php esc_attr_e(stripslashes($options['Rbox_facebook'])); ?>" />
					</td>
				</tr>
				
						<tr valign="top"><th scope="row">Twitter url</th>
					<td>
						<input id="Rbox_theme_options[Rbox_twitter]" class="regular-text" type="text" name="Rbox_theme_options[Rbox_twitter]" value="<?php esc_attr_e(stripslashes($options['Rbox_twitter'])); ?>" />
					</td>
				</tr>
				
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="Save Options" />
			</p>
		</form>
		
		<div class="side-wrap" style="float: right; width: 26%; padding-right: 25px;">
			
			<div class="postbox">
				<div><h3 class="hndle">Support <?php echo get_current_theme(); ?> Theme</h3></div>
				<div class="panel-wrap inside">
					<p>If you enjoy the FREE version using it for your website, please any donation would be much appreciated.</p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="48GRNM4JYYRBU">
<table>
<tr><td><input type="hidden" name="on0" value="Amount">Amount</td></tr><tr><td><select name="os0">
	<option value="Option 1">Option 1 $5.00</option>
	<option value="Option 2">Option 2 $10.00</option>
	<option value="Option 3">Option 3 $25.00</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="http://www.themeszen.com/donate.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>

				</div>
			</div>
			
			
		</div>
		
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
*/
function Rbox_theme_options_validate( $input ) {
	// Say our textarea option must be safe text with the allowed tags for posts
	$input['Rbox_footer_text'] = wp_filter_post_kses( $input['Rbox_footer_text'] );
	$input['Rbox_rss'] = wp_filter_nohtml_kses( $input['Rbox_rss'] );
	$input['Rbox_facebook'] = wp_filter_nohtml_kses( $input['Rbox_facebook'] );
	$input['Rbox_twitter'] = wp_filter_nohtml_kses( $input['Rbox_twitter'] );
	
	return $input;
}

?>