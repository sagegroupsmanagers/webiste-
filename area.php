<?php
	$link=mysqli_connect("localhost","root","","food");
	if (!$link) {
			die('Not connected : ' . mysql_error());
	}
	
	$city_name = isset($_GET['city_name']) ? mysqli_real_escape_string($link,$_GET['city_name']) :  "";
	//echo $city_name;
	if(!empty($city_name)) {
		$qur_area_for_city = mysqli_query($link,"SELECT area_name from area a,city_area_map cam,city c WHERE a.area_id=cam.area_id and cam.city_id=c.city_id and c.city_name = '$city_name'")  or die("Invalid query: "  .mysql_error());
		$result =array();
		while($r = mysqli_fetch_array($qur_area_for_city))
		{
			extract($r);
			$result[] = array("Area name" => $area_name); 
			$json = array("status" => 1, "info" => $result);
		}  
	}	
	else{
		$json = array("user-exist" => "0");
		//echo " User not exist";
	}
	@mysqli_close($link);
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
?>

