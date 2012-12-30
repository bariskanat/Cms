<div id="aboutus">
    
    <div id="aboutleft">
        <ul>
            <li><a href="<?php echo base_url()."about";?>" <?php if($menu=="about") {echo "class='sel'";} ?>>hakkimizda</a></li>
            <li><a href="<?php echo base_url()."about/emp" ?>" <?php if($menu=="emp") {echo "class='sel'";} ?>>calisanlar</a></li>
            
            
        </ul>
        
        
        
    </div><!-------aboutleft----------->
    
    <div id="aboutright">
     <?php if(isset($menu) && $menu=="about"): ?>
        <div id="aboutdetails">
         
  </div><!-----------aboutdetails---------------->
    
<?php  endif;?>        
   
  
  <?php if(isset($menu) && $menu=="emp"): ?>
  
        <div id="calisanlar">
            
              <?php foreach($emp as $row): ?>
    
        
                <div class="gall">
                    
                        <img src="<?php echo base_url()."public/images/emp/thumb_{$row->picture}"; ?>">
                        <span><?php echo $row->firstname." ".$row->lastname; ?></span>
                    
                </div>  <!-------------gall--------->
                <div class="empinfo">
                    
                        <h2>
                            <?php echo $row->firstname." ".$row->lastname." :".$row->title; ?>
                        </h2>
                        <p>
                            <?php echo nl2br($row->content); ?>
                        </p>
                </div>
    
    
    
    <?php endforeach; ?>
            
        </div><!----calisanlar----------->
        
  <?php endif;?>
        
    </div><!----------aboutright------->
    
    
</div><!--------------aboutus------------>




<script>
    $(function(){        
       $("body").addClass("background");

     


    $(".gall").hover(function(e){
        
        
        tooltip=$(this).next(); 
        
          var x;
           if(e.pageX>700)
           {
               
               x=e.pageX-150;
               
           }else
           {
               
               x=e.pageX+10;
                
           }
              
          
            tooltip.show().css({
            top:e.pageY+10,
            //left:$(this).position().left-500
            //top:e.pageY+20,
            left:x

            });
          
      
    },function(){      

        tooltip.hide();
        
    });
    
    
    
    });
    
</script>
