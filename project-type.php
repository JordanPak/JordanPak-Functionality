<?php
/**
 * JordanPak Functionality - Project Type Taxonomy
 *
 * Project Type Taxonomy for Project CPT
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */


 //=====================//
 //  REGISTER TAXONOMY  //
 //=====================//

 if ( ! function_exists( 'jpak_project_type' ) ) {

    // Register Custom Taxonomy
    function jpak_project_type() {

    	$labels = array(
    		'name'                       => _x( 'Project Types', 'Taxonomy General Name', 'text_domain' ),
    		'singular_name'              => _x( 'Project Type', 'Taxonomy Singular Name', 'text_domain' ),
    		'menu_name'                  => __( 'Project Types', 'text_domain' ),
    		'all_items'                  => __( 'All Project Types', 'text_domain' ),
    		'parent_item'                => __( 'Parent Project Type', 'text_domain' ),
    		'parent_item_colon'          => __( 'Parent Project Type:', 'text_domain' ),
    		'new_item_name'              => __( 'New Project Type Name', 'text_domain' ),
    		'add_new_item'               => __( 'Add New Project Type', 'text_domain' ),
    		'edit_item'                  => __( 'Edit Project Type', 'text_domain' ),
    		'update_item'                => __( 'Update Project Type', 'text_domain' ),
    		'view_item'                  => __( 'View Project Type', 'text_domain' ),
    		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    		'add_or_remove_items'        => __( 'Add or Remove Project Types', 'text_domain' ),
    		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    		'popular_items'              => __( 'Popular Project Types', 'text_domain' ),
    		'search_items'               => __( 'Search Project Types', 'text_domain' ),
    		'not_found'                  => __( 'Not Found', 'text_domain' ),
    	);
    	$args = array(
    		'labels'                     => $labels,
    		'hierarchical'               => false,
    		'public'                     => true,
    		'show_ui'                    => true,
    		'show_admin_column'          => true,
    		'show_in_nav_menus'          => true,
    		'show_tagcloud'              => true,
    	);
    	register_taxonomy( 'jpak_project_type', array( 'jpak_project' ), $args );

    }
    
    add_action( 'init', 'jpak_project_type', 0 );

} // if jpak_project_type exists
