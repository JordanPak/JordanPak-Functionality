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
 remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
 remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
 remove_action( 'genesis_entry_footer', 'genesis_post_meta' );



//-- LOAD FRAMEWORK --//
genesis();
