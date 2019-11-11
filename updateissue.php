<?php

$id = $_GET['id']; 
$projectname = strip_tags($_POST['projectname']);
$issuesubject =  strip_tags($_POST['issuesubject']);
$issuedescription =  strip_tags($_POST['issuedescription']);
$issuestatus = strip_tags($_POST['issuestatus']);
$duedate =  strip_tags($_POST['duedate']);
$issuetype =  strip_tags($_POST['issuetype']);
$Assignee =  strip_tags($_POST['Assignee']);
echo $issuedescription;
echo $id;
echo $projectname;
echo $issuestatus; 
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
$sql="UPDATE Issues SET projectname = '$projectname', issuetype ='$issuetype', issuesubject='$issuesubject', issuedescription='$issuedescription', Assignee='$Assignee', duedate='$duedate', issuestatus='$issuestatus' WHERE  id='$id' ";
if(mysqli_query($conn, $sql)){ 
    echo "Issue updated successfully."; 
} 
else { 
    echo "ERROR: Could not able to execute $sql. ";
} 
?>
