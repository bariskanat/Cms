<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reklam extends CI_Controller {
    
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
    
    
    public function crop($id)
    {
        $id=(int)$id;
        $this->load->model("adminreklammodel");
        $this->adminreklammodel->crop($id);
        $data['picture'] =$this->adminreklammodel->get($id);
        $data['value'] = "reklamcrop";
        $this->load->view("admintemplate",$data); 
    }
    
    public function cropimg($id)
    {
        $id=(int)$id;
        $this->load->model("adminreklammodel");
        $this->adminreklammodel->cropimg($id);
        $this->index();
    }
    
    
    public function editreklam($id)
    {
        $id=(int)$id;
        $this->load->model("adminreklammodel");  
        $this->adminreklammodel->edit($id);
        $this->index();
    }
    
    
    public function edit($id)
    {
        $id=(int)$id;
        $this->load->model("adminreklammodel");
        $data['info']=$this->adminreklammodel->get($id);
        $data['value']="reklamedit";
        $this->load->view("admintemplate",$data); 
    }
    
    public function index()
    {
        $this->load->model("adminreklammodel");
        $data['all']=$this->adminreklammodel->getall();
        $data['value'] = "adminreklam";
        $this->load->view("admintemplate",$data);
    }    
    
    public function add()
    {
        $this->load->model("adminreklammodel");
        $this->adminreklammodel->add();
    }
}