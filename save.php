<?php
try{
       $conn = new PDO('mysql:host=localhost;dbname=u0123456', 'u0123456', '01jan96');
}
catch (PDOException $exception) 
{
	echo "Oh no, there was a problem" . $exception->getMessage();
}


//This is a simple example we would normally do some form validation here

//basic form processing
$title=$_POST['title'];
$year=$_POST['year'];
$duration=$_POST['duration'];
$certId=$_POST['certificate'];
$genres=[];
if(isset($_POST['genres'])){
	$genres=$_POST['genres'];
}
$msg="";

//SQL INSERT for adding a new row
//Use a prepared statement to bind the values from the form
$query="INSERT INTO films (id, title, year, duration, certificate_id) VALUES (NULL, :title, :year, :duration, :certId)";
$stmt=$conn->prepare($query);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':year', $year);
$stmt->bindValue(':duration', $duration);
$stmt->bindValue(':certId', $certId);

//when we execute the SQL statement the number of affected rows is returned
$affected_rows = $stmt->execute();

if($affected_rows==1){
    $msg="<p>Successfully added the details for ".$title."</p>";
}else{
    $msg="<p>There was a problem inserting the data.</p>";
}

//now we need the id of the film we have just inserted
$newFilmId = $conn->lastInsertId(); 

foreach($genres as $genreId){
	$query="INSERT INTO film_genre (film_id, genre_id) VALUES (:filmId, :genreId)";
	$stmt=$conn->prepare($query);
	$stmt->bindValue(':filmId', $newFilmId);
	$stmt->bindValue(':genreId', $genreId);
	$stmt->execute();
}


$conn=NULL;
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Save films</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<?php
echo $msg;
?>
</body>
</html>