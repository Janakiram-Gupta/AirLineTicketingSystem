<?php
	session_start();
?>
<html>
	<head>
		<title>
			Welcome Administrator
		</title>
		<style>
			td a {
				font-weight: bold;
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
				<li style="margin-left: 31%;"><a href="admin_homepage.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li><a href="admin_homepage.php"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a></li>
				<li><a href="logout_handler.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
			</ul>
		</div>
		<div style="margin-left: 25%;">
			<h2>Welcome Administrator!</h2>
			<table cellpadding="5">
				
				<tr>
					<td class="admin_func"><a href="admin_view_booked_tickets.php"><i class="fa fa-plane" aria-hidden="true"></i> View List of Booked Tickets for a Flight</a>
					</td>
				</tr>
				
				<tr>
					<td class="admin_func"><a href="admin_total_hours_aircraft_served_timeinterval.php"><i class="fa fa-plane" aria-hidden="true"></i> Total hours that a specific aircraft has served during a specific time interval</a>
					</td>
				</tr>
				
				<tr>
					<td class="admin_func"><a href="admin_view_aircrafts_specific_airline.php"><i class="fa fa-plane" aria-hidden="true"></i>  Total number of aircrafts belonging to a specific airline </a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="admin_view_specific_time_travelled.php"><i class="fa fa-plane" aria-hidden="true"></i>  Total number of hours that a specific passenger has travelled during a specific time interval </a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="admin_total_hours_airline_served_timeinterval.php"><i class="fa fa-plane" aria-hidden="true"></i>  Total number of hours that a specific airline has been running during a specific time interval</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="admin_total_passengers_tocity_timeinterval.php"><i class="fa fa-plane" aria-hidden="true"></i>  List of all Passengers who flew to a specific city during a specific time interval</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="admin_most_visited_city_lastmonth.php"><i class="fa fa-plane" aria-hidden="true"></i>  Most visited city during the last month</a>
					</td>
				</tr>
				
				<tr>
					<td class="admin_func"><a href="admin_view_Airline_not_active.php"><i class="fa fa-plane" aria-hidden="true"></i>  List of aircrafts that have not been in used from a specific source location.</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="admin_view_Airline_specific.php"><i class="fa fa-plane" aria-hidden="true"></i>  List of airlines that run flight from a specific source to a destination</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="add_flight_details.php"><i class="fa fa-plane" aria-hidden="true"></i> Add Flight Schedule Details</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="delete_flight_details.php"><i class="fa fa-plane" aria-hidden="true"></i> Delete Flight Schedule Details</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="add_jet_details.php"><i class="fa fa-plane" aria-hidden="true"></i> Add Aircrafts Details</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="activate_jet_details.php"><i class="fa fa-plane" aria-hidden="true"></i> Activate Aircraft</a>
					</td>
				</tr>
				<tr>
					<td class="admin_func"><a href="deactivate_jet_details.php"><i class="fa fa-plane" aria-hidden="true"></i> Deactivate Aircraft</a>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>