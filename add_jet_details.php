<?php
	session_start();
?>
<html>
	<head>
		<title>
			Add Aircrafts Details
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
    			margin: 0px 60px
			}
		</style>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
	</head>
	<body style='background-color: #0077c82e;'>
		<div style="margin-left: 20%; height: 85px;">
			 
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
		<form action="add_jet_details_form_handler.php" method="post">
			<div style="margin-left: 26%;">
				<h2>ENTER THE AIRCRAFTS DETAILS</h2>
				<div>
				<?php
					if(isset($_GET['msg']) && $_GET['msg']=='success')
					{
						echo "<strong style='color: green'>The Aircraft has been successfully added.</strong>
							<br><br>";
					}
					else if(isset($_GET['msg']) && $_GET['msg']=='failed')
					{
						echo "<strong style='color:red'>*Aircraft ID already exists, please enter a new Aircraft ID.</strong>
							<br><br>";
					}
				?>
				<table cellpadding="5" style="margin-left: 20%;">
					<tr>
						<td class="fix_table">Enter a valid Aircraft ID</td>
					</tr>
					<tr>
						<td class="fix_table"><input type="text" name="jet_id" required></td>
					</tr>
				</table>
				<br>
				<table cellpadding="5" style="margin-left: 20%;">
					<tr>
						<td class="fix_table">Enter the Aircraft Type/Model</td>
					</tr>
					<tr>
						<td class="fix_table"><input type="text" name="jet_type" required></td>
					</tr>
				</table>
				<br>
				<table cellpadding="5" style="margin-left: 20%;">
					<tr>
						<td class="fix_table">Enter the total capacity of the Aircraft</td>
					</tr>
					<tr>
						<td class="fix_table"><input type="number" name="jet_capacity" required></td>
					</tr>
				</table>
				<br>
				<br>
				<input type="submit" value="Submit" name="Submit" style="margin: 0px 0px 0px 23%;width: 14%;padding: 5px 29px;">
				</div>
			</div>	
		</form>
	</body>
</html>