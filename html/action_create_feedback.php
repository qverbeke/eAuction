<?php
  include_once 'connect-to-database.php';
    $title = $_POST['Title'];
    $check=0;
    if(isset($_POST['check'])){
		$check=1;
	}
    $content = $_POST['Content'];

    $sql = "INSERT INTO Feedback (Title, Is_bug, Content) VALUES ('".$title."',  ".$check.", '".$content."');";
    mysqli_query($conn, $sql);
    header("Location: feedback.php");
    
?>
