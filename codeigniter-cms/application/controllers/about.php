<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class About extends CI_Controller {
    
    public function index()
    {
        $this->load->model("aboutmodel");       
        $data['menu']="about";        
        $data['value']="aboutview";
        $data['mainmenu']="about";
        $this->load->view("templateview",$data);
    }
    
    
    public function emp()
    {
        $this->load->model("aboutmodel");
        $data['emp']=$this->aboutmodel->get();
        $data['menu']="emp";
        $data['value']="aboutview";
        $data['mainmenu']="about";
        $this->load->view("templateview",$data);
    }
}
