<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
    
    public function index()
    {
        $this->load->model("gallerymodel");
        $data['gallery']=$this->gallerymodel->get();
        
        $data['value']="gallery";
        $data['mainmenu']="gallery";
        $this->load->view("templateview",$data);
    }
    
    
    public function ajaxget()
    {
        $this->load->model("gallerymodel");
        return $this->gallerymodel->ajaxget();
    }
    
}
