
<html>
<title>Group Chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="dashcss.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    

<div class="w3-sidebar w3-bar-block w3-black w3-xxlarge" style="width:50px;font-size:25px!important;">
    <br>
    <br>
  <a href="dashboard1.php" class="w3-bar-item w3-button" ><i class="fa fa-home" ></i></a> <br>
  <a href="groupchat1.php" class="w3-bar-item w3-button" style="background-color:#F1F1F1;color:black;"><i class="fa fa-users"></i></a> <br>
  <a href="chat1.php" class="w3-bar-item w3-button"><i class="fa fa-paper-plane-o"></i></a> <br>
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
   <div id="group_chat_dialog" title="Group Chat Window">
 <div id="group_chat_history" >

 </div>
 <div class="form-group">
  <textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>
 </div>
 <div class="form-group" align="left">
  <label class="fileContainer" align="left"><img src="fileupload.png" width="5%"><input type="file" placeholder="Choose a file ..." name="image" id="image" class="image"></label>
 </div>
 <div class="form-group" align="right" >
  <button type="button"  name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
 </div>
<script>
  
  $('#send_group_chat').click(function(){
 var chat_message = $('#group_chat_message').val();
 var action = 'insert_data';
 var file_name=$('.image').val();
 var formData = new FormData();
			formData.append('fileupload',$( '.image' )[0].files[0], file_name);
			formData.append('action',action);
			formData.append('chat_message',chat_message);
 
  $.ajax({
   url:"group_chat.php",
   method:"POST",
   processData: false,
   contentType: false,
   data:formData,
   success:function(data){
    $('#group_chat_message').val('');
    document.getElementById('image').value="";
   
   }
  })
 
});


function fetch_group_chat_history()
{
    
var action = "fetch_data";
 $.ajax({
   url:"group_chat.php",
   method:"POST",
   data:{action:action},
   success:function(data)
   {
   $('#group_chat_history').html(data);
   }
  })
 
}

setInterval(fetch_group_chat_history,1000);
</script>
<style>
#group_chat_dialog{
    width:50%;
    margin-left:25%;
    margin-top:2;}
    #send_group_chat{
    position:absolute;
    top:87%;
    left:70%;
    }
    #group_chat_history{
        height:500px;
        border:1px solid #ccc; 
        overflow-y: scroll;
        margin-bottom:24px; 
        padding:16px;
        width:100%;}
    
    @media only screen and (max-width: 600px) {
#group_chat_dialog{
    width:100%;
    height:50%;
    margin-left:10%;
    padding-right:15%;
  }
  #send_group_chat{
position:static;
margin-right:10%;
  }
  #image{
      width:80%;
      margin-left:6%;
      
  }
  #group_chat_message{
      margin-left:10%;
      width:80%
      
  }
  #group_chat_history{
      
      height:120%;
  }
}
    




</style>




      
</body>
</html>
