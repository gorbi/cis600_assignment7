<?php
require 'vendor/autoload.php';
require 'routes/movies.php';

$app = new \Slim\App ();

//TODO: Add HTML code so that it accept a value and POSTs it to the entered URL
$app->get ( '/', function () {
	echo "<!DOCTYPE html>";
	echo "<html>";
	echo "<head>";
	echo "<meta charset=\"UTF-8\">";
	echo "<title>Android Movie Database</title>";
	echo "</head>";
	echo "<body>";
	echo "<h2>Add Movie To Database</h2>";
	echo "<form action=\"http://tyrant.local/index.php/add\" method=\"POST\">";
	echo "<table>";
	echo "<tr>";
	echo "<th>id:</th>";
	echo "<th><input type=\"text\" name=\"id\" /></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>name:</th>";
	echo "<th><input type=\"text\" name=\"name\" /></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>description:</th>";
	echo "<th><input type=\"text\" name=\"description\" /></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>stars:</th>";
	echo "<th><input type=\"text\" name=\"stars\" /></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>length:</th>";
	echo "<th><input type=\"text\" name=\"length\" /></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>image:</th>";
	echo "<th><input type=\"text\" name=\"image\" /></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>year:</th>";
	echo "<th><input type=\"text\" name=\"year\" /></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>rating:</th>";
	echo "<th><input type=\"text\" name=\"rating\" /></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>director:</th>";
	echo "<th><input type=\"text\" name=\"director\" /></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>url:</th>";
	echo "<th><input type=\"text\" name=\"url\" /></th>";
	echo "</tr>";
	echo "</table>";
	echo "<input type=\"submit\" value=\"Submit\" />";
	echo "</form>";
	echo "</body>";
	echo "</html>";
} );

$app->get ( '/movies/', function () {
	getMovies ();
} );

$app->get ( '/movies/rating/{rating}', function ($request, $response, $args) {
	getMoviesAboveRating ( $args ['rating'] );
} );

$app->get ( '/movies/id/{id}', function ($request, $response, $args) {
	getMovie ( $args ['id'] );
} );

$app->post ( '/add', function ($request, $response, $args) {
	$data = $request->getParsedBody ();
	addMovie ( $data ['id'], $data ['name'], $data ['description'], $data ['stars'], $data ['length'], $data ['image'], $data ['year'], $data ['rating'], $data ['director'], $data ['url'] );
} );

//TODO: Delete should be changed to POST method in the final version
$app->get ( '/delete/id/{id}', function ($request, $response, $args) {
	deleteMovie ( $args ['id'] );
} );

$app->run ();