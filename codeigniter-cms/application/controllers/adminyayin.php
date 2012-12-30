<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminyayin extends CI_Controller {
   
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
    
    public function index()
    {
        $data['value']="adminyayin";
        $this->load->model("adminyayinmodel");
        $data['yayin']=$this->adminyayinmodel->get();
        $this->load->view("admintemplate",$data);
    }
    
    public function delete($id)
    {
        $this->load->model("adminyayinmodel");
        $this->adminyayinmodel->delete($id);
        redirect("adminyayin");
        
    }
    
    public function add()
    {
       $this->load->model("adminyayinmodel") ;
       $this->adminyayinmodel->add();
       redirect("adminyayin");
    }
    
    
    public function update($id)
    {
       $this->load->model("adminyayinmodel") ;
       $this->adminyayinmodel->update($id);
       redirect("adminyayin");
    }
    
   
    
    
    public function edit($id)
    {
        $data['value']="adminyayinedit";
        $this->load->model("adminyayinmodel");
        $data['yayin']=$this->adminyayinmodel->getyayin($id);
        $this->load->view("admintemplate",$data);
    }
}
