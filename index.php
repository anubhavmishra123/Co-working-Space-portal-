<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Co-working Space</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="button.css" type="text/css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <script type="text/javascript">
	// Prevent dropdown menu from closing when click inside the form
	$(document).on("click", ".navbar-right .dropdown-menu", function(e){
		e.stopPropagation();
	});
</script>
    


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
&nbsp;		<ul class="nav navbar-nav navbar-right"  >
			<li class="nav-item"><a href="#" class="nav-link">Home</a></li>
			<li class="nav-item"><a href="#" class="nav-link">About</a></li>			
			<li class="nav-item dropdown">
				<a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#">Features<b class="caret"></b></a>
				<ul class="dropdown-menu">					
					<li><a href="#" class="dropdown-item">Real-Time Chat</a></a></a></li>
					<li><a href="#" class="dropdown-item">News Feed</a></li>
					<li><a href="#" class="dropdown-item">File Sharing</a></li>
					<li><a href="#" class="dropdown-item">Task-Manager</a></li>
				</ul>
			</li>
			<li class="nav-item "><a href="#" class="nav-link">Pricing</a></li>
			<li class="nav-item"><a href="#" class="nav-link">Blog</a></li>
			<li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
		</ul>
		<div>
		    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-end" >
	
		<ul class="nav navbar-nav navbar-right ml-auto">			
			<li class="nav-item">
				<a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#" style="margin-top:4%;">Login</a>
				<ul class="dropdown-menu form-wrapper">					
					<li>
						<form action="http://coworkingspace-co-in.stackstaging.com" method="post">
							<p class="hint-text">Sign In</p>
							
							
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Username" name="email1"required="required">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Password" name="pass1"required="required">
							</div>
							<input type="submit" class="btn btn-primary btn-block" name="login" value="login">
							
						</form>
						<?php
						
						if(isset($_POST['login']))  
{  
						$_SESSION['email']=$_POST['email1'];
    $servername = "shareddb-s.hosting.stackcp.net";
$database = "anudbms-313235305e";
$username = "anudbms-313235305e";
$password = "welcome123";
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

    $user_email=$_POST['email1'];

    $user_pass=$_POST['pass1'];  
  
    $check_user="select * from admins WHERE username='$user_email'AND password='$user_pass'";  
    $check_user1="select * from member WHERE mem_username='$user_email'AND password='$user_pass'";
  
    $run=mysqli_query($conn,$check_user);
    $run1=mysqli_query($conn,$check_user1);
    $result = $conn->query($check_user1);
    $result1 = $conn->query($check_user);
    
    
  
    if(mysqli_num_rows($run)!==0)  
    {  
         $row1 = $result1->fetch_assoc();
       $_SESSION['sessionid']=$row1['adminid'];
        
       echo "<script>window.location.href='dashboard.php';</script>";
    exit;
  
        
 
    } 
    else if(mysqli_num_rows($run1)!==0)
    { $row = $result->fetch_assoc();
       $_SESSION['sessionid']=$row['groupid'];
     $_SESSION['mem_username']=$row['mem_username'];
        echo "<script>window.location.href='dashboard1.php';</script>";
    exit;
    }
    else  
    {  
      echo "<script>alert('Email or password is incorrect!')</script>";  
    }  
}  
						?>
					</li>
				</ul>
			</li>
			<br>
			<li class="nav-item">
				<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle get-started-btn mt-1 mb-1" >Sign up</a>
				<ul class="dropdown-menu form-wrapper">					
					<li>
						<form action="index.php" method="post">
							<p class="hint-text">Fill in this form to create your account!</p>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Name" name="name"required="required">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="uname" id="uname" placeholder="Email" required="required">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="pass"id="pass1" placeholder="Password" required="required">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" id="pass2" placeholder="Confirm Password" required="required">
							</div>
							<h3></h3>
							
							<div class="form-group">
								<p style="font-family:cursive;text-decoration:line-through;"id="mainCaptcha"> </p><input type="text" class="form-control" id="cap" placeholder="Enter Captcha" required="required">
							</div>
							
							<input type="submit" class="btn btn-primary btn-block" name="reg_user" onclick="return signup()"value="Sign up">
						</form>
						<?php 
						if($_POST['uname']==="" or $_POST['pass']===""){
						    
						}
						else{
						$servername = "shareddb-s.hosting.stackcp.net";
$database = "anudbms-313235305e";
$username = "anudbms-313235305e";
$password = "welcome123";

// Create connection
if (isset($_POST['reg_user']))
{
   // Do Stuff

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
$name1=$_POST['name'];
$name = $_POST['uname'];
$pass = $_POST['pass'];


$query = "insert into admins(password,username,name) values ('$pass', '$name','$name1')";

if (mysqli_query($conn, $query)) {
    $jmsg="Successfully Signed Up!!!";
      echo '<script type=\'text/javascript\'>'; 
                echo 'alert("'.$jmsg.'");'; 
                echo '</script>';
} 

else{
   

}
}
}

// Closing Connection with Server
?>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
<div class="back" style="background-image:url('a.jpg');height:50%;width:100%;padding-top: 10%;padding-bottom: 15%">
<div style="margin-left: 5%;">
 <div id="back1" style="font-family: Impact, fantasy;">
  Work Smarter,
  <br>
  Work Together
  <br>
</div>
<br>
<br>
<br>
<br>
<div id="back2" style="font-family:Courier, monospace;font-weight:bold;font-size:20px;">
  Connect with people and teams across your organization.<br>Make better decisions,Faster.
 </div>
 <br>
 <br>
 <form>
 
 
 </div>
 
 </form>
 </div>

  </div>
  <div ><center>
   <div class="gill" style="font-family:  Gill Sans Extrabold, sans-serif;font-size:40px;margin-top: 5%;"> Co-working Space makes communication and collaboration effortless</div>
<div class="gill1" style="font-size:25px">Get all the features you need in one easy-to-use tool</div>
  </center></div>
  <br>
  <br>
  <br>
  <br>
  <div class="xmas" style="margin-left:25%; font-size:20px;">
  <div class="box" style="float: left;width:20%;">
    <img id="im"src="chat.png" width="20%"><br>
    <div id="con" onclick="conversation()">Messenger</div>
  </div>
  <div class="box" style="float: left;width:20%;">
    <img id="im" src="feed.png" width="20%"><br>
  <div id="con2" onclick="feed()"> New Feed</div>
  </div>
  <div class="box" style="float: left;width:20%">
    <img id="im" src="files.png" width="20%"><br>
    <div id="con2" onclick="files()">File Sharing</div>
  </div>
  <div class="box" style="float: left;width:20%">
    <img id="im" src="task.png" width="20%"><br>
    <div id="con1"onclick="taskmanager()">Task Manager</div>
  
  </div>
</div>

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

  <div style="clear: both;"></div>

  <div id="para" style="width: 50%;margin-left: 30%;" ><h2>Start a direct chat or group conversation</h2> <br>With the entire company directory at your fingertips, you can begin a chat with just about anyone. Or, simply create a channel and get everyone to share their ideas. Use a private channel for focused discussions, or a public one to let your teammates easily discover and join meaningful conversations.</div>
  <br>
  <br><br>
  <br>
  <script type="text/javascript">
  var alpha = new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
             var i;
             for (i=0;i<4;i++){
               var a = alpha[Math.floor(Math.random() * alpha.length)];
               var b = alpha[Math.floor(Math.random() * alpha.length)];
               var c = alpha[Math.floor(Math.random() * alpha.length)];
               var d = alpha[Math.floor(Math.random() * alpha.length)];
              }
            var code = a + '' + b + '' + '' + c + '' + d;
            document.getElementById("mainCaptcha").innerHTML=document.getElementById("mainCaptcha").innerHTML+""+code;
    var str="<h2>Start a direct chat or group conversation</h2> <br>With the entire company directory at your fingertips, you can begin a chat with just about anyone. Or, simply create a channel and get everyone to share their ideas. Use a private channel for focused discussions, or a public one to let your teammates easily discover and join meaningful conversations.";
    var st1="<h2>Share all types of files and find them easily </h2><br>Need to share multiple images with your teammates? Simply drag and drop files of all types and see previews of shared files as well. Need to find a file someone shared? You can view all shared files and content in one place in Flock.";
    var st0="<h2>Share important news and updates with the entire team </h2><br>Over the moon with that big client win? With Flock, you can share the cheer with everyone via one-way Announcement channels, where only team admins can broadcast information. No more guessing whether everyone got the message!";
    var st2="<h2>Make it quick to organize tasks</h2><br>Organizing your tasks can make everything more manageable.You are likely to lose track of what needs to be done at certain times. The to-do list apps will help you get organized with a great to-do lists."
    function conversation()
    {
      document.getElementById("para").innerHTML=str;


    }
    function feed()
    {
      document.getElementById("para").innerHTML=st0;

    }
    function files()
    {
      document.getElementById("para").innerHTML=st1;

    }
    function taskmanager()
    {
      document.getElementById("para").innerHTML=st2;

    }
    function signup()
    {   var z=document.getElementById("uname").value;
        var x=document.getElementById("pass1").value;
        var y=document.getElementById("pass2").value;
        var cap=document.getElementById("cap").value;
        if(z==""||x==""||z=="")
        { alert("Enter Your Details!!!");
            return false;
        }
        else if(cap!=code)
        {
            alert("You Entered Wrong Captcha");
            return false;
        }
        else if(x!=y)
        {document.getElementById("pass1").value="";
        document.getElementById("pass2").value="";
            alert("Passwords Entered Not Matching!");
        return false;
            
        }
    }


  </script>
  <div class="me" style="background-color: #4599DA">
    <center><button class="try">Try For Free</button></center>
  </div>
  
  <div style="padding-left:5%;background-color:#4599DA">
      <div id="card" >
          <p id="header">Product</p>
Features<br>
Compare<br>
Customers<br>

</div>
<div id="card" >
<p id="header">OS</p>
Browse Apps<br>
Build Apps<br>
API Documentation
</div>
<div id="card">
<p id="header">Support</p>
Videos<br>
Help Center<br>
User Guide<br>
Admin Guide<br>
Contact Sales<br>
Legal
</div>
<div id="card">
<p id="header">Usecases</p>
Engineering<br>
Sales<br>
Marketing<br>
Product<br>
Human Resource<br>
Customer Support
</div>
<div id="card">
<p id="header">Company</p>
Careers<br>
News<br>
Desktop App<br>
Mobile App
</div>
<div style="clear:both">
          <br>
          <br>
          </div>

      </div>
   


      
</body>
</html>