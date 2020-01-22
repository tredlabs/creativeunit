<?php 
include 'db.php';


$db_servername = "localhost";
							$db_username = "root";
							$db_password = "";
							$db_name =  "ssjlinve_inventorysystem";
							$sql = "SELECT name FROM fields";
							$formatted_result="";
$id=113;
$sql="SELECT receivals.*, rec_lineitems.*, stocks.*
			  FROM receivals
			  INNER JOIN rec_lineitems
			  ON recevials.id=rec_lineitems.receival_id LEFT JOIN stocks ON rec_lineitems.stock_id=stocks.id
			  WHERE rec_lineitems.receival_id=".$id;
	
					
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
			
		
		
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				echo $line_item = array('id' => $row["id"], 'stock_id' => $row["stock_id"], 'name' => ''.$row["name"].'', 'qty' => $row["qty"],'envsmall' => $row["envsmall"], 'envlarge' => $row["envlarge"], 'printedform1' => $row["printedform1"], 'printedform2' => $row["printedform2"]);
				
				array_push($line_items, $line_item);
			}
			$json_encoded_out = json_encode($line_items);
			$formatted_result=$json_encoded_out;
			$conn->close();
		
		
	}

	echo $formatted_result;

?>