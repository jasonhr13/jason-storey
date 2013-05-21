<?php 
// Enter account #
$acctid = "101473"; 
// Enter correct paths for lhp
$mainpath = ""; //default is the website name folder
$branchPath = ""; //default is the same folder -branch

$localFiles = false; //Set to true so the css javascript and images on the domain for faster load times.
$cachePage = true; // Set to false for no caching, this will reduce performance

/*Replace string of text with the new URLs or paths on the page as it loads
* Example 
*	$originalUrls = array(
*		'"Inner.php?Category=calculators&page=static&acctid='.$acctid,
*		'"Inner.php?Category=LoanProcess&page=static&acctid='.$acctid,
*		'www.loanland.com'
*	);
*	$newUrls = array(
*		'"calculators',
*		'"loan-process',
*		'www.boughtoutloanland.com'
*	);
*
*/

$originalUrls = array();
$newUrls = array();

$subdomains = array('mobile','www');

/*Find the lenderhomepage URL for downloading the page
* Example 
*	$newUrlsLoaded = array(
*		'calculators',
*		'loan-process'
*	);
*	$originalUrlsLoaded = array(
*		'Inner.php?Category=calculators&page=static&acctid='.$acctid,
*		'Inner.php?Category=LoanProcess&page=static&acctid='.$acctid
*	);
*
*/
$newUrlsLoaded = array();
$originalUrlsLoaded = array();
?>