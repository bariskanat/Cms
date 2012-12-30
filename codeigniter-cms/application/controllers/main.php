<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	
	public function index()
	{
            $this->load->model("mainmodel");
            $data['magazin']=$this->mainmodel->getmagazin();
            $data['music']=$this->mainmodel->getmusic();
            $data['albums']=$this->mainmodel->getalbum();
            $data['gallery']=$this->mainmodel->getgallery();
            $data['top']=$this->mainmodel->gettop();
            $data['sanatci']=$this->mainmodel->getsanatci();
            $data['yayin']=$this->mainmodel->getyayin();
            $data['value']="indexview";
            $data['mainmenu']="main";
            $this->load->view("templateview",$data);
	}
}

?>