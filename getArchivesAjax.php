<?php

/** Define ABSPATH as this files directory */
define('ABSPATH', dirname(__FILE__) . '/../../../');
include_once(ABSPATH . "wp-config.php");

$args = array(
    'type' => 'monthly',
    'format' => 'html',
    'show_post_count' => false,
    'echo' => 0);

$archives = wp_get_archives($args);
$output = $archives;

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
$stuffToReturn["title"] = $options['archives'];
echo json_encode($stuffToReturn);
?>
