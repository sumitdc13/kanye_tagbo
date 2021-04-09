<?php
/**
 *
 * Template Name: Frontpage

 *
 * @package Music Artist
 */

$music_artist_options = music_artist_theme_options();
$about_show = $music_artist_options['about_show'];
$blog_show = $music_artist_options['blog_show'];
$video_show = $music_artist_options['video_show'];

get_header();


get_template_part('template-parts/homepage/banner', 'section');

get_template_part('template-parts/homepage/album', 'section');



if($video_show == 1)
get_template_part('template-parts/homepage/about', 'section');


get_template_part('template-parts/homepage/video', 'section');

if($blog_show == 1)
get_template_part('template-parts/homepage/blog', 'section');


get_footer();
