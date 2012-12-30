<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminaddphoto extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata("loggedin")==1)
        {
            if($this->session->userdata("atype")!=0)
            {
                redirect("adminsanat");
            }
            
        }
        else
        {
            redirect("admin");
        }
        
        
    }
    
    
    public function upload($num)
    {
        if($this->input->post("cat")==1)
        {
            $this->uploadmain($num);
        }
        $this->load->library("Photo");
        
        $picname=basename($_FILES['picture']['name']);
        $ext=  substr($picname, strrpos($picname,".")+1);
        $error=array();
        $name=md5(uniqid(rand(),true).time());
        $tmp_name=$_FILES['picture']['tmp_name'];
        $picerror=$_FILES['picture']['error'];
        $allowedext=array("jpg","jpeg","png","gif");
        $imagex=$this->photo->getimagex($tmp_name);
        $imagey=$this->photo->getimagey($tmp_name);
        $fullname=$name.".".$ext;
       
        if(!$tmp_name || $picerror!=0 || !in_array(strtolower($ext), $allowedext))
        {
            $error[]="picture upload error";
           
            
        }
        if($imagex<300 || $imagey<300)
        {
            $error[]="Image width and height must be at least 300px";
            
            
        }
        
        
        if(empty($error))
        {

            
            $path="public/images/".$num."/";
            $this->photo->setname($name);
            $this->photo->setext($ext);
		
	    if($imagex<700|| $imagey<700)
            {    
		$imgspath="public/images/".$num."/".$name.".".$ext;
	    	if(!move_uploaded_file($_FILES['picture']['tmp_name'],$imgspath))
	        {

		   redirect("adminaddphoto/addphoto/".$num);

		  
		}
               
		
	    }
            else
            {
		
		
		$this->photo->resize($_FILES['picture'],699,699,$path,true);
		
	    }
           
           
            if(file_exists($path.$name.".".$ext) && empty($error))
            {
                
                
               
                $data=array(
                    
                    "external_id" =>$num,
                    "filename" =>$fullname
                );
                
                
                 if($this->db->insert("photo",$data))
                 {
                     
                     redirect("adminalbumcrop/index/".$this->db->insert_id());
                 }
                 else
                 {
                     
                     if(file_exists($path.$fullname))
                     {
                         
                          unlink($path.$fullname);
                          redirect("adminaddphoto/addphoto/".$num);
                     }
                     
                     
                 }        
                 
            }
            
		
        }
        else
        {
            
            redirect("adminaddphoto/addphoto/".$num);
        }
        
        
        
        
        
        
    }
    
    
    public function uploadmain($num)
    {
        $this->load->library("Photo");
        
        $picname=basename($_FILES['picture']['name']);
        $ext=  substr($picname, strrpos($picname,".")+1);
        $error=array();
        $name=md5(uniqid(rand(),true).time());
        $tmp_name=$_FILES['picture']['tmp_name'];
        $picerror=$_FILES['picture']['error'];
        $allowedext=array("jpg","jpeg","png","gif");
        $imagex=$this->photo->getimagex($tmp_name);
        $imagey=$this->photo->getimagey($tmp_name);
        $fullname=$name.".".$ext;
       
        if(!$tmp_name || $picerror!=0 || !in_array(strtolower($ext), $allowedext))
        {
            $error[]="picture upload error";
           
            
        }
        if($imagex<570 || $imagey<250)
        {
            $error[]="Image width and height must be at least 300px";
            
            
        }
        
        
        if(empty($error))
        {

            
            $path="public/images/".$num."/";
            $this->photo->setname($name);
            $this->photo->setext($ext);
		
	    if($imagex<1000|| $imagey<1000)
            {    
		$imgspath="public/images/".$num."/".$name.".".$ext;
	    	if(!move_uploaded_file($_FILES['picture']['tmp_name'],$imgspath))
	        {

		   redirect("adminaddphoto/addphoto/".$num);

		  
		}
               
		
	    }
            else
            {
		
		
		$this->photo->resize($_FILES['picture'],999,999,$path,true);
		
	    }
           
           
            if(file_exists($path.$name.".".$ext) && empty($error))
            {
                
                $this->db->where("external_id",$num);
                $this->db->where("photo_cat","1");
                $query=$this->db->get("photo");
                
                if($query->num_rows()>0)
                {
                    $result=$query->row();
                    $filename=$result->filename;
                    
                    $picid=$result->id;
                    $query->free_result();
                     

                    if(file_exists("public/images/{$num}/{$filename}"))
                    {
                        
                        @unlink("public/images/{$num}/{$filename}");
                        @unlink("public/images/{$num}/thumb_{$filename}");
                        $this->db->where("id",$picid);
                        $this->db->delete("photo");
                        
                    } 
                }
                
               
                $data=array(
                    
                    "external_id" =>$num,
                    "filename"    =>$fullname,
                    "photo_cat"   =>1
                );
                
                
                 if($this->db->insert("photo",$data))
                 {
                     
                     redirect("adminalbumcrop/mainpic/".$this->db->insert_id());
                 }
                 else
                 {
                     
                     if(file_exists($path.$fullname))
                     {
                         
                          unlink($path.$fullname);
                          redirect("adminaddphoto/addphoto/".$num);
                     }
                     
                     
                 }        
                 
            }
            
		
        }
        else
        {
            
            redirect("adminaddphoto/addphoto/".$num);
        }
    }
    public function deletephoto($num)
    {
       $this->load->model("adminalbummodel");
       $album= $this->adminalbummodel->deletephoto($num);       
       redirect("adminaddphoto/addphoto/{$album}");
    }
           
    public function addphoto($num)
    {
        $num=(int)$num;
        $this->load->model("adminalbummodel");
        $data['photos']=$this->adminalbummodel->getphoto($num);
        $data['value']="adminphotoview";
        $this->load->view("admintemplate",$data);
        
        
    }
    
    
}