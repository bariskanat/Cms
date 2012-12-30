<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminalbum extends CI_Controller {
    
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
        $this->load->model("adminalbummodel");
        $data['albums']=$this->adminalbummodel->getall();        
        $data['value']="adminalbumview";
        $this->load->view("admintemplate",$data);
    }
    public function delete($num)
    {
        $num=(int)$num;
        $this->load->model("adminalbummodel");
        $this->adminalbummodel->delete($num);
        $this->index();
        
    }
    
    public function create()
    {
         $this->load->model("adminalbummodel");
         $this->adminalbummodel->addalbum();
         $this->index();
    }
    
}