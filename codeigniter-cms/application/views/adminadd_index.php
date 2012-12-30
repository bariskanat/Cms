


<div id="admincalisan">
    <h1>add employee</h1>
<?php echo validation_errors(); ?>
<?php
  echo form_open("adminadd/adduser");
  echo form_input("email","email");
  echo form_password("password","password");
  echo form_submit("adduser","add");
  echo form_close();

?>

<?php if(isset($calisan) && $calisan!=false): ?>

<?php foreach($calisan as $row):?>
<p>
    <span> <?php echo $row->username;?></span>
    <span><a href="<?php echo base_url()."adminadd/delete/{$row->id}";?>">delete</a></span>
</p>
<?php endforeach; ?>

<?php endif; ?>
</div>