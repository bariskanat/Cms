<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminsanat extends CI_Controller {
    
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
        $data['value'] = "adminsanatview";
        $this->load->view("admintemplate",$data);
    }
    
    
    public function add()    
    {
        
        $this->load->model("sanatmodel");
        $id=$this->sanatmodel->add();
        if(!$id)
        {
            $data['value'] = "adminsanatview";
            $this->load->view("admintemplate",$data);
        }
        else
        {
            redirect("adminsanat/crop/{$id}");
        }
        
    }
    
    public function cropimage($id)
    {
        $this->load->model("sanatmodel");
        
        if($this->sanatmodel->cropimage($id))
        {
            redirect("adminsanat/listsanat");
        }
        else
        {
           redirect("adminsanat") ;
        }
    }
    
    public function getvideo($id)
    {
        $this->load->model("sanatmodel");
        $data['info']=$this->sanatmodel->get($id);
        $data['videos']=$this->sanatmodel->getvideos($id);
        $data['value'] = "adminvideoview";
        $this->load->view("admintemplate",$data);
    }
    
    public function addvideo($id)
    {
        $this->load->model("sanatmodel");
        $this->sanatmodel->addvideo($id);
        $this->getvideo($id);
    }
    
    public function update($id)
    {
        $this->load->model("sanatmodel");
        $this->sanatmodel->update($id);
        $this->getsanatci($id);
        //redirect("adminsanat/getsanatci/{$id}");
    }
    
    
    public function getphoto($id)
    {
        $this->load->model("sanatmodel");
        $data['info']=$this->sanatmodel->get($id);
        $data['value'] = "adminsanatphotoview";
        $data['photos']=$this->sanatmodel->getphotos($id);
        $this->load->view("admintemplate",$data);
        
    }
    
    public function deletephoto($id)
    {
        $this->load->model("sanatmodel");
        $sanatid=$this->sanatmodel->getsanatphotoid($id);  
        $this->sanatmodel->deletephoto($id);
         redirect("adminsanat/getphoto/{$sanatid}");
        
    }
    public function deletevideo($id)
    {
        $this->load->model("sanatmodel");
        $sanatid=$this->sanatmodel->getsanatid($id);        
        $this->sanatmodel->deletevideo($id);
        $this->getvideo($sanatid);
    }
    
    public function addphoto($id)
    {
        $this->load->model("sanatmodel");
        $this->sanatmodel->addphoto($id);        
        redirect("adminsanat/getphoto/{$id}");
    }
    
    public function getsanatci($id)
    {
        $this->load->model("sanatmodel");
        $data['info']=$this->sanatmodel->get($id);
        $data['value'] = "adminsanatciview";
        $this->load->view("admintemplate",$data);
    }
    
    public function listsanat()
    {
        $this->load->model("sanatmodel");
        $data['sanat']=$this->sanatmodel->getall();
        $data['value'] = "adminsanatlistview";
        $this->load->view("admintemplate",$data);
    }
    
    
    public function crop($id)
    {
         $this->load->model("sanatmodel");
         $data['filename']=$this->sanatmodel->getpicname($id);
         $data['id']=$id;
         $data['value'] = "adminsanatcropview";
         $this->load->view("admintemplate",$data);
    }
}

