<?php
include_once 'connect-to-database.php';
$course_nums=explode(',',$_GET['q']);
array_pop($course_nums);
$query="SELECT DISTINCT B.ImgURL, B.Name, N.Author, N.Edition, B.ISBN FROM Course C, Course_Uses_Book CB, Book B, Book_NAE N WHERE C.CID=CB.CID AND CB.ISBN=B.ISBN AND B.ISBN=N.ISBN AND (";
foreach($course_nums as $course){
	 $query=$query."C.CID=".$course." OR ";
}
$query = substr($query, 0, strlen($query)-4).");";
$result=mysqli_query($conn, $query);
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






?>
