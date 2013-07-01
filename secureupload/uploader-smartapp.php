<?php

$target_path = "uploads/";


$fdfName = basename($_FILES['uploaded_xfdf']['name']);

$extFDF = substr($fdfName, strrpos($fdfName, '.') + 1);

if (($extFDF == "xfdf") && ($_FILES["uploaded_xfdf"]["size"] <= 5000000)) {
	$pdf = "1003irev.pdf";
	$xfdf = $target_path . basename( $_FILES['uploaded_xfdf']['name']); 
	
	$name = basename($xfdf);
	$name = basename($xfdf, ".xfdf");
		if((move_uploaded_file($_FILES[				'uploaded_xfdf']['tmp_name'], $xfdf))) {
		header('Content-Description: File Transfer'); 
		header('Content-Type: application/pdf'); 
		header('Content-Disposition: attachment; filename="' . $name . '"'); 
		header('Content-Transfer-Encoding: binary'); 
		header('Expires: 0'); 
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
		header('Pragma: public'); 
		header('Content-Length: ' . filesize($xfdf)); 
		passthru("pdftk " . $pdf  . " fill_form " . $xfdf . " output pdfs/" . $name . ".pdf");
		exit();
} else{
    echo "There was an error uploading the file, please try again!";
}
}
else {
	echo "Nope";
}