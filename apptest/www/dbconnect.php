<?php
	$con = @mysql_connect("localhost","gothemor_phpdev2","Kriya2002_arexo1414");
	//$con = @mysql_connect("localhost", "root", "");
	$OK = @mysql_select_db("gothemor_forms",$con);
	if(!$OK){
		print("Unable to connect...");
	}
?>