
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-9" />
        
    
        
        <title>baris</title>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.js"/></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/main.js"/></script> 
         <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.Jcrop.js"/></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.color.js"/></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.masonry.js"/></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/jwplayer/jwplayer.js"/></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.jplayer.min.js"/></script>


         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/adminmain.css"/>
         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/jquery.Jcrop.css"/>
        
</head>
</body>
<div id="mainwrapper">
    <?php if($this->session->userdata("loggedin")==1): ?>
    <div id="menu">
    
    <ul>
        
        <?php if($this->session->userdata("atype")==0):?>
            <li><a href="<?php echo base_url();?>adminadd">add</a></li>
            <li><a href="<?php echo base_url();?>adminalbum">album</a></li>
            <li><a href="<?php echo base_url();?>adminyayin">yayin</a></li>
            <li><a href="<?php echo base_url();?>adminhaber">haber</a></li>
            <li><a href="<?php echo base_url();?>emp">calisanlar</a></li>
             <li><a href="<?php echo base_url();?>reklam">reklam</a></li>
            
            
        <?php endif; ?>
            
        <li><a href="<?php echo base_url();?>adminsanat">sanatci</a></li>
        <li><a href="<?php echo base_url();?>adminsanat/listsanat">sanatlist</a></li>
        <li><a href="<?php echo base_url();?>top">top20</a></li>
         <li><a href="<?php echo base_url();?>admin/logout">logout</a></li>
        
        
    </ul>
    
    
</div>
<?php endif; ?>