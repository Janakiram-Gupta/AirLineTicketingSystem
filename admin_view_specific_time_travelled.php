<?php
	session_start();
?>
<html>
	<head>
		<title>
			View Booked Tickets
		</title>
		<style>
			input {
    			border: 1.5px solid #030337;
    			border-radius: 4px;
    			padding: 7px 30px;
			}
			input[type=submit] {
				background-color: #030337;
				color: white;
    			border-radius: 4px;
    			padding: 7px 45px;
    			margin: 0% 15.8%
			}
			input[type=date] {
				border: 1.5px solid #030337;
    			border-radius: 4px;
    			padding: 5.5px 44.5px;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
	</head>
	<body style='background-color: #0077c82e;'>
		<div style="margin-left: 20%; height: 85px;">
			<img class="logo" src="images/shutterstock_22.png"/> 
			<h1 id="title">
				Threya Flight Reservation Services
			</h1>
		</div>
		<div>
			<ul>
				<li style="margin-left: 30%;"><a href="admin_homepage.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li><a href="admin_homepage.php"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a></li>
				<li><a href="logout_handler.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
			</ul>
		</div>
		<form action="admin_view_specific_time_travelled__formhandler.php" method="post">
			<div>
					<h2 style="margin-left: 20%;">View Total number of hours that a specific passenger has travelled during a specific time interval.</h2>
					<div style="margin-left: 29%;">
					<table cellpadding="5">
						<tr>
							<td class="fix_table">Enter the customer name</td>
							<td class="fix_table">Enter the from date</td>
							<td class="fix_table">Enter the to date</td>
						</tr>
						<tr>
							<td class="fix_table"><input type="text" name="customer_id" required></td>
							<td class="fix_table"><input type="date" name="from_date" required></td>
							<td class="fix_table"><input type="date" name="to_date" required></td>
						</tr>
					</table>
					<br>
					<br>
					<input type="submit" value="Find" name="Find">
				</div>

			</div>
		</form>
	</body>
</html>