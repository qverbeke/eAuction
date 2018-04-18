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
  <script>
	function expandChildren(parent_id){
		var par_elem = Array.from(document.getElementById(parent_id).children);
		var i;
		for(i=1; i<par_elem.length; i++){
			if(par_elem[i].className==="hide"){
				par_elem[i].className="unhide";
			}
			else if(par_elem[i].className==="unhide"){
				par_elem[i].className="hide";
			}
		}
		return false;
	}
	function findChildCourses(parent_id){
		var res_ary=[];
		if(parent_id.includes("browse")){
			res_ary = findChildCourses_helper(parent_id);
		}
		else if(parent_id.includes("course")){
			res_ary.push(parent_id.substring(6));
		}
		var i;
		var res_str="";
		for(i=0; i<res_ary.length; i++){
			res_str=res_str.concat(res_ary[i])+",";
		}
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("books").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "action_browse.php?q=" + res_str, true);
		xmlhttp.send();
		return false;
	}
	function findChildCourses_helper(parent_id){
		var par_elem = Array.from(document.getElementById(parent_id).children);
		var res_ary = [];
		var i;
		for(i=1; i<par_elem.length; i++){
			if(par_elem[i].id.includes("course")){
				res_ary.push(par_elem[i].id.substring(6));
			}
			else if(par_elem[i].id.includes("browse")){
				res_ary=res_ary.concat(findChildCourses_helper(par_elem[i].id));
			}
		}
		return res_ary;
	}
	function togglePM(pmid){
		var pm = document.getElementById(pmid);
		if(pm.className==="plus"){
			pm.className="minus";
			pm.innerHTML="<img src='img/minus.png' style='width:18px; float:left; margin-left:1px; margin-right:1px; margin-top:1px'>"
			
		}
		else if(pm.className==="minus"){
			pm.className="plus";
			pm.innerHTML="<img src='img/plus.png' style='width:20px; float:left'>"
		}
		return false;
	}
  </script>
</head>
<body style="background-color:#00cc7a">
	<div id="navbar" style="margin-top:50px;"></div>
	<div class="container-fluid with-navbar">
		<div class="row">
			<div class="col-sm-6" id="books"></div>
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
					function direct_child_courses($gid){
						include 'connect-to-database.php';
						$query="SELECT C.CID, C.Name FROM MyGroup G, Course C WHERE G.GID=".$gid." AND C.GID=G.GID;";
						$result=mysqli_query($conn, $query);
						while($c_info = mysqli_fetch_array($result, MYSQLI_ASSOC)){
							echo "<div id='course".$c_info["CID"]."' class='hide' style='margin-left:28px'>
								<a href='' onclick='findChildCourses(\"course".$c_info["CID"]."\"); return false;'>".$c_info["Name"]."</a>
							</div>";
						}
					}
					function create_graphic($input_index){
						$input_tuple=array();
						if($input_index>=count($GLOBALS["group_hier"])){
							return 0;
						}
						else{
							$input_tuple=$GLOBALS["group_hier"][$input_index];
						}
						include 'connect-to-database.php';
						$query="SELECT Name FROM MyGroup WHERE GID=".$input_tuple[0].";";
						$result=mysqli_query($conn, $query);
						$name = mysqli_fetch_assoc($result);
						if($GLOBALS["prev_level"]>=$input_tuple[1]){
							echo str_repeat("</div>", 1+$GLOBALS["prev_level"]-$input_tuple[1]);
						}
						$GLOBALS["prev_level"]=$input_tuple[1];
						echo "<div id='browse".$input_tuple[0]."' style='margin-left:10px' class='";
						if($input_tuple[1]==0){
							echo "un";
						}
						echo "hide'>
								<a id='pm".$input_tuple[0]."' class='plus' href='' onclick=\"expandChildren('browse".$input_tuple[0]."'); togglePM('pm".$input_tuple[0]."'); return false;\"><img src='img/plus.png' style='width:20px; float:left'></a>
								<a href='' onclick=\"findChildCourses('browse".$input_tuple[0]."'); return false;\" style='float:left'>"
									.$name["Name"]."
								</a><br>";
						direct_child_courses($input_tuple[0]);
						create_graphic($input_index+1);
						echo "</div>";
						return "<h3>".str_repeat("&emsp;", $input_tuple[1])." ".$name["Name"]."</h3>";
					}
					
					include 'connect-to-database.php';
					$query="SELECT GID FROM MyGroup;";
					$result=mysqli_query($conn, $query);
					while($GID = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						build_hier($GID["GID"]);
					}
					$prev_level=-1;
					echo "<div class='container-fluid' style='background-color:white; border-radius:10px; margin-right:10px; padding-top:10px; padding-bottom:10px'>";
					create_graphic(0);
					echo "</div>";
				?>
			</div>
		</div>
	</div>
</body>
</html>
