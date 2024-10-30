<?php

$no_posts = 5;
$before = '<li>';
$after = '</li>';
/** Define ABSPATH as this files directory */
define('ABSPATH', dirname(__FILE__) . '/../../../');
include_once(ABSPATH . "wp-config.php");
include_once(ABSPATH . "wp-load.php");
include_once(ABSPATH . "wp-includes/wp-db.php");
include_once(ABSPATH . "wp-includes/post.php");

global $wpdb;
$recent_posts = wp_get_recent_posts($no_posts);
$output = '';

foreach ($recent_posts as $post) {
    $output .= $before . '<a href="' . get_permalink($post["ID"]) . '" title="' .
            $post["post_title"] . '" >' . $post["post_title"] . '</a>' . $after;
}

$stuffToReturn = array();
$stuffToReturn["list"] = $output;

$options = get_option("widget_JQueryAccessibleButton");
if (!is_array($options)) {
    $options = array(
        'title' => 'JQuery Accessible Button',
        'archives' => 'Archives',
        'posts' => 'Posts',
        'comments' => 'Comments',
        'recent' => 'Recent',
        'text' => 'Select the appropriate checkbox'
    );
}
$stuffToReturn["title"] = $options['recent'] . " " . $options['posts'];
echo json_encode($stuffToReturn);

?>
