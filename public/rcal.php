<?php
/**
 *  Recipe Calculator Front-end
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

 function recipe_calculator() {
echo '<!-- Recipe Calculator plugin -->'; 
 echo '<div class="rcal-wrap">'; 
//Recipe Ingredients
	$portions = esc_html( get_post_meta( get_the_ID(), 'ingredients_portions', true)); 
		if(!empty($portions)){
		 echo '<div class="ingredients">'; 
		
		echo '<h2>'; _e('Ingredients for', 'rcal'); echo '<span itemprop="recipeYield" class="p-yield portions-num">'; echo $portions; echo '</span>'; echo '<span class="portions-text">';  _e('portions', 'rcal'); echo '</span>'; echo '<span class="portions-text-single">';  _e('portion', 'rcal'); echo '</span>'; echo '<span class="portions-text-plural">'; _e('portions', 'rcal'); echo '</span>:</h2>';

		echo '<div class="control-ingredients">';
			echo '<button type="button" class="down ion-ios-minus-outline"></button>';
			echo '<button type="button" class="up ion-ios-plus-outline"></button>';
		
		echo '</div>';
		echo '<ul>'; 
		
	$ingredients = get_post_meta( get_the_ID(), 'ingredients_group', true );
	$counter = 1;
	
foreach ( (array) $ingredients as $key => $entry ) {
	 
    $quantity = $unit = $ingredient = '';

    if ( isset( $entry['ingredients_quantity'] ) ) {
		if ( $entry['ingredients_unit'] == 'L' && ($entry['ingredients_quantity'])<=1000) {
			 $quantity = esc_html( ($entry['ingredients_quantity'])*1000 );
		} elseif ( $entry['ingredients_unit'] == 'kg' && ($entry['ingredients_quantity'])<=1000) {
			 $quantity = esc_html( ($entry['ingredients_quantity'])*1000 );
		} else { 
		
        $quantity = esc_html( $entry['ingredients_quantity'] );
		
		}
    }
	
if($quantity) {

    if ( isset( $entry['ingredients_unit'] ) ) {
		if ($entry['ingredients_unit'] == 'L' && $entry['ingredients_quantity']<=1000) {
			 $unit = 'ml';
		} elseif ($entry['ingredients_unit'] == 'kg' && $entry['ingredients_quantity']<=1000) {
			  $unit = 'g';
		} elseif ($entry['ingredients_unit'] == 'none') {
			 $unit = '';
		}  else {
        $unit = esc_html( $entry['ingredients_unit'] );
		}
    }

    if ( isset( $entry['ingredients_ingredient'] ) ) {
        $ingredient = esc_html( $entry['ingredients_ingredient'] );
    }
	if ( isset( $entry['ingredients_ingredient_plural'] ) ) { 
			 $ingredient_plural = esc_html( $entry['ingredients_ingredient_plural'] ); 
    }
	
	$subtitle = get_post_meta( get_the_ID(), 'ingredients_subtitle_group', true );
		for($i = 0; $i < count($subtitle); ++$i) {
				$ingredients_subtitle = $insert_subtitle_before = '';
				if ( isset( $subtitle[$i]['ingredients_subtitle'] ) ) { 
					$ingredients_subtitle = esc_html( $subtitle[$i]['ingredients_subtitle'] );
				}
				if ( isset( $subtitle[$i]['ingredients_subtitle_before'] ) ) { 
					$insert_subtitle_before = esc_html( $subtitle[$i]['ingredients_subtitle_before'] );
				}
			if ( $counter == $insert_subtitle_before ) {
			  echo '<span class="subtitle">'; echo $ingredients_subtitle; echo '</span>';
			}
		} 
 $counter++;
    // Display Ingredients 
	echo '</span>'; echo '<li itemprop="recipeIngredient" class="p-ingredient recipe-ingredients">'; echo '<span class="quantity">'; echo $quantity; echo '</span>'; echo '<span class="quantity-unit">'; echo __( $unit, 'rcal'); echo '</span>'; echo '<p class="single-name">'; echo $ingredient; echo '</p>'; if ($ingredient_plural) { echo '<p class="plural-name">'; echo $ingredient_plural; echo '</p>'; } echo '</li>'; 
	 
   }
	}	 
		echo '</ul>';
		echo '</div>';
		 
		 } 
	 
echo '</div>';
echo '<!-- // End Recipe Calculator plugin -->'; 
 }  
 