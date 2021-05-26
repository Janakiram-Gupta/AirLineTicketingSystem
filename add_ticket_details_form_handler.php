<?php
	session_start();
?>
<html>
	<head>
		<title>Add Ticket Details</title>
	</head>
	<body>
		<?php
			$i=1;
			if(isset($_POST['Submit']))
			{
				$PNR_NO=rand(1000000,9999999);
				$date_of_res=date("Y-m-d");
				$flight_no=$_SESSION['flight_no'];
				$Journey_date=$_SESSION['Journey_date'];
				$class=$_SESSION['class'];
				$booking_status="PENDING";
				$no_of_pass=$_SESSION['no_of_pass'];
				$lounge_access=$_POST['lounge_access'];
				$priority_checkin=$_POST['priority_checkin'];
				$insurance=$_POST['insurance'];
				$total_no_of_meals=0;
				$_SESSION['PNR_NO']=$PNR_NO;

				$_SESSION['lounge_access']=$lounge_access;
				$_SESSION['priority_checkin']=$priority_checkin;
				$_SESSION['insurance']=$insurance;

				$payment_id=NULL;
				$customer_name=$_SESSION['login_user'];

				require_once('Database Connection file/mysqli_connect.php');

				if($_SESSION['class']=='economy')
				{	
					$query="SELECT price_economy FROM flight_det where flight_no=? and departure_date=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"ss",$flight_no,$Journey_date);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$ticket_price);
					mysqli_stmt_fetch($stmt);
				}
				else if($_SESSION['class']=='business')
				{
					$query="SELECT price_business FROM flight_det where flight_no=? and departure_date=?";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"ss",$flight_no,$Journey_date);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$ticket_price);
					mysqli_stmt_fetch($stmt);
				}
				mysqli_stmt_close($stmt);
				$ff_mileage=$ticket_price/10;

				$query="INSERT INTO Purchased_tickets (PNR_NO,date_of_reservation,flight_no,Journey_date,class,booking_status,no_of_passengers,lounge_access,priority_checkin,insurance,payment_id,customer_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmt=mysqli_prepare($dbc,$query);
				mysqli_stmt_bind_param($stmt,"ssssssisssss",$PNR_NO,$date_of_res,$flight_no,$Journey_date,$class,$booking_status,$no_of_pass,$lounge_access,$priority_checkin,$insurance,$payment_id,$customer_name);
				mysqli_stmt_execute($stmt);
				$affected_rows=mysqli_stmt_affected_rows($stmt);
				echo $affected_rows.'<br>';
				// mysqli_stmt_bind_result($stmt,$cnt);
				// mysqli_stmt_fetch($stmt);
				// echo $cnt;
				/*
				$response=@mysqli_query($dbc,$query);
				*/
				if($affected_rows==1)
				{
					echo "Successfully Submitted<br>";
				}
				else
				{
					echo "Submit Error";
					echo mysqli_error();
				}
				
				for($i=1;$i<=$no_of_pass;$i++)
				{
					echo "frequent_flier_no=".$_POST['pass_ff_id'][$i-1].'<br>';
					if($_POST['pass_ff_id'][$i-1]=='')
						$_POST['pass_ff_id'][$i-1]=NULL;
					else
					{
						$query="SELECT count(*) from Customer c, Frequent_Flier_Details f WHERE c.name=? and f.frequent_flier_no=? and c.customer_id=f.customer_id";
						$stmt=mysqli_prepare($dbc,$query);
						mysqli_stmt_bind_param($stmt,"ss",$_POST['pass_name'][$i-1],$_POST['pass_ff_id'][$i-1]);
						mysqli_stmt_execute($stmt);
						$affected_rows=mysqli_stmt_affected_rows($stmt);
						mysqli_stmt_bind_result($stmt,$cnt);
						mysqli_stmt_fetch($stmt);
						echo "cnt=".$cnt."<br>";
						mysqli_stmt_close($stmt);
						
						if($cnt==1)
						{
							$query="UPDATE Frequent_Flier_Details SET mileage=mileage+? where frequent_flier_no=?";
							$stmt=mysqli_prepare($dbc,$query);
							mysqli_stmt_bind_param($stmt,"is",$ff_mileage,$_POST['pass_ff_id'][$i-1]);
							mysqli_stmt_execute($stmt);
							$affected_rows=mysqli_stmt_affected_rows($stmt);
							echo $affected_rows.'<br>';
							mysqli_stmt_close($stmt);
						}
					}
					$query="INSERT INTO passengers_det (passenger_id,PNR_NO,name,age,gender,meal_choice,frequent_flier_no) VALUES (?,?,?,?,?,?,?)";
					$stmt=mysqli_prepare($dbc,$query);

					if($_POST['pass_meal'][$i-1]=='yes')
						$total_no_of_meals++;
					mysqli_stmt_bind_param($stmt,"ississs",$i,$PNR_NO,$_POST['pass_name'][$i-1],$_POST['pass_age'][$i-1],$_POST['pass_gender'][$i-1],$_POST['pass_meal'][$i-1],$_POST['pass_ff_id'][$i-1]);
					mysqli_stmt_execute($stmt);
					$affected_rows=mysqli_stmt_affected_rows($stmt);
					echo 'Passenger added '.$affected_rows.'<br>';
					// mysqli_stmt_bind_result($stmt,$cnt);
					// mysqli_stmt_fetch($stmt);
					// echo $cnt;
				}
				$_SESSION['total_no_of_meals']=$total_no_of_meals;
				mysqli_stmt_close($stmt);
				mysqli_close($dbc);

				header("location: payment_det.php");

// 						else
// 						{
// 							echo "Submit Error";
// 							echo mysqli_error();
// 						}
// 					}
// 					else
// 					{
// 						echo "The following data fields were empty! <br>";
// 						foreach($data_missing as $missing)
// 						{
// 							echo $missing ."<br>";
// 						}
// 					}
// 				}
			}
			else
			{
				echo "Submit request not received";
			}
		?>
	</body>
</html>