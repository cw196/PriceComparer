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
$db->query("drop table PB;");
$db->exec("CREATE TABLE PB(
		ID int NOT NULL,
		Title varchar(255),
		CPU varchar(255),
		RAM varchar(255),
		Storage varchar(255),
		Price Float,
		Access_PB varchar(255)
	); ");
  
  
  
//scrape data;

$html  = new  DOMDocument();   
  
libxml_use_internal_errors(true);
$stop=0;
$page=0;
$i=0;
for($page=1;$stop!=1;$page++)
{
	$stop=1;
	$url='http://www.pbtech.co.nz/index.php?z=c&p=laptops&pg='.$page;
			
	$Context = stream_context_create(array(
	'http' => array(
    'method' => 'GET',
	'timeout' => 240,
	)
	));
	
	$html ->loadHTML(file_get_contents($url,0,$Context));   
	$html ->preserveWhiteSpace = false;

	$tables=$html ->getElementsByTagName("table");

	foreach($tables as $table){
		if($table->getAttribute('class') =="explist"){
			$stop=0;
			$num =1;
			$spans=$table->getElementsByTagName("span");
			foreach($spans as $span){
				if($span->getAttribute('class')=='explist_name_link'){
					$title = $span->nodeValue;
				}
			}
			
			
			$tds =$table->getElementsByTagName("td");
			foreach($tds as $td){
				if($td->getAttribute('class')=='explist_name'){
					$Link_PB = "http://www.pbtech.co.nz/".$td -> firstChild ->getAttribute('href');
				}
			}
			
			
			$divs = $table ->getElementsByTagName("div");
			foreach($divs as $div){
				
				if($div->getAttribute('class')=='explist_dollars'){
					$num = $num +1;
					if($num %2 ==1 ){
						$price_content = $div->nodeValue;
						echo " PRICE!!!!!:".$price_content." ";
						$prices =explode("$",$price_content);
						echo $prices." ";
						$pricess =str_replace(",",'',$prices[1]);
						echo $pricess." <br />";
						$price=floatval($pricess);
						$price=$price/100;
					}
				}
			}
					
					
					
					
			try {
				$i++;
				$stmt = $db->prepare('INSERT INTO PB (ID, Title, Price,Access_PB) VALUES (:id, :title, :price, :access_PB)');
				$stmt->execute(array(':id' => $i, ':title' => $title, ':price' => $price, ':access_PB' => $Link_PB));
			}
			catch (PDOException $ex) {
				echo "errors";
			}
			echo $i."<br/>".$title."<br />".$price."<br />".$Link_PB."<br/>";
		
		}
	}
}





  

?>    