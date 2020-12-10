<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0))
{
  header('location:logout.php');
} 
else
{

  

  ?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Daily Expense Tracker - View Expense</title>
		  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/datepicker3.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	
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
				<li class="active">Savings</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">View Savings</h1>
			</div>
		</div><!--/.row-->
		
		
	
	
		<div class="row">
	<?php		
	$userid=$_SESSION['detsuid'];
		$berry=mysqli_query($con,"select * from tblcategory where CategType='savings' and UserId='$userid'");

while($rows=mysqli_fetch_array($berry))
{ ?>
		
			<div class="col-xs-6 col-md-3">
					
		<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
<?php

	//Savings displayed by categoriy
	$userid=$_SESSION['detsuid'];
	$tdate=date('Y-m-d');
	$categid=$rows['CategId'];
	$query=mysqli_query($con,"select sum(SavingsAmount) as savingscateg from tblsavings where CategId='$categid'");
	$result=mysqli_fetch_array($query);
	$sum_savings=$result['savingscateg'];
	$categname=$rows['CategName'];
	
	?> 

						<h4><?php echo "$categname";?></h4>
						<div class="easypiechart"  data-percent="<?php echo $sum_savings;?>" ><span class="percent"><font style="color:#30a5ff;"><?php if($sum_savings==""){
	echo "0";
} 
	
	else 
{
		echo $sum_savings;
}

	?> </font></span></div>
					</div>
				</div>
			</div>
			
				
			
<?php } ?>

			<div class="col-xs-6 col-md-3">
			
			</div>
			<div class="col-xs-6 col-md-3">
			
			</div>
		
		</div><!--/.row-->
			<div class="row">
			<div class="col-xs-6 col-md-3">
				

			</div>

		


		</div>
		
		<!--/.row-->
	</div>	<!--/.main-->
	<?php include_once('includes/footer.php');?>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>
<?php } ?>