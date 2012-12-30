<?php

 class Photo
        {

            private $name;
            private $ext;
            private $image;
            
            public function __construct(){}
            public function say()
            {
                return "hello from photo class";
            }
            public function checkPhoto($images)
            {
                
                
                $error=array();
                $ext=array('jpg','jpeg','gif','png');
                 if(!isset($this->name) && !isset($this->ext))
                 {
                     $this->ext=(is_array($images))? strtolower(end(explode(".",$images['name']))): strtolower(end(explode(".",basename($images))));             
              
                     $this->name=(is_array($images))? array_shift(explode(".",$images['name'])):array_shift(explode(".",basename($images))) ;
                 }
                
                if(is_array($images))
                {      
                   
                    return (!empty($images['tmp_name']) && in_array($this->ext,$ext) && $images['size']<41943040) ? true : false ;                    
                }
                else
                { 
                    
                    //return (in_array($this->ext,$ext) && filesize($images)<41943040) ? true:false; 
                    if(filesize($images)<41943040)
                    {
                        
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                
            }
            
            
            public function resize($images,$thumb_width=700,$thumb_height=400,$dest=null,$name=false)
            {    
                
                
                if($name==false)
                {
                    
                     $this->ext=(is_array($images))? strtolower(end(explode(".",$images['name']))): strtolower(end(explode(".",basename($images))));             
              
                     $this->name=(is_array($images))? array_shift(explode(".",$images['name'])):array_shift(explode(".",basename($images))) ; 
                }
                
                if($this->checkPhoto($images))
                {
                      
                    
                    if(is_array($images))
                    {
                        
                        
                        
                        
                        $src_image=getimagesize($images['tmp_name']);
                        $images=$images['tmp_name'];
                        
                      
                        
                        
                    }
                    else
                    {
                        $src_image=getimagesize($images);                        
                    }      
                    
                    if($src_image[0]>$thumb_width)
                    {
                        
                        //if($src_image != false)
                        //{                       
                            $source=$this->createimage($images);                        
                       // }                

                        $thumb_ratio=$thumb_width/$thumb_height;      
                        $ratio=$src_image[0]/$src_image[1];


                        if($thumb_ratio>$ratio)
                        {
                            $thumb_width=$thumb_height*$ratio;
                        }
                        else
                        {
                            $thumb_height=$thumb_width/$ratio;
                        }

                        $thumb=imagecreatetruecolor($thumb_width,$thumb_height);
                        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $src_image[0], $src_image[1]);                    
                        $this->save($images,$thumb,$dest);                    
                        @imagedestroy($thumb);
                        @imagedestroy($source);
                        return true;    

                }//   end of the -----if($src_image[0]>$thumb_width)
                else
                {   // if src_image width lesss thne thumbnail width return false
                    //then move this file 
                    return false;
                }
              }//    end of the if($this->checkPhoto($images))
            }
            
            
            
            public function createimage($images)
            {
                 $src_image=getimagesize($images);
                 
                 $source="";
                 switch ($src_image['mime'])
                 {
                     case 'image/jpeg';                                
                           $source=imagecreatefromjpeg($images);                                
                     break;
                     case 'image/png';                               
                            $source=imagecreatefrompng($images);
                            imageAlphaBlending($source, false); // setting alpha blending on
                            imageSaveAlpha($source, true);                                
                    break;
                    case 'image/gif';                              
                             $source=imagecreatefromgif($images);                               
                    break;
                 }             
                              
                 if(!empty($source))
                 {
                     
                     return $source;
                 }        
                        
            }
            
            public function cropimage($images,$thumb_width,$thumb_height,$picture_x,$picture_y,$picture_width,$picture_height,$dest=null,$name=false)
            {
                if($name==false)
                {
                    
                     $this->ext=(is_array($images))? strtolower(end(explode(".",$images['name']))): strtolower(end(explode(".",basename($images))));             
              
                     $this->name=(is_array($images))? array_shift(explode(".",$images['name'])):array_shift(explode(".",basename($images))) ; 
                }
                
                if($this->checkPhoto($images))
                {
                   
                    $image=(is_array($images)) ? $images['tmp_name'] :$images; 
                    
                    //list foe the other kind of cropping such as witout using jquery
                    //list($width,$height)=getimagesize($image);                    
                    $crop=imagecreatetruecolor($thumb_width, $thumb_height);
                    $img=$this->createimage($image); 
                    //calculate where yu start to cut 
                    imagecopyresampled ( $crop, $img, 0, 0,$picture_x,$picture_y,$thumb_width,$thumb_height , $picture_width, $picture_height );
                    $this->save($image,$crop,$dest);                 
                    
                   
                }else
                echo "you must supply the correct image format";
            }
            
            public function save($images,$thumb,$dest=null)
            {
               
               
                $image=(is_array($images)) ? $images['tmp_name'] :$images;
                
                $src_image=getimagesize($image);
               
                
               
                
                //echo $name=substr($images['name'],0,  strrpos($images['name'], '.'));
               
                switch ($src_image['mime'])
                        {
                            case 'image/jpeg';
                                imagejpeg($thumb,$dest.$this->name.".".$this->ext,80);
                            break;

                            case 'image/png';
                                imagepng($thumb,$dest.$this->name.".".$this->ext,8);
                            break;

                            case 'image/gif';
                                imagegif($thumb,$dest.$this->name.".".$this->ext,80);
                            break;
                        }
            }
            
            public function setname($name)
            {
                
                    $this->name=$name;
                
            }
             
            public function setext($ext)
            {              
                    $this->ext=$ext;
                
            }
            
            public function getimagex($images)
            {
                $image= getimagesize($images);
                return $image[0];
            }
            public function getimagey($images)
            {
                $image= getimagesize($images);
                return $image[1];
            }
            
        }
?>

