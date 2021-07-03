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
if($_POST["action"] == "fetch_data")
{
 echo fetch_group_chat_history($conn);
}

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
if($_POST["action"] == "insert_data")
{
 $data = array(
  ':from_user_id'  => $_SESSION["email"],
  ':chat_message'  => $_POST['chat_message'],
  ':status'   => '1'
 );
$from_user_id  = $_SESSION['email'];
$chat_message  = $_POST['chat_message'];
$groupid=$_SESSION['sessionid'];
 if($chat_message!=""&&!isset($file_name)){
 $query = "
 INSERT INTO userstory
 (groupid,text,from_user_id) 
 VALUES ('".$groupid."','".$chat_message."', '".$from_user_id."')
 ";
if ($conn->query($query) === TRUE) {
  echo fetch_group_chat_history($conn);
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
}

 

if($chat_message!=""&&isset($file_name))
{
   
 $query = "
 INSERT INTO userstory
 (groupid,text,from_user_id,files) 
 VALUES ('".$groupid."','".$chat_message."', '".$from_user_id."','".$file_name."')
 ";
if ($conn->query($query) === TRUE) {
    echo fetch_group_chat_history($conn);
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
}
}



function fetch_group_chat_history($connect)
{
    
 $query = "
 SELECT * FROM userstory
 where groupid='".$_SESSION['sessionid']."'
 ORDER BY timestamp DESC
 ";

$result = $connect->query($query);

 $output = '<ul class="list-unstyled" >';
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
$user_name = '<b style="color:black;font-size:30px;text-transform:capitalize;"><i class="fa fa-share-alt-square" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;'.$row1["name"].'</b>';
 }
 $query2 = "
 SELECT * FROM member
 WHERE mem_username = '".$row["from_user_id"]."'
 ";
  $result2 = $connect->query($query2);
 while($row2 = $result2->fetch_assoc())
 {
$user_name = '<b style="color:black;font-size:30px;text-transform:capitalize;"><i class="fa fa-share-alt-square" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;'.$row2["member_name"].'</b>';
 }
   
  }

 
$src='/files/'.$row["files"];
  $output .= '
  <li>
   <p>'.$user_name.'&nbsp;&nbsp;&nbsp;&nbsp;'.$row["timestamp"].'<br><br><img id="fileimage" src='.$src.'><br><br>'.$row["text"].'
    
   </p>
   </li>
  ';


 

 
 

 
     
     
 
 
}
$output .= '</ul>';
 return $output;
}


?>