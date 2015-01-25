<?php 
/**
 * Filter CSS Output for image style. 
 */
function mp_stacks_image_styles($css_output, $post_id, $first_content_type, $second_content_type){
	
	if ( $first_content_type != 'image' && $second_content_type != 'image' ){
		return $css_output;	
	}
	
	//Get the radius this image should be
	$brick_main_image_corner_radius = mp_core_get_post_meta( $post_id, 'brick_main_image_corner_radius', 0 );
	$radius_css = 'border-radius: ' . ( $brick_main_image_corner_radius / 2 ) . '%; ';
	
	$shadow_css = mp_core_box_shadow_css( $post_id, 'brick_main_image_', false );
	
	$stroke_css = mp_core_stroke_css( $post_id, 'brick_main_image_' );
	
	//Return new CSS
	return $css_output . '#mp-brick-' . $post_id . ' .mp-brick-main-image{' . $radius_css . $shadow_css . $stroke_css . '}';

}
add_filter('mp_brick_additional_css', 'mp_stacks_image_styles', 10, 4);
