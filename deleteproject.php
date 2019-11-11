<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "issue_tracker";
$sub = $_REQUEST['proname']; 

// Creating a connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlp = "DELETE FROM Projects WHERE projectname='$sub' ";
$sqli = "DELETE FROm issues WHERE projectname='$sub' ";

if(mysqli_query($conn, $sqlp) &&(mysqli_query($conn, $sqli))){ 
    echo $sub."project and its issues are deleted successfully."; 

} else { 
    echo "ERROR: Could not able to execute $sql. "  
                            . mysqli_error($link); 
}  
?>
