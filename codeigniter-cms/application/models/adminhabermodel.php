<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminhabermodel extends CI_Model {
    
    public function add()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title","Title","trim|required");
        $this->form_validation->set_rules("content","Content","trim|required");
        $this->form_validation->set_rules("cat","Categorie","required");
        
        if($this->form_validation->run())
        {
            
            $id=$this->checkpic();
            return ($id)?$id:false;
        }
        else
        {
            return false;
        }
        
        
        
        
    }
    
    
    public function checkpic()
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
        if($imagex<400 || $imagey<300)
        {
            $error[]="Image width and height must be at least 300px";
            
            
        }
        
        
        
        if(empty($error))
        {
            //there is no error
            
              
            $path="public/images/news/";
            $this->photo->setname($name);
            $this->photo->setext($ext);
            
            
            if($imagex<700|| $imagey<700)
            {    //if image width and heightless than 700 px move directly
		$imgspath="public/images/news/".$name.".".$ext;
	    	if(!move_uploaded_file($_FILES['picture']['tmp_name'],$imgspath))
	        {
                   //image is not moved
		   return false;

		  
		}
                //image moved successfully
               
               
		
	    }
            else 
            {
               //image width and height is higher than 700 px resize  
               $this->photo->resize($_FILES['picture'],699,699,$path,true);
            }
            
            
            
            if(file_exists($path.$name.".".$ext) && empty($error))
            {
                
                
               
                $data=array(
                    
                    "title"            =>$this->input->post("title"),
                    "picture"          =>$fullname,
                    "content"          =>$this->input->post("content"),
                    "newcatgories"     =>$this->input->post("cat"),
                    "tim"              =>time()
                );
                
                
                 if($this->db->insert("news",$data))
                 {
                     
                     return $this->db->insert_id();
                 }
                 else
                 {
                     
                     if(file_exists($path.$fullname))
                     {
                         
                          unlink($path.$fullname);
                          return false;
                     }
                     return false;
                     
                     
                 }        
                 
            }
            
            
            return false;
            
            
        }
        else
        {
            //there is an error 
            return false;
        }
         
    }
    
    
    public function getbyid($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("news");
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        return false;
    }
    
    public function editnews($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title","title","trim|required");
        $this->form_validation->set_rules("content","Content","trim|required");
        if($this->form_validation->run())
        {
            $this->db->where("id",$id);
            $data=array(
                "title"         =>$this->input->post("title"),
                "content"       =>$this->input->post("content")
            );
            
            $this->db->update("news",$data);
        }
    }
    
    public function deletenews($id)
    {
        $picture=$this->getpicture($id);
        $path="public/images/news/{$picture}";
        $thumbpath="public/images/news/thumb_{$picture}";
        @unlink($path);
        @unlink($thumbpath);
        
        if(!file_exists($path) && !file_exists($thumbpath))
        {
            $this->db->where("id",$id);
            $this->db->delete("news");
        }
    }
    
    public function getpicture($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("news");
        
        if($query->num_rows()==1)
        {
            $result=$query->row();
            return $result->picture;
        }
        return false;
    }
    
    public function getall()
    {
        $query=$this->db->query("select `id`, `title`,`picture`, left(`content`,200) as `content` from `news` order by `id` desc");
        if($query->num_rows()>0)
        {
            $data=array();
            foreach($query->result() as $row)
            {
                $data[]=$row;
            }
            return (!empty($data))?$data:false;
        }
        return false;
    }
    
    
    public function cropimage($id)
    {
        $this->load->library("photo");
        $filename=$this->input->post("filename");
        $x=$this->input->post("x");
        $y=$this->input->post("y");
        $w=$this->input->post("w");
        $h=$this->input->post("h");
        
        $name="thumb_".substr($filename,0,strrpos($filename,"."));        
        $ext=$ext=substr($filename,strrpos($filename,".")+1);
        $imagename=$name.'.'.$ext;
        $image="public/images/news/".$filename;        
        $path="public/images/news/";
        
        $this->photo->setname($name);
        $this->photo->setext($ext);
        
        $this->photo->cropimage($image,300,200,$x,$y,$w,$h,$path,true);
        if(file_exists($path.$imagename))
        {
           
            return true;
        }
        else
        {
            return false;
        }
       
    }
    
  
    
    public function getfilename($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("news");
        if($query->num_rows()==1)
        {
            $result=$query->row();
            return $result->picture;
        }
        return false;
    }
}
