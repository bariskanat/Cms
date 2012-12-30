

<div id="newsedit">
    
    <img src="<?php echo base_url()."public/images/news/{$haber->picture}" ;?>"><br/>
    
   <?php
        echo form_open("adminhaber/editnews/{$haber->id}");
        echo form_input("title",$haber->title);
        echo form_textarea("content",$haber->content);
            echo "<br/>";
        echo form_submit("submit","edit");
        echo form_close();   
    
    
    ?>
    <a href="<?php echo base_url()."adminhaber/deletenews/{$haber->id}"; ?>">delete</a>
    
    
    
    
</div>
