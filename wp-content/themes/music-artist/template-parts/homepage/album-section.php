<?php
$music_artist_options = music_artist_theme_options();

$album_show = $music_artist_options['album_show'];
$album_category = $music_artist_options['album_category'];
$album_title = $music_artist_options['album_title'];
$album_desc = $music_artist_options['album_desc'];
if($album_show) {

    if (1 == $album_show):
        if ($album_category == 'none') {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'order' => 'desc',
                'orderby' => 'menu_order date',

            );
        } else {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'order' => 'desc',
                'orderby' => 'menu_order date',
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => array( $album_category ),
                    ),
                ),
            );
        } ?>
        <div class="album-section section">
            <div class="container">
                <div class="row">
                    <?php if ($album_title || $album_desc): ?>
                        <div class="section-title">
                            <?php
                            if ($album_desc)
                                echo '<p>' . esc_html($album_desc) . '</p>';
                            
                            if ($album_title)
                                echo '<h2>' . esc_html($album_title) . '</h2>';
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
             </div>
             <div class="container">
                <div class="row"> 
                    <div class="album-list-wrap">
                <?php 
                $loop = 1;
                $recent_query = new WP_Query($args);
                    if ($recent_query->have_posts()) :
                    ?>

                        <?php
                        while ($recent_query->have_posts()) : $recent_query->the_post();
                        global $post;
                         echo(($loop % 3 == 1 || $loop == 1) ? '<div class="row">' : '');
                            $content = get_the_content();
                            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                            $image = wp_get_attachment_image_src($post_thumbnail_id, 'music-artist-blog-thumbnail-img');
                            ?>
                            <div class="col-md-4 col-sm-4">

                                <div class="card">
                                    <div class="child">
                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url($image[0]); ?>" alt="" /></a>

                                        <div class="album-footer">
                                            <h2 class="title"> <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                                        </div>
                                    </div>
                              
                                </div>
                            </div>
                        <?php 
                    echo(($loop % 3  == 0 && $loop != 1) ? '</div>' : '');
                        $loop++;
                    endwhile;
                        wp_reset_postdata();
                        ?>
                    <?php
                    endif; ?>
                    </div>
                </div>
             </div>
         </div>
        </div>
        <?php
        
    endif;
}



