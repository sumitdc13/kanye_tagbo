<?php


$music_artist_options = music_artist_theme_options();
$youtube_video_show            = $music_artist_options['youtube_video_show'];
$youtube_video_title           = $music_artist_options['youtube_video_title'];
$youtube_video_desc           = $music_artist_options['youtube_video_desc'];
$youtube_video1           = $music_artist_options['youtube_video1'];
$youtube_video2  = $music_artist_options['youtube_video2'];


if($youtube_video_show) { 
    if (1 == $youtube_video_show):?>
    <div class="section youtube-section">
        <div class="container">
            <div class="row">
                <?php if ($youtube_video_title || $youtube_video_desc): ?>
                    <div class="section-title">
                        <?php

                         if ($youtube_video_desc)
                            echo '<p>' . esc_html($youtube_video_desc) . '</p>';
                        
                        if ($youtube_video_title)
                            echo '<h2>' . esc_html($youtube_video_title) . '</h2>';
                       
                        ?>
                    </div>
                <?php endif; ?>
            </div>
         </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php 
                     $url = $youtube_video1;
                        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                        $id = $matches[1];
                        $width = '100%';
                        $height = '450px';
                        ?>
                        <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                        src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                        frameborder="0" allowfullscreen></iframe> 

                </div>

                <div class="col-md-6">
                    <?php 
                     $url = $youtube_video2;
                        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                        $id = $matches[1];
                        $width = '100%';
                        $height = '450px';
                        ?>
                        <iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
                        src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                        frameborder="0" allowfullscreen></iframe> 

                </div>
            </div>
        </div>
    </div>

        <?php
        
    endif;
}


