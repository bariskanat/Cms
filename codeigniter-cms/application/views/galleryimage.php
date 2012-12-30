
<?php 
    if($gallery==false)
    {
        redirect(base_url());
    }
      
    
    
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


<div id="galle">
<div id="galleryleft">
    

<?php if($title!=false):?>
    <h1 id="gallerytitle">
        <?php echo $title->title; ?>
    
  
        
        
    </h1>
   <?php endif; ?>
    
<div id="photosection"> 
 
<div id="galleryphoto">
    
    <?php foreach($gallery as $row):?>
    
    <div class="galleryimage">
        <a class="fancybox"  rel="group" href="<?php echo base_url()."public/images/{$id}/$row->filename"; ?>">
           <img src="<?php echo base_url()."public/images/{$id}/$row->filename"; ?>">
        </a>
    </div>
    
    <?php endforeach; ?>
</div>
    
     
    
    
    
</div><!------photosection------->


  


    <div id="imagecomment">
      
            <h1>yorumlar</h1>
            
            
            <div class="fb-comments" data-href="<?php echo base_url()."albumimage/show/{$id}" ;?>" data-num-posts="3" data-width="788"></div>
            <h1>baris kanat</h1>
    </div>
    
    
</div><!----------------galleryleft------>
   
<div id="galleryrigth">
   
    

    <?php if($other && count($other)>0):?>
    
        <div id="galeryother">
            <h1>Benzer Galeriler</h1>
           <?php foreach($other as $row): ?> 
            
            <div class="gall">
                 <a href="<?php echo base_url()."albumimage/show/{$row->external_id}" ?>">
                    <img src="<?php echo base_url()."public/images/{$row->external_id}/thumb_{$row->filename}"; ?>">
                    <span><?php echo $row->title; ?></span>
                </a>
            </div>  <!-------------gall--------->
            
            
            <?php endforeach; ?>
        </div><!-------------galleryheader--------->
    <?php endif; ?>
    
    
</div> <!---------------galleryrigth------------------>
    
    
</div>



<script>
    $(function(){
        
       
        
        
       $("body").addClass("background");
       $("#galleryphoto img").load(function(){
           $("#galleryphoto").masonry({
            itemSelector:".galleryimage",
            isAnimated:true,
            isFitWidth:true,
            columnWidth : 262,
            animationOptions: {
                queue: false,
                duration: 500
            }
            
        });
       });
      
        $("#galleryphoto").masonry({
            itemSelector:".galleryimage",
            isAnimated:true,
            isFitWidth:true,
            columnWidth : 262,
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
      
      
     });
    
   
    
                          

  </script>