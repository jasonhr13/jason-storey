<?php
$speedTest = microtime ();
session_start();
ob_start();
$testingMode = false;
if(basename(dirname(__FILE__) ) == 'test'){
    $testingMode = true;
}

//-----------------------------------------------------------------------------------
//      Check basics and load data
//-----------------------------------------------------------------------------------

$acctid = trim($acctid);
$mainpath = trim($mainpath); 
$branchPath = trim($branchPath);
$protocol = (!empty($_SERVER['HTTPS'])) ? "https://" : "http://";
if($protocol == "https://") {
	$cachePage = false;
}

if(!isset($cachePage)){
	$cachePage = true;
}

if($testingMode){
	$testFolder = 'test/';
} else {
	$testFolder = '';
}

require('/lhp-page-loader/' . $testFolder . 'includes/functions.php');// Regular mode


$SiteInformation = getFile('SiteInformation.txt'); // get site information
$CompareInfo = getFile('updateCheck.txt');
if(@array_diff($SiteInformation[0],$CompareInfo[0])){
	$cacheUpdate = true;
} else {
	$cacheUpdate = false;
}
if(substr(strval($_SERVER['SERVER_NAME']), 0 ,4) == "www."){
	writeFile($SiteInformation,'updateCheck.txt');
}

if($mainpath == "" || $branchPath == ""){
	if($SiteInformation[0][5] == "custom"){
		$domainTrimmed = explode('.',$SiteInformation[0][0]);
		array_pop($domainTrimmed);
		array_shift($domainTrimmed);
		$domainTrimmed = implode(".",$domainTrimmed);
		
                if($mainpath == ""){
			$mainpath = $protocol . "www.lenderhomepage.com/content/custom/$domainTrimmed/";
		}
		if($branchPath == ""){
			$branchPath = $protocol . "www.lenderhomepage.com/content/custom/{$domainTrimmed}-branch/";
		}
	} else {
		if($SiteInformation[0][6] != "" && $SiteInformation[0][7] != ""){
                        if($mainpath == ""){
                            $mainpath = $protocol . "www.lenderhomepage.com/content/".$SiteInformation[0][6]."/".$SiteInformation[0][7]."/";
                        }
			if($branchPath == ""){
				$branchPath = $protocol . "www.lenderhomepage.com/content/".$SiteInformation[0][6]."/".$SiteInformation[0][7]."/";
			}
		}
		else {
			$cacheUpdate = true;
		}
	}
}

$path = $mainpath;
$domainURL = $protocol . $_SERVER['SERVER_NAME'];
$regularURL = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$fullURL = $protocol . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

//-----------------------------------------------------------------------------------
//      Check for cached page
//-----------------------------------------------------------------------------------
if($cachePage) {
	$loadingpage = checkForCachedPage();
}
if (isset($loadingpage) && !empty($loadingpage)){

	echo $loadingpage;
		/* turn this on to display called page*/
	echo "<!--";
	$speedTest = microtime() - $speedTest;
	echo " [ speed: ". $speedTest . " ] [cached]";
	echo "-->";

} else {

//-----------------------------------------------------------------------------------
//      Add www if missing
//-----------------------------------------------------------------------------------

$rootFolder = checkforWWWandslash($subdomains);

//-----------------------------------------------------------------------------------
//      More settings and data loading
//-----------------------------------------------------------------------------------


$InnerName = 'Inner.php';
if((isset($_SESSION['LoanOfficer2']) && $_SESSION['LoanOfficer2'] != '')){
	$InnerName = 'InnerLO.php';
}


$BranchList = getFile('BranchList.txt'); // get list of branches
$ExtraPages = getFile('ExtraPageLinks.txt'); // get list of extrapages
$LoanOfficerList = getFile('LoanOfficerList.txt'); // get loan officer list

if(!$LoanOfficerList || !$ExtraPages || !$BranchList || !$SiteInformation || $cacheUpdate){

	header("location:update?cb=".$regularURL);
	exit;
}

//-----------------------------------------------------------------------------------
//      Load branch account id and info if URL is a branch
//-----------------------------------------------------------------------------------
$mainbranchid = $acctid;
$calledUrl = checkForBranch($BranchList); // if found, set acctid and path to the selected branch and fix url




//-----------------------------------------------------------------------------------
//      Figure out what page template is loaded by last 2 letters
//-----------------------------------------------------------------------------------

$innerNames = array("Inner-no-box.php"=>"-b","Inner-no-qq.php"=>"-q", "Inner-one.php"=>"-1", "Inner-two.php"=>"-2", "Inner-three.php"=>"-3", "Inner-four.php"=>"-4", "Inner-five.php"=>"-5", "Inner-six.php"=>"-6", "Inner-seven.php"=>"-7", "Inner-eight.php"=>"-8", "Inner-nine.php"=>"-9", "Inner-ten.php"=>"-0");
$InnerMatchesAll = array();
$InnerReplaceMatchesAll = array();

foreach($innerNames as $innerFile => $abbr){
	if (substr($calledUrl,-strlen($abbr),strlen($abbr))===$abbr){
		if($InnerName == 'Inner.php'){ // check if file is set to default Inner.php
			$InnerName = $innerFile; // change the loading file name
			str_replace("Inner.php", $innerFile, $calledUrl); //If url is not replaced, revert it back to correct Inner name
		}
		$calledUrl = substr($calledUrl,0,strlen($calledUrl)-2); //Remove $abbr from end of url before loading
	}
}

//-----------------------------------------------------------------------------------
//      Check for blog
//-----------------------------------------------------------------------------------
$isBlogUrl = false;
$blogCategories = array("media-coverage", "press-releases", "mortgage-news", "featured-article", "blog", "recent-articles");
foreach($blogCategories AS $cat)
{
	if(strpos($calledUrl, $cat) === 0)
	{
		$isBlogUrl = true;
		if(trim($calledUrl) == $cat)
		{
			$calledUrl = "$InnerName?page=blogs&acctid=$acctid&cat=$calledUrl";
		}
		else
		{
			$calledUrl = "$InnerName?page=blogs-display&acctid=$acctid&id=$calledUrl";
		}
		
		break;
	}
}

//-----------------------------------------------------------------------------------
//      Build Extra Page Renaming Arrays
//-----------------------------------------------------------------------------------

require('/lhp-page-loader/' . $testFolder . 'includes/linkMap.php');
require('/lhp-page-loader/' . $testFolder . 'includes/reverseLinkMap.php');

$ExtraPageLinks = array();
$ExtraPageNames = array();
$ReverseExtraPageLinks = array();
$ReverseExtraPageNames = array();
if(!empty($ExtraPages)){
	foreach ($ExtraPages as $page){
		$pageurl = 'Inner.php?page=ExtraPages&acctid='.$acctid.'&pageId='.$page[0];
		array_push($ExtraPageLinks,$pageurl);
		$pageurl = $InnerName.'?page=ExtraPages&acctid='.$acctid.'&pageId='.$page[0];
		array_push($ReverseExtraPageLinks,$pageurl);
		$pagename = $page[1];
		array_push($ExtraPageNames,$pagename);
		$pagename = $page[1];
		array_push($ReverseExtraPageNames,$pagename);
	}
}
//var_dump($ExtraPages);
$names = array_merge($ExtraPageNames, $names);
$reverseNames = array_merge($ReverseExtraPageNames, $reverseNames);
$links = array_merge($ExtraPageLinks, $links);
$reverseLinks = array_merge($ReverseExtraPageLinks, $reverseLinks);

//-----------------------------------------------------------------------------------
//      Build Loan Officer Renaming Arrays
//-----------------------------------------------------------------------------------

$LOPageLinks = array();
$LOPageNames = array();

if(!empty($LoanOfficerList)){
	foreach ($LoanOfficerList as $LoanOfficer){
		
		$pageurl = 'LoanOfficer.php?selLoanOfficerId='.$LoanOfficer[0]."&acctid=".$acctid;
		array_push($LOPageLinks,$pageurl);
		$pagename = $LoanOfficer[1];
		array_push($LOPageNames,$pagename);
		
		$pageurl = 'LoanOfficer.php?selLoanOfficerId='.$LoanOfficer[0];
		array_push($LOPageLinks,$pageurl);
		$pagename = $LoanOfficer[1];
		array_push($LOPageNames,$pagename);

	}
}

$names = array_merge($LOPageNames, $names);
$links = array_merge($LOPageLinks, $links);

//-----------------------------------------------------------------------------------
//      Use Local Files Switch (true/false)
//-----------------------------------------------------------------------------------

if(strtolower($localFiles) == (true || "y" || "yes" || 1))
	{
	$localLinks = 	array(
		"url(images/",
		'"images/',
		"'images/",
		'"css/',
		'"js/',
		'Scripts/'
	);
	
	$localNames = array(
		'url(/images/',
		'"/images/',
		"'/images/",
		'"/css/',
		'"/js/',
		'"/Scripts/'
	);	
	}else{
	$localLinks = 	array(
		"url(images/",
		"\"/images/",
		"\"images/",
		"'images/",
		"\"css/",
		"\"js/",
		"\"Scripts/"
	);
	
	$localNames = array(
		"url(".$mainpath."images/",
		"\"{$protocol}www.lenderhomepage.com/images/",
		"\"".$mainpath."images/",
		"'".$mainpath."images/",
		"\"".$mainpath."css/",
		"\"".$mainpath."js/",
		"\"".$mainpath."Scripts/"
	);
	
	
}
$names = array_merge($names, $localNames);
$links = array_merge($links, $localLinks);

//-----------------------------------------------------------------------------------
//      Add the custom URL replacement
//-----------------------------------------------------------------------------------

$innerNamesList = array("Inner-no-box.php", "Inner-no-qq.php", "Inner-one.php", "Inner-two.php", "Inner-three.php", "Inner-four.php", "Inner-five.php", "Inner-six.php", "Inner-seven.php", "Inner-eight.php", "Inner-nine.php", "Inner-ten.php", "Inner.php");
if(isset($originalUrls) && is_array($originalUrls) && isset($newUrls) && is_array($newUrls)){
	
	$innerLoUrls = array();
	foreach ($originalUrls as $key => $value){
		$originalUrls[$key] = str_replace($mainbranchid, $acctid, $originalUrls[$key]);
		$innerLoUrls[] = str_replace($innerNamesList, "InnerLO.php", $originalUrls[$key]);
		
	}
	$links = array_merge($originalUrls, $links);
	$links = array_merge($innerLoUrls, $links);
	$names = array_merge($newUrls, $names);
	$names = array_merge($newUrls, $names);
}
if(isset($newUrlsLoaded) && is_array($newUrlsLoaded) && isset($originalUrlsLoaded) && is_array($originalUrlsLoaded)){
	foreach ($newUrls as $key => $value){
		$originalUrlsLoaded[$key] = str_replace($mainbranchid, $acctid, $originalUrlsLoaded[$key]);
	}
	$reverseLinks = array_merge($originalUrlsLoaded, $reverseLinks);
	$reverseNames = array_merge($newUrlsLoaded, $reverseNames);
}
//-----------------------------------------------------------------------------------
//      Add Blog Stripping
//-----------------------------------------------------------------------------------

array_push($links,"\"Inner.php?page=blogs-display&acctid=$acctid&id=");
array_push($names,"\"");
array_push($links,"\"Inner.php?page=blogs&acctid=$acctid&cat=");
array_push($names,"\"");


//-----------------------------------------------------------------------------------
//      Unset Loan Officer SESSION on Homepages
//-----------------------------------------------------------------------------------

if ($calledUrl == 'homepage'){// if url is homepage delete loan officer session
	$_SESSION['LoanOfficer2'] = '';
	$_SESSION['LOUserId'] = '';

} elseif ($calledUrl == ($rootFolder || '')){// if the webpage is reloaded delete the loan officer
	$calledUrl = "homepage";
	$_SESSION['LoanOfficer2'] = '';
	$_SESSION['LOUserId'] = '';

} elseif(isset($_GET['LoOfficerId']) && !empty($_GET['LoOfficerId'])){
	$_SESSION['LoanOfficer2'] = $_GET['LoOfficerId'];	
}

//-----------------------------------------------------------------------------------
//      Find the real URL to load from lenderhomepage
//-----------------------------------------------------------------------------------
//$urlToLoad = str_replace($reverseNames,$reverseLinks,$calledUrl);
if(is_array($originalUrlsLoaded))
{
	$reverseLinks = array_merge($originalUrlsLoaded, $reverseLinks);
}
if(is_array($newUrlsLoaded))
{
	$reverseNames = array_merge($newUrlsLoaded, $reverseNames);
}


$urlToLoad = $calledUrl;
if(!$isBlogUrl)
{
	foreach ($reverseNames as $uniqueKey => $foundName)
	{
			if(strpos($calledUrl, $foundName) === 0)
			{
				$urlToLoad = str_replace($foundName, $reverseLinks[$uniqueKey], $calledUrl);
				break;
			}
	}
}

//-----------------------------------------------------------------------------------
//      Check for loan officers and fix the URL
//-----------------------------------------------------------------------------------
if($urlToLoad == $calledUrl) { //if the url wasn't found try loan officers
	if ($calledUrl == "LoanOfficer.php?acctid=".$acctid) { //Check if loan officer ID is located in the POST and put it in the URL
		if(isset($_POST['selLoanOfficerId'])){
			$LoanOfficerID = $_POST['selLoanOfficerId'];
			$newurl = "LoanOfficer.php?acctid=".$acctid."&selLoanOfficerId=".$LoanOfficerID;
			$_SESSION['LoanOfficer2'] = $LoanOfficerID;

			header("location:".$newurl);
			exit; // rewrite url to a useable link and reload page
		}
	}
	foreach ($LoanOfficerList as $LoanOfficer){ //cycle through loan officers usernames to see if one was called

		if ($calledUrl == $LoanOfficer[1]){
			$_SESSION['LOUserId'] = $LoanOfficer[1];
			$urlToLoad = "LoanOfficer.php?acctid=". $acctid ."&OfficerUser=".$LoanOfficer[1];
			//if(!isset($_SESSION['LoanOfficer2']) || $_SESSION['LoanOfficer2']==''){
				$_SESSION['LoanOfficer2'] = $LoanOfficer[0];	
			//}
			if($regularURL != $LoanOfficer[2]){//catch old LO links and use branch style : example old "www.domain.com/username" new "www.domain.com/branch/username"
				$newurl = $protocol . $LoanOfficer[2];

				header("location:".$newurl);
				exit;
			}
			break;
		} elseif ($calledUrl == "LoanOfficer.php?selLoanOfficerId=".$LoanOfficer[0] ) { //check if loan officer url with only selLoanOfficerId
			$_SESSION['LOUserId'] = $newurl = $LoanOfficer[1];
			$_SESSION['LoanOfficer2'] = $LoanOfficer[0];

			header("location:".$newurl);
			exit; // rewrite url to loan officer username
		} elseif($calledUrl == "LoanOfficer.php?acctid=".$acctid."&selLoanOfficerId=".$LoanOfficer[0]){
			$_SESSION['LOUserId'] = $newurl = $LoanOfficer[1];
			$_SESSION['LoanOfficer2'] = $LoanOfficer[0];

			header("location:".$newurl); // rewrite url to loan officer username
			exit;
		}
	}
	
}

if($_SESSION['LoanOfficer2'] != '' && !isset($_GET['LoOfficerId']) ){ // This section adds LoOfficerId to the end of URLs when a lown officer is set in the SESSION
	$urlToLoad = $urlToLoad."&LoOfficerId=".$_SESSION['LoanOfficer2'];
}
//-----------------------------------------------------------------------------------
//      Add /setup
//-----------------------------------------------------------------------------------

if(strtolower($calledUrl) == 'setup'){

	header('location:https://www.lenderhomepage.com/admin/login.php?acctid='.$acctid);
	exit;
}

//-----------------------------------------------------------------------------------
//      Form submit URL fixes
//-----------------------------------------------------------------------------------

array_push($links,"\"Inner.php?acctid=".$acctid."&page=submitquote");
array_push($names,"\"{$protocol}www.lenderhomepage.com/content/noframe_templates/inner/Inner.php?acctid=".$acctid."&page=submitquote-domain&selLoanOfficerId=".$_SESSION['LoanOfficer2']);
array_push($links,"\"{$protocol}www.lenderhomepage.com/content/phpfiles/submitquote.php");
array_push($names,"\"{$protocol}www.lenderhomepage.com/content/noframe_templates/inner/Inner.php?acctid=".$acctid."&page=submitquote-domain&selLoanOfficerId=".$_SESSION['LoanOfficer2']);


$lhpPageData = grabURLdata($path.$urlToLoad); // download webpage from lenderhomepage.com
createPageCache();

//-----------------------------------------------------------------------------------
//      Check For page errors 
//-----------------------------------------------------------------------------------

$display404 = false;
if (strpos($lhpPageData,"<h1>Page not found (404)</h1>") > -1){
		createPageCache("-Error1-");
        $display404 = true;
		$cachePage = FALSE;
		$ErrorType = 1;
} elseif (strpos($lhpPageData,"<b>Warning</b>:  mysql_fetch_object():") > -1){
		createPageCache("-Error2-");
		$display404 = true;
		$cachePage = FALSE;
		$ErrorType = 2;
} elseif (strpos($lhpPageData,"<b>Warning</b>:  main(../../phpfiles/") > -1){
		createPageCache("-Error3-");
        $display404 = true;
		$cachePage = FALSE;
		$ErrorType = 3;
} elseif (strpos($lhpPageData,"select * from") > -1){
		createPageCache("-Error4-");
        $display404 = true;
		$cachePage = FALSE;
		$ErrorType = 4;
} elseif (strpos($lhpPageData,"error in your SQL syntax") > -1){
        $display404 = true;
		$cachePage = FALSE;
		$ErrorType = 6;
} elseif (strpos($lhpPageData,"</body>") === false && strpos($lhpPageData,"</BODY>") === false){
		$cachePage = FALSE;
		$ErrorType = 5;
} 


//-----------------------------------------------------------------------------------
//      Unset loan officer if the page error was found and try again
//-----------------------------------------------------------------------------------

if($cachePage == FALSE && $_SESSION['LoanOfficer2'] != '' && $ErrorType != 1 && $ErrorType != 5 && $ErrorType != 6){
		$_SESSION['LoanOfficer2'] = "";
		$_SESSION['LOUserId'] = "";
		header("location:".$fullURL);
		exit;
} elseif (strpos($urlToLoad,'InnerLO.php') > -1 && $cachePage == FALSE) {
		$_SESSION['LoanOfficer2'] = "";
		$_SESSION['LOUserId'] = "";

		header("location:".$fullURL);
		exit;
}

if($display404){
    if(!isset($showHomePageOn404)){
        $showHomePageOn404 = false;
    }
    if(!$showHomePageOn404){
        display404();
    }
    else {
        $lhpPageData = grabURLdata($path."Index.php?page=Default&acctid=".$acctid);
    }
}


foreach($innerNames as $innerFile => $abbr){//find links on page matching other inner names
	preg_match_all("/\"".$innerFile."(\?[^\"]*)/",$lhpPageData,$matches);
	$replaceMatches = array();
	foreach ($matches[1] as $match){
			$replaceMatches[] = "\"Inner.php".$match.$abbr;
	}
	$InnerMatchesAll = array_merge($InnerMatchesAll,$matches[0]);
	$InnerReplaceMatchesAll = array_merge($InnerReplaceMatchesAll,$replaceMatches);
}
preg_match("/<script [\w\"\'= .\/><]+(?:jsfunctions.js)[\w\"\'= .\/><]+(?:<\/script>)/i", $lhpPageData, $jsmatches); //remove old functions.js call
array_push($links,$jsmatches[0]);
array_push($names,"");


array_unshift($names,"&");// fix wrong symbols
array_unshift($links,"&amp;");
$links = array_merge($InnerMatchesAll, $links);
$names = array_merge($InnerReplaceMatchesAll, $names);

//-----------------------------------------------------------------------------------
//      Substitute URL for testing site
//-----------------------------------------------------------------------------------
/*
if(strpos($fullURL , "/whm-load") > -1){
	$names[] = $domainURL . "/whm-load";
} else {
	$names[] = $domainURL;
}
$links[] = $alternateDomainURL;
*/

//-----------------------------------------------------------------------------------
//      Rewrite page and display it
//-----------------------------------------------------------------------------------

$pagetodisplay = str_replace($links,$names,$lhpPageData); // replace urls
//var_dump($names,$links);

	echo $pagetodisplay; //DISPLAY PAGE!!!
	
/* turn this on to display called page*/
	echo "<!--";
	echo $path.$urlToLoad;
	$speedTest = microtime() - $speedTest;
	echo " [ speed: ". $speedTest . " ] [not-cached]";
	echo "-->";
// turn this on for fixing link bugs
/*	echo "<br /><br />************* LINKS ************* <br />";
	print_r($links);
	echo "<br /><br />************* NAMES ************* <br />";
	print_r($names);
	echo "<br /><br />************* REVERSENAMES ************* <br />";
	print_r($reverseNames);
	echo "<br /><br />************* REVERSELINKS ************* <br />";
	print_r($reverseLinks);
*/

	if ($cachePage){
		if(!createPageCache()){
//			echo "failed to cache page";
		}
	}

	
}
?>