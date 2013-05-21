<!DOCTYPE html> 
<html> 
<head> 
	<title>Lender411 Mobile</title> 
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="jqueryMobile.css" />
    <link rel="stylesheet" href="custom.css" />
     <script src="http://www.lenderhomepage.com/scripts/landingpage.js" ></script>
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0-alpha.1/jquery.mobile-1.2.0-alpha.1.min.js"></script>
   
    <script type="text/javascript">
	function hideURLbar() {
	if (window.location.hash.indexOf('#') == -1) {
		window.scrollTo(0, 1);
	}
}

if (navigator.userAgent.indexOf('iPhone') != -1 || navigator.userAgent.indexOf('Android') != -1) {
    addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
    }, false);
}

$(document).bind("mobileinit", function(){
  $.mobile.defaultPageTransition('flow');
});

	</script>
<meta charset="UTF-8">
</head> 
<body> 
<div data-role="page">

	<div class="header">
    <div class="logo_container" data-role="header">
		<div class="logo"><img src="images/lender_logo.jpg" width="260" height="74" alt="logo"></div>
       </div>
        <div class="info">
        	
           <table align="center">
           <tr>
          
            
            <td>
            <p style="text-align:center">
               
              <?=$rs_contactinfo->CompanyName?><br />
              <a class="phone" href="tel:<?=formatPhone($rs_contactinfo->Phone,'noExt')?>"><?=formatPhone($rs_contactinfo->Phone)?></a></span><br />
              <a href="mailto:<?=$rs_contactinfo->Email?>"><?=$rs_contactinfo->Email?></a><br />
               
            </p>
            </td>
            </tr>
          </table>
        
       	
   
      </div>
  </div>