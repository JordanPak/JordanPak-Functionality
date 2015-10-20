<?php
/**
 * JordanPak Functionality - Project CPT Template - Archive
 *
 * Archive Template for Project CPT
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */



//===========================//
//  CONFIGURE PAGE ELEMENTS  //
//===========================//


//-- REMOVE DEFAULT ELEMENTS --//
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
// remove_action( 'genesis_loop', 'genesis_do_loop' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


//-- ADD BODY CLASSES --//
add_filter( 'body_class', 'jpak_project_archive_body_classes' );
/**
* JordanPak Functionality - Project Archive Body Classes
*
* @package JordanPak-Functionality
* @since 1.0.0
*
* @param string $classes Array of body classes
* @return string $classes Array of body classes
*/
function jpak_project_archive_body_classes( $classes ) {

    $classes[] = 'full-width-content';

    return $classes;

} // jpak_project_archive_body_classes



function be_archive_post_class( $classes ) {
	global $wp_query;
	if( ! $wp_query->is_main_query() )
		return $classes;

	$classes[] = 'one-half';
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 2 )
		$classes[] = 'first';
	return $classes;
}
add_filter( 'post_class', 'be_archive_post_class' );



//-- LOAD FRAMEWORK --//
genesis();
