<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reklamlar extends CI_Controller {
    
    public function index()
    {
        $this->load->model("adminreklammodel");
        $data['all']=$this->adminreklammodel->getreklam();
        
        $data['value']="reklamlar";
        $data['mainmenu']="reklamlar";
        $this->load->view("templateview",$data);
    }
}
