<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title> Issue tracker </title> 
    <link rel="stylesheet" href="styles.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
<body>

    <div id="wrapper">
      <div id="sidebar-wrapper" style="background-color:6A8BA7;">
        <nav class="sidebar">
          <ul class="sidebar__toggled">  
            <li><a href="javascript:void(0)"style="color:white;" id="main-toggle" class="sidebar-toggle">Issue Tracker</a> </li>
          </ul>
        </nav>
        <nav class="sidebar">
          <ul>  
            <li style="margin-top:20px;"><a href="welcome.php" style="color:white;" target="_top"><i class="fa fa-home"></i>   Dashboard  </a></li>
            <li style="margin-top:20px;"><a href="fetchprojects.php" style="color:white;" target="_top">Projects<span class="sub_icon glyphicon glyphicon-link"></span></a></li>
          <li style="margin-top:20px;"><a href="fetchissues.php" style="color:white;" target="_top">issues<span class="sub_icon glyphicon glyphicon-link"></span></a></li>
          <li style="margin-top:20px;"><a href="#" style="color:white;" data-toggle="modal" data-target="#myIssueModal">Add issue</a></li>
          </ul>
        </nav>
      </div>
   <div id="page-content-wrapper">
  
	
<nav class="navbar navbar-expand-sm navbar-light bg-light">


<ul class="navbar-nav">
<li class="nav-item">
    <a class="nav-link" href="welcome.php">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#"data-toggle="modal" data-target="#myProjectModal">Add Project</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#myIssueModal">Add issue</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#myUserModal">Add User</a>
  </li>
</ul>
</ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item "><a href="logout.php" target ="_self"><i class="fa fa-lg fa-sign-out"> Logout</i></a></li>
    </ul>
</nav> 


<?php
session_start();

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
$sql = "SELECT * from Issues WHERE id='".$_GET['id']."' "; 
$result = $conn->query($sql);
$issid = $_GET['id'];

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<dl class='row'>";
  
       echo "<dt class='col-sm-2'>issuesubject </dt>";
        echo "<dd class='col-sm-9'>". $row['issuesubject']."</dd>"; 
        echo "<dt class='col-sm-2'>Issue Description </dt>";
        echo " <dd class='col-sm-9'>".$row['issuedescription']."</dd>";
        echo "<dt class='col-sm-2'>Project Name </dt>";
        echo " <dd class='col-sm-9'>". $row['projectname']."</dd>";
        echo "<dt class='col-sm-2'> Issue Status </dt>";
        echo " <dd class='col-sm-9'>".$row['issuestatus']."</dd>";
        echo "<dt class='col-sm-2'>Assignee </dt>";
        echo " <dd class='col-sm-9'>".$row['Assignee']."</dd>";
        echo "<dt class='col-sm-2'>Issue Type </dt>";
        echo " <dd class='col-sm-9'>". $row['issuetype']."</dd>";
        echo "<dt class='col-sm-2'>Due Date </dt>";
        echo " <dd class='col-sm-9'>". $row['duedate']."</dd>";
       
        echo "</dl>";
            }
          } else {
         echo "0 results";
          }
        $issid = $_GET['id'];

?>
<form action='' method='POST'>
<button type="button" name='edit' value ="&#xf044;" class=" btn btn-link fa fa-edit"  data-toggle="modal" data-target="#myeditIssueModal"  style='color:red;font-size:30px;'/></button>
<input type="submit" name ='delete' value=" delete" id="delete" class="btn btn-danger" />
</form>

<!--editissuemodal -->
<div class="modal fade" id="myeditIssueModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Edit Issue</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h3>Issue Details</h3>
           <form class="update" name="update">
            <div class="form-row">
             <div class="form-group col-md-6">
              <label for="usr">Project name:</label>
              <select name="projectname">
              <?php 
              $servername = "localhost";
              $username = "root";
              $password = "1234";
              $dbname = "issue_tracker";
              
              // Creating a connection
              $conn = new MYSQLI($servername, $username, $password, $dbname);
              $sqlp =  "SELECT projectname FROM Projects";
              $result = $conn->query($sql);
              while ($rows = $result->fetch_assoc()) {
                $projectname = $rows["projectname"];
                echo "<option value='$projectname'>$projectname</option>";
                }
               
              ?>
              </select>
             </div>         
             <div class="form-group col-md-6">
             <label for="usr"></label>

              <select class="form-control" name="issuetype">
              <option>Task</option>
              <option>Bug</option>
              </select>
              </div>
             
            <div class="form-group">
              <label for="subject">Subject</label>
              <?php 
              $servername = "localhost";
              $username = "root";
              $password = "1234";
              $dbname = "issue_tracker";
              $conn = new MYSQLI($servername, $username, $password, $dbname);

              $sqli = "SELECT * from Issues WHERE id='".$_GET['id']."' "; 
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {
              
              // Creating a connection
              echo "<input type='text' class='form-control' value ='".$row['issuesubject']."' name='issuesubject'>";
              echo "</div>";
               echo "<div class='form-group'>";
               echo "<label for='Description'>Description</label>";
               echo "<textarea class='form-control' name='issuedescription' rows='5'> ".$row['issuedescription']."</textarea>";
              echo "</div>";
             echo  "<div class='form-group'>";
              echo "<label for='exampleFormControlTextarea1'>Assignee</label>";
               
             echo "<select name='Assignee' class='form-control'>"; // Open your drop down box
            
            //Members
             $sql =  "SELECT * FROM Members";
             $result = $conn->query($sql);
              while ($rows = $result->fetch_assoc()) {
                $usern = $rows["username"];
                echo "<option>$usern</option>";
                }
              
            echo" </select>";
           echo" </div>";
           echo "<div class='form-group'>";
              echo "<label for='exampleFormControlTextarea2'>Status</label>";
               
             echo "<select name='issuestatus' class='form-control'>";
              echo "<option>new</option>";
              echo "<option>resolved</option>";
               echo "<option>in-progress</option>";
              echo "</select>";
              echo "</div>";
            echo "<div class='form-group'>"; // Date input -->
              echo "<label class='control-label' for='date'>due date</label>";
              echo "<input class='form-control' id='date' name='duedate' value ='".$row['duedate']."' type='date'/>";
            echo "</div>";
              }
            ?>
            
           </div>
            
          <div class="modal-footer">

          <button type="button" id= "savebutton" class="btn btn-default" data-dismiss="modal">Save</button>
          </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>

       </div>
      </div> 
    </div>
    </div>
   
    <!-- Modals -->
        <!-- Project Modal -->
        <div class="modal fade" id="myProjectModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Add projects</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h3>Project Details</h3>
           <form action="database.php" method = "post">
           <div class="form-group">
           <input name="user" type="text" value="<?php echo $_SESSION['username'];?>" readonly>
           </div>
             <div class="form-group">
              <label for="usr">Project name:</label>
              <input type="text" class="form-control" name="projectname">
             </div>
            <div class="form-group">
              <label for="pwd">Description(optional):</label>
               <input type="text" class="form-control" name="pdescription">
             </div>
             
           </div>
        <div class="modal-footer">
        <input type="submit" name="create" id ="button" value="create" class="btn btn-success" />

          </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>
      </div>
      
    </div>
      
    </div>
       <!--Issue Modal-->
  <div class="modal fade" id="myIssueModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Add Issue</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h3>Issue Details</h3>
           <form action="issues.php" method = "post">
            <div class="form-row">
             <div class="form-group col-md-6">
              <label for="usr">Project name:</label>
              <select name="projectname">
              <?php 
              $servername = "localhost";
              $username = "root";
              $password = "1234";
              $dbname = "issue_tracker";
              
              // Creating a connection
              $conn = new MYSQLI($servername, $username, $password, $dbname);
              $sql =  "SELECT projectname FROM Projects where user ='".$_SESSION['username']."'";
              $result = $conn->query($sql);
              while ($rows = $result->fetch_assoc()) {
                $projectname = $rows["projectname"];
                echo "<option value='$projectname'>$projectname</option>";
                }
              ?>
              </select>
             </div>         
             <div class="form-group col-md-6">
             <label for="usr"></label>

              <select class="form-control" name="issuetype">
              <option>Task</option>
              <option>Bug</option>
              </select>
              </div>
             </div>
            <div class="form-group">
              <label for="subject">Subject</label>
               <input type="text" class="form-control" name="issuesubject">
             </div>
             <div class="form-group">
               <label for="Description">Description</label>
               <textarea class="form-control" name="issuedescription" rows="5"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Assignee</label>
               
             <select name="Assignee" class="form-control"> // Open your drop down box
             <?php
             $servername = "localhost";
             $username = "root";
             $password = "1234";
             $dbname = "issue_tracker";
             
             // Creating a connection
             $conn = new MYSQLI($servername, $username, $password, $dbname);
             $sql =  "SELECT * FROM Members";
             $result = $conn->query($sql);
              while ($rows = $result->fetch_assoc()) {
                $username = $rows["username"];
                echo "<option value='$username'>$username</option>";
                }
              ?>
            </select>
            </div>
            <div class="form-group"> <!-- Date input -->
              <label class="control-label" for="date">due date</label>
              <input class="form-control" id="date" name="duedate" placeholder="YYYY/MM/DD" type="date"/>
            </div>
            
           </div>

        <div class="modal-footer">
           <input type="submit" name="create" id="insert" value="create" class="btn btn-success" />
           <input type="button"  id ="savebutton" value=" Save"  class="btn btn-success" onclick="window.location.href='http://localhost:81/issue tracker/welcome.php'" /></form> 
           
          <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
       </div>
      </div> 
    </div>

    <!-- User Modal -->
  <div class="modal fade" id="myUserModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h3>Invite Users by Email</h3>
           <form action="users.php" method = "post">
             <div class="form-group">
              <label for="usr">User Email:</label>
              <input type="Email" class="form-control" name="useremail">
             </div>
            <div class="form-group col-md-6">
             <label for="usr">Role</label>
              <select class="form-control" name="issueroletype">
              <option>Admin</option>
              <option>Project member</option>
              </select>
              </div>
           
            </div>
        <div class="modal-footer">
          <input type="submit" name="create" id="insert" value="create" class="btn btn-success" />
          </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
      </div>
      </div>
    </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
$('#savebutton').click(function() {
    var val = $(this).val();
     var id = '<?php echo $issid; ?>';
     console.log(id);
      $.ajax({
        type: "POST",
        url: "updateissue.php?id="+id,
        data: $('form.update').serialize(),
        success:function( msg ) {
         alert( "Data Saved: " + msg );
         $("#update").html(msg)

        }
       });

  });
 $('#delete').click(function() {
      var delval= '<?php echo $issid; ?>';
      console.log(delval);
      $.ajax({
        type: "POST",
        url: "deleteissue.php",
        data: ({ delval: delval}),
        success:function( msg ) {
         alert( "Data deleted: " + msg );
         window.location.replace("http://localhost:81/issue tracker/welcome.php");
        }
       });

  }); 
  $(document).ready(function(){
      var date_input=$('input[name="duedate"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
     
    })



</script>
</body>
</html>