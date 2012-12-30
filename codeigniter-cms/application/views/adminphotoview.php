


<div id="uploadalbumphto">
    
    <?php echo form_open_multipart("adminaddphoto/upload/".$this->uri->segment(3));?>
    <?php 
        $data=array(
            
            1=>"main",
            0=>"regular"
        );
    
    ?>
   <?php echo form_dropdown('cat', $data,0);?>
    <input type="file" name="picture">
    <?php 
    
       echo form_submit("resim","upload");
       echo form_close();  
    
    ?>
    
    
    <div id="albumphoto">
        <?php
        
        
           // if($photos){echo "yes";print_r($photos);}else{echo "no";}
        
        ?>
        <?php if($photos!=false): foreach ($photos as $p): ?> 
        <div>
            <img src="<?php echo base_url()."public/images/".$this->uri->segment(3)."/thumb_".$p->filename; ?>">
            <br>
            <a href="<?php echo base_url()."adminaddphoto/deletephoto/".$p->id; ?>">delete</a>
        </div>
        <?php endforeach; endif; ?>
            
    </div>
    
</div>
