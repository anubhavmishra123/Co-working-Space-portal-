<?php

session_start();

$files=$_FILES['fileupload'];
$tmp_name=$files['tmp_name'];
$file_name=$files['name'];
move_uploaded_file($tmp_name,"files/".$file_name);
$servername = "shareddb-s.hosting.stackcp.net";
$database = "anudbms-313235305e";
$username = "anudbms-313235305e";
$password = "welcome123";
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
//group_chat.php




if($_POST["action"] == "insert_data")
{
 $data = array(
  ':from_user_id'  => $_SESSION["email"],
  ':chat_message'  => $_POST['chat_message'],
  ':status'   => '1'
 );
$from_user_id  = $_SESSION['email'];
$chat_message  = $_POST['chat_message'];
$to_user_id=$_SESSION['sessionid'];
 $status=1;
 if($chat_message!=""){
 $query = "
 INSERT INTO chat_message 
 (from_user_id,to_user_id, chat_message, status) 
 VALUES ('".$from_user_id."','".$to_user_id."','".$chat_message."', '".$status."')
 ";
if ($conn->query($query) === TRUE) {
    echo fetch_group_chat_history($conn);
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
}

 
}
if(isset($file_name))
{
    $to_user_id  = $_SESSION['sessionid'];
 $from_user_id  = $_SESSION['email'];
 $chat_message  = "files/".$file_name;
 $status=0;
 $query = "
    INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message, status) 
VALUES ('".$to_user_id."', '".$from_user_id."', '".$chat_message."', '".$status."')
";
if ($conn->query($query) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
}


if($_POST["action"] == "fetch_data")
{
 echo fetch_group_chat_history($conn);
}


function fetch_group_chat_history($connect)
{
    $to_user_id1=$_SESSION['sessionid'];
    
 $query = "
 SELECT * FROM chat_message 
 WHERE to_user_id = '".$to_user_id1."'  
 ORDER BY timestamp DESC
 ";

$result = $connect->query($query);

 $output = '<ul class="list-unstyled" style="font-size:8%!important">';
 while($row = $result->fetch_assoc())
 {
  $user_name = '';
  
  {
       $query1 = "
 SELECT * FROM admins 
 WHERE username = '".$row["from_user_id"]."'
 ";
 $result1 = $connect->query($query1);
 while($row1 = $result1->fetch_assoc())
 {
$user_name = '<b style="color:black;font-size:20px;text-transform:uppercase;">'.$row1["name"].'</b>';
 }
 $query2 = "
 SELECT * FROM member
 WHERE mem_username = '".$row["from_user_id"]."'
 ";
  $result2 = $connect->query($query2);
 while($row2 = $result2->fetch_assoc())
 {
$user_name = '<b style="color:black;font-size:20px;text-transform:uppercase;">'.$row2["member_name"].'</b>';
 }
   
  }

  if($row["from_user_id"]!=$_SESSION['email'])
  {
if($row['status']!=0){
  $output .= '
  <li align="left" style="background-color:#00AF91;margin-right:50%;padding-left:5%;padding-top:1%;padding-bottom:1%;margin-bottom:2%;border-radius:7px;color:white">
   <p>'.$user_name.' <br>'.$row["chat_message"].'
    
   </p>
   </li>
  ';
}
else
{
  $output .= '
  <li align="left" style="background-color:#00AF91;margin-right:50%;padding-left:5%;padding-top:1%;padding-bottom:1%;margin-bottom:2%;border-radius:7px;color:white">
   <p>'.$user_name.' <br><a target="_blank" href='.$row["chat_message"].'><image src="fileicon.png" width="20%"></a>
    
   </p>
   </li>
  ';  
    
    
}
 }
 else
 {
     if($row['status']!=0){
     $output .= '
  <li align="right" style="background-color:#00AF91;margin-left:50%;padding-right:3%;padding-top:1%;padding-left:5%;padding-bottom:1%;margin-bottom:2%;border-radius:7px;color:white">
   <p>'.$user_name.'<br> '.$row["chat_message"].'
    
   </p>
   </li>
  ';
 }
 
 else
 {
     
    $output .= '
  <li align="right" style="background-color:#00AF91;margin-left:50%;padding-right:3%;padding-top:1%;padding-left:5%;padding-bottom:1%;margin-bottom:2%;border-radius:7px;color:white">
   <p>'.$user_name.'<br> <a target="_blank" href='.$row["chat_message"].'><image src="fileicon.png" width="20%"></a>
    
   </p>
   </li>
  '; 
     
     
 }
 
 }
     
     
 }
 $output .= '</ul>';
 return $output;
}


?>