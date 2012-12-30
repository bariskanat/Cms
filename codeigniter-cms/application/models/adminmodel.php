<?php

class Adminmodel extends CI_Model
{
    private $_salt="RT%^*gVFDHhfkhrgkjhjrghkj*jgfjkgfjgfjgfnmgkngkrkn454878/*><?";
    public function getall()
    {
        $query=$this->db->get("admin");
        
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        return false;
    }
    
    
    public function validate()
    {
        $this->db->where("username",$this->input->post("name",true));
        $this->db->where("password",$this->create_salt($this->input->post("password")));
        $q=$this->db->get("admin");
        if($q->num_rows()==1)
        {
          $data=array(
              "loggedin" =>1,
              "type" => $q->row()->atype
          );
          $this->session->set_userdata($data);
          return true;
        }
        else
        {
            return false;
        }
    }
    
    public function adduser()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[admin.username]');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[5]');
        
        if($this->form_validation->run())
        {
            $data=array(
                "username" =>$this->input->post("email"),
                "atype" => 1,
                "password" =>$this->create_salt($this->input->post("email"))
                
            );
            
            $this->db->insert("admin",$data);
        }
        
        return true;
    }
    
    
    public function delete($num)
    {
        $this->db->where("id",$num);
        $this->db->delete("admin");
    }
    
    
    public function getemp()
    {
        $this->db->where("atype",1);
        $q=$this->db->get("admin");
        $data=array();
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
               $data[]=$row; 
            }
            return (!empty($data))? $data:false;
        }
        return false;
    }
    
    
    private function create_salt($value)
    {
        return sha1($this->_salt.md5($value).$this->_salt);
    }
    
    
   
}
?>
