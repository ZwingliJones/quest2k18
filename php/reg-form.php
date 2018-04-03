
<?php
if(isset($_POST['std_name'])&& isset($_POST['dob']) && isset($_POST['std1'])&&isset($_POST['schoolname1'])&&isset($_POST['events1'])&&isset($_POST['agelimit'])){
		if (!empty($_POST['std_name'])) {
		$st_name = htmlentities($_POST['std_name']);
		$st_dob = $_POST['dob'];
		$st_std = htmlentities($_POST['std1']);
		$st_school= htmlentities($_POST['schoolname1']);
		$st_events = htmlentities($_POST['events1']);
		$st_age= htmlentities($_POST['agelimit']);
		if (isset($_POST['submit'])) {
			require 'db_connection.php';
			$query = "INSERT INTO `student_info` (`s_id`,`s_name`,`s_dob`,`s_school`,`s_age`,`s_std`,`s_event`)
               								 VALUES ('','".$st_name."','".$st_dob."','".$st_school."','".$st_age."','".$st_std."','".$st_events."')";
              $query2 = "SELECT `s_id` FROM `student_info` ORDER BY `s_id` desc limit 2";
              $run2 = mysqli_query($connection,$query2);
              $result = mysqli_fetch_row($run2);
              if ($result[0]==NULL) {
              		$result[0]=0;
              }
              $current_sid= ((int)$result[0]) +1;
              $query1 ="INSERT INTO `participate`(`e_id`,`s_id`) VALUES('".$st_events."','".$current_sid."')";
              $run = mysqli_query($connection,$query1);
			$run = mysqli_query($connection,$query);




			if ($run) {
				echo "Registered Successfully";			
			       }
			}
		}
		 else{
			echo'submit error';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="reg-form.css">
</head>
<body>
<h1><center>Registration Form</center></h1>
<form class="container" action="reg-form.php" method="POST">
	<label><span>Student's Name:</span><input type="text" name="std_name" placeholder="Name"/></label><br>
	<label><span>Date Of Birth :</span><input type="date" name="dob" /></label><br>
	<label><span>Standard      :</span><select id="mainselection" name="std1">
						    <option name="std" value=1>I std</option>
						    <option name="std" value=2>II </option>
						    <option name="std" value=3>III </option>
						    <option name="std" value=4>IV</option>
						    <option name="std" value=5>V</option>
						    <option name="std" value="6">VI</option>
						    <option name="std" value="7">VII</option>
						    <option name="std" value="8">VIII</option>
						    <option name="std" value="9">IX</option>
						    <option name="std" value="10">X</option>
						    <option name="std" value="11">XI</option>
						    <option name="std" value="12">XII</option>
						</select></label>
	</br><label><span>School Name:</span>
						<select id="mainselection" name="schoolname1">
						    <option name="schoolname" value="Joseph">Joseph School</option>
						    <option name="schoolname" value="vidhya">vidhya school</option>
						    <option name="schoolname" value="tvs">tvs school</option>
						    <option name="schoolname" value="tmv">tmv school</option>
						    <option name="schoolname" value="tce">tce school</option>
						</select></label>
	</br><label><span>Age Limit:</span> 
						<input type="radio" name=agelimit value="1"/><span>6 to 10</span>
						<input type="radio" name=agelimit value="2"/><span>11 to 14</span>
						<input type="radio" name=agelimit value="3"/><span>15 to 17</span></label></br>
	<label><span>Event Name:</span>
				<select id="mainselection" name="events1">
			        <option name="events" value="1">Dance</option>
			        <option name="events" value="2">Lits english</option>
			        <option name="events" value="3">Tamil lits</option>
			        <option name="events" value="4">Photography</option>
			        <option name="events" value="5">Arts</option>
			        <option name="events" value="6">Dramatics</option>
			        <option  name="events" value="7">Music</option>
			    </select></label>
			   	<label><input type="submit" name="submit" value="Register Now"/></label>

</form>

</body>
</html>

