<?php
	function test($path, $quality = 10)
	{
		list($imageWidth, $imageHeight, $imageType) = getimagesize($path);
		$type = $imageType == '3' ? 'imagecreatefrompng' : 'imagecreatefromjpeg'; 
        $newImage = $type($path);
		$new = imagecreatetruecolor($imageWidth, $imageHeight);
		imagecopyresampled($new, $newImage, 0, 0, 0, 0, $imageWidth, $imageHeight, $imageWidth, $imageHeight);
		// $ob = imagejpeg($new,'./img/12354.jpg',$quality);
		$quality == 10 ? imagejpeg($new, './img/123456.jpg') : imagejpeg($new,'./img/12354.jpg',$quality);
	}
	test('./img/123123.jpg');
?>