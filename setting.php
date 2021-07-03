
<html>
<title>Adminland</title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="settingcss.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body style="background-color:#F6F2EF">
    

<div class="w3-sidebar w3-bar-block w3-black w3-xxlarge" style="width:50px;font-size:25px!important;">
    <br>
    <br>
  <a href="dashboard.php" class="w3-bar-item w3-button"><i class="fa fa-home" ></i></a> <br>
  <a href="groupchat.php" class="w3-bar-item w3-button"><i class="fa fa-users"></i></a> <br>
  <a href="chat.php" class="w3-bar-item w3-button"><i class="fa fa-paper-plane-o"></i></a> <br>
  <a href="TaskManager.php" class="w3-bar-item w3-button"><i class="fa fa-tasks"></i></a><br>
  <a href="setting.php" class="w3-bar-item w3-button" style="background-color:#F1F1F1;color:black;"><i class="fa fa-gear"></i></a><br>
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
<div class="header1" >
    <figure>
<img src="header.png" width="100%" height="30%">
<figcaption id="cap"><i class="fa fa-key">&nbsp;&nbsp;&nbsp;<b>Adminland</b></i><br>
<span id="cap2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manage your Co-working Space Account</span></figcaption>
</figure>

<div class="content">

<button class="accordion"><i class="fa fa-user-circle"> &nbsp;&nbsp;&nbsp;Admin</i></button>
<div class="panel">
    <?php
$servername = "shareddb-s.hosting.stackcp.net";
$database = "anudbms-313235305e";
$username = "anudbms-313235305e";
$password = "welcome123";
$un=$_SESSION['email'];
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM admins WHERE username='".$un."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<i class='fa fa-user-circle-o'>&nbsp;";
        echo $row["name"];
        $_SESSION['sessionid']=$row["adminid"];
        echo "</i>";
    }
} else {
    echo "0 results";
  
}

?>
  
</div>
<button class="accordion"><i class="fa fa-user-circle"> &nbsp;&nbsp;&nbsp;Group Members</i></button></button>
<div class="panel">
    <?php
$sql = "SELECT * FROM member WHERE groupid='".$_SESSION['sessionid']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<i class='fa fa-user-circle'>&nbsp;";
        echo $row["member_name"];
        echo "</i>";
       echo "<br>";
        echo "<br>";
    }
} else {
    echo "No Members";
  
}
?>
  
</div>
<button class="accordion"><i class="fa fa-user-plus"> &nbsp;&nbsp;&nbsp;Add Group Member</i></button>
<div class="panel">

  <form action="setting.php" method="post">
    <div class="row">
      <div class="col-25">
        <label for="fname">Name</label>
      </div>
      <div class="col-75">
        <input type="text" style="height:25%;" id="lname" name="mem_name" placeholder="Name"  required >
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Email</label>
      </div>
      <div class="col-75">
        <input type="email" style="height:25%;" id="lname" name="mem_email" placeholder="Email" required>
      </div>
    </div>
     <div class="row">
      <div class="col-25">
        <label for="lname">Password</label>
      </div>
      <div class="col-75">
        <input type="text" style="height:25%;" id="lname" name="mem_pass" placeholder="Password"  required>
      </div>
      <input id="add" type="submit" name="save" value="Add">

    
  </form>
  <?php

if(isset($_POST['save']))
{	 
	 $mem_name = $_POST['mem_name'];
	 $mem_email = $_POST['mem_email'];
	 $mem_pass = $_POST['mem_pass'];
	 $gid=$_SESSION['sessionid'];
	 $sql = "INSERT INTO member (member_name,mem_username,password,groupid)
	 VALUES ('$mem_name','$mem_email','$mem_pass','$gid')";
	 if (mysqli_query($conn, $sql)) {
		$jmsg="New Member Added successfully !";
		echo '<script type=\'text/javascript\'>'; 
                echo 'alert("'.$jmsg.'");'; 
                echo '</script>';
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 
	 echo "<meta http-equiv='refresh' content='0'>";
}
?>
</div>
</div>

<button class="accordion"><i class="fa fa-user-times"> &nbsp;&nbsp;&nbsp;Remove Member</i></button>
<div class="panel">
    <?php
$sql = "SELECT * FROM member WHERE groupid='".$_SESSION['sessionid']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<i class='fa fa-user-circle'>&nbsp;";
        echo $row["member_name"];
        echo ":&nbsp;&nbsp;&nbsp;";
        echo $row["mem_username"];
        echo "</i>";
       echo "<br>";
        echo "<br>";
    }
} else {
    echo "No Members";
  
}
?> 
<form action="setting.php" method="post">
    <div class="row">
     
        <input type="text" id="lname" name="u1" placeholder="Enter Username to Remove member"  required>
      
    </div>
    <input type="submit" name="save1" value="Remove">
    </form>
</div>
<?php
if(isset($_POST['save1'])){
    $u1=$_POST['u1'];
    $sql = "SELECT * FROM member WHERE mem_username='".$u1."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$sql = "DELETE FROM member WHERE mem_username='".$u1."'";

if ($conn->query($sql) === TRUE) {
	$jmsg="Member Removed";
		echo '<script type=\'text/javascript\'>'; 
                echo 'alert("'.$jmsg.'");'; 
                echo '</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}
echo "<meta http-equiv='refresh' content='0'>";
}
else
{$jmsg="Member Not Found!";
		echo '<script type=\'text/javascript\'>'; 
                echo 'alert("'.$jmsg.'");'; 
                echo '</script>';
    
}
}
?>

<button class="accordion"><i class="fa fa-refresh"> &nbsp;&nbsp;&nbsp;Change Your Password</i></button>
<div class="panel">
 <form action="setting.php" method="post">
    <div class="row">
      <div class="col-25">
        <label for="fname">Current Password</label>
      </div>
      <div class="col-75">
        <input type="password" style="height:70%;" id="p1" name="old_pass" placeholder="Enter Current Password"  required >
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">New Password</label>
      </div>
      <div class="col-75">
        <input type="password" style="height:70%;" id="p2" name="new_pass" placeholder="New Password" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Confirm Password</label>
      </div>
      <div class="col-75">
        <input type="password" style="height:70%;" id="p3" name="new2_pass" placeholder="New Password" required>
      </div>
    </div>
    <input id="change" type="submit" name="change" value="Change" onclick="return check()">
    </form>
    <script>
    function check()
    {
    var p2=document.getElementById("p2").value;
    var p3=document.getElementById("p3").value;
    if(p2==p3)
    {
        return true;
    }
    else
    { alert("Passwords Not Matching");
    return false;
    }   
    }
    
    </script>
 </div>
 <?php
if(isset($_POST['change'])){
    $p1=$_POST['old_pass'];
    $p2=$_POST['new_pass'];
    $u1=$_SESSION['email'];
    $sql = "SELECT * FROM admins WHERE username='".$u1."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if($p1===$row["password"])
        {
            $sql = "UPDATE admins SET password='".$p2."' WHERE username='".$u1."'";
            if ($conn->query($sql) === TRUE) {
   $jmsg="Password Changed Successfully !";
		echo '<script type=\'text/javascript\'>'; 
                echo 'alert("'.$jmsg.'");'; 
                echo '</script>';
} else {
    echo "Error updating record: " . $conn->error;
}
            
        }
        else
        {$jmsg="Password Not Matching";
		echo '<script type=\'text/javascript\'>'; 
                echo 'alert("'.$jmsg.'");'; 
                echo '</script>';
            
        }
    }
}
}
?>
<br>
<br>
<br>
<br>
</div>
</div>
<style>
#add
{
    margin-left:5%;
}
input[type=text],input[type=email], select, textarea {
  width: 100%;
  padding: 10px;
  margin-top:2%;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  height:80%;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
  font-size:20px!important;
}


input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin-top:5%;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding-left:210px;
  font-size:20px!important;
  background-color:red;
  padding-bottom:0px;
  height:2%;
  margin:0px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
  
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
  
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top:20%;
  }
}
.accordion {
  background-color:#93c2ea;
  color:black;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding:20px;
  display: none;
  background-color: white;
  overflow: hidden;

}
.body
{
    background-color:#F6F2EF!important;
}
	.header1
	{
	    width:70%;
	    margin-left:230px;
	    margin-right:150px;
	    margin-top:5%;
	    background-color:#FFFFFF!important;
	  
	}
	#cap{
	    
	    position:relative;
	    bottom:160px;
	    left:370px;
	    font-size:30px;
	    
	    
	}
	#cap2{
	    
	    
	    font-size:18px;
	    color:white;
	    
	    
	}
	.content
	{
	    padding-left:5%;
	    padding-right:5%;
	     font-size:20px!important;
	}
	@media only screen and (max-width:620px) {
  /* For mobile phones: */
.header1{
    width:100%!important;
 margin-top:0px;
    margin-left:50px;
    
  }
  	#cap{
	    
	    position:relative;
	    bottom:150px;
	    left:20px;
	    font-size:19px!important;
	    
	    
	}
	#cap2{
	    
	    
	    font-size:10px;
	    color:white;
	    
	    
	}
	.content
	{
	    font-size:19px!important;
	    padding-right:25%;
	}
}
	</style>
	<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
      
</body>
</html>
