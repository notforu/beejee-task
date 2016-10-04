<?php

class ImageManager{
	
	const DESIRED_WIDTH = 320;
	const DESIRED_HEIGHT = 240;
	
	//proportionally resize an image to desired size
	public static function resize($pathToImage){

		list($width, $height) = getimagesize($pathToImage);
		if ($width > $height){
			$new_width = self::DESIRED_WIDTH;
			$new_height = $height / ($width / self::DESIRED_WIDTH);
		}
		else{
			$new_height = self::DESIRED_HEIGHT;
			$new_width = $width / ($height / self::DESIRED_HEIGHT);
		}
		
		$image_p = imagecreatetruecolor($new_width, $new_height);
		
		switch (exif_imagetype($pathToImage)) {
			case IMAGETYPE_JPEG:
		        $image = imagecreatefromjpeg($pathToImage);
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				imagejpeg($image_p, $pathToImage, 100);
		    	break;
		    case IMAGETYPE_GIF:
		        $image = imagecreatefromgif($pathToImage);
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				imagegif($image_p, $pathToImage);
		    	break;
		    case IMAGETYPE_PNG:
		        $image = imagecreatefrompng($pathToImage);
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				imagepng($image_p, $pathToImage);
		    	break;
		}
	}
	
}
