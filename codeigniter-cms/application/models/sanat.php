<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sanat extends CI_Model {
    
    
    public function get($id)
    {
        
        $this->db->where("id",$id);
        $query=$this->db->get("sanatci");
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        
        return false;
        
    }
    
    
    public function ajaxget()
    {
        $lastid=$this->input->post("dataid");
        $sql="select * from `sanatci` 
              where `id` < {$lastid} 
              order by `id` desc
              limit 20";
        $query=$this->db->query($sql);
        
        if($query->num_rows()>0)
        {
            $data="";
            
            foreach($query->result() as $row)
            {
                $url= base_url()."sanatci/show/{$row->id}";
                $imgsrc=base_url()."public/images/sanatci/thumb_{$row->picture}";
                $name=$row->firstname." ".$row->lastname;
                
                $data.="<div class=\"gall\" data-id=\"{$row->id}\">
                    <a href=\"{$url}\">
                        <img src=\"{$imgsrc}\">
                        <span>{$name}</span>
                    </a>
                </div>";
            }
            
            echo $data;
        }
        
    }
    
    
    public function getall()
    {
        $this->db->from("sanatci");
        $this->db->order_by("id","desc");
        $this->db->limit(20);
        $query=$this->db->get();
        if($query->num_rows()>0)
        {
            $data=array();
            foreach($query->result() as $row )
            {
                $data[]=$row;
            }
            
            return (!empty($data))?$data:false;
        }
        
        return false;
    }
    
    
    public function getother($id)
    {
        $sql="SELECT * FROM `sanatci`
              where `id` != {$id}
              order by rand()
              limit 6             
              ";
         
         return $this->returnresult($sql);
    }
    
    public function getvideo($id)
    {
        $sql="select `parcaname`,`youtube` 
              from `videos` 
              where `sanat_id` = {$id}
              order by `id` desc
              limit 40
              ";
        return $this->returnresult($sql);
    }
    
    public function getphoto($id)
    {
        $sql="select `id`,`filename` from `photo`
              where `external_id` = {$id} and `type` = 1
              order by `id` desc
              limit 40";
         
         return $this->returnresult($sql);
    }
    
    public function returnresult($sql)
    {
        $query=$this->db->query($sql);
        
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
    
}