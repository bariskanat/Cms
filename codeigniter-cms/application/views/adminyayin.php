  



<div id="sanatform">

 <?php 
    
           
       
        echo validation_errors();
        echo form_open_multipart("adminyayin/add");
        echo form_upload("music");
        echo "<p>Title</p>";
        echo form_input("title");       
        echo "<p>Year</p>";
        echo form_input("year");
        echo "<p>Month</p>";
        echo form_input("month");
        echo "<p>Day</p>";
        echo form_input("day");             
        echo form_submit("submit","add");
        echo form_close();
    
    
    ?>
</div>

<div id="playlist">
    <?php if($yayin):foreach($yayin as $y): ?>
    
    <div class="yayinlar">
        <div><a href="<?php echo base_url()."public/audio/$y->filename"?>"><?php echo $y->title; ?></a></div>
        <div><a href="<?php echo base_url()."adminyayin/edit/{$y->id}"; ?>">Edit</a></div>
        <div><a href="<?php echo base_url()."adminyayin/delete/{$y->id}"; ?>">Delete</a></div>
        
    </div>
    
    
    
    <?php endforeach; endif; ?>
    <div id="player"></div>
</div>
<script>

//$(function(){
//     
//      jwplayer("player").setup({
//                                        flashplayer: "<?php //echo base_url(); ?>public/jwplayer/player.swf",
//                                        
//                                        levels: [
//                                                    { file: "<?php //echo base_url() ?>public/audio/5601dacd039fa89432f3c5ab5bf6c100.mp3" } // H.264 version
//
//                                                ],
//
//                                        height: 360,
//                                        width: 640
//                                      
//                  
//              });       
//});



</script>
<script type="text/javascript" src="http://webplayer.yahooapis.com/player.js"></script> 