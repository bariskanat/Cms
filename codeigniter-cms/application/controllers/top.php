<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Top extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata("loggedin")!=1)
        {
            redirect("admin");
            
        }
        
        
        
    }
    
    
    public function index()
    {
        $this->load->model("topmodel");
        $data['list']=$this->topmodel->get();
        $data['value'] = "topview";
        $this->load->view("admintemplate",$data);
    }
    
    
    public function edit($id)
    {
        $this->load->model("topmodel");
        $data['list']=$this->topmodel->getone($id);
        $data['value'] = "topeditview";
        $this->load->view("admintemplate",$data);
    }
    
    
    public function cropimage($id)
    {
        $this->load->model("topmodel");
        $data['photo']=$this->topmodel->getone($id);
        $data['value'] = "topcropview";
        $this->load->view("admintemplate",$data); 
    }
    
    public function cropartist($id)
    {
        $this->load->model("topmodel");
        $this->topmodel->cropartist($id);
        redirect(base_url()."top");
        
    }
    
    
    
    
    public function editlist($id)
    {
         $this->load->model("topmodel");
         $this->topmodel->editlist($id);
         redirect(base_url()."top");
    }
}
