<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Yayinmodel extends CI_Model {
    
    public function get($year)
    {
        
   
        $sql="SELECT  `id` ,  `title` ,`year`,`month`,`day`, CAST( CONCAT(  `year` ,  `month` ,  `day` ) AS UNSIGNED ) AS  `tarih` 
              FROM  `audio` 
              WHERE `year` = {$year}
              ORDER BY  `tarih` DESC ";
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
}