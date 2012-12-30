<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Habermodel extends CI_Model {
    
    public function get()
    {
       $sql="select `id`, `title`,left(`content`,300) as `content`,`picture`
              from `news`              
              order by `id` desc
              limit 20";
        
        return $this->returnresult($sql);
       
    }
    
    public function albums()
    {
        $sql="select `id`, `title`,`newcatgories`,left(`content`,300) as `content`,`picture`
              from `news`
              where `newcatgories` = 3
              order by `id` desc
              limit 20";
        
        return $this->returnresult($sql);
    }
    
    
    public function roportaj()
    {
        $sql="select `id`, `title`,`newcatgories`,left(`content`,300) as `content`,`picture`
              from `news`
              where `newcatgories` = 2
              order by `id` desc
              limit 20";
        
        return $this->returnresult($sql);
    }
    
    
    public function magazin()
    {
        $sql="select `id`, `title`,`newcatgories`,left(`content`,300) as `content`,`picture`
              from `news`
              where `newcatgories` = 1
              order by `id` desc
              limit 20";
        
        return $this->returnresult($sql);
    }
    
    
    public function addvisitor($id)
    {
        $sql="update `news` set `uniq` = `uniq` + 1 where `id` = {$id}";
        $this->db->query($sql);
    }
    
    public function gethaber($id)
    {
       
        $this->db->where("id",$id);
        $query=$this->db->get("news");
        
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        return false;
    }
    
    
    public function getalbums()
    {
        $sql=" select `photo`.`id`,`photo`.`external_id`,`photo`.`filename`,`albums`.`title`
               from `photo` 
               left join `albums` on(`albums`.`id` =`photo`.`external_id`)
               where `photo`.`photo_cat` = 1 
               order by `photo`.`external_id`
               limit 4";
        return $this->returnresult($sql);
    }
    
    
    public function getpopuler($id)
    {
        if($this->getcat($id)===false)
            return false;
        $sql="select `title`,`picture`,`id`,left(`content`,180) as `content`
              from `news`
              where `id` != {$id}              
              order by `uniq` desc 
              limit 3";
         return $this->returnresult($sql);
    }
    
    public function getenson($id)
    {
        if($this->getcat($id)===false)
            return false;
        $sql="select `title`, `picture` , `id`,left(`content`,180) as `content` 
              from `news` 
              where `id` != {$id}              
              order by `id` desc 
              limit 3";
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
    
    
    public function ajaxget()
    {
        
        $lastid=$this->input->post("dataid");
        $cat=$this->input->post("datacat");
        
           $sql="select `id`, `title`,left(`content`,300) as `content`,`picture`
                 from `news`  
                 where `id` < {$lastid}";            
                 
        if($cat!="all")
        {
            $sql.=" and `newcatgories` = {$cat} ";
        }
        
        
        
        $sql.=" order by `id` desc limit 20";
        
        $result=$this->returnresult($sql);
        
        
        if($result!=false)
        {
            $data="";
            foreach($result as $row)
            {
                $content=substr($row->content,0,strrpos($row->content," "))." ....";
                $imgsrc=base_url()."public/images/news/thumb_{$row->picture}";
                $url=base_url()."haber/show/{$row->id}";
                $data.="<div class=\"habergenelinfo\" data-id=\"{$row->id}\">
                        <a href=\"{$url}\">
                            <div class=\"haberpic\">
                                <img src=\"{$imgsrc}\">
                                <h1>{$row->title}</h1>
                            </div>
                        </a>
                        <p>{$content}</p>      

                    </div>";
            }
            
            echo $data;
        }
        
        
         
            
        
    }
    public function getcat($id)
    {
        $sql="select `newcatgories` from `news` where `id` = {$id}";
        $query=$this->db->query($sql);
        
        if($query->num_rows()==1)
        {
            return $query->row()->newcatgories;
        }
        
        return false;
    }
    
    public function getreleated($id)
    {
       $cat=$this->getcat($id);
       if($cat===false)
           return false;
       $sql="select `title`,`picture`, `id`,left(`content`,180) as `content` from `news` where `newcatgories` = {$cat} and `id`!= {$id} order by `id` desc limit 3";
       return $this->returnresult($sql);
               
            
    }
    
    
    public function music()
    {
        $sql="select `id`, `title`,`newcatgories`,left(`content`,300) as `content`,`picture`
              from `news`
              where `newcatgories` = 0
              order by `id` desc
              limit 20";
        
       return $this->returnresult($sql);
       
        
    }
    
    
    
    
}
