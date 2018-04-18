<?php
include_once 'connect-to-database.php';
$course_nums=explode(',',$_GET['q']);
array_pop($course_nums);
$query1="SELECT DISTINCT B.ImgURL, B.Name, N.Author, N.Edition, B.ISBN FROM Course C, Course_Uses_Book CB, Book B, Book_NAE N WHERE C.CID=CB.CID AND CB.ISBN=B.ISBN AND B.ISBN=N.ISBN AND (";
$query2="SELECT DISTINCT CD.LID, CD.Type, CD.Title, CD.Qty_sold, C.Name FROM Course_Doc_Listing CD, Course_Doc_Part_Of_Course P, Course C WHERE CD.LID=P.LID AND P.CID=C.CID AND (";
foreach($course_nums as $course){
	 $query1=$query1."C.CID=".$course." OR ";
	 $query2=$query2."C.CID=".$course." OR ";
}
$query1 = substr($query1, 0, strlen($query1)-4).");";
$query2 = substr($query2, 0, strlen($query2)-4).");";
$result=mysqli_query($conn, $query1);
while($book_info = mysqli_fetch_assoc($result)){
	echo "<a href=\"/book_page.php?ISBN=".$book_info["ISBN"]."\" style='float:left'>
		<div class='browse-container'>
			<div style='height:80px'>
				<h5 style='line-height:20px;'><b>Title:</b> ".$book_info["Name"]."<br>
				<b>Author:</b> ".$book_info["Author"]."<br>
				<b>Edition:</b> ".$book_info["Edition"]."</h5>
			</div>
			<div class=\"textbook-img\" style='margin-left:25px'>
				<img src='".$book_info["ImgURL"]."' alt='image not found' style='width:150px'>
			</div>
		
		</div>
	</a>";
}

$result2=mysqli_query($conn, $query2);
while($cd_info = mysqli_fetch_assoc($result2)){
	echo "<a href=\"/course_doc_page.php?LID=".$cd_info["LID"]."\" style='float:left'>
		<div class='browse-container'>
			<h5 style='line-height:20px;'><b>Title:</b> ".$cd_info["Title"]."<br>
			<b>Type:</b> ".$cd_info["Type"]."<br>
			<b>Associated Course:</b> ".$cd_info["Name"]."<br>
			<b>Quantity Sold:</b> ".$cd_info["Qty_sold"]."</h5>
		</div>
	</a>";
}


?>
