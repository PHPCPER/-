<?php  
/** 
* 生成缩略图 
* 
* @param string $imagePath 图片路径 
* @param string $thumb 生成缩略图名称 
* @param integer $width 生成缩略图最大宽度 
* @param integer $height 生成缩略图最大高度 
*/  
    function resizeImage($imagePath, $width = '100', $height = '100', $model = 1 )  
    {  
        if (!file_exists($imagePath)) {
            die('no file');
        }
        if (empty($width) || empty($height)) {
            die ('没有传宽高！！');
        }
        list($imageWidth, $imageHeight, $typeStatus) = getimagesize($imagePath);
        $imageCate = pathinfo($imagePath);
        
        $type = $typeStatus == '3' ? 'imagecreatefrompng' : 'imagecreatefromjpeg'; 
        $imagePath = $type($imagePath);
        $dst_scale = $height / $width; //目标比例
        $src_scale = $imageHeight / $imageWidth;
        if ($src_scale >= $dst_scale)
        {
            $w = intval($imageWidth);
            $h = intval($dst_scale * $w);
            $x = 0;
            $y = ($imageHeight - $h) / 3;
        } else {
            $h = intval($imageHeight);
            $w = intval($h / $dst_scale);
            $y = 0;
            $x = ($imageWidth - $w) / 2;
        }
        // if ($width && ($imageWidth < $imageHeight))  
        // {  
        //     $width = ($height / $imageHeight) * $imageWidth;  
        // } else { 
        //     $height = ($width / $imageWidth) * $imageHeight;  
        // }
        // $source = imagecreatefromjpeg($imagePath);
        $croped = imagecreatetruecolor($w, $h);
        imagecopy($croped, $imagePath, 0, 0, $x, $y, $imageWidth, $imageHeight);
        // $image = imagecreatetruecolor($width, $height); 

        $save_dir = './'.$w.'x'.$h;
        if(!file_exists($save_dir) && !mkdir($save_dir, 0777, true)){
            return array('file_name'=>'','save_path'=>'','error'=>5);
        }
        $thumb = $save_dir.'/'.$imageCate['filename'].'_'.$w.'x'.$h.'.'.$imageCate['extension'];

        // imagecopyresampled($image, $imagePath, 0, 0, 0, 0, $width, $height, $imageWidth, $imageHeight);      
        imagepng($croped, $thumb);  
        imagedestroy($croped);  
    }  
    resizeImage('./img/101.jpg');  
?> 