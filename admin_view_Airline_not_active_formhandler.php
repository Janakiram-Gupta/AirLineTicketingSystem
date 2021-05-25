 <?php
	session_start();
?>
<html>
	<head>
		<title>
			List of aircrafts that have not been in used from a specific source location
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
		<h2 style="margin-left: 21%;">List of aircrafts that have not been in used from a specific source location.
</h2>
		<div style="margin-left: 22%;">
		<?php			
			if (isset($_POST['find']))
			{
				
				$data_missing=array();
				if(empty($_POST['from_city']))
				{
					$data_missing[]='from_city';
				}
				else
				{
					$from_city=trim($_POST['from_city']);
				}
				
				if(empty($data_missing))
				{
					require_once('Database Connection file/mysqli_connect.php');
					$query="SELECT jet_type FROM jet_details WHERE active='No' AND jet_id IN(SELECT jet_id FROM flight_details WHERE from_city=?)";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"s",$from_city);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$jet_type);
					mysqli_stmt_store_result($stmt);
					if(mysqli_stmt_num_rows($stmt)==0)
					{
						echo "<h3>No Aircrafts are in active from selected location !</h3>";
					}
					else
					{
						echo "Total aircrafts that have not been in used from a source $from_city are below";
						echo "<br> <br> <table id=\"tblAircrafts\" cellpadding=\"10\"";
						echo "<tr><th>Aircraft</th>
						</tr>";
						while(mysqli_stmt_fetch($stmt)) {
							echo "<tr>
        						<td>".$jet_type."</td>
        					</tr>";
						}
						echo "</table> <br>";
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