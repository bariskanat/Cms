<script type="text/javascript">

$(function(){
   // alert("calisiyor");
    $('#cropbox').Jcrop({
        aspectRatio: 1.5,
        bgOpacity:   .4,
        minSize :[300,200],
        onChange: showCoords,
        onSelect: showCoords
        
    });
  
});

function showCoords(c)
{
        
        $('#x').val(c.x);
	$('#y').val(c.y);	
	$('#w').val(c.w);
	$('#h').val(c.h);        
      
};



</script>
<div id="adminmain">





<div id="mainpicture">
    <img id="cropbox" src="<?php echo base_url()."public/images/sanatci/{$filename}";?>" alt="picture"/>
</div>

<div id="clear"></div>

<?php //$imgsrc=realurl."public/images/".$this->album_id."/".$this->photo['filename'];?>
<?php echo form_open("adminsanat/cropimage/{$id}");?>
<p>
    <input type="hidden" name="x" id="x"/>
    <input type="hidden" name="y" id="y"/>
    <input type="hidden" name="w" id="w"/>
    <input type="hidden" name="h" id="h"/>
     
    <input type="hidden" name="filename" value="<?php echo $filename; ?>" />
    <input type="submit" name="submit" value="CROP IMAGE"/>
    
</p>
<?php form_close(); ?>






</div>
