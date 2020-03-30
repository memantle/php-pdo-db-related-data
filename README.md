# PHP and PDO - Working with Related Data

This repository contains examples for working with related data using the films example we have looked at previously. See https://github.com/CIT2318/mysql-foreign-keys-joins/blob/master/films-db.sql for the database.

### One-to-many relationships e.g Certificate and Film
* When inserting a new film, we need to specify the certificate for the film. *certificate_id* is a foreign key in the films table.
* To implement this, in the *create.php* page we need to query the database for a list of all the certificates. We then construct a ```<select>``` menu so the user can select the certificate for the film.
* When updating a film's details we need to do the same i.e. provide a ```<select>``` menu of certificates. The ```<option>``` element for certificate that is currently associated with the film is pre-selected using the *selected* HTML attribute.

### Many-to-many relationships e.g. Film and Genre
* When inserting a new film, we need to specify the genres associated with that film.
* To implement this, in the *create.php* page we need to query the database for a list of all the genres. We then add a checkbox for each genre so that the user can select the relevant genres for the film.
* In *save.php* we run an *INSERT* query (one for each chosen genre) that will add a row to *film_genre* junction table.
* When deleting the film we need to first delete the relevant rows from the *film_genre* table and then delete the row in the *film* table.
