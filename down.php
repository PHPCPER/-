<?php
//2. 在生成的二维码中加上logo(生成图片文件)  
function scerweima1($url='',$agent_id='',$save_dir=''){  
    $ab=require_once ('phpqrcode.php');  
    $value = $url;                  //二维码内容    
    $errorCorrectionLevel = 'H';    //容错级别    
    $matrixPointSize = 6;           //生成图片大小     
    //生成二维码图片 
    //SITE_PATH .'/uploadfile/'
    if (trim($save_dir)==''){
        $save_dir='./';
    }
    //创建保存目录
    if (!file_exists($save_dir)&&!mkdir($save_dir,0777,true))
    {
        return array('file_name' => '','save_path' => '','error' => 5);
    } 
    $filename = 'qrcode/'.$agent_id.'.png';  
    QRcode::png($value,$filename , $errorCorrectionLevel, $matrixPointSize, 2);    
      
    $logo = 'qrcode/logo.jpg';  //准备好的logo图片     
    $QR = $filename;            //已经生成的原始二维码图    
  
    if (file_exists($logo)) {     
        $QR = imagecreatefromstring(file_get_contents($QR));        //目标图象连接资源。  
        $logo = imagecreatefromstring(file_get_contents($logo));    //源图象连接资源。  
        $QR_width = imagesx($QR);           //二维码图片宽度     
        $QR_height = imagesy($QR);          //二维码图片高度     
        $logo_width = imagesx($logo);       //logo图片宽度     
        $logo_height = imagesy($logo);      //logo图片高度     
        $logo_qr_width = $QR_width / 4;     //组合之后logo的宽度(占二维码的1/5)  
        $scale = $logo_width/$logo_qr_width;    //logo的宽度缩放比(本身宽度/组合后的宽度)  
        $logo_qr_height = $logo_height/$scale;  //组合之后logo的高度  
        $from_width = ($QR_width - $logo_qr_width) / 2;   //组合之后logo左上角所在坐标点  
          
        //重新组合图片并调整大小  
        /* 
         *  imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中 
         */  
        imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);   
    }     
    
    //输出图片    
    $a = imagepng($QR, $save_dir.'/'.'1245'.'.png');
    var_dump($ab);
    unlink($filename);  
    return $ab;  
}  
if (!file_exists('./isda/1245.png'))
            {
                $agent_id = 1245;
                $url = "http://m_bug.fengqiangnet.com";
                $savePath = './isda';
                $a = scerweima1($url,$agent_id,$savePath);
            }
//调用查看结果  

?>