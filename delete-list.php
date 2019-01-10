<?php
try{
    $conn = new PDO('mysql:host=localhost;dbname=u0123456', 'u0123456', '01jan96');
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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
<title>Delete the films</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<form action="delete.php" method="POST">
<?php
foreach ($films as $film) {
     echo "<p>";
    echo "<label>";
    //outputs a checkbox button for each film e.g. <label><input type="checkbox" name="ids[]" value="1" '="">Jaws</label>
    echo "<input type='checkbox' name='ids[]' value='{$film["id"]}''>";
    echo $film["title"];
    echo "</label>";
    echo "</p>";
}

?>
<input type="submit">
</form>
</body>
</html>