
<?php

    if($info==false)
    redirect(base_url()."reklam");
?>


<div id="reklamalan">
    
    
    
    <div>
        
            <img src="<?php echo base_url()."public/images/reklam/thumb_{$info->picture}";?>">
       
            <a href="<?php echo base_url()."public/audio/reklam/{$info->audio}";?>"><?php echo $info->name; ?></a>
    </div>
    
   
</div>
<div id="haberadd">
    
<?php
         echo validation_errors();
         echo form_open_multipart("reklam/editreklam/{$info->id}");
         echo "Picture<br/>";
         echo form_upload("picture");
         echo "<br/>Audio<br/>";
         echo form_upload("audio");
         echo "<br/>Aame<br/>";
         echo form_input("name",$info->name);   
         echo "<br/>Telefon<br/>";
         echo form_input("tlf",$info->telefon);
         echo "<br/>Address<br/>";
         echo form_input("address",$info->address);
         echo "<br/>Web Address<br/>";
         echo form_input("web",$info->web);
         echo "<br/>About<br/>";
         echo form_textarea("content",$info->content);
         echo form_submit("submit", "update");
         echo form_close();
    
?>
    
    
    
    
    
    
</div>