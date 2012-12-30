<div id="sanatlist">
    
    <?php if($sanat): foreach($sanat as $a): ?>
    
    <div>
        <a href="<?php echo base_url()."adminsanat/getsanatci/{$a->id}"; ?>">
            <img src="<?php echo base_url()."public/images/sanatci/thumb_{$a->picture}";?>">
        </a>
        <p><?php echo $a->firstname." ".$a->lastname; ?></p>
        
    </div>
    
    
    <?php endforeach; endif; ?>
</div>