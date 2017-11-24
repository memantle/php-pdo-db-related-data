<?php
try{
       $conn = new PDO('mysql:host=localhost;dbname=u0123456', 'u0123456', '01jan96');
}
catch (PDOException $exception) 
{
	echo "Oh no, there was a problem" . $exception->getMessage();
}

//select all the films
$query = "SELECT * FROM films";
$resultset = $conn->query($query);
$films = $resultset->fetchAll();
$conn=NULL;

?>


<!DOCTYPE HTML>
<html>
<head>
<title>List the films</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<?php
foreach ($films as $film) {
    echo "<p>";
    echo $film["title"];
    //outputs a hyperlink for each film e.g. <a href="edit.php?id=4">edit</a>
    //each hyperlink has a query string (look back at practical 1) that specifies which film has been clicked on
    echo " (<a href='edit.php?id=" . $film["id"] . "'>edit</a>)";
    echo "</p>";
}

?>
</body>
</html>