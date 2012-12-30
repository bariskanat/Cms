
<?php
    if($all==false)
    {
        redirect(base_url());
    }


 ?>
<div id="reklamlarinfo">
    


    
</div>
<div id="reklamlar">    
    <?php foreach($all as $row): ?>
    
    
    <div class="rek">
        
        <div class="reklampphoto">
            <img src="<?php echo base_url()."public/images/reklam/thumb_{$row->picture}"; ?>">
            <span><?php echo $row->name; ?></span>            
        </div>
        <p><?php echo "Tlf : ".$row->telefon;?></p>
        <p class="rekinfo">
            <a href="<?php echo base_url()."public/audio/reklam/{$row->audio}"; ?>">dinle</a>
            <?php if($row->web!=null): ?>
                <a class="rekweb"href="<?php echo "http://{$row->web}"; ?>" target="_blank">Web</a>
            <?php endif; ?>
        </p>
        
        <div class="reklaminfo"><?php echo $row->address."<br/>", nl2br($row->content); ?></div>
        
    </div>
    
    <?php  endforeach;?>
</div>




<script>

    $(function(){
        $("body").addClass("background");
        
        
        $(".rek").hover(function(e){
        
        
        tooltip=$(this).children("div.reklaminfo"); 
        
          var x;
           if(e.pageX>700)
           {
               
               x=e.pageX-150;
               
           }else
           {
               
               x=e.pageX+10;
                
           }
              
          
            tooltip.show().css({
            top:e.pageY+30,            
            left:x

            });
          
      
    },function(){      

        tooltip.hide();
        
    });
    

        
        
        
        

    });

</script>

