<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminyayinmodel extends CI_Model {
    
    public function add()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title","Title","trim|required");
        $this->form_validation->set_rules("year","Year","trim|required|min_length[4]|integer|max_length[4]");
        $this->form_validation->set_rules("month","Month","trim|required|integer|max_length[2]");
        $this->form_validation->set_rules("day","Day","trim|required|integer|max_length[2]");
        
        if($this->form_validation->run())
        {
            
            $this->uploadaudio();
        }
        else
        {
            
            return false;
        }
    }
    
    public function uploadaudio()
    {
        
        if(isset($_FILES["music"]['tmp_name']))
        {
            
            $name=md5(uniqid(rand(),true).time());
            $config['upload_path'] = 'public/audio/';
            $config['allowed_types'] = 'wav|mp3|wma|ram|rm|mpga|mid|midi';        
            $config['file_name']  = $name;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("music"))
            {

                return false;
            }
            else
            {
                
                $result=$this->upload->data();
                
                $data=array(
                   "title"      =>$this->input->post("title"),
                   "year"       =>$this->input->post("year"),
                   "month"      =>$this->input->post("month"),
                   "day"        =>$this->input->post("day"),
                   "filename"   =>$result['file_name']
                    
                );
                
                $this->db->insert("audio",$data);                
                return;
            }
        }
        else 
        {
            return;
        }
        
    }
    
    public function delete($id)
    {
        $filename=$this->getfilename($id);
        $path="public/audio/{$filename}";
        @unlink($path);
        if(!file_exists($path))
        {
            $this->db->where("id",$id);
            $this->db->delete("audio");
        }
    }
    
    
    public function update($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title","Title","trim|required");
        $this->form_validation->set_rules("year","Year","trim|required|min_length[4]|integer|max_length[4]");
        $this->form_validation->set_rules("month","Month","trim|required|integer|max_length[2]");
        $this->form_validation->set_rules("day","Day","trim|required|integer|max_length[2]");
        
        if($this->form_validation->run())
        {
                if(isset($_FILES['music']) && $_FILES['music']['tmp_name'] )
                {
                    $name=md5(uniqid(rand(),true).time());
                    $config['upload_path'] = 'public/audio/';
                    $config['allowed_types'] = 'wav|mp3|wma|ram|rm|mpga|mid|midi';        
                    $config['file_name']  = $name;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload("music"))
                    {

                        return ;
                    }
                    else
                    {

                        $result=$this->upload->data();
                        $file=$this->getyayin($id);
                        @unlink($file->filename);

                        $data=array(
                        "title"      =>$this->input->post("title"),
                        "year"       =>$this->input->post("year"),
                        "month"      =>$this->input->post("month"),
                        "day"        =>$this->input->post("day"),
                        "filename"   =>$result['file_name']

                        );
                        $this->db->where("id",$id);
                        $this->db->update("audio",$data);                
                        return;
                    }
               }
               else
               {
                   $data=array(
                        "title"      =>$this->input->post("title"),
                        "year"       =>$this->input->post("year"),
                        "month"      =>$this->input->post("month"),
                        "day"        =>$this->input->post("day")
                       

                        );
                     $this->db->where("id",$id);
                     $this->db->update("audio",$data);                
                     return;
               }
            
        }
        else
        {
            
            return ;
        }
    }
    
    public function getyayin($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("audio");
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        return false;
    }
    
    public function edit($id)
    {
        
    }
    
    
    public function getfilename($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("audio");
        if($query->num_rows()==1)
        {
            $result=$query->row();
            return $result->filename;
        }
        return false;
    }
    
    
    public function get()
    {
        $this->db->from("audio");
        $this->db->order_by("id","desc");
        $query=$this->db->get();
        if($query->num_rows()>0)
        {
            $data=array();
            foreach($query->result() as $result)
            {
               $data[]=$result; 
            }
            
            return (!empty($data))?$data:false;
        }
        else
        {
            return false;
        }
    }
}
