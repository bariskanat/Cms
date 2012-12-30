<?php

class Sanatci extends CI_Controller {
    
    public function show($id,$type=null)
    {
        $id=(int)$id;
        $this->load->model("sanat");
        if($type==null)
        {
           $data['photos']=$this->sanat->getphoto($id);
        }
        else if($type=="video")
        {
           $data['videos']=$this->sanat->getvideo($id); 
        }
        
        $data['sanatci']=$this->sanat->get($id);
        $data['sanatciinfo']=$this->sanat->get($id);
        $data['other']=$this->sanat->getother($id);
        $data['value']="sanatci";
        $this->load->view("templateview",$data);
    }
    
    
   
    
}
