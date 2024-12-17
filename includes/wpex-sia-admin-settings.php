<?php
// wpex-sia-admin-settings.php
defined('ABSPATH') || exit;

function wpex_sia_add_admin_menu()
{
    add_menu_page(
        __('Site is Alive', WPEX_SIA_TEXT_DOMAIN),
        __('Site is Alive', WPEX_SIA_TEXT_DOMAIN),
        'manage_options',
        'site-is-alive',
        'wpex_sia_render_admin_page',
        'dashicons-heart',
        100
    );
}
add_action('admin_menu', 'wpex_sia_add_admin_menu');

function wpex_sia_render_admin_page()
{
?>
    <div class="wrap">
        <h1><?php esc_html_e('Site is Alive Settings', WPEX_SIA_TEXT_DOMAIN); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wpex_sia_settings_group');
            do_settings_sections('site-is-alive');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

// Register settings.
function wpex_sia_register_settings()
{
    add_settings_section(
        'wpex_sia_main_section',
        __('General Settings', WPEX_SIA_TEXT_DOMAIN),
        '__return_null',
        'site-is-alive'
    );

    register_setting('wpex_sia_settings_group', 'wpex_sia_message_text');
    register_setting('wpex_sia_settings_group', 'wpex_sia_calendar_type');
    register_setting('wpex_sia_settings_group', 'wpex_sia_display_date');
    register_setting('wpex_sia_settings_group', 'wpex_sia_display_time');
    register_setting('wpex_sia_settings_group', 'wpex_sia_display_message');
    register_setting('wpex_sia_settings_group', 'wpex_sia_message_color');
    register_setting('wpex_sia_settings_group', 'wpex_sia_background_color');
    register_setting('wpex_sia_settings_group', 'wpex_sia_border_color');
    register_setting('wpex_sia_settings_group', 'wpex_sia_font_size');
    register_setting('wpex_sia_settings_group', 'wpex_sia_border_style');
    register_setting('wpex_sia_settings_group', 'wpex_sia_border_width');
    register_setting('wpex_sia_settings_group', 'wpex_sia_border_radius');
    register_setting('wpex_sia_settings_group', 'wpex_sia_padding');


    add_settings_field(
        'wpex_sia_message_text',
        __('Message Text', WPEX_SIA_TEXT_DOMAIN),
        'wpex_sia_message_text_field_callback',
        'site-is-alive',
        'wpex_sia_main_section'
    );

    add_settings_field(
        'wpex_sia_calendar_type',
        __('Calendar Type', WPEX_SIA_TEXT_DOMAIN),
        'wpex_sia_calendar_type_field_callback',
        'site-is-alive',
        'wpex_sia_main_section'
    );

    add_settings_field(
        'wpex_sia_display_options',
        __('Display Options', WPEX_SIA_TEXT_DOMAIN),
        'wpex_sia_display_options_callback',
        'site-is-alive',
        'wpex_sia_main_section'
    );

    add_settings_field(
        'wpex_sia_colors',
        __('Message Colors', WPEX_SIA_TEXT_DOMAIN),
        'wpex_sia_colors_callback',
        'site-is-alive',
        'wpex_sia_main_section'
    );

    add_settings_field(
        'wpex_sia_styling',
        __('Message Styling', WPEX_SIA_TEXT_DOMAIN),
        'wpex_sia_styling_callback',
        'site-is-alive',
        'wpex_sia_main_section'
    );
}
add_action('admin_init', 'wpex_sia_register_settings');

function wpex_sia_message_text_field_callback()
{
    $message = get_option('wpex_sia_message_text', __('Site is active. Prices and availability of products are up-to-date.', WPEX_SIA_TEXT_DOMAIN));
?>
    <input type="text" name="wpex_sia_message_text" value="<?php echo esc_attr($message); ?>" class="regular-text">
    <p class="description">
        <?php esc_html_e('Enter the message text to display on the site.', WPEX_SIA_TEXT_DOMAIN); ?>
    </p>
<?php
}

function wpex_sia_calendar_type_field_callback()
{
    $calendar_type = get_option('wpex_sia_calendar_type', 'gregorian');
?>
    <select name="wpex_sia_calendar_type">
        <option value="gregorian" <?php selected($calendar_type, 'gregorian'); ?>>
            <?php esc_html_e('Gregorian', WPEX_SIA_TEXT_DOMAIN); ?>
        </option>
        <option value="solar_hijri" <?php selected($calendar_type, 'solar_hijri'); ?>>
            <?php esc_html_e('Solar Hijri', WPEX_SIA_TEXT_DOMAIN); ?>
        </option>
        <option value="lunar_hijri" <?php selected($calendar_type, 'lunar_hijri'); ?>>
            <?php esc_html_e('Lunar Hijri', WPEX_SIA_TEXT_DOMAIN); ?>
        </option>
    </select>
    <p class="description"><?php esc_html_e('Select the calendar type to display the date.', WPEX_SIA_TEXT_DOMAIN); ?></p>
<?php
}

function wpex_sia_display_options_callback()
{
    $display_date = get_option('wpex_sia_display_date', 1);
    $display_time = get_option('wpex_sia_display_time', 1);
    $display_message = get_option('wpex_sia_display_message', 1);
?>
    <label>
        <input type="checkbox" name="wpex_sia_display_date" value="1" <?php checked(1, $display_date); ?>>
        <?php esc_html_e('Display Date', WPEX_SIA_TEXT_DOMAIN); ?>
    </label>
    <br>
    <label>
        <input type="checkbox" name="wpex_sia_display_time" value="1" <?php checked(1, $display_time); ?>>
        <?php esc_html_e('Display Time', WPEX_SIA_TEXT_DOMAIN); ?>
    </label>
    <br>
    <label>
        <input type="checkbox" name="wpex_sia_display_message" value="1" <?php checked(1, $display_message); ?>>
        <?php esc_html_e('Display Message', WPEX_SIA_TEXT_DOMAIN); ?>
    </label>
    <p class="description"><?php esc_html_e('Select the items you want to display to the user.', WPEX_SIA_TEXT_DOMAIN); ?></p>
<?php
}

function wpex_sia_colors_callback()
{
    $message_color = get_option('wpex_sia_message_color', '#000000');
    $background_color = get_option('wpex_sia_background_color', '#ffffff');
    $border_color = get_option('wpex_sia_border_color', '');
?>
    <p>
        <label>
            <?php esc_html_e('Text Color', WPEX_SIA_TEXT_DOMAIN); ?><br>
            <input type="color" name="wpex_sia_message_color" value="<?php echo esc_attr($message_color); ?>">
        </label>
    </p>
    <p>
        <label>
            <?php esc_html_e('Background Color', WPEX_SIA_TEXT_DOMAIN); ?><br>
            <input type="color" name="wpex_sia_background_color" value="<?php echo esc_attr($background_color); ?>">
        </label>
    </p>
    <p>
        <label>
            <?php esc_html_e('Border Color', WPEX_SIA_TEXT_DOMAIN); ?><br>
            <input type="color" name="wpex_sia_border_color" value="<?php echo esc_attr($border_color); ?>">
        </label>
    </p>
    <p class="description">
        <?php esc_html_e('Choose colors for the message display.', WPEX_SIA_TEXT_DOMAIN); ?>
    </p>
<?php
}

function wpex_sia_styling_callback()
{
    $font_size = get_option('wpex_sia_font_size', '1');
    $border_style = get_option('wpex_sia_border_style', 'none');
    $border_width = get_option('wpex_sia_border_width', '0');
    $border_radius = get_option('wpex_sia_border_radius', '0');
    $padding = get_option('wpex_sia_padding', '0');
?>
    <p>
        <label>
            <?php esc_html_e('Font Size (rem)', WPEX_SIA_TEXT_DOMAIN); ?><br>
            <input type="number" name="wpex_sia_font_size" value="<?php echo esc_attr($font_size); ?>" min="0" max="50" step="0.25">
        </label>
    </p>
    <p>
        <label>
            <?php esc_html_e('Border Width (px)', WPEX_SIA_TEXT_DOMAIN); ?><br>
            <input type="number" name="wpex_sia_border_width" value="<?php echo esc_attr($border_width); ?>" min="0" max="50" step="1">
        </label>
    </p>
    <p>
        <label>
            <?php esc_html_e('Border Radius (px)', WPEX_SIA_TEXT_DOMAIN); ?><br>
            <input type="number" name="wpex_sia_border_radius" value="<?php echo esc_attr($border_radius); ?>" min="0" max="50" step="1">
        </label>
    </p>
    <p>
        <label>
            <?php esc_html_e('Padding (px)', WPEX_SIA_TEXT_DOMAIN); ?><br>
            <input type="number" name="wpex_sia_padding" value="<?php echo esc_attr($padding); ?>" min="0" max="100" step="1">
        </label>
    </p>
    <p class="description">
        <?php esc_html_e('Customize the message box styling.', WPEX_SIA_TEXT_DOMAIN); ?>
    </p>
    <p>
        <label>
            <?php esc_html_e('Border Style', WPEX_SIA_TEXT_DOMAIN); ?><br>
            <select name="wpex_sia_border_style">
                <option value="none" <?php selected($border_style, 'none'); ?>><?php esc_html_e('None', WPEX_SIA_TEXT_DOMAIN); ?></option>
                <option value="solid" <?php selected($border_style, 'solid'); ?>><?php esc_html_e('Solid', WPEX_SIA_TEXT_DOMAIN); ?></option>
                <option value="dashed" <?php selected($border_style, 'dashed'); ?>><?php esc_html_e('Dashed', WPEX_SIA_TEXT_DOMAIN); ?></option>
                <option value="dotted" <?php selected($border_style, 'dotted'); ?>><?php esc_html_e('Dotted', WPEX_SIA_TEXT_DOMAIN); ?></option>
                <option value="double" <?php selected($border_style, 'double'); ?>><?php esc_html_e('Double', WPEX_SIA_TEXT_DOMAIN); ?></option>
                <option value="groove" <?php selected($border_style, 'groove'); ?>><?php esc_html_e('Groove', WPEX_SIA_TEXT_DOMAIN); ?></option>
                <option value="ridge" <?php selected($border_style, 'ridge'); ?>><?php esc_html_e('Ridge', WPEX_SIA_TEXT_DOMAIN); ?></option>
            </select>
        </label>
    </p>

<?php
}
