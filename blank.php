<?php


require 'db.php';

 $show=5;  
 $sql = "SELECT * FROM Warehouse1 WHERE field_id='$show'";
 //$sql = "SELECT * FROM stocks";
$result = $mysqli->query($sql);
if(mysqli_num_rows($result) > 0)  
 {
 $a=0;
    while($row = mysqli_fetch_assoc($result)) {
       
		 $instock[$a]=$row["instock"];
		 
		 $item[$a]=$row["name"];
		
	$size[$a]=$row["size"];
	

 $a++;
 // echo "<br>";
 
 }
 } 
 
  $show=6;  
 $sql = "SELECT * FROM Warehouse1 WHERE field_id='$show'";
 //$sql = "SELECT * FROM stocks";
$result = $mysqli->query($sql);
if(mysqli_num_rows($result) > 0)  
 {
 $a=0;
    while($row = mysqli_fetch_assoc($result)) {
       
		 $envinstock[$a]=$row["instock"];
		 
		 $envitem[$a]=$row["name"];
		
	
	

 $a++;
 // echo "<br>";
 
 }
 } 
 
 
 
   // this is for Paper

 
 
 
 
 ?>