<h1>employee section</h1>


<div id="haberadd">   
    <?php
            echo validation_errors();
            echo form_open_multipart("emp/add");
            echo form_upload("picture");
            echo form_input("firstname",  set_value("firstname","Firstname")); 
             echo form_input("lastname",  set_value("lastname","Lastname")); 
            echo form_input("gorev",  set_value("gorev","Gorev"));         
            echo form_textarea("about","About");
            echo form_submit("submit", "add");
            echo form_close();

    ?>

</div>

<?php  if($calisan!=false): ?>

    <div id="calisanlar">
        
        <?php foreach($calisan as $row): ?>
        <a href="<?php echo base_url()."emp/edit/{$row->id}"; ?>">
            <div>
                <img src="<?php echo base_url()."public/images/emp/thumb_{$row->picture}"; ?>">
                <span><?php  echo $row->firstname." ".$row->lastname; ?></span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
    
