<?php

class AjaxExampleController
{
    /**
     * Let's get this party started!
     *
     * @return void
     */
    static function init(): void
    {
        add_action('init', [self::class, 'addScriptsToPlugin']);
        add_action('init', [self::class, 'registerShortcodeForAJAXExample']);
        add_action('wp_ajax_getLatestPost', [self::class, 'getLatestPost']);
        add_action('wp_ajax_nopriv_getLatestPost', [self::class, 'getLatestPost']);
    }

    /**
     * Add in js scripts to the admin
     *
     * @param $hook
     * @return void
     */
    static function addScriptsToPlugin($hook): void
    {
        // loading js
        wp_register_script('ajaxexample', plugins_url('/../js/ajaxexample.js"',__FILE__ ), array('jquery-core'), date("Y-m-d-H-i-s"), true);
        wp_enqueue_script('ajaxexample');
        wp_localize_script('ajaxexample', 'ajaxexample_object', array('ajaxexample_url' => admin_url('admin-ajax.php')));
    }

    /**
     * Registers a simple shortcode to use on the front-end.
     *
     * @return void
     */
    static function registerShortcodeForAJAXExample(): void
    {
        add_shortcode('ajax-example', [self::class, 'displayAJAXExampleButtons']);
    }

    /**
     * Shortcode content.
     *
     * @return false|string
     */
    static function displayAJAXExampleButtons()
    {
        ob_start();
        // Normally I would not directly echo here, but it's a quick example...
        echo "<button id='ajaxexamplebutton'>Get Latest Post</button>";
        echo "<div id='ajaxexampleresponse'></div>";
        return ob_get_clean();
    }

    /**
     * This is the AJAX function.
     *
     * @return void
     */
    static function getLatestPost()
    {
        $args = [
            "post_type" => "post",
            "numberposts" => 1,
            "posts_per_page" => 1
        ];
        $post = get_posts($args);
        echo json_encode($post);
        wp_die();
    }
}