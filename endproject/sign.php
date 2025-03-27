<html>
<head>
<title> Processing Form </title>
</head>
<body>
<?php
	// Database Connection
	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "endproject";

	$conn = new mysqli($host, $username, $password, $dbname);

	// Check Connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Retrieve and Sanitize User Input
	$FIRST_NAME = mysqli_real_escape_string($conn, $_POST['FIRST_NAME']);
	$LAST_NAME = mysqli_real_escape_string($conn, $_POST['LAST_NAME']);
	$PHONE_NUMBER = mysqli_real_escape_string($conn, $_POST['PHONE_NUMBER']);
	$EMAIL = mysqli_real_escape_string($conn, $_POST['EMAIL']);
	$PASSWORD = mysqli_real_escape_string($conn, $_POST['PASSWORD']);
	$CONFIRM_PASSWORD = mysqli_real_escape_string($conn, $_POST['CONFIRM_PASSWORD']);

	// Validate Password Match
	if ($PASSWORD !== $CONFIRM_PASSWORD) {
		die("Error: Passwords do not match. <a href='sighnupForm.html'>Try Again</a>");
	}

	// Hash the Password
	$hashed_password = password_hash($PASSWORD, PASSWORD_DEFAULT);

	// Insert Data into Database
	$sql = "INSERT INTO users (FIRST_NAME, LAST_NAME, PHONE_NUMBER, EMAIL, PASSWORD) 
        VALUES ('$FIRST_NAME', '$LAST_NAME', '$PHONE_NUMBER', '$EMAIL', '$hashed_password')";

	if ($conn->query($sql) === TRUE) {
		echo "Your record is saved, you can now proceed with the page! <a href='loginForm.html'>Login Here</a><br>";
	} else {
		echo "Error: " . $conn->error;
	}

	// Close Connection
	$conn->close();
?>
</body>
</html>