<?php 
/**
 *  Recipe Calculator Metaboxes
 */
 defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
 
if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
  require_once  __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once  __DIR__ . '/CMB2/init.php';
}
 
//Recipe Calculator Ingredients
add_action( 'cmb2_admin_init', 'rcal_register_ingredients_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function rcal_register_ingredients_metaboxes() {
    $prefix = 'ingredients_';
	
	$rcal_include = get_theme_mod('rcal_show_on_post_type', 'post');  
	$rcal_post = comma_separated_to_array($rcal_include);
    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'ingredients_metabox',
        'title'         => __( 'Ingredients', 'rcal' ),
        'object_types'  => $rcal_post, // Post type
        'context'       => 'normal',
        'show_names'    => true, // Show field names on the left   
    ) );

    // Portions Number field
    $cmb->add_field( array(
        'name'       => __( 'Portions number', 'rcal' ),  
        'id'         => $prefix . 'portions',
		'desc'		 =>  __('portions', 'rcal' ),
        'type'       => 'text_small',
    ) );

   $ingredients_field_id = $cmb->add_field( array(
    'id'          => 'ingredients_group',
    'type'        => 'group', 
    'options'     => array(
        'group_title'   => __( 'Ingredient {#}', 'rcal' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'    => __( 'Add Another Ingredient', 'rcal' ),
        'remove_button' => __( 'Remove', 'rcal' ),
        'sortable'      => true, // beta 
    ),
) );

$cmb->add_group_field( $ingredients_field_id, array(
	'name' =>  __('Quantity', 'rcal'),
    'id'   => $prefix . 'quantity',
	'desc'		 => __('<strong>For non-integers</strong> enter dot(.) separated values - e.g. 1.5', 'rcal'),
    'type' => 'text_small',
) );

//Measurement units
$cmb->add_group_field( $ingredients_field_id, array(
    'name' => __('Measurement Unit', 'rcal'),
    'id'   => $prefix . 'unit',
    'type'             => 'select',
    'show_option_none' => __('Select', 'rcal'), 
    'options'          => array(
        'none' => __( 'none', 'rcal' ),
        'kg' => __( 'kg', 'rcal' ),
        'g' => __( 'g', 'rcal' ),
        'L' => __( 'L', 'rcal' ),
        'ml' => __( 'ml', 'rcal' ),
        'tsp' => __( 'tsp', 'rcal' ),
        'tbsp' => __( 'tbsp', 'rcal' ),
        'cup' => __( 'cup', 'rcal' ),
        'cups' => __( 'cups', 'rcal' ),
),
));

$cmb->add_group_field( $ingredients_field_id, array(
    'name' => __('Ingredient name', 'rcal'),
    'id'   => $prefix . 'ingredient',
    'type' => 'text',
) );
	
$cmb->add_group_field( $ingredients_field_id, array(
    'name' => __('Ingredient Plural name', 'rcal'),
    'id'   => $prefix . 'ingredient_plural',
    'type' => 'text', 
	'desc'		 => __('Fill only if Measurement Unit = None', 'rcal'),
));

}
 