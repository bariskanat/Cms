<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminreklammodel extends CI_Model {
    
    public function getreklam()
    {
        $this->db->from("reklam");
        $this->db->order_by("name","asc");
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
    
    public function add()
    {
       $this->load->library("form_validation");
       $this->form_validation->set_rules("name","Name","trim|required");
       $this->form_validation->set_rules("content","About","trim|required");
       $this->form_validation->set_rules("tlf","Telefon","trim|required");
       $this->form_validation->set_rules("address","Address","trim|required");
       if($this->form_validation->run())
       {
           $data=$this->uploadaudio();
           $picture=$this->picerror();
          
          if($data!=false && $picture!=false) 
          {
              if($check=$this->movepic($picture))
              {
                   extract($picture);
                   $path="public/images/reklam/";
                   if(file_exists($path.$name.".".$ext))
                    {
                        $imgname=$name.".".$ext;
                        $web=trim($this->input->post("web"));
                        $info=array(
                            "name"          =>$this->input->post("name"),
                            "telefon"       =>$this->input->post("tlf"),
                            "address"       =>$this->input->post("address"),
                            "content"       =>$this->input->post("content"),
                            "web"           =>$web,
                            "picture"       =>$imgname,
                            "audio"         =>$data['file_name']

                        );

                        $this->db->insert("reklam",$info);
                        $id=$this->db->insert_id();
                        redirect(base_url()."reklam/crop/{$id}");


                    }
                    else
                    {
                        redirect(base_url()."reklam");
                    }
            }
             
                          
          }
          else {
            redirect(base_url()."reklam");
          }
       }
       else
       {
           redirect(base_url()."reklam");
       }
    }
    
    public function cropimg($id)
    {
         $this->load->library("photo");
        $filename=$this->input->post("photoname");
        $x=$this->input->post("x");
        $y=$this->input->post("y");
        $w=$this->input->post("w");
        $h=$this->input->post("h");
        
        $name="thumb_".substr($filename,0,strrpos($filename,"."));        
        $ext=$ext=substr($filename,strrpos($filename,".")+1);
        $imagename=$name.'.'.$ext;
        $image="public/images/reklam/".$filename;        
        $path="public/images/reklam/";
        
        $this->photo->setname($name);
        $this->photo->setext($ext);
        
        $this->photo->cropimage($image,290,315,$x,$y,$w,$h,$path,true);
        if(file_exists($path.$imagename))
        {
           
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function movepic($picture)
    {
            extract($picture);
            $path="public/images/reklam/";
            $this->photo->setname($name);
            $this->photo->setext($ext);
            
            
            if($imagex<700|| $imagey<700)
            {    //if image width and heightless than 700 px move directly
		$imgspath="public/images/reklam/".$name.".".$ext;
	    	move_uploaded_file($_FILES['picture']['tmp_name'],$imgspath);
	       		
	    }
            else 
            {
               //image width and height is higher than 700 px resize  
               $this->photo->resize($_FILES['picture'],699,699,$path,true);
            }
            
            
            return (file_exists($path.$name.".".$ext))?true:false;
    }
    public function edit($id)
    {
       $this->load->library("form_validation");
       $this->form_validation->set_rules("name","Name","trim|required");
       $this->form_validation->set_rules("content","About","trim|required");
       $this->form_validation->set_rules("tlf","Telefon","trim|required");
       $this->form_validation->set_rules("address","Address","trim|required");
       if($this->form_validation->run())
       {
          
          if(!empty($_FILES['picture']['tmp_name'])&& !empty($_FILES['audio']['tmp_name']))
          {
              
              $picture=$this->picerror();
              $info=$this->uploadaudio();
              $check=$this->movepic($picture);
              if($info!=false && $check!=false)
              {
                  extract($picture);
                  $filepath=$this->get($id);
                  $web=trim($this->input->post("web"));
                  @unlink("public/images/reklam/{$filepath->picture}");
                  @unlink("public/images/reklam/thumb_{$filepath->picture}");
                  @unlink("public/audio/reklam/{$filepath->audio}");
                  $data=array(
                            "name"          =>$this->input->post("name"),
                            "telefon"       =>$this->input->post("tlf"),
                            "address"       =>$this->input->post("address"),
                            "content"       =>$this->input->post("content"),
                            "web"           =>$web,
                            "picture"         =>$name.".".$ext,
                            "audio"         =>$info['file_name']

                        );
                        $this->updatereklam($id, $data);
                        redirect(base_url()."reklam/crop/{$id}");
                  
              }
              
              
              
          }elseif(!empty($_FILES['picture']['tmp_name']))
          {
              
              
              $picture=$this->picerror();
              
              if($picture!=false)
              {
                  if(($check=$this->movepic($picture)))
                  {
                      $filepath=$this->get($id);
                      @unlink("public/images/reklam/{$filepath->picture}");
                      @unlink("public/images/reklam/thumb_{$filepath->picture}");
                       extract($picture);
                       $web=trim($this->input->post("web"));
                        $data=array(
                            "name"          =>$this->input->post("name"),
                            "telefon"       =>$this->input->post("tlf"),
                            "address"       =>$this->input->post("address"),
                            "content"       =>$this->input->post("content"),
                            "web"           =>$web,
                            "picture"         =>$name.".".$ext

                        );
                        $this->updatereklam($id, $data);
                        redirect(base_url()."reklam/crop/{$id}");
                  }
                 
                  
                  
              }
              
              
          }elseif(!empty($_FILES['audio']['tmp_name']))
          {
              $info=$this->uploadaudio();
              $file=$this->get($id);
              $filename=$info['file_name'];
              
              if($info!=false)
              {
                  $web=trim($this->input->post("web"));
                  @unlink("public/audio/reklam/{$file->audio}");
                  $data=array(
                    "name"          =>$this->input->post("name"),
                    "telefon"       =>$this->input->post("tlf"),
                    "address"       =>$this->input->post("address"),
                    "content"       =>$this->input->post("content"),
                    "web"           =>$web,
                    "audio"         =>$filename
                    
                );
                $this->updatereklam($id, $data);
               
                  
              }
              
              
              
          }else
          {
              $web=trim($this->input->post("web"));
                $data=array(
                    "name"          =>$this->input->post("name"),
                    "telefon"       =>$this->input->post("tlf"),
                    "address"       =>$this->input->post("address"),
                    "content"       =>$this->input->post("content")  ,
                    "web"           =>$web
                    
                );
                $this->updatereklam($id, $data);
          }
       }
    }   
    
    
    public function updatereklam($id,$data)
    {
        $this->db->where("id",$id);
        $this->db->update("reklam",$data);
    }
    
    
    
    
    public function getall()
    {
        $this->db->from("reklam");
        $this->db->order_by("id","desc");
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
    
    
    public function get($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("reklam");
      
        
        if($query->num_rows()==1)
        {
            
            return $query->row();
        }
        
        return false;
    }
    
    public function crop($id)
    {
        
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
        if($imagex<400 || $imagey<400)
        {
            $error[]="Image width and height must be at least 400px";
            
            
        }
        return (empty($error))?$data:false;
        
    }
    
    
    public function uploadaudio()
    {
        
           if(isset($_FILES['audio']['tmp_name']))
           {
               
                $name=md5(uniqid(rand(),true).time());
                $config['upload_path'] = 'public/audio/reklam/';
                $config['allowed_types'] = 'wav|mp3|wma|ram|rm|mpga|mid|midi';        
                $config['file_name']  = $name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("audio"))
                {

                    return false;
                }
                else
                { 
                    
                    return $this->upload->data();
                   
                    
                }

           }
           
           return false;
          
    }
 }
