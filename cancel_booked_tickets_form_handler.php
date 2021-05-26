<?php
	session_start();
?>
<html>
	<head>
		<title>
			Cancel Booked Tickets
		</title>
	</head>
	<body>
		<?php
			if(isset($_POST['Cancel_Ticket']))
			{
				$data_missing=array();
				if(empty($_POST['PNR_NO']))
				{
					$data_missing[]='PNR_NO';
				}
				else
				{
					$PNR_NO=trim($_POST['PNR_NO']);
				}

				if(empty($data_missing))
				{
					require_once('Database Connection file/mysqli_connect.php');

					$todays_date=date('Y-m-d'); 
					$customer_name=$_SESSION['login_user'];

					$query="SELECT count(*) from Purchased_tickets t WHERE PNR_NO=? and Journey_date>=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"ss",$PNR_NO,$todays_date);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$cnt);
					mysqli_stmt_fetch($stmt);
					mysqli_stmt_close($stmt);
					if($cnt!=1)
					{
						mysqli_close($dbc);
						header("location: cancel_booked_tickets.php?msg=failed");
					}
					$query="UPDATE Purchased_tickets SET booking_status='CANCELED' WHERE PNR_NO=? and customer_name=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"ss",$PNR_NO,$customer_name);
					mysqli_stmt_execute($stmt);
					$affected_rows=mysqli_stmt_affected_rows($stmt);
					//echo $affected_rows."<br>";
					// mysqli_stmt_bind_result($stmt,$cnt);
					// mysqli_stmt_fetch($stmt);
					// echo $cnt;
					mysqli_stmt_close($stmt);
					if($affected_rows==1)
					{
						$query="SELECT t.flight_no,t.Journey_date,t.no_of_passengers,t.class,0.85*p.payment_amount as refund_amount from Purchased_tickets t,payment_det p WHERE t.PNR_NO=? and t.PNR_NO=p.PNR_NO";
						$stmt=mysqli_prepare($dbc,$query);
						mysqli_stmt_bind_param($stmt,"s",$PNR_NO);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_bind_result($stmt,$flight_no,$Journey_date,$no_of_pass,$class,$refund_amount);
						mysqli_stmt_fetch($stmt);
						mysqli_stmt_close($stmt);
						$_SESSION['refund_amount']=$refund_amount;
						if($class=='economy')
						{
							$query="UPDATE flight_det SET seats_economy=seats_economy+? WHERE flight_no=? AND departure_date=?";
							$stmt=mysqli_prepare($dbc,$query);
							mysqli_stmt_bind_param($stmt,"iss",$no_of_pass,$flight_no,$Journey_date);
							mysqli_stmt_execute($stmt);
							$affected_rows_1=mysqli_stmt_affected_rows($stmt);
							echo $affected_rows_1.'<br>';
							mysqli_stmt_close($stmt);
						}
						else if($class=='business')
						{
							$query="UPDATE flight_det SET seats_business=seats_business+? WHERE flight_no=? AND departure_date=?";
							$stmt=mysqli_prepare($dbc,$query);
							mysqli_stmt_bind_param($stmt,"iss",$no_of_pass,$flight_no,$Journey_date);
							mysqli_stmt_execute($stmt);
							$affected_rows_1=mysqli_stmt_affected_rows($stmt);
							echo $affected_rows_1.'<br>';
							mysqli_stmt_close($stmt);
						}
						if($affected_rows_1==1)
						{

							header("location: cancel_booked_tickets_success.php");
						}
						else
						{
							echo "Submit Error";
							echo mysqli_error();
						}
					}
					else
					{
						echo "Submit Error";
						echo mysqli_error();
						header("location: cancel_booked_tickets.php?msg=failed");
					}
					mysqli_close($dbc);
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
			else
			{
				echo "Cancel request not received";
			}
		?>
	</body>
</html>