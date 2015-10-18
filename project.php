<?php
/**
 * JordanPak Functionality - Project CPT
 *
 * Project CPT Functions
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */


 //================//
 //  REGISTER CPT  //
 //================//

 if ( ! function_exists('jpak_project') ) {

     // Register Custom Post Type
     function jpak_project() {

     	$labels = array(
     		'name'                => _x( 'Projects', 'Post Type General Name', 'text_domain' ),
     		'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'text_domain' ),
     		'menu_name'           => __( 'Projects', 'text_domain' ),
     		'name_admin_bar'      => __( 'Project', 'text_domain' ),
     		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
     		'all_items'           => __( 'All Projects', 'text_domain' ),
     		'add_new_item'        => __( 'Add New Project', 'text_domain' ),
     		'add_new'             => __( 'Add New', 'text_domain' ),
     		'new_item'            => __( 'New Project', 'text_domain' ),
     		'edit_item'           => __( 'Edit Project', 'text_domain' ),
     		'update_item'         => __( 'Update Project', 'text_domain' ),
     		'view_item'           => __( 'View Project', 'text_domain' ),
     		'search_items'        => __( 'Search Projects', 'text_domain' ),
     		'not_found'           => __( 'Not found', 'text_domain' ),
     		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
     	);
     	$args = array(
     		'label'               => __( 'Project', 'text_domain' ),
     		'description'         => __( 'Project with Description, Featured Images/Screenshots, Testimonial, and Feature List', 'text_domain' ),
     		'labels'              => $labels,
     		'supports'            => array( 'title', 'editor', 'thumbnail', ),
     		'taxonomies'          => array( 'category' ),
     		'hierarchical'        => false,
     		'public'              => true,
     		'show_ui'             => true,
     		'show_in_menu'        => true,
     		'menu_position'       => 5,
     		'menu_icon'           => 'dashicons-hammer',
     		'show_in_admin_bar'   => true,
     		'show_in_nav_menus'   => true,
     		'can_export'          => true,
     		'has_archive'         => true,
     		'exclude_from_search' => false,
     		'publicly_queryable'  => true,
     		'capability_type'     => 'page',
     	);
     	register_post_type( 'jpak_project', $args );

    } // jpak_project()

    // Add the CPT to init
    add_action( 'init', 'jpak_project', 0 );

} // if jpak_project()



//=======================//
//  REGISTER META BOXES  //
//=======================//

add_action( 'cmb2_admin_init', 'jpak_project_metaboxes' );
function jpak_project_metaboxes() {

    $prefix = '_jpak_project_';

    // Project Details Box
    $cmb = new_cmb2_box( array(
        'id'            => 'project_details',
        'title'         => __( 'Project Details', 'cmb2' ),
        'object_types'  => array( 'jpak_project', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

    // Color Picker
    $cmb->add_field( array(
        'name'    => 'Project Color',
        'id'      => $prefix . 'color',
        'type'    => 'colorpicker',
        'default' => '#ffffff',
    ) );

    // Features
    $cmb->add_field( array(
        'name'       => __( 'Features', 'cmb2' ),
        'id'         => $prefix . 'features',
        'type'       => 'text',
        'repeatable' => true,
    ) );

    // Live URL
    $cmb->add_field( array(
        'name' => __( 'Live Site URL', 'cmb2' ),
        'desc' => __( 'For button if project type is "Website"', 'cmb2' ),
        'id'   => $prefix . 'live_url',
        'type' => 'text_url',
        'protocols' => array( 'http', 'https' ), // Array of allowed protocols
    ) );

} // jpak_project_metaboxes()
