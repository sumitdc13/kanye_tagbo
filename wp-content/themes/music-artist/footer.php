<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package music_artist
 */

$music_artist_options = music_artist_theme_options();

$show_prefooter = $music_artist_options['show_prefooter'];

?>

<footer id="colophon" class="site-footer">


	<?php if ($show_prefooter== 1){ ?>
	    <section class="footer-sec">
	        <div class="container">
	            <div class="row">
	                <?php if (is_active_sidebar('music_artist_footer_1')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('music_artist_footer_1') ?>
	                    </div>
	                    <?php
	                else: music_artist_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('music_artist_footer_2')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('music_artist_footer_2') ?>
	                    </div>
	                    <?php
	                else: music_artist_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('music_artist_footer_3')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('music_artist_footer_3') ?>
	                    </div>
	                    <?php
	                else: music_artist_blank_widget();
	                endif; ?>
	            </div>
	        </div>
	    </section>
	<?php } ?>

		<div class="site-info">

     <p><?php esc_html_e('Powered By WordPress', 'music-artist');
                    esc_html_e(' | ', 'music-artist') ?>
                    <span><a target="_blank" rel="nofollow"
                       href="<?php echo esc_url('https://www.flawlessthemes.com/theme/music-artist-best-free-music-artist-wordpress-theme/'); ?>"><?php esc_html_e('Music Artist' , 'music-artist'); ?></a></span>
                </p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->


    <?php $args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' =>'publish',
    'order' => 'desc',
    'orderby' => 'menu_order date',
    'tax_query' => array(
        array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array( 'post-format-audio' )
            )
        )
    );
  $audio_query = new WP_Query($args);
  if($audio_query->have_posts() || has_post_format( 'audio' ) ): ?>
<!-- Music Player -->
<div id="music_player" class="nomargin">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <table class="ms-table">
          <tr>
            <td class="ms-buttons">
              <a href="javascript:;" class="ms-prev">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 20 15" xml:space="preserve">
                  <path d="M0.1,7.2l9.5-6.7c0.1-0.1,0.2-0.1,0.4,0c0.1,0.1,0.2,0.2,0.2,0.3v6.3l9.3-6.6c0.1-0.1,0.2-0.1,0.4,0C19.9,0.5,20,0.6,20,0.8v13.5c0,0.1-0.1,0.3-0.2,0.3c-0.1,0-0.1,0-0.2,0c-0.1,0-0.1,0-0.2-0.1l-9.3-6.6v6.3c0,0.1-0.1,0.3-0.2,0.3c-0.1,0-0.1,0-0.2,0c-0.1,0-0.1,0-0.2-0.1L0.1,7.8C0.1,7.7,0,7.6,0,7.5C0,7.4,0.1,7.3,0.1,7.2z"/>
                </svg>
              </a>
              <a href="javascript:;" class="ms-play">
                <svg id="ms_play_pause" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 20 26" enable-background="new 0 0 20 26" xml:space="preserve">
                  <g id="ms_pause" style="display:none;">
                    <path d="M8.3,25.1c0,0.5-0.4,0.9-0.9,0.9h-5c-0.5,0-0.9-0.4-0.9-0.9V0.9C1.5,0.4,1.9,0,2.4,0h5c0.5,0,0.9,0.4,0.9,0.9V25.1L8.3,25.1z"/>
                    <path d="M18.5,25.1c0,0.5-0.4,0.9-0.9,0.9h-5c-0.5,0-0.9-0.4-0.9-0.9V0.9c0-0.5,0.4-0.9,0.9-0.9h5c0.5,0,0.9,0.4,0.9,0.9V25.1z"/>
                  </g>
                  <g id="ms_play">
                    <path d="M19.2,12.5L1.5,0.1C1.3,0,1,0,0.8,0.1C0.6,0.2,0.5,0.4,0.5,0.6v24.8c0,0.2,0.1,0.4,0.3,0.5C0.9,26,1,26,1.1,26c0.1,0,0.2,0,0.3-0.1l17.8-12.4c0.2-0.1,0.3-0.3,0.3-0.5C19.5,12.8,19.4,12.6,19.2,12.5z"/>
                  </g>
                </svg>
              </a>
              <a href="javascript:;" class="ms-next">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 20 15" xml:space="preserve">
                  <path d="M19.9,7.2l-9.5-6.7c-0.1-0.1-0.2-0.1-0.4,0C9.9,0.5,9.8,0.6,9.8,0.8v6.3L0.6,0.5c-0.1-0.1-0.2-0.1-0.4,0C0.1,0.5,0,0.6,0,0.8v13.5c0,0.1,0.1,0.3,0.2,0.3c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2-0.1l9.3-6.6v6.3c0,0.1,0.1,0.3,0.2,0.3c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2-0.1l9.5-6.7C19.9,7.7,20,7.6,20,7.5C20,7.4,19.9,7.3,19.9,7.2z"/>
                </svg>
              </a>
            </td>
            <td class="ms-wrap">
              <audio id="msplayer" class="msplayer-skin" src="preview.mp3" type="audio/mp3" controls="controls"></audio>
            </td>
            <td class="ms-controls">
              <div class="ms-entry-controls">
                <div class="ec-item ec-repeat">
                  <a href="javascript:;" class="ms-control-repeat active">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 16" xml:space="preserve">
                      <g>
                        <path d="M10.4,7.7c-0.3-0.4-0.9-0.4-1.2,0C8.8,8,8.8,8.6,9.2,9l1.2,1.2H5.2c-1.9,0-3.5-1.6-3.5-3.5c0-1.9,1.6-3.5,3.5-3.5h4c0.5,0,0.9-0.4,0.9-0.9c0-0.5-0.4-0.9-0.9-0.9h-4C2.3,1.3,0,3.7,0,6.6C0,9.6,2.3,12,5.2,12h5.1l-1.2,1.2c-0.3,0.4-0.3,0.9,0,1.3c0.2,0.2,0.4,0.3,0.6,0.3c0.2,0,0.5-0.1,0.6-0.3l2.7-2.7c0.3-0.4,0.3-0.9,0-1.3L10.4,7.7z"/>
                        <path d="M18.8,4h-5.1l1.2-1.2c0.3-0.4,0.3-0.9,0-1.3c-0.3-0.4-0.9-0.4-1.2,0l-2.7,2.7c-0.3,0.4-0.3,0.9,0,1.3l2.7,2.7c0.2,0.2,0.4,0.3,0.6,0.3c0.2,0,0.5-0.1,0.6-0.3c0.3-0.4,0.3-0.9,0-1.3l-1.2-1.2h5.1c1.9,0,3.5,1.6,3.5,3.5s-1.6,3.5-3.5,3.5h-4c-0.5,0-0.9,0.4-0.9,0.9s0.4,0.9,0.9,0.9h4c2.9,0,5.2-2.4,5.2-5.3C24,6.4,21.7,4,18.8,4z"/>
                      </g>
                    </svg>
                  </a>
                </div>
                <div class="ec-item ec-shuffle">
                  <a href="javascript:;" class="ms-control-shuffle">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 16" xml:space="preserve">
                      <g>
                        <path d="M11.3,8.5c0.3-0.7,0.5-1.3,0.7-1.7c0.2-0.3,0.3-0.6,0.4-0.8c0.1-0.2,0.3-0.4,0.5-0.6c0.2-0.2,0.4-0.4,0.7-0.5c0.2-0.1,0.5-0.1,0.8-0.1h2.4v1.9c0,0.1,0,0.2,0.1,0.2C17,7,17.1,7,17.2,7c0.1,0,0.2,0,0.2-0.1l3-3.2c0.1-0.1,0.1-0.1,0.1-0.2c0-0.1,0-0.2-0.1-0.2l-3-3.2C17.3,0,17.2,0,17.2,0c-0.1,0-0.2,0-0.2,0.1c-0.1,0.1-0.1,0.1-0.1,0.2v1.9h-2.4c-0.4,0-0.8,0.1-1.2,0.2c-0.4,0.1-0.7,0.2-1,0.4c-0.3,0.2-0.6,0.4-0.9,0.7c-0.3,0.3-0.5,0.6-0.7,0.8c-0.2,0.3-0.4,0.6-0.6,1C9.8,5.7,9.7,6.1,9.5,6.4C9.4,6.7,9.2,7.1,9.1,7.5C8.8,8.2,8.5,8.8,8.3,9.2C8.2,9.5,8,9.8,7.9,10c-0.1,0.2-0.3,0.4-0.5,0.6C7.2,10.8,7,11,6.7,11.1c-0.2,0.1-0.5,0.1-0.8,0.1H3.8c-0.1,0-0.2,0-0.2,0.1c-0.1,0.1-0.1,0.1-0.1,0.2v1.9c0,0.1,0,0.2,0.1,0.2c0.1,0.1,0.1,0.1,0.2,0.1h2.1c0.4,0,0.8-0.1,1.2-0.2c0.4-0.1,0.7-0.2,1-0.4C8.4,13,8.7,12.8,9,12.5c0.3-0.3,0.5-0.6,0.7-0.8c0.2-0.3,0.4-0.6,0.6-1c0.2-0.4,0.4-0.8,0.5-1.1C11,9.3,11.1,8.9,11.3,8.5z"/>
                        <path d="M3.8,4.8h2.1c0.3,0,0.5,0,0.8,0.1C6.9,5,7.1,5.2,7.3,5.3c0.2,0.1,0.3,0.3,0.5,0.6c0.2,0.2,0.3,0.5,0.4,0.6c0.1,0.2,0.2,0.4,0.4,0.7C9,6,9.4,5.1,9.8,4.5C8.8,3,7.5,2.2,5.9,2.2H3.8c-0.1,0-0.2,0-0.2,0.1C3.5,2.4,3.5,2.5,3.5,2.6v1.9c0,0.1,0,0.2,0.1,0.2C3.6,4.8,3.7,4.8,3.8,4.8z"/>
                        <path d="M17.4,9.1C17.3,9,17.2,9,17.2,9c-0.1,0-0.2,0-0.2,0.1c-0.1,0.1-0.1,0.1-0.1,0.2v1.9h-2.4c-0.3,0-0.5,0-0.8-0.1c-0.2-0.1-0.4-0.2-0.6-0.4c-0.2-0.1-0.3-0.3-0.5-0.6c-0.2-0.2-0.3-0.5-0.4-0.6c-0.1-0.2-0.2-0.4-0.4-0.7c-0.5,1.2-0.9,2.1-1.3,2.7c0.2,0.3,0.3,0.5,0.5,0.7c0.2,0.2,0.4,0.4,0.5,0.5c0.2,0.2,0.4,0.3,0.6,0.4c0.2,0.1,0.4,0.2,0.6,0.3c0.2,0.1,0.4,0.1,0.6,0.2c0.2,0,0.4,0.1,0.6,0.1c0.2,0,0.4,0,0.7,0.1c0.3,0,0.5,0,0.7,0c0.2,0,0.4,0,0.8,0c0.3,0,0.6,0,0.8,0v1.9c0,0.1,0,0.2,0.1,0.2C17,16,17.1,16,17.2,16c0.1,0,0.2,0,0.2-0.1l3-3.2c0.1-0.1,0.1-0.1,0.1-0.2c0-0.1,0-0.2-0.1-0.2L17.4,9.1z"/>
                      </g>
                    </svg>
                  </a>
                </div>
                <div class="ec-item ec-volume">
                  <a href="javascript:;">
                    <svg id="ec_volume" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 16" xml:space="preserve">
                      <g id="vol_middle" style="display:none;">
                        <path d="M15.8,12.1c-0.2,0-0.4-0.1-0.6-0.3c-0.3-0.3-0.3-0.9,0-1.2c1.4-1.4,1.4-3.8,0-5.3c-0.3-0.3-0.3-0.9,0-1.2c0.3-0.3,0.9-0.3,1.2,0c2.1,2.1,2.1,5.6,0,7.7C16.2,12,16,12.1,15.8,12.1z"/>
                        <path d="M13.4,16c-0.1,0-0.3-0.1-0.4-0.2l-4.4-4.4h-2c-0.3,0-0.6-0.3-0.6-0.6V5.1c0-0.3,0.3-0.6,0.6-0.6h2L13,0.2C13.2,0,13.4,0,13.6,0C13.9,0.1,14,0.3,14,0.6v14.9c0,0.2-0.1,0.4-0.4,0.5C13.6,16,13.5,16,13.4,16z"/>
                      </g>
                      <g id="vol_mute" style="display:none;">
                        <path d="M15.4,16c-0.1,0-0.3-0.1-0.4-0.2l-4.4-4.4h-2c-0.3,0-0.6-0.3-0.6-0.6V5.1c0-0.3,0.3-0.6,0.6-0.6h2L15,0.2C15.2,0,15.4,0,15.6,0C15.9,0.1,16,0.3,16,0.6v14.9c0,0.2-0.1,0.4-0.4,0.5C15.6,16,15.5,16,15.4,16z"/>
                      </g>
                      <g id="vol_max">
                        <path d="M18.2,15.3c-0.2,0-0.4-0.1-0.6-0.3c-0.3-0.3-0.3-0.9,0-1.2C19.1,12.3,20,10.2,20,8c0-2.2-0.9-4.3-2.4-5.9c-0.3-0.3-0.3-0.9,0-1.2c0.3-0.3,0.9-0.3,1.2,0c1.9,1.9,2.9,4.4,2.9,7.1c0,2.7-1,5.2-2.9,7.1C18.6,15.2,18.4,15.3,18.2,15.3L18.2,15.3z M15.1,13.7c-0.2,0-0.4-0.1-0.6-0.3c-0.3-0.3-0.3-0.9,0-1.2c2.3-2.3,2.3-6.1,0-8.5c-0.3-0.3-0.3-0.9,0-1.2c0.3-0.3,0.9-0.3,1.2,0C17.2,4,18,5.9,18,8c0,2.1-0.8,4-2.3,5.5C15.6,13.6,15.4,13.7,15.1,13.7L15.1,13.7L15.1,13.7z M12.1,12.1c-0.2,0-0.4-0.1-0.6-0.3c-0.3-0.3-0.3-0.9,0-1.2c1.4-1.4,1.4-3.8,0-5.3c-0.3-0.3-0.3-0.9,0-1.2c0.3-0.3,0.9-0.3,1.2,0c2.1,2.1,2.1,5.6,0,7.7C12.5,12,12.3,12.1,12.1,12.1z"/>
                        <path d="M9.7,16c-0.1,0-0.3-0.1-0.4-0.2l-4.4-4.4h-2c-0.3,0-0.6-0.3-0.6-0.6V5.1c0-0.3,0.3-0.6,0.6-0.6h2l4.4-4.4C9.5,0,9.7,0,9.9,0c0.2,0.1,0.4,0.3,0.4,0.5v14.9c0,0.2-0.1,0.4-0.4,0.5C9.9,16,9.8,16,9.7,16z"/>
                      </g>
                    </svg>
                  </a>
                  <div class="ec-volume-control">
                    <div class="ec-vol-el"></div>
                  </div>
                </div>
                <div class="ec-item ec-playlist">
                  <a href="javascript:;">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 16" xml:space="preserve">
                      <g>
                        <path d="M5.7,6.2c-0.5,0-0.9,0.2-1.2,0.5C4.2,7.1,4,7.5,4,8c0,0.5,0.2,0.9,0.5,1.3c0.3,0.4,0.7,0.5,1.2,0.5c0.5,0,0.9-0.2,1.2-0.5C7.3,8.9,7.4,8.5,7.4,8c0-0.5-0.2-0.9-0.5-1.3C6.6,6.4,6.2,6.2,5.7,6.2z"/>
                        <path d="M5.7,1.3c-0.5,0-0.9,0.2-1.2,0.5C4.2,2.2,4,2.6,4,3.1c0,0.5,0.2,0.9,0.5,1.3C4.8,4.8,5.2,5,5.7,5c0.5,0,0.9-0.2,1.2-0.5c0.3-0.4,0.5-0.8,0.5-1.3c0-0.5-0.2-0.9-0.5-1.3C6.6,1.5,6.2,1.3,5.7,1.3z"/>
                        <path d="M5.7,11c-0.5,0-0.9,0.2-1.2,0.5C4.2,11.9,4,12.4,4,12.9c0,0.5,0.2,0.9,0.5,1.3c0.3,0.4,0.7,0.5,1.2,0.5c0.5,0,0.9-0.2,1.2-0.5c0.3-0.4,0.5-0.8,0.5-1.3c0-0.5-0.2-0.9-0.5-1.3C6.6,11.2,6.2,11,5.7,11z"/>
                        <path d="M19.9,2c-0.1-0.1-0.1-0.1-0.2-0.1H8.9c-0.1,0-0.1,0-0.2,0.1C8.6,2.1,8.6,2.1,8.6,2.2V4c0,0.1,0,0.2,0.1,0.2c0.1,0.1,0.1,0.1,0.2,0.1h10.9c0.1,0,0.1,0,0.2-0.1C20,4.2,20,4.1,20,4V2.2C20,2.1,20,2.1,19.9,2z"/>
                        <path d="M19.7,6.8H8.9c-0.1,0-0.1,0-0.2,0.1C8.6,6.9,8.6,7,8.6,7.1v1.8c0,0.1,0,0.2,0.1,0.2c0.1,0.1,0.1,0.1,0.2,0.1h10.9c0.1,0,0.1,0,0.2-0.1C20,9.1,20,9,20,8.9V7.1c0-0.1,0-0.2-0.1-0.2C19.9,6.8,19.8,6.8,19.7,6.8z"/>
                        <path d="M19.7,11.6H8.9c-0.1,0-0.1,0-0.2,0.1c-0.1,0.1-0.1,0.1-0.1,0.2v1.8c0,0.1,0,0.2,0.1,0.2c0.1,0.1,0.1,0.1,0.2,0.1h10.9c0.1,0,0.1,0,0.2-0.1c0.1-0.1,0.1-0.1,0.1-0.2V12c0-0.1,0-0.2-0.1-0.2C19.9,11.7,19.8,11.6,19.7,11.6z"/>
                      </g>
                    </svg>
                  </a>
                  <div class="ec-playlist-control">
                    <div class="pl-head">
                        <h5>Songs </h5>
                      <a href="javascript:;" class="ms-control-shuffle">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 16" xml:space="preserve">
                          <g>
                            <path d="M11.3,8.5c0.3-0.7,0.5-1.3,0.7-1.7c0.2-0.3,0.3-0.6,0.4-0.8c0.1-0.2,0.3-0.4,0.5-0.6c0.2-0.2,0.4-0.4,0.7-0.5c0.2-0.1,0.5-0.1,0.8-0.1h2.4v1.9c0,0.1,0,0.2,0.1,0.2C17,7,17.1,7,17.2,7c0.1,0,0.2,0,0.2-0.1l3-3.2c0.1-0.1,0.1-0.1,0.1-0.2c0-0.1,0-0.2-0.1-0.2l-3-3.2C17.3,0,17.2,0,17.2,0c-0.1,0-0.2,0-0.2,0.1c-0.1,0.1-0.1,0.1-0.1,0.2v1.9h-2.4c-0.4,0-0.8,0.1-1.2,0.2c-0.4,0.1-0.7,0.2-1,0.4c-0.3,0.2-0.6,0.4-0.9,0.7c-0.3,0.3-0.5,0.6-0.7,0.8c-0.2,0.3-0.4,0.6-0.6,1C9.8,5.7,9.7,6.1,9.5,6.4C9.4,6.7,9.2,7.1,9.1,7.5C8.8,8.2,8.5,8.8,8.3,9.2C8.2,9.5,8,9.8,7.9,10c-0.1,0.2-0.3,0.4-0.5,0.6C7.2,10.8,7,11,6.7,11.1c-0.2,0.1-0.5,0.1-0.8,0.1H3.8c-0.1,0-0.2,0-0.2,0.1c-0.1,0.1-0.1,0.1-0.1,0.2v1.9c0,0.1,0,0.2,0.1,0.2c0.1,0.1,0.1,0.1,0.2,0.1h2.1c0.4,0,0.8-0.1,1.2-0.2c0.4-0.1,0.7-0.2,1-0.4C8.4,13,8.7,12.8,9,12.5c0.3-0.3,0.5-0.6,0.7-0.8c0.2-0.3,0.4-0.6,0.6-1c0.2-0.4,0.4-0.8,0.5-1.1C11,9.3,11.1,8.9,11.3,8.5z"/>
                            <path d="M3.8,4.8h2.1c0.3,0,0.5,0,0.8,0.1C6.9,5,7.1,5.2,7.3,5.3c0.2,0.1,0.3,0.3,0.5,0.6c0.2,0.2,0.3,0.5,0.4,0.6c0.1,0.2,0.2,0.4,0.4,0.7C9,6,9.4,5.1,9.8,4.5C8.8,3,7.5,2.2,5.9,2.2H3.8c-0.1,0-0.2,0-0.2,0.1C3.5,2.4,3.5,2.5,3.5,2.6v1.9c0,0.1,0,0.2,0.1,0.2C3.6,4.8,3.7,4.8,3.8,4.8z"/>
                            <path d="M17.4,9.1C17.3,9,17.2,9,17.2,9c-0.1,0-0.2,0-0.2,0.1c-0.1,0.1-0.1,0.1-0.1,0.2v1.9h-2.4c-0.3,0-0.5,0-0.8-0.1c-0.2-0.1-0.4-0.2-0.6-0.4c-0.2-0.1-0.3-0.3-0.5-0.6c-0.2-0.2-0.3-0.5-0.4-0.6c-0.1-0.2-0.2-0.4-0.4-0.7c-0.5,1.2-0.9,2.1-1.3,2.7c0.2,0.3,0.3,0.5,0.5,0.7c0.2,0.2,0.4,0.4,0.5,0.5c0.2,0.2,0.4,0.3,0.6,0.4c0.2,0.1,0.4,0.2,0.6,0.3c0.2,0.1,0.4,0.1,0.6,0.2c0.2,0,0.4,0.1,0.6,0.1c0.2,0,0.4,0,0.7,0.1c0.3,0,0.5,0,0.7,0c0.2,0,0.4,0,0.8,0c0.3,0,0.6,0,0.8,0v1.9c0,0.1,0,0.2,0.1,0.2C17,16,17.1,16,17.2,16c0.1,0,0.2,0,0.2-0.1l3-3.2c0.1-0.1,0.1-0.1,0.1-0.2c0-0.1,0-0.2-0.1-0.2L17.4,9.1z"/>
                          </g>
                        </svg>
                      </a>
                    </div>
                    <div class="pl-list-container">
                      <table class="pl-list"> 

                      	<?php

                         while($audio_query->have_posts()) : $audio_query->the_post(); 

                          $post_id = get_the_ID();
                          $content = trim(get_post_field('post_content', $post_id));
                          $ori_url = explode("\n", esc_html($content));
                          $new_content = preg_match_all('/\[[^\]]*\]/', $content, $matches);
                          if ($new_content) {
                              global $post;
                              $text = $matches[0][0];
                              $post_content = $post->post_content;
                              preg_match( '#\[audio\s*.*?\]#s', $post_content, $matches ) && preg_match('/"([^"]+)"/', $matches[0], $ids);
                              $audio_id = explode(",", $ids[1]);
                              if($audio_id){
                                  $audio_file = $audio_id[0];
                                  ?>
                          
                            <tr class="tr-item" data-id="mpid6">
                              <td class="td-num">
                                <span class="number" data-value="6"></span>
                              </td>
                              <td class="td-title">
                                <a href="javascript:;" class="pl-audio-item" data-url="<?php echo esc_url($audio_file); ?>">
                                  <span class="pl-item-title"><?php echo esc_html($post->post_title); ?></span>
                                  
                                </a>
                              </td>
                            </tr>
                            <?php }
                                        }

                        endwhile;
                        wp_reset_postdata(); ?>

                    <!-- End of blog section -->

                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td class="ms-nowplaying">
              <span class="np-thumb"></span>
              <span class="np-meta">
                <span class="np-title"></span>
                <span class="np-artist"></span>
              </span>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

                       <?php endif; ?>
<!-- // Music Player -->
<?php wp_footer(); ?>



</body>
</html>
