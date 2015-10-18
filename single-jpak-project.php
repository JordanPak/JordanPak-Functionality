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
  * JordanPak Functionality - Full Width Content
  *
  * Adds "full-width-content" body class to page
  *
  * @package JordanPak-Functionality
  * @since 1.0.0
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

$project_meta;
$project_meta = jpak_project_get_meta( $post->ID );



//====================//
//  PROJECT ELEMENTS  //
//====================//



//-- LOAD FRAMEWORK --//
genesis();
