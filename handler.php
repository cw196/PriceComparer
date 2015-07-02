<?php

use google\appengine\api\users\User;
use google\appengine\api\users\UserService;



function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}




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
  
  
  
//display
echo "<h2>Information you need:</h2>";


$sql = "SELECT * from My_database where";
$sql_cpu = "";
$sql_ram = "";
$sql_storage = "";
$sql_keywords = "";

$array_cpu = array();
$array_ram = array();
$array_storage =array();
$array_keywords =array();
//CPU
if(($i7 = $_REQUEST["i7"])||($i5 = $_REQUEST["i5"])||($i3 = $_REQUEST["i3"])||($Intel_Celeron = $_REQUEST["Intel_Celeron"])||($AMD = $_REQUEST["AMD"]))
{
	
	$i7 = $_REQUEST["i7"];
	$i5 = $_REQUEST["i5"];
	$i3 = $_REQUEST["i3"];
	$Intel_Celeron = $_REQUEST["Intel_Celeron"];
	$AMD = $_REQUEST["AMD"];
	if($i7!=""){
		if((count($array_cpu))>0){
		$sql_cpu = $sql_cpu . " or CPU like :i7";}
		else{
			$sql_cpu = $sql_cpu . " CPU like :i7";
		}
		$array_cpu[":i7"]='%'.$i7.'%';
	}
	if($i5!=""){
		if(count($array_cpu)>0){
		$sql_cpu = $sql_cpu . " or CPU like :i5";}
		else{
			$sql_cpu = $sql_cpu . " CPU like :i5";
		}
		$array_cpu[":i5"]='%'.$i5.'%';
	}
	if($i3!=""){
		if(count($array_cpu)>0){
		$sql_cpu = $sql_cpu . " or CPU like :i3";}
		else{
			$sql_cpu = $sql_cpu . " CPU like :i3";
		}
		$array_cpu[":i3"]='%'.$i3.'%';
	}
	if($Intel_Celeron!=""){
		if(count($array_cpu)>0){
		$sql_cpu = $sql_cpu . " or CPU like :Intel_Celeron";}
		else{
			$sql_cpu = $sql_cpu . " CPU like :Intel_Celeron";
		}
		$array_cpu[":Intel_Celeron"]='%'.$Intel_Celeron.'%';
	}
	if($AMD!=""){
		if(count($array_cpu)>0){
		$sql_cpu = $sql_cpu . " or CPU like :AMD";}
		else{
			$sql_cpu = $sql_cpu . " CPU like :AMD";
		}
		$array_cpu[":AMD"]='%'.$AMD.'%';
	}
}
//RAM
if(($GB2 = $_REQUEST["GB2"])||($GB4 = $_REQUEST["GB4"])||($GB6 = $_REQUEST["GB6"])||($GB8 = $_REQUEST["GB8"])||($GB16 = $_REQUEST["GB16"]))
{
	
	$GB2 = $_REQUEST["GB2"];
	$GB4 = $_REQUEST["GB4"];
	$GB6 = $_REQUEST["GB6"];
	$GB8 = $_REQUEST["GB8"];
	$GB16 = $_REQUEST["GB16"];
	
	if($GB2!=""){
		if(count($array_ram)>0){
		$sql_ram = $sql_ram . " or RAM like :GB2";}
		else{
			$sql_ram = $sql_ram . " RAM like :GB2";
		}
		$array_ram[":GB2"]='%'.$GB2.'%';
	}
	if($GB4!=""){
		if(count($array_ram)>0){
		$sql_ram = $sql_ram . " or RAM like :GB4";}
		else{
			$sql_ram = $sql_ram . " RAM like :GB4";
		}
		$array_ram[":GB4"]='%'.$GB4.'%';
	}
	if($GB6!=""){
		if(count($array_ram)>0){
		$sql_ram = $sql_ram . " or RAM like :GB6";}
		else{
			$sql_ram = $sql_ram . " RAM like :GB6";
		}
		$array_ram[":GB6"]='%'.$GB6.'%';
	}
	if($GB8!=""){
		if(count($array_ram)>0){
		$sql_ram = $sql_ram . " or RAM like :GB8";}
		else{
			$sql_ram = $sql_ram . " RAM like :GB8";
		}
		$array_ram[":GB8"]='%'.$GB8.'%';
	}
	if($GB16!=""){
		if(count($array_ram)>0){
		$sql_ram = $sql_ram . " or RAM like :GB16";}
		else{
			$sql_ram = $sql_ram . " RAM like :GB16";
		}
		$array_ram[":GB16"]='%'.$GB16.'%';
	}
}	
//Storage
if(($S320GB = $_REQUEST["S320GB"])||($S500GB = $_REQUEST["S500GB"])||($S750GB = $_REQUEST["S750GB"])||($S1TB = $_REQUEST["S1TB"])||($S32GB = $_REQUEST["S32GB"])||($S16GB = $_REQUEST["S16GB"])||($S80GB = $_REQUEST["S80GB"]))
{
	
	$S320GB = $_REQUEST["S320GB"];
	$S500GB = $_REQUEST["S500GB"];
	$S750GB = $_REQUEST["S750GB"];
	$S1TB = $_REQUEST["S1TB"];
	$S32GB = $_REQUEST["S32GB"];
	$S16GB =$_REQUEST["S16GB"];
	$S80GB = $_REQUEST["S80GB"];
	if($S320GB!=""){
		if(count($array_storage)>0){
		$sql_storage = $sql_storage . " or Storage like :S320GB";}
		else{
			$sql_storage = $sql_storage . " Storage like :S320GB";
		}
		$array_storage[":S320GB"]='%'.$S320GB.'%';
	}
	if($S500GB!=""){
		if(count($array_storage)>0){
		$sql_storage = $sql_storage . " or Storage like :S500GB";}
		else{
			$sql_storage = $sql_storage . " Storage like :S500GB";
		}
		$array_storage[":S500GB"]='%'.$S500GB.'%';
	}
	if($S750GB!=""){
		if(count($array_storage)>0){
		$sql_storage = $sql_storage . " or Storage like :S750GB";}
		else{
			$sql_storage = $sql_storage . " Storage like :S750GB";
		}
		$array_storage[":S750GB"]='%'.$S750GB.'%';
	}
	if($S1TB!=""){
		if(count($array_storage)>0){
		$sql_storage = $sql_storage . " or Storage like :S1TB";}
		else{
			$sql_storage = $sql_storage . " Storage like :S1TB";
		}
		$array_storage[":S1TB"]='%'.$S1TB.'%';
	}
	if($S32GB!=""){
		if(count($array_storage)>0){
		$sql_storage = $sql_storage . " or Storage like :S32GB";}
		else{
			$sql_storage = $sql_storage . " Storage like :S32GB";
		}
		$array_storage[":S32GB"]='%'.$S32GB.'%';
	}
	if($S16GB!=""){
		if(count($array_storage)>0){
		$sql_storage = $sql_storage . " or Storage like :S16GB";}
		else{
			$sql_storage = $sql_storage . " Storage like :S16GB";
		}
		$array_storage[":S16GB"]='%'.$S16GB.'%';
	}
	if($S80GB!=""){
		if(count($array_storage)>0){
		$sql_storage = $sql_storage . " or Storage like :S80GB";}
		else{
			$sql_storage = $sql_storage . " Storage like :S80GB";
		}
		$array_storage[":S80GB"]='%'.$S80GB.'%';
	}
}
//keywords
if($keywords = $_REQUEST["keywords"]){
	$keywords = $_REQUEST["keywords"];
	if($keywords != ""){
		$sql_keywords= "title like :keywords";
	}
	$array_keywords[":keywords"]='%'.$keywords.'%';
}


	$sql_array = array($sql_cpu,$sql_ram,$sql_storage,$sql_keywords);
	$And_toggle = true;
	for($position = 0;$position < count($sql_array);$position++){
		if($sql_array[$position]!=""){
			if($And_toggle){
				$sql = $sql." (".$sql_array[$position].")";
				$And_toggle = false;
			}else{
				$sql = $sql." and (".$sql_array[$position].")";
			}
		}
	}


	$array_middle = array_merge($array_cpu,$array_ram);
	$array2 = array_merge($array_middle,$array_storage);
	$array = array_merge($array2,$array_keywords);
	//SQL 

	
	echo "
	<table class=\"table\">
    <thead>
      <tr>
        <th>Title</th>
        <th>CPU</th>
        <th>RAM</th>
		<th>Storage</th>
		<th>JB Price</th>
		<th>PB Price</th>
      </tr>
    </thead>
    ";
	try {
	$stmt = $db->prepare($sql);
	$stmt->execute($array);
	echo "<tbody>";	
		for($i=0;$row = $stmt->fetch();$i++){
			if($i%2==0){
				echo"
				<tr class=\"success\">
					<td>".$row['Title']."</td>
					<td>".$row['CPU']."</td>
					<td>".$row['RAM']."</td>
					<td>".$row['Storage']."</td>
					<td><a href='".$row['Access_JB']."'>".$row['Price_JB']."</a></td>
					<td><a href='".$row['Access_PB']."'>".$row['Price_PB']."</a></td>
				</tr>
				";
			}else{
				echo"
				<tr class=\"info\">
					<td>".$row['Title']."</td>
					<td>".$row['CPU']."</td>
					<td>".$row['RAM']."</td>
					<td>".$row['Storage']."</td>
					<td><a href='".$row['Access_JB']."'>".$row['Price_JB']."</a></td>
					<td><a href='".$row['Access_PB']."'>".$row['Price_PB']."</a></td>
				</tr>
				";
				
			}
		}
	echo"
		</tbody>
	</table>
	<div class=\"pull_right\">".$i."items</div>";
	}
	catch (PDOException $ex) {
	echo "errors";
	}








?>
