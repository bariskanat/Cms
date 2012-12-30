<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminalbummodel extends CI_Model {
    
    public function getall()
    {
        $query=$this->db->query("select * from `albums` order by `id` desc");
        $result=array();
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
            {
             
                $result[]=array(
                    'id'      => $row->id,
                    'title'   =>$row->title,
                    'number'  => $this->allphoto($row->id)

                );
            }

            return (!empty($result))?$result:false;
            
        }
        
        return false;
        
    }
    
    
    private function allphoto($num)
    {
        $num=(int)$num;
       $query=$this->db->query("select count(`id`) as `num` from `photo` where `external_id` = {$num} and type  = 0 ");
       return $query->row()->num;
    }
    
    
    public function addalbum()
    {
        
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title","Album Title","trim|required|is_unique[albums.title]");
        
        if($this->form_validation->run()!=false)
        {
           $data=array(
            
                    "title" =>$this->input->post("title")
             );
     
            if($this->db->insert("albums",$data))
            {
                mkdir("public/images/".$this->db->insert_id(),0777);
            }
        }
         
        
        
    }
    
    
    public function getphoto($num)
    {
        $this->db->where("external_id",$num);
        $this->db->where("type",0);
        $query=$this->db->get("photo");
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
    
    
    public function deletephoto($num)
    {
        $filename=$this->getcropphoto($num);
        $albumid=$this->getalbumid($num); 
        $this->db->where("id",$num);
        if($this->db->delete("photo"))
        {
            
            $path="public/images/{$albumid}/{$filename}";
            @unlink($path);
            $thumpath="public/images/{$albumid}/thumb_{$filename}";
            unlink($thumpath);
            
        }
      
        return $albumid;
               
              
    }
    
    
    public function getcropphoto($num)
    {
        $num=(int)$num;        
        $this->db->where("id",$num);
        $query=$this->db->get("photo");
        $result=$query->row();
        
       return $result->filename;
    }
    
    
    public function getalbumid($num)
    {
        $num=(int)$num;       
        $this->db->where("id",$num);
        $query=$this->db->get("photo");
        $result=$query->row();
       return $result->external_id;
    }
    
    public function cropmain($id)
    {
        $albumid=$this->getalbumid($id);
       
        $this->load->library("photo");
        $filename=$this->input->post("photoname");
       
        $name="thumb_".substr($filename,0,strrpos($filename,"."));
        
        $ext=$ext=substr($filename,strrpos($filename,".")+1);
        $imagename=$name.'.'.$ext;
        $image="public/images/".$albumid."/".$filename;
        
        $path="public/images/".$albumid."/";
        $x=$this->input->post("x");
        $y=$this->input->post("y");
        $w=$this->input->post("w");
        $h=$this->input->post("h");
        $this->photo->setname($name);
        $this->photo->setext($ext);
        
        $this->photo->cropimage($image,570,250,$x,$y,$w,$h,$path,true);
        if(file_exists($path.$imagename))
        {
           
            return true;
        }
        else
        {
          
            
            return false;
        }
    }


    public function crop($id)
    {
        
       $albumid=$this->getalbumid($id);
       
        $this->load->library("photo");
        $filename=$this->input->post("photoname");
       
        $name="thumb_".substr($filename,0,strrpos($filename,"."));
        
        $ext=$ext=substr($filename,strrpos($filename,".")+1);
        $imagename=$name.'.'.$ext;
        $image="public/images/".$albumid."/".$filename;
        
        $path="public/images/".$albumid."/";
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
    
    
    public function delete($num)
    {
        $this->db->where("id",$num);
        if($this->db->delete("albums"))
        {
           return  $this->_removedir("public/images/{$num}");
            
        }
        return false;
    }
    
   function _removedir($path)
   {
       if(!is_dir($path)) return false;
        
        foreach(scandir($path) as $a)
        {
            if ('.' === $a || '..' === $a) continue;
            if (is_dir("$path/$a")) $this->_removedir("$path/$a");
            else unlink ("$path/$a");
        }
        
        return rmdir($path);
   }
    
}
