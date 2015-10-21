<?php
/**
 * JordanPak Functionality - Project CPT
 *
 * Project CPT Functions
 *
 * @package JordanPak-Functionality
 * @since 1.0.0
 */


//====================//
//  PROJECT INCLUDES  //
//====================//

require_once( 'project-type.php' );



 //================//
 //  REGISTER CPT  //
 //================//

if ( ! function_exists('jpak_project') ) {

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
    	$rewrite = array(
    		'slug'                => 'projects',
    		'with_front'          => true,
    		'pages'               => true,
    		'feeds'               => true,
    	);
    	$args = array(
    		'label'               => __( 'Project', 'text_domain' ),
    		'description'         => __( 'Project with Description, Featured Images/Screenshots, Testimonial, and Feature List', 'text_domain' ),
    		'labels'              => $labels,
    		'supports'            => array( 'title', 'editor', 'thumbnail', ),
    		'taxonomies'          => array( 'jpak_project_type' ),
    		'hierarchical'        => false,
    		'public'              => true,
    		'show_ui'             => true,
    		'show_in_menu'        => true,
    		'menu_position'       => 5,
    		'menu_icon'           => 'dashicons-hammer',
    		'show_in_admin_bar'   => true,
    		'show_in_nav_menus'   => true,
    		'can_export'          => true,
    		'has_archive'         => 'projects',
    		'exclude_from_search' => false,
    		'publicly_queryable'  => true,
    		'rewrite'             => $rewrite,
    		'capability_type'     => 'page',
    	);
    	register_post_type( 'jpak_project', $args );

    }
    add_action( 'init', 'jpak_project', 0 );

} // if jpak_project() exists



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
        'name'      => 'Project Color',
        'desc'      => __( 'Used in page background and button accent.', 'cmb2' ),
        'id'        => $prefix . 'color',
        'type'      => 'colorpicker',
        'default'   => '#ffffff',
    ) );

    // Desktop Preview
    $cmb->add_field( array(
        'name'    => 'Desktop Preview Image',
        'desc'    => 'Recommended Size: 1100px x 700px.',
        'id'      => $prefix . 'desktop_preview',
        'type'    => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
            'add_upload_file_text' => 'Upload Image',
        ),
    ) );

    // Mobile Preview
    $cmb->add_field( array(
        'name'    => 'Mobile Preview Image',
        'desc'    => 'Recommended Size: 400px x 650px.',
        'id'      => $prefix . 'mobile_preview',
        'type'    => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
            'add_upload_file_text' => 'Upload Image',
        ),
    ) );

    // Features
    $cmb->add_field( array(
        'name'      => __( 'Features', 'cmb2' ),
        'id'        => $prefix . 'features',
        'type'      => 'text',
        'repeatable' => true,
    ) );

    // Live URL
    $cmb->add_field( array(
        'name'      => __( 'Live Site URL', 'cmb2' ),
        'desc'      => __( 'For button if project type is "Website".', 'cmb2' ),
        'id'        => $prefix . 'live_url',
        'type'      => 'text_url',
        'protocols' => array( 'http', 'https' ), // Array of allowed protocols
    ) );

    // Testimonial
    $cmb->add_field( array(
        'name' => 'Testimonial',
        'desc' => 'Do not add quotation marks.',
        'id' => $prefix . 'testimonial',
        'type' => 'textarea_small'
    ) );

    // Testimonial Name
    $cmb->add_field( array(
        'name' => 'Testimonial Name',
        'desc' => 'Ex: "Jimbo Fisher"',
        'id' => $prefix . 'testimonial_name',
        'type' => 'text'
    ) );

    // Testimonial Occupation
    $cmb->add_field( array(
        'name' => 'Testimonial Occupation',
        'desc' => 'Ex: "Head Football Coach, USF"',
        'id' => $prefix . 'testimonial_occupation',
        'type' => 'text'
    ) );

} // jpak_project_metaboxes()



//====================//
//  HELPER FUNCTIONS  //
//====================//


/**
 * Project CPT Query
 *
 * Get Project CPT IDs
 *
 * @since 1.0.0
 *
 * @see jpak_project
 *
 * @param int $num Number of Project Post IDs to Return (0 = All).
 * @param int $num_per_page Number of results per page.
 * @return array $project_ids Project Post IDs.
 */
 function jpak_project_query( $num = 0, $num_per_page = 12 ) {

     // Query Options
     $project_args = array(
         'post_type'        => 'jpak_project',
         'fields'           => 'ids',
        //  'orderby'          => 'meta_value_num',
        //  'order'            => 'DSC',
         'post_count'       => 10,
        //  'posts_per_page'   => $num_per_page,
     );

     // Query
     return new WP_Query( $project_args );

 } // jpak_project_query()


/**
 * Get Project Meta
 *
 * Get Project Post Meta Array
 *
 * @since 1.0.0
 *
 * @see jpak_project
 *
 * @param string $project Project post ID.
 * @param bool $is_archive Whether or not meta needed is for archive template.
 * @return array $project_meta Project post meta.
 */
function jpak_project_get_meta( $project, $is_archive = false ) {

    $project_meta = array();

    // Set Meta ID
    $meta_id_prefix = '_jpak_project_';


    // SINGLE META //
    if ( $is_archive == false ) {

        $project_meta['color']                  = get_post_meta( $project, $meta_id_prefix . 'color', true );
        $project_meta['desktop_preview']        = get_post_meta( $project, $meta_id_prefix . 'desktop_preview', true );
        $project_meta['mobile_preview']         = get_post_meta( $project, $meta_id_prefix . 'mobile_preview', true );
        $project_meta['features']               = get_post_meta( $project, $meta_id_prefix . 'features', true );
        $project_meta['live_url']               = get_post_meta( $project, $meta_id_prefix . 'live_url', true );
        $project_meta['testimonial']            = get_post_meta( $project, $meta_id_prefix . 'testimonial', true );
        $project_meta['testimonial_name']       = get_post_meta( $project, $meta_id_prefix . 'testimonial_name', true );
        $project_meta['testimonial_occupation'] = get_post_meta( $project, $meta_id_prefix . 'testimonial_occupation', true );

    } // If $is_archive == false

    return $project_meta;

} // jpak_project_get_meta()



add_action( 'init', 'jpak_project_image_sizes' );
/**
 * Project Image Sizes
 *
 * Image Sizes for Grid thumbnails and other stuff.
 *
 * @since 1.0.0
 *
 * @see jpak_project
 */
function jpak_project_image_sizes() {
    add_image_size('project-grid-thumbnail', 600, 380, TRUE);
} // jpak_project_image_sizes()



/**
 * Get Project Archive Template
 *
 * Loads the archive-jpak-project template as needed.
 *
 * @since 1.0.0
 *
 * @see jpak_project
 *
 * @param string $archive_template Path to template file.
 * @return string $archive_template Path to template file.
 */
function jpak_get_project_archive_template( $archive_template ) {

     global $post;

     if ( $post->post_type == 'jpak_project' ) {
          $archive_template = dirname( __FILE__ ) . '/archive-jpak-project.php';
     }

     return $archive_template;

} // jpak_get_project_archive_template()
add_filter( 'archive_template', 'jpak_get_project_archive_template' );



/**
 * Get Project Single Template
 *
 * Loads the single-jpak-project template as needed.
 *
 * @since 1.0.0
 *
 * @see jpak_project
 *
 * @param string $single_template Path to template file.
 * @return string $single_template Path to template file.
 */
function jpak_get_project_single_template( $single_template ) {

     global $post;

     if ( $post->post_type == 'jpak_project' ) {
          $single_template = dirname( __FILE__ ) . '/single-jpak-project.php';
     }

     return $single_template;

} // jpak_get_project_single_template()
add_filter( 'single_template', 'jpak_get_project_single_template' );
