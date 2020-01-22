<?php
require 'db.php';

$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name =  "ssjlinve_inventorysystem";




	$sql = "SELECT usages.*,usage_lineitems.*,stocks.name
			    FROM usages
			    INNER JOIN usage_lineitems
			    ON usages.id=usage_lineitems.usage_id LEFT JOIN stocks ON usage_lineitems.stock_id=stocks.id 
			   ";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Gavin Palmer || March 2016
	
	
	//If the individual is searching for specific vendors  -Gavin Palmer || March 2016
	if(isset($_REQUEST["search_value"]))
	{
		$search_value=$_REQUEST["search_value"];
		$sql=$sql." WHERE invoice_number LIKE '".$search_value."%'";
	}
	
	if(isset($_REQUEST["search_start_date"]) && isset($_REQUEST["search_end_date"]))
	{
		if(($_REQUEST["search_start_date"]!="") && ($_REQUEST["search_end_date"]!=""))
		{
			$sql=$sql." and usagedate BETWEEN '".$_REQUEST["search_start_date"]."' and '".$_REQUEST["search_end_date"]."'";
		}
	}
	
	$sql=$sql." ORDER BY usages.id DESC";
	
	//echo "[".$sql."]";
					
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		//echo "Connected successfully<br/>";
						
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
								
						
					
						
					
				
			
										$id=$row["id"];
												$inv=$row["invoice_number"];
												$usage=$row["usagedate"];
												$equip=$row["equip"];
												$pur=$row["purpose"];
												$name=$row["name"];
												$pack=$row["pack"];
												$qty=$row["qty"];
												
												$sheet=$row["printedform1"];
												$sheet2=$row["printedform2"];
												
											$envsmall=$row["envsmall"];
										
												$spenvsmall=$row["spenvsmall"];
											
												$cost=$row["cost"];
												
												
			}
		}


}
?>