<?php
$music_artist_options = music_artist_theme_options();
$video_show            = $music_artist_options['video_show'];
$video_message           = $music_artist_options['video_message'];
$video_name           = $music_artist_options['video_name'];
$video_bg_image  = $music_artist_options['video_bg_image'];
$video_youtube_url      = $music_artist_options['video_youtube_url'];
$video_button_txt = $music_artist_options['video_button_txt'];
$video_button_url = $music_artist_options['video_button_url'];

?>



    <div class="section video-section">
        <div class="container">
            <div class="row">
                <div class="video-content">
                    <div class="col-md-6">
                        <img src="<?php echo esc_url($video_bg_image); ?>" alt="" />
                        <a href="<?php echo esc_url($video_youtube_url); ?>" class="iframe-link"><i class="fa fa-play-circle" aria-hidden="true"></i></a>
                    </div>
                    
                     <div class="col-md-6">
                        <div class="video-wrap">
                            <h2><?php echo esc_html($video_message); ?></h2>
                            <p><?php echo esc_html($video_name); ?></p>
                            <?php  if( $video_button_txt && $video_button_url):?>
        <a href="<?php echo esc_url($video_button_url); ?>" class="btn btn-default"><?php echo esc_html($video_button_txt); ?></a>
        <?php endif; ?>
                        </div>
                     </div>
                   
                </div>
            </div>
        </div>
    </div>