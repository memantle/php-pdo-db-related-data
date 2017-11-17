<?php
try{
       $conn = new PDO('mysql:host=localhost;dbname=u0123456', 'u0123456', '01jan96');
}
catch (PDOException $exception) 
{
	echo "Oh no, there was a problem" . $exception->getMessage();
}
//the search term the user entered
$searchTerm=$_GET['search'];

//Need to use a LIKE for fuzzy matching just like in previous weeks 
$stmt = $conn->prepare("SELECT * FROM films WHERE title LIKE :searchTerm");
$stmt->bindValue(':searchTerm','%'.$searchTerm.'%');
$stmt->execute();
$films = $stmt->fetchAll();
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Search results</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<?php

foreach ($films as $film) {
    echo "<p>";
    echo $film["title"];
    echo "</p>";
}

?>
</body>
</html>