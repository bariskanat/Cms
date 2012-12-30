
<div id="haberadd">
    
<?php
         echo validation_errors();
         echo form_open_multipart("reklam/add");
         echo "Picture<br/>";
         echo form_upload("picture");
         echo "<br/>Audio<br/>";
         echo form_upload("audio");
         echo form_input("name","Name");   
         echo form_input("tlf","telefon");
         echo form_input("web","Web Address");
         echo form_input("address","Address");
         echo form_textarea("content","About");
         echo form_submit("submit", "add");
         echo form_close();
    
?>
    
    
    
    
    
    
</div>


<div id="reklamalan">
    
    <?php if($all!=false):foreach($all as $row): ?>
    
    <div>
        <a href="<?php echo base_url()."reklam/edit/{$row->id}"; ?>">
            <img src="<?php echo base_url()."public/images/reklam/thumb_{$row->picture}";?>">
        </a>
        <span><?php  echo $row->name;?></span>
    </div>
    
    <?php  endforeach; endif; ?>
</div>