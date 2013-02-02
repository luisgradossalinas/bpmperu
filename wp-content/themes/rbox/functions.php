<?php

if ( ! isset( $content_width ) )
	$content_width = 620;

/** Tell WordPress to run Rbox_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'Rbox_setup' );

if ( ! function_exists( 'Rbox_setup' ) ):

function Rbox_setup() {

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );	

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'Rbox', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
		
			// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'Rbox' ),
	) );

}
endif;
?>
<?php
function Rbox_list_pings($comment, $args, $depth) { 
	$GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php } ?>
<?php
add_filter('get_comments_number', 'comment_count', 0);
function Rbox_comment_count( $count ) {
	if ( ! is_admin() ) {
	global $id;
	$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
	return count($comments_by_type['comment']);
} else {
return $count;
}
}
?>
<?php
if ( ! function_exists( 'Rbox_comment' ) ) :
function Rbox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s', 'Rbox' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'Rbox' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'Rbox' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'Rbox' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'Rbox' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'Rbox'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override Rbox_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 */
function Rbox_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'Rbox' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'Rbox' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'Rbox' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'Rbox' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'Rbox' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'Rbox' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'Rbox' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'Rbox' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'Rbox' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'Rbox' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
if ( ! function_exists( 'Rbox_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
function Rbox_posted_on() {
	printf( __( '%2$s <span class="meta-sep">by</span> %3$s', 'Rbox' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'Rbox' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;
/** Register sidebars by running Rbox_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'Rbox_widgets_init' );

/** Excerpt */
function Rbox_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'Rbox_excerpt_length' );

function Rbox_auto_excerpt_more( $more ) {
	return ' &hellip;' ;
}
add_filter( 'excerpt_more', 'Rbox_auto_excerpt_more' );

/** redirect */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow ==	"themes.php" )
	wp_redirect( 'themes.php?page=Rbox_theme_options');

// custom function
function Rbox_get_ID_by_page_name($page_name)
{
	global $wpdb;
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".$page_name."' AND post_type = 'page'");
	return $page_name_id;
}

/*small title*/
function Rbox_small_title($amount,$echo=true) {
	$small = get_the_title(); 
	if ( strlen($small) <= $amount ) $echo_out = ''; else $echo_out = '...';
	$small = mb_substr( $small, 0, $amount, 'UTF-8' );
	if ($echo) {
		echo $small;
		echo $echo_out;
	}
	else { return ($small . $echo_out); }
}

function Rbox_date_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s', 'Rbox' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		)
	);
}

// include panel file.
require_once ( get_stylesheet_directory() . '/panel/Rbox-options.php' );