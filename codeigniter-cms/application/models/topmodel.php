<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topmodel extends CI_Model {
    
    
    public function editlist($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("name","Sanatci adi","trim|required");
        $this->form_validation->set_rules("title","Parca ismi","trim|required");
        $this->form_validation->set_rules("youtube","Youtube Address","trim|required");
        $this->form_validation->set_rules("sira","Sira","trim|required|integer|max_length[2]");
        
        if($this->form_validation->run())
        {
            
           if(isset($_FILES['picture']) && $_FILES['picture']['tmp_name'] && ($data=$this->picerror())) 
           {
              
               $path="public/images/top/";
               $this->movepic($path, $data);
               $imgname=$data['name'].".".$data['ext'];
               
               if(file_exists($path.$imgname))
               {
                    
                   $image=$this->getone($id);
                   $filepath=$path.$image->picture;
                   $thumfile=$path."thumb_".$image->picture;
                   @unlink($filepath);
                   @unlink($thumfile);
                    $data=array(
                                "name"      =>$this->input->post("name"),
                                "title"     =>$this->input->post("title"),
                                "youtube"   =>$this->input->post("youtube"),
                                "sira"      =>$this->input->post("sira"),
                                "picture"   =>$imgname
                            );
               
                    $this->db->where("id",$id);
                    $this->db->update("top",$data);
                    redirect(base_url()."top/cropimage/{$id}");
               }
               redirect(base_url()."top");
                
               
               
               
               
               
               
           }
           elseif(!$_FILES['picture']['tmp_name'])
           {
               $data=array(
                   "name"      =>$this->input->post("name"),
                   "title"     =>$this->input->post("title"),
                   "youtube"   =>$this->input->post("youtube"),
                   "sira"      =>$this->input->post("sira")
               );
               
               $this->db->where("id",$id);
               $this->db->update("top",$data);
           }
        }
        
        redirect(base_url()."top");
    }
    
    
    public function cropartist($id)
    {
        $this->load->library("Photo");
        $filename=$this->input->post("photoname");
       
        $x=$this->input->post("x");
        $y=$this->input->post("y");
        $w=$this->input->post("w");
        $h=$this->input->post("h");
        $name="thumb_".substr($filename,0,strrpos($filename,"."));
        
        $ext=substr($filename,strrpos($filename,".")+1);
        $this->photo->setname($name);
        $this->photo->setext($ext);
        $imagename=$name.'.'.$ext;
        $image="public/images/top/".$filename;
        $path="public/images/top/";
        
        $this->photo->cropimage($image,300,200,$x,$y,$w,$h,$path,true);
        
        if(file_exists($path.$imagename))
        {
           
            redirect(base_url()."top");
        }
        else
        {
          
           redirect(base_url()."top");
        }
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
    
    
    public function get()
    {
        $this->db->from("top");
        $this->db->order_by("sira","asc");
        $query=$this->db->get();
        
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
    
    
    public function getone($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("top");
        
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        return false;
    }
    
    
   
    
    
    
}