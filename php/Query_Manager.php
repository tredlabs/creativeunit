<?php
date_default_timezone_set("Jamaica");
session_start();
error_reporting(E_ALL-E_NOTICE);

require 'db.php';


//Prevent direct access, via browser
defined('The Cretive Uint');

//Global Variables
	$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
  
$dir="../";
require_once($dir."classes/Session_Manager.php");

//Set the access level for th query manager -Imani Sterling|| 2018
$Session_Manager = new Session_Manager();
//$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="";
$userid = $_SESSION[$sid]['userid'];
//echo " $username  $userid";

//_____________________________________________________________[Functions]____________________________________________________________________


$sql = "SELECT users.id,users.email,users.username,users.sign_in_count
				FROM users
				
				WHERE id = '".$userid."' AND sign_in_count='1' ";
				
		


		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
		
	
		
			
			$result = $conn->query($sql);

			if ($result->num_rows > 0)
			{	
				// output data of each row
				while($row = $result->fetch_assoc())
				{
					//only checks one row and then cloes the connect
				
					 $id=$row["id"];
					  $_SESSION['id']=$id;
							
				 
			
				}
			
				
			}		
				

if($userid==$id){


/** -Imani Sterling|| 2018
*	@Discription:	Requets from the server the default formated infromation in the receival table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Generate_Receival_table()
{
		//$sql = "SELECT receivals.*,rec_lineitem.* FROM receivals LEFT JOIN rec_lineitems ON receivals.id=rec_lineitem.receival_id";


	$sql = "SELECT receivals.*,rec_lineitems.*,stocks.name,stocks.p1
	FROM receivals INNER JOIN rec_lineitems 
	ON receivals.id=rec_lineitems.receival_id LEFT JOIN stocks ON rec_lineitems.stock_id=stocks.id ";
	//$sql = "SELECT * FROM receivals";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
	if(isset($_REQUEST["search_value"]))
	{
		$search_value=$_REQUEST["search_value"];
		$sql=$sql." WHERE invoice_number LIKE '".$search_value."%'";
	}
	
	if(isset($_REQUEST["search_start_date"]) && isset($_REQUEST["search_end_date"]))
	{
		if(($_REQUEST["search_start_date"]!="") && ($_REQUEST["search_end_date"]!=""))
		{
			$sql=$sql." and recdate BETWEEN '".$_REQUEST["search_start_date"]."' and '".$_REQUEST["search_end_date"]."'";
		}
	}
	
	$sql=$sql." ORDER BY receivals.id DESC";
	
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
			$div=5000;
		    $box=0;	
		$per=0;
			// output data of each row
			while($row = $result->fetch_assoc())
			{ 
				
					
				    //box=$per/$div;				
				    $per1 =$row["packs"];
						$per =$row["boxs"];
					 //$per=$per/$div;
				
				$data_row_item_formatted = '
											<tr id="Listing_row_'.$row["id"].'">
												<td>'.$row["invoice_number"].'</td>
												<td>'.$row["recdate"].'</td>
													<td>'.$row["equip"].'</td>
												<td>'.$row["name"].' '.$row["p1"].'</td>
												<td>'.$row["envsmall"].'</td>
									<td>'.$row["envlarge"].'</td>
								<td>'.$per.'</td>
								<td>'.$per1.'</td>
									<td>'.$row["qty"].'</td>
									<td>'.$row["printedform1"].'</td>
									<td>'.$row["printedform2"].'</td>
									<td>'.'$'.$row["cost"].'</td>
												<td class="text-center">';
												
			if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
					$data_row_item_formatted.=' <a class="btn btn-primary btn-md button_style_addon" href="#" onClick="Show_Edit_Receival('.$row["id"].');" style="border-radius: 5px;"><span class="glyphicon glyphicon-edit"></span> Edit</a>';
				}
				
				if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{
					$data_row_item_formatted.=' <a href="#" class="btn btn-danger btn-md button_style_addon" style="border-radius: 5px;" onClick="Remove_Receival('.$row["id"].','.$row["receival_id"].');"><span class="glyphicon glyphicon-remove"></span> Del</a>';
				}
												
				$data_row_item_formatted.='		</td>
											</tr>
										  ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}



/** -Imani Sterling|| 2018
*	@Discription:	Generates the options for the stock menu
*	
*	@param none
*
*	@return (String) HTML formatted output
*/
function Generate_Stock_in_Type()
{
	//Create SQL string
	$sql = "SELECT stocks.id,stocks.name,stocks.p1,stocks.papersize
			FROM stocks
			INNER JOIN fields
			ON fields.id=stocks.field_id";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors 
	if(isset($_REQUEST["Type"]))
	{
		$type = $_REQUEST["Type"];
		$sql = $sql." WHERE fields.name = '".$type."'";
		//echo "[".$sql."]";
	}
		
		
		if($type=="PAPER")
		{
		$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
		
	// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);				
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
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].' '.$row["p1"].'</option>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
			
			
			
		}




if($type=="Envelope")

{
	$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
					
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
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].':  '.$row["p1"].'   '.$row["papersize"].'</option>
										   ';
										   
									   
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
	
			
			
		}

	
	if($type=="PrintedForm")

{
	$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
			
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
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].':  '.$row["p1"].'</option>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
			
			
			
		}
	
		if($type=="INSERTER")

{
			
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
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].'</option>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
			
			
			
		}
	
	
}



function Generate_Stock_in_Types()
{
	//Create SQL string
	//Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors 
	if(isset($_GET["Type"]))
	{
		$location = $_GET["location"];
		$sql = "SELECT $location.id,$location.name
			FROM $location
			INNER JOIN fields
			ON fields.id=$location.field_id";
	$formatted_result=""; 
		$type = $_REQUEST["Type"];
		
		$sql = $sql." WHERE fields.name = '".$type."'";
		//echo "[".$sql."]";
	}
		

if($type=="$type")
		{
		$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
		
	// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);				
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
			
			while($row = $result->fetch_assoc())
			{
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].'</option>
											
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
			
		}
		else
		{
		$conn->close();
				
		}
	}

	return $formatted_result;
			
			
			
		}


	
}

function Generate_Stock_in_office()
{
	//Create SQL string
	//Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors 
	if(isset($_GET["Type"]))
	{
		$location = $_GET["location"];
		$sql = "SELECT * FROM $location";
	$formatted_result=""; 
		$type = $_REQUEST["Type"];
		
		$sql = $sql." WHERE $location.type = '".$type."'";
		//echo "[".$sql."]";
	}
		

if($type=="$type")
		{
		$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
		
	// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);				
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
			
			while($row = $result->fetch_assoc())
			{
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].'</option>
											
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
			
		}
		else
		{
		$conn->close();
				
		}
	}

	return $formatted_result;
			
			
			
		}



	
	
}


function Generate_Stock_in_events()
{
	//Create SQL string
	//Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors 
	if(isset($_GET["Type"]))
	{
		$location = $_GET["location"];
		$sql = "SELECT * FROM $location";
	$formatted_result=""; 
		$type = $_REQUEST["Type"];
		
		$sql = $sql." WHERE $location.type = '".$type."'";
		//echo "[".$sql."]";
	}
		

if($type=="$type")
		{
		$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
		
	// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);				
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
			
			while($row = $result->fetch_assoc())
			{
				$data_row_item_formatted = '
											<option value="'.$row["id"].'">'.$row["name"].'</option>
											
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
			
		}
		else
		{
		$conn->close();
				
		}
	}

	return $formatted_result;
			
			
			
		}


	
}






/** -Imani Sterling|| 2018
*	@Discription:	adds a recieval to the recieval table and the coresponding line item in the receival line item table
*	
*	@param (void)
*
*	@return (void)
*/
function Add_Recieval()
{
	  
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Receival";
$userid = $_SESSION[$sid]['userid'];
	//variables
	$sql = "";
	$Invoice_Number = "";
	$Recdate = "";
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	//echo "$mess $username  $userid";
			
	//If the individual is searching for specific vendors  
	if(isset($_POST["Invoice_Number"]) && isset($_POST["Recdate"]) && isset($_POST["Inline_items"]))
	{
		$Invoice_Number = $_POST["Invoice_Number"];
		$Recdate = $_POST["Recdate"];
		$location = $_POST["location"];
		$Inline_items = $_POST["Inline_items"];
		
	}
	
	
	
	
	
	
		$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
						$quantity=$item_objects[$x]['quantity'];
						$stock=$item_objects[$x]['Stock_ID'];
						//$unitcost=$item_objects[$x]['unitcost'];
						
			}
	
	if($quantity==null){
		echo "Please Enter Quantity\n";
	exit;
	}
	if($stock==null){
		echo "Please Enter Stock Type\n";
	exit;
	}
	
	$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
				
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
				$sql ="INSERT INTO receivals(invoice_number, recdate, created_at)
			VALUES ('$Invoice_Number', '".$Recdate."', '".$Recdate."')";
						
		if($conn->query($sql) === TRUE){
		 echo "Receival Created\n";
			$ids = mysqli_insert_id($conn); 
		}
		else
					{
						echo "Error while creating receival ".$conn->error;
					}
					
		
			
			
			
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
						$quantity=$item_objects[$x]['quantity'];
					    $unitcost=$item_objects[$x]['unitcost'];
				
			
			   	
			       $type=$item_objects[$x]['Type']; 						
			   	   $sql ="SELECT $location.code,$location.name FROM $location WHERE $location.id =".$item_objects[$x]['Stock_ID'];
		           $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	    $code= $row['code'];
		$name= $row['name'];
		
	
	}
}	
			   				
		$sql ="SELECT * FROM price WHERE code ='$code'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unitcost1= $row["unit_cost"];
	
	
	}


	 			
			   	  


}

 $quantity=$item_objects[$x]['quantity'];
 $unitcost=$item_objects[$x]['unitcost'];					
					
			   	$cost=$quantity*$unitcost;
             
              	$item=$name;
           
			   	
				$sqls = "INSERT INTO rec_lineitems(receival_id,stock_id,cost,unit_cost,item,type,qty,created_at,location)
					VALUES ('$ids',".$item_objects[$x]['Stock_ID'].",'$cost','$unitcost','$item','$type',".$item_objects[$x]['quantity'].", '$Recdate','$location')";
				//echo "[".$sql."]";				
				if($conn->query($sqls)===TRUE)
				{ 
					//Make adjustment the stock table 
			
					
					$sql = "UPDATE $location
							SET instock = instock + $quantity,cost=cost+$cost,unit_cost=$unitcost
							WHERE id=".$item_objects[$x]['Stock_ID'];
										
  if ($conn->query($sql) === TRUE) {
 
  
  
}else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}		
	
					
					$id = mysqli_insert_id($conn);
	
	
                   
				   $info="Item: $item quantity: $quantity  Cost:$ $cost";
				   
				   
	               $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	               VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error: " . $sqltr . "<br>" . $conn->error;
}		
					
					
									
					
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
	 

			
			
			
		}


					
		
		
		$conn->close();
	}
}




/** -
*	@Discription:	Remove the given recieval from th receival table along with its line items
*	
*	@param (void)
*
*	@return (String) HTML formatted output
*/
function Remove_price()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Remove Item Price ";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
		$sql3="SELECT * FROM price WHERE
		id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$code=$row["code"];
				$unit_cost=$row["unit_cost"];
				$name=$row["name"];
				$size=$row["size"];
                $sale_cost=$row["sale_cost"];
				
			}
		}

				
	$sql = "DELETE FROM price WHERE id=".$id;
			
		
			
			if ($conn->query($sql) === TRUE)
			{
			echo "Record deleted successfully \n";	
	
			}
			else
			{
				echo "Error deleting record: " . $conn->error;
			}
			
		
	
	
	

	
	$info="Name: $name Code :$code  Unit Cost: $unit_cost  Sale Cost: $sale_cost Size: $size";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,purpose,created_at)
	VALUES ('$userid','$username','$action','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	}
	
	
	
	}
function Del_Receival()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Remove Usage";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
		$sql3="SELECT * FROM rec_lineitems WHERE
		id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$location=$row["location"];
				$stock_id=$row["stock_id"];
				$receival_id=$row["receival_id"];
				$cost=$row["cost"];
                $qty=$row["qty"];
				
				
			$sql2 = "UPDATE $location SET instock = instock - $qty,cost=cost-$cost WHERE id=$stock_id";
	
	
				if ($conn->query($sql2) === TRUE)
			{
				
			}
				else
		{
			echo "Error updating record: " . $conn->error;
		}
				
			
					
		}
			
		
		}
	
		
	$sql = "DELETE FROM rec_lineitems WHERE id =".$id;
			
			
			
			if ($conn->query($sql) === TRUE)
			{
			echo "Record deleted successfully \n";	
						
						}
			else
			{
				echo "Error deleting record: " . $conn->error;
			}
		
	
	
	

	
	$info="Quantity :$qty  Cost: $cost";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$stockid','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	}
	
	
	
	}	

function Remove_Receival()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Remove Usage";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	if(isset($_GET["rid"]))
	{
		$rrid = $_GET["rid"];
		$sql3="SELECT * FROM rec_lineitems WHERE
		id=".$rrid;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$location=$row["location"];
				$stock_id=$row["stock_id"];
				$receival_id=$row["receival_id"];
				$cost=$row["cost"];
                $qty=$row["qty"];
				
				
			$sql2 = "UPDATE $location SET instock = instock - $qty,cost=cost-$cost WHERE id=$stock_id";
	
	
				if ($conn->query($sql2) === TRUE)
			{
				
			}
				else
		{
			echo "Error updating record: " . $conn->error;
		}
				
			
					
		}
			
		
		}
	
		
	$sql = "DELETE FROM rec_lineitems WHERE receival_id =".$rrid;
			
			$sql2 = "DELETE FROM receivals WHERE id=".$rrid;
			
			if ($conn->query($sql) === TRUE)
			{
			echo "Record deleted successfully \n";	
			$result = $conn->query($sql2);
			}
			else
			{
				echo "Error deleting record: " . $conn->error;
			}
		
	
	
	

	
	$info="Quantity :$qty  Cost: $cost";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$stockid','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	}
	
	
	
	}
	
	
	function Add_price()
{
	
	
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Price Item";
$userid = $_SESSION[$sid]['userid'];
	//variables
	$sql = "";
	$Invoice_Number = "";
	$Recdate = "";
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	//echo "$mess $username  $userid";
	
	$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	
		if(!empty($_POST["addtype"]))
	{
						
		$code = $_POST["code"];
		$name = $_POST["name"];
		$addtype = $_POST["addtype"];
		
	    $unit_cost = $_POST["unit_cost"];
		$sale_cost = $_POST["sale_cost"];
		$location = $_POST["location"];
		$instock = $_POST["instock"];
		$reorder = $_POST["reorder"];
		$cost=$instock*$unit_cost;			
		
		
		if($location=="Warehouse1")
		{
			$addtype=$_POST["addtype"];
		    
		    $sql2="SELECT * FROM fields WHERE name='$addtype'";
		
		    $result = $conn->query($sql2);
			
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$field_id=$row["id"];
										
				
			}
		}
		else{

      $sql = "INSERT INTO fields(name)
	VALUES ('$addtype')";
	$result = $conn->query($sql);
	$field_id = mysqli_insert_id($conn);

		}
		
	
	
	$sql2="SELECT * FROM equipment WHERE name='$addtype'";
		$result = $conn->query($sql2);
			
			if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
		
										
				
			}
		}
		else{

      $sql = "INSERT INTO equipment(name)
	VALUES ('$addtype')";
	$result = $conn->query($sql);
	

		}
		
			$sql = "INSERT INTO price(code,unit_cost,name,type,location)
	VALUES ('$code','$unit_cost','$name','$addtype','$location')";
	
	 $sql2 = "INSERT INTO $location(code,field_id,cost,unit_cost,instock,reorderlevel,name,type,location,created_at)
	VALUES ('$code','$field_id','$cost','$unit_cost','$instock','$reorder','$name','$addtype','$location','$created_at')";
			
  if ($conn->query($sql) === TRUE) {
   $result = $conn->query($sql2);
  	
	  echo "Successfully Added\n";
   
 } 				
	else
		{
			echo "Error adding price item: " . $conn->error;
		}

		
$info="Name: $name  Code: $code Unit Cost: $unit_cost Instock: $instock reorder: $reorder location: $location ";

	 $sqltr = "INSERT INTO user_action(user_id,user,action,purpose,created_at)
	             VALUES ('$userid','$username','$action','$info','$created_at')";
				 
		 if ($conn->query($sqltr) === TRUE) {
 
   } 
	  
				 
				 
				 
	}
	
	
		if($location=="Warehouse2")
		{
			$addtype=$_POST["addtype"];
		    
		    $sql2="SELECT * FROM office_type WHERE name='$addtype'";
		
		    $result = $conn->query($sql2);
			
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$field_id=$row["id"];
										
				
			}
		}
		else{

      $sql = "INSERT INTO office_type(name)
	VALUES ('$addtype')";
	$result = $conn->query($sql);
	$field_id = mysqli_insert_id($conn);

		}
		
	
			$sql = "INSERT INTO price(code,unit_cost,name,type,location)
	VALUES ('$code','$unit_cost','$name','$addtype','$location')";
	
	 $sql2 = "INSERT INTO $location(code,field_id,cost,unit_cost,instock,reorderlevel,name,type,location,created_at)
	VALUES ('$code','$field_id','$cost','$unit_cost','$instock','$reorder','$name','$addtype','$location','$created_at')";
			
  if ($conn->query($sql) === TRUE) {
   $result = $conn->query($sql2);
  	
	  echo "Successfully Added\n";
   
 } 				
	else
		{
			echo "Error adding price item: " . $conn->error;
		}

		
$info="Name: $name  Code: $code Unit Cost: $unit_cost Instock: $instock reorder: $reorder location: $location ";

	 $sqltr = "INSERT INTO user_action(user_id,user,action,purpose,created_at)
	             VALUES ('$userid','$username','$action','$info','$created_at')";
				 
		 if ($conn->query($sqltr) === TRUE) {
 
   } 
	  
				 
				 
				 
	}
	
	
	
	
	
	if($location=="Warehouse3")
		{
			$addtype=$_POST["addtype"];
		    
		    $sql2="SELECT * FROM events_type WHERE name='$addtype'";
		
		    $result = $conn->query($sql2);
			
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$field_id=$row["id"];
										
				
			}
		}
		else{

      $sql = "INSERT INTO events_type(name)
	VALUES ('$addtype')";
	$result = $conn->query($sql);
	$field_id = mysqli_insert_id($conn);

		}
		
	
			$sql = "INSERT INTO price(code,unit_cost,name,type,location)
	VALUES ('$code','$unit_cost','$name','$addtype','$location')";
	
	 $sql2 = "INSERT INTO $location(code,field_id,cost,unit_cost,instock,reorderlevel,name,type,location,created_at)
	VALUES ('$code','$field_id','$cost','$unit_cost','$instock','$reorder','$name','$addtype','$location','$created_at')";
			
  if ($conn->query($sql) === TRUE) {
   $result = $conn->query($sql2);
  	
	  echo "New Type Created\n";
   
 } 				
	else
		{
			echo "Error adding price item: " . $conn->error;
		}

		
$info="Name: $name  Code: $code Unit Cost: $unit_cost Instock: $instock reorder: $reorder location: $location ";

	 $sqltr = "INSERT INTO user_action(user_id,user,action,purpose,created_at)
	             VALUES ('$userid','$username','$action','$info','$created_at')";
				 
		 if ($conn->query($sqltr) === TRUE) {
 
   } 
	  
				 
				 
				 
	}
	
	

	 	
		}		
else{
	if(isset($_POST["code"]) && isset($_POST["name"]) && isset($_POST["unit_cost"])&& isset($_POST["type"])&& isset($_POST["location"]))
	
		//if(isset($_REQUEST["code"]) && isset($_REQUEST["name"]) && isset($_REQUEST["unit_cost"])&& isset($_REQUEST["type"])&& isset($_REQUEST["location"]))
	{
		$code = $_POST["code"];
		$name = $_POST["name"];
		$type = $_POST["type"];
		
		//$type = $_REQUEST["type"];
			$unit_cost = $_POST["unit_cost"];
		$sale_cost = $_POST["sale_cost"];
			$location = $_POST["location"];
			$instock = $_POST["instock"];
		$reorder = $_POST["reorder"];
		$cost=$instock*$unit_cost;
	
		
	
	$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
				
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
		
		if($location=="Warehouse1"){
			
			
			  $sql2="SELECT * FROM fields WHERE name='$type'";
		
		    $result = $conn->query($sql2);
			
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$field_id=$row["id"];
										
				
			}
		}
						   
	
	$sql = "INSERT INTO price(code,unit_cost,name,type,location)
	VALUES ('$code','$unit_cost','$name','$type','$location')";
	
	 $sql2 = "INSERT INTO $location(code,field_id,cost,unit_cost,instock,reorderlevel,name,type,location,created_at)
	VALUES ('$code','$field_id','$cost','$unit_cost','$instock','$reorder','$name','$type','$location','$created_at')";
			
  if ($conn->query($sql) === TRUE) {
   	
   $result = $conn->query($sql2);
  	
	  echo "Successfully Added\n";
   
 } 				
	else
		{
			echo "Error adding price item: " . $conn->error;
		}
		
		
			
  
		
		
$info="Name: $name  Code: $code Unit Cost: $unit_cost Instock: $instock reorder: $reorder location: $location ";

	 $sqltr = "INSERT INTO user_action(user_id,user,action,purpose,created_at)
	             VALUES ('$userid','$username','$action','$info','$created_at')";
	
	
	   if ($conn->query($sqltr) === TRUE) {
 
   } 
	  
			
			}		


if($location=="Warehouse2"){
			
			
			  $sql2="SELECT * FROM office_type WHERE name='$type'";
		
		    $result = $conn->query($sql2);
			
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$field_id=$row["id"];
										
				
			}
		}
						   
	
	$sql = "INSERT INTO price(code,unit_cost,name,type,location)
	VALUES ('$code','$unit_cost','$name','$type','$location')";
	
	 $sql2 = "INSERT INTO $location(code,field_id,cost,unit_cost,instock,reorderlevel,name,type,location,created_at)
	VALUES ('$code','$field_id','$cost','$unit_cost','$instock','$reorder','$name','$type','$location','$created_at')";
			
  if ($conn->query($sql) === TRUE) {
   $result = $conn->query($sql2);
  	
	  echo "Successfully Added\n";
   
 } 				
	else
		{
			echo "Error adding price item: " . $conn->error;
		}
		
		
			
  
		
		
$info="Name: $name  Code: $code Unit Cost: $unit_cost Instock: $instock reorder: $reorder location: $location ";

	 $sqltr = "INSERT INTO user_action(user_id,user,action,purpose,created_at)
	             VALUES ('$userid','$username','$action','$info','$created_at')";
	
	
	   if ($conn->query($sqltr) === TRUE) {
 
   } 
	  
			
			}




if($location=="Warehouse3"){
			
			
			  $sql2="SELECT * FROM events_type WHERE name='$type'";
		
		    $result = $conn->query($sql2);
			
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$field_id=$row["id"];
										
				
			}
		}
						   
	
	$sql = "INSERT INTO price(code,unit_cost,name,type,location)
	VALUES ('$code','$unit_cost','$name','$type','$location')";
	
	 $sql2 = "INSERT INTO $location(code,field_id,cost,unit_cost,instock,reorderlevel,name,type,location,created_at)
	VALUES ('$code','$field_id','$cost','$unit_cost','$instock','$reorder','$name','$type','$location','$created_at')";
			
  if ($conn->query($sql) === TRUE) {
   $result = $conn->query($sql2);
  	
	  echo "Successfully Added\n";
   
 } 				
	else
		{
			echo "Error adding price item: " . $conn->error;
		}
		
		
			
  
		
		
$info="Name: $name  Code: $code Unit Cost: $unit_cost Instock: $instock reorder: $reorder location: $location ";

	 $sqltr = "INSERT INTO user_action(user_id,user,action,purpose,created_at)
	             VALUES ('$userid','$username','$action','$info','$created_at')";
	
	
	   if ($conn->query($sqltr) === TRUE) {
 
   } 
	  
			
			}












}

		}
		
	
	
	
}


		 

	  
	
	}



/** -Imani Sterling|| 2018
*	@Discription:	Get the the receival inline items from the inline item table and format the output for display
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) HTML formatted output
*/
function Get_Receival_line_items($id)
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
	if(isset($id))
	{
			
		$sql="SELECT rec_lineitems.id, stocks.name, rec_lineitems.qty , rec_lineitems.envsmall
		
			  FROM rec_lineitems
			  INNER JOIN stocks
			  ON rec_lineitems.stock_id=stocks.id
			  WHERE rec_lineitems.receival_id=".$id;
	}
					
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
						
		//$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$data_row_item_formatted = '
											<tr id=\''.$row["id"].'\'>
												<td>'.$row["name"].'</td>
												
												
												
											</tr>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}



/** -Imani Sterling|| 2018
*	@Discription:	Get the receival id, invoice number and created date in json encoded format
*	
*	@param (void)
*
*	@return (String) JSON ended formatted output
*/
function Basic_Receival_info()
{
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_REQUEST["id"]))
	{
	
		$id=$_REQUEST["id"];
		
		$sql="SELECT receivals.*, rec_lineitems.*
			  FROM receivals
			  INNER JOIN rec_lineitems
			  ON receivals.id=rec_lineitems.receival_id
			  WHERE receivals.id=".$id;
	}

					
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
				$json_encoded_out = array('Invoice_Number' => $row["invoice_number"],'location' => $row["location"], 'Recdate' => ''.$row["recdate"].'');
				$json_encoded_out = json_encode($json_encoded_out);
				
				$formatted_result=$json_encoded_out;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}
function Basic_Receival_price()
{
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_GET["id"]))
	{
	
		$id=$_GET["id"];
		
		$sql="SELECT price.*
			  FROM price
			  WHERE id=".$id;
	}

					
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
				$json_encoded_out = array('code' => $row["code"],'unit_cost' => $row["unit_cost"],'sale_cost' => $row["sale_cost"],'size' => $row["size"], 'name' => ''.$row["name"].'');
				$json_encoded_out = json_encode($json_encoded_out);
				
				$formatted_result=$json_encoded_out;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}


function Basic_warehouse()
{
	//Create SQL string 
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors  
	if(isset($_GET["id"]))
	{
	
		$id=$_GET["id"];
		$location=$_GET["location"];
		
		$sql="SELECT *
			  FROM $location
			  WHERE id=".$id;
	}

					
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
				$json_encoded_out = array('type' => $row["type"],'name' => $row["name"],'instock' => $row["instock"],'reorderlevel' => $row["reorderlevel"], 'cost' => ''.$row["cost"].'');
				$json_encoded_out = json_encode($json_encoded_out);
				
				$formatted_result=$json_encoded_out;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}

  
/** -Imani Sterling|| 2018
*	@Discription:	Get the the receival inline items from the inline item table and format the output for JSON
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) JSON formatted output
*/
function Get_Receival_line_items_JSON()
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
	if(isset($_GET["id"]))
	{
		$id=$_GET["id"];
		//$rid=$_REQUEST["rid"];
		$sql="SELECT receivals.*, rec_lineitems.*,rec_lineitems.id as rid
			  FROM  receivals
			  	INNER JOIN rec_lineitems
			  	ON receivals.id=rec_lineitems.receival_id
		      WHERE rec_lineitems.receival_id=".$id;
					 
	}
					
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
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$line_item = array('id' => $row["receival_id"],'rid' => $row["rid"],'name' => $row["item"], 'stock_id' => $row["stock_id"], 'qty' => $row["qty"],'unitcost' => $row["unit_cost"], 'equip' => $row["type"]);
				
				array_push($line_items, $line_item);
			}
			$json_encoded_out = json_encode($line_items);
			$formatted_result=$json_encoded_out;
			$conn->close();
		}
		else
		{
			$conn->close();
		}
	}

	return $formatted_result;
}


/** -Imani Sterling|| 2018
*	@Discription:	Requets from the server the default formated infromation in the Usage table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Generate_Usage_table()
{
	
	
	$sql = "SELECT usages.*,usage_lineitems.*,stocks.name
			    FROM usages
			    INNER JOIN usage_lineitems
			    ON usages.id=usage_lineitems.usage_id LEFT JOIN stocks ON usage_lineitems.stock_id=stocks.id 
			   ";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
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
									/*$data_row_item_formatted = '
											<tr id="Listing_row_'.$row["id"].'">
												<td>'.$row["invoice_number"].'</td>
												<td>'.$row["usagedate"].'</td>
												<td>'.$row["equip"].'</td>
												<td>'.$row["purpose"].'</td>
												<td>'.$row["name"].'</td>
												<td>'.$row["pack"].'</td>
												<td>'.$row["qty"].'</td>
												<td>'.$row["spoilage"].'</td>
												<td>'.$row["printedform1"].'</td>
												<td>'.$row["printedform2"].'</td>
													<td>'.$row["spform1"].'</td>
												<td>'.$row["spform2"].'</td>
													<td>'.$row["envsmall"].'</td>
												<td>'.$row["envlarge"].'</td>
													<td>'.$row["spenvsmall"].'</td>
												<td>'.$row["spenvlarge"].'</td>
												<td>'.$row["cost"].'</td>
												<td class="text-center">';*/
								
							
						
					
						
					
				
				$data_row_item_formatted = '
											<tr id="Listing_row_'.$row["id"].'">
												<td>'.$row["invoice_number"].'</td>
												<td>'.$row["usagedate"].'</td>
												<td>'.$row["equip"].'</td>
												<td>'.$row["purpose"].'</td>
												<td>'.$row["name"].'</td>
												<td>'.$row["pack"].'</td>
												<td>'.$row["qty"].'</td>
												
												<td>'.$row["printedform1"].'</td>
												<td>'.$row["printedform2"].'</td>
												
													<td>'.$row["envsmall"].'</td>
												
													<td>'.$row["spenvsmall"].'</td>
											
												<td>'.$row["cost"].'</td>
												<td class="text-center">';
												
												
				if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
					$data_row_item_formatted.= '<a class="btn btn-primary btn-md button_style_addon" href="#" onClick="Show_Edit_Usage('.$row["id"].');" style="border-radius: 5px;"><span class="glyphicon glyphicon-edit"></span> Edit</a> ';
				}
				if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{
					$data_row_item_formatted.= '<a href="#" class="btn btn-danger btn-md button_style_addon" style="border-radius: 5px;" onClick="Remove_Usage('.$row["id"].','.$row["usage_id"].');"><span class="glyphicon glyphicon-remove"></span> Del</a> ';
				}
				
				$data_row_item_formatted.= '	</td>
											</tr>
										   ';
										   
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}


/** -Imani Sterling|| 2018
*	@Discription:	Get the the Usage inline items from the inline item table and format the output for display
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) HTML formatted output
*/
function Get_Usage_line_items($id)
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
	if(isset($id))
	{
		$sql="SELECT usage_lineitems.id, stocks.name, usage_lineitems.qty,usage_lineitems.reams, usage_lineitems.spoilage
			  FROM usage_lineitems
			  INNER JOIN stocks
			  ON usage_lineitems.stock_id=stocks.id
			  WHERE usage_lineitems.usage_id=".$id;
	}
					
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
				$data_row_item_formatted = '
											<tr id=\''.$row["id"].'\'>
												<td>'.$row["name"].'</td>
													<td>'.$row["reams"].'</td>
												<td>'.$row["qty"].'</td>
												<td>'.$row["spoilage"].'</td>
												
												
											</tr>
										   ';
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}


/** -Imani Sterling|| 2018
*	@Discription:	Remove the given recieval inline item from th receival inline item table
*	
*	@param (void)
*
*	@return (String) HTML formatted output
*/
function Remove_Receival_line_item()
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
		$sql = "DELETE FROM rec_lineitems WHERE id=".$id;
		echo "[".$sql."]";
	}
	
					
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
							
		if ($conn->query($sql) === TRUE)
		{
			echo "Record deleted successfully";
		}
		else
		{
			echo "Error deleting record: " . $conn->error;
		}
		$conn->close();
	}
}


/** -Imani Sterling|| 2018
*	@Discription:	Update the details of a receival and also its line items, allowing for the adding off new line items in the update
*	
*	@param (void)
*
*	@return (void)
*/
function Update_Recieval()
{
	
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Receival";
$userid = $_SESSION[$sid]['userid'];

	//variables
	$sql = "";
	$ID = "";
	$Invoice_Number = "";
	$Recdate = "";
	
	$Inline_items = "";
	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_POST["ID"]) && isset($_POST["Invoice_Number"]) && isset($_POST["Recdate"]) && isset($_POST["Inline_items"]))
	{
		$ID = $_POST["ID"]; 
		$Item_ID = $_POST["Item_ID"]; 
		$Invoice_Number = $_POST["Invoice_Number"];
		$Recdate = $_POST["Recdate"];
        $location = $_POST["location"];
		$stock_id = $_POST["stock_id"];
		$Inline_items = $_POST["Inline_items"];
	$add_item=$_POST["add_item"];
	
	}
	if(isset($_POST["new_Inline_items"])){
		
			$ID = $_POST["ID"]; 

		$Invoice_Number = $_POST["Invoice_Number"];
		$Recdate = $_POST["Recdate"];
        $location = $_POST["location"];
	
		$add_item=$_POST["new_Inline_items"];
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
					$item_objects = json_decode($add_item, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
						$quantity=$item_objects[$x]['qty'];
					    $unitcost=$item_objects[$x]['unitcost'];
				
			
			   	
			       $type=$item_objects[$x]['type']; 						
			   	   $sql ="SELECT $location.code,$location.name FROM $location WHERE $location.id =".$item_objects[$x]['stock'];
		           $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	    $code= $row['code'];
		$name= $row['name'];
		
	
	}
}	
			   				
		$sql ="SELECT * FROM price WHERE code ='$code'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unitcost1= $row["unit_cost"];
}

}

 $quantity=$item_objects[$x]['qty'];
 $unitcost=$item_objects[$x]['unitcost'];					
					
			   	$cost=$quantity*$unitcost;
             
              	$item=$name;
           
			   	
				$sqls = "INSERT INTO rec_lineitems(receival_id,stock_id,cost,unit_cost,item,type,qty,created_at,location)
					VALUES ('$ID',".$item_objects[$x]['stock'].",'$cost','$unitcost','$item','$type',".$item_objects[$x]['qty'].", '$Recdate','$location')";
				//echo "[".$sql."]";				
				if($conn->query($sqls)===TRUE)
				{
					echo"Item Added\n"; 
					//Make adjustment the stock table 
				
				    $sql = "UPDATE $location
							SET instock = instock + $quantity,cost=cost+$cost,unit_cost=$unitcost
							WHERE id=".$item_objects[$x]['stock'];
							
									
  if ($conn->query($sql) === TRUE) {
   
  
} else {
    echo "Error:" . $conn->error;
}		
			
							
					
					$id = mysqli_insert_id($conn);
	
	
                   
				   $info="Item: $item quantity: $quantity  Cost:$ $cost";
				   
				   
	               $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	               VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error: " . $sqltr . "<br>" . $conn->error;
}		
					
					
									
					
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
				}
	 

			
			
			
		}
		
		
		
		
		
		
	}
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
		$sql = "UPDATE receivals
				SET invoice_number='$Invoice_Number', recdate='$Recdate'
				WHERE id='$ID'";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			 echo "Updated successfully\n";	
			}  
	
			
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
			$id=$item_objects[$x]['Item_ID'];
			$type=$item_objects[$x]['Type'];
			$stockid=$item_objects[$x]['stockid'];
	
					$sql="SELECT * FROM $location 
		WHERE id=".$stockid;
		
		$result= $conn->query($sql);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				
                $code=$row["code"];
				
			}
			
			
		}	
				
			
			
										
		$sql ="SELECT * FROM price  WHERE code ='$code'";
		$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost1=$row["unit_cost"];
	
	
	}

}		
			$sql2= "SELECT * FROM rec_lineitems
			WHERE id=".$item_objects[$x]['Item_ID'];		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
			 $qtyA=$row["qty"];
			
			$stockid1=$row["stock_id"];
			
		}
		}	
				
		
			//Update individual line items   -Imani Sterling|| 2018
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Imani Sterling || 2018
			
			$item_objects = json_decode($Inline_items, true); 
			$number_of_inline_items = sizeof($item_objects);
			
			
				$qtyB=$item_objects[$x]['Quantity'];
				$unitcost=$item_objects[$x]['unitcost'];
			
						if($qtyB<=$qtyA)
						{
							
							$updatesheet=$qtyA-$qtyB;
							$cost=$updatesheet*$unitcost;	
							$cost1=$unitcost*$qtyB;
						
								$sql1 = "UPDATE $location
						SET instock=instock-$updatesheet,cost=cost-$cost, unit_cost=$unitcost
						WHERE id=".$stockid;
							
											$sql = "UPDATE rec_lineitems
						SET cost=$cost1,qty=".$item_objects[$x]['Quantity'].",unit_cost=$unitcost, created_at= '".$Recdate."'
						WHERE id=".$item_objects[$x]['Item_ID'];
						
						if($conn->query($sql1) === TRUE)
				{
					
               $purpose="Remove Sheets: $updatesheet Cost:  $cost";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$stockid','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
  	$uid = mysqli_insert_id($conn);
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
					
					
					
							if($conn->query($sql) === TRUE)
				{
					if($qtyB==$qtyA||$qtyB==""){
					// echo "Updated successfully\n";	
					}else{
						  //echo "Updated\n";	
					}
					
					
				}
				else
				{
					echo "Error updating Receival: 	 ".$conn->error;
				}	
				}
				else
				{
					echo "Error while updating $location: 	 ".$conn->error;
				}
					}
						else{
							        $updatesheet=$qtyB-$qtyA;
									$cost=$updatesheet*$unitcost;
								$cost1=$unitcost*$qtyB;
						   $sql1 = "UPDATE $location
						SET instock=instock+$updatesheet, cost=cost+$cost,unit_cost=$unitcost
						WHERE id='$stockid'";
							
						  $sql = "UPDATE rec_lineitems
						SET cost=$cost1, qty=".$item_objects[$x]['Quantity'].",unit_cost=$unitcost, created_at= '$Recdate'
						WHERE id=".$item_objects[$x]['Item_ID'];
						
						if($conn->query($sql) === TRUE)
				{
					
					$purpose="Add Sheets: $updatesheet Cost:  $cost";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$stockid','$purpose','$created_at')";
			
         if ($conn->query($sqltr) === TRUE) {
         	$uid = mysqli_insert_id($conn);
           //$mess="Trace user  ";
	       //echo "$mess $username  $userid";
           } else 
           {
              echo "Error1: " . $sqltr . "<br>" . $conn->error;
           }
			 if($conn->query($sql1) === TRUE)
				{
					//echo "Updated successfully\n";
				}
				else
				{
					echo "Error while updating:".$conn->error;
				}
					
				}
				else
				{
					echo "Error while updating Receival: 	 ".$conn->error;
				}
			
						}	
			
						
							
									
				
			
			}

		
		
	}
	}
	
	
	function Update_price()
{

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Price";
$userid = $_SESSION[$sid]['userid'];

	//variables

	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_POST["ID"]) && isset($_POST["code"]) && isset($_POST["unit_cost"])&& isset($_POST["location"]))
	{
		$ID = $_POST["ID"]; 
		$code = $_POST["code"]; 
		$unit_cost = $_POST["unit_cost"];
		$sale_cost = $_POST["sale_cost"];
		$location = $_POST["location"];
        $name = $_POST["name"];	
	}
		
	
		
		
		
		
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			$sql1="SELECT * FROM price WHERE id='$ID' ";
			$result= $conn->query($sql1);
	
		echo"$rowcount";
			$i=0;
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$codeA=$row["code"];
               
			}
		}	
		
		
		
		
		
		
		
		
			
				
		$sql = "UPDATE price
				SET code='$code', unit_cost='$unit_cost',name='$name'
				WHERE id='$ID'";
		
		$sql1 = "UPDATE $location
				SET code='$code',name='$name'
				WHERE code=".$codeA;	
				
		
				
					
				
						
		if($conn->query($sql) === TRUE)
		{
			echo "Updated ";
			
			
					if($conn->query($sql1) === TRUE)
		{
			echo "Successfully";
			
		}					
		else
				{
					echo "Error updating $location 	 ".$conn->error;
				}
					
               $purpose="Update Price Items:  code:  $code Name: $name Sale Cost: $sale_cost Size: $size Unit Cost: $unit_cost";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$ID','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
  	$uid = mysqli_insert_id($conn);
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
					
					
					
			
				}
				else
				{
					echo "Error updating Price: 	 ".$conn->error;
				}	
				}
	
						}	


					
	function Update_all()
{
//echo"love";
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Warehouse";
$userid = $_SESSION[$sid]['userid'];

	//variables

	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_REQUEST["ID"]) && isset($_REQUEST["name"]) && isset($_REQUEST["type"]))
	{
		$ID = $_REQUEST["ID"]; 
		$type = $_REQUEST["type"]; 
		$cost = $_REQUEST["cost"];
		$reorder = $_REQUEST["reorder"];
        $name = $_REQUEST["name"];
		$instock = $_REQUEST["instock"];
       $location = $_REQUEST["location"];
       $qty=$instock;
		
		
	}
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
			$sql="SELECT * FROM $location ";
			$result= $conn->query($sql);
		$rowcount=mysqli_num_rows($result);
		echo"$rowcount";
			$i=0;
		if ($result->num_rows > 0)
		{
			// output data of each row
			for($count=0;$count<$rowcount;$count++)
			{
				//echo"$rowcount";
				$code[$i]=$row["code"];
				$ID[$i]=$row["id"];
				
                $qtyA[$i]=$row["instock"];
				$i++;
				
			}
		}
		
		for($count=0;$count>$i;$count++)
		{$sql1 ="SELECT * FROM price WHERE code ='$code[$i]'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost[$i]= $row["unit_cost"];
	//$size= $row["size"];
	
	}
}
	
		$cost[$i]=$qtyA[$i]*$unit_cost[$i];
		
			
		$sql = "UPDATE $location 
				SET  cost=$cost[$i],instock=$qtyA[$i],reorderlevel='$reorder'
				WHERE id='$ID[$i]'";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			echo "Updated Successfully";
		}
			
		
		
	}	
				}
				
				}
	
						

			
						
	function Update_warehouse()
{

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Warehouse";
$userid = $_SESSION[$sid]['userid'];

	//variables

	
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -
	if(isset($_POST["ID"]) && isset($_POST["name"]) && isset($_POST["type"]))
	{
		$ID = $_POST["ID"]; 
		$type = $_POST["type"]; 
		$cost = $_POST["cost"];
		$reorder = $_POST["reorder"];
        $name = $_POST["name"];
		$instock = $_POST["instock"];
       $location = $_POST["location"];
       $qty=$instock;
		
		
	}
					
	// Create connection to database
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
			$sql="SELECT * FROM $location 
			WHERE id='$ID'";
			$result= $conn->query($sql);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$code=$row["code"];
                $qtyA=$row["instock"];
				//$unitcost=$row["unit_cost"];
			}
		}
		
			$sql1 ="SELECT * FROM price WHERE code ='$code'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost= $row["unit_cost"];
	//$size= $row["size"];
	
	}
}
	if($qty<=$qtyA){
		//$updateqty=$qtyA-$qty;
		$cost=$qty*$unit_cost;
		
			
		$sql = "UPDATE $location 
				SET  cost=$cost,instock=$qty,reorderlevel='$reorder'
				WHERE id='$ID'";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			//echo "Updated Successfully";
		}
		
		
	}
	if($qty>=$qtyA){
	//$updateqty=$qty-$qtyA;
		
		$cost=$qty*$unit_cost;
		$sql = "UPDATE $location 
				SET  cost=$cost,instock=$qty,reorderlevel='$reorder'
				WHERE id='$ID'";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			//echo "Updated Successfully";
		}
	}
	
	
		
		
			
		$sql = "UPDATE $location 
				SET name='$name',type='$type',reorderlevel='$reorder'
				WHERE id='$ID'";
				
				
						
		if($conn->query($sql) === TRUE)
		{
			echo "Updated Successfully";
			
			//Update individual line items   -Imani Sterling|| 2018
			//$id = mysqli_insert_id($conn); //Get the inserted ID for the Receival that was inserted above -Imani Sterling|| 2018
			
					
               $purpose="Update Inventory Item:  Type:  $type Name: $name Instock: $instock Reorder: $reorder Cost: $cost";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$ID','$purpose','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
  	$uid = mysqli_insert_id($conn);
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   
  
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}		
					
					
					
			
				}
				else
				{
					echo "Error updating Price: 	 ".$conn->error;
				}	
				}
	
						}	
			
						
														
									
				
	
	



/** -Modified By Imani Sterling 2018
*	@Discription:	adds a Usage to the usage table and the coresponding line item in the usage line item table
*	
*	@param (void)
*
*	@return (void)
*/
function Add_Usage()  //This is where we add the usage request 
{
		
$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Add Usage";
$userid = $_SESSION[$sid]['userid'];
	
	//variables
	$sql = "";
	$Invoice_Number = "";
	$Usagedate = "";
	$Purpose = "";
	$Equipment = "";
	$Req="";
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	
	if(isset($_POST["Invoice_Number"]) && isset($_POST["Recdate"]) && isset($_POST["Purpose"]) && isset($_POST["Inline_items"]))
	{
		$Invoice_Number = $_POST["Invoice_Number"];
		
		$Usagedate = $_POST["Recdate"];
		$Purpose = $_POST["Purpose"];
		//$Equipment = $_REQUEST["Equipment"];
		$jname = $_POST["jname"];
		$location = $_POST["location"];
		$Inline_items = $_POST["Inline_items"];
	   // $Insertqty= $_REQUEST["insertqty"];
	   
	   
	}
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
	
	
	
	$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
						$quantity=$item_objects[$x]['quantity'];
						$stock=$item_objects[$x]['Stock_ID'];
						
			}
			
				 $sql ="SELECT * FROM $location WHERE id ='$stock'";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	  $code= $row["code"];
	  $name=$row["name"];
	  $unitcost=$row["unit_cost"];
	
	}}	
			
			
			$qty=$quantity;
			
			if($qty<=$instock){
				
	
			$sql = "INSERT INTO usages(invoice_number, usagedate, purpose, equipment_id,created_at)
			VALUES ('$Invoice_Number', '$Usagedate', '$Purpose','$Equipment','$created_at')";
						
	if($conn->query($sql) === TRUE){
		$id = mysqli_insert_id($conn);
	
				}		
}	
			
			
			
			
			
	
	if($quantity==null){
		echo "Please Enter Quantity\n  $Usagedate";
	exit;
	}
	if($stock==null){
		echo "Please Enter Stock Type\n";
	exit;
	}
	
	
		$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";


	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
		

		
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $stock_id=$item_objects[$x]['Stock_ID'];
		      $qty=$item_objects[$x]['quantity'];
			  $spoil=$item_objects[$x]['spoil'];
		      $type=$item_objects[$x]['Type'];
	
			
			     
			      	
						 $sql ="SELECT * FROM $location WHERE id ='$stock_id'";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	  $code= $row["code"];
	  $name=$row["name"];
	  $unitcost=$row["unit_cost"];
	
	}}	
		
	$sql1 ="SELECT * FROM price WHERE code ='$code'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost= $row["unit_cost"];
	//$size= $row["size"];
	
	}
}
	


	$cost=$qty*$unitcost;
	$spcost=$spoil*$unitcost;	
		
			
			if($qty<=$instock){
				
				 
              	$item=$name;
              
			   	
				
			
					
	
		$sql1 = "INSERT INTO usage_lineitems(usage_id,req_by,cost,spoilcost,items,stock_id,qty,spoilage,created_at,equip,location)
					VALUES ('$id','$jname','$cost','$spcost','$item','$stock_id','$qty','$spoil','$Usagedate','$type','$location')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					$info="Jobname: $jname Type:$type  Item: $item   spoil: $spoil spcost: $ $spcost  sheets: $qty  cost: $ $cost";
					
					$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	

	
					
					$sql = "UPDATE $location
							SET instock = instock - $qty,cost=cost-$cost
							WHERE id=".$item_objects[$x]['Stock_ID'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Internal PO Created \n";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
						$sql ="DELETE  FROM usages WHERE id  ='$id'";
		$result = $conn->query($sql);
					
				}
				
	
		
				

	
			

}
else{
	$amount=$qty-$instock;
	echo "You have exceeded stock amount by: $amount  Instock: $instock";
	
}	



		}

}
	
		
		$conn->close();
	



}


 
/** 
*	@Discription:	Remove the given usage from the usage table along with its line items
*	
*	@param (void)
*
*	@return (void)
*/
function Remove_Usage()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Remove Usage";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
		$sql3="SELECT * FROM usage_lineitems 
		WHERE usage_id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$location=$row["location"];
				$stock_id=$row["stock_id"];
				$cost=$row["cost"];
                $qty=$row["qty"];
				
				$sql2 = "UPDATE $location SET instock = instock + $qty,cost=cost+$cost WHERE id=$stock_id";
	
	
				if ($conn->query($sql2) === TRUE)
			{
				
			}
		else
		{
			echo "Error updating record: " . $conn->error;
		}
		}
		}
	$sql = "DELETE FROM usage_lineitems WHERE usage_id=".$id;
			
			$sql2 = "DELETE FROM usages WHERE id=".$id;
			
			if ($conn->query($sql) === TRUE)
			{
			echo "Internal PO Deleted \n";	
			$result = $conn->query($sql2);
			}
			else
			{
				echo "Error deleting record: " . $conn->error;
			}

	
	$info="Quantity :$qty  Cost: $cost";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$stock_id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	
	
	
	
	}
	
	
		$conn->close();
	
}

function Del_Usage()
{

$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Delete Usage";
$userid = $_SESSION[$sid]['userid'];

	$sql = "";
	
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	
	
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql3="SELECT * FROM usage_lineitems 
		WHERE id=".$id;
		
		$result= $conn->query($sql3);
		
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				
				$location=$row["location"];
				$stock_id=$row["stock_id"];
				$cost=$row["cost"];
                $qty=$row["qty"];
				
				$sql2 = "UPDATE $location SET instock = instock + $qty,cost=cost+$cost WHERE id=$stock_id";
	
	
				if ($conn->query($sql2) === TRUE)
			{
				
			}
		else
		{
			echo "Error updating record: " . $conn->error;
		}
		}
		}
	$sql = "DELETE FROM usage_lineitems WHERE id=".$id;
			
	if ($conn->query($sql) === TRUE)
			{
				echo "Item Deleted";
			}
	
	$info="Quantity :$qty  Cost: $cost";
				   
				   
	
	$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$stock_id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     
   } 				
	


	
	
	
	
	
	
	
	}
	
	
		$conn->close();
	
}




/** 
*	
*	
*	@param (void)
*
*	@return (String) JSON ended formatted output
*/
function Basic_Usage_info()
{
	
	$sql = "";
	$formatted_result=""; 
	
	

	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		
		 
			$sql="SELECT usages.*, usage_lineitems.*
		    FROM usages
			INNER JOIN usage_lineitems
			ON usages.id=usage_lineitems.usage_id
		    WHERE usage_lineitems.usage_id=".$id;
			
			
			
	}

	$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
					
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
				$json_encoded_out = array('ID' => $row["id"],'job_id' => $row["job_id"], 'Invoice_Number' => $row["invoice_number"], 'Usagedate' => ''.$row["usagedate"].'', 'jname' => ''.$row["req_by"].'','location' => ''.$row["location"].'', 'Purpose' => ''.$row["purpose"].'','Req' => ''.$row["req_by"].'', 'Equipment' => ''.$row["equipment_id"].'');
				$json_encoded_out = json_encode($json_encoded_out);
				
				$formatted_result=$json_encoded_out;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}




/** 
*	@Discription:	Get the the usage inline items from the inline item table and format the output for JSON
*	
*	@param (Integer) $id - The id numbere for the receival
*
*	@return (String) JSON formatted output
*/
function Get_Usage_line_items_JSON()
{
	
	$sql = "";
	$formatted_result=""; //Will be used to contain the result of the formatted SQL query 
	
	
	//If the individual is searching for specific vendors
	if(isset($_GET["id"]))
	{
		$id=$_GET["id"];
	//$job_id=$_REQUEST["job_id"];
	//echo "$invoice";
		
	 $sql = "SELECT usages.*, usage_lineitems.*
		    FROM usages
			INNER JOIN usage_lineitems 
			ON usages.id=usage_lineitems.usage_id
			WHERE usage_lineitems.usage_id=$id";
		
	/* 			
	  $sql = "SELECT usages.*, usage_lineitems.*
		    FROM usage_lineitems
			INNER JOIN usages 
			ON usage_lineitems.invoice=usages.invoice_number
			WHERE usage_lineitems.invoice=".$invoice;
	 */	
	}
					  
 	$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
					
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
			$line_items = array();
			
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				//$reams=$row["reams"];
				$line_item = array('id' => $row["id"],'item' => $row["items"], 'stock_id' => $row["stock_id"], 'qty' => $row["qty"], 'spoilage' => $row["spoilage"], 'equip' => $row["equip"], 'usage_id' => $row["usage_id"], 'size' => $row["size"]);
				
				array_push($line_items, $line_item);
			}
			$json_encoded_out = json_encode($line_items);
			$formatted_result=$json_encoded_out;
			$conn->close();
		}
		else
		{
			$conn->close();
		}
	}

	return $formatted_result;
}



/** 
*	@Discription:	Remove the given usage inline item from th usage inline item table
*	
*	@param (void)
*
*	@return (void)
*/
function Remove_Usage_line_item()
{
	
	$sql = "";
	
	

	if(isset($_REQUEST["id"]))
	{
		$id = $_REQUEST["id"];
		$sql = "DELETE FROM usage_lineitems WHERE id=".$id;
		//echo "[".$sql."]";
	}
	
					
	// Create connection to database
	$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";
		
	$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		//echo "Connected successfully<br/>";
						
		if ($conn->query($sql) === TRUE)
		{
			echo "Record deleted successfully";
		}
		else
		{
			echo "Error deleting record: " . $conn->error;
		}
		$conn->close();
	}
}


/** 
*	@Discription:	Update the details of a usage and also its line items, allowing for the adding off new line items in the update
*	
*	@param (void)
*
*	@return (void)
*/
function Update_Usage()
{
	require 'db.php';
$created_at = date("Y-m-d h:i:s");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Update Usage";
$userid = $_SESSION[$sid]['userid'];
	
	
	//variables
	$sql = "";
	$ID = "";
	$Invoice_Number = "";
	$Usagedate = "";
	$Equipment = "";
	$Purpose = "";
	$Inline_items = "";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	
	if(isset($_POST["ID"]) && isset($_POST["Invoice_Number"]) && isset($_POST["Usagedate"]) && isset($_POST["Purpose"]) && isset($_POST["Equipment"]) && isset($_POST["Inline_items"]))
	{
		$ID = $_POST["ID"]; 
		$Item_ID = $_POST["Item_ID"]; 
		$Invoice_Number = $_POST["Invoice_Number"];
		$Usagedate = $_POST["Usagedate"];
		$Purpose = $_POST["Purpose"];
		$Equipment = $_POST["Equipment"];
		$location = $_POST["location"];
		$jname = $_POST["jname"];
		$Inline_items = $_POST["Inline_items"];
		$new_Inline_items = $_POST["new_Inline_items"];
		
	/*	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);				
		
		
								 $sql ="SELECT * FROM usages";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $uid= $row["id"];
	  $date= $row["usagedate"];
	  
	  
	  	$sql = "UPDATE usage_lineitems
							SET created_at ='$date'
							WHERE usage_id='$uid'";
									
					if($conn->query($sql) === TRUE)
					{
						//echo "date updated \n";
					}
	  
	
	}}	
		
		*/
		
		
		
		
		
	}
	
	if(isset($_POST["new_Inline_items"])){
		
			$ID = $_POST["ID"]; 

		$Invoice_Number = $_REQUEST["Invoice_Number"];
		$Usagedate = $_REQUEST["Usagedate"];
		$Purpose = $_REQUEST["Purpose"];
		$Equipment = $_REQUEST["Equipment"];
		$location = $_REQUEST["location"];
		$jname = $_REQUEST["jname"];
	
		$add_item=$_REQUEST["new_Inline_items"];
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
	
					$item_objects = json_decode($add_item, true); //Array containing associate array of inline item(ID and quantity)   -Imani Sterling|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
			for ($x = 0; $x < $number_of_inline_items; $x++)
			{
				
					// $id=$item_objects[$x]['Item_ID'];	
		      $stock_id=$item_objects[$x]['stock'];
		      $qty=$item_objects[$x]['qty'];
			  $spoil=$item_objects[$x]['spoil'];
		      $type=$item_objects[$x]['type'];
	
			
			     
			      	
						 $sql ="SELECT * FROM $location WHERE id ='$stock_id'";
		
		     $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	  $instock= $row["instock"];
	  $code= $row["code"];
	  $name=$row["name"];
	  $unitcost=$row["unit_cost"];
	
	}}	
		
	$sql1 ="SELECT * FROM price WHERE code ='$code'";
		$result = $conn->query($sql1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$unit_cost= $row["unit_cost"];
	//$size= $row["size"];
	
	}
}
	


	$cost=$qty*$unitcost;
	$spcost=$spoil*$unitcost;	
		
			
			if($qty<=$instock){
				
				 
              	$item=$name;
              
			   	
				
			
					
	
		$sql1 = "INSERT INTO usage_lineitems(usage_id,req_by,cost,spoilcost,items,stock_id,qty,spoilage,created_at,equip,location)
					VALUES ('$ID','$jname','$cost','$spcost','$item','$stock_id','$qty','$spoil','$Usagedate','$type','$location')";
				//echo "[".$sql."]";				
				if($conn->query($sql1) === TRUE)
				
				{
					$info="Jobname: $jname Type:$type  Item: $item   spoil: $spoil spcost: $ $spcost  sheets: $qty  cost: $ $cost";
					
					$sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	VALUES ('$userid','$username','$action','$id','$info','$created_at')";
			
  if ($conn->query($sqltr) === TRUE) {
     //$mess="Trace user  ";
	//echo "$mess $username  $userid";
   } else {
    echo "here Error: " . $sqltr . "<br>" . $conn->error;
}	

	
					
					$sql = "UPDATE $location
							SET instock = instock - $qty,cost=cost-$cost
							WHERE id=".$item_objects[$x]['stock'];
									
					if($conn->query($sql) === TRUE)
					{
						echo "Item Added \n";
					}
					else
					{
						echo "Error while updating stock level: ".$conn->error;
					}
				
				}
				else
				{
					echo "Error while inserting into database: ".$conn->error;
						
				}
				
	
		
				

	
			

}
else{
	$amount=$qty-$instock;
	echo "You have exceeded stock amount by: $amount  Instock: $instock";
	
}	



		}
		
		
		
		
		
	}
	//adding new item
					
	// Create connection to database
		
	$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);				
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
			
			$item_objects = json_decode($Inline_items, true); //Array containing associate array of inline item(ID and quantity)   -|| 2018
			$number_of_inline_items = sizeof($item_objects);
			
				for ($x = 0; $x < $number_of_inline_items; $x++){
				
				
			$id=$item_objects[$x]['Item_ID'];
			$sid=$item_objects[$x]['sid'];
		     $type=$item_objects[$x]['Type'];
			 $qtyB=$item_objects[$x]['Quantity'];
			 $spoilB=$item_objects[$x]['Spoilage'];
			
				
				$stock_id=$item_objects[$x]['Stock_ID'];
		  $sql1 ="SELECT * FROM $location WHERE id ='$stock_id'";
		
		     $result = $conn->query($sql1);

        if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
    
	      $instock=$row["instock"];
	      $code=$row["code"];
		  $unitcost=$row["unit_cost"];
	
	}}	
				$sql2= "SELECT * FROM usage_lineitems
			WHERE id=".$item_objects[$x]['sid'];		
			$result = $conn->query($sql2);
				if ($result->num_rows > 0)
		{	
		
			
	
			while($row = $result->fetch_assoc())
			{
				
				
			 $qtyA=$row["qty"];
			$spoilA=$row["spoilage"];
			}
			
			
		}
			
	   
		
		
if($qtyB<=$qtyA){
	$tamount=$qtyA-$qtyB;
}
			if($qtyB>=$qtyA){
	$tamount=$qtyB-$qtyA;
}
		
				
				
					$sql1 ="SELECT * FROM price WHERE code ='$code'";
		           $result = $conn->query($sql1);

             if ($result->num_rows > 0) {
             // output data of each row
            while($row = $result->fetch_assoc()) {
    
	         $unit_cost= $row["unit_cost"];
	         $size= $row["size"];
	
	}
			
}
				

			if($qtyB<=$qtyA)
						{
						     	$sql1 = "UPDATE usages
				SET invoice_number='$Invoice_Number', usagedate='$Usagedate', purpose='$Purpose'
				WHERE id=".$id;
				
			//	echo $sql1;
						
		if($conn->query($sql1) === TRUE)
		{
			
			
			echo "Updated successfully";
		
						$updateqty=$qtyA-$qtyB;
							
							$cost=$updateqty*$unitcost;
							
							$sql1 = "UPDATE $location
						SET instock=instock+$updateqty,cost=cost+$cost
						WHERE id='$stock_id'";
						
								if($conn->query($sql1) === TRUE)
				{
				
					}		
					
								$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost-$cost,req_by='$jname',qty=qty-$updateqty,created_at= '".$Usagedate."'
						WHERE id=".$item_objects[$x]['sid'];
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
							
						
					}
							
					}
						}
else{
			
		$updateqty=$qtyB-$qtyA;
	if($updateqty<=$instock){
	$cost=$updateqty*$unitcost;	
		
		
			$sql1 = "UPDATE usages
				SET invoice_number='$Invoice_Number', usagedate='$Usagedate', purpose='$Purpose'
				WHERE id=".$id;
				
		$result = $conn->query($sql1);
		
		
		
							
							$sql1 = "UPDATE $location
						SET instock=instock-$updateqty,cost=cost-$cost
						WHERE id=".$stock_id;
						if($conn->query($sql1) === TRUE)
				{
				
					
		
					
								$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",cost=cost+$cost,req_by='$jname',qty=qty+$updateqty,created_at= '".$Usagedate."'
						WHERE id=".$item_objects[$x]['sid'];
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
				echo "Updated successfully\n";
					}		
		}	
		
	}else

			{
				
				echo "Cannot update that Amount: $tamount  Instock: $instock";
			}
							
							
	
}
			
			 
			if($spoilB<=$spoilA)
						{
							
						$updatespoil=$spoilA-$spoilB;
							
							$spcost=$updatespoil*$unitcost;		
					
								$sql = "UPDATE usage_lineitems
						SET spoilcost=spoilcost-$spcost,spoilage=spoilage-$updatespoil, updated_at='$updated_at'
						WHERE id=".$item_objects[$x]['sid'];
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
					}
							
					}
else{
			
		$updatespoil=$spoilB-$spoilA;
							
							$spcost=$updatespoil*$unit_cost;		
					
								$sql = "UPDATE usage_lineitems
						SET stock_id=".$item_objects[$x]['Stock_ID'].",spoilcost=spoilcost+$spcost,spoilage=spoilage+$updatespoil, updated_at= '".$updated_at."'
						WHERE id=".$item_objects[$x]['sid'];
					//echo "[".$sql."]";			
				if($conn->query($sql) === TRUE)
				{
					}	
	
}
				

				
					 $info="Quantity: $tamount Cost:$  $cost Spoilage: $updatespoil Spoilcost: $spcost ";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$stock_id','$info','$created_at')";
			
         if ($conn->query($sqltr) === TRUE) {
         	$uid = mysqli_insert_id($conn);
           //$mess="Trace user  ";
	       //echo "$mess $username  $userid";
           } else 
           {
              echo "Error1: " . $sqltr . "<br>" . $conn->error;
           }
					
			
			
			
		
		}		
		
		}}


function CreateStock()
{
	//variables
	$sql = "";
	$BOX = "";
	$Reams = "";
	$Singles = "";
	$Type ="";
	$created_at = date("Y-m-d h:i:s");
	$updated_at = date("Y-m-d h:i:s");
	
			
	//Checking for the presents of the required variables  -Imani Syerling|| 2018
	if(isset($_POST["type"]))
	{
		$box = $_POST["box"]; 
		$reams = $_POST["reams"]; 
		$singles = $_POST["singles"];
		$name = $_POST["name"];

	}
	
/*	$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name =  "ssjlinve_inventorysystem";*/
					
	// Create connection to database
	//$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);								
	$tbox=5000*$box+$reams+$singles;
	$sql ="SELECT * FROM fields WHERE name=".$type;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
	$fieldid= $row["id"];

   $updated_at = date("Y-m-d h:i:s");
	
	$sql = "INSERT INTO stocks(field_id,name,instock,created_at)
	VALUES ('$fieldid', '$name','$tbox','$updated_at')";
echo $sql;
if ($conn->query($sql) === TRUE) {
   $mess="New record created successfully";
	return $mess;
   

  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
	
	
	}
} else {
    echo "0 results";
}
	


	
			

	

		
	
		
		$conn->close();
	
	
	}










/** -Imani Syerling|| 2018
*	@Discription:	Requets from the server the default formated infromation in the Inventory table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Generate_Inventory_table()
{  
	//Create SQL string -Imani Syerling|| 2018
	$sql = "SELECT stocks.id, fields.name as type, stocks.name, stocks.p1, stocks.p2, stocks.p3, stocks.small,stocks.large,stocks.papersize,stocks.sheet1,stocks.sheet2, stocks.instock, stocks.reorderlevel, stocks.cost
		    FROM stocks
			INNER JOIN fields
			ON stocks.field_id=fields.id ";

	$formatted_result=""; //Will be used to contain the result of the formatted SQL query -Imani Sterling|| 2018
	
	
	//If the individual is searching for specific vendors  -Imani Sterling|| 2018
	if(isset($_REQUEST["search_value"]))
	{
		$search_value=$_REQUEST["search_value"];
		$sql=$sql." WHERE stocks.name LIKE '".$search_value."%'";
	}
	
	/*if(isset($_REQUEST["search_start_date"]) && isset($_REQUEST["search_end_date"]))
	{
		if(($_REQUEST["search_start_date"]!="") && ($_REQUEST["search_end_date"]!=""))
		{
			$sql=$sql." and usagedate BETWEEN '".$_REQUEST["search_start_date"]."' and '".$_REQUEST["search_end_date"]."'";
		}
	}*/
	
	$sql=$sql." ORDER BY stocks.id DESC";
	
	//echo "[".$sql."]";
					
					
	// Create connection to database
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		//echo "Connected successfully<br/>";
		//echo $sql;		
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
				$data_row_item_formatted = '
											<tr id="Listing_row_'.$row["id"].'">
												<td>'.$row["id"].'</td>
												<td>'.$row["type"].'</td>
												<td>'.$row["name"].'</td>
												<td>'.$row["p1"].'</td>
												<td>'.$row["small"].'</td>
												<td>'.$row["large"].  ' &nbsp &nbsp'.$row["papersize"].'</td>
												<td>'.$row["sheet1"].'</td>
												<td>'.$row["sheet2"].'</td>
												<td>'.$row["instock"].'</td>
												<td>'.$row["reorderlevel"].'</td>
												<td>'.'$'.$row["cost"].'</td>
											
											
												<td class="text-center">';
												
												
				if($GLOBALS['role']>0 && $GLOBALS['role']<2)
				{								
					$data_row_item_formatted.= '<a href="#" class="btn btn-danger btn-md button_style_addon" style="border-radius: 5px;" onClick="Remove_Usage('.$row["id"].');"><span class="glyphicon glyphicon-remove"></span> Del</a> ';
				}
				
				$data_row_item_formatted.= '	</td>
											</tr>
										   ';
										   
				$formatted_result=$formatted_result.$data_row_item_formatted;
			}
			$conn->close();
		}
		else
		{
				//echo "0 results";
				//$this->failed = true;
				$conn->close();
				//$this->logout();
		}
	}

	return $formatted_result;
}



/** -Imani Sterling|| 2018
*	@Discription:	Remove the given stock itm from the stocks
*	
*	@param (void)
*
*	@return (void)
*/
function Remove_Stock()
{
	//Create SQL string -Imani Sterling|| 2018
	$sql = "";
	$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();
$sid = $Session_Manager->get_custom_SID();
//echo "[".$_SESSION[$sid]['userid']."]";

$username=$_SESSION[$sid]['username'];
$action="Delete Stock";
$userid = $_SESSION[$sid]['userid'];
$created_at = date("Y-m-d h:i:s");
	
	//Get the id of the usage being deleted  -Imani Sterling|| 2018
	if(isset($_GET["id"]))
	{
			
		$id = $_GET["id"];
		$location = $_GET["location"];
		
		
			
		
		$sql = "DELETE FROM $location WHERE id=".$id;
		//echo "[".$sql."]";
	}
	
		$sql1="SELECT * FROM $location  WHERE id='$id'"; 		
		
		$conn = new mysqli($GLOBALS['db_servername'], $GLOBALS['db_username'], $GLOBALS['db_password'], $GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		
				$result = $conn->query($sql1);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
			                                  
               $type=$row["type"];
				$name=$row["name"];
			
			    $instock=$row["instock"];
				$cost=$row["cost"];
			    }
}
		        $purpose="Item $name Type: $type instock: $instock Cost:$  $cost";
		      $sqltr = "INSERT INTO user_action(user_id,user,action,data,purpose,created_at)
	          VALUES ('$userid','$username','$action','$id','$purpose','$created_at')";
			  
			  	 if ($conn->query($sqltr) === TRUE) {
  
} else {
    echo "Error3: " . $sqltr . "<br>" . $conn->error;
}	
			
		
						
		if ($conn->query($sql) === TRUE)
		{
			echo "Record deleted\n";
		}
		else
		{
			echo "Error deleting record: " . $conn->error;
		}
		$conn->close();
	}
}


//_____________________________________________________________[Action scripts]____________________________________________________________________

//Limit access to SQL by only respnding to named queries only

if(isset($_REQUEST["Query"]))
{
	$Query = $_REQUEST["Query"];
	
	switch ($Query)
	{
		case "Receival_default":
			$response_table = Generate_Receival_table();
			echo $response_table;
			break;
			
		case "Stock_in_Type":
			$response_table = Generate_Stock_in_Type();
			echo $response_table;
			break;
			
			
			case "Stock_in_Types":
			$item = Generate_Stock_in_Types();
			echo $item;
			break;
			
			
			case "Stock_in_office":
			$item = Generate_Stock_in_office();
			echo $item;
			break;
			
			
				case "Stock_in_events":
			$item = Generate_Stock_in_events();
			echo $item;
			break;
			
			
			
		case "Add_Recieval":
			Add_Recieval();
			break;
			
		case "Add_price":
			Add_price();
			break;
				
		
				
		case "Basic_Receival_info":
		$response_table = Basic_Receival_info();
			echo $response_table;
			break;
			
			case "Remove_price":
			Remove_price();
			break;
			
		case "Basic_Receival_price":
			$response_table = Basic_Receival_price();
			echo $response_table;
			break;
			
				
		case "Basic_warehouse":
			$response_table = Basic_warehouse();
			echo $response_table;
			break;
			
		case "Get_Receival_line_items_JSON":
			$response_table = Get_Receival_line_items_JSON();
			echo $response_table;
			break;
			
		case "Usage_default":
			$response_table = Generate_Usage_table();
			echo $response_table;
			break;
			
		case "Remove_Receival_line_item":
			Remove_Receival_line_item();
			break;
			
			case "Del_Receival":
			Del_Receival();
			break;
			
			case "Remove_Receival":
			Remove_Receival();
			break;
			
		case "Update_Recieval":
			Update_Recieval();
			break;
			
			case "Update_price":
			Update_price();
			break;
			
			case "Update_warehouse":
			//Update_all();
				Update_warehouse();
			break;
			
		case "Add_Usage":
			Add_Usage();
			break;
			
		case "Remove_Usage":
			Remove_Usage();
			break;
			
			case "Del_Usage":
			Del_Usage();
			break;
			
		case "Basic_Usage_info":
			$response_table = Basic_Usage_info();
			echo $response_table;
			break;
			
			
			
		case "Get_Usage_line_items_JSON":
			$response_table = Get_Usage_line_items_JSON();
			echo $response_table;
			break;
			
		case "Remove_Usage_line_item":
			Remove_Usage_line_item();
			break;
			
		case "Update_Usage":
			Update_Usage();
			break;
			
		case "Inventory_default":
			$response_table = Generate_Inventory_table();
			echo $response_table;
			break;
			
		case "Remove_Stock":
			Remove_Stock();
			break;

		default:
			echo "No such query could be found";
	}
}
}

else{
	echo " Access Forbiden";
}
//echo "<br/>STOP - Server running";
?>
