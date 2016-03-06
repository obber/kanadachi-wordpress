<?php

/**
 * Template Name: Lettering Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_lettering_archive_template' ); // Add custom loop

function custom_lettering_archive_template() {  
  
  // Intro Text and other elements
  echo '<div class="page">';
  echo '<h1 class="archive-title">Hand Lettering</h1>';
  echo '<div class="entry-content">';

  // Loop through modified $query
  if( have_posts() ):
        
    while( have_posts() ): the_post();
    echo '<a class="lettering-piece-permalink" href="' . get_post_permalink() . '">';
    echo '<div class="lettering-piece-container" style="background-image:url('. wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) .');"></div>';
    echo '</a>';
    endwhile;

  endif;

  echo genesis_posts_nav();

}

/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
/* Run the Genesis Loop */
genesis();