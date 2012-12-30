
<?php
      if($sanatci==false)
          redirect(base_ur());
?>

<div id="sanatcilar">
    
    <?php foreach($sanatci as $row): ?>
    
        
    <div class="gall" data-id="<?php echo $row->id; ?>">
                    <a href="<?php echo base_url()."sanatci/show/{$row->id}" ?>">
                        <img src="<?php echo base_url()."public/images/sanatci/thumb_{$row->picture}"; ?>">
                        <span><?php echo $row->firstname." ".$row->lastname; ?></span>
                    </a>
                </div>  <!-------------gall--------->
    
    
    
    <?php endforeach; ?>
</div><!----------sanatcilar-------->






<script>
    
    var loading=true;
    $(function(){        
       $("body").addClass("background");

       
       
       $(".gall").live({
        mouseenter:
           function()
           {
                $("#sanatcilar div").css("opacity","0.3");
                $(this).css("opacity","1");
           },
        mouseleave:
           function()
           {
                $("#sanatcilar div").css("opacity","1");
           }
       }
    );
    
    
    
    
    $(window).scroll(function(){
                 
               
                 var check=($(window).scrollTop()>=$(document).height()-$(window).height()-500);
                
                if( check && loading==true)
                {
                    
                    loading=false;
                    scrolling();
                    
                    
                    
                }
    
    
    
    });
    
    
    
    
    
       

    });
    
    
    
    
       
function scrolling()
{
    var  dataid=$("#sanatcilar").children(" div:last").attr("data-id"),
                        cct = $("input[name=ci_csrf_token]").val(); 
                        
                       // alert(dataid);
                        
                        url="<?php echo base_url()."sanatcilar/ajaxget" ?>"; 


                        $.post(url,
                                {'dataid':dataid, 'ci_csrf_token':cct},
                                function(data)
                                {
                                    console.log(data);
                                   //alert(data);
                                    if(data)
                                    {
                                        $("#sanatcilar").append(data);
                                    }
                                     loading=true;
                                });
                               

}
    
</script>
