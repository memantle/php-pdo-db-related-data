# PHP and PDO - Working with Related Data

Through working on the assignment you should now be familiar with *reading* data from a database. Next you need to become comfortable with the other CRUD actions - *creating*, *updating* and *deleting*. 

## Exercise 1 - Create, Update and Delete using a single table
1. Choose a database table from your assignment work that has **no** foreign keys.
2. Create
	* Create an HTML form that will allow users to enter details for a new row in this table. Save this page as *create.php*.
	* Create a PHP page that will process this form and insert a new row into this database table. Save this page as *save.php*.
3. Delete
	* Create an PHP page (delete-list.php) that will list all the rows from your chosen table. Each item should be a hyperlink.
	* Clicking on the hyperlink should take the user to a page called delete.php. delete.php should run an SQL statement to delete the selected item from the table.
4. Edit
	* Create an PHP page (edit-list.php) that will list all the rows from your chosen table. Each item should be a hyperlink.
	* Clicking on the hyperlink should take the user to a page called edit.php. edit.php should display an HTML form populated with values from the chosen row.
	* Submitting the form should take the user to a page named update.php that updates this row in the table

Examples for each of the above can be found at https://github.com/CIT2318/php-pdo-databases-lec-examples/

## Exercise 2 - Create, Update and Delete using a related tables
Working with tables that have relationships is more difficult. You can have a look at the files in this repository for examples of typical approaches we might take.

The examples use the Certificate-Film-Genre example and involve creating, updating and deleting a film. 

Choose a table from your assignment that features a foreign key or one that has a many-to-many relationship with another entity. See if you can implement *create*, *update* and *delete* functionality for your table. 

### One-to-many relationships e.g Certificate and Film
* When inserting a new film, we need to specify the certificate for the film. *certificate_id* is a foreign key in the films table. 
* To implement this, in the *create.php* page we need to query the database for a list of all the certificates. We then construct a ```<select>``` menu so the user can select the certificate for the film. 
* When updating a film's details we need to do the same i.e. provide a ```<select>``` menu of certificates. The ```<option>``` element for certificate that is currently associated with the film is pre-selected using the *selected* HTML attribute.

### Many-to-many relationships e.g. Film and Genre
* When inserting a new film, we need to specify the genres associated with that film. 
* To implement this, in the *create.php* page we need to query the database for a list of all the genres. We then add a checkbox for each genre so that the user can select the relevant genres for the film.  
* In *save.php* we run an *INSERT* query (one for each chosen genre) that will add a row to *film_genre* junction table. 
* When deleting the film we need to first delete the relevant rows from the *film_genre* table and then delete the row in the *film* table. 
