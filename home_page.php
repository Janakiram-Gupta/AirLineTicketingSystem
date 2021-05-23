<?php
	session_start();
?>
<html>
	<head>
		<title>
			Welcome to Threya Airlines
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
    			margin: 0px 127px
			}
			input[type=date] {
				border: 1.5px solid #030337;
    			border-radius: 4px;
    			padding: 5.5px 44.5px;
			}
			select {
    			border: 1.5px solid #030337;
    			border-radius: 4px;
    			padding: 6.5px 75.5px;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
	</head>
	<body style='background-image: url("images/shutterstock_1.jpg");background-repeat: no-repeat, repeat;background-color: #cccccc;'>
		<div style="margin-left: 25%;">
			<img class="logo" src="images/shutterstock_22.png"/> 
			<h1 id="title">
				Threya Airlines
			</h1>
		</div>
		<div>
			<ul>
				<li style="margin-left: 32%;"><a href="home_page.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li>
					<?php
						if(isset($_SESSION['login_user'])&&$_SESSION['user_type']=='Customer')
						{
							echo "<a href=\"book_tickets.php\"><i class=\"fa fa-ticket\" aria-hidden=\"true\"></i> Book Tickets</a>";
						}
						else if(isset($_SESSION['login_user'])&&$_SESSION['user_type']=='Administrator')
						{
							echo "<a href=\"admin_ticket_message.php\"><i class=\"fa fa-ticket\" aria-hidden=\"true\"></i> Book Tickets</a>";
						}
						else
						{
							echo "<a href=\"login_page.php\"><i class=\"fa fa-ticket\" aria-hidden=\"true\"></i> Book Tickets</a>";
						}
					?>
				</li>
				<li>
					<?php
						if(isset($_SESSION['login_user'])&&$_SESSION['user_type']=='Customer')
						{
							echo "<a href=\"customer_homepage.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</a>";
						}
						else if(isset($_SESSION['login_user'])&&$_SESSION['user_type']=='Administrator')
						{
							echo "<a href=\"admin_homepage.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</a>";
						}
						else
						{
							echo "<a href=\"login_page.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i> Login</a>";
						}
					?>
				</li>
			</ul>
		</div>
		<div style="margin-left: 26%; margin-top: 2%;width: 38%;border: 5px solid #0077c8;padding: 20px;border-radius: 25px;">
			<form action="view_flights_form_handler1.php" method="post">
				<table cellpadding="5">
					<tr>
						<td class="fix_table">Departure airport</td>
						<td class="fix_table">Arrival airport</td>
					</tr>
					<tr>
						<td class="fix_table">
							<input list="origins" name="origin" placeholder="From" required>
							<datalist id="origins">
								<option value="bangalore">
							</datalist>
							<!-- <input type="text" name="origin" placeholder="From" required> --></td>
						<td class="fix_table">
							<input list="destinations" name="destination" placeholder="To" required>
							<datalist id="destinations">
								<option value="mumbai">
								<option value="mysore">
								<option value="mangalore">
								<option value="chennai">
								<option value="hyderabad">
							</datalist>
							<!-- <input type="text" name="destination" placeholder="To" required> --></td>
					</tr>
				</table>
				<br>
				<table cellpadding="5">
					<tr>
						<td class="fix_table">Enter the Departure Date</td>
						<td class="fix_table">Enter the No. of Passengers</td>
					</tr>
					<tr>
						<td class="fix_table"><input type="date" name="dep_date" min=
							<?php 
								$todays_date=date('Y-m-d'); 
								echo $todays_date;
							?> 
							max=
							<?php 
								$max_date=date_create(date('Y-m-d'));
								date_add($max_date,date_interval_create_from_date_string("90 days")); 
								echo date_format($max_date,"Y-m-d");
							?> required></td>
						<td class="fix_table"><input type="number" name="no_of_pass" placeholder="Eg. 5" required></td>
					</tr>
				</table>
				<br>
				<table cellpadding="5">
					<tr>
						<td class="fix_table">Enter the Class</td>
					</tr>
					<tr>
						<td class="fix_table">
							<select name="class">
								<option value="economy">Economy</option>
								<option value="business">Business</option>
							</select>
						</td>
					</tr>
				</table>
				<br>
				<input type="submit" value="Search for Available Flights" name="Search">
			</form>	
		</div>
		<!--check out addling local host in links and other places

			shift login/logout buttons to right side
		-->
	</body>
</html>