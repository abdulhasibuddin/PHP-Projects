<?php
	//This file checks if the username input by the user already exists or not
	//This file is required in 'registrationPage2.php' & 'resetAccount2.php'
	require 'config.php'; //Opening database connection

	//Prevent SQL Injection type vulnerability::
	//$uName = mysqli_real_escape_string($conn, $uName);

	//Prepared statement to prevent SQL-Injection::
	if($isAdmin == 1){
		$query = "SELECT member.* FROM member, admin WHERE admin.membership_no = member.membership_no AND member.email = ?";
	}
	else{
		$query = "SELECT * FROM member WHERE email = ?";
	}
	$stmt = $conn->prepare($query); //Processing prepared statement
	$stmt->bind_param("s", $email); //Binding parameters
	$stmt->execute(); //Executing prepared statement
	$result = $stmt->get_result(); //Get the result
	$result->fetch_all(); //Fetch all the column values of the selected row
	
	$stmt->close(); //Closing prepared statement
	$conn->close(); //Closing database connection
?>
