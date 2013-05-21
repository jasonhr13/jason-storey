<!DOCTYPE html> 
<html> 
<head> 
	<title>My Page</title> 
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="jqueryMobile.css" />
    <link rel="stylesheet" href="red.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0-alpha.1/jquery.mobile-1.2.0-alpha.1.min.js"></script>
    <script src="http://www.lenderhomepage.com/scripts/landingpage.js" ></script>
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
	</script>
    <style type="text/css">
	.text-inputs input {
		background-image: none;
padding: .4em;
margin: 25px 0 20px 0;
margin-top: 20px;
line-height: 1.4;
font-size: 16px;
display: block;
width: 100%;
outline: 0;
}	
.header {
	position: relative;
border-left-width: 0;
border-right-width: 0;
zoom: 1;
background-color:;
}
	.ui-btn-up-a {
		border: 1px solid #116212;
background: #ed1c24;
font-weight: bold;
color: #ffffff;
text-shadow: 0 1px 0 #444444;
background-image: -webkit-gradient(linear,left top,left bottom,from( #159118 ),to( #1fb523 ));
background-image: -webkit-linear-gradient( #159118,#1fb523 );
background-image: -moz-linear-gradient( #159118,#1fb523 );
background-image: -ms-linear-gradient( #159118,#1fb523 );
background-image: -o-linear-gradient( #159118,#1fb523 );
background-image: linear-gradient( #159118,#1fb523 );
}
.ui-btn-hover-a {
	border: 1px solid #116212;
background: #FF2029;
font-weight: bold;
color: #ffffff;
text-shadow: 0 1px 0 #444444;
background-image: -webkit-gradient(linear,left top,left bottom,from( #29c52d ),to( #34d738 ));
background-image: -webkit-linear-gradient( #29c52d,#34d738 );
background-image: -moz-linear-gradient( #29c52d,#34d738 );
background-image: -ms-linear-gradient( #29c52d,#34d738 );
background-image: -o-linear-gradient( #29c52d,#34d738 );
background-image: linear-gradient( #29c52d,#34d738 );
}
.logo_container {
	width: 100%;
	min-width: 100%;
	height:auto;
	position:fixed;
	background-color:#F7F7F7;
	z-index: 9999;
	box-shadow: 0 0 5px 1px rgba(0,0,0,0.4);
	
}
.ui-select .ui-btn select{
font-size: 50px;
}

.logo {
	margin: 0 auto;
	width: 206px;
}
.info {
	width: 100%;
	text-align:center;
	padding-top: 62px;
	
}
.photo {
	float:left;
	
}
.contact {
	float: left;
}
.bold {
	font-size: 22px;
	font-weight: bold;
}
table td {
	padding: 8px;
}
#footer {
	background-color:#0B539B;
}
#footer p {
	padding: 3px 10px 5px 10px;
	color: #fff;
	font-size:80%;
	text-shadow:none;
}
.legal {
	text-align:justify;
}
#footer a:link {
	color:#6DA79B;
}
	body {
	margin-bottom: 0px;
}
</style>
<meta charset="UTF-8">
</head> 
<body> 

<div data-role="page">

	<div class="header">
    <div class="logo_container">
		<div class="logo"><img src="images/logo.jpg" width="206" height="52" alt="logo"></div>
    </div>
        <div class="info">
        	
           <table align="center">
           <tr>
           <td>
            <img src="images/lender_photo.jpg" width="94" height="122" alt="preet"> 
            </td>
            
            <td>
            <p><span class="bold">Preet Kalirai</span><br>
             
               <span style="font-size:24px; color: red">1-866-488-2632</span><br>
               <strong>CA-DOC/NMLS# 281660</strong><br>
              
               <a href="mailto:preet@lhfinancial.com">preet@lhfinancial.com</a><br />
               <a href="http://www.callpreet.com">www.callpreet.com</a><br>
            </p>
            </td>
            </tr>
          </table>
        
       	
      </div>
  </div><!-- /header -->

	<div data-role="content">
    <p style="margin-bottom: 200px;">Thank you for submitting the form. We will contact you shortly.</p>
    
			
	</div><!-- /content -->
	<div id="footer">
    <p style="text-align:center; margin-bottom: 4px;"><a href="http://www.callpreet.com?ViewFullSite=true">View Full Site</a></p>
    <p class="legal">Equal Housing Opportunity Lender. Rates, Program, Fees, and Guidelines are subject to change without notice. Not a commitment to lend. Land Home only conducts business in states we are approved to. Land Home Financial Services, Inc. 530 La Sierra Drive, Sacramento, California 95864. Licensed by the Department of Corporations under the California Finance Lenders law - #6073454. NMLS# 740244. CA-DRE #00988341. CA Department of Corporations - 916-324-6624. CA Dept. of Real Estate - 916-227-0931.</p>
    </div>
</div><!-- /page -->

</body>
</html>