
<?php  if($list==false)
            redirect(base_ur()."top");
    
?>

<div id="haberadd">
    
    <?php
         echo validation_errors();
         echo form_open_multipart("top/editlist/{$list->id}");
         echo form_upload("picture");         
         echo form_input("name",$list->name);        
         echo form_input("title",$list->title);   
         echo form_input("youtube",$list->youtube);  
         echo form_input("sira",$list->sira);    
         
         echo form_submit("submit", "edit");
         echo form_close();
    
?>
    
    </div>
