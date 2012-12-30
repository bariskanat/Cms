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
    
           
        $options=array(
            1 =>"halk",
            2 =>"ozgun",
            3 =>"pop",
            4 =>"arabesk",
            5 =>"sanat",
            6 =>"fantezi"
            
        );
        echo validation_errors();
        echo form_open_multipart("adminsanat/update/{$info->id}");
        echo form_upload("picture");
        echo "<p>firstname</p>";
        echo form_input("firstname",$info->firstname);
        echo "<p>Lastname</p>";
        echo form_input("lastname",$info->lastname);     
        echo form_dropdown("type", $options,$info->type);
        echo "<p>Year</p>";
        echo form_input("year",$info->year);
        echo "<p>Month</p>";
        echo form_input("month",$info->month);
        echo "<p>Day</p>";
        echo form_input("day",$info->day);
        echo "<p>About</p>";
        echo form_textarea("about",$info->about); 
        echo form_submit("submit","add");
        echo form_close();
    
    
    ?>
</div>
        
        
        
        
    </div>
    
    
</div>