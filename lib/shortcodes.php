<?php

/**
 *
 *  Colored Notes Shortcodes
 *
 */
function noteBlock($params, $content = null) {

  // default parameters
  extract(shortcode_atts(array(
    'color' => ''
    ), $params));

  return
    '<div class="note note-'
    . ($color == '' ? '">' : "$color\">")
    . "$content" . "</div>";
}
add_shortcode('note', 'noteBlock');