<!DOCTYPE HTML> 
<html>
<head>
</head>
<body> 

<?php
/*

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $title = test_input($_POST["title"]);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
*/
?>

<h2>Search</h2>
<form method="post" action="/handler"> 
   Title: <input type="text" name="title">
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>


<?php
/*
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

 // Create a connection.
  $db = null;
  if (isset($_SERVER['SERVER_SOFTWARE']) &&
  strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
    // Connect from App Engine.
    try{
       $db = new pdo('mysql:unix_socket=/cloudsql/academic-empire-89909:php-test;dbname=data_computer', 'root', '');
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
  
  
echo "<h2>Information you need</h2>";



try {
	$stmt = $db->prepare('SELET * from JB where title=:title');
	$stmt->execute(array(':title' => $title));
	echo $stmt->setFetchMode(PDO::FETCH_ASSOC); 
}
catch (PDOException $ex) {
	echo "errors";
}


*/
?>

</body>
</html>