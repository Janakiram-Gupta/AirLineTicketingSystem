 <?php
	session_start();
?>
<html>
	<head>
		<title>
			Total number of aircrafts belonging to a specific airline
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
		
		<script type="text/javascript">
			setTimeout(function(){
				var totalRowCount = 0;
				var rowCount = 0;
				var table = document.getElementById("tblAircrafts");
				var rows = table.getElementsByTagName("tr")
				for (var i = 0; i < rows.length; i++) {
					totalRowCount++;
					if (rows[i].getElementsByTagName("td").length > 0) {
						rowCount++;
					}
				}
				document.getElementById("aircrafts_count").innerHTML = totalRowCount - 1; 
			}, 500);
		</script>
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
		<h2 style="margin-left: 21%;">Total number of aircrafts belonging to a specific airline</h2>
		<div style="margin-left: 22%;">
		<?php			
			if (isset($_POST['Find']))
			{
				
				$data_missing=array();
				if(empty($_POST['jet_type']))
				{
					$data_missing[]='jet_type';
				}
				else
				{
					$jet_type=trim($_POST['jet_type']);
				}

				if(empty($data_missing))
				{
					require_once('Database Connection file/mysqli_connect.php');
					$query="SELECT jet_id,jet_type,total_capacity,active FROM jet_details WHERE jet_type=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"s",$jet_type);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$jet_id,$jet_type,$total_capacity,$active);
					mysqli_stmt_store_result($stmt);
					if(mysqli_stmt_num_rows($stmt)==0)
					{
						echo "<h3>No aircrafts are available belonging to $jet_type airline!</h3>";
					}
					else
					{	
						echo "Total number of aircrafts belonging to $jet_type airline is <h4 id='aircrafts_count'></h4>";
						echo "<table id=\"tblAircrafts\" cellpadding=\"10\"";
						echo "<tr><th>Aircraft ID</th>
						<th>Aircraft Type</th>
						<th>Total capacity</th>
						<th>Active</th>
						</tr>";
						while(mysqli_stmt_fetch($stmt)) {
								echo "<tr>
        						<td>".$jet_id."</td>
        						<td>".$jet_type."</td>
								<td>".$total_capacity."</td>
								<td>".$active."</td>
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