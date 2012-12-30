<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albumimage extends CI_Controller {
    
    public function show($id)
    {
        $this->load->model("gallerymodel");
        $id=(int)$id;
        $data['gallery']=$this->gallerymodel->getalbumphoto($id);
        $data['galleryinfo']=$this->gallerymodel->getinfo($id);
        $data['id']=$id;
        $data['title']=$this->gallerymodel->getalbumtitle($id);
        $data['other']=$this->gallerymodel->getotheralbum($id);
        $data['value']="galleryimage";
        $this->load->view("templateview",$data);
    }
    
}