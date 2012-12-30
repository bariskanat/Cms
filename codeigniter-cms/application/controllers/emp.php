<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emp extends CI_Controller {
    
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
         $data["value"]="empview";
         $this->load->model("empmodel");
         $data['calisan']=$this->empmodel->getemp();
         $this->load->view("admintemplate",$data);
    }
    
    
    public function add()
    {
        $this->load->model("empmodel");
        $this->empmodel->add();
        $this->index();     
       
    }
    
    
    public function edit($id)
    {
        $data=array();
        $data["value"]="empedit";
        $this->load->model("empmodel");
        $data['emp']=$this->empmodel->get($id);
        $this->load->view("admintemplate",$data);
    }
    
    public function editemp($id)
    {
        $this->load->model("empmodel");
        $this->empmodel->editemp($id);
        redirect(base_url()."emp");
    }
    
    
    public function crop($id)
    {
        $data=array();
        $data["value"]="empcrop";
        $this->load->model("empmodel");
        $data['photo']=$this->empmodel->getphoto($id);
        $this->load->view("admintemplate",$data);
    }
    
    public function delete($id)
    {
          $this->load->model("empmodel");
          $this->empmodel->delete($id);
          redirect(base_url()."emp");
    }
    
    
    public function cropimage($id)
    {
        $this->load->model("empmodel");
        $this->empmodel->cropimage($id);
        redirect(base_url()."emp");
    }
}