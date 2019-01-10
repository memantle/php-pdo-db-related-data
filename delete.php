<?php
try{
    $conn = new PDO('mysql:host=localhost;dbname=u0123456', 'u0123456', '01jan96');
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $exception) 
{
	echo "Oh no, there was a problem" . $exception->getMessage();
}

//Simple validation
if(isset($_POST['ids'])){
	//the ids come from the form as an array e.g. ids=[3,6,7]
	$ids=$_POST['ids'];

	//statement to delete the genres associated with the film
	$deleteGenresStmt = $conn->prepare("DELETE FROM film_genre WHERE film_genre.film_id = :id");

	//prepared statement uses the id to delete a single film
	$deleteFilmStmt = $conn->prepare("DELETE FROM films WHERE films.id = :id");
	
	//loop over the array of ids to delete multiple students
	foreach($ids as $id){
		//delete the genres
		$deleteGenresStmt->bindValue(':id',$id);
		$deleteGenresStmt->execute();
		//delete the film
		$deleteFilmStmt->bindValue(':id',$id);
		$deleteFilmStmt->execute();
	}
	$msg="<p>Successfully deleted films.</p>";
}else{
    $msg="<p>No films selected.</p>";
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