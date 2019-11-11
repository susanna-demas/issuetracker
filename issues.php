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
$sql = "CREATE TABLE Issues(
    id   int(11)  AUTO_INCREMENT,
    projectname VARCHAR(100) NOT NULL,
    issuetype VARCHAR(50) NOT NULL,
    issuesubject VARCHAR(100) NOT NULL,
    issuedescription VARCHAR(100) NOT NULL,
    Assignee VARCHAR(50) NOT NULL,
    duedate DATE NOT NULL,
    issuestatus VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table Issues created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql="INSERT INTO Issues (projectname, issuetype, issuesubject, issuedescription, Assignee, duedate, issuestatus) VALUES ('$_POST[projectname]','$_POST[issuetype]','$_POST[issuesubject]','$_POST[issuedescription]','$_POST[Assignee]','$_POST[duedate]', '$_POST[issuestatus]')";

if ($conn->query($sql) === TRUE) {
    echo "Issue added successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// closing connection
$conn->close();
?>