<?php 
// Used by update.php
function checkforwww(){
	if(substr($_SERVER['SERVER_NAME'], 0 ,4) != "www."){
		$url = (!empty($_SERVER['HTTPS'])) ? "https://www.".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://www.".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		header("location:".$url);
		exit;
	}
}

function checkforWWWandslash($subdomains = array()){
        if(empty($subdomains)){
            $subdomains = array('www');
        }
	$serverName = strval($_SERVER['SERVER_NAME']);

	if(strpos($serverName,'72.232.246.170') > -1 || strpos($serverName,'72.232.240.218') > -1){
		header("location:index-classic.php");
		exit;
	}
        $found = false;
        foreach($subdomains AS $subdomain){
            if(strpos($_SERVER['SERVER_NAME'], $subdomain . '.') === 0){
                $found = true;
                break;
            }
        }
	if(!$found){
		$url = (!empty($_SERVER['HTTPS'])) ? "https://www.".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://www.".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		header("location:".$url);
		exit;
		
	} elseif (substr($_SERVER['REQUEST_URI'], -1, 1) == "/" && $_SERVER['REQUEST_URI'] != "/"){
		$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$url = substr($url, 0, -1);
		header("location:".$url);
		exit;
	} elseif($_SERVER['REQUEST_URI'] == '/homepage'){
		$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'] : "http://".$_SERVER['SERVER_NAME'];
		header("location:".$url);
		exit;
	}
}

function formatlist($ExtraPages) {
	$fixedlist = array();
	//$replaceList = array(" ","/","?","&","'",'"',"|");
	$ExtraPages = strtolower(substr($ExtraPages, 1, -1));
	$ExtraPages = explode('//',$ExtraPages);
	foreach ($ExtraPages as $page){
		$page = str_replace(" ","-",$page);
		$page = explode('=>',$page);
		array_push($fixedlist,$page);
	}
	return $fixedlist;
}

function grabURLdata($url){
	
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL,$url); 
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_REFERER, $_SERVER['SERVER_NAME']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($ch); 
	curl_close($ch);
	
	return $data;
}


function writeFile($List,$filename){
    
    $tmpPath = getTmpFoldPath();
	$domain = nameStyleURL($_SERVER['SERVER_NAME']);
	checkFileWrite($tmpPath . $domain.'-'.$filename);
    if(!validUrl($filename)){
        return true;
    }
	if (!file_put_contents($tmpPath . $domain.'-'.$filename, serialize($List)))
		die ("Can't open file of ".$domain.$filename);
	return true;
}

function checkTime(){
    $tmpPath = getTmpFoldPath();
	$domain = nameStyleURL($_SERVER['SERVER_NAME']);
	checkFileWrite($tmpPath . $domain.'-'.'lastupdate.txt');
	$lastupdate =  file_get_contents($tmpPath . $domain.'-'.'lastupdate.txt');
	if (intval($lastupdate + 300) <= time()){
		if (!file_put_contents($tmpPath . $domain.'-'.'lastupdate.txt', time())){
			die ("Can't open file of ".$filename);
		}
		return true;
	} else return false;
}

function checkFileWrite($file) {
	if(!file_exists(dirname($file))){
		mkdir(dirname($file));
	}
	if(file_exists($file)){
		if(!chmod($file, 0777))
			die("Can't edit permissions of ".$file);
	}
}

function getTmpFoldPath(){
    $domain = nameStyleURL($_SERVER['SERVER_NAME']);
    return '/tmp/'.$domain.'/';
}

function getFile($filename){
	$tmpPath = getTmpFoldPath();
    $domain = nameStyleURL($_SERVER['SERVER_NAME']);
    $fileName = $tmpPath . $domain.'-'.$filename;
	if(file_exists($fileName)){
		$contents =  file_get_contents($fileName);
		$contents_array = unserialize($contents);
		return $contents_array;
	} else {
		return false;	
	}
}

function limitNumOfCaches(){
    $tmpPath = getTmpFoldPath();
    if (glob($directory . "*.txt") != false)
    {
        $filecount = count(glob($directory . "*.jpg"));
        if($filecount > 150){
            deleteOldestCache();
        }
    }
    
}

function deleteOldestCache(){
    $tmpPath = getTmpFoldPath();
    $files = glob( $tmpPath );
    // Sort files by modified time, latest to earliest
    // Use SORT_ASC in place of SORT_DESC for earliest to latest
    array_multisort(
        array_map( 'filemtime', $files ),
        SORT_NUMERIC,
        SORT_DESC,
        $files
    );
    unset($files[0]);
}

function checkForBranch($BranchList) {
	$serverpath = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	global $path;
	global $acctid;
	global $branchPath;
	
	if(!empty($BranchList[0][0])){
		foreach ($BranchList as $branch){
			//die($serverpath."<-server and database->".$trimbranch);
			if(strpos($serverpath, $branch[1])>-1){
				$acctid = $branch[0];
				$path = $branchPath;
				if($serverpath == $branch[1]){
					$newurl = (!empty($_SERVER['HTTPS'])) ? "https://".$branch[1]."/" : "http://".$branch[1]."/homepage";
					header("location:".$newurl);
					exit;
				}
				break;
			}
		}
	}
	$calledUrl = basename($_SERVER['REQUEST_URI']);
	return $calledUrl;	
}

function createPageCache($preName = "") {
    $tmpPath = getTmpFoldPath();
	$url = nameStyleURL($_SERVER['REQUEST_URI']);
	$filename = $preName . "cachedURL-".$url."-".$_SESSION['LoanOfficer2'].".txt";
	checkFileWrite($tmpPath . $filename);
	$bufferContents = ob_get_contents();
	if(writeFile($bufferContents, $filename)){
        limitNumOfCaches();
		return true;	
	} else return false;
}

function validUrl($fileName){
    $doNotSavePrePrefixs = array(
        'LoanOfficer.php',
        'InnerLO.php',
        'Index.php',
        'Inner.php',
        'Inner-one.php',
        'Inner-two.php',
        'Inner-three.php',
        'Inner-four.php',
        'Inner-five.php',
        'Inner-six.php',
        'Inner-seven.php',
        'Inner-eight.php',
        'Inner-nine.php',
        'Inner-ten.php'
        );
    foreach ($doNotSavePrePrefixs AS $prefix){
        if(strpos($fileName, $prefix) !== false){
            return false;
        }
    }
    return true;
    
}

function deleteCacheOfURL($url) {
    $tmpPath = getTmpFoldPath();
	$parsed = parse_url($url); 
	$domain = nameStyleURL($parsed['host']);
	$path = nameStyleURL($parsed['path']);
	$query = nameStyleURL($parsed['query']);
	$filename = $tmpPath . $domain."-cachedURL-".$path.$query."-".$_SESSION['LoanOfficer2'].".txt";   
	if(unlink($filename)){
		return true;	
	} else {
		return false;
	}
}



function checkForCachedPage() {
    
	$url = nameStyleURL($_SERVER['REQUEST_URI']);
	$domain = nameStyleURL($_SERVER['SERVER_NAME']);
	$filename = "cachedURL-".$url."-".$_SESSION['LoanOfficer2'].".txt";
	if ($contents = getFile($filename)) {
		/*$CreationDate = filemtime('/tmp/'.$domain.'/'.$domain.'-'.$filename);
		if (intval($CreationDate + 24*60*60)>= time()){*/
		if(empty($contents) || $contents == "\r\n"){
			return false;
		}
			return $contents;
		/*} else return false */
	} else return false;
	
}

function clearCachedPages(){
    $tmpPath = getTmpFoldPath();
	$domain = nameStyleURL($_SERVER['SERVER_NAME']);
	$filelist = "<br />Cache Deleted<br />";
	$files = glob($tmpPath . $domain.'*.txt');
	foreach ($files as $file){
		$filelist .= $file."<br>";
		unlink($file);
	}
	return $filelist;
}

function nameStyleURL($url){
	$badchars = array ("/","\\",":","*","?","<",">","|");
	$url = str_replace($badchars, "", $url);
	return $url;
}


function display404(){
    header('HTTP/1.0 404 Not Found');
    echo '<img src="http://www.lenderhomepage.com/content/images/404.jpg" style="width:500px;margin:0 auto;">';
    exit();
}
