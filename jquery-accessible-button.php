<?php
/*
Plugin Name: JQuery Accessible Button
Plugin URI: http://wordpress.org/extend/plugins/jquery-accessible-button/
Description: WAI-ARIA Enabled Button Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 3.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "JQueryAccessibleButton_init");
function JQueryAccessibleButton_init() {
    register_sidebar_widget(__('JQuery Accessible Button'), 'widget_JQueryAccessibleButton');
    register_widget_control(   'JQuery Accessible Button', 'JQueryAccessibleButton_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_JQueryAccessibleButton') ) {
        wp_register_style('jquery.ui.all', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-button/lib/jquery-ui/themes/base/jquery.ui.all.css'));
        wp_enqueue_style('jquery.ui.all');

        wp_deregister_script('jquery');

        // add your own script
        wp_register_script('jquery-1.6.4', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-button/lib/jquery-ui/jquery-1.6.4.js'));
        wp_enqueue_script('jquery-1.6.4');

        wp_register_script('jquery.ui.core', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-button/lib/jquery-ui/ui/jquery.ui.core.js'));
        wp_enqueue_script('jquery.ui.core');

        wp_register_script('jquery.ui.widget', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-button/lib/jquery-ui/ui/jquery.ui.widget.js'));
        wp_enqueue_script('jquery.ui.widget');

        wp_register_script('jquery.ui.button', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-button/lib/jquery-ui/ui/jquery.ui.button.js'));
        wp_enqueue_script('jquery.ui.button');

        wp_register_script('jquery.ui.accordion', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-button/lib/jquery-ui/ui/jquery.ui.accordion.js'));
        wp_enqueue_script('jquery.ui.accordion');

        wp_register_style('demos', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-button/lib/jquery-ui/demos.css'));
        wp_enqueue_style('demos');

        wp_register_script('JQueryAccessibleButton', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-button/lib/JQueryAccessibleButton.js'));
        wp_enqueue_script('JQueryAccessibleButton');
    }
}

function widget_JQueryAccessibleButton($args) {
    extract($args);

    $options = get_option("widget_JQueryAccessibleButton");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'JQuery Accessible Button',
            'archives' => 'Archives',
            'posts' => 'Posts',
            'comments' => 'Comments',
            'recent' => 'Recent',
            'text' => 'Select the appropriate button'
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    JQueryAccessibleButtonContent();
    echo $after_widget;
}

function JQueryAccessibleButtonContent() {
    $options = get_option("widget_JQueryAccessibleButton");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'JQuery Accessible Button',
            'archives' => 'Archives',
            'posts' => 'Posts',
            'comments' => 'Comments',
            'recent' => 'Recent',
            'text' => 'Select the appropriate button'
        );
    }

    echo '<div class="demo" role="application">
    <form>
    <div id="radioButton">
        <input type="radio" id="radio1Button" name="radioButton" value="archives" /><label for="radio1Button">' . $options['archives'] . '</label>
        <input type="radio" id="radio2Button" name="radioButton" value="posts" /><label for="radio2Button">' . $options['posts'] . '</label>
        <input type="radio" id="radio3Button" name="radioButton" value="comments" /><label for="radio3Button">' . $options['comments'] . '</label>
    </div>
    <br />
    </form>
<div id="accordion_withButton">
	<h3><a class="areaAButton" href="#">' . $options['recent'] . '...</a></h3>
	<div class="areaBButton">
            <ul>
                <li>' . $options['text'] . '</li>
            </ul>
	</div>
    </div>
</div>';
}

function JQueryAccessibleButton_control() {
    $options = get_option("widget_JQueryAccessibleButton");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'JQuery Accessible Button',
            'archives' => 'Archives',
            'posts' => 'Posts',
            'comments' => 'Comments',
            'recent' => 'Recent',
            'text' => 'Select the appropriate button'
        );
    }

    if ($_POST['JQueryAccessibleButton-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['JQueryAccessibleButton-WidgetTitle']);
        update_option("widget_JQueryAccessibleButton", $options);
    }
    if ($_POST['JQueryAccessibleButton-SubmitArchives']) {
        $options['archives'] = htmlspecialchars($_POST['JQueryAccessibleButton-WidgetArchives']);
        update_option("widget_JQueryAccessibleButton", $options);
    }
    if ($_POST['JQueryAccessibleButton-SubmitRecent']) {
        $options['recent'] = htmlspecialchars($_POST['JQueryAccessibleButton-WidgetRecent']);
        update_option("widget_JQueryAccessibleButton", $options);
    }
    if ($_POST['JQueryAccessibleButton-SubmitPosts']) {
        $options['posts'] = htmlspecialchars($_POST['JQueryAccessibleButton-WidgetPosts']);
        update_option("widget_JQueryAccessibleButton", $options);
    }
    if ($_POST['JQueryAccessibleButton-SubmitComments']) {
        $options['comments'] = htmlspecialchars($_POST['JQueryAccessibleButton-WidgetComments']);
        update_option("widget_JQueryAccessibleButton", $options);
    }
    if ($_POST['JQueryAccessibleButton-SubmitText']) {
        $options['text'] = htmlspecialchars($_POST['JQueryAccessibleButton-WidgetText']);
        update_option("widget_JQueryAccessibleButton", $options);
    }
    ?>
    <p>
        <label for="JQueryAccessibleButton-WidgetTitle">Widget Title: </label>
        <input type="text" id="JQueryAccessibleButton-WidgetTitle" name="JQueryAccessibleButton-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="JQueryAccessibleButton-SubmitTitle" name="JQueryAccessibleButton-SubmitTitle" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleButton-WidgetArchives">Translation for "Archives": </label>
        <input type="text" id="JQueryAccessibleButton-WidgetArchives" name="JQueryAccessibleButton-WidgetArchives" value="<?php echo $options['archives'];?>" />
        <input type="hidden" id="JQueryAccessibleButton-SubmitArchives" name="JQueryAccessibleButton-SubmitArchives" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleButton-WidgetPosts">Translation for "Posts": </label>
        <input type="text" id="JQueryAccessibleButton-WidgetPosts" name="JQueryAccessibleButton-WidgetPosts" value="<?php echo $options['posts'];?>" />
        <input type="hidden" id="JQueryAccessibleButton-SubmitPosts" name="JQueryAccessibleButton-SubmitPosts" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleButton-WidgetComments">Translation for "Comments": </label>
        <input type="text" id="JQueryAccessibleButton-WidgetComments" name="JQueryAccessibleButton-WidgetComments" value="<?php echo $options['comments'];?>" />
        <input type="hidden" id="JQueryAccessibleButton-SubmitComments" name="JQueryAccessibleButton-SubmitComments" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleButton-WidgetRecent">Translation for "Recent": </label>
        <input type="text" id="JQueryAccessibleButton-WidgetRecent" name="JQueryAccessibleButton-WidgetRecent" value="<?php echo $options['recent'];?>" />
        <input type="hidden" id="JQueryAccessibleButton-SubmitRecent" name="JQueryAccessibleButton-SubmitRecent" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleButton-WidgetText">Translation for "Select the appropriate button": </label>
        <input type="text" id="JQueryAccessibleButton-WidgetText" name="JQueryAccessibleButton-WidgetText" value="<?php echo $options['text'];?>" />
        <input type="hidden" id="JQueryAccessibleButton-SubmitText" name="JQueryAccessibleButton-SubmitText" value="1" />
    </p>
    
    <?php
}

?>
