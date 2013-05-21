<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Inga's Blooms | Custom floral design with a Passion for Nature</title>
<link rel="stylesheet" type="text/css" href="inner.css" />
<link rel="stylesheet" href="flexslider.css" type="text/css" media="screen" />
  
  <!-- Attach our CSS -->
	<script type="text/javascript" src="jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="jquery.fancybox.js?v=2.1.3"></script>
	<link rel="stylesheet" type="text/css" href="jquery.fancybox.css?v=2.1.2" media="screen" />
    
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>  		
   
	<script src="jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(window).load(function() {
				$('.flexslider').flexslider();
			});
		</script>
 
 
  

    
</head>

<body>
<div id="wrapper">

  <div id="header">
  
    		<div class="logo">
       	  <img src="logo.png" width="432" height="218" /> 
          
          </div>
          
          
    	
   	<ul>
            	<li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="order.php">Order</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a class="selected" href="contact.php">Contact</a></li>
    </ul>
            
    <div id="social"><a href="http://www.facebook.com/pages/Ingas-Blooms/105415169980?sid=0.33244852302595973" target="_blank"><img src="facebook.png" width="34" height="34" alt="facebook" /></a> <a href="http://instagram.com/ingasblooms" target="_blank"><img src="instagram.png" width="34" height="34" alt="instagram" /></a> <a href="mailto:ingasblooms@gmail.com"><img src="email.png" width="34" height="34" alt="email" /></a></div>

  </div>
  <div style="clear:both"></div>
  <div id="banner">
    
    <ul class="slides">
    <li>
      <img src="contact_banner.jpg" width="960" height="79" /></li>
   
    </ul>
    </div>
    
    <div id="content">
    
   <div id="left"> <blockquote><p style="margin-bottom: 40px"><span class="parents">Call Us</span> or send us an email. If you want to ask Inga about an arrangement or have any other general information questions then please use the form below to send Inga an email. Or give her a call!  </p>
    <?php

$contact_form_fields = array(
							 
  
  array('name'    => 'Name:',
        'type'    => 'name',
        'require' => 1),
  array('name'    => 'Phone:',
        'type'    => 'name',
        'require' => 1),
  array('name'    => 'Subject:',
        'type'    => 'subject',
        'require' => 1),
  array('name'    => 'Request:',
        'type'    => 'textarea',
        'require' => 1),
  );

$contact_form_graph           = false;
$contact_form_xhtml           = true;

$contact_form_email           = "updates@ingasblooms.com";
$contact_form_encoding        = "utf-8";
$contact_form_default_subject = "Inga's Blooms General Info Form";
$contact_form_message_prefix  = "Sent from General Info Form\r\n==============================\r\n\r\n";

include_once "contact-form/contact-form.php";

?>
   
   
   </blockquote></div>

<div id="right">
<p style="text-align:center; font-size:24px">Call Us</p>
<p style="text-align:center">&nbsp;</p>
<p style="text-align:center"><span class="parents">Phone</span></p>
<p style="text-align:center">(949) 218-4576</p>

<p style="text-align:center">&nbsp;</p>

<p style="text-align:center"><span class="parents">Email</span></p>
<p style="text-align:center">ingasblooms@gmail.com</p>

  <p>&nbsp;</p></div>

<div style="clear:both"></div>
  </div>
  
  
  
  
	
  <div id="footer">
    <div id="copy">2012 &copy; Copyright Inga's Blooms, All Rights Reserved.</div>
    <div id="links"><a href="index.html">Home</a> | <a href="about.html">About</a> | <a href="gallery.html">Order</a> | <a href="gallery.html">Gallery</a> | <a href="contact.html">Contact</a></div>
    <div class="search"><form action="http://www.smithandcompanypc.com/search.html" id="cse-search-box">
    <div>
  <input type="image" src="search_btn.png" name="sa" value="Search" />
    <input type="hidden" name="cx" value="000949325887129273963:0drcypni-mc" />
    <input type="hidden" name="cof" value="FORID:10" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" value="Search Inga's Blooms" size="31" />
    </div>
  
</form> </div>
  </div>
</div>

<!-- Modals -->






</body>
</html>
