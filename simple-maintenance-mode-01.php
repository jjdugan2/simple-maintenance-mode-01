<?php
/**
 * Plugin Name: Simple Maintenance Mode
 * Description: Displays a maintenance mode message for users who are not logged in.
 * Version: 1.0
 * Author: Jorgen Jensen
 */

// Hook the 'wp_loaded' action to check for maintenance mode before the site loads.
add_action('wp_loaded', 'smm_maintenance_mode');

function smm_maintenance_mode() {
    // Check if the current user is not an administrator.
    if (!current_user_can('manage_options')) {
        // Set the HTTP response status code to 503 (Service Unavailable) for SEO.
        header('HTTP/1.1 503 Service Temporarily Unavailable');
        header('Content-Type: text/html; charset=utf-8');

        // Display the maintenance mode message.
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Maintenance Mode</title></head><body>';
        echo '<h1>Site Under Maintenance</h1>';
        echo '<p>We are currently performing maintenance on the site. Please check back later.</p>';
        echo '</body></html>';

        // Stop script execution to prevent WordPress from loading.
        exit();
    }
}
?>
