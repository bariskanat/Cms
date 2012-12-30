<h1>haberler section</h1>

<div id="haberadd">
    
<?php
         echo validation_errors();
         echo form_open_multipart("adminhaber/add");
         echo form_upload("picture");

         $option=array(
             0=>"music",
             1=>"magazin",
             2=>"roportaj",
             3=>"album"
             
         );
         echo form_dropdown('cat', $option,0);
    
         echo form_input("title",  set_value("title","Title"));         
         echo form_textarea("content","Content");
         echo form_submit("submit", "add");
         echo form_close();
    
?>
    
    
    
    
    
    
</div>

<div id="haberlist">
    <?php if($haber): foreach ($haber as $a): ?>
    <div>
        <a href="<?php echo base_url()."adminhaber/edit/{$a->id}"; ?>">
            <img src="<?php echo base_url()."public/images/news/thumb_{$a->picture}"; ?>">
        </a>
        <h1><?php echo $a->title ?></h1>
        <p><?php echo $a->content; ?></p>
        
    </div>
    <?php endforeach; endif; ?>
    
</div>