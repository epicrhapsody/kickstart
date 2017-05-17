<?php get_header(); ?>
    <!-- THE LOOP -->
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2 class="title"><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <span class="meta"><?php the_time('j. F, Y'); ?> <?php the_tags( '//  ', ', ' ); ?></span>
                <?php the_content(); ?>
            </div>
           <?php
           if (($wp_query->current_post + 1) < ($wp_query->post_count)) {
              echo '<hr />';
           }
           ?>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php if (function_exists("pagination")) {
        pagination($additional_loop->max_num_pages);
    } ?>
    <?php wp_reset_query(); ?>
    <!-- //THE LOOP -->
<?php get_footer(); ?>
