<?php
session_start();

//insert_chat.php
 
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
 $to_user_id  = $_POST['to_user_id'];
 $from_user_id  = $_SESSION['email'];
 $chat_message  = $_POST['chat_message'];
 $status=1;
 if($chat_message!=""){
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
if(isset($file_name))
{
    $to_user_id  = $_POST['to_user_id'];
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
    


 
   
?>
