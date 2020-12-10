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
    $dateincome=$_POST['dateincome'];
    $costitem=$_POST['costitem'];
	$note=$_POST['note'];
	$item=$_POST['category'];
	
	//query to obtain balance
	$bet=mysqli_query($con,"select * from tblbalance where UserId='$userid'");
	$row1=mysqli_fetch_array($bet);
	$balance=$row1['BalanceAmount'];
	
	//updatig balance amount
			$updateamount=$balance+$costitem;
			
			
		//query to fetch category name 
		$ret=mysqli_query($con,"select * from tblcategory where CategName='$item'");
		$row=mysqli_fetch_array($ret);	
		$categid=$row['CategId'];
	
		//updating the balance 
		$det=mysqli_query($con,"update tblbalance SET BalanceAmount='$updateamount' where UserId='$userid'");
		
		//income insertion query
		$query=mysqli_query($con,"insert into tblincome(UserId,IncomeDate,IncomeCost,IncomeNote,CategId) value('$userid','$dateincome','$costitem','$note','$categid')");
	

		if ($query && $det)
		{
			echo "<script>alert('Income has been added');</script>";
			echo "<script>window.location.href='manage-income.php'</script>";
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
	<title>Daily Expense Tracker || Add Income</title>
	  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
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
				<li class="active">Income</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Income</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Date of Income</label>
									<input class="form-control" type="date" value="" name="dateincome" required="true">
								</div>
								<div class="form-group">
									<label>Category</label>
									<!-- <input type="text" class="form-control" name="item" value="" required="true"> -->
									<select class="form-control" name="category" value="" required="true">
										 <option value="" disabled selected>Select Category</option>
										 <?php
										 $userid=$_SESSION['detsuid'];
										 $ret=mysqli_query($con,"select CategName from tblcategory where UserId='$userid' and CategType='income'");
										 while ($rows=mysqli_fetch_array($ret))
										 {
											$name=$rows['CategName'];
											echo "<option value='$name'>$name</option>";										  
										 
										  } ?>
										
									</select>
									<div class="form-group has-success">
									<p align="right">
									<br>
									<a href="addcategoryi.php" class="btn btn-primary">Add Catgeory</a></span>
									
									</p>
									</div>
									
								</div>
								
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="text" value="" required="true" name="costitem">
								</div>
								
								<div class="form-group">
									<label>Note</label>
									<textarea class="form-control" value="" name="note" rows=4 cols=7>
									
									</textarea>
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Add</button>
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