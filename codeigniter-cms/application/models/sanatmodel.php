<?php

class Sanatmodel extends CI_Model
{
    
    
    public function validateform()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("firstname","Fistname","trim|required");
        $this->form_validation->set_rules("lastname","Lastname","trim|required");
        
        if($this->input->post("year"))
        {
            $this->form_validation->set_rules("year","year","trim|required|integer|min_length[4]|max_length[4]");
        }
        if($this->input->post("month"))
        {
            $this->form_validation->set_rules("month","month","trim|required|integer|max_length[2]");
        }
        if($this->input->post("day"))
        {
            $this->form_validation->set_rules("day","day","trim|required|integer|max_length[2]");
        }
        if($this->input->post("about"))
        {
            $this->form_validation->set_rules("about","about","trim|required");
        }
        
        
        if($this->form_validation->run())
        {
          return true; 
            
        }
        else
        {
            return false;
        }
    }
    public function add()
    {
       
        
        if($this->validateform())
        {
            
            if(($id=$this->checkpic()))
            {
                
                return $id;
                
            }
            return false;   
            
            
        }
        else
        {
            return false;
        }
        
    }
    
    
    public function addvideo($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("video","Video youtube address","trim|required");
        $this->form_validation->set_rules("title","Title","trim|required");
        
        if($this->form_validation->run())
        {
            $data=array(
                "sanat_id"     =>$id,
                "parcaname"    =>$this->input->post("title"),
                "youtube"    =>$this->input->post("video")
                
            );
            
            $this->db->insert("videos",$data);
            return true;
        }
        else 
        {
            return false;
        }
    }
    public function getphotos($id)
    {
//        $this->db->where("external_id",$id);
//        $this->db->where("type" ,"1");
//        $this->db->from("photo");
//        $this->db->order_by("id","desc");
        $query=$this->db->query("select * from `photo` where `external_id` = {$id}  and `type` = 1 order by `id` desc");
         
        if($query->num_rows()>0)
        {
            $data=array();
           foreach($query->result() as $result)
           {
               $data[]=$result;
           }
           return (!empty($data))?$data:false;
           
        }
        return false;
    }
    
    
    public function addphoto($id)
    {
        if(isset($_FILES['picture']) && $_FILES['picture']['tmp_name'])
        {
           if(($error=$this->picerror()))
           {
               
                $this->load->library("Photo");
                $this->photo->setname($error['name']);
                $this->photo->setext($error['ext']);
                $imagename=$error['name'].".".$error['ext'];
                $path="public/images/sanatci/";
            
            if($error['imagex']<700|| $error['imagey']<700)
            {    //if image width and heightless than 700 px move directly
		$imgspath=$path.$error['name'].".".$error['ext'];
                
	        if( move_uploaded_file($_FILES['picture']['tmp_name'],$imgspath))
                {
                    $data=array(
                        "type"         => 1,
                        "external_id"  =>$id,
                        "filename"     =>$imagename
                    );
                    
                    $this->db->insert("photo",$data);
                    
                }
	    }
            else 
            {
                
               //image width and height is higher than 700 px resize
               
               $this->photo->resize($_FILES['picture'],699,699,$path,true);
               if(file_exists($path.$imagename))
               { 
                    
                    $data=array(
                        "type"         => 1,
                        "external_id"  =>$id,
                        "filename"     =>$imagename
                    );
                    
                    $this->db->insert("photo",$data);
               }
               
            }
        
             
           }
        
        }
    }
    
    public function getsanatid($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("videos");
        $result=$query->row();
        return $result->sanat_id;
    }
    public function getsanatphotoid($id)
    {
        $this->db->where("id",$id);
        $this->db->where("type",1);
        $query=$this->db->get("photo");
        $result=$query->row();
        return $result->external_id;
    }
    
    public function deletevideo($id)
    {
        $this->db->where("id",$id);
        $this->db->delete("videos");
    }
    
    public function getvideos($id)
    {
        $this->db->where("sanat_id",$id);
        $this->db->order_by("id","desc");
        $query=$this->db->get("videos");
        $data=array();
        if($query->num_rows()>0)
        {
            foreach($query->result() as $result)
            {
                $data[]=$result;
            }
            return (!empty($data))?$data:false;
        }
        return false;
    }
    
    public function update($id)
    {
        if($this->validateform())
        {
            
            if(isset($_FILES['picture']) && $_FILES['picture']['tmp_name'])
            {
                
                if(($error=$this->picerror()))
                {
                    
                    $path="public/images/sanatci/";
                    $this->movepic($path,$error);
                    
                    if(file_exists($path.$error['name'].".".$error['ext']) && $error)
                    {
                        
                        $picname=$this->getpicname($id);
                        @unlink("public/images/sanatci/{$picname}");
                        @unlink("public/images/sanatci/thumb_{$picname}");
                        $fullname=$error['name'].".".$error['ext'];
                        $data=array(

                            "firstname"     =>$this->input->post("firstname"),
                            "lastname"      =>$this->input->post("lastname"),
                            "picture"       =>$fullname,
                            "about"         =>$this->input->post("about")?$this->input->post("about"):"",
                            "year"          =>$this->input->post("year")?$this->input->post("year"):"",
                            "month"         =>$this->input->post("month")?$this->input->post("month"):"",
                            "day"           =>$this->input->post("day")?$this->input->post("day"):"",
                            "type"          =>$this->input->post("type")
                        );
                        $this->db->where("id",$id);
                        $this->db->update("sanatci",$data);
                        if($this->db->affected_rows()>0)
                        {
                           redirect("adminsanat/crop/{$id}");
                        }
                        return false;
                   }
                
                    return false;
                }
                
                return false;
            }
            else
            {
                
                 $data=array(
                    
                    "firstname"     =>$this->input->post("firstname"),
                    "lastname"      =>$this->input->post("lastname"),                    
                    "about"         =>$this->input->post("about")?$this->input->post("about"):"",
                    "year"          =>$this->input->post("year")?$this->input->post("year"):"",
                    "month"         =>$this->input->post("month")?$this->input->post("month"):"",
                    "day"           =>$this->input->post("day")?$this->input->post("day"):"",
                    "type"          =>$this->input->post("type")
                );
                
                 $this->db->where("id",$id);
                 $this->db->update("sanatci",$data);
                 return ($this->db->affected_rows()>0)?true:false;
                 
                
                
            }
        }
        return false;
    }
    
    public function deletephoto($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("photo");
        if($query->num_rows()>0)
        {
            $result=$query->row();
            
            $filename=$result->filename;
            
            if(file_exists("public/images/sanatci/{$filename}"))
            {
                @unlink("public/images/sanatci/{$filename}");
                $this->db->where("id",$id);
                $this->db->delete("photo");
            }
        }
    }
    
    
    public function getpicname($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("sanatci");
        return $query->row()->picture;
    }
    
    public function cropimage($id)
    {
        $this->load->library("Photo");
        $filename=$this->input->post("filename");
        $x=$this->input->post("x");
        $y=$this->input->post("y");
        $w=$this->input->post("w");
        $h=$this->input->post("h");
        $name="thumb_".substr($filename,0,strrpos($filename,"."));
        
        $ext=substr($filename,strrpos($filename,".")+1);
        $this->photo->setname($name);
        $this->photo->setext($ext);
        $imagename=$name.'.'.$ext;
        $image="public/images/sanatci/".$filename;
        $path="public/images/sanatci/";
        
        $this->photo->cropimage($image,300,200,$x,$y,$w,$h,$path,true);
        if(file_exists($path.$imagename))
        {
           
            return true;
        }
        else
        {
            echo 22222;die();
            
            return false;
        }
    }
    
   
    public function picerror()
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
        $data=array(
            "imagex" =>$imagex,
            "imagey" => $imagey,
            "name"   =>$name,
            "ext"    =>$ext,
            "tmp_name" =>$tmp_name
        );
       
        if(!$tmp_name || $picerror!=0 || !in_array(strtolower($ext), $allowedext))
        {
            $error[]="picture upload error";
           
            
        }
        if($imagex<300 || $imagey<300)
        {
            $error[]="Image width and height must be at least 300px";
            
            
        }
        return (empty($error))?$data:false;
        
    }
    
    
    public function movepic($path,$error)
    {
            $this->load->library("Photo");
            $this->photo->setname($error['name']);
            $this->photo->setext($error['ext']);
            
            
            if($error['imagex']<700|| $error['imagey']<700)
            {    //if image width and heightless than 700 px move directly
		$imgspath=$path.$error['name'].".".$error['ext'];
	         move_uploaded_file($_FILES['picture']['tmp_name'],$imgspath);
	    }
            else 
            {
               //image width and height is higher than 700 px resize  
               $this->photo->resize($_FILES['picture'],699,699,$path,true);
            }
        
    }
    public function checkpic()
    {   
        $error=$this->picerror();
       
        if(count($error)>0)
        {
            
            //there is no error
            $path="public/images/sanatci/";
            $this->movepic($path,$error);
            
            
            
            
            if(file_exists($path.$error['name'].".".$error['ext']) && $error)
            {
                
                
               $fullname=$error['name'].".".$error['ext'];
                $data=array(
                    
                    "firstname"     =>$this->input->post("firstname"),
                    "lastname"      =>$this->input->post("lastname"),
                    "picture"       =>$fullname,
                    "about"         =>$this->input->post("about")?$this->input->post("about"):"",
                    "year"          =>$this->input->post("year")?$this->input->post("year"):"",
                    "month"         =>$this->input->post("month")?$this->input->post("month"):"",
                    "day"           =>$this->input->post("day")?$this->input->post("day"):"",
                    "type"          =>$this->input->post("type")
                );
                
                
                 if($this->db->insert("sanatci",$data))
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
    
    public function getall()
    {
        $this->db->from("sanatci");
        $this->db->order_by("id","desc");
        $query=$this->db->get();
        return $query->result();
    }
    
    public function get($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("sanatci");
        return ($query->num_rows()>0)?$query->row():false;
    }
    
    
    public function edit()
    {
        
    }
    
    public function delete()
    {
        
    }
    
}
