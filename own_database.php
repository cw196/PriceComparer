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
$db->query("drop table My_database;");
$db->exec("CREATE TABLE My_database(
		ID int NOT NULL,
		Title varchar(255),
		CPU varchar(255),
		RAM varchar(255),
		Storage varchar(255),
		Access_JB varchar(255),
		Access_PB varchar(255),
		Price_JB Float,
		Price_PB Float
	); ");

	$html  = new  DOMDocument();   
  
	libxml_use_internal_errors(true);
	
try {
	$stmt = $db->query("SELECT Title,CPU,RAM,Price,Storage,Access_JB from JB;");
	$ID=0;
	$inserted_PB_item= array();
	$i=0;
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$title_JB=$row['Title'];
		$CPU_JB=$row['CPU'];
		$RAM_JB=$row['RAM'];
		$Storage_JB=$row['Storage'];
		$Price_JB=$row['Price'];
		$Link_JB =$row['Access_JB'];
		$search_key_word= extract_key_words($title_JB);
	
		$stmt2 = $db->prepare("SELECT ID, Title, Price, Access_PB from PB where title like :search_key_word1 and title like :search_key_word2");
		
		$stmt2->execute(array(':search_key_word1' => '%'.$search_key_word[0].'%',':search_key_word2' => '%'.$search_key_word[1].'%'));
		
		$inserted = false;
		$Link_PB=NULL;
		$title_PB=NULL;
		$Price_PB=0;
			//list the item in PB have the same band and type with the item in JB
		for(;($row2=$stmt2->fetch())&&($inserted==false);){
				
				$ID_PB=$row2['ID'];
				$title_PB=$row2['Title'];
				$Price_PB=$row2['Price'];
				$Link_PB=$row2['Access_PB'];
				$match= match($title_PB,$CPU_JB,$RAM_JB,$Storage_JB);
				//if the item has the same brand and type in JB and PB, compare each item in the list whether it has the same CPU type and RAM size.
				//insert the item has the same specifications in PB and JB.
				if($match == true){
					
					$ID++;					
					$stmt3 = $db ->prepare('INSERT INTO My_database (ID, Title, CPU, RAM, Storage, Access_JB, Access_PB, Price_JB, Price_PB)  VALUES (:ID, :title, :cpu, :ram, :storage, :link_JB, :link_PB, :price_JB,:price_PB)');
					$stmt3->execute(array(':ID' => $ID, ':title' => $title_JB, ':cpu' => $CPU_JB, ':ram' => $RAM_JB,':storage' => $Storage_JB,':link_JB'=> $Link_JB,':link_PB'=>$Link_PB, ':price_JB' => $Price_JB,':price_PB'=>$Price_PB ));
					$inserted=true;
					break;
				}
		}	
		//insert items only contained in JB
		if($inserted == false){
			$Link_PB=NULL;
			$title_PB=NULL;
			$Price_PB=null;
			$ID++;
			$stmt4 = $db ->prepare('INSERT INTO My_database (ID, Title, CPU, RAM, Storage, Access_JB, Access_PB,Price_JB,Price_PB)  VALUES (:ID, :title, :cpu, :ram, :storage, :link_JB, :link_PB, :price_JB,:price_PB)');
			$stmt4->execute(array(':ID' => $ID, ':title' => $title_JB, ':cpu' => $CPU_JB, ':ram' => $RAM_JB,':storage' => $Storage_JB, ':link_JB'=> $Link_JB,':link_PB'=>$Link_PB,':price_JB' => $Price_JB, ':price_PB'=>$Price_PB));
			$inserted=true;
		}
	}
}  

catch (PDOException $ex) {
	echo "errors";
}
	

function extract_key_words($title_JB){
	$title_keys=explode(",",$title_JB);
	$title_key=$title_keys[0];
	
	$title_keys=explode(' ',$title_key);
	$brand=$title_keys[0];
	$type=$title_keys[1];
	$specifications[0]=$brand;
	$specifications[1]=$type;

	return $specifications;
}	

function match($title_PB,$CPU_JB,$RAM_JB,$Storage_JB){
	//extract CPU
	$CPU_match=NULL;
	if(stripos($CPU_JB,"i7")){
		$CPU_match="i7";
	}else{
		if(stripos($CPU_JB,"i5")){
			$CPU_match="i5";
		}else{
			if(stripos($CPU_JB,"i3")){
				$CPU_match="i3";
			}else{
				if(stripos($CPU_JB,"Celeron")){
					$CPU_match="Celeron";
				}else{
					if(stripos($CPU_JB,"AMD")){
						$CPU_match="AMD";
					}
				}	
			}		
		}			
	}

	$RAM_match=NULL;
	if(stripos($RAM_JB,"2GB")){
		$RAM_match="2GB";
	}
	else{
		if(stripos($RAM_JB,"4GB")){
			$RAM_match="4GB";
		}else{
			if(stripos($RAM_JB,"6GB")){
				$RAM_match="6GB";
			}else{
				if(stripos($RAM_JB,"8GB")){
					$RAM_match="8GB";
				}else{
					if(stripos($RAM_JB,"16GB")){
						$RAM_match="16GB";
					}
				}
			}
		}
	}
	

	$Storage_match =NULL;
	if(stripos($Storage_JB,"32GB")){
		$Storage_match="32GB";
	}else{
		if(stripos($Storage_JB,"128GB")){
			$Storage_match="128GB";
		}else{
			if(stripos($Storage_JB,"80GB")){
				$Storage_match="80GB";
			}else{
				if(stripos($Storage_JB,"256GB")){
					$Storage_match="256GB";
				}else{
					if(stripos($Storage_JB,"320GB")){
						$Storage_match="320GB";
					}else{
						if(stripos($Storage_JB,"500GB")){
							$Storage_match="500GB";
						}else{
							if(stripos($Storage_JB,"750GB")){
								$Storage_match="750GB";
							}else{
								if(stripos($Storage_JB,"1TB")){
									$Storage_match="1TB";
								}else{
									if(stripos($Storage_JB,"1.5TB")){
										$Storage_match="1.5TB";
									}
								}
							}
						}
					}
				}
			}
		}
	}

	if((stripos($title_PB,$CPU_match))&&(stripos($title_PB,$RAM_match))&&(stripos($title_PB,$Storage_match))){
		return true;
	}else{
		return false;
	}
	
	
				
}
	
  
?>