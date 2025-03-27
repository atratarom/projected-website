<?php
	session_start(); // Start session

	// Database connection
	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "endproject";

	$conn = new mysqli($host, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Retrieve and sanitize input
	$EMAIL = mysqli_real_escape_string($conn, $_POST['EMAIL']);
	$PASSWORD = mysqli_real_escape_string($conn, $_POST['PASSWORD']);

	// Check if the email exists in the database
	$sql = "SELECT * FROM users WHERE EMAIL = '$EMAIL'";
	$result = $conn->query($sql);

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		// Verify password
		if (password_verify($PASSWORD, $row['PASSWORD'])) {
			// Store user data in session
			$_SESSION['USER_ID'] = $row['id'];
			$_SESSION['FIRST_NAME'] = $row['FIRST_NAME'];
			$_SESSION['EMAIL'] = $row['EMAIL'];

			// Redirect to home page
			header("Location: homeDetails.html");
			exit();
		} else {
			echo "Incorrect password. <a href='loginForm.html'><br>Try Again</a>";
		}
	} else {
		echo "User not found. <a href='sighnupForm.html'><br>Sign Up</a>";
	}

	$conn->close();
?>