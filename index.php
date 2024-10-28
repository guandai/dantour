<?php
/*
Plugin Name: Dantour Plugin
Plugin URI: http://twindai.com/my-custom-footer
Description: Adds a custom message to the footer of every post.
Version: 1.0
Author: twindai
Author URI: http://twindai.com
*/



// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once 'download_core.php';
require_once 'bookings_user.php';
require_once 'transfer_user_data.php';
// require_once 'redirect_trace.php';



function insert_js_by_url_name($file_name, $path_contains) {
    // Define an anonymous function with a unique key in the add_action hook
    add_action('wp_enqueue_scripts', function() use ($file_name, $path_contains) {
        if (strpos($_SERVER['REQUEST_URI'], $path_contains) !== false) {
            wp_enqueue_script(
                $file_name . '_script',
                plugins_url('js/' . $file_name . '.js', __FILE__),
                array('jquery'), '1.0', true
            );
        }
    });
}

insert_js_by_url_name('form_change_upload_file', '/book_');
insert_js_by_url_name('form_load_wpuserdata', '/book_');
insert_js_by_url_name('form_add_repeater', '/book_');
insert_js_by_url_name('form_vehicel_active', '/book_');

insert_js_by_url_name('form_show_sent_modal', '/booking_');
insert_js_by_url_name('global_navigation', '/');
insert_js_by_url_name('account_order_data', '/account');
