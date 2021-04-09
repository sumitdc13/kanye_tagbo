<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package music_artist
 */


$music_artist_options = music_artist_theme_options();

$show_sidebar = $music_artist_options['show_sidebar'];

get_header();
?>

<div id="content" class="vb-section-content section">
    <div class="container">
        <div class="row">

        	<?php if (1 == $show_sidebar){ ?>
            <div class="col-md-8">

            	<?php }

            	else { ?>
					<div class="col-md-12">
				<?php } ?>

                <div id="primary" class="content-area">
                    <main id="main" class="site-main">

						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', get_post_type() );

							the_post_navigation(
								array(
									'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'music-artist' ) . '</span> <span class="nav-title">%title</span>',
									'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'music-artist' ) . '</span> <span class="nav-title">%title</span>',
								)
							);

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

					</main><!-- #main -->
                </div>
            </div>

            <?php if (1 == $show_sidebar): ?>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>

        	<?php endif; ?>
        </div>
    </div>
</div>
<?php
get_footer();
