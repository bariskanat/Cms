
<div id="gallery">
    
   <?php if($gallery!=false): foreach($gallery as $row):?> 
    <?php if(count($row['photos'])>5):  $id=$row['external_id'];?>
    <div class="galleryind" data-id="<?php echo $id; ?>">
        
        <div class="galleryheader">
            <a href="<?php echo base_url()."albumimage/show/{$id}" ?>">
                <img src="<?php echo base_url()."public/images/{$row['external_id']}/thumb_{$row['filename']}"; ?>">
                <span><?php echo $row['title']; ?></span>
            </a>
        </div>  <!---------------galleryheader----------->
        
        
        <div class="galleryfooter">
            <?php if($row['photos']!=false && count($row['photos'])>0): ?>
            <?php foreach($row['photos'] as $row):?>
            <a href="<?php echo base_url()."albumimage/show/{$id}" ?>">
              <img src="<?php echo base_url()."public/images/{$row->external_id}/thumb_{$row->filename}"; ?>">
            </a>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>  <!---------------galleryfooter----------->
        
        
        
    </div>   <!-------------galleryind----------->
   <?php endif ?>
   <?php endforeach; endif;?> 
</div><!----gallery------>
<script>
    var loading=true;
    $(function(){
        $("body").addClass("background");
        
         $(window).scroll(function(){
                 
               
                 var check=($(window).scrollTop()>=$(document).height()-$(window).height()-500);
                
                if( check && loading==true)
                {
                    loading=false;
                    scrolling();                    
                }
    
    });
      
    

    });
    
    
    
    
    
       
function scrolling()
{
                  
        var  dataid=$("#gallery").children(" div.galleryind:last").attr("data-id"),
        cct = $("input[name=ci_csrf_token]").val(); 

        

        url="<?php echo base_url()."gallery/ajaxget" ?>"; 


        $.post(url,
                {'dataid':dataid, 'ci_csrf_token':cct},
                function(data)
                {

                  
                    
                    if(data)
                    {
                        $("#gallery").append(data);
                    }
                        loading=true;
                });
                               

}


</script>