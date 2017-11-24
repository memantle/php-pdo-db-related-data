<?php
try{
       $conn = new PDO('mysql:host=localhost;dbname=u0123456', 'u0123456', '01jan96');
}
catch (PDOException $exception) 
{
	echo "Oh no, there was a problem" . $exception->getMessage();
}

//This is a simple example we would normally do some validation here

//the id from the query string e.g. details.php?id=4
$filmId=$_GET['id'];

//first we need to delete the genres associated with the film
$stmt = $conn->prepare("DELETE FROM film_genre WHERE film_genre.film_id = :id");
$stmt->bindValue(':id',$filmId);
$stmt->execute();

//now delete the film itself
$stmt = $conn->prepare("DELETE FROM films WHERE films.id = :id");
$stmt->bindValue(':id',$filmId);
$affected_rows=$stmt->execute();

if($affected_rows==1){
    $msg="<p>Deleted film with id of ".$filmId." from the database.</p>";
}else{
    $msg="<p>There was a problem deleting the record.</p>";
}
$conn=NULL;
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Delete the film</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<?php
echo $msg;
?>
</body>
</html>