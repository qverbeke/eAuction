<!DOCTYPE html>
<html>
<head>
  <title>The Better Bookstore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/misc.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
	$(document).ready(function(e){
    $('#navbar').load("navbar.html");
		$('.search-panel .dropdown-menu').find('a').click(function(e) {
			e.preventDefault();
			var param = $(this).attr("href").replace("#","");
			var concept = $(this).text();
			$('.search-panel span#search_concept').text(concept);
			$('.input-group #search_param').val(param);
		});
	});
  </script>
</head>
<body>
<div id="navbar" style="margin-top:50px;">
</div>
<div class="container-fluid with-navbar">
	<div class="row">
		<div class="col-sm-6">
		
		</div>
		<div class="col-sm-6">
			<?php
				$group_hier=array();
				function build_hier($gid) {
					include 'connect-to-database.php';
					$query="SELECT Supergroup_GID FROM MyGroup WHERE GID=".$gid.";";
					$result=mysqli_query($conn, $query);
					$supergroup_GID = mysqli_fetch_assoc($result);
					if($supergroup_GID["Supergroup_GID"]===NULL){
						array_push($GLOBALS["group_hier"], array($gid, 0));
						return array(1, count($GLOBALS["group_hier"]));
					}
					else{
						
						$in_ary=check_in_array($supergroup_GID["Supergroup_GID"]);
						if($in_ary[0]!=0){
							array_splice($GLOBALS["group_hier"], $in_ary[0], 0, array(array($gid, $in_ary[1])));
							return array($in_ary[1]+1, $in_ary[0]+1); 
						}
						else{
							$res_item=build_hier($supergroup_GID["Supergroup_GID"]);
							array_splice($GLOBALS["group_hier"], $res_item[1], 0, array(array($gid, $res_item[0])));
							return array($res_item[0]+1, $res_item[1]+1);
						} 
					}
				}
				function check_in_array($gid){
					$i=0;
					foreach($GLOBALS["group_hier"] as $elem){
						if($elem[0]==$gid){
							return array($i+1, $elem[1]+1);
						}
						$i=$i+1;
					}
					return array(0, 0);
				}
				function create_my_string($input_tuple){
					include 'connect-to-database.php';
					$query="SELECT Name FROM MyGroup WHERE GID=".$input_tuple[0].";";
					$result=mysqli_query($conn, $query);
					$name = mysqli_fetch_assoc($result);
					return "<h3>".str_repeat("--", $input_tuple[1])." ".$name["Name"]."</h3>";
				}
				include 'connect-to-database.php';
				$query="SELECT GID FROM MyGroup;";
				$result=mysqli_query($conn, $query);
				while($GID = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					build_hier($GID["GID"]);
				}
				foreach($group_hier as $input_tuple){
					echo create_my_string($input_tuple);
				}
				
				
				
				
				
				
			
			?>
		</div>
	</div>
</div>
</body>
</html>
