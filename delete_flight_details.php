<?php
	session_start();
?>
<html>
	<head>
		<title>
			Delete Flight Schedule Details
		</title>
		<style>
			input {
    			border: 1.5px solid #030337;
    			border-radius: 4px;
    			padding: 7px 10px;
			}
			input[type=submit] {
				background-color: #030337;
				color: white;
    			border-radius: 4px;
    			padding: 7px 45px;
    			margin: 0px 215px
			}
			input[type=date] {
				border: 1.5px solid #030337;
    			border-radius: 4px;
    			padding: 5.5px 30px;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
	</head>
	<body style='background-color: #0077c82e;'>
		<div style="margin-left: 25%;">
			<img class="logo" src="images/shutterstock_22.png"/> 
			<h1 id="title">
				Threya Airlines
			</h1>
		</div>
		<div>
			<ul>
				<li style="margin-left: 30%;"><a href="admin_homepage.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li><a href="admin_homepage.php"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a></li>
				<li><a href="logout_handler.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
			</ul>
		</div>
		<form action="delete_flight_details_form_handler.php" method="post">
			<div style="margin-left: 17%;">
				<h2>ENTER THE FLIGHT SCHEDULE TO BE DELETED</h2>
				<div>
				<?php
					if(isset($_GET['msg']) && $_GET['msg']=='success')
					{
						echo "<strong style='color:green; padding-left:20px;'>The Flight Schedule has been successfully deleted.</strong>
							<br>
							<br>";
					}
					else if(isset($_GET['msg']) && $_GET['msg']=='failed')
					{
						echo "<strong style='color:red; padding-left:20px;'>*Invalid Flight No./Departure Date, please enter again.</strong>
							<br>
							<br>";
					}
				?>
				<table cellpadding="5" style="margin-left: 12%;">
					<tr>
						<td class="fix_table">Enter a valid Flight No.</td>
						<td class="fix_table">Enter the Departure Date</td>
					</tr>
					<tr>
						<td class="fix_table"><input type="text" name="flight_no" required></td>
						<td class="fix_table"><input type="date" name="departure_date" required></td>
					</tr>
				</table>
				<br>
				<br>
				<input type="submit" value="Delete" name="Delete" style="margin: 0px 0px 0px 27%;width: 11%;padding: 5px 29px;">
				</div>
			</div>	
		</form>
	</body>
</html>