<?php

/**
 * Template Name: Lettering Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_toy_problems_archive' ); // Add custom loop

function custom_toy_problems_archive() {  
  
  // Intro Text and other elements
  echo '<div class="page">';
  echo '<h1 class="archive-title">Toy Problems</h1>';
  echo '<div class="entry-content">';

  // Loop through modified $query
  if( have_posts() ):
        
    while( have_posts() ): the_post();
    echo '<h3>';
    the_title();
    echo '</h3>';
    echo '<p>' . get_the_excerpt() . '</p>';
    echo '<p><a href="' . get_permalink() . '">View Toy Problem &#10141;</a>';
    endwhile;

  endif;

  echo genesis_posts_nav();

}

/** Remove Post Info */
// remove_action('genesis_before_post_content','genesis_post_info');
// remove_action('genesis_after_post_content','genesis_post_meta');
 
/* Run the Genesis Loop */
genesis();