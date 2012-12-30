<?php

class Toplistmodel extends CI_Model{
    
    public function get()
    {
        $this->db->from("top");
        $this->db->order_by("sira","asc");
        $query=$this->db->get();
        
        if($query->result() > 0)
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
    
    
    public function getsanatci()
    {
        $sql="select * from `sanatci` order by rand() limit 3";
        $query=$this->db->query($sql);
        if($query->result() > 0)
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
    
    
    public function getalbums()
    {
        $sql="select `id`, `title` ,`picture`
              from `news`
              where `newcatgories` = 3
              limit 3";
        
         $query=$this->db->query($sql);
        if($query->result() > 0)
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
