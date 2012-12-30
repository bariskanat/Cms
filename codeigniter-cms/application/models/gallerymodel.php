<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallerymodel extends CI_Model {
    
    
    public function get($id=null)
    {
        $sql=" select `photo`.`id`,`photo`.`external_id`,`photo`.`filename`,`albums`.`title` from `photo` 
               left join `albums` on(`albums`.`id` =`photo`.`external_id`)
               where `photo`.`photo_cat` = 1";
               
        if($id!=null)
        {
            $sql.=" AND  `photo`.`external_id` < {$id} ";
        }
         $sql.=" order by `photo`.`id` desc limit 4 ";
        $query=$this->db->query($sql);
        if($query->num_rows()>0)
        {
            $data=array();
            foreach($query->result() as $row)
            {
                $data[]=array(
                    'id'            =>  $row->id,
                    'external_id'   =>  $row->external_id,
                    'filename'      =>  $row->filename,
                    'photos'        =>  $this->getphoto($row->external_id),
                    'title'         =>  $row->title
                    
                );
            }
            
            return (!empty($data))?$data:false;
        }
        
        return false;
    }
    
    
    
    public function getalbumtitle($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("albums");
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        return false;
        
    }
    
    public function getphoto($id)
    {
        $id=(int)$id;
        $sql="select `filename`,`external_id` from `photo` where `external_id` = {$id} and `type` = 0 and `photo`.`photo_cat` != 1 order by `id` desc limit 6";
        $query=$this->db->query($sql);
        
        if($query->num_rows()>0)
        {
            $data=array();
            foreach($query->result() as $row)
            {
                $data[]=$row;
            }
            
            return (!empty($data))?$data:false;
        }
        return false;
    }
    
    
    public function ajaxget(){
        
        
        
        $id=(int)$this->input->post("dataid");
       
        $result=$this->get($id);
        
        if($result!=false)
        {
            $data="";
           foreach($result as $row)
           {
               if(count($row['photos'])>5)
               {
                   
                   $url=base_url()."albumimage/show/{$row['id']}";
                   $id=$row['external_id'];
                   $imgsrc=base_url()."public/images/{$row['external_id']}/thumb_{$row['filename']}";
                   $data.="<div class=\"galleryind\" data-id=\"{$id}\">
                        <div class=\"galleryheader\">
                            <a href=\"{$url}\">
                            <img src=\"{$imgsrc}\">
                                <span>{$row['title']}</span>
                            </a>
                        </div>  <!---------------galleryheader----------->
                        
                        <div class=\"galleryfooter\">";
                   
               
                
                       foreach($row['photos'] as $row)
                       {
                           $thumb=base_url()."public/images/{$row->external_id}/thumb_{$row->filename}";
                           $data.="
                                <a href=\"{$url}\">
                                    <img src=\"{$thumb}\">
                                 </a>";
                       }// end of the foreach($row['photos'] as $row)
                       
                       $data.="
                                </div>  <!---------------galleryfooter----------->



                            </div>   <!-------------galleryind----------->";
                       
                 
                   
                  
                   
               }//end of the if(count($row['photos'])>5)
               
           }//end of the foreach($result as $row)
            
            echo $data;
        } // end of if($result!=false)



        
        
    }
    
    
    public function getinfo($id)
    {
         $sql="select `photo`.`id`,`photo`.`external_id`,`photo`.`filename`,`albums`.`title` from `photo` 
               left join `albums` on(`albums`.`id` =`photo`.`external_id`)
               where `photo`.`photo_cat` = 1
               and `photo`.`external_id` = {$id}";
         $query=$this->db->query($sql);
         if($query->num_rows()==1)
         {
             return $query->row();
         }
         return false;
    }
    
  
  
      
    
    public function getotheralbum($id)
    {
         $sql=" select `photo`.`id`,`photo`.`external_id`,`photo`.`filename`,`albums`.`title` from `photo` 
               left join `albums` on(`albums`.`id` =`photo`.`external_id`)
               where `photo`.`photo_cat` = 1 and `photo`.`external_id`!={$id}
               limit 6";
        $query=$this->db->query($sql);
        if($query->num_rows()>0)
        {
            $data=array();
            foreach($query->result() as $row)
            {
                $data[]=$row;
            }
            
            return (!empty($data))?$data:false;
        }
        
        return false;
    }
    
    
    public function getalbumphoto($id)
    {
        $this->db->where("external_id",$id);
        $this->db->where("type",0);
        $this->db->from("photo");
        $this->db->order_by("id","desc");
        $this->db->limit(30);
        $query=$this->db->get();
        if($query->num_rows()>0)
        {
            $data=array();
            foreach($query->result() as $row)
            {
                $data[]=$row;
            }
            
            return (!empty($data))?$data:false;
        }
        return false;
    }
}