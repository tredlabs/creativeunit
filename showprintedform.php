<?php


require 'db.php';
// this is for Printed form
  $show1=10;  
 $sql2 = "SELECT * FROM stocks WHERE field_id='". $show1. "'AND name='Lime'";
 //$sql = "SELECT * FROM stocks";
$result2 = $mysqli->query($sql2);
if(mysqli_num_rows($result2) > 0)  
 {

	$totalsheet1=0;
	$totalsheet2=0;
	$name1="";
	
     while($row = mysqli_fetch_assoc($result2)) {
       

		 $totalsheet1+=$row["sheet1"];
		 $totalsheet2+=$row["sheet2"];
	$name1=$row["name"];
		
	echo  $totalsheet1;
	echo "<br>";
 echo $name1;
 // echo "<br>";
 
 }
 } 
	
	echo "<br>";
	echo  $totalsheet1;
		echo "<br>";
		echo  $totalsheet2;
	
 
 
 
 
 
 ?>