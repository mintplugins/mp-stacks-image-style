<?php

/**
 * Add the meta options for the Image Style to the Main Image Metabox
 *
 * @access   public
 * @since    1.0.0
 * @param    Void
 * @param    $post_id Int - The ID of the Brick
 * @return   Array - All of the placement optons needed for Title, Price, and Excerpt
 */
function mp_stacks_image_style_meta_options( $items_array ){		
	
	//Title Settings
	$new_fields = array(
		array( 
			'field_id'			=> 'brick_main_image_style_showhider',
			'field_title' 	=> __( 'Image Styling Settings', 'mp_stacks'),
			'field_description' 	=> '',
			'field_type' 	=> 'showhider',
			'field_value' => '',
		),
			array(
				'field_id'			=> 'brick_main_image_corner_radius',
				'field_title' 	=> __( 'Corner Radius', 'mp_stacks'),
				'field_description' 	=> 'Set the radius of the corners. The higher this value, the more "rounded" the corners of the image will be.',
				'field_type' 	=> 'input_range',
				'field_value' => '0',
				'field_showhider' => 'brick_main_image_style_showhider',
			),
			array(
				'field_id'			=> 'brick_main_image_stroke_showhider',
				'field_title' 	=> __( 'Stroke', 'mp_stacks'),
				'field_description' 	=> 'Set the stroke for this image.',
				'field_type' 	=> 'showhider',
				'field_value' => '0',
				'field_showhider' => 'brick_main_image_style_showhider',
			),
				array(
					'field_id'			=> 'brick_main_image_stroke_size',
					'field_title' 	=> __( 'Stroke Size', 'mp_stacks'),
					'field_description' 	=> 'How large should the stroke be around this image?',
					'field_type' 	=> 'input_range',
					'field_value' => '0',
					'field_showhider' => 'brick_main_image_stroke_showhider',
				),
				array(
					'field_id'			=> 'brick_main_image_stroke_color',
					'field_title' 	=> __( 'Stroke Color', 'mp_stacks'),
					'field_description' 	=> 'What color should the stroke be?',
					'field_type' 	=> 'colorpicker',
					'field_value' => '#fff',
					'field_showhider' => 'brick_main_image_stroke_showhider',
				),
				array(
					'field_id'			=> 'brick_main_image_stroke_opacity',
					'field_title' 	=> __( 'Stroke Opacity', 'mp_stacks'),
					'field_description' 	=> 'What opacity should the stroke be?',
					'field_type' 	=> 'input_range',
					'field_value' => '100',
					'field_showhider' => 'brick_main_image_stroke_showhider',
				),
			
	);
	
	return mp_core_insert_meta_fields( $items_array, $new_fields, 'brick_main_image_lightbox_height' );

}
add_filter( 'mp_stacks_image_items_array', 'mp_stacks_image_style_meta_options', 99 );