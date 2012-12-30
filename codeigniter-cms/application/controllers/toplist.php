<?php

class Toplist extends CI_Controller
{
    
    
    public function index()
    {
        $this->load->model("toplistmodel");
        $data['list']=$this->toplistmodel->get();
        $data['sanatci']=$this->toplistmodel->getsanatci();
        $data['albums']=$this->toplistmodel->getalbums();
        $data['value']="listview";
        $data['mainmenu']="toplist";
        $this->load->view("templateview",$data);
    }
}
