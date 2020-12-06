<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Income Tracker - View Income</title>
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
				<li class="active">Income</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">View Income</h1>
			</div>
		</div><!--/.row-->
		
		
		
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
<?php
//Today Income
$userid=$_SESSION['detsuid'];
$tdate=date('Y-m-d');
$query=mysqli_query($con,"select sum(IncomeCost)  as todaysincome from tblincome where (IncomeDate)='$tdate' && (UserId='$userid');");
$result=mysqli_fetch_array($query);
$sum_today_income=$result['todaysincome'];
 ?> 

						<h4>Today's Income</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $sum_today_income;?>" ><span class="percent"><?php if($sum_today_income==""){
echo "0";
} else {
echo $sum_today_income;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yestreday Income
$userid=$_SESSION['detsuid'];
$ydate=date('Y-m-d',strtotime("-1 days"));
$query1=mysqli_query($con,"select sum(IncomeCost)  as yesterdayincome from tblincome where (IncomeDate)='$ydate' && (UserId='$userid');");
$result1=mysqli_fetch_array($query1);
$sum_yesterday_income=$result1['yesterdayincome'];
 ?> 
					<div class="panel-body easypiechart-panel">
						<h4>Yesterday's Income</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_yesterday_income;?>" ><span class="percent"><?php if($sum_yesterday_income==""){
echo "0";
} else {
echo $sum_yesterday_income;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Weekly Income
$userid=$_SESSION['detsuid'];
 $pastdate=  date("Y-m-d", strtotime("-1 week")); 
$crrntdte=date("Y-m-d");
$query2=mysqli_query($con,"select sum(IncomeCost)  as weeklyIncome from tblincome where ((IncomeDate) between '$pastdate' and '$crrntdte') && (UserId='$userid');");
$result2=mysqli_fetch_array($query2);
$sum_weekly_Income=$result2['weeklyIncome'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 7day's Income</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $sum_weekly_Income;?>"><span class="percent"><?php if($sum_weekly_Income==""){
echo "0";
} else {
echo $sum_weekly_Income;
}

	?></span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Monthly Income
$userid=$_SESSION['detsuid'];
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query3=mysqli_query($con,"select sum(IncomeCost)  as monthlyIncome from tblincome where ((IncomeDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
$result3=mysqli_fetch_array($query3);
$sum_monthly_Income=$result3['monthlyIncome'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Last 30day's Incomes</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_monthly_Income;?>" ><span class="percent"><?php if($sum_monthly_Income==""){
echo "0";
} else {
echo $sum_monthly_Income;
}

	?></span></div>
					</div>
				</div>
			</div>
		
		</div><!--/.row-->
			<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Yearly Income
$userid=$_SESSION['detsuid'];
 $cyear= date("Y");
$query4=mysqli_query($con,"select sum(IncomeCost)  as yearlyIncome from tblincome where (year(IncomeDate)='$cyear') && (UserId='$userid');");
$result4=mysqli_fetch_array($query4);
$sum_yearly_Income=$result4['yearlyIncome'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Current Year Incomes</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_yearly_Income;?>" ><span class="percent"><?php if($sum_yearly_Income==""){
echo "0";
} else {
echo $sum_yearly_Income;
}

	?></span></div>


					</div>
				
				</div>

			</div>

		<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<?php
//Total Income
$userid=$_SESSION['detsuid'];
$query5=mysqli_query($con,"select sum(IncomeCost)  as totalIncome from tblincome where UserId='$userid';");
$result5=mysqli_fetch_array($query5);
$sum_total_Income=$result5['totalIncome'];
 ?>
					<div class="panel-body easypiechart-panel">
						<h4>Total Incomes</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_total_Income;?>" ><span class="percent"><?php if($sum_total_Income==""){
echo "0";
} else {
echo $sum_total_Income;
}

	?></span></div>


					</div>
				
				</div>

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