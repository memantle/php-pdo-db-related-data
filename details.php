<?php
try{
      $conn = new PDO('mysql:host=localhost;dbname=u0123456', 'u0123456', '01jan96');
      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $exception)
{
	echo "Oh no, there was a problem" . $exception->getMessage();
}
//the id from the query string e.g. details.php?id=4
$filmId=$_GET['id'];
//prepared statement uses the id to select a single film
$stmt = $conn->prepare("SELECT * FROM films
  INNER JOIN certificates on films.certificate_id = certificates.id
  WHERE films.id = :id");
$stmt->bindValue(':id',$filmId);
$stmt->execute();
$film=$stmt->fetch();

$stmt2 = $conn->prepare("SELECT * FROM films
  INNER JOIN film_genre on films.id=film_genre.film_id
  INNER JOIN genres on film_genre.genre_id=genres.id
   WHERE films.id = :id");
$stmt2->bindValue(':id',$filmId);
$stmt2->execute();
$genres=$stmt2->fetchAll();

$conn=NULL;
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Display the details for a film</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<?php
//simple validation to see if we found a film
if($film){
	echo "<h1>".$film['title']."(".$film['name'].")</h1>";
	echo "<p>Year: ".$film['year']."</p>";
	echo "<p>Duration: ".$film['duration']."</p>";
  echo"<ul>";
  foreach($genres as $genre){
    echo "<li>".$genre['name']."</li>";
  }
  echo"</ul>";
}
else
{
	echo "<p>Can't find the film</p>";
}
?>
</body>
</html>
