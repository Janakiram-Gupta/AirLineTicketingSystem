<?php
	session_start();
?>
<html>
	<head>
		<title>
			Cancel Booked Tickets
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
    			margin: 0px 68px
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
				<li style="margin-left: 31%;"><a href="customer_homepage.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li><a href="customer_homepage.php"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a></li>
				<li><a href="logout_handler.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
			</ul>
		</div>
		<div style="margin-left: 30%;">
			<form action="cancel_booked_tickets_form_handler.php" method="post">
				<h2>CANCEL BOOKED TICKETS</h2>
				<?php
					if(isset($_GET['msg']) && $_GET['msg']=='failed')
					{
						echo "<strong style='color: red'>*Invalid PNR, please enter PNR again</strong>
							<br>
							<br>";
					}
				?>
				<table cellpadding="5" style="margin-left: 15%;">
					<tr>
						<td class="fix_table">Enter the PNR</td>
					</tr>
					<tr>
						<td class="fix_table"><input type="text" name="pnr" required></td>
					</tr>
				</table>
				<br>
				<input type="submit" value="Cancel Ticket" name="Cancel_Ticket" style="margin: 0px 0px 0px 19%;width: 14%;padding: 5px 29px;">
			</form>
		</div>
		<!--Following data fields were empty!
			...
			ADD VIEW FLIGHT DETAILS AND VIEW JETS/ASSETS DETAILS for ADMIN
			PREDEFINED LOCATION WHEN BOOKING TICKETS
		-->
	</body>
</html>