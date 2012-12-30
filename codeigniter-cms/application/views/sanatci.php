

<?php 

    if($sanatci==false)
    {
        redirect(base_url());
    }

?>

<div id="sanatcidetails">
    
    <div id="sanatmenu">
               <a href="<?php echo base_url()."sanatci/show/{$sanatci->id}"; ?>">fotograflar</a>
               <a href="<?php echo base_url()."sanatci/show/{$sanatci->id}/video"; ?>">videolar</a>
    </div>
    
    
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

    
    <div id="sanatcileft">
        
        
        
        
        <div id="sanatcidetailinfo">
            
            <?php if(isset($photos) && $photos!=false): ?>
            <h2 class="photohea">fotograflar</h2>
            <div id="sanatphoto">
                  
                <?php foreach($photos as $row): ?>
                    <div data-id="<?php echo $row->id; ?>" data-type="photo">
                        <a class="fancybox" rel="group" href="<?php echo base_url()."public/images/sanatci/".$row->filename; ?>">
                            <img src="<?php echo base_url()."public/images/sanatci/".$row->filename; ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div><!------------sanatphoto------------->
            
            
            
            <?php endif;?>
            
            
            
            
       <?php $this->load->helper("video");?>
        <div id="youtubevideo">
            <?php if( isset($videos) && $videos!=false): ?>
              <h2>videolar</h2>
             <?php foreach($videos as $video):?>
              <?php $id=youtube_id($video->youtube); ?>
              <?php if($id):?>
               <div data-id="<?php echo $id;?>">
                    <?php echo "<img src=\"http://img.youtube.com/vi/{$id}/0.jpg\">"; ?>
                   <p><?php echo $video->parcaname; ?></p>
                   <span id="videoplay"></span>
               </div>
            <?php  endif;endforeach; endif; ?>
        </div><!-------------youtubevideo------------>
            
            
            
            
        </div><!-------------sanatcidetailinfo--------------->
        
        
        <div  id="sanatcicomment">
           <h2>yorumlar</h2>
            <div class="fb-comments" data-href="<?php echo base_url()."sanatci/show/{$sanatci->id}" ;?>" data-num-posts="3" data-width="750"></div>
        </div><!-------------sanatcicomment--------------------->
        
        <?php if(isset($other)&& $other!=false): ?>
          <div id="othersanatci">
             <h2>diger sanatcilar</h2>
            <?php foreach($other as $row): ?>
             
                <div class="gall">
                    <a href="<?php echo base_url()."sanatci/show/{$row->id}" ?>">
                        <img src="<?php echo base_url()."public/images/sanatci/thumb_{$row->picture}"; ?>">
                        <span><?php echo $row->firstname." ".$row->lastname; ?></span>
                    </a>
                </div>  <!-------------gall--------->
            
            
            
            
            <?php endforeach; ?>
          </div><!--------------othersanatci------------------>
        
        <?php endif; ?>
        
    </div><!-------------sanatcileft------------------>
    
    
    
    
    
    <div id="sanatciright">
        <div>
            <img src="<?php echo base_url()."public/images/sanatci/thumb_{$sanatci->picture}"; ?>">
            <span><?php echo $sanatci->firstname." ".$sanatci->lastname; ?></span>
        </div>
        
        <p>
            
            
            
            
            
            
            <?php echo nl2br($sanatci->about); ?>
        
        </p> 
        
        
    </div><!-------sanatciright-------------->
    
    
    
    <div class="clear"  ></div>
</div><!----------sanatcidetails------------->





<script>
    $(function(){        
       $("body").addClass("background");
       
       
       $("#sanatphoto img").load(function(){
           $("#sanatphoto").masonry({
            itemSelector:"#sanatphoto div",
            isAnimated:true,
            isFitWidth:true,
            columnWidth : 259,
            animationOptions: {
                queue: false,
                duration: 500
            }
            
        });
       });
      
        $("#sanatphoto").masonry({
            itemSelector:"#sanatphoto div",
            isAnimated:true,
            isFitWidth:true,
            columnWidth : 259,
            animationOptions: {
                queue: false,
                duration: 500
            }
        });
        
        
        $(".fancybox").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'       :	600, 
		'speedOut'      :	200,
                
                'overlayOpacity' :      0.75, 
                'overlayColor'   :      '#000',
		'overlayShow'	:	true
                
	});
        
        
        
         $(".overlay").live("click",function(){
            $("#videoplayer").remove();
            $(this).remove();
        });
        
        $("#videoplay").live("click",function(){
            var id=$(this).parent().attr("data-id");
          
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




