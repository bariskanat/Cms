<div class="entersite">
<?php 


echo form_open("admin/check");
echo form_input("name","email");
echo form_password("password","password");
echo form_submit("submit","enter");
echo form_close();


?>
   
</div>