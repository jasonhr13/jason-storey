<?php session_start(); ?>
<!DOCTYPE html>
<!-- 
 * Markup for jQuery Reveal Plugin 1.0
 * www.ZURB.com/playground
 * Copyright 2010, ZURB
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 -->
	<head>
		<meta charset="utf-8" />
		<title>Inga's Blooms | Coming Soon</title>
		
		<!-- Attach our CSS -->
	  	<link rel="stylesheet" href="reveal.css">	
        
	  	
		<!-- Attach necessary scripts -->
		<!-- <script type="text/javascript" src="jquery-1.4.4.min.js"></script> -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="jquery.reveal.js"></script>
		
		<style type="text/css">
		    @font-face {
    font-family: 'khmer_sangam_mnregular';
    src: url('khmer_sangam_mn-webfont.eot');
    src: url('khmer_sangam_mn-webfont.eot?#iefix') format('embedded-opentype'),
         url('khmer_sangam_mn-webfont.woff') format('woff'),
         url('khmer_sangam_mn-webfont.ttf') format('truetype'),
         url('khmer_sangam_mn-webfont.svg#khmer_sangam_mnregular') format('svg');
    font-weight: normal;
    font-style: normal;

}
			body { 
				background-image:url(bg.jpg);
				margin:0;
			}
			#logo {
				background-image:url(ingasblooms.png);
				width: 865px;
				height: 433px;
				margin: 0 auto;
				margin-top: 50px;
			}
			#content {
				margin:0 auto;
				margin-top: 20px;
				width: 865px;
				
			}
			#content p {
				text-align:center;
				font-family: 'khmer_sangam_mnregular';
				color: #484747;
				overflow:hidden;
			}
			h3 {
				text-align:center;
				color:#484747;
				font-family: 'khmer_sangam_mnregular';
			}
			#icons {
				height: 30px;
				margin:0 auto;
				width: 200px;
				text-align:center;
				display:block;
				clear:both;
			}
			#icons a{
				float:left;
				
			}
			.social {
				margin-top: 1px;
				margin-left: 10px;
			}
			.big-link { display:block; margin-top: 100px; text-align: center; font-size: 70px; color: #06f; }
			
		</style>
		
	</head>
	<body>
    
    <div id="logo"></div>
	<div id="content"><h3>Exciting things are happening with Inga's Blooms in 2013.</h3>
       				  <p>Sign up below to receive updates and check us out on Facebook or contact us via email</p>
                     
                      </div>
                      
                       <div id="icons"><a href="#" class="button" data-reveal-id="myModal">
			Sign up
		</a>	
        <a href="http://www.facebook.com/pages/Ingas-Blooms/105415169980" target="_blank" class="social"><img src="facebook.png" alt="facebook" /></a>
        <a href="mailto:ingasblooms@gmail.com" class="social"><img src="email.png" alt="email" /></a>
        <div style="clear:both"></div>
        </div>
		
		

		<div id="myModal" class="reveal-modal">
			<h1 style="color:#484747; font-family:Helvetica; ">Keep up to date!</h1>
			<p style="color:#484747; font-family:Helvetica; ">Want to know when the new site is live? Or when we have new deals? Enter your email below!</p>
             <?php

$contact_form_fields = array(
							 
  
  array('name'    => 'E-mail:',
        'type'    => 'email',
        'require' => 1),
  );

$contact_form_graph           = false;
$contact_form_xhtml           = true;

$contact_form_email           = "updates@ingasblooms.com";
$contact_form_encoding        = "utf-8";
$contact_form_default_subject = "Inga's Blooms updates";
$contact_form_message_prefix  = "Sent from contact form\r\n==============================\r\n\r\n";

include_once "contact-form/contact-form.php";

?>
			<a class="close-reveal-modal">&#215;</a>
		</div>
			
	</body>
</html>