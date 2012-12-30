<?php

    if($yayin==false)
        redirect(base_url());

?>

<div id="yayinlar">
    
    <div id="yayinleft">
        
        <ul>
            <li><a <?php if($menu=="2012"){echo "class='sel'";}?> href="<?php echo base_url()."yayin/show/2012";?>" <?php if($menu=="about") {echo "class='sel'";} ?>>2012</a></li>
            <li><a  <?php if($menu=="2011"){echo "class='sel'";}?> href="<?php echo base_url()."yayin/show/2011" ?>" <?php if($menu=="emp") {echo "class='sel'";} ?>>2011</a></li>
            <li><a  <?php if($menu=="2010"){echo "class='sel'";}?> href="<?php echo base_url()."yayin/show/2010" ?>" <?php if($menu=="emp") {echo "class='sel'";} ?>>2010</a></li>
            
            
        </ul>
        
        
        
    </div><!--------yayinleft------------->
    
    
    
    <div id="yayinright">
        
        <div id="yayindetails">
           <?php foreach($yayin as $row):?> 
              <div>
                  <a target="_blank" href="<?php echo base_url()."yayin/dinle/{$row->id}"; ?>"><?php echo $row->title;?>
                  <span>Tarih: <?php echo $row->year."/".$row->month."/".$row->day; ?></span></a>
              </div>
            
           <?php endforeach;?>
        </div>
        
        
        
    </div><!------------yayinright----------->
    
    
</div><!----------yayinlar---------->





<script>
    $(function(){        
       $("body").addClass("background");

    });
    
</script>

