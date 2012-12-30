<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empmodel extends CI_Model {
    
    
    public function add()
    {
        
        if($this->validateform())
        {
            if(isset($_FILES['picture']) && $_FILES['picture']['tmp_name'] && ($data=$this->checkpic()))
            {
                
                $this->load->library("Photo");
                $this->photo->setname($data['name']);
                $this->photo->setext($data['ext']);
                $imagename=$data['name'].".".$data['ext'];
                $path="public/images/emp/";
                
            if($data['imagex']<700|| $data['imagey']<700)
            {    //if image width and heightless than 700 px move directly
		$imgspath=$path.$data['name'].".".$data['ext'];
                
	        if( move_uploaded_file($_FILES['picture']['tmp_name'],$imgspath))
                {
                    $insertdata=array(
                        "firstname"        => $this->input->post("firstname"),
                        "lastname"         =>$this->input->post("lastname"),
                        "title"            =>$this->input->post("gorev"),
                        "content"          =>$this->input->post("about"),
                        "picture"           =>$imagename
                    );
                    
                    if($this->db->insert("employee",$insertdata))
                    {
                     redirect(base_url()."emp/crop/{$this->db->insert_id()}")  ; 
                    }else{return false;}
                    
                }
	    }
            else 
            {
                
               //image width and height is higher than 700 px resize
               
               $this->photo->resize($_FILES['picture'],699,699,$path,true);
               if(file_exists($path.$imagename))
               { 
                    
                    $insertdata=array(
                        "firstname"        => $this->input->post("firstname"),
                        "lastname"         =>$this->input->post("lastname"),
                        "title"            =>$this->input->post("gorev"),
                        "content"          =>$this->input->post("about"),
                        "picture"            =>$imagename
                    );
                    
                    if($this->db->insert("employee",$insertdata))
                    {
                        redirect(base_url()."emp/crop/{$this->db->insert_id()}")  ; 
                    }else{return false;}
                    
               }
               
            }
                
                
                
                
                
                
                
            }
            return false;
        }
        return false;
        
    }
    
    public function cropimage($id)
    {
       
       
        $this->load->library("photo");
        $filename=$this->input->post("photoname");
       
        $name="thumb_".substr($filename,0,strrpos($filename,"."));
        
        $ext=$ext=substr($filename,strrpos($filename,".")+1);
        $imagename=$name.'.'.$ext;
        $image="public/images/emp/".$filename;
        
        $path="public/images/emp/";
        $x=$this->input->post("x");
        $y=$this->input->post("y");
        $w=$this->input->post("w");
        $h=$this->input->post("h");
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
    
    
    public function getemp()
    {
        $query=$this->db->get("employee");
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
    
    
    public function get($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("employee");
        
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        return false;
    }
    
    
    public function getphoto($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("employee");
        return ($query->num_rows()>0)?$query->row():false;
    }
    
    private function validateform()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("firstname","Firstname","trim|required");
        $this->form_validation->set_rules("lastname","Lastname","trim|required");
        $this->form_validation->set_rules("gorev","Gorev","trim|required");
        $this->form_validation->set_rules("about","About","trim|required");
        
        return ($this->form_validation->run())?true:false;
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
    
    public function editemp($id)
    {
        if($this->validateform())
        {
            if($_FILES['picture']['tmp_name'])
            {
                if(($data=$this->checkpic()))
                {
                     
                    $this->load->library("Photo");
                    $this->photo->setname($data['name']);
                    $this->photo->setext($data['ext']);
                    $imagename=$data['name'].".".$data['ext'];
                    $path="public/images/emp/";
                    
                    if($data['imagex']<700|| $data['imagey']<700)
                    {    //if image width and heightless than 700 px move directly
                        $imgspath=$path.$data['name'].".".$data['ext'];

                        if( move_uploaded_file($_FILES['picture']['tmp_name'],$imgspath))
                        {
                            $insertdata=array(
                                "firstname"        => $this->input->post("firstname"),
                                "lastname"         =>$this->input->post("lastname"),
                                "title"            =>$this->input->post("gorev"),
                                "content"          =>$this->input->post("about"),
                                "picture"           =>$imagename
                            );
                            $pic=$this->get($id);
                            $resimpath="public/images/emp/{$pic->picture}";
                            $smallresim="public/images/emp/thumb_{$pic->picture}";
                            @unlink($resimpath);
                            @unlink($smallresim);
                            $this->db->where("id",$id);
                            if($this->db->update("employee",$insertdata))
                            {
                            redirect(base_url()."emp/crop/{$id}")  ; 
                            }else{return ;}

                        }
                    }else
                    {
                        
                            $this->photo->resize($_FILES['picture'],699,699,$path,true);
                            if(file_exists($path.$imagename))
                            { 

                                    $insertdata=array(
                                        "firstname"        => $this->input->post("firstname"),
                                        "lastname"         =>$this->input->post("lastname"),
                                        "title"            =>$this->input->post("gorev"),
                                        "content"          =>$this->input->post("about"),
                                        "picture"          =>$imagename
                                    );
                                    
                                    $pic=$this->get($id);
                                    $resimpath="public/images/emp/{$pic->picture}";
                                    $smallresim="public/images/emp/thumb_{$pic->picture}";
                                    @unlink($resimpath);
                                    @unlink($smallresim);
                                    $this->db->where("id",$id);
                                    if($this->db->update("employee",$insertdata))
                                    {
                                        redirect(base_url()."emp/crop/{$id}")  ; 
                                    }else{return ;}

                            }



                    }

                    
                }else{return;}
            }
            else
            {
                 $insertdata=array(
                        "firstname"        => $this->input->post("firstname"),
                        "lastname"         =>$this->input->post("lastname"),
                        "title"            =>$this->input->post("gorev"),
                        "content"          =>$this->input->post("about")
                        
                    );
                 $this->db->where("id",$id);
                 $this->db->update("employee",$insertdata);
            }
        }
    }
    
    
    public function delete($id)
    {
        $row=$this->get($id);
        if($row)
        {
           $path ="public/images/emp/{$row->picture}";
           $thumbpath="public/images/emp/thumb_{$row->picture}";
           if(file_exists($path))
           {
               @unlink($path);
               @unlink($thumbpath);
               $this->db->where("id",$row->id);
               $this->db->delete("employee");
           }
        }
    }
    
    
    public function edit($id)
    {
        
    }
}
