<?php
if (!function_exists('music_artist_theme_options')) :
    function music_artist_theme_options()
    {
        $defaults = array(

            //banner section
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
            'youtube' => '',
            'spotify_button_url' => '',
            'itunes_button_url' => '',
            'soundcloud_button_url' => '',
            'banner_title' => '',
            'banner_bg_image' => '',

            'about_show' => 0,


            'youtube_video_show' => 0,
            'youtube_video1' => '',
            'youtube_video2' => '',
            'youtube_video_title' => '',
            'youtube_video_desc' => '',



            'video_show' => 0,
            'video_message' => '',
            'video_name' => '',
            'video_youtube_url' => '',
            'video_bg_image' => '',
            'video_button_txt' => '',
            'video_button_url' => '',

            'album_show' => 0,
            'album_title' => '',
            'album_desc' => '',
            'album_category' => '',

            'blog_show' => 0,
            'blog_title' => '',
            'blog_desc' => '',
            'blog_category' => '',
            'show_prefooter' => 1,
            'show_sidebar'=> 0,
            'site_title_show' => 1,


        );

        $options = get_option('music_artist_theme_options', $defaults);

        //Parse defaults again - see comments
        $options = wp_parse_args($options, $defaults);

        return $options;
    }
endif;
