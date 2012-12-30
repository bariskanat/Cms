<h1>sanatciler section</h1>


<div id="sanatform">
    <?php 
           
        $options=array(
            1 =>"halk",
            2 =>"ozgun",
            3 =>"pop",
            4 =>"arabesk",
            5 =>"sanat",
            6 =>"fantezi",
            7 => "rock"
            
        );
        echo validation_errors();
        echo form_open_multipart("adminsanat/add");
        echo form_upload("picture");
        echo "<p>firstname</p>";
        echo form_input("firstname");
        echo "<p>Lastname</p>";
        echo form_input("lastname");     
        echo form_dropdown("type", $options);
        echo "<p>Year</p>";
        echo form_input("year");
        echo "<p>Month</p>";
        echo form_input("month");
        echo "<p>Day</p>";
        echo form_input("day");
        echo "<p>About</p>";
        echo form_textarea("about"); 
        echo form_submit("submit","add");
        echo form_close();
    
    
    ?>
</div>
<div id="adminsanat">
    
</div>
