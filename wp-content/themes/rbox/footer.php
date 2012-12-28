	<!--footer-->
	<div class="clear"></div>
		
		<div id="footer">
		
	<!--footer container--><div id="footer-container">
		
		<div id="footer-widget">
			
			<?php
			/* A sidebar in the footer? Yep. You can can customize
			 * your footer with four columns of widgets.
			 */
			get_sidebar( 'footer' );
			?>
			
			</div><!--footer widget end-->
			
			<div id="footer-info">		
			
			<?php $options = get_option('Rbox_theme_options'); ?>
			
			<div id="copyright"><?php _e( 'Copyright', 'Rbox' ); ?> <?php echo get_the_date( 'Y' ); ?> <?php echo $options['Rbox_footer_text'] ?> | <?php _e( 'Powered by', 'Rbox' ); ?> <a href="http://www.wordpress.com">WordPress</a> | Rbox theme by <a href="http://www.themeszen.com">themeszen</a></div>
			
			<div id="follow-box"><p>Follow us:</p>
	
		<a href="<?php echo $options['Rbox_rss'] ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/RSS.png" alt="RSS" /></a>
		<a href="<?php echo $options['Rbox_twitter'] ?> "><img src="<?php echo get_template_directory_uri(); ?>/images/Twitter.png" alt="Twitter" /></a>
		<a href="<?php echo $options['Rbox_facebook'] ?> "><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="facebook" /></a>
	
	</div>
					
			</div><!--footer info end-->
			
		</div><!-- footer container-->
		
	<div class="clear"></div>		
			
	</div>
	
	<?php wp_footer(); ?>

</body>

</html>