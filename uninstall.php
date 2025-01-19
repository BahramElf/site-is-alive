<?php
// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Options to remove
$options = array(
    'wpex_sia_message_text',
    'wpex_sia_calendar_type',
    'wpex_sia_display_date',
    'wpex_sia_display_time',
    'wpex_sia_display_message',
    'wpex_sia_message_color',
    'wpex_sia_background_color',
    'wpex_sia_border_color',
    'wpex_sia_font_size',
    'wpex_sia_border_style',
    'wpex_sia_border_width',
    'wpex_sia_border_radius',
    'wpex_sia_padding'
);

// Remove each option
foreach ($options as $option) {
    delete_option($option);
}
