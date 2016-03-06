<?php

/**
 * Template Name: Lettering Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */

add_action('genesis_entry_footer', 'add_pagination_links');

function add_pagination_links() {

  echo '<div class="pagination-previous alignleft">';
  previous_post_link('&laquo; %link', 'previous');
  echo '</div>';

  echo '<div class="pagination-next alignright">';
  next_post_link('%link &raquo;', 'next');
  echo '</div>';
}

/** Remove Post Info */
remove_action('genesis_entry_header', 'genesis_post_info', 12);
remove_action('genesis_entry_footer','genesis_post_meta');
 
/* Run the Genesis Loop */
genesis();