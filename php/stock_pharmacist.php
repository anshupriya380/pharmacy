<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['pharmacist_id'];
$user=$_SESSION['username'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."index.php");
exit();
}
if(isset($_POST['submit'])){
$sname=$_POST['drug_name'];
$cat=$_POST['category'];
$des=$_POST['description'];
$com=$_POST['company'];
$sup=$_POST['supplier'];
$qua=$_POST['quantity'];
$cost=$_POST['cost'];
$sta="Available";

$sql=mysqli_query($conn, "INSERT INTO stock(drug_name,category,description,company,supplier,quantity,cost,status,date_supplied)
VALUES('$sname','$cat','$des','$com','$sup','$qua','$cost','$sta',NOW())");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/stock_pharmacist.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> - Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" type="text/css" href="style/home.css">
    <link rel="stylesheet" type="text/css" href="style/form.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<link rel="stylesheet" href="style/table1.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>

</head>
<body>
<body>

	<div style="width: 100%;display: flex;flex-direction: column;">
    <div class="div1">

        <div class="bnr" style="margin-top: 0px">
            <img src="images/logo.png" width="67px" height="" />
        </div>

        <div class="bnr" style="margin-left: 100px">
            HOSPITAL PHARMACY MANAGEMENT SYSTEM
        </div>
	    <?php 
		include('connect_db.php');
		$qury=mysqli_query($conn, "SELECT * from stock where status='low'") or die(mysqli_error());
		$ros=mysqli_num_rows($qury);
		if($ros>0){
			?>
		 <div class="bnr" style="margin-top: 17px;margin-left: 0px">
		 	<img src="images/red.png" class="imgc">: Low stock</div>
		<?php
		}else{
			?>
		<div class="bnr" style="margin-top: 17px">
			<img src="images/green.png" class="imgc">: Enough stock
		</div>
		<?php	
		}
		?>
     <div class="bnr" style="margin-top: 17px">
            <a href="logout.php">
                <button class="lout" style="vertical-align:middle;">
                <div style=" display: flex; justify-content: space-between;">
                <img src="images/user.png" style="width: 25px">
                <div style="padding:5px;color: #000000;">
                    <b>Logout</b>
                </div>
                </div>
                </button>
            </a>
        </div>
    </div>
<div style="width: 100%;display: flex;">

        <div>
            <a href="pharmacist.php" style="text-decoration:none;"><button class="button">Home</button></a>
            <a href="prescription.php" style="text-decoration:none;"><button class="button">Prescription</button></a>
            <a href="stock_pharmacist.php" style="text-decoration:none;"><button class="button">Stock</button></a>
        </div>
<div class="content" style="margin-left:235px;width: 700px;">
			<div div style="width: 100%;display: flex;flex-direction: column;">  
		    <h2 style="padding-bottom: 0px;margin-bottom: 0px;margin-top: 0px">Manage Stock</h2> 
			<hr style="background-color: black;width: 100%;height: 3px;" align="left">	
			</div>
		    <div style="margin-top: 15px;"> 
        
          
        <div id="content_1" style="margin-top: 15px">  
		 <?php echo $message;
			  echo $message1;
			  ?>
      
		<?php
		/* 
		View
        Displays all data from 'Stock' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysqli_query($conn, "SELECT * FROM stock") 
                or die(mysqli_error());
		// display data in table
        echo "<table border='0' cellpadding='3' class='tab'>";
         echo "<tr><th>ID</th><th>Name</th><th>Avalable stock</th><th>Description</th><th>Status </th><th>Delete</th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                 echo '<td>' . $row['stock_id'] . '</td>';               
                echo '<td>' . $row['drug_name'] . '</td>';
				echo '<td>' . $row['quantity'] ." ". $row['category'] . '</td>';
				echo '<td>' . $row['description'] . '</td>';
				echo '<td>' . $row['status'] . '</td>';
			?>
				<td><a href="deletestock1.php?id=<?php echo $row['stock_id']?>"><img src="images/delete-icon.jpg" width="24" height="24" border="0" /></a></td>
				<?php
		 } 
        // close table>
        echo "</table>";
?> 
        </div>  
        
              
    </div>  
  
</div>
 
</div>
<div style="background-color: #231F20; font-size: 17px;padding: 6px; margin-top: 170px">
            <p style="float: left; padding-left: 30px;color: #ffffff; margin: 5px">&copy; 2022 Pharmacy. All Rights Reserved</p>
            <p style="float: right; padding-right: 30px;color: #ffffff; margin: 5px;"> Designed By : Arisha & Anshu </p>
 </div>
</div>
</body>
</html>
