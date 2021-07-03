<?php
session_start();

?>
<html>
<title>Direct Message</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="chatcss.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    

<div class="w3-sidebar w3-bar-block w3-black w3-xxlarge" style="width:50px;font-size:25px!important;">
    <br>
    <br>
  <a href="dashboard1.php" class="w3-bar-item w3-button" ><i class="fa fa-home" ></i></a> <br>
  <a href="groupchat1.php" class="w3-bar-item w3-button"><i class="fa fa-users"></i></a> <br>
  <a href="chat1.php" class="w3-bar-item w3-button" style="background-color:#F1F1F1;color:black;"><i class="fa fa-paper-plane-o"></i></a> <br>
  <a href="TaskManager1.php" class="w3-bar-item w3-button"><i class="fa fa-tasks"></i></a><br>
  <a href="setting1.php" class="w3-bar-item w3-button"><i class="fa fa-gear"></i></a><br>
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
   
<div class="box">
    <div id="head">
       <center><p>CONTACTS</p></center>
    
    </div>
    <hr style="background-color:white;margin-bottom:0px;">
    <div id="friends">
   
       <?php
$servername = "shareddb-s.hosting.stackcp.net";
$database = "anudbms-313235305e";
$username = "anudbms-313235305e";
$password = "welcome123";
$conn = mysqli_connect($servername, $username, $password, $database);
$sql = "SELECT * FROM member WHERE groupid='".$_SESSION['sessionid']."' AND mem_username <>'".$_SESSION['email']."' ";
$sql1="SELECT * FROM admins WHERE adminid='".$_SESSION['sessionid']."'";
$result = $conn->query($sql);
$result1 = $conn->query($sql1);

if ($result->num_rows > 0 or $result1->num_rows > 0) {
 
    while($row = $result->fetch_assoc()) {
        echo "<div class='contact' onMouseOver=\"this.style.backgroundColor='#333333'\"
        onMouseOut=\"this.style.backgroundColor='black'\"  style='margin-top:0px;padding-top:5px' data-uid='".$row['member_name']."' data-uname='".$row['mem_username']."'>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-user-circle'><i  style='font-family:Courier;'>&nbsp;";
        echo strtoupper($row["member_name"]);
        echo "<br>&nbsp;&nbsp;&nbsp;";
        echo "<i style='font-size:15px;font-family:georgia'>";
        echo $row["mem_username"];
         echo "</i></i></i>";
        echo "<hr style=\"background-color:white;margin-bottom:0px;\">";
        echo "</div>";
    }
    while($row = $result1->fetch_assoc()) {
        echo "<div class='contact' onMouseOver=\"this.style.backgroundColor='#333333'\"
        onMouseOut=\"this.style.backgroundColor='black'\"  style='margin-top:0px;padding-top:5px' data-uid='".$row['name']."' data-uname='".$row['username']."'>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-user-circle'><i  style='font-family:Courier;'>&nbsp;";
        echo strtoupper($row["name"]);
        echo "<br>&nbsp;&nbsp;&nbsp;";
        echo "<i style='font-size:15px;font-family:georgia'>";
        echo $row["username"];
        echo "</i></i></i>";
        echo "<hr style=\"background-color:white;margin-bottom:0px;\">";
        echo "</div>";
    }
} else {
    echo "No Contact";
  
}

?>
<script>
$(document).ready(function(){


 setInterval(function(){

  update_chat_history_data();
 }, 5000);
    
 function make_chat_dialog_box(to_user_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_user_id+'"  style="padding:0px!important;height:5%;"class="user_dialog" title="You have chat with '+to_user_name+'">';
  modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll;margin-top:0px; margin-bottom:0px; padding:0px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
  modal_content += 'Loading...';
  modal_content += '</div>';
  modal_content += '<div class="form-group"><form action="insert_chat.php" method="post">';
  modal_content += '<textarea placeholder="Type a message..." rows="1" name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
  modal_content += '</div><div class="form-group" align="center">';
  modal_content += '<label class="fileContainer" align="left"><img src="fileupload.png" width="10%"><input type="file" placeholder="Choose a file ..." name="image" id="image" class="image"></label>';
  modal_content+= '<button type="button" style="background-color:#007BFF" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></form></div>';
  $('#user_model_details').html(modal_content);
 }


    $(document).on('click', '.contact', function(){
  var to_user_id = $(this).data('uname');
  var to_user_name = $(this).data('uid');
  var name=to_user_name.toUpperCase();
  
  make_chat_dialog_box(to_user_id, to_user_name);
  $('#user_model_details').dialog({
   autoOpen:false,
   width:400,
   title: name,
   dialogClass: 'myTitleClass'
  });
  $('#user_model_details').dialog('open');
 });
 
  $(document).on('click', '.send_chat', function(){
  var to_user_id = $(this).attr('id');
  var file_name=$('.image').val();
  var chat_message = document.getElementById('chat_message_'+to_user_id).value;
var formData = new FormData();
			formData.append('fileupload',$( '.image' )[0].files[0], file_name);
			formData.append('to_user_id',to_user_id);
			formData.append('chat_message',chat_message);
  
  $.ajax({
   url:"insert_chat.php",
   method:"POST",
   processData: false,
   contentType: false,
   data:formData,
   success:function(data)
   {
    document.getElementById('chat_message_'+to_user_id).value="";
//    $('#chat_history_'+to_user_id).html(data);
  document.getElementById('image').value="";
   }
   
   
  })
  
 });
 
 
 function fetch_user_chat_history(to_user_id)
 {
     
  $.ajax({
   url:"fetch_user_chat_history.php",
   method:"POST",
   data:{to_user_id:to_user_id},
   success:function(data){
  document.getElementById('chat_history_'+to_user_id).innerHTML=data;
   }
  })
 }

 function update_chat_history_data()
 {
     
  $('.chat_history').each(function(){
   var to_user_id = $(this).data('touserid');
   fetch_user_chat_history(to_user_id);
  });
 }
 
 
});
 
</script>
<style>
.myTitleClass .ui-dialog-titlebar {
          background-color:#007BFF;
          color:white;
    }
</style>
        </div>
    
    
    </div>
   
 <div id="user_model_details" style="padding:0px;"></div>
      
</body>
</html>
