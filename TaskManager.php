
<html>
<title>Task-Manager</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="dashcss.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body >
    

<div class="w3-sidebar w3-bar-block w3-black w3-xxlarge" style="width:50px;font-size:25px!important;">
    <br>
    <br>
  <a href="dashboard.php" class="w3-bar-item w3-button" ><i class="fa fa-home" ></i></a> <br>
  <a href="groupchat.php" class="w3-bar-item w3-button"><i class="fa fa-users"></i></a> <br>
  <a href="chat.php" class="w3-bar-item w3-button"><i class="fa fa-paper-plane-o"></i></a> <br>
  <a href="TaskManager.php" class="w3-bar-item w3-button" style="background-color:#F1F1F1;color:black;"><i class="fa fa-tasks"></i></a><br>
  <a href="setting.php" class="w3-bar-item w3-button"><i class="fa fa-gear"></i></a><br>
  <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i></a> <br>
</div>

<div style="margin-left:70px">

<nav class="navbar navbar-default navbar-expand-lg navbar-light">
	<div class="navbar-header d-flex col">
		<a class="navbar-brand" href="#">Co-working<b>Space</b></a>  		
		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
			<span class="navbar-toggler-icon"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-end">
<ul class="nav navbar-nav navbar-right"  >
    <li class="nav-item "><a href="index.php" class="nav-link">Home</a></li>
    <li class="nav-item "><a href="#" class="nav-link">Pricing</a></li>
			<li class="nav-item"><a href="#" class="nav-link">Blog</a></li>
			<li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
<li class="nav-item dropdown">
				<a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#"><i class="fa fa-user-circle-o" >&nbsp;&nbsp;<?php 

      session_start();
                echo $_SESSION['email']; 
                
?> </i><b class="caret"></b></a>
				<ul class="dropdown-menu">					
					<li><a href="logout.php" class="dropdown-item">LogOut</a></a></a></li>
				
				</ul>
			</li>
</ul>

		</div>
		</nav>


</div>
<div class="hello">
   <h2 align="center"> <img src="taskicon.png" width=7%>&nbsp;To Do List</h2>
    <hr style="background-color:white">
    <form method="post" action="TaskManager.php" >
      <input type="text" id="txtb" name='name' placeholder="Add a Task...">
      <input type="submit"  style="background-color:black;color:white;padding:1%" value="ADD" name="add" ></form>
      <div class="notcomp">
      <center>  <h4 id="nc" ><i class='fa fa-pencil-square-o'>&nbsp; </i>Not Completed Tasks</h4></center>
    <br>
  <?php
$servername = "shareddb-s.hosting.stackcp.net";
$database = "anudbms-313235305e";
$username = "anudbms-313235305e";
$password = "welcome123";
$un=$_SESSION['email'];
$conn = mysqli_connect($servername, $username, $password, $database);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
   
          if(isset($_POST['add'])){
        $tname=$_POST['name'];    
            $tgroup=$_SESSION['sessionid'];
         $status="nc";
            $sql = "INSERT INTO tasks (tname,tgroup,status) VALUES ('$tname','$tgroup','$status')";
	if (mysqli_query($conn, $sql)) {
	}
          }
	    

    $sql = "SELECT * FROM tasks WHERE tgroup='".$_SESSION['sessionid']."' and status='nc'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='task'>";
        echo $row["tname"];
      $tid=$row['tid'];
        echo "<a href='TaskManager.php?hello=$tid'><i class='fa fa-check-square-o'>Done</i></a>";
        
        echo "</div>";
    }
} else {
    echo "<center>No Tasks</center>";
  
}
echo "<br>";

 function runMyFunction() {
   
     $servername = "shareddb-s.hosting.stackcp.net";
$database = "anudbms-313235305e";
$username = "anudbms-313235305e";
$password = "welcome123";
$un=$_SESSION['email'];
$conn = mysqli_connect($servername, $username, $password, $database);
    $sql = "update tasks set status='c' where tid='".$_GET['hello']."'";
    	if (mysqli_query($conn, $sql)) {
    	    if (!isset($_GET['reload'])) {
     echo '<meta http-equiv=Refresh content="0;url=TaskManager.php?reload=1">';
}
	}
  }

  if (isset($_GET['hello'])) {
     
    runMyFunction();
  }


?>



      
      <center>  <h4 ><i class='fa fa-check-square'>&nbsp;</i>Completed Tasks</h4></center>
<br>
        <?php $sql = "SELECT * FROM tasks WHERE tgroup='".$_SESSION['sessionid']."' and status='c'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='task'>";
        echo $row["tname"];
        $tid=$row['tid'];
       echo "<a href='TaskManager.php?world=$tid'><i class='fa fa-trash-o'></i></a>";
        echo "</div>";
    }
} else {
    echo "<center>No Tasks</center>";
  
} 

 function runMyFunction1() {
   
     $servername = "shareddb-s.hosting.stackcp.net";
$database = "anudbms-313235305e";
$username = "anudbms-313235305e";
$password = "welcome123";
$un=$_SESSION['email'];
$conn = mysqli_connect($servername, $username, $password, $database);
    $sql = "delete from tasks where tid='".$_GET['world']."'";
    	if (mysqli_query($conn, $sql)) {
    	    if (!isset($_GET['reload'])) {
     echo '<meta http-equiv=Refresh content="0;url=TaskManager.php?reload=1">';
}
	}
  }

  if (isset($_GET['world'])) {
     
    runMyFunction1();
  }






?>
<br>
      </div>
  <style>
 a { color:black; }
.hello
{ padding-top:1%;
    margin-left:30%;
    width:40%;
    background-color:black;
    color:white;
    margin-top:5%;
   
    
}
/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .hello {
    width:90%;
    margin-right:0px;
    margin-top:0px;
    margin-left:40px;
  }
  
#nc
{
padding:0%!important;
margin:0%!important;
}

  
  
}
#nc
{
    
    margin-left:0%!important;
}


#txtb{
    margin-top:10%;
    margin-bottom:10%;
  width: 70%;
  margin-left:10%;
  border: none;
  border-bottom: 2px solid white;
  background: none;
  padding:1px;
  outline: none;
  color:white;
  font-size: 18px;
}

h3{
  margin: 10px 0;
}

.task{
  width: 100%;
  background: rgba(255,255,255,0.5);
  padding: 18px;
  margin: 6px 0;
  overflow: hidden;
}
.task:hover
{
    background-color:#bdc8db;
    color:black;
}

.task i{
  float: right;
  margin-left: 20px;
  cursor: pointer;
}

.comp .task{
  background: rgba(255,255,255,0.5);
  color: #fff;
}
</style>
</div>
      
</body>
</html>
