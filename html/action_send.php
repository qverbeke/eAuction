<?php
//allow errors to be displayed
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'connect-to-database.php';

$Reciever_Username = $_POST["to"];
$message = $_POST["message"];
$action = $_POST["action"];

$Sender_UID = $_SESSION["UID"];

if($action == 'send'){
    $sql_statement = "SELECT U.UID FROM User_Username U WHERE U.Username='$Reciever_Username';";
    $result = mysqli_query($conn, $sql_statement);
    if (!$result || mysqli_num_rows($result) == 0) {
      //reload the page with different erro
      header("Location: messages.php?error=to_not_found");
      //stop running script
      exit();
    }
    $Receiver_UID = mysqli_fetch_row($result)[0];
    $sql_statement = "INSERT INTO Message(Sender_UID,
    Receiver_UID, Content, Is_Draft, Receiver_Username)
    Values('$Sender_UID', '$Receiver_UID', '$message', 0, '$Reciever_Username');";
    $result = mysqli_query($conn, $sql_statement);
    if(!$result){
      echo 'Could not run query: ' . mysqli_error($conn);
    }
    mysqli_query($conn, $sql_statement);
    header("Location: messages.php?action=sent");
    exit();
}
$sql_statement = "INSERT INTO Message(Sender_UID,
 Content, Is_Draft, Receiver_Username)
Values('$Sender_UID', '$message', 1, '$Reciever_Username');";
$result = mysqli_query($conn, $sql_statement);
if(!$result){
  echo 'Could not run query: ' . mysqli_error($conn);
}
mysqli_query($conn, $sql_statement);
header("Location: messages.php?action=saved");
exit();

?>
