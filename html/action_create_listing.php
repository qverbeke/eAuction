<?php
//allow errors to be displayed
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'connect-to-database.php';

$action = $_POST["action"];
if ($action != "book" && $action != "doc"){
  echo "illegal action";
  exit();
}
$seller_uid = $_SESSION["UID"];
$price = 0;
if($action == "book"){
  $price = $_POST["book-price"];
}
else{
  $price = $_POST["doc-price"];
}
mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
$sql_statement = "INSERT INTO Listing(Price, Seller_UID)
VALUES({$price}, {$seller_uid});";
$result = mysqli_query($conn, $sql_statement);
if(!$result){
  echo 'Could not run query: ' . mysqli_error($conn);
  mysqli_rollback($conn);
  exit();

}
$LID = mysqli_insert_id($conn);
if($action == "book"){
  $isbn = $_POST["select-book"];
  $quality = $_POST["select-quality"];
  $sql_statement = "INSERT INTO Book_Listing(LID, Quality, ISBN)
  VALUES({$LID}, \"{$quality}\", \"{$isbn}\");";
  $result = mysqli_query($conn, $sql_statement);
  if(!$result){
    echo 'Could not run query: ' . mysqli_error($conn);
    mysqli_rollback($conn);
    exit();

  }

  $course = $_POST["select-course"];
  $query="INSERT INTO Course_Uses_Book(CID, ISBN) VALUES({$course},\"{$isbn}\");";
  $result=mysqli_query($conn, $query);
  if(!$result){
    echo 'Could not run query: ' . mysqli_error($conn);
    mysqli_rollback($conn);
    exit();
  }
  mysqli_commit($conn);
  mysqli_close($conn);
  header("Location: home.php");
  exit();
}
else if($action =="doc"){
  $type = $_POST["select-type"];
  $title = $_POST["title"];
  $description = $_POST["description"];
  $sql_statement = "INSERT INTO Course_Doc_Listing(LID, Type, Title, Description)
  VALUES ({$LID}, \"{$type}\", \"{$title}\", \"{$description}\");";
  $result = mysqli_query($conn, $sql_statement);
  if(!$result){
    echo 'Could not run query: ' . mysqli_error($conn);
    mysqli_rollback($conn);
    exit();

  }

  $CID = $_POST["select-course"];
  echo "{$CID}";
  $sql_statement = "INSERT INTO Course_Doc_Part_Of_Course(CID, LID)
  VALUES ({$CID}, {$LID});";
  $result = mysqli_query($conn, $sql_statement);
  if(!$result){
    echo 'Could not run query: ' . mysqli_error($conn);
    mysqli_rollback($conn);
    exit();
  }
  mysqli_commit($conn);
  mysqli_close($conn);
	$target_dir = "/var/www/html/uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
	echo "hi";
        echo $_FILES["fileToUpload"]["error"];
    }
  //header("Location: home.php");
  //exit();
}

 ?>
