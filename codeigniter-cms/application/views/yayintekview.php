<?php

   if($yayin==false)
       redirect(base_url());
?>


<div id="yayindinle">
    
    <a href="<?php echo base_url()."public/audio/".$yayin->filename;?>"><?php echo $yayin->title."  ".$yayin->year."/".$yayin->month."/".$yayin->day; ?></a>
    
    
    
</div>




<script type="text/javascript" src="http://webplayer.yahooapis.com/player.js"></script> 
<script>
$(function(){
  $("body").addClass("background");
});
</script>