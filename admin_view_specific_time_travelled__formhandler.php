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
		<h2 style="margin-left: 21%;">Total number of hours that a specific passenger has travelled during a specific time interval</h2>
		<div style="margin-left: 22%;">
		<?php			
			if (isset($_POST['Find']))
			{
				
				$data_missing=array();
				if(empty($_POST['customer_name']))
				{
					$data_missing[]='customer_name No.';
				}
				else
				{
					$customer_name=trim($_POST['customer_name']);
				}
				if(empty($_POST['from_date']))
				{
					$data_missing[]='from_date ';
				}
				else
				{
					$from_date=$_POST['from_date'];
				}
				if(empty($_POST['to_date']))
				{
					$data_missing[]='to_date ';
				}
				else
				{
					$to_date=$_POST['to_date'];
				}

				if(empty($data_missing))
				{
					require_once('Database Connection file/mysqli_connect.php');
					$query="select sum(journey_time) as total_hours from flight_det where flight_no in( select flight_no from Purchased_tickets where customer_name = ? and Journey_date between CAST(? AS DATE) AND CAST(? AS DATE))";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"sss",$customer_name,$from_date,$to_date);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$total_hours);
					mysqli_stmt_store_result($stmt);
					if(mysqli_stmt_num_rows($stmt)==0)
					{
						echo "<h3>No booked tickets information is available!</h3>";
					}
					else
					{
						while(mysqli_stmt_fetch($stmt)) {
						echo "Total hours of journey is <h4>$total_hours</h4>";
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