<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminalbumcrop extends CI_Controller {
    private $album;
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
    
    public function mainpic($num)
    {
        $this->load->model("adminalbummodel");
        
        $data['filename']=$this->adminalbummodel->getcropphoto($num);
        $data['value']="adminmaincrop";
        $data['album']=$this->adminalbummodel->getalbumid($num);
        $data['id']=$num;
        $this->load->view("admintemplate",$data);
    }
    
    public function cropmain($id)
    {
        $this->load->model("adminalbummodel");
        $this->adminalbummodel->cropmain($id);
        $albumid=$this->adminalbummodel->getalbumid($id);
        redirect("adminaddphoto/addphoto/{$albumid}");
    }
    
    
    public function index($num)
    {
        
        $this->load->model("adminalbummodel");
        
        $data['filename']=$this->adminalbummodel->getcropphoto($num);
        $data['value']="adminalabumcrop";
        $data['album']=$this->adminalbummodel->getalbumid($num);
        $data['id']=$num;
        $this->load->view("admintemplate",$data);
        
        
    }
    
    public function crop($id)
    {
        $this->load->model("adminalbummodel");
        $this->adminalbummodel->crop($id);
        $albumid=$this->adminalbummodel->getalbumid($id);
        redirect("adminaddphoto/addphoto/{$albumid}");
        
        
    }
}