<?php
  include_once 'connect-to-database.php';
    session_start();
    $title = $_POST['Title'];
    $check=0;
    if(isset($_POST['check'])){
		$check=1;
	}
    $content = $_POST['Content'];
    $sql = "INSERT INTO Feedback(Title, Is_bug, Content, UID, Timestamp) VALUES ('".$title."',  ".$check.", '".$content."', ".$_SESSION["UID"].", CURRENT_TIMESTAMP);";
    mysqli_query($conn, $sql);
    header("Location: feedback.php");
    
?>
