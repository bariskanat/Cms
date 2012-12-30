<?php
    if($list==false)
        redirect(base_url());

?>



<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_floating_style addthis_32x32_style" style="left:50px;top:50px;">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e4a464d62143928"></script>
<!-- AddThis Button END -->



<div id="toplist">
    
    <div id="toplistleft">
        <div id="mediaplayer"><div id="player"></div></div>
        <div id="parcalist">
            <h1>Radio Perfect top 20</h1>
            <?php $this->load->helper("video");?>
            <?php foreach($list as $row):?>
            
             <?php 
                    $id=youtube_id($row->youtube);            
             
             ?>
                        <div class="gall" data-video="<?php echo $id; ?>">
                            <p class="siralamam"><?php echo $row->sira; ?></p>
                            <?php if($row->picture!=null): ?>
                                    <img src="<?php echo base_url()."public/images/top/thumb_".$row->picture; ?>">
                                    <span class="parcainfo"><?php echo $row->name; ?><br/>
                                      <?php echo $row->title; ?>
                                    </span>
                                    <p class="videobutton"></p>
                            <?php endif; ?>

                        </div>

                      

                    
            
            
            <?php  endforeach;?>
        </div><!------parcalist----------->
        
    </div><!-------toplistleft------->
    
    
    
    
    <div id="toplisright">
        
        <?php if($sanatci!=false): ?>
          
            <h1>sanatcilar</h1>
            <?php foreach($sanatci as $row):?>
        
                <div>
                    <a href="<?php echo base_url()."sanatci/show/{$row->id}"; ?>">
                        <img src="<?php echo base_url()."public/images/sanatci/thumb_{$row->picture}"; ?>">
                        <span><?php echo $row->firstname." ".$row->lastname; ?></span>
                    </a>
                </div>
        
        
            <?php endforeach; ?>
        <?php endif; ?>
            
            
         <?php if($albums!=false): ?>
          
            <h1>albumler</h1>
            <?php foreach($albums as $row):?>
        
                <div>
                    <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                        <img src="<?php echo base_url()."public/images/news/thumb_{$row->picture}"; ?>">
                        <span><?php echo $row->title ?></span>
                    </a>
                </div>
        
        
            <?php endforeach; ?>
        <?php endif; ?>
        
        
    </div><!-------toplistright------->
    
    
    
    
    
    
</div><!-------toplist------>




<script>
    $(function(){
        
       $("body").addClass("background");
       var id=$("#parcalist div.gall").first().attr("data-video");
       
       tool(id);
       
       $(".videobutton").click(function(){
           id=$(this).parent().attr("data-video");
           tool(id);
           var top=5;
           $("body,html").animate({scrollTop : top},1500,"easeOutExpo");
          
          
       
       
       
       
     });
     
    });
     
     
     
     
     
     
     function tool(id)
    {
     
               jwplayer("player").setup({
                                        flashplayer: "<?php echo base_url(); ?>public/jwplayer/player.swf",
                                        autostart: true,
                                        levels: [
                                                    { file: "http://www.youtube.com/watch?v="+id } // H.264 version

                                                ],

                                        height: 480,
                                        width: 880,
                                        skin: "<?php echo base_url(); ?>public/jwplayer/bekle.zip"
                  
              });                       
                                  
        
    }
    
   
  </script>
