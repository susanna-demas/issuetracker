<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title> Issue tracker </title> 
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
<body>
<?php
   // session_start();
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

        echo "<br>";
        $sql = "SELECT * FROM Issues where  Assignee = '".$_SESSION['username']."' " ;
        $result = $conn->query($sql);
        
 
        if ($result->num_rows > 0) {
            echo "<div class='table-responsive-sm'>";
            echo "<table class ='table table-borderless table-hover' style='width: auto;' '>";
            echo "<thead>";
            echo "<tr>";
             echo "<th>Issues</th>";
             echo "<th>Due Date</th>";
             echo "<th>Status</th>";
             echo "</tr>";
             echo "</thead>";
             echo "<tbody>";

        while($row = $result->fetch_assoc()){
            echo "<tr>";
            $id= $row["id"];
            $sub = $row["issuesubject"];
            $da=$row["duedate"];
            $st = $row["issuestatus"];
            $desc = $row["issuedescription"];
            $as=$row["Assignee"];
            $pname=$row["projectname"];
            $istype=$row["issuetype"];
            echo "<td><a href='changestatus.php?id=$id'>" .$sub. "</a></td>";

            echo "<td><a href='changestatus.php?id=$id'>" .$da. "</td>";
            if ($st == 'new'){
                echo "<td><a href='changestatus.php?id=$id'><span class='label label-primary' name = 'la' id = 'la'>".$st."</span> </td>" ;
            }
            else if($st == 'Resolved'){
                echo "<td><a href='changestatus.php?id=$id'><span class='label label-success' name = 'la' id = 'la'>".$st."</span> </td>" ;
            }
            else if($st == 'in-progress'){
                echo "<td><a href='changestatus.php?id=$id'><span class='label label-danger' name = 'la' id = 'la'>".$st."</span> </td>" ;
            }
            
         echo "</tr>";
            
        }
        echo "</tbody>";
        echo "</div>";
    }
    else{
        echo " No tasks";
    }
    echo "</table>";
    echo "</div>";
        $conn->close();   
    
    ?>
    </body>
    </html>
    