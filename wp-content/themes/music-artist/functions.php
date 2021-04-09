<?php
/**
 * Music Artist functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package music_artist
 */


if ( ! function_exists( 'music_artist_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function music_artist_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Music Artist, use a find and replace
		 * to change 'music-artist' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'music-artist', get_template_directory() . '/languages' );

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

        add_image_size( 'music-artist-blog-thumbnail-img', 600, 400, true);

		// This theme uses wp_nav_menu() in one location.

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'music-artist' ),
		) );

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
		add_theme_support(
			'custom-background',
			apply_filters(
				'music_artist_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'post-formats', array('image', 'video', 'audio'));

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
	}
endif;
add_action( 'after_setup_theme', 'music_artist_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function music_artist_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'music_artist_content_width', 640 );
}
add_action( 'after_setup_theme', 'music_artist_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function music_artist_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'music-artist' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'music-artist' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar(array(
            'name' => esc_html__('Music Artist Footer Widget', 'music-artist') . $i,
            'id' => 'music_artist_footer_' . $i,
            'description' => esc_html__('Shows Widgets in Footer', 'music-artist') . $i,
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}
add_action( 'widgets_init', 'music_artist_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function music_artist_scripts_enqueue() {
	wp_enqueue_style( 'music-artist-style', get_stylesheet_uri() );
    wp_enqueue_style( 'music-artist-font', music_artist_font_url(), array(), null);
    wp_enqueue_style( 'music-artist-bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1.0' );
     wp_enqueue_style( 'music-artist-fontawesome-css', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '1.0' );
     wp_enqueue_style( 'music-artist-media-element', get_template_directory_uri() . '/assets/css/mediaelementplayer.min.css', array(), '1.0' );
     wp_enqueue_style( 'music-artist-slick-css', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0' );
     wp_enqueue_style( 'music-artist-ionicons-css', get_template_directory_uri() . '/assets/css/ionicons.css', array(), '1.0' );
       wp_enqueue_style( 'music-artist-youtube-popup-css', get_template_directory_uri() . '/assets/css/youtube-popup.css', array(), '1.0' );
     wp_enqueue_style( 'music-artist-css', get_template_directory_uri() . '/assets/css/music-artist.css', array(), '1.0' );
     wp_enqueue_style( 'music-artist-media-css', get_template_directory_uri() . '/assets/css/media-queries.css', array(), '1.0' );
	wp_enqueue_script( 'music-artist-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'music-artist-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0', true);



	wp_enqueue_script( 'music-artist-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script( 'music-artist-youtube-popup', get_template_directory_uri() . '/assets/js/youtubepopup.js', array('jquery'), '1.0', true);
		wp_enqueue_script( 'music-artist-svg-morpheus', get_template_directory_uri() . '/assets/js/svg-morpheus.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'music-artist-media-element', get_template_directory_uri() . '/assets/js/mediaelement-and-player.min.js', array('jquery'), '1.0', true);
	
		wp_enqueue_script( 'music-artist-jqueru-ui', get_template_directory_uri() . '/assets/js/jquery-ui-slider.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'music-artist-app', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), '1.0', true);

	wp_enqueue_script( 'music-artist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'music_artist_scripts_enqueue' );

function music_artist_custom_customize_enqueue()
{
    wp_enqueue_style('music-artist-customizer-style', trailingslashit(get_template_directory_uri()) . 'inc/customizer/css/customizer-control.css');
}

add_action('customize_controls_enqueue_scripts', 'music_artist_custom_customize_enqueue');



if (!function_exists('music_artist_font_url')) :
    function music_artist_font_url()
    {
        $fonts_url = '';
        $fonts = array();


        if ('off' !== _x('on', 'Open Sans font: on or off', 'music-artist')) {
            $fonts[] = 'Open Sans:300';
        }

        if ('off' !== _x('on', 'Passion One font: on or off', 'music-artist')) {
            $fonts[] = 'Passion One:400';
        }
        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
            ), '//fonts.googleapis.com/css');
        }

        return $fonts_url;
    }
endif;



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/music-artist-menu.php';
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
require get_template_directory() . '/inc/customizer-control.php';
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/music-artist-customizer-default.php';
require get_template_directory() . '/plugin-activation.php';
require get_template_directory() . '/lib/music-artist-tgmp.php';
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


if (!function_exists('music_artist_get_excerpt')) :
    function music_artist_get_excerpt($post_id, $count)
    {
        $content_post = get_post($post_id);
        $excerpt = $content_post->post_content;

        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);


        $excerpt = preg_replace('/\s\s+/', ' ', $excerpt);
        $excerpt = preg_replace('#\[[^\]]+\]#', ' ', $excerpt);
        $strip = explode(' ', $excerpt);
        foreach ($strip as $key => $single) {
            if (!filter_var($single, FILTER_VALIDATE_URL) === false) {
                unset($strip[$key]);
            }
        }
        $excerpt = implode(' ', $strip);

        $excerpt = substr($excerpt, 0, $count);
        if (strlen($excerpt) >= $count) {
            $excerpt = substr($excerpt, 0, strripos($excerpt, ' '));
            $excerpt = $excerpt . '...';
        }
        return $excerpt;
    }
endif;



if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
}

if (!function_exists('music_artist_blank_widget')) {

    function music_artist_blank_widget()
    {
        echo '<div class="col-md-4">';
        if (is_user_logged_in() && current_user_can('edit_theme_options')) {
            echo '<a href="' . esc_url(admin_url('widgets.php')) . '" target="_blank"><i class="fa fa-plus-circle"></i> ' . esc_html__('Add Footer Widget', 'music-artist') . '</a>';
        }
        echo '</div>';
    }
}

		


