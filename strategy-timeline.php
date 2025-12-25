<?php
/**
 * Plugin Name: Strategy Timeline
 * Description: Custom post type for Strategy Timeline with ACF-powered steps.
 * Version: 1.0.0
 *  Author: Roly Estemonio
 */

if (!defined('ABSPATH')) exit;

define('ST_PATH', plugin_dir_path(__FILE__));
define('ST_URL', plugin_dir_url(__FILE__));

/* Register CPT */
add_action('init', function () {

    register_post_type('strategy_timeline', [
            'labels' => [
                    'name' => 'Strategy Timelines',
                    'singular_name' => 'Strategy Timeline',
            ],
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-editor-ol',
            'supports' => ['title'],
    ]);
});

/* Load ACF fields */
require_once ST_PATH . 'acf/fields.php';

/* Enqueue assets */
add_action('wp_enqueue_scripts', function () {

    wp_enqueue_style(
            'strategy-timeline',
            ST_URL . 'assets/css/strategy-timeline.css',
            [],
            '1.0'
    );

    wp_enqueue_script(
            'strategy-timeline',
            ST_URL . 'assets/js/strategy-timeline.js',
            ['jquery'],
            '1.0',
            true
    );
});

/* Shortcode */
add_shortcode('strategy_timeline', function ($atts) {

    $atts = shortcode_atts([
            'id' => null,
    ], $atts);

    if (!$atts['id'] || !function_exists('have_rows')) return '';

    $post_id = (int) $atts['id'];

    ob_start();
    ?>

    <div class="strategy-wrapper">

        <div class="strategy-left">
            <h2>
                <?php echo esc_html(get_field('heading', $post_id)); ?><br>
                <span><?php echo esc_html(get_field('subheading', $post_id)); ?></span>
            </h2>

            <ul class="strategy-steps">
                <?php while (have_rows('steps', $post_id)) : the_row(); ?>
                    <li data-target="<?php echo esc_attr(get_sub_field('slug')); ?>">
                        <span class="step-label"><?php the_sub_field('label'); ?></span>
                        <div class="mobile-content"></div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <div class="strategy-right is-hidden">
            <?php while (have_rows('steps', $post_id)) : the_row(); ?>
                <div class="strategy-content" id="<?php echo esc_attr(get_sub_field('slug')); ?>">
                    <?php the_sub_field('content'); ?>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

    <?php
    return ob_get_clean();
});
