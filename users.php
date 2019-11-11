<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "issue_tracker";

// Creating a connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//create Table
$sql = "CREATE TABLE users(
    useremail VARCHAR(100) NOT NULL,
    issueroletype VARCHAR(50) NOT NULL
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql="INSERT INTO users (useremail, issueroletype) VALUES ('$_POST[useremail]','$_POST[issueroletype]')";

if ($conn->query($sql) === TRUE) {
    echo "user added successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// closing connection
$conn->close();
?>