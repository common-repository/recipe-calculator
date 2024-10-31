<?php 
/**
 *  Recipe Calculator Functions
 */
 defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * This function adds some styles to the WordPress Customizer
 */
function rcal_customizer_styles() { ?>
	<style>
	#customize-control-unlock_recipe_calculator_plugin {
		border-top: 1px solid #b7b7b7;
		padding-top: 7px;
	}	
	#customize-control-unlock_recipe_calculator_plugin span {
		padding: 0 5px 5px;
		font-style: normal;
		color: #000 !important;
	}
	#customize-control-unlock_recipe_calculator_plugin a.order-link {
		color: #ffffff;
		background-color: #FF9800;
		border-radius: 3px;
		padding: 5px 5px;
		text-align: center;
		display: block;
		font-style: normal;
		font-size: 14px;
		margin: 10px 25px 0 25px;
	}
	</style>
	<?php

}
add_action( 'customize_controls_print_styles', 'rcal_customizer_styles', 999 );

 //Include admin styles and scripts
function rcal_load_admin_styles_and_scripts() { 
		wp_register_style( 'rcal_admin_style', plugins_url( 'admin/css/admin-styles.min.css', dirname(__FILE__) ));
		wp_enqueue_style( 'rcal_admin_style' );
		
		wp_enqueue_script( 'rcal_admin_js', plugins_url( 'admin/js/admin.min.js', dirname(__FILE__) ));
}
add_action( 'admin_enqueue_scripts', 'rcal_load_admin_styles_and_scripts' );

//Include public styles and scripts
function rcal_load_styles_and_scripts() {  
			wp_register_style( 'rcal_css', plugins_url( 'public/css/rcal.min.css', dirname(__FILE__) ));
			wp_enqueue_style( 'rcal_css' ); 
		  
			wp_register_script( 'rcal-js', plugins_url('public/js/rcal.min.js', dirname(__FILE__)), array( 'jquery' ), null, true );
			wp_enqueue_script( 'rcal-js' );
			wp_localize_script( 'rcal-js', 'rcal_js', array( 'ajaxurl' => admin_url('admin-ajax.php')) );
			
}
add_action( 'wp_enqueue_scripts', 'rcal_load_styles_and_scripts' );

include( plugin_dir_path( __FILE__ ) . 'customizer.php');

//load Google font - Roboto
add_action('wp_footer', 'rcal_load_roboto', 100);
function rcal_load_roboto() {
?>
	<script type="text/javascript">
	 WebFontConfig={google:{families:["Roboto:300,400,900"]}};(function(){var a=document.createElement("script");a.src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";a.type="text/javascript";a.async="true";var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})();
	</script>
<?php
}


// Include Ionicons icon styling if Yes is selected in Customizer
add_action( 'wp_head', 'rcal_fonts_css'); 
function rcal_fonts_css() {
	?> 
	<style>
	.ingredients,.instructions,.portions-num{font-family:Roboto,sans-serif}.ingredients h2,.instructions h2{font-family:'Roboto Black',sans-serif}.ingredients li.checked-ingredients:before{content:"\f3fd";color:#000;background-color:transparent;font-family:Ionicons;font-size:25px;font-weight:700;height:22px;position:absolute;margin-left:-20px;margin-top:8px;background-size:30px}.control-ingredients button{border:0}.control-ingredients{margin-top:-10px}
	</style>
	<?php
}


//Change default main colors with Customizer
add_action( 'wp_head', 'rcal_customize_css');
function rcal_customize_css() {
?>
	<style>
	.portions-num, .control-ingredients button:hover, .control-ingredients button:focus, .control-ingredients button:hover {
		color: <?php echo get_theme_mod('rcal_color', '#ff0000'); ?>;
	} 
	</style>
    <?php
}

//post types from Customizer to array
function comma_separated_to_array($string, $separator = ',')
{
  //Explode on comma
  $vals = explode($separator, $string);
 
  //Trim whitespace
  foreach($vals as $key => $val) {
    $vals[$key] = trim($val);
  }
  //Return empty array if no items found
  //http://php.net/manual/en/function.explode.php#114273
  return array_diff($vals, array(""));
}
