<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Yayin extends CI_Controller {
    
    
    public function index()
    {
        $this->show();
    }
    public function show($year=2012)
    {
        $year=(int)$year;
        $this->load->model("yayinmodel");
        $data['yayin']=$this->yayinmodel->get($year);
        $data['menu']=$year;
        $data['value']="yayinview";
        $data['mainmenu']="yayin";
        $this->load->view("templateview",$data);
    }
    
    
    public function dinle($id)
    {
        $id=(int)$id;
        $this->load->model("yayinmodel");
        $data['yayin']=$this->yayinmodel->getyayin($id);
        $data['value']="yayintekview";
        $this->load->view("templateview",$data);
        
    }
}
