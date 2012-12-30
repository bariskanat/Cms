<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminadd extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata("loggedin")==1)
        {
            if($this->session->userdata("atype")!=0)
            {
                redirect("adminsanat");
            }
            
        }
        else
        {
            redirect("admin");
        }
        
        
    }
    
    public function adduser()
    {
        $this->load->model("adminmodel");
        $this->adminmodel->adduser();
        $this->index();

    }
    
    public function delete()
    {
        $id=(int)$this->uri->segment(3);
        $this->load->model("adminmodel");
        $this->adminmodel->delete($id);
        redirect("adminadd");
        
    }
    
    public function index()
    {
         $data["value"]="adminadd_index";
         $this->load->model("adminmodel");
         $data['calisan']=$this->adminmodel->getemp();
         $this->load->view("admintemplate",$data);
    }
}