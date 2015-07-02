<?php   

use google\appengine\api\users\User;
use google\appengine\api\users\UserService;



 // Create a connection.
  $db = null;
  if (isset($_SERVER['SERVER_SOFTWARE']) &&
  strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
    // Connect from App Engine.
    try{
       $db = new pdo('mysql:unix_socket=/cloudsql/my-second-965:php;dbname=data_computer', 'root', '');
    }catch(PDOException $ex){
        die(json_encode(
            array('outcome' => false, 'message' => 'Unable to connect.')
            )
        );
    }
  } else {
    // Connect from a development environment.
    try{
       $db = new pdo('mysql:host=127.0.0.1:3306;dbname=data_computer', 'root', '1234');
    }catch(PDOException $ex){
        die(json_encode(
            array('outcome' => false, 'message' => 'Unable to connect')
            )
        );
    }
  }
  
//recreate table  
$db->query("drop table JB;");
$db->exec("CREATE TABLE JB(
		Title varchar(255),
		CPU varchar(255),
		RAM varchar(255),
		Storage varchar(255),
		Price Float,
		Access_JB varchar(255)
	); ");


 

//scrape data;

$html  = new  DOMDocument();   
  
libxml_use_internal_errors(true);
$html ->loadHTML(file_get_contents('http://www.jbhifi.co.nz/computers/laptop-notebook/'));   
$html ->preserveWhiteSpace = false;

$divs=$html ->getElementsByTagName("div");

foreach($divs as $div){
	$cpu=NULL;
	$ram=NULL;
	$storage=NULL;
	$features = "";
	$attri_div=$div->getAttribute('class');
	if($attri_div =="content"){
		$title=getTitle($div);
	
		$price=getSrc($div);
		
		
		$features_divs = $div ->getElementsByTagName("div");
		foreach($features_divs as $features_div){
			if($features_div->getAttribute('class')=="feature"){
				$as = $features_div ->getElementsByTagName("a");
				
				foreach($as as $a){
					$feature= $a->nodeValue;
					$link_JB = $a->getAttribute('href');
					$string = htmlentities($feature, null, 'utf-8');
					$feature = str_replace("&nbsp;","",$string);
					$feature = str_replace("&bull;","",$string);

					$features = $features.",".$feature;
				}
			}
		}
		
		
		
		$string=explode(",",$features);
		foreach($string as $out){
			if(stripos($out,"Intel")||stripos($out,"AMD")||stripos($out,"Atom")||stripos($out,"Celeron")||stripos($out,"Processor")){
				$cpu= $out;
			}
			if(stripos($out,"RAM")){
				$ram=$out;
			}
			if(stripos($out,"Hard Drive")||stripos($out,"Emmc")||stripos($out,"SSD")||stripos($out,"HDD")){
				$storage=$out;
			}
		}
		
		echo $title."<br />".$price."<br />".$cpu."<br />".$ram."<br/>".$storage."<br/>".$link_JB."<br/>";
		
		//insert into database
		try {
		$stmt = $db->prepare('INSERT INTO JB (Title,CPU,RAM,Storage,Price,Access_JB) VALUES (:title, :cpu, :ram, :storage, :price, :access_JB)');
		$stmt->execute(array(':title' => $title, ':cpu' => $cpu, ':ram' => $ram,':storage' => $storage, ':price' => $price, ':access_JB' => $link_JB));
		}
		catch (PDOException $ex) {
		echo "errors";
		}
		
	}

}
function getTitle(DOMElement $sub_div){
	$div_titles=$sub_div->getElementsByTagName("div");
	foreach($div_titles as $div_title){
		$attri_title=$div_title->getAttribute('class');
		if($attri_title=="descr-padding"){
			$title=$div_title->getElementsByTagName("a")->item(0)->getAttribute('title');
		}
		
	}
	return $title;
}

function getSrc(DOMElement $sub_div){
	$div_prices=$sub_div->getElementsByTagName("div");
	foreach($div_prices as $div_price){
		$attri_price=$div_price->getAttribute('class');
		if($attri_price=="xobecirp"){
			$srcs=$div_price->getElementsByTagName("img")->item(0)->getAttribute('src');
		}
	}
	
	$prices=explode("/",$srcs);
	
	$price_png=$prices[4];
	$price=explode("_",$price_png);
	$price_float= floatval($price[0]);
	 return $price_float;
	
}



  
$db = null;

?>    