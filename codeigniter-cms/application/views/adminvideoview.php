<div id="sanatci">
    
    <div id="info">
        
   <?php if($info):?>
    <div id="saninfo">
        <div class="sanatpic">
            <img src="<?php echo base_url()."public/images/sanatci/thumb_{$info->picture}";?>">

            <p><?php echo $info->firstname." ".$info->lastname; ?></p>
        </div>
        
         <div id="sanmenu">
            
            <ul>
                <li><a href="<?php echo base_url()."adminsanat/getsanatci/$info->id"; ?>">update</a></li>
                <li><a href="<?php echo base_url()."adminsanat/getvideo/$info->id"; ?>">video</a></li>
                <li><a href="<?php echo base_url()."adminsanat/getphoto/$info->id"; ?>">photo</a></li>
                
            </ul>
        </div>
        
        </div>
        
       
        
    
   <?php endif;?>
        
    </div>
    <div id="detay">
        
            <div id="sanatform">
    <?php 
    
           
    
        echo validation_errors();
        echo form_open("adminsanat/addvideo/{$info->id}");
        echo "<p>Video</p>";
        echo form_input("video");
        echo "<p>Title</p>";
        echo form_input("title");
       
        echo form_submit("submit","add");
        echo form_close();
    
    
    ?>
</div>
        <?php $this->load->helper("video");?>
        <div id="youtubevideo">
            <?php if($videos!=false): foreach($videos as $video):?>
              <?php $id=youtube_id($video->youtube); ?>
              <?php if($id):?>
               <div data-id="<?php echo $id;?>">
                    <?php echo "<img src=\"http://img.youtube.com/vi/{$id}/0.jpg\">"; ?>
                   <p><?php echo $video->parcaname; ?><br/><a href="<?php echo base_url()."adminsanat/deletevideo/$video->id"; ?>"/>delete</a></p>
                   <span id="videoplay"></span>
               </div>
            <?php  endif;endforeach; endif; ?>
        </div>
        
        
        
    </div>
    
    
</div>


<script>
    $(function(){
        $(".overlay").live("click",function(){
            $("#videoplayer").remove();
            $(this).remove();
        });
        
        $("#videoplay").live("click",function(){
            var id=$(this).parent().attr("data-id");
          console.log($(this));
            tool(id);
           
    });
});
    
    function tool(id)
    {
         $("<div>").addClass("overlay").prependTo("body").css({"opacity":"0.4"}).show();
                                $("<div id='videoplayer'><div id='player'></div></div>").appendTo("body");
                                  
                                  h=($(window).height() - $("#videoplayer").outerHeight()) / 2 ;
                                  w=($(window).width() - $("#videoplayer").outerWidth()) / 2;
                                  $("#videoplayer").css({
                                      top:$(window).scrollTop()+150+"px",
                                      left:w+"px"
                                  });
                                  
                                  
               jwplayer("player").setup({
                                        flashplayer: "<?php echo base_url(); ?>public/jwplayer/player.swf",
                                        autostart: true,
                                        levels: [
                                                    { file: "http://www.youtube.com/watch?v="+id } // H.264 version

                                                ],

                                        height: 360,
                                        width: 640,
                                        skin: "<?php echo base_url(); ?>public/jwplayer/bekle.zip"
                  
              });                       
                                  
        
    }
    
    
                          

  </script>
  
  
  
<!--  <iframe width="640" height="360" src="http://www.youtube.com/embed/zHnzxnIUnxo?feature=player_embedded" frameborder="0" allowfullscreen></iframe>-->