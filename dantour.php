<?php
/*
Plugin Name: My Custom Footer
Plugin URI: http://yourwebsite.com/my-custom-footer
Description: Adds a custom message to the footer of every post.
Version: 1.0
Author: Your Name
Author URI: http://yourwebsite.com
*/

// Hook into the 'the_content' filter
add_filter('the_content', 'add_my_footer');

// Define the function to add the footer
function add_my_footer($content) {
    // Customize the message
    $footer_message = '<div style="margin-top: 20px; padding: 10px; background-color: #f9f9f9; border: 1px solid #ddd;">Thank you for reading!</div>';

    // Append the footer message to the content of each post
    return $content . $footer_message;
}
?>
