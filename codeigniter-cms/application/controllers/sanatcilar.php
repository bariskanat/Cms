<?php

class Sanatcilar extends CI_Controller {
    
    public function index()
    {
        
        $this->load->model("sanat");        
        
        $data['sanatci']=$this->sanat->getall();
        
        $data['value']="sanatcilar";
        $data['mainmenu']="sanatcilar";
        $this->load->view("templateview",$data);
    }
    
    
    public function ajaxget()
    {
        $this->load->model("sanat");        
        
        return $this->sanat->ajaxget();
    }
    
}
      
