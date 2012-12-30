<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	
	public function index()
	{

             $data["value"]="admin_index";
             $this->load->view("admintemplate",$data);
		
	}
        
        
        public function logout()
        {
            $this->session->sess_destroy();
            redirect("admin");
            
        }
        
        
        
        
        public function check()
        {
            $this->load->model("adminmodel");
            $result=$this->adminmodel->validate();
            if($result)
            {
                redirect("admin/members");
            }
            else
            {
                redirect("admin");
            }
        }
        
        
        public function members()
        {
            if($this->session->userdata("loggedin")!=1)
            {
                $this->session->sess_destroy();
                $this->index();
            }
            else
            {
                if($this->session->userdata("atype")==1)
                {
                    redirect("emplo");
                }
                else
                {
                    $this->loadmain();
                }
            }
        }
        
        
        public function loadmain()
        {
            $data['value']="admin_main";
            $this->load->view("admintemplate",$data);
            
        }
        
        
        
}

?>