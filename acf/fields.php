<?php
if (!defined('ABSPATH')) exit;

add_action('acf/init', function () {

    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key' => 'group_strategy_timeline',
        'title' => 'Strategy Timeline',
        'fields' => [

            [
                'key' => 'field_heading',
                'label' => 'Heading',
                'name' => 'heading',
                'type' => 'text',
                'default_value' => 'Our Methodology',
            ],
            [
                'key' => 'field_subheading',
                'label' => 'Subheading',
                'name' => 'subheading',
                'type' => 'text',
                'default_value' => 'About Strategy-First',
            ],
            [
                'key' => 'field_steps',
                'label' => 'Steps',
                'name' => 'steps',
                'type' => 'repeater',
                'button_label' => 'Add Step',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_step_label',
                        'label' => 'Step Label',
                        'name' => 'label',
                        'type' => 'text',
                        'wrapper' => [
                            'width' => '100',
                        ],
                    ],
                    [
                        'key' => 'field_step_slug',
                        'label' => 'Step Slug',
                        'name' => 'slug',
                        'type' => 'text',
                        'instructions' => 'Unique ID (e.g. discovery)',
                        'wrapper' => [
                            'width' => '100',
                        ],
                    ],
                    [
                        'key' => 'field_step_content',
                        'label' => 'Step Content',
                        'name' => 'content',
                        'type' => 'wysiwyg',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => true,
                        'wrapper' => [
                            'width' => '100',
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'strategy_timeline',
                ],
            ],
        ],
    ]);
});
