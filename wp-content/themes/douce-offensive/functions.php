<?php

function douce_main($post) {
	$sizes = get_post_meta($post->ID, 'photoQImageSizes', true);
	
	$main = '<img class="photoQcontent" height="'.$sizes['main']['imgHeight'].'" src="'.$sizes['main']['imgUrl'].'" alt="'.$post->title.'"/>';
	
	return $main;
}

function douce_thumbnail($post, $selected = false, $new_row = false) {
	$sizes = get_post_meta($post->ID, 'photoQImageSizes', true);
	
	// Preoload image
	$thumbnail = '<script type="text/javascript" charset="utf-8">jQuery.preloadImages("'.$sizes['main']['imgUrl'].'");</script>';
	
	// Display image
	$thumbnail .= '<div class="nav_photo ';
	
	// Add style depending on the row/selected position
	if($selected){
		$thumbnail .= 'selected_photo ';
	}
	
	if($new_row){
		$thumbnail .= 'first_column ';
	}
	
	// Close image
	$thumbnail .= '" url="'.$sizes['main']['imgUrl'].'"><img width="'.$sizes['thumbnail']['imgWidth'].'" height="'.$sizes['thumbnail']['imgHeight'].'" alt="'.$post->title.'" src="'.$sizes['thumbnail']['imgUrl'].'" class="photoQexcerpt photoQLinkImg"/></div>';
	
	// Return image
	return $thumbnail;
}


?>