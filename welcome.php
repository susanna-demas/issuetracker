<html>
<head>
<meta charset="utf-8">
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
            <li style="margin-top:20px;"><a href="fetchprojects.php" style="color:white;" target="_top"><i class="fa fa-tasks" aria-hidden="true"></i>  Projects</a></li>
          <li style="margin-top:20px;"><a href="fetchissues.php" style="color:white;" target="_top"> <i class="fa fa-exclamation-triangle"></i>  issues</a></li>
          <li style="margin-top:20px;"><a href="#" style="color:white;" data-toggle="modal" data-target="#myIssueModal"><i class="fa fa-plus"></i> Add issue</a></li>
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
               $conn = new MYSQLI($servername, $username, $password, $dbname);
               // Check connection
               
              $sqlp =  "SELECT count(distinct projectname) as cntp from projects where user= '".$_SESSION['username']."'";

              $sqlb = "SELECT count(distinct issuesubject)  as cntb from  issues where issuetype='bug' AND Assignee ='".$_SESSION['username']."'";

              $sqlt = "SELECT count(distinct issuesubject) as cntt from issues where issuetype='Task' AND Assignee ='".$_SESSION['username']."'";


              $resultp = $conn->query($sqlp);
              $row = mysqli_fetch_assoc($resultp);
              $pr= $row['cntp'];
              $resultb = $conn->query($sqlb);
              $row = mysqli_fetch_assoc($resultb);
              $bu = $row['cntb'];
             // echo $bu;
              $resultt = $conn->query($sqlt);
              $row = mysqli_fetch_assoc($resultt);
              $ta = $row['cntt'];
              //echo $ta;
               ?>
    


<div class="card-columns" style="display: flex; justify-content: center;" >
  <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem; margin-right:20px;" >
    <div class="card-body text-center">
      <p class="card-text text-secondary display-4"><?php  echo $pr; ?><br><h4 class="text-secondary">Projects</h4> </p>
    </div>
  </div>
  <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem; margin-right:20px;">
    <div class="card-body text-center">
      <p class="card-text text-secondary display-4"> <?php echo $bu;?><br><h4 class="text-secondary">Bugs</h4></p>
    </div>
  </div>
 
  <div class="card shadow p-3 mb-5 bg-white rounded"style="width: 18rem; margin-right:20px; ">
    <div class="card-body text-center">
      <p class="card-text text-secondary display-4"><?php echo $ta;?><br><h4 class="text-secondary">Tasks</h4> </p>
    </div>
  </div>

 
</div>
       <div class="col-xs-6 col-sm-6 col-md-6">
         <?php include "dashboard.php"; ?> 
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
        <input type="submit" name="create" id="insert" value="create" class="btn btn-success" />

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
               <label for="status">Issue Status</label>
               <input class="form-control" name="issuestatus" value = "new" readonly>
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
           </form>
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
              


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("active");
});
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
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

    $(".sidebar-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

</script>
</body>
</html>
<?php
