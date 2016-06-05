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
    '<div class="sc note note-'
    . ($color == '' ? '">' : "$color\">")
    . "$content" . "</div>";
}
add_shortcode('note', 'noteBlock');

/**
 *
 *  Code Block Shortcodes
 *
 */
function codeBlock($params, $content = null) {

  // default parameters
  extract(shortcode_atts(array(
    'lang' => 'javascript'
    ), $params));

  return
    '<pre><code class="sc custom-sc hljs '
    . ($lang == '' ? '">' : "$lang\">")
    . "$content" . "</pre></code>";
}
add_shortcode('c', 'codeBlock');

/**
 *
 *  Toy Problem Hints & Solution Shortcodes
 *
 */
function tpHints($params, $content = null) {

  return
    '<p class="tplink-stop"><a href="" class="tplink" id="hints"><span>&#8595;</span> View Hints</a></p>'
    . '<div class="sc hints">'
    . do_shortcode("$content") . "</div>";
}
add_shortcode('hints', 'tpHints');

function tpSolutions($params, $content = null) {

  return
    '<p class="tplink-stop"><a href="" class="tplink" id="solution"><span>&#8595;</span> View Solution</a></p>'
    . '<div class="sc solution">'
    . do_shortcode("$content") . "</div>";
}
add_shortcode('solution', 'tpSolutions');

