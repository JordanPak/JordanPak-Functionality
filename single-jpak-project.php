<?php
/**
 * JordanPak Functionality - Project CPT Template - Single
 *
 * Single Template for Project CPT
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */


//===========================//
//  CONFIGURE PAGE ELEMENTS  //
//===========================//


 //-- REMOVE DEFAULT ELEMENTS --//
 remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
 remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
 remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
 remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
 remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


//-- ADD BODY CLASSES --//
 add_filter( 'body_class', 'jpak_project_single_body_classes' );
 /**
  * JordanPak Functionality - Project Single Body Classes
  *
  * Adds "full-width-content", "page", and "no-mini-hero" body classes to page
  *
  * @package JordanPak-Functionality
  * @since 1.0.0
  *
  * @param string $classes Array of body classes
  * @return string $classes Array of body classes
  */
 function jpak_project_single_body_classes( $classes ) {

     $classes[] = 'full-width-content';
     $classes[] = 'page';
     $classes[] = 'no-mini-hero';

     return $classes;

 } // jpak_project_single_body_classes


//-- REMOVE MINI-HERO --//
remove_action( 'genesis_after_header', 'jpak_mini_hero' );



//====================//
//  GET PROJECT META  //
//====================//

global $jpak_project_meta;
$jpak_project_meta = jpak_project_get_meta( $post->ID );



//====================//
//  PROJECT ELEMENTS  //
//====================//

add_action( 'genesis_after_header', 'jpak_project_single_background_previews' );
/**
 * JordanPak Functionality - Project Single Background & Previews
 *
 * Configures top part of page with color theme and desktop/mobile preview images.
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */
function jpak_project_single_background_previews() {

    // Get Project Meta
    $project_meta = $GLOBALS['jpak_project_meta'];

    // Prep Needed Vars
    $color = $project_meta['color'];


    // project-background-previews Inline Styling
    $background_previews_style = 'background-color: #8CC63F'; //'background-color: ' . $color . ';';


    // Background & Previews
    echo '<div class="project-background-previews" style="' . $background_previews_style . '">';

        // Wrap for Images
        // echo '<div class="wrap">';


            echo '<div class="browser-mockup with-tab position-left">
  <img src="http://placehold.it/1100x700/fff/eee" />
</div>';

            echo '<div class="browser-mockup with-tab position-right">
  <img src="http://placehold.it/400x650/fff/eee" />
</div>';


        // echo '</div>'; // .wrap (for images)

    echo '</div>'; // .project-background-previews

} // jpak_project_single_background_previews()


//-- LOAD FRAMEWORK --//
genesis();
