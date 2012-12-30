<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aboutmodel extends CI_Model {
    
    public function get()
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
}