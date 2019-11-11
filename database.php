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
// Creating a database named newDB
$sql = "CREATE DATABASE issue_tracker";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
//create Table
$sql = "CREATE TABLE Projects(
    id INT  PRIMARY KEY, 
    projectname VARCHAR(30) NOT NULL,
    pdescription VARCHAR(100) NOT NULL,
    User Varchar(50) NOT NULL
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table Projects created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql="INSERT INTO Projects IF NOT EXISTS (projectname, pdescription, user) VALUES ('$_POST[projectname]','$_POST[pdescription]', '$_POST[user]')";

if ($conn->query($sql) === TRUE) {
    echo "project added successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// closing connection
$conn->close();
?>