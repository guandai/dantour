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

// Add meta box to the trip edit screen
add_action('add_meta_boxes', 'wptp_add_custom_meta_box');

function wptp_add_custom_meta_box() {
    add_meta_box(
        'wptp_custom_meta_box', // ID of the meta box
        'Additional Trip Info', // Title of the meta box
        'wptp_render_meta_box_content', // Callback function to render content
        'wp_travel', // Post type
        'normal', // Context
        'high' // Priority
    );
}

// Render the meta box content
function wptp_render_meta_box_content($post) {
    // Nonce field for security
    wp_nonce_field('wptp_save_meta_box_data', 'wptp_meta_box_nonce');

    // Retrieve existing meta value
    $custom_value = get_post_meta($post->ID, 'custom_trip_info', true);

    // Display input field for the custom meta
    echo '<label for="custom_trip_info">Custom Info:</label>';
    echo '<input type="text" id="custom_trip_info" name="custom_trip_info" value="' . esc_attr($custom_value) . '" />';
}

// Save the custom meta data
add_action('save_post', 'wptp_save_meta_box_data');

function wptp_save_meta_box_data($post_id) {
    // Verify nonce
    if (!isset($_POST['wptp_meta_box_nonce']) || !wp_verify_nonce($_POST['wptp_meta_box_nonce'], 'wptp_save_meta_box_data')) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save the data
    if (isset($_POST['custom_trip_info'])) {
        $custom_value = sanitize_text_field($_POST['custom_trip_info']);
        update_post_meta($post_id, 'custom_trip_info', $custom_value);
    }
}
