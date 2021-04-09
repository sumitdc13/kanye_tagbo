<?php
$music_artist_options = music_artist_theme_options();

$banner_title = $music_artist_options['banner_title'];
$banner_bg_image = $music_artist_options['banner_bg_image'];
$spotify_button_url = $music_artist_options['spotify_button_url'];
$itunes_button_url = $music_artist_options['itunes_button_url'];
$soundcloud_button_url = $music_artist_options['soundcloud_button_url'];
if(!empty($banner_bg_image)){
    $background_style = "style='background-image:url(".esc_url($banner_bg_image).")'";
}
else{
    $background_style = '';
}

?>


<div class="hero-section">
     <div class="image" data-type="background" data-speed="2"  <?php echo wp_kses_post($background_style); ?>></div>
    <div class="stuff" data-type="content">
        <h1><?php echo esc_html($banner_title); ?></h1>
        <div class="header-social">

			<?php 

			if($spotify_button_url) 
			echo '<div class="social-icon"><a href="'.esc_url($spotify_button_url).'"><i class="fa fa-spotify"></i><span>'.esc_html__('Spotify', 'music-artist').'</span></a></div>';

			if($itunes_button_url) 
			echo '<div class="social-icon"><a href="'.esc_url($itunes_button_url).'"><i class="fa fa-apple"></i><span>'.esc_html__("iTunes", "music-artist").'</span></a></div>';


			if($soundcloud_button_url) 
			echo '<div class="social-icon"><a href="'.esc_url($soundcloud_button_url).'"><i class="fa fa-soundcloud"></i><span>'.esc_html__("SoundCloud", "music-artist").'</span></a></div>'; ?>

		</div>
    </div>
</div>
</div>





