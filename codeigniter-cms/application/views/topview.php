

    
 





<div id="top">
    
    
    <div id="haberadd">
    
  
    
    </div>
    
    
    <div id="list">
        <?php  if($list!=false): foreach($list as $row):?>
        
        <div>
            <div id="topimage">
                <span><?php echo $row->sira; ?></span>
                  <?php if($row->picture!=null): ?>
                        <img src="<?php echo base_url()."public/images/top/thumb_".$row->picture; ?>">
                  <?php endif; ?>
                 
            </div>
            
            <div id="topinfo">
               
                <p><?php echo $row->name; ?><br/>
                    <?php echo $row->title; ?>
                </p>
                <p>
                    <a href="<?php echo base_url()."top/edit/{$row->id}"; ?>">edit</a>
                </p>
            </div>
            
        </div>
        
        
        <?php endforeach; endif; ?>
        
    </div>
    
</div><!---------top---------------->



<script>

    var say = function () {
            init: function(name){
  	     alert(name);
       }
        
};

say.init("baris");




</script>
