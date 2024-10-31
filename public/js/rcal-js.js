function RecipeCalculator(){
	//float2rat.js source: https://gist.github.com/anonymous/4569504
function float2rat(x,fraction) {
    var tolerance = 1.0E-6;
    var h1=1; var h2=0;
    var k1=0; var k2=1;
    var b = x;
    do {
        var a = Math.floor(b);
        var aux = h1; h1 = a*h1+h2; h2 = aux;
        aux = k1; k1 = a*k1+k2; k2 = aux;
        b = 1/(b-a);
    } while (Math.abs(x-h1/k1) > x*tolerance);
    
	if (fraction){
		return "<span class='numerator'>"+h1+"</span>/<span class='denominator'>"+k1+"</span>";
	}else{
		return h1+"/"+k1;
	}
}
//end float2rat.js

//rcal js
jQuery.each(jQuery(".quantity"), function(){
	var quantity = jQuery(this);
	var theIngredients = parseFloat(quantity.text());  
	var currentIngredients = theIngredients.toFixed(2);
	var currentPortions = parseInt(jQuery('.portions-num').text(),10);
	var currentIngredientsPerPortion = currentIngredients/currentPortions;
	
	quantity.attr("data-per-portion", currentIngredientsPerPortion);
});	

var setPortionsNumber = function (portions){
	jQuery.each(jQuery(".recipe-ingredients"), function(){
		var ingredients = jQuery(this);
		var ingredientsText = jQuery(this).find('p');
			
		var ingredientsPerPortion = parseFloat(ingredients.find('.quantity').data('per-portion'));
		var ingredientsQuantity = portions * ingredientsPerPortion;

//CHANGE UNITS		
var quantityUnit = ingredients.find('.quantity-unit').html(); 
var quantityDecimalHundreds = ingredientsQuantity.toFixed();
var quantityDecimalTens = ingredientsQuantity.toFixed(1);


//decimal values
if(quantityUnit == 'ml' || quantityUnit == 'g'){
	ingredients.addClass("decimal-hundreds");
} else if (quantityUnit == 'lb' || quantityUnit == 'lbs' || quantityUnit == 'oz' || quantityUnit == 'fl oz' || quantityUnit == 'pt' || quantityUnit == 'qt'){
	ingredients.addClass("decimal-tens"); 
}else{
	
};

//Single to plural Ingredient Name
if(ingredientsText.hasClass('plural-name') && (ingredientsQuantity> 1) && quantityUnit == ''){
	ingredients.find('p.single-name').hide();
	ingredients.find('p.plural-name').show();
}else if (ingredientsText.hasClass('plural-name')&& ingredientsQuantity<= 1 && quantityUnit == ''){
	ingredients.find('p.single-name').show();
	ingredients.find('p.plural-name').hide();
}else{
	ingredients.find('p.plural-name').hide();
};
	
//cup to cups
if(quantityUnit == 'cup'&& (ingredientsQuantity> 1)){
	ingredients.addClass("plural");
}else if (quantityUnit == 'cups'&& ingredientsQuantity<= 2){
	ingredients.removeClass("plural");
	
}else{
	
};
if (ingredients.hasClass('plural')){
	var x=ingredients.find('.quantity-unit');  // Find the elements
	
    for(var i = 0; i < x.length; i++){
    x[i].innerText="cups";      // Change the text
    }
	};
if (quantityUnit == 'cups'&&(ingredientsQuantity<= 1)) {
	var x=ingredients.find('.quantity-unit');
    for(var i = 0; i < x.length; i++){
    x[i].innerText="cup";
    }
};

//ml to L
if(quantityUnit == 'ml'&& (ingredientsQuantity>= 1000)){
	ingredients.addClass("litter");
}else if (quantityUnit == 'L'&& ingredientsQuantity<= 999){
	ingredients.removeClass("litter");
	
}else{
	
};
if (ingredients.hasClass('litter')){
	var x=ingredients.find('.quantity-unit');
	
    for(var i = 0; i < x.length; i++){
    x[i].innerText="L";
	var amountLitters =(ingredientsQuantity/1000);
	// If is integer,show only number
	if (amountLitters %1==0){
		quantityLitters = amountLitters.toFixed();
		}else{
		quantityLitters = amountLitters.toFixed(1);
		}
	
    }
	};
if (quantityUnit == 'L'&&(ingredientsQuantity<= 999)) {
	var x=ingredients.find('.quantity-unit');
    for(var i = 0; i < x.length; i++){
    x[i].innerText="ml";
    }
};
	
 //g to kg
if(quantityUnit == 'g'&& (ingredientsQuantity>= 1000)){
	ingredients.addClass("kilo");
}else if (quantityUnit == 'kg'&& ingredientsQuantity<= 999){
	ingredients.removeClass("kilo");
	
}else{
	
};
	
if (ingredients.hasClass('kilo')){
	var x=ingredients.find('.quantity-unit');
    for(var i = 0; i < x.length; i++){
    x[i].innerText="kg";
	var amountKilograms =(ingredientsQuantity/1000);
	  // If is integer,show only number
	if (amountKilograms %1==0){
		quantityKilograms = amountKilograms.toFixed();
		}else{
		quantityKilograms = amountKilograms.toFixed(1);
		}
	
    }
	}; 
if (quantityUnit == 'kg'&&(ingredientsQuantity<= 999)) {
	var x=ingredients.find('.quantity-unit');
    for(var i = 0; i < x.length; i++){
    x[i].innerText="g"; 
    }
};
//END CHANGE UNITS

// Setting the ingredients quantity
		if (ingredientsQuantity %1!==0){
			ingredientsQuantity.toFixed(2);
			var remainingQuantity;
			var roundedQuantity = Math.floor(ingredientsQuantity);
		if (roundedQuantity===0){
			remainingQuantity = ingredientsQuantity - roundedQuantity;
			ingredientsQuantity = float2rat(remainingQuantity,true);
		} else{
			remainingQuantity = ingredientsQuantity - roundedQuantity;
			ingredientsQuantity = roundedQuantity.toString() + ' ' + float2rat(remainingQuantity,true);
		}
			
		};
		ingredients.find('.quantity').html(ingredientsQuantity);

	if (ingredients.hasClass('decimal-hundreds')){
	ingredients.find('.quantity').html(quantityDecimalHundreds);
	}
	if (ingredientsQuantity %1!==0 && ingredients.hasClass('decimal-tens')){
	ingredients.find('.quantity').html(quantityDecimalTens);
	}
	if (ingredients.hasClass('litter')){
	ingredients.find('.quantity').html(quantityLitters);
	} 
	if (ingredients.hasClass('kilo')){
	ingredients.find('.quantity').html(quantityKilograms);
	}	
	if (ingredients.hasClass('litar')){
	ingredients.find('.quantity').html(quantityLitar);
	} 
	if (ingredients.hasClass('kilogram')){
	ingredients.find('.quantity').html(quantityKilogramsCyrilic);
	}	
	

	});	
};
  // Updating portions number on click
 jQuery('.control-ingredients button').click(function(){
	 var portionsNumber = jQuery('.portions-num');
	 var portions = parseInt(portionsNumber.text(),10); 
	 var portionsText = '';
	 var portionsTextSingle = jQuery('span.portions-text-single').text();
	 var portionsTextPlural = jQuery('span.portions-text-plural').text();
	 var updatePortions;

 if (jQuery(this).hasClass('up')){
	 updatePortions = portions+1;
	if (updatePortions > 1000) {return false;}
	
 } else if(jQuery(this).hasClass('down')){
	 
	 updatePortions = portions-1;
	if (updatePortions < 1) {return false;}
 };
 if (updatePortions === 1){
	 portionsText = portionsTextSingle;
	 };
 if (updatePortions > 1){
	 portionsText = portionsTextPlural;
	 };
 jQuery('.portions-text').text(portionsText);
 portionsNumber.text(updatePortions);
 setPortionsNumber(updatePortions);
 });
setPortionsNumber(parseInt(jQuery('.portions-num').text(),10));

	//If the .quantity-unit is empty, hide it
	jQuery.each(jQuery(".quantity-unit"), function(){
		 if(jQuery(this).html() == ''){
		 jQuery(this).hide();
		 }
	});
 
//Ingredients we have - Change of opacity 
	jQuery.each(jQuery(".recipe-ingredients"), function(){ 
	var recipeIngredients = jQuery(this)
	
	recipeIngredients.on( "click", function(){
	if ( ! recipeIngredients.hasClass("checked-ingredients")) {
		jQuery(this).addClass("checked-ingredients");
	} else {  
		jQuery(this).removeClass("checked-ingredients");
	}
	});
	
	});

 //Determine width of Ingredients and Instructions, according to rcal-wrap width
 var rcalWrapWidth = jQuery('.rcal-wrap').outerWidth();
 var ingredientsWidth = jQuery('.ingredients');
 var instructionsWidth = jQuery('.instructions');
 
 if (rcalWrapWidth <= 800 ){
	 ingredientsWidth.css("width", "100%");
	 instructionsWidth.css("width", "100%");
 }
 
 };
 
 //call RecipeCalculator function
 jQuery(document).ready(function () {
    RecipeCalculator();
});
jQuery(document).ajaxComplete(function () {
    RecipeCalculator();
});