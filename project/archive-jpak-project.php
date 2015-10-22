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

    // Project Grid Wrapper
    echo '<div class="project-grid clearfix">';

        //-- GET PROJECTS --//
        $projects = jpak_project_query();


        //-- PROJECT LOOP --//
        $count = 0;

        // CYCLE PROJECTS
        foreach ( $projects as $project ) {

            // Post Data
            $project_post =         get_post( $project );
            $project_thumbnail =    get_post_thumbnail_id( $project );                                              // Get ID of Thumb
            $project_thumbnail =    wp_get_attachment_image_src( $project_thumbnail, 'project-grid-thumbnail' );    // Get Stuff from ID
            $project_thumbnail =    $project_thumbnail[0];                                                          // Get URL from Stuff

            // Wrapper Classes
            $wrapper_classes = 'entry project-grid-entry one-half';    // Defaults
            if ( $count % 2 == 0 ) {                // Check for First
                $wrapper_classes .= ' first';
            }

            // Wrapper Background
            if ( $project_thumbnail ) {
                $background_gradient = 'linear-gradient( rgba(0,0,0,0) 55%, rgba(0,0,0,0.9) )';
                $wrapper_background = 'style="background: ' . $background_gradient . ', url(\'' . $project_thumbnail . '\');" ';
            }

            // Start Link to Project
            echo '<a href="' . get_permalink( $project ) . '">';

                // START WRAPPER
                echo '<div class="' . $wrapper_classes . '" ' . $wrapper_background . '>';


                    // Project Title
                    echo '<h2 class="entry-title" itemprop="headline">' . $project_post->post_title . '</h2>';


                echo '</div>'; // Close Project Wrapper

            echo '</a>'; // Project Link

            $count++;

        } // foreach $projects as $project


    echo '</div>'; // .project-grid

} // jpak_project_archive_loop()


//-- LOAD FRAMEWORK --//
genesis();
