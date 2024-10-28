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


