
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Haber extends CI_Controller {
    
    public function index()
    {
        
       
        $this->load->model("habermodel");
        $data['haber']=$this->habermodel->get();
        
        
        $data['value']="haberler";
        $this->load->view("templateview",$data);
    }
    
    
    
    public function show($id)
    {
        $id=(int)$id;
        $this->load->model("habermodel");
        $this->habermodel->addvisitor($id);
        $data['haber']=$this->habermodel->gethaber($id);
        $data['haberinfo']=$this->habermodel->gethaber($id);
        $data['related']=$this->habermodel->getreleated($id);
        $data['enson']=$this->habermodel->getenson($id);
        $data['populer']=$this->habermodel->getpopuler($id);
        $data['albums']=$this->habermodel->getalbums();
        
        
        
        $data['value']="haber";
        $this->load->view("templateview",$data);
        
    }
}
