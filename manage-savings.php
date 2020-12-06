  <?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

// category deletion 
if(isset($_GET['delcateg']))
{
	$userid=$_SESSION['detsuid'];
	$categid=intval($_GET['delcateg']);

	$serry=mysqli_query($con,"delete from tblsavings where CategId='$categid'");
	$berry=mysqli_query($con,"delete from tblcategory where CategId='$categid'");
	
	
	if($berry)
	{
	echo "<script>alert('Catrgory successfully deleted');</script>";
	echo "<script>window.location.href='manage-savings.php'</script>";
	}
	else
		{
			echo "<script>alert('Something went wrong. Please try again');</script>";

	}
	
}


//code deletion
if(isset($_GET['delid']))
{
$userid=$_SESSION['detsuid'];
$rowid=intval($_GET['delid']);
//echo "<script>alert($rowid);</script>";


//storing expense cost
$queryf=mysqli_query($con,"select * from tblsavings where SavingsId='$rowid'");
$row=mysqli_fetch_array($queryf);
$cost=$row['SavingsAmount'];

//balance amount storing 

$querys=mysqli_query($con,"select * from  tblbalance where UserId='$userid'");
$roww=mysqli_fetch_array($querys);
$amount=$roww['BalanceAmount'];
$update=$amount+$cost;


//updating balance amount
$queryl=mysqli_query($con,"update tblbalance set BalanceAmount='$update' where UserId='$userid'");

// deleting income details 
$query=mysqli_query($con,"delete from tblsavings where SavingsId='$rowid'");

if($query){
echo "<script>alert('Record successfully deleted');</script>";
echo "<script>window.location.href='manage-savings.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Manage Savings</title>
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
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Savings</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							
							<div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Savings Item</th>
                  <th>Savings Cost</th>
                  <th>Savings Date</th>
				  <th>Notes</th>
                  <th>Action</th>
				  
                </tr>
              </thead>
              <?php
              $userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"select * from tblsavings where UserId='$userid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

$categid=$row['CategId'];
 $query=mysqli_query($con,"select * from tblcategory where CategId='$categid'");
 $roww=mysqli_fetch_array($query);

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $roww['CategName'];?></td>
                  <td><?php  echo $row['SavingsAmount'];?></td>
                  <td><?php  echo $row['SavingsDate'];?></td>
				  <td><?php  echo $row['SavingsNote'];?></td>
                  <td><a href="manage-savings.php?delid=<?php echo $row['SavingsId'];?>">Cancel Savings</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
               
              </tbody>
            </table>
          </div>
		  
						</div>
						
					</div>
					<div class="panel-heading">Manage Category</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							
							<div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Savings Category</th>
                  <th>Action</th>
                  
				  
                </tr>
              </thead>
              <?php
              $userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"select distinct CategId from tblsavings where UserId='$userid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

$categid=$row['CategId'];
 $query=mysqli_query($con,"select CategName from tblcategory where CategId='$categid'");
 $roww=mysqli_fetch_array($query);

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $roww['CategName'];?></td>
                  
                  <td><a href="manage-savings.php?delcateg=<?php echo $row['CategId'];?>">Delete Category</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
               
              </tbody>
            </table>
          </div>
		  
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