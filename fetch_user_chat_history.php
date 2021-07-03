<?php


session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//insert_chat.php

$servername = "shareddb-s.hosting.stackcp.net";
$database = "anudbms-313235305e";
$username = "anudbms-313235305e";
$password = "welcome123";
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}

echo fetch_user_chat_history($_SESSION['email'], $_POST['to_user_id'], $conn);
function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE (from_user_id = '".$from_user_id."' 
 AND to_user_id = '".$to_user_id."') 
 OR (from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."') 
 ORDER BY timestamp DESC
 ";
 $result = $connect->query($query);
 $output = '<ul class="list-unstyled">';
 while($row = $result->fetch_assoc())
 {
  $user_name = '';
  if($row["from_user_id"] == $from_user_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.$from_user_id.'</b>';
  }
  if($row["from_user_id"]==$to_user_id)
  {
  if($row['status']!=0)
  {$output .= '
  <li align="left" style="background-color:#007AFF;margin-right:50%;padding-left:3%;padding-top:1%;padding-bottom:1%;margin-bottom:2%;border-radius:7px;color:white">
   <p> '.$row["chat_message"].'
    
   </p>
   </li>
  ';}
      else
       {$output .= '
  <li align="left" style="background-color:#007AFF;margin-right:50%;padding-left:3%;padding-top:1%;padding-bottom:1%;margin-bottom:2%;border-radius:7px;color:white">
   <p> <a target="_blank" href='.$row["chat_message"].'><image src="fileicon.png" width="20%"></a>
    
   </p>
   </li>
  ';}
      
  }
  else
  {if($row['status']!=0)
  {$output .= '
  <li align="right" style="background-color:#D3D3D3;margin-left:50%;padding-right:3%;padding-top:1%;padding-bottom:1%;margin-bottom:2%;border-radius:7px">
   <p> '.$row["chat_message"].'
    
   </p>
   </li>
  ';
      
  }
  else{
      $output .= '
  <li align="right" style="background-color:#D3D3D3;margin-left:50%;padding-right:3%;padding-top:1%;padding-bottom:1%;margin-bottom:2%;border-radius:7px">
   <p> <a target="_blank" href='.$row["chat_message"].'><image src="fileicon.png" width="20%"></a>
    
   </p>
   </li>
  ';
     
  }
  
 }
 }
 $output .= '</ul>';
 $query = "
 UPDATE chat_message 
 SET status = '1' 
 WHERE from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."' 
 AND status = '1'
 ";
 
 return $output;
}

function get_user_name($user_id, $connect)
{
 $query = "SELECT mem_username FROM member WHERE mem_username = '$user_id'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['username'];
 }
}

function count_unseen_message($from_user_id, $to_user_id, $connect)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}

?>