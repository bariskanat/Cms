<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-9" />
        
    <?php if(isset($haberinfo)): ?>
            <meta property="og:title" content="<?php echo $haberinfo->title; ?>" />
            <meta property="og:type" content="news" />
            <meta property="og:url" content="<?php echo base_url()."haber/show/".$haberinfo->id; ?>" />

            <meta property="og:image" content="<?php echo base_url()."public/images/news/thumb_".$haberinfo->picture; ?>" />

            <meta property="og:site_name" content="<?php echo "Radio perfect" ?>"/>
            <?php $content=substr($haberinfo->content,0,150); ?>
            <meta property="og:description" content="<?php echo substr($content,0,strrpos($content," "))." ...."; ?>" />
    <?php endif; ?>
            
            
    <?php if(isset($sanatciinfo)): ?>
            <meta property="og:title" content="<?php echo $sanatciinfo->firstname." ".$sanatciinfo->lastname; ?>" />
            <meta property="og:type" content="Sanatcilar hakkinda detayli bilgi" />
            <meta property="og:url" content="<?php echo base_url()."sanatci/show/".$sanatciinfo->id; ?>" />

            <meta property="og:image" content="<?php echo base_url()."public/images/sanatci/thumb_".$sanatciinfo->picture; ?>" />

            <meta property="og:site_name" content="<?php echo "baris" ?>"/>
            <?php $content=substr($sanatciinfo->about,0,150); ?>
            <meta property="og:description" content="<?php echo substr($content,0,strrpos($content," "))." ...."; ?>" />
    <?php endif; ?>
        
    
            
            
                
    <?php if(isset($list)): ?>
            <meta property="og:title" content="<?php echo $list[0]->name; ?>" />
            <meta property="og:type" content="Radio Perfect top 20" />
            <meta property="og:url" content="<?php echo base_url()."toplist"; ?>" />

            <meta property="og:image" content="<?php echo base_url()."public/images/top/thumb_".$list[0]->picture; ?>" />

            <meta property="og:site_name" content="<?php echo "khh" ?>"/>
           
            <meta property="og:description" content="Radio Perfect top20 list" />
    <?php endif; ?>
            
            
        <?php if(isset($galleryinfo)): ?>
            <meta property="og:title" content="<?php echo $galleryinfo->title; ?>" />
            <meta property="og:type" content="Radio perfect fotograflari" />
            <meta property="og:url" content="<?php echo base_url()."albumimage/show/".$galleryinfo->external_id; ?>" />

            <meta property="og:image" content="<?php echo base_url()."public/images/{$galleryinfo->external_id}/thumb_".$galleryinfo->filename; ?>" />

            <meta property="og:site_name" content="<?php echo "Radio perfect" ?>"/>
            <?php 
                if(strlen($galleryinfo->title)>150)
                {
                    $content=substr($galleryinfo->title,0,150);
                }
                else
                {
                    $content=$galleryinfo->title;
                }
                
                
             ?>
            <meta property="og:description" content="<?php if(strlen($galleryinfo->title)>150) echo substr($content,0,strrpos($content," "))." ....";else echo $galleryinfo->title;  ?>" />
       <?php endif; ?>
            
            
        
        <title>Radio Perfect</title>
        
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.js"/></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/main.js"/></script>  
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.masonry.js"/></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/jwplayer/jwplayer.js"/></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/easing.js"/></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>public/js/fancybox/jquery.easing-1.3.pack.js"/></script>
 
 
 <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
 


 <script type="text/javascript" src="<?php echo base_url(); ?>public/js/fancybox/jquery.fancybox-1.3.4.pack.js"/></script>
         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css"/>
         <link href='<?php echo base_url(); ?>public/js/fancybox/jquery.fancybox-1.3.4.css' rel='stylesheet' type='text/css'>
         <link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
</head>
</body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php




?>
<div id="mainmenu">
    <ul>
        <li><a <?php if(isset($mainmenu) && $mainmenu=="main") echo "class='slct'"; ?> href="<?php echo base_url(); ?>">Radio perfect</a></li>
        <li>
            <a <?php if(isset($mainmenu) && $mainmenu=="haberler") echo "class='slct'"; ?> href="<?php echo base_url()."haberler"; ?>">haberler</a>
        
            <ul>
                <li><a href="<?php echo base_url()."haberler/magazin"; ?>">Magazin</a></li>
                <li><a href="<?php echo base_url()."haberler/music"; ?>">Music</a></li>
                <li><a href="<?php echo base_url()."haberler/albums"; ?>">Yeni albumler</a></li>
                <li><a href="<?php echo base_url()."haberler/roportaj";?>">Roportaj</a></li>
            </ul>
        </li>
        <li><a <?php if(isset($mainmenu) && $mainmenu=="about") echo "class='slct'"; ?> href="<?php echo base_url()."about"; ?>">hakkimizda</a></li>
        <li><a <?php if(isset($mainmenu) && $mainmenu=="yayin") echo "class='slct'"; ?> href="<?php echo base_url()."yayin"; ?>">yayinlar</a></li>
        <li><a <?php //if($mainmenu=="main") echo "class='slct'"; ?> href="http://50.7.240.146:8016/listen.pls" target="_blank">Canli dinle</a></li>
        <li><a <?php if(isset($mainmenu) && $mainmenu=="sanatcilar") echo "class='slct'"; ?> href="<?php echo base_url()."sanatcilar"; ?>">Sanatcilar</a></li>
        <li><a <?php if(isset($mainmenu) && $mainmenu=="reklamlar") echo "class='slct'"; ?> href="<?php echo base_url()."reklamlar"; ?>">Reklamlar</a></li>
        <li><a <?php if(isset($mainmenu) && $mainmenu=="gallery") echo "class='slct'"; ?> href="<?php echo base_url()."gallery"; ?>">albumler</a></li>
        <li><a <?php if(isset($mainmenu) && $mainmenu=="toplist") echo "class='slct'"; ?> href="<?php echo base_url()."toplist"; ?>">top 20</a></li>
    </ul>
    <div class="clear"></div>
</div>




<div id="mainwrapper">