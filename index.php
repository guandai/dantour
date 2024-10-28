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




function insert_js_by_url_name ($file_name, $path_contains) {
    error_log(1111);
    $function_name = $file_name . '_' . md5('specific_url');
    error_log($function_name);
    ${$function_name} = function() {
        global $path_contains, $file_name, $function_name;
        if (strpos($_SERVER['REQUEST_URI'], $path_contains) !== false) {
            error_log('222' . '__' . $file_name);
            wp_enqueue_script(
                $file_name . '_script',
                plugins_url('js/' . $file_name . '.js', __FILE__),
                array('jquery'), '1.0', true
            );
        }
    };

    // Use the dynamic function name in the hook
    add_action('wp_enqueue_scripts', ${$function_name});
}

insert_js_by_url_name('form_change_upload_file', '.com/book');
