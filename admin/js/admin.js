//If selected unit is empty - show Ingredient plural name metabox on post change
jQuery(document).ready(function() {
    jQuery('#post').change(function(){
		jQuery.each(jQuery(".cmb-repeatable-grouping"), function(){ 
	
	var container = jQuery(this);
	var ingredients = jQuery(this).find("[class*='-ingredients-ingredient-plural']");
	var selectUnit = jQuery(this).find("[id*='_ingredients_unit']"); 

	selectUnit.click(function(){
  if(selectUnit.val() == 'none'){ 
     ingredients.css('opacity',1);
  } else if (selectUnit.val() !== 'none'){
	   ingredients.css('opacity',0); 
  }
});
	});
      
    });
	
	jQuery.each(jQuery(".cmb-repeatable-grouping"), function(){ 
 
	var ingredients = jQuery(this).find("[class*='-ingredients-ingredient-plural']");
	var selectUnit = jQuery(this).find("[id*='_ingredients_unit']"); 
	 
	if(selectUnit.val() == 'none'){
		ingredients.css('opacity',1); 
		}else if(selectUnit.val() !== 'none'){
			ingredients.css('opacity',0); 
		}
	
});
});	
 