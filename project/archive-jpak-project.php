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
remove_action( 'genesis_loop', 'genesis_do_loop' );
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



//=======================//
//  CUSTOM PROJECT LOOP  //
//=======================//

add_action( 'genesis_before_loop', 'jpak_project_archive_loop' );
function jpak_project_archive_loop() {

    // Get Project IDs
    $projects = jpak_project_query();

    // Loop Projects
    foreach ( $projects as $project ) {

        $project_post = get_post($project);

        echo print_r($project);
        echo '<br><br>';


    } // foreach $projects as $project

} // jpak_project_archive_loop()


//-- LOAD FRAMEWORK --//
genesis();
