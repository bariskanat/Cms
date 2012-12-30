  




<?php

    if($yayin==false)
    {
        redirect("adminyayin");
    }

?>

<div id="sanatform">
  <a href="<?php echo base_url()."public/audio/$yayin->filename"?>"><?php echo $yayin->title; ?></a>
 <?php 
    
           
       
        echo validation_errors();
        echo form_open_multipart("adminyayin/update/{$yayin->id}");
        echo form_upload("music");
        echo "<p>Title</p>";
        echo form_input("title",$yayin->title);       
        echo "<p>Year</p>";
        echo form_input("year",$yayin->year);
        echo "<p>Month</p>";
        echo form_input("month",$yayin->month);
        echo "<p>Day</p>";
        echo form_input("day",$yayin->day);             
        echo form_submit("submit","edit");
        echo form_close();
    
    
    ?>
</div>



<script type="text/javascript" src="http://webplayer.yahooapis.com/player.js"></script> 