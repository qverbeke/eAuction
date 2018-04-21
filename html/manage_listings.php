<?php
session_start();
if(!isset($_SESSION['UID'])){
	header("Location:index.php?from=book_page");
}
?>
<!DOCTYPE html>
<html>
</html>
