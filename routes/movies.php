<?php
require 'db.php';
function getMovies() {
	$conn = getDB ();
	$sql = "SELECT * FROM Movies ORDER BY name ASC;";
	
	if (! $result = $conn->query ( $sql )) {
		die ( "There was an error running the query [" . $conn->error . "]\n" );
	}
	
	$return_arr = array ();
	
	while ( $row = $result->fetch_assoc () ) {
		$row_array ['id'] = $row ['id'];
		$row_array ['name'] = $row ['name'];
		$row_array ['description'] = $row ['description'];
		$row_array ['stars'] = $row ['stars'];
		$row_array ['length'] = $row ['length'];
		$row_array ['image'] = $row ['image'];
		$row_array ['year'] = $row ['year'];
		$row_array ['rating'] = $row ['rating'];
		$row_array ['director'] = $row ['director'];
		$row_array ['url'] = $row ['url'];
		
		array_push ( $return_arr, $row_array );
	}
	
	echo json_encode ( $return_arr );
	
	$conn->close ();
}
function getMoviesAboveRating($rating) {
	$conn = getDB ();
	
	if ($stmt = $conn->prepare ( "SELECT * FROM Movies WHERE rating > ? ORDER BY rating DESC;" )) {
		$stmt->bind_param ( "s", $rating );
		
		$stmt->execute ();
		
		$result = $stmt->get_result ();
		
		$return_arr = array ();
		
		while ( $row = $result->fetch_assoc () ) {
			$row_array ['id'] = $row ['id'];
			$row_array ['name'] = $row ['name'];
			$row_array ['description'] = $row ['description'];
			$row_array ['stars'] = $row ['stars'];
			$row_array ['length'] = $row ['length'];
			$row_array ['image'] = $row ['image'];
			$row_array ['year'] = $row ['year'];
			$row_array ['rating'] = $row ['rating'];
			$row_array ['director'] = $row ['director'];
			$row_array ['url'] = $row ['url'];
			
			array_push ( $return_arr, $row_array );
		}
		
		echo json_encode ( $return_arr );
		
		$stmt->close ();
	}
	
	$conn->close ();
}
function getMovie($id) {
	$conn = getDB ();
	
	if ($stmt = $conn->prepare ( "SELECT * FROM Movies WHERE id = ?;" )) {
		$stmt->bind_param ( "s", $id );
		
		$stmt->execute ();
		
		$result = $stmt->get_result ();
		
		if ($row = $result->fetch_assoc ()) {
			$row_array ['id'] = $row ['id'];
			$row_array ['name'] = $row ['name'];
			$row_array ['description'] = $row ['description'];
			$row_array ['stars'] = $row ['stars'];
			$row_array ['length'] = $row ['length'];
			$row_array ['image'] = $row ['image'];
			$row_array ['year'] = $row ['year'];
			$row_array ['rating'] = $row ['rating'];
			$row_array ['director'] = $row ['director'];
			$row_array ['url'] = $row ['url'];
			
			echo json_encode ( $row_array );
		}
		
		$stmt->close ();
	}
	
	$conn->close ();
}
function addMovie($id, $name, $descripton, $stars, $length, $image, $year, $rating, $director, $url) {
	$conn = getDB ();
	
	if ($stmt = $conn->prepare ( "INSERT INTO Movies (id,name,description,stars,length,image,year,rating,director,url) VALUES (?,?,?,?,?,?,?,?,?,?);" )) {
		$stmt->bind_param ( "ssssssidss", $id, $name, $descripton, $stars, $length, $image, $year, $rating, $director, $url );
		
		if ($row_array ['result'] = $stmt->execute ())
			$row_array ['affected_rows'] = $stmt->affected_rows;
		
		echo json_encode ( $row_array );
		
		$stmt->close ();
	}
	
	$conn->close ();
}
function deleteMovie($id) {
	$conn = getDB ();
	
	if ($stmt = $conn->prepare ( "DELETE FROM Movies WHERE id = ?;" )) {
		$stmt->bind_param ( "s", $id );
		
		if ($row_array ['result'] = $stmt->execute ())
			$row_array ['affected_rows'] = $stmt->affected_rows;
				
		echo json_encode ( $row_array );
		
		$stmt->close ();
	}
	
	$conn->close ();
}