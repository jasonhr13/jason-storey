<?php
	include('http://www.jason-storey.com/apptest/www/function.php');
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width, initial-scale
= 1.0, user-scalable = no">
<title>Gingersnaps Cafe</title>

<link rel="stylesheet" href="main.css" type="text/css" />
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css">

<script src="special.js" type="text/javascript"></script>
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
</head>

<body>

<div id="wrapper">
    
    	<header id="header">
        	<img src="logo.png" width="300" height="127" />
        </header>
        
        <section id="main">
        	
          <div id="Accordion1" class="Accordion" tabindex="0">
              <div class="AccordionPanel">
                <div class="AccordionPanelTab"><span class="label">Todays Special</span></div>
                <div class="AccordionPanelContent">
                <p class="specials">

<script type="text/javascript">

document.write(x);
</script>

</p>                
                </div>
              </div>
              <div class="AccordionPanel">
                <div class="AccordionPanelTab"><span class="label">Menu</span></div>
                <div class="AccordionPanelContent">
                
             <?php contents("Food-Cravings"); ?>
                
                </div>
              </div>
          </div>
        </section>
        
	</div>
<script type="text/javascript">
<!--
 
var Accordion1 = new Spry.Widget.Accordion("Accordion1", { useFixedPanelHeights: false, defaultPanel: -1 });
 
//-->
</script>

<?php
	if(isset($_REQUEST['flg']))
		flags($_REQUEST['flg']);
	?>
</body>
</html>
