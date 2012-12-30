<div id="sanatci">
    
    <div id="info">
        
   <?php if($info):?>
    <div id="saninfo">
        <div class="sanatpic">
            <img src="<?php echo base_url()."public/images/sanatci/thumb_{$info->picture}";?>">

            <p><?php echo $info->firstname." ".$info->lastname; ?></p>
        </div>
        
         <div id="sanmenu">
            
            <ul>
                <li><a href="<?php echo base_url()."adminsanat/getsanatci/$info->id"; ?>">update</a></li>
                <li><a href="<?php echo base_url()."adminsanat/getvideo/$info->id"; ?>">video</a></li>
                <li><a href="<?php echo base_url()."adminsanat/getphoto/$info->id"; ?>">photo</a></li>
                
            </ul>
        </div>
        
        </div>
        
       
        
    
   <?php endif;?>
        
    </div>
    <div id="detay">
        
    <div id="sanatform">
        <?php 



            echo validation_errors();
            echo form_open_multipart("adminsanat/addphoto/{$info->id}");
            echo "<p>Photo</p>";
            echo form_upload("picture");      
            echo form_submit("submit","add");
            echo form_close();


        ?>
   </div><!---sanatform--->
   <div id="sanatphotosection">
          
        <?php if($photos!=false): foreach($photos as $photo):?>
       <div id="sanatimage">
            <img src="<?php echo base_url()."public/images/sanatci/{$photo->filename}";?>">
            <a href="<?php echo base_url()."adminsanat/deletephoto/$photo->id"; ?>">delete</a>
   
       </div>
   
        <?php  endforeach; endif;?>
        
   </div><!------saantphotosection----->   
    </div><!---detay--->
    
    
</div><!---sanatci--->


<script>
    $(function(){
       $("#sanatphotosection img").load(function(){
           $("#sanatphotosection").masonry({
            itemSelector:"#sanatimage",
            isAnimated:true,
            isFitWidth:true,
            columnWidth : 242,
            animationOptions: {
                queue: false,
                duration: 500
            }
            
        });
       });
      
        $("#sanatphotosection").masonry({
            itemSelector:"#sanatimage",
            isAnimated:true,
            isFitWidth:true,
            columnWidth : 242,
            animationOptions: {
                queue: false,
                duration: 500
            }
        });

      
      
     });
    
   
    
                          

  </script>
  
  
  
