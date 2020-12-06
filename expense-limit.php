<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
	 //form method variables
  	$userid=$_SESSION['detsuid'];
	$limit=$_POST['limit'];
	//updating the limit
	$query=mysqli_query($con,"update tblbalance SET BalanceLimit='$limit' where UserId='$userid'");
		
		
	

		if ($query)
		{
			echo "<script>alert('Limit has been confirmed');</script>";
			echo "<script>window.location.href='manage-expense.php'</script>";
		}
		else 
		{
		
			echo "<script>alert('Something went wrong. Please try again');</script>";
		

		}
	
	
	
  
}
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Add Expense</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!-- <script>   
	 function addcategory() {   
	window.open("addcategory.php");  
	}   
	</script>   -->
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Expense</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Expense Limit</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							<h5> The expense limit determines the minimum  amount that must be there in the User's Balance in order for the user to add expenses. This limit can be changed according to user requirments.</h5> <br><br>
							<form role="form" method="post" action="">
								
								<?php
								$userid=$_SESSION['detsuid'];
								$berry=mysqli_query($con,"select * from tblbalance where UserId='$userid'");
								$row=mysqli_fetch_array($berry);
								$limit=$row['BalanceLimit'];
								?>
								
								<div class="form-group">
									<label>Expense Limit</label>
									<input class="form-control" type="text" value="<?php echo "$limit";?>" required="true" name="limit">
								</div>
								
								
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Confirm Limit</button>
								</div>
								
								
								</div>
								
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
<?php }  ?>