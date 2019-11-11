<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "issue_tracker";
$sub = $_POST['delval']; 

// Creating a connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqli = "DELETE FROm Issues WHERE id='$sub' ";

if(mysqli_query($conn, $sqli)){ 
    echo " issue  deleted successfully."; 

} else { 
    echo "ERROR: Could not able to execute $sql. "  
                            . mysqli_error($link); 
}  
?>
