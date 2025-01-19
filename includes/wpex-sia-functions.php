<?php
// wpex-sia-functions.php
defined('ABSPATH') || exit;

/**
 * Gets the localized date based on selected calendar type
 * 
 * @since 1.0.0
 * @return string Formatted date string in selected calendar format
 */
function wpex_sia_get_localized_date()
{
    $calendar_type = get_option('wpex_sia_calendar_type', 'gregorian');
    $now = current_time('timestamp');
    if ($calendar_type === 'solar_hijri') {
        // Use IntlDateFormatter for Solar Hijri
        $formatter = new IntlDateFormatter(
            'fa_IR@calendar=persian',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'UTC',
            IntlDateFormatter::TRADITIONAL,
            'yyyy/MM/dd'
        );
        return $formatter->format($now);
    } elseif ($calendar_type === 'lunar_hijri') {
        // Use IntlDateFormatter for Lunar Hijri
        $formatter = new IntlDateFormatter(
            get_locale(),
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'UTC',
            IntlDateFormatter::TRADITIONAL,
            'yyyy/MM/dd'
        );
        $formatter->setCalendar(IntlDateFormatter::TRADITIONAL);
        return $formatter->format($now);
    } else {
        return date_i18n('Y/m/d', $now); // Default Gregorian
    }
}

/**
 * Enqueues frontend styles and scripts, localizes JavaScript data
 * 
 * @since 1.0.0
 * @return void
 */
function wpex_sia_enqueue_assets()
{
    wp_enqueue_style('wpex-sia-style', WPEX_SIA_PLUGIN_URL . 'assets/css/wpex-sia-front-css.css', [], WPEX_SIA_VERSION);
    wp_enqueue_script('wpex-sia-script', WPEX_SIA_PLUGIN_URL . 'assets/js/wpex-sia-front-js.js', [], WPEX_SIA_VERSION, true);

    $message = esc_js(get_option('wpex_sia_message_text', __('Site is active. Prices and availability of products are up-to-date.', 'site-is-alive')));
    $date_time = wpex_sia_get_localized_date();
    $calendar_type = get_option('wpex_sia_calendar_type', 'gregorian');
    // Pass translations and dynamic data.
    wp_localize_script('wpex-sia-script', 'wpexSiaPhpData', [
        'message' => esc_js(get_option('wpex_sia_message_text', __('Site is active. Prices and availability of products are up-to-date.', 'site-is-alive'))),
        'dateTime' => wpex_sia_get_localized_date(),
        'calendarType' => get_option('wpex_sia_calendar_type', 'gregorian'),
        'displayDate' => get_option('wpex_sia_display_date', 1),
        'displayTime' => get_option('wpex_sia_display_time', 1),
        'displayMessage' => get_option('wpex_sia_display_message', 1),
        'textColor' => get_option('wpex_sia_message_color', '#000000'),
        'backgroundColor' => get_option('wpex_sia_background_color', '#ffffff'),
        'borderColor' => get_option('wpex_sia_border_color', ''),
        'fontSize' => get_option('wpex_sia_font_size', 1),
        'borderStyle' => get_option('wpex_sia_border_style', 0),
        'borderWith' => get_option('wpex_sia_border_width', 0),
        'borderRadius' => get_option('wpex_sia_border_radius', 0),
        'padding' => get_option('wpex_sia_padding', 0),

    ]);
}
add_action('wp_enqueue_scripts', 'wpex_sia_enqueue_assets');

/**
 * Registers the [site_is_alive] shortcode
 * 
 * @since 1.0.0
 * @return string HTML output for the site status message
 */
function wpex_sia_display_message_shortcode()
{
    ob_start();
?>
    <div id="wpex-sia-message">
        <span id="wpex-sia-timestamp"></span>
        <span id="wpex-sia-message-text"></span>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('wpex_sia_site_is_alive', 'wpex_sia_display_message_shortcode');
