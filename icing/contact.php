<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="The official site of Icing on the Cake Bakery located in Terre Haute, Indiana.">
    <meta name="keywords" content="icing, cake, bakery, pastry, cupcakes, wedding, cookies, fondant, decorated, chocolate, carmel, vanilla, bake, brownies,">
    <meta name="copyright" content="Copyright Icing on the Cake Bakery 2011">
    <meta name="author" content="Jason Storey Interactive Web Design">
    <meta name="email" content="jasons@thwebco.com">
    <meta name="Revisit-after" content="1 Day">
    <meta name="expires" content="never">
<title>Contact</title>
 <link rel="stylesheet" type="text/css" href="main.css" />
  <link rel="stylesheet" type="text/css" href="TopMenu.css" />
  <link rel="stylesheet" type="text/css" href="contact-form/style-basic.css" />
<link rel="stylesheet" type="text/css" href="contact-form/style-simple.css" />
    <script type="text/javascript" src="javascript/bw-menu.js"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>

 <body class="home">
<div id="header">
  <div id="header-content">
    <div id="text-img"><img src="logo2.png" width="287" height="135" /></div>
    
    
  </div>
</div>

<div id="wrapper">
  <div id="main">
        
               <div id="menuTop">

    <ul id="menuOne" class="menuHoriz">
        <li><a href="index.html" onMouseOver="setMenu('menuSubOne')" onMouseOut="clearMenu('menuSubOne')">HOME</a></li>
        <li><a href="gallery.html" onMouseOver="setMenu('menuSubTwo')" onMouseOut="clearMenu('menuSubTwo')">GALLERY</a></li>
        <li><a href="menu.html" onMouseOver="setMenu('menuSubThree')" onMouseOut="clearMenu('menuSubThree')">MENU</a></li>
        <li><a href="contact.html" onMouseOver="setMenu('menuSubFour')" onMouseOut="clearMenu('menuSubFour')">CONTACT</a></li>
    </ul>

   

    

    <ul id="menuSubThree" class="menuVert" onMouseOver="setMenu('menuSubThree')" onMouseOut="clearMenu('menuSubThree')">
        <li><a href="pricing.html">PRICING</a></li>
        
    </ul>

   

</div> 

<div style="width:960px; height:80px "></div>


     <div id="content">
     
   <div id="text">
        
            <h1 style="line-height: 90%;">Contact Icing on the Cake Bakery</h1>
<?php

$contact_form_fields = array(
							 
  array('name'    => 'Name:',
        'type'    => 'name',
        'require' => 1),
  array('name'    => 'E-mail:',
        'type'    => 'email',
        'require' => 1),
  array('name'    => 'Phone:',
        'type'    => 'name',
        'require' => 1),
  array('name'    => 'Subject:',
        'type'    => 'subject',
        'require' => 1),
  array('name'    => 'Message:',
        'type'    => 'textarea',		
        'url'     => 'contact-form/image.php'));

$contact_form_graph           = false;
$contact_form_xhtml           = true;

$contact_form_email           = "jasons@thwebco.com";
$contact_form_encoding        = "utf-8";
$contact_form_default_subject = "Contact Page";
$contact_form_message_prefix  = "Sent from contact form\r\n==============================\r\n\r\n";

include_once "contact-form/contact-form.php";

?>
</div>    
     
     
     
    
    </div><!-- end content -->
  </div> 
  <!-- end main -->
    <div id="footer">
        <hr/>
        <br clear="all" />
    </div>
</div> <!-- end wrapper -->
    <script type="text/javascript">
swfobject.registerObject("FlashID");
    </script>
 </body>
</html>

