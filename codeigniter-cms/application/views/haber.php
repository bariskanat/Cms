<?php

    if($haber==false)
    {
        redirect(base_url());
    }

?>
<div id="haber">
    
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

    
    <div id="haberleft">
        <div id="habermain">
            <div id="haberdetay">
                
                <h1><?php echo $haber->title; ?></h1>
                <div id="haberimage">
                 <img src="<?php echo base_url()."public/images/news/{$haber->picture}"; ?>">
                </div>
                <p><?php echo nl2br($haber->content); ?></p>

            </div><!------------haberdetay------------->



            <div id="habercomment">

                <div class="fb-comments" data-href="<?php echo base_url()."haber/show/{$haber->id}" ;?>" data-num-posts="7" data-width="720"></div>

            </div><!---------habercomment----------->
            
        </div>  <!-------------habermain-------------------->
            
            
            
            
     <?php if($albums && count($albums)>0):?>
    
        <div id="galeryother">
            <h1>Galeriler</h1>
           <?php foreach($albums as $row): ?> 
            
            <div class="gall">
                 <a href="<?php echo base_url()."albumimage/show/{$row->external_id}" ?>">
                    <img src="<?php echo base_url()."public/images/{$row->external_id}/thumb_{$row->filename}"; ?>">
                    <span><?php echo $row->title; ?></span>
                </a>
            </div>  <!-------------galleryheader--------->
            
            
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
        
        
    </div><!-----------haberleft--------------->
    
    
    
    
    <div id="haberright">
        <?php if($related): ?>
        <div id="haberrelated">
        
        <h1>Benzer haberler</h1>
        
        <?php  foreach($related as $row): ?>
           
           <div id="haberinfo">
               <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                    <img src="<?php echo base_url()."public/images/news/thumb_{$row->picture}"; ?>">
               </a>
               <div>
                    <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                        <h2><?php echo $row->title; ?></h2>
                    </a>
                    <p><?php echo substr($row->content,0,strrpos($row->content," "))." ...."; ?></p>
               </div>
               
           </div>
        
        <?php endforeach; ?>
        
        
        
        </div><!---------haberrelated------------> 
        <?php endif; ?>
        
        
        
        <?php if($enson): ?>
       <div id="haberenson">
        
        <h1>Enson haberler</h1>
        
        <?php  foreach($enson as $row): ?>
           
           <div id="haberinfo">
               <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                    <img src="<?php echo base_url()."public/images/news/thumb_{$row->picture}"; ?>">
               </a>
               <div>
                    <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                        <h2><?php echo $row->title; ?></h2>
                    </a>
                    <p><?php echo substr($row->content,0,strrpos($row->content," "))." ...."; ?></p>
               </div>
               
           </div>
        
        <?php endforeach; ?>
        
        
        
        </div><!---------haberenson------------>
        
        <?php endif; ?>
        
         <?php if($populer): ?>
         <div id="haberpopuler">
       
        <h1>encok okunan haberler</h1>
        
        <?php  foreach($populer as $row): ?>
           
           <div id="haberinfo">
               <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                    <img src="<?php echo base_url()."public/images/news/thumb_{$row->picture}"; ?>">
               </a>
               <div>
                    <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                        <h2><?php echo $row->title; ?></h2>
                    </a>
                    <p><?php echo substr($row->content,0,strrpos($row->content," "))." ...."; ?></p>
               </div>
               
           </div>
        
        <?php endforeach; ?>
        
        
        
        </div><!---------haberpopuler------------>
        
        <?php endif; ?>
        
        
    </div><!-----------------haberright------------->
    
    
    
</div><!--------------haber----------->








<script>
    $(function(){
        
       $("body").addClass("background");
       
     });
    
   
  </script>