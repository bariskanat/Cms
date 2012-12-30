<?php
    if($haber==false)
    {
        redirect(base_url());
    }
?>


<div id="haberler" data-cat="<?php echo $cat; ?>">
    <?php  foreach($haber as $row):  ?>
    <?php ?>
    <div class="habergenelinfo" data-id="<?php echo $row->id; ?>">
        <a href="<?php echo base_url()."haber/show/{$row->id}"; ?>">
            <div class="haberpic">
                <img src="<?php echo base_url()."public/images/news/thumb_{$row->picture}"; ?>">
                <h1><?php echo $row->title; ?></h1>
            </div>
        </a>
        <p><?php echo substr($row->content,0,strrpos($row->content," "))." ...."; ?></p>      
        
    </div>
    
    
    
    <?php endforeach;   ?>
</div>




<script>
     var loading=true;
    $(function(){
        $("body").addClass("background");
        //alert($("#haberler").children(" div.habergenelinfo:last").attr("data-id"));
        //cct = $.cookie('csrf_cookie_name');
        
        //console.log(cct);
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
    var datacat=$("#haberler").attr("data-cat"),                        
                        dataid=$("#haberler").children(" div.habergenelinfo:last").attr("data-id"),
                        cct = $("input[name=ci_csrf_token]").val(); 
                        
                        
                        
                        url="<?php echo base_url()."haberler/ajaxget" ?>"; 


                        $.post(url,
                                {'datacat':datacat,'dataid':dataid, 'ci_csrf_token':cct},
                                function(data)
                                {
                                    
                                   //alert(data);
                                    if(data)
                                    {
                                        $("#haberler").append(data);
                                    }
                                     loading=true;
                                });
                               

}



</script>