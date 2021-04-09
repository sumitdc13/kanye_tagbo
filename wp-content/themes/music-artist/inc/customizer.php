<?php
/**
 * Music Artist Theme Customizer
 *
 * @package music_artist
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function music_artist_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$music_artist_options = music_artist_theme_options();

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'music_artist_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'music_artist_customize_partial_blogdescription',
			)
		);
	}


    $wp_customize->add_setting('music_artist_theme_options[site_title_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $music_artist_options['site_title_show'],
            'sanitize_callback' => 'music_artist_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('music_artist_theme_options[site_title_show]',
        array(
            'label' => esc_html__('Show Title & Tagline', 'music-artist'),
            'type' => 'Checkbox',
            'section' => 'title_tagline',

        )
    );
    

    $wp_customize->add_panel(
        'theme_options',
        array(
            'title' => esc_html__('Theme Options', 'music-artist'),
            'priority' => 2,
        )
    );



    /* Header Section */
    $wp_customize->add_section(
        'header_section',
        array(
            'title' => esc_html__( 'Header Section','music-artist' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

	$wp_customize->add_setting('music_artist_theme_options[facebook]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['facebook'],
	        'sanitize_callback' => 'music_artist_sanitize_url',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[facebook]',
	    array(
	        'label' => esc_html__('Facebook Link', 'music-artist'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'music_artist_theme_options[facebook]',
	    )
	);


	$wp_customize->add_setting('music_artist_theme_options[twitter]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['twitter'],
	        'sanitize_callback' => 'music_artist_sanitize_url',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[twitter]',
	    array(
	        'label' => esc_html__('Twitter Link', 'music-artist'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'music_artist_theme_options[twitter]',
	    )
	);


	$wp_customize->add_setting('music_artist_theme_options[instagram]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['instagram'],
	        'sanitize_callback' => 'music_artist_sanitize_url',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[instagram]',
	    array(
	        'label' => esc_html__('Instagram Link', 'music-artist'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'music_artist_theme_options[instagram]',
	    )
	);

	$wp_customize->add_setting('music_artist_theme_options[youtube]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['youtube'],
	        'sanitize_callback' => 'music_artist_sanitize_url',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[youtube]',
	    array(
	        'label' => esc_html__('Youtube Link', 'music-artist'),
	        'type' => 'text',
	        'section' => 'header_section',
	        'settings' => 'music_artist_theme_options[youtube]',
	    )
	);



    /* Banner Section */

    $wp_customize->add_section(
        'banner_section',
        array(
            'title' => esc_html__( 'Banner Section','music-artist' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );




	$wp_customize->add_setting('music_artist_theme_options[banner_title]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('banner_title',
	    array(
	        'label' => esc_html__('Title', 'music-artist'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'music_artist_theme_options[banner_title]',
	    )
	);


	$wp_customize->add_setting('music_artist_theme_options[spotify_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['spotify_button_url'],
	        'sanitize_callback' => 'music_artist_sanitize_url',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[spotify_button_url]',
	    array(
	        'label' => esc_html__('Spotify Link', 'music-artist'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'music_artist_theme_options[spotify_button_url]',
	    )
	);


	$wp_customize->add_setting('music_artist_theme_options[itunes_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['itunes_button_url'],
	        'sanitize_callback' => 'music_artist_sanitize_url',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[itunes_button_url]',
	    array(
	        'label' => esc_html__('iTunes Link', 'music-artist'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'music_artist_theme_options[itunes_button_url]',
	    )
	);

	$wp_customize->add_setting('music_artist_theme_options[soundcloud_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['soundcloud_button_url'],
	        'sanitize_callback' => 'music_artist_sanitize_url',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[soundcloud_button_url]',
	    array(
	        'label' => esc_html__('Soundcloud Link', 'music-artist'),
	        'type' => 'text',
	        'section' => 'banner_section',
	        'settings' => 'music_artist_theme_options[soundcloud_button_url]',
	    )
	);


	$wp_customize->add_setting('music_artist_theme_options[banner_bg_image]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'esc_url_raw',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'music_artist_theme_options[banner_bg_image]',
	        array(
	            'label' => esc_html__('Add Background Image', 'music-artist'),
	            'section' => 'banner_section',
	            'settings' => 'music_artist_theme_options[banner_bg_image]',
	        ))
	);



	/* album Section*/


    $wp_customize->add_section(
        'album_section',
        array(
            'title' => esc_html__( 'album Section ','music-artist' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('music_artist_theme_options[album_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $music_artist_options['album_show'],
            'sanitize_callback' => 'music_artist_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('music_artist_theme_options[album_show]',
        array(
            'label' => esc_html__('Show album Section', 'music-artist'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'album_section',

        )
    );
	$wp_customize->add_setting('music_artist_theme_options[album_title]',
	    array(
	        'default' => $music_artist_options['album_title'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('music_artist_theme_options[album_title]',
	    array(
	        'label' => esc_html__('album Section Title', 'music-artist'),
	        'type' => 'text',
	        'section' => 'album_section',
	        'settings' => 'music_artist_theme_options[album_title]',
	    )
	);
	$wp_customize->add_setting('music_artist_theme_options[album_desc]',
	    array(
	        'default' => $music_artist_options['album_desc'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('music_artist_theme_options[album_desc]',
	    array(
	        'label' => esc_html__('album Section Description', 'music-artist'),
	        'type' => 'text',
	        'section' => 'album_section',
	        'settings' => 'music_artist_theme_options[album_desc]',
	    )
	);
	$wp_customize->add_setting('music_artist_theme_options[album_category]', array(
	    'default' => $music_artist_options['album_category'],
	    'type' => 'option',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability' => 'edit_theme_options',

	));

	$wp_customize->add_control(new music_artist_album_Dropdown_Customize_Control(
	    $wp_customize, 'music_artist_theme_options[album_category]',
	    array(
	        'label' => esc_html__('Select album Posts Category', 'music-artist'),
	        'section' => 'album_section',
	        'settings' => 'music_artist_theme_options[album_category]',
	    )
	));





    /* About Section */

    $wp_customize->add_section(
        'video_section',
        array(
            'title' => esc_html__( 'About Section','music-artist' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );


    $wp_customize->add_setting('music_artist_theme_options[video_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $music_artist_options['video_show'],
            'sanitize_callback' => 'music_artist_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('music_artist_theme_options[video_show]',
        array(
            'label' => esc_html__('Show About Section', 'music-artist'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'video_section',

        )
    );
	$wp_customize->add_setting('music_artist_theme_options[video_message]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('video_message',
	    array(
	        'label' => esc_html__('About Title', 'music-artist'),
	        'type' => 'text',
	        'section' => 'video_section',
	        'settings' => 'music_artist_theme_options[video_message]',
	    )
	);

	$wp_customize->add_setting('music_artist_theme_options[video_name]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('video_name',
	    array(
	        'label' => esc_html__('About Description', 'music-artist'),
	        'type' => 'text',
	        'section' => 'video_section',
	        'settings' => 'music_artist_theme_options[video_name]',
	    )
	);


	$wp_customize->add_setting('music_artist_theme_options[video_youtube_url]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['video_youtube_url'],
	        'sanitize_callback' => 'music_artist_sanitize_url',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[video_youtube_url]',
	    array(
	        'label' => esc_html__('Video Link', 'music-artist'),
	        'type' => 'text',
	        'section' => 'video_section',
	        'settings' => 'music_artist_theme_options[video_youtube_url]',
	    )
	);


	$wp_customize->add_setting('music_artist_theme_options[video_bg_image]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'esc_url_raw',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'music_artist_theme_options[video_bg_image]',
	        array(
	            'label' => esc_html__('Add Image', 'music-artist'),
	            'section' => 'video_section',
	            'settings' => 'music_artist_theme_options[video_bg_image]',
	        ))
	);
	$wp_customize->add_setting('music_artist_theme_options[video_button_txt]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['video_button_txt'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[video_button_txt]',
	    array(
	        'label' => esc_html__('Button Text', 'music-artist'),
	        'type' => 'text',
	        'section' => 'video_section',
	        'settings' => 'music_artist_theme_options[video_button_txt]',
	    )
	);
	$wp_customize->add_setting('music_artist_theme_options[video_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['video_button_url'],
	        'sanitize_callback' => 'music_artist_sanitize_url',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[video_button_url]',
	    array(
	        'label' => esc_html__('Button Link', 'music-artist'),
	        'type' => 'text',
	        'section' => 'video_section',
	        'settings' => 'music_artist_theme_options[video_button_url]',
	    )
	);




    /* Youtube Section */

    $wp_customize->add_section(
        'youtube_video_section',
        array(
            'title' => esc_html__( 'Youtube Videos Section','music-artist' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );


    $wp_customize->add_setting('music_artist_theme_options[youtube_video_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $music_artist_options['youtube_video_show'],
            'sanitize_callback' => 'music_artist_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('music_artist_theme_options[youtube_video_show]',
        array(
            'label' => esc_html__('Show Youtube Videos', 'music-artist'),
            'description' => esc_html__('Only 2 videos in free Theme', 'music-artist'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'youtube_video_section',

        )
    );


	$wp_customize->add_setting('music_artist_theme_options[youtube_video_title]',
	    array(
	        'default' => $music_artist_options['youtube_video_title'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('music_artist_theme_options[youtube_video_title]',
	    array(
	        'label' => esc_html__('Youtube Video Title', 'music-artist'),
	        'type' => 'text',
	        'section' => 'youtube_video_section',
	        'settings' => 'music_artist_theme_options[youtube_video_title]',
	    )
	);
	$wp_customize->add_setting('music_artist_theme_options[youtube_video_desc]',
	    array(
	        'default' => $music_artist_options['youtube_video_desc'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('music_artist_theme_options[youtube_video_desc]',
	    array(
	        'label' => esc_html__('Youtube Video Description', 'music-artist'),
	        'type' => 'text',
	        'section' => 'youtube_video_section',
	        'settings' => 'music_artist_theme_options[youtube_video_desc]',
	    )
	);
	$wp_customize->add_setting('music_artist_theme_options[youtube_video1]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['youtube_video1'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[youtube_video1]',
	    array(
	        'label' => esc_html__('youtube Video1', 'music-artist'),
	        'type' => 'text',
	        'section' => 'youtube_video_section',
	        'settings' => 'music_artist_theme_options[youtube_video1]',
	    )
	);
	$wp_customize->add_setting('music_artist_theme_options[youtube_video2]',
	    array(
	        'type' => 'option',
	        'default' => $music_artist_options['youtube_video2'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[youtube_video2]',
	    array(
	        'label' => esc_html__('youtube Video2', 'music-artist'),
	        'type' => 'text',
	        'section' => 'youtube_video_section',
	        'settings' => 'music_artist_theme_options[youtube_video2]',
	    )
	);











    /* Blog Section */

    $wp_customize->add_section(
        'blog_section',
        array(
            'title' => esc_html__( 'Blog Section','music-artist' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('music_artist_theme_options[blog_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $music_artist_options['blog_show'],
            'sanitize_callback' => 'music_artist_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('music_artist_theme_options[blog_show]',
        array(
            'label' => esc_html__('Show Blog Section', 'music-artist'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'blog_section',

        )
    );
	$wp_customize->add_setting('music_artist_theme_options[blog_title]',
	    array(
	        'capability' => 'edit_theme_options',
	        'default' => $music_artist_options['blog_title'],
	        'sanitize_callback' => 'sanitize_text_field',
	        'type' => 'option',
	    )
	);
	$wp_customize->add_control('music_artist_theme_options[blog_title]',
	    array(
	        'label' => esc_html__('Section Title', 'music-artist'),
	        'priority' => 1,
	        'section' => 'blog_section',
	        'type' => 'text',
	    )
	);

	$wp_customize->add_setting('music_artist_theme_options[blog_desc]',
	    array(
	        'default' => $music_artist_options['blog_desc'],
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);

	$wp_customize->add_control('music_artist_theme_options[blog_desc]',
	    array(
	        'label' => esc_html__('Blog Section Description', 'music-artist'),
	        'type' => 'text',
	        'section' => 'blog_section',
	        'settings' => 'music_artist_theme_options[blog_desc]',
	    )
	);

	$wp_customize->add_setting('music_artist_theme_options[blog_category]', array(
	    'default' => $music_artist_options['blog_category'],
	    'type' => 'option',
	    'sanitize_callback' => 'music_artist_sanitize_select',
	    'capability' => 'edit_theme_options',

	));

	$wp_customize->add_control(new music_artist_Dropdown_Customize_Control(
	    $wp_customize, 'music_artist_theme_options[blog_category]',
	    array(
	        'label' => esc_html__('Select Blog Category', 'music-artist'),
	        'section' => 'blog_section',
	        'choices' => music_artist_get_categories_select(),
	        'settings' => 'music_artist_theme_options[blog_category]',
	    )
	));



    /* Blog Section */

    $wp_customize->add_section(
        'prefooter_section',
        array(
            'title' => esc_html__( 'Prefooter Section','music-artist' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('music_artist_theme_options[show_prefooter]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $music_artist_options['show_prefooter'],
            'sanitize_callback' => 'music_artist_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('music_artist_theme_options[show_prefooter]',
        array(
            'label' => esc_html__('Show Prefooter Section', 'music-artist'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'prefooter_section',

        )
    );

       $wp_customize->add_section(
        'single_article',
        array(
            'title' => esc_html__( 'Single Article Page Options','music-artist' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('music_artist_theme_options[show_sidebar]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $music_artist_options['show_sidebar'],
            'sanitize_callback' => 'music_artist_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('music_artist_theme_options[show_sidebar]',
        array(
            'label' => esc_html__('Show Sidebar in single Article Pages', 'music-artist'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'single_article',

        )
    );
}
add_action( 'customize_register', 'music_artist_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function music_artist_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function music_artist_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function music_artist_customize_preview_js() {
	wp_enqueue_script( 'music-artist-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'music_artist_customize_preview_js' );
