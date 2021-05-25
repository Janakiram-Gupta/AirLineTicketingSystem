 <?php
	session_start();
?>
<html>
	<head>
		<title>
			Most visited city during the last month
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
    			margin: 0px 390px
			}
			table {
			 border-collapse: collapse; 
			}
			tr/*:nth-child(3)*/ {
			 border: solid thin;
			}
			
			h3 {
				margin-left: 30%;	
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
		<h2 style="margin-left: 28%;">Most visited city during the last month.</h2>
		<div>
		<?php
			
			if (isset($_POST['find']))
			{
				
				$data_missing=array();
				
				if(empty($data_missing))
				{
					require_once('Database Connection file/mysqli_connect.php');
					$query="select count(f.to_city) as top_city, f.to_city as cityName from flight_details f join ticket_details t on f.flight_no = t.flight_no WHERE t.journey_date <= date(DATE_SUB('2021-06-28', INTERVAL 1 MONTH)) GROUP by f.to_city ORDER by top_city desc LIMIT 1;";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$top_city,$cityName);
					mysqli_stmt_store_result($stmt);
					if(mysqli_stmt_num_rows($stmt)==0)
					{
						echo "<h3>No city has been most visited during the last month !</h3>";
					}
					else
					{
						while(mysqli_stmt_fetch($stmt)) {
							echo "<h4 style='margin-left: 29%;'>Most visited city is $cityName</h4>";
						}
    				}
					mysqli_stmt_close($stmt);
					mysqli_close($dbc);
					// else
					// {
					// 	echo "Submit Error";
					// 	echo mysqli_error();
					// }
				}
				else
				{
					echo "The following data fields were empty! <br>";
					foreach($data_missing as $missing)
					{
						echo $missing ."<br>";
					}
				}
				
			}
			else{
				echo "No data found";
			}
			//echo "Submit request not received";
		?>
		</div>
	</body>
</html>