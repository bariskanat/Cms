
<div id="adminalbum">
<?php echo validation_errors(); ?>
<?php
    echo form_open("adminalbum/create");
    echo form_input("title","title");
    echo form_submit("albumsubmit","create");
    echo form_close();
?>
</div>
<?php if($albums): ?>
<?php foreach($albums as $row): ?>
        <div id="albuminfo">
            <div id="albumname"><?php echo $row['title'] ?></div>
            <div id="albumphotonum"><?php if($row['number']>0) {echo $row['number'];}else{ echo "no photo uploaded yet";}?></div>
            <div id="albumdelete"><?php if($row['number']==0)echo anchor("adminalbum/delete/{$row['id']}","delete");?></div>
            <div id="albumupload"><a href="<?php echo base_url(); ?>adminaddphoto/addphoto/<?php echo $row['id'];?>">upload</a></div>


        </div>
<?php endforeach; ?> 
<?php endif; ?>