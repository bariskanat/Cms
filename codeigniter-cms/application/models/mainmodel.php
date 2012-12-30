<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mainmodel extends CI_Model {
    
    public function getmagazin(){
        
         $sql="select `id`, `title`,left(`content`,300) as `content`,`picture`
              from `news`
              where `newcatgories` = 1
              order by `id` desc
              limit 2";
        
        return $this->returnresult($sql);
        
        
        
    }
    
    public function getmusic(){
        
         $sql="select `id`, `title`,left(`content`,300) as `content`,`picture`
              from `news`
              where `newcatgories` = 0
              order by `id` desc
              limit 2";
        
        return $this->returnresult($sql);
        
        
    }
    
    public function getalbum(){
         $sql="select `id`, `title`,left(`content`,300) as `content`,`picture`
              from `news`
              where `newcatgories` = 3
              order by `id` desc
              limit 2";
        
        return $this->returnresult($sql);
        
    }
    
    
    public function getsanatci()
    {
        $this->db->from("sanatci");
        $this->db->order_by("id","desc");
        $this->db->limit(8);
        $query=$this->db->get();
        if($query->num_rows()>0)
        {
            $data=array();
            foreach($query->result() as $row )
            {
                $data[]=$row;
            }
            
            return (!empty($data))?$data:false;
        }
        
        return false;
    }
    
    public function getgallery(){
        
        $sql=" select `photo`.`id`,`photo`.`external_id`,`photo`.`filename`,`albums`.`title` from `photo` 
               left join `albums` on(`albums`.`id` =`photo`.`external_id`)
               where `photo`.`photo_cat` = 1
               order by `photo`.`id` desc
               
               ";
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
            
            
//            $newdata=array_filter($data,function($key){
//                
//               return (count($key['photos'])>5);
//            });
            
            $newdata=array_filter($data,array($this,"baris"));
            
            $newdata=(count($newdata)>2)?array_slice($newdata,0,2):$newdata;
            
            
            return (!empty($newdata))?$newdata:false;
        
        }
        return false;
    }
    
    
    public function baris($key)
    {
         return (count($key['photos'])>5);
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
    
    public function gettop(){
          $sql="SELECT * 
                FROM `top`
                ORDER BY  `sira` ASC 
                LIMIT 5";
        
        return $this->returnresult($sql);
        
        
    }
    
  
    
   public function getyayin()
   {
       $sql="SELECT  `id` ,  `title` ,  `year` ,  `month` ,  `day` , CAST( CONCAT(  `year` ,  `month` ,  `day` ) AS UNSIGNED ) AS  `tarih` 
        FROM  `audio` 
        ORDER BY  `tarih` DESC 
        LIMIT 5";
       return $this->returnresult($sql);
   }
    
    
    public function returnresult($sql)
    {
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
}