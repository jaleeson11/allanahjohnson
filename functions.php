<?php
/**
 * allanahjohnson functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package allanahjohnson
 */

if ( ! defined( 'ALLANAHJOHNSON_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'ALLANAHJOHNSON_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function allanahjohnson_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on allanahjohnson, use a find and replace
		* to change 'allanahjohnson' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'allanahjohnson', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'allanahjohnson' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	// add_theme_support(
	// 	'custom-background',
	// 	apply_filters(
	// 		'allanahjohnson_custom_background_args',
	// 		array(
	// 			'default-color' => 'ffffff',
	// 			'default-image' => '',
	// 		)
	// 	)
	// );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add page support for excerpt.
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'allanahjohnson_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function allanahjohnson_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'allanahjohnson_content_width', 640 );
}
add_action( 'after_setup_theme', 'allanahjohnson_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function allanahjohnson_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'allanahjohnson' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Add widgets here.', 'allanahjohnson' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
	);
}
add_action( 'widgets_init', 'allanahjohnson_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function allanahjohnson_scripts() {
	wp_enqueue_style( 'allanahjohnson-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', array(), ALLANAHJOHNSON_VERSION );
	wp_enqueue_style( 'allanahjohnson-style', get_stylesheet_uri(), array(), ALLANAHJOHNSON_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'allanahjohnson-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), ALLANAHJOHNSON_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'allanahjohnson_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }

/**
 * Redirects.
 */
function allanahjohnson_redirect() {
	if ( is_author() || is_archive() ) {
		wp_safe_redirect( home_url(), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'allanahjohnson_redirect' );

/**
 * Adds ellipses to end of post excerpt.
 */
function allanahjohnson_excerpt_more() {
	return '...';
}
add_filter( 'excerpt_more', 'allanahjohnson_excerpt_more' );

/**
 * Disables comments.
 */
function allanahjonhson_disable_comments() {
	// Redirect any user trying to access comments page
    global $pagenow;
     
    if ( $pagenow === 'edit-comments.php' ) {
        wp_safe_redirect( admin_url() );
        exit;
    }
 
    // Remove comments metabox from dashboard
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
 
    // Disable support for comments and trackbacks in post types
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
}
add_action( 'admin_init', 'allanahjonhson_disable_comments' );

/**
 * Removes comments page in menu.
 */
function allanahjonhson_remove_comments_from_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'allanahjonhson_remove_comments_from_menu' );

/**
 * Removes comments links from admin bar.
 */
function allanahjonhson_remove_comments_from_admin_bar() {
	if ( is_admin_bar_showing() ) {
        remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
    }
}
add_action( 'init', 'allanahjonhson_remove_comments_from_admin_bar' );

/**
 * Disables search functionality.
 * 
 * @param $query
 * @param $error
 */
function allanahjonhson_disable_search( $query, $error = true ) {
	if ( is_search() ) {
		$query->is_search = false;   
		$query->query_vars['s'] = false;
		$query->query['s'] = false;

		if ( $error ) {
			$query->is_404 = true;
		}
	}
}
add_action( 'parse_query', 'allanahjonhson_disable_search' ); 

/**
 * Replaces default login error message.
 */
function  allanahjonhson_login_error() {
	return 'Your username or password is incorrect';
}
add_filter( 'login_errors', 'allanahjonhson_login_error' );

/**
 * Pre-loads fonts.
 */
function allanahjonhson_preload_fonts() {
	$fonts = [
		'DMSans-Regular',
		'Caveat-Regular',
		'DMSans-Medium',
		'DMSans-Bold',
		'DMSans-Italic',
	];

	foreach ($fonts as $font) {
		?>
		<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/fonts/' . $font . '.woff' ?>" as="font" type="font/woff" crossorigin>
		<?php
	}
}

/**
 * Blocks reCAPTCHA on all pages apart from contact.
 */
function allanahjohnson_block_recaptcha() {
	if ( ! is_page( array( 'contact' ) ) ) {
		wp_dequeue_script( 'google-recaptcha' );
		wp_deregister_script( 'google-recaptcha' );
		add_filter( 'wpcf7_load_js', '__return_false' );
		add_filter( 'wpcf7_load_css', '__return_false' );
	}
}
add_action( 'wp_print_scripts', 'allanahjohnson_block_recaptcha' );

/**
 * Theme defaults.
 */
function allanahjohnson_theme_defaults( $setting ) {
	$defaults = array(
		'bio_heading'     => 'Welcome',
		'bio_intro' 	   => 'Hi, my name is Allanah, I am an Integrative Counsellor and Psychotherapist who specialises in working with children, adolescents, and their families. I have a passion for nurturing young minds and offering support through challenging life events towards emotional wellbeing by providing a safe and therapeutic space to enable children and adolescents to tell their own unique stories.',
	);

	return $defaults[$setting];
}

/**
 * Disable tags.
 */
function allanahjohnson_disable_tags() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action('init', 'allanahjohnson_disable_tags');

/**
 * Disable categories.
 */
function allanahjohnson_disable_categories() {
    unregister_taxonomy_for_object_type( 'category', 'post' );
}
add_action('init', 'allanahjohnson_disable_categories');
