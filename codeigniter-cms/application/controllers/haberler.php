<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Haberler extends CI_Controller {
    
    public function index()
    {
        $this->load->model("habermodel");
        $data['haber']=$this->habermodel->get();
        $data['cat']="all";
        
        $data['value']="haberler";
        $data['mainmenu']="haberler";
        $this->load->view("templateview",$data);
    }
    
    
    public function music()
    {
        $this->load->model("habermodel");
        $data['haber']=$this->habermodel->music();
        $data['cat']="0";
        
        $data['value']="haberler";
        $data['mainmenu']="haberler";
        $this->load->view("templateview",$data);
    }
    
    public function magazin()
    {
        $this->load->model("habermodel");
        $data['haber']=$this->habermodel->magazin();
        $data['cat']="1";
        $data['value']="haberler";
        $data['mainmenu']="haberler";
        $this->load->view("templateview",$data);
    }
    
    
    public function albums()
    {
        $this->load->model("habermodel");
        $data['haber']=$this->habermodel->albums();
         $data['cat']="3";
        $data['value']="haberler";
        $data['mainmenu']="haberler";
        $this->load->view("templateview",$data); 
    }
    
    
    public function ajaxget()
    {
        
        $this->load->model("habermodel");
        return $this->habermodel->ajaxget();
        
    }
    
    
    public function roportaj()
    {
        $this->load->model("habermodel");
        $data['haber']=$this->habermodel->roportaj();
         $data['cat']="2";
        $data['value']="haberler";
        $data['mainmenu']="haberler";
        $this->load->view("templateview",$data); 
    }
    
}