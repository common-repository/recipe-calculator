<?php 
/**
 * Recipe Calculator Customizer
 */
function rcal_theme_customizer( $wp_customize ) {
	 //display options
    $wp_customize->add_section( 'load_recipe_calculator_from', array(
        'title'             => 'Recipe Calculator Settings', 'rcal',
        'description'       => 'Display  options for Recipe Calculator', 'rcal' 
    ));
	$wp_customize->add_setting( 'rcal_load_recipe_calculator', array(
        'default'           => 'before_content',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'recipe_calculator_control', array(
        'label'             => 'Display Recipe Calculator', 'rcal',
		'description'       => 'How do you prefer to display Recipe Calculator in your theme? ', 'rcal', 
        'section'           => 'load_recipe_calculator_from',
		'type'			    => 'select',
        'settings'          => 'rcal_load_recipe_calculator',
		'choices'  => array(
			'before_content' => 'Before Content',
		),
    )));
	
	 //include in post type
$wp_customize->add_setting( 'rcal_show_on_post_type', array(
        'default'           => 'post',
        'transport'         => 'postMessage',
    ));
	 
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'recipe_calculator_post_type_control', array(
        'label'             => 'Post type', 'rcal',
		'description'       => 'Post type where Recipe Calculator should be included. Change if you use Custom Post Type for displaying your recipes. For more than 1 values, enter them separated by comma. <strong>e.g. post, recipes</strong>', 'rcal', 
        'section'           => 'load_recipe_calculator_from',
		'type'			    => 'text',
        'settings'          => 'rcal_show_on_post_type',
    )));
	

	//color
	$wp_customize->add_setting( 'rcal_color', array( 
        'transport'         => 'refresh',
		'default'			=> '#ff0000',
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color_red_control', array(
        'label'             => 'Change the Red Color', 'marmalade',
		'description'       => 'Change the color of Portions number and portion control buttons (on hover)', 'rcal', 
        'section'           => 'load_recipe_calculator_from',
        'settings'          => 'rcal_color',
    )));
	
  //measurement units
	$wp_customize->add_setting( 'unlock_recipe_calculator', array(
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'unlock_recipe_calculator_plugin', array(
        //'label'             => '', 'rcal',
		'description'       => 'Unlock the full potential of Recipe Calculator. <br /><a class="order-link" href="https://codecanyon.net/item/recipe-calculator/19190205?ref=helloirena_com" target"_blank" rel="noopener noreferrer">Get the full version</a> <br /><u>With the full version you get:</u> <br /> - up to 7 times lighter plugin; <br /> - you can include it after the content, via a shortcode or to specify manually where you want it to be included in your theme; <br /> - you can choose between metric and english measurement units; <br /> - ability to separate the ingredients for different parts of the recipe (sauce, dough, etc.); <br /> - the plugin is avaliable in more languages (Dutch, Bulgarian, German, Spanish, Russian); <br /> - you can add instructions for each recipe and <a href="http://helloirena.com/documentation/recipe-calculator-documentation/" target"_blank" rel="noopener noreferrer">more</a>.', 'rcal', 
        'section'           => 'load_recipe_calculator_from',
		'type'			    => 'hidden',
        'settings'          => 'unlock_recipe_calculator',
    )));

}
add_action( 'customize_register', 'rcal_theme_customizer' );


 /**
 * Display Recipe Calculator options
 *
 */
// Switch to selected in Customizer Display
if('before_content' === get_theme_mod('rcal_load_recipe_calculator')){ 
//Include Recipe Calculator Before the_content  
add_filter( 'the_content', 'rcal_show_recipe_calculator');
function rcal_show_recipe_calculator($content) {
	$rcal_include = get_theme_mod('rcal_show_on_post_type', 'post');  
	$rcal_post = comma_separated_to_array($rcal_include); 
if ( is_singular($rcal_post) && in_the_loop() ) {	
$recipe_calculator = recipe_calculator();  
if ($recipe_calculator){ 
  $content = $recipe_calculator . $content;
} 
		return $content;
	 
} else {
	
	return $content;
}
}

 } else {
//Include Recipe Calculator Before the_content  
add_filter( 'the_content', 'rcal_show_recipe_calculator');
function rcal_show_recipe_calculator($content) {
	$rcal_include = get_theme_mod('rcal_show_on_post_type', 'post');  
	$rcal_post = comma_separated_to_array($rcal_include); 
if ( is_singular($rcal_post) && in_the_loop() ) {	
$recipe_calculator = recipe_calculator();  
if ($recipe_calculator){ 
  $content = $recipe_calculator . $content;
} 
		return $content;
	 
} else {
	
	return $content;
}
}
	 
 }