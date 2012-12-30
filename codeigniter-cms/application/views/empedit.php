<div id="empedit">
   
    
    
    <div id="haberadd">  
         <img src="<?php echo base_url()."public/images/emp/thumb_".$emp->picture; ?>">
    <?php
            echo validation_errors();
            echo form_open_multipart("emp/editemp/{$emp->id}");
            echo form_upload("picture");
            echo form_input("firstname",  $emp->firstname); 
             echo form_input("lastname",  $emp->lastname); 
            echo form_input("gorev",  $emp->title);         
            echo form_textarea("about",$emp->content);
            echo form_submit("submit", "edit");
            echo form_close();

    ?>
         <a href="<?php echo base_url()."emp/delete/{$emp->id}" ?>">delete</a>

   </div>   
    
    
</div>
