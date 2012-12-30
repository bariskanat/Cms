<div id="mainpage">
    
    
    <div id="mainleft">
        
        <div id="haberler">
            <?php  foreach($music as $row):  ?>
            <?php ?>
            <div>
                <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                    <div class="haberpic">
                        <img src="<?php echo base_url()."public/images/news/thumb_{$row->picture}"; ?>">
                        <h1><?php echo $row->title; ?></h1>
                        <h2>Music</h2>
                    </div>
                </a>
                <p><?php echo substr($row->content,0,strrpos($row->content," "))." ...."; ?></p>      

            </div>



            <?php endforeach;   ?>
            
            
            <?php  foreach($magazin as $row):  ?>
            <?php ?>
            <div>
                <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                    <div class="haberpic">
                        <img src="<?php echo base_url()."public/images/news/thumb_{$row->picture}"; ?>">
                        <h1><?php echo $row->title; ?></h1>
                        <h2>Magazin</h2>
                    </div>
                </a>
                <p><?php echo substr($row->content,0,strrpos($row->content," "))." ...."; ?></p>      

            </div>



            <?php endforeach;   ?>
            
             <?php  foreach($albums as $row):  ?>
            <?php ?>
            <div>
                <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
                    <div class="haberpic">
                        <img src="<?php echo base_url()."public/images/news/thumb_{$row->picture}"; ?>">
                        <h1><?php echo $row->title; ?></h1>
                        <h2>Yeni Albumler</h2>
                    </div>
                </a>
                <p><?php echo substr($row->content,0,strrpos($row->content," "))." ...."; ?></p>      

            </div>



            <?php endforeach;   ?>
            
            
            
            
            
        </div><!--------haberler------->

        
        
        
        
    </div> <!------mainleft------>
    
    
    
    
    
    
    
    <div id="mainright">
        
        <?php if($yayin!=false): ?>
        <div id="ensonyayin">
            <h1>enson Yayinlar</h1>
            
           <?php  foreach($yayin as $row):?> 
            
                <a target="_blank" href="<?php echo base_url()."yayin/dinle/{$row->id}"; ?>">
                    <?php echo $row->title;?>
                  <span>Tarih: <?php echo $row->year."/".$row->month."/".$row->day; ?></span>
                </a>
            
            
           <?php endforeach; ?>
          
        </div><!-------ensonyayin---------->
        <?php endif; ?>
        
        
        <?php if($top!=false): ?>
            <div id="top20">
                <h1><a href="<?php echo base_url()."toplist"; ?>">Top 20(liste )</a></h1>
                <ul>
                    <?php foreach($top as $row): ?>
                    <li>
                        <img src="<?php echo base_url()."public/images/top/thumb_{$row->picture}"; ?>">
                        <span><?php echo $row->sira; ?></span>
                        <p>
                            <h3><?php echo $row->name; ?></h3>
                            <h4><?php echo $row->title; ?></h4>
                        </p>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div><!-------top20---------->
        <?php endif; ?>
        
        
    </div><!--------mainright----------->   
    
    
    
    
    


    
   <?php if($gallery!=false): foreach($gallery as $row):?> 
    <?php if(count($row['photos'])>5):  $id=$row['external_id'];?>
    <div class="galleryind">
        
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


    

<div id="sanatcilar">
    
    <?php foreach($sanatci as $row): ?>
    
        
                <div class="gall">
                    <a href="<?php echo base_url()."sanatci/show/{$row->id}" ?>">
                        <img src="<?php echo base_url()."public/images/sanatci/thumb_{$row->picture}"; ?>">
                        <span><?php echo $row->firstname." ".$row->lastname; ?></span>
                    </a>
                </div>  
    
    
    
    <?php endforeach; ?>
</div><!----------sanatcilar-------->
    
    
    
    
    
    
    
    
</div><!-----mainpage------->





<script>

    $(function(){
        $("body").addClass("background");
      
    

    });

</script>
