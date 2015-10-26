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
    $full_image =       $project_meta['full_image'];
    $desktop_preview =  $project_meta['desktop_preview'];
    $mobile_preview =   $project_meta['mobile_preview'];


    // project-background-previews Inline Styling
    $background_previews_style = ''; //'background-color: ' . $color . ';';


    // Background & Previews
    echo '<div class="project-background-previews" style="' . $background_previews_style . '">';

        // If There's a Full Image
        if ( $full_image ) {
            echo '<img class="project-full-image" src="' . $full_image . '" alt="Project Image">';
        }

        // If There's a Desktop Preview
        if ( $desktop_preview ) {
            echo jpak_project_browser_mockup( $desktop_preview );
        }

        // If There's a Mobile Preview
        if ( $mobile_preview ) {
            echo jpak_project_browser_mockup( $mobile_preview, 'mobile', 'right', false );
        }

    echo '</div>'; // .project-background-previews

} // jpak_project_single_background_previews()



add_filter( 'body_class', 'jpak_project_single_body_classes' );
/**
 * JordanPak Functionality - Browser Mockup
 *
 * Outputs a preview image inside a "Browser Mockup" frame.
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 *
 * @param string $src Image SRC Attribute
 * @param string $size Size of mockup (desktop, mobile)
 * @param string $position Position of Mockup (left, right)
 * @param bool $with_tab Include tab in frame
 * @return string $browser_mockup HTML markup of Browser Mockup
 */
function jpak_project_browser_mockup( $src, $size = 'desktop', $position = 'left', $with_tab = true ) {

    //-- HTML STRING --//
    $browser_mockup = '';


    //-- WRAPPER CLASSES --//
    $mockup_classes = 'browser-mockup';             // Default
    $mockup_classes .= ' size-' . $size;            // Size
    $mockup_classes .= ' position-' . $position;    // Position

    if ( $with_tab ) {
        $mockup_classes .= ' with-tab';
    }


    //-- MARKUP --//
    $browser_mockup .= '<div class="' . $mockup_classes . '">';
        $browser_mockup .= '<img src="' . $src . '">';
    $browser_mockup .= '</div>'; // .browser-mockup


    return $browser_mockup;

} // jpak_project_browser_mockup()



remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_header', 'jpak_project_header' );
/**
 * JordanPak Functionality - Project Title
 *
 * Output Project Label, Title, and Button.
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */
function jpak_project_header() {

    // Project Meta
    $project_meta = $GLOBALS['jpak_project_meta'];
    $visit_website = $project_meta['live_url'];


    // Label
    echo '<p class="project-header-label"><i class="fa fa-pencil"></i>&nbsp; Project</p>';

    // Project Title
    echo '<h1 class="entry-title" itemprop="headline">' . get_the_title() . '</h1>';

    // Visit Website Button
    if ( $visit_website ) {
        echo '<a class="project-visit-website button button-outline" href="' . $visit_website . '" title="View Live Project" target="_BLANK">Visit Website</a>';
    }

} // jpak_project_header()



add_action( 'genesis_entry_content', 'jpak_project_entry_content');
/**
 * JordanPak Functionality - Project Content
 *
 * Output Project Content & Other Meta
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */
function jpak_project_entry_content() {

    // Project Meta
    $project_meta =             $GLOBALS['jpak_project_meta'];
    $features =                 $project_meta['features'];
    $testimonial =              $project_meta['testimonial'];
    $testimonial_name =         $project_meta['testimonial_name'];
    $testimonial_occupation =   $project_meta['testimonial_occupation'];


    //-- DESCRIPTION --//
    echo '<div class="project-description">';
        echo the_content();
    echo '</div>';


    //-- FEATURES --//
    if ( $features ) {

        echo '<div class="project-features">';

            // echo '<h3>Features</h3>';

            echo '<ul class="features">';

                foreach ( $features as $feature ) {
                    echo '<li>' . $feature . '</li>';
                }

            echo '</ul>';

        echo '</div>'; // .one-third

    } // if $features


    // clearfix
    echo '<div class="clearfix"></div>';


    //-- PROJECTS & CONTACT BUTTONS --//
    echo '<div class="project-buttons">';

        // Back to Projects
        echo '<a class="button button-dark" href="' . site_url() .'/projects"><i class="fa fa-arrow-left"></i>Back to Projects</a>';

        // OR
        echo '<span>or</span>';

        // Contact
        echo '<a class="button" href="' . site_url() . '/contact"><i class="fa fa-pencil"></i>Get Your Project Started</a>';

    echo '</div>'; // .project-buttons


    //-- TESTIMONIAL --//
    if ( $testimonial ) {

        echo '<div class="project-testimonial">';

            echo '<blockquote>';

                // Testimonial Body
                echo $testimonial;

                // Name
                echo '<cite>' . $testimonial_name . '</cite>';

                // Occupation
                if ( $testimonial_occupation ) {
                    echo '<span>' . $testimonial_occupation . '</span>';
                }

            echo '</blockquote>';

        echo '</div>'; // .project-testimonial

    } // if $testiominal


} // jpak_project_entry_content()



//-- LOAD FRAMEWORK --//
genesis();
