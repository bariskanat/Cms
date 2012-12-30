<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminhaber extends CI_Controller {
    
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
    
    public function edit($id)
    {
        $this->load->model("adminhabermodel");
        $data['haber'] =$this->adminhabermodel->getbyid($id);
        if($data['haber']==false)
        {
            redirect("adminhaber");
        }
        $data['value'] = "adminhabereditview";
        $this->load->view("admintemplate",$data);
    }
    public function editnews($id)
    {
        $this->load->model("adminhabermodel");
        $this->adminhabermodel->editnews($id);
        redirect("adminhaber");
    }
    
    
    public function deletenews($id)
    {
        $this->load->model("adminhabermodel");
        $this->adminhabermodel->deletenews($id);
        redirect("adminhaber");
    } 
          
    
    public function crop($id)
    {
        $this->load->model("adminhabermodel");
        $data['id']=$id;
        $data['filename']=$this->adminhabermodel->getfilename($id);
        $data['value']="adminhabercropview";
        $this->load->view("admintemplate",$data);
        
    }
    
    
    public function cropimage($id)
    {
        $this->load->model("adminhabermodel");
        $this->adminhabermodel->cropimage($id);
        redirect("adminhaber");
    }
    
    
    public function add()
    {
       $this->load->model("adminhabermodel");
       if(($id=$this->adminhabermodel->add()))
       {
           //redirect to crop section
           redirect("adminhaber/crop/{$id}");
       }
       redirect("adminhaber");
    }
    
    
    public function index()
    {
        $this->load->model("adminhabermodel");
        $data['value']="adminhaberview";
        $data['haber']=$this->adminhabermodel->getall();
        $this->load->view("admintemplate",$data);
    }
}