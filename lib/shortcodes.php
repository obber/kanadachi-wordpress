<?php

/**
 *
 *  Code Block Shortcode
 *
 */
function codeBlock($params, $content = null) {

  // default parameters
  extract(shortcode_atts(array(
    'lang' => 'javascript'
    ), $params));

  return
    '<pre><code class="'
    . ($lang == '' ? '">' : "$lang\">")
    . "$content" . "</code></pre>";
}
add_shortcode('code', 'codeBlock');