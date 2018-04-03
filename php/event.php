<?php
	require 'db_connection.php';
	$query = "SELECT `s_event`,`s_id` from `student_info`";
	$run=mysqli_query($connection,$query);
	while($row = mysql_fetch_array($query) ){
		$colunm1 = $row['s_id'];
		$colunm2 = $row['s_event'];
		$query1 = "INSERT INTO `eventdb` (`e_id`,`e_name`) VALUES ('".$colunm1."','".$colunm2."')";
		$run=mysqli_query($connection,$query1);
		if($run){
			echo "Successfully";
		}
	}
?>