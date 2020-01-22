<?php
include 'reorder.php';
session_start();
require 'db.php';
include 'lnav.php';
error_reporting(E_ALL & ~E_NOTICE);

$dir="";
require_once($dir."classes/Session_Manager.php");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();



    $username = $_SESSION['username'];

            
					$Session_Manager = new Session_Manager();
					$sid = $Session_Manager->get_custom_SID();
				    $role = $_SESSION[$sid]['role'];
						 $name = $_SESSION[$sid]['name'];
				
					
					
				

?>
<!--

-->
<!DOCTYPE html>
<html>
    <head>
    	
    	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
                    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
                    <meta name="author" content="Coderthemes">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
                    <link rel="shortcut icon" href="assets/images/creat.ico">
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->

<link href="css/font-awesome.css" rel="stylesheet"> 


<script src="js/bootstrap.min.js"> </script>

<link href="css/bootstrap-3.3.6-dist/css/bootstrap.css" rel='stylesheet' type='text/css' />
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script src="https://w3resource.com/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-tooltip.js"></script>
<script src="https://w3resource.com/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-popover.js"></script>

<script src="js/validator.js"></script>

 <!-- DataTables -->
        <link href="../plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />


<!-- Custom Theme files -->
                    <title>Events Internal PO</title>

                    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
                    <link href="../plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />

                    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">

                    <script src="assets/js/modernizr.min.js"></script>
                    <script src="js/scripts(Tredlabs).js"></script>
                   
  
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>

 <script>


function reorder(){
	var reorder='<?php echo $reorder;?>';
	var instock='<?php echo $instock;?>';
	var name='<?php echo $pname;?>';
	var item='<?php echo $item;?>';
	var type='<?php echo $type;?>';
	 
	if(instock<reorder )
	{
	//alert('test');
  var alerted = localStorage.getItem('alerted')|| '';
		    if (alerted != 'yes') {
		alert(type+' '+ name+' ' +item+" is below Reorder Level Instock: " +instock  + alerted);
	localStorage.setItem('alerted','yes');
	var mess= type+' '+ name+' ' +item+" is below Reorder Level Instock: " +instock;
	var sub="Reorder"+type+' '+ name+' ' +item;
	sendMail(mess,sub);
	//localStorage.setItem('status','yes');
	}
	
	}
	else{
		//localStorage.clear();
		localStorage.removeItem('alerted');
	}
	
		//status=0;
	
	
	
}

$(function()
{
	$(function()
	{
    	$( "#search_start_date" ).datepicker({
            dateFormat:"yy-mm-dd"
         });
		 
		 $( "#search_end_date" ).datepicker({
          dateFormat:"yy-mm-dd"
         });
		 
		 $( "#Recdate" ).datepicker({
           dateFormat:"yy-mm-dd"
         });
         
          $( "#Recdate1" ).datepicker({
           dateFormat:"yy-mm-dd"
         });
		 
		 
		 $( "#Recdate_Edit" ).datepicker({
            dateFormat:"yy-mm-dd"
         });
  
     });
});



</script>	


      <script>
	//Global JS variables
	var inline_item_index=0;
	var edit_new_inline_item_index=0;
	
	//Dynamically get all the types
	var type_options = "<?php
							//database connection variables
							$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";  
						
							$sql = "SELECT name FROM fields";
							$formatted_result="";
													
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
										$data_row_item_formatted = '<option>'.$row["name"].'</option>';
										$formatted_result=$formatted_result.$data_row_item_formatted;
									}
									$conn->close();
									echo $formatted_result;
								}
								else
								{
									$conn->close();
								}
							}
						?>";
						
						
				var type_option = "<?php
							//database connection variables
							$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";  
						
							$sql = "SELECT name FROM office_type";
							$formatted_result="";
													
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
										$data_row_item_formatted = '<option>'.$row["name"].'</option>';
										$formatted_result=$formatted_result.$data_row_item_formatted;
									}
									$conn->close();
									echo $formatted_result;
								}
								else
								{
									$conn->close();
								}
							}
						?>";		
						
			var type_optione = "<?php
							//database connection variables
							$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";  
						
							$sql = "SELECT name FROM events_type";
							$formatted_result="";
													
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
										$data_row_item_formatted = '<option>'.$row["name"].'</option>';
										$formatted_result=$formatted_result.$data_row_item_formatted;
									}
									$conn->close();
									echo $formatted_result;
								}
								else
								{
									$conn->close();
								}
							}
						?>";	
					</script>
					<script type="text/javascript"> 

	$(function ()
	{
		$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

		if (!screenfull.enabled)
		{
				return false;
		}

		$('#toggle').click(function()
		{
				screenfull.toggle($('#container')[0]);
		});
		
	});
	
	
	/*__________________________________________________________________[Functions]____________________________________________________________*/
	
	/** 
	*		switch between the 3 viewable options on this page
	*	
	*	@param (integer) index - the number that marks the key for that index
	*
	*	@return void
	*/
	function switch_page(index)
	{
		switch (index)
		{
			case 0:
				document.getElementById("Receival_listing").style.display = "block";
				document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
				document.getElementById("Office").style.display = "none";
				Load_Default_Usage_table();
				//loadAds();
				break;
				
			case 1:
				document.getElementById("Enter_Receival").style.display = "block";
				document.getElementById("Receival_listing").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
				document.getElementById("Office").style.display = "none";
				
				break;
				
			case 2:
				document.getElementById("Edit_Receival").style.display = "block";
				document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Receival_listing").style.display = "none";
				document.getElementById("Office").style.display = "none";
				break;
				
				
					case 3:
					document.getElementById("Enter_Receival").style.display = "none";
				document.getElementById("Edit_Receival").style.display = "none";
				document.getElementById("Office").style.display = "block";
				document.getElementById("Receival_listing").style.display = "none";
				break;
				
		}
	}
	
	
	/** 
	*	@Discription:	add a new row for the line item in the purchasing
	*	
	*	@param void
	*
	*	@return void
	*/
	function add_field()
	{
		//alert("Satrt");
		inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select 
		                   	  +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		                   	  
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_fields(this.value, \'field_row_'+inline_item_index+'\'); showqty(this.value, \'field_row_'+inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_options				
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
						   
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_'+inline_item_index+'_stock">'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+inline_item_index+'" style="display:none">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/>'
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_paperspoil" name="paperspoil" type="number" placeholder="Spoil"/>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1"><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								   +'	<br/>';
								   +'	<br/>';
								 +'	</div>';
								 
								
								   
								  
							
								 +''
	
							
		document.getElementById("fields").appendChild(new_line_item);
		size=document.getElementById("field_row_'+inline_item_index+'_stock").value;
	
	
	var loc=document.getElementById("location").value;
		//alert(loc);
		
		if(loc=="Warehouse1"){
			
			inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
	
		                   	  +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_fields(this.value, \'field_row_'+inline_item_index+'\'); showqty(this.value, \'field_row_'+inline_item_index+'\');showqty1(this.value, \'field_row_'+inline_item_index+'\'); showqty2(this.value, \'field_row_'+inline_item_index+'\'); showqty3(this.value, \'field_row_'+inline_item_index+'\'); showqty4(this.value, \'field_row_'+inline_item_index+'\');showqty5(this.value, \'field_row_'+inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_options				
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
							
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_'+inline_item_index+'_stock" required>'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 			//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+inline_item_index+'" style="display:none">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/ required>'
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_unitcost" name="unitcost" type="number" placeholder="Unit Cost"/ required>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1" required><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		document.getElementById("fields").appendChild(new_line_item);
		size=document.getElementById("field_row_'+inline_item_index+'_stock").value;
	
		}
	
	
	
	
	
	}
	
	function add_fields()
	{
		
		var loc=document.getElementById("location").value;
		//alert(loc);
		
		if(loc=="Warehouse1"){
			inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select 
		                   	  +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_fields(this.value, \'field_row_'+inline_item_index+'\'); showqty(this.value, \'field_row_'+inline_item_index+'\');showqty1(this.value, \'field_row_'+inline_item_index+'\'); showqty2(this.value, \'field_row_'+inline_item_index+'\'); showqty3(this.value, \'field_row_'+inline_item_index+'\'); showqty4(this.value, \'field_row_'+inline_item_index+'\');showqty5(this.value, \'field_row_'+inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_options				
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
							
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_'+inline_item_index+'_stock" required>'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 			//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+inline_item_index+'" style="display:none">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/ required>'
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_paperspoil" name="spoil" type="number" placeholder="Spoil"/ required>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1" required><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		document.getElementById("fields").appendChild(new_line_item);
		size=document.getElementById("field_row_'+inline_item_index+'_stock").value;
	
		}
		if(loc=="Warehouse2"){
			inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select 
		                   	  +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_office(this.value, \'field_row_'+inline_item_index+'\'); showqty(this.value, \'field_row_'+inline_item_index+'\');showqty1(this.value, \'field_row_'+inline_item_index+'\'); showqty2(this.value, \'field_row_'+inline_item_index+'\'); showqty3(this.value, \'field_row_'+inline_item_index+'\'); showqty4(this.value, \'field_row_'+inline_item_index+'\');showqty5(this.value, \'field_row_'+inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_option			
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
							
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_'+inline_item_index+'_stock" required>'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 			//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+inline_item_index+'" style="display:none">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/ required>'
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_paperspoil" name="spoil" type="number" placeholder="Spoil"/ required>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1" required><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		document.getElementById("fields").appendChild(new_line_item);
		size=document.getElementById("field_row_'+inline_item_index+'_stock").value;
	
		}
		
		
		
		if(loc=="Warehouse3"){
			inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select 
		                   	  +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_events(this.value, \'field_row_'+inline_item_index+'\'); showqty(this.value, \'field_row_'+inline_item_index+'\');showqty1(this.value, \'field_row_'+inline_item_index+'\'); showqty2(this.value, \'field_row_'+inline_item_index+'\'); showqty3(this.value, \'field_row_'+inline_item_index+'\'); showqty4(this.value, \'field_row_'+inline_item_index+'\');showqty5(this.value, \'field_row_'+inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_optione			
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
							
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_'+inline_item_index+'_stock" required>'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 			//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+inline_item_index+'" style="display:none">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/ required>'
								   +'			<input class="form-control" id="field_row_'+inline_item_index+'_paperspoil" name="spoil" type="number" placeholder="Spoil"/ required>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1" required><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
						 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		document.getElementById("fields").appendChild(new_line_item);
		size=document.getElementById("field_row_'+inline_item_index+'_stock").value;
	
		}
		
		
		//alert("Stop");
	}
	
	
	
	
	
	/** 
	*	@Discription:	Populate teh stock field of the inline item in the row specificed by the inline_item_id
	*	
	*	@param (String) stock_type - The type of stock to be query to get the available stock
	*	@param (String) inline_item_id - ID attribute of the iline item
	*
	*	@return (void)
	*/
	
	
	
	function edit_new_add_fields()
	{
		
		var loc=document.getElementById("location_edit").value;
		//alert(loc);
		
		if(loc=="Printery"){
		//alert("Satrt");
		edit_new_inline_item_index=edit_new_inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_new_field_row_"+edit_new_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								   +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="edit_new_field_row_'+edit_new_inline_item_index+'_Type" name="Type" onChange="get_stock_fields1(this.value, \'edit_new_field_row_'+edit_new_inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_options				
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
							
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="edit_new_field_row_'+edit_new_inline_item_index+'_stock" required>'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 
			
		
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	 
								
								  
						
							 						//This is the input for Envelope usageage spoilage amount this has 2 input	
						
								
 		 			
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+edit_new_inline_item_index+'" style="display:block">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="edit_new_field_row_'+edit_new_inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/ required>'
								   +'			<input class="form-control" id="edit_new_field_row_'+edit_new_inline_item_index+'_unitcost" name="unitcost" type="number" placeholder="Spoil"/ required>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1" required><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
					
								 
								 	 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Clear</span></button>'
								 +'	</div>';
							 
							 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		
			
		document.getElementById("new_fields_Edit").appendChild(new_line_item);
		//alert("Stop");
	}
	
	if(loc=="Office"){
		//alert("Satrt");
		edit_new_inline_item_index=edit_new_inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_new_field_row_"+edit_new_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								   +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="edit_new_field_row_'+edit_new_inline_item_index+'_Type" name="Type" onChange="get_stock_office1(this.value, \'edit_new_field_row_'+edit_new_inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_option			
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
							
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="edit_new_field_row_'+edit_new_inline_item_index+'_stock" required>'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 
			
		
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	 
								
								  
						
							 						//This is the input for Envelope usageage spoilage amount this has 2 input	
						
								
 		 			
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+edit_new_inline_item_index+'" style="display:block">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="edit_new_field_row_'+edit_new_inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/ required>'
								   +'			<input class="form-control" id="edit_new_field_row_'+edit_new_inline_item_index+'_unitcost" name="unitcost" type="number" placeholder="Spoil"/ required>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1" required><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
					
								 
								 	 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Clear</span></button>'
								 +'	</div>';
							 
							 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		
			
		document.getElementById("new_fields_Edit").appendChild(new_line_item);
		//alert("Stop");
	}
	
	
	if(loc=="Events"){
		//alert("Satrt");
		edit_new_inline_item_index=edit_new_inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_new_field_row_"+edit_new_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								   +'<hr style="height: 1px; width: 100%; background-color: #999999;"/>'
		                   	  +'<br/>'
		               
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="edit_new_field_row_'+edit_new_inline_item_index+'_Type" name="Type" onChange="get_stock_events1(this.value, \'edit_new_field_row_'+edit_new_inline_item_index+'\');">'
								
								 +'				<option  value=""  disabled selected  >Type</option>'
								 +'				'+type_optione				
								 +'			</select>'  
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
							
								    
								 +'	<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="edit_new_field_row_'+edit_new_inline_item_index+'_stock" required>'
								 +'					<option value="" disabled selected>Stock</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 
								 
			
		
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	 
								
								  
						
							 						//This is the input for Envelope usageage spoilage amount this has 2 input	
						
								
 		 			
								//This is the input for printedform usageage quantity amount this has 2 input sheet1 and sheet 2	
								 		 +'<div class="col-md-2 custyle" id="qtysheet2_input_field_row_'+edit_new_inline_item_index+'" style="display:block">'
								 +'		<div class="input-group">'
								
								 
								   +'			<input class="form-control" id="edit_new_field_row_'+edit_new_inline_item_index+'_papersheet" name="papersheet" type="number" placeholder="Quantity"/ required>'
								   +'			<input class="form-control" id="edit_new_field_row_'+edit_new_inline_item_index+'_unitcost" name="unitcost" type="number" placeholder="Spoil"/ required>'
								     +'		<!--	<label for="sel1"></label><select class="form-control" id="sel1" required><option value="" disabled selected>Location:</option><option>Warehouse1</option><option>Warehouse2</option><option>Warehouse3</option></select>-->'
								  +'		</div>'
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								 
			
					
								 
								 	 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Clear</span></button>'
								 +'	</div>';
							 
							 
								  +'	</br>';
								   +'	</br>';
								   
								  
							
								 +''
	
							
		
			
		document.getElementById("new_fields_Edit").appendChild(new_line_item);
		//alert("Stop");
	}
	
	
	
	
	
}
	
	function get_stock_office(stock_type, inline_item_id)
	{
		//alert(stock_type);
		///alert(inline_item_id);
		//Variables
		var location=document.getElementById('location').value;
		//alert(location);
		var Options;
		var xhttp = new XMLHttpRequest();
		inline_item_id+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(inline_item_id).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_office&Type="+stock_type+"&location="+location, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	}
	
	function get_stock_events(stock_type, inline_item_id)
	{
		//alert(stock_type);
		///alert(inline_item_id);
		//Variables
		var location=document.getElementById('location').value;
		//alert(location);
		var Options;
		var xhttp = new XMLHttpRequest();
		inline_item_id+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(inline_item_id).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_events&Type="+stock_type+"&location="+location, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	}
	
	function get_stock_events1(stock_type, edit_new_inline_item_index)
	{
	
		var location=document.getElementById('location_edit').value;
		if(location=="Printery"){
			location="Warehouse1";
		}
			if(location=="Office"){
			location="Warehouse2";
		}
			if(location=="Events"){
			location="Warehouse3";
		}
		
		var Options;
		var xhttp = new XMLHttpRequest();
		edit_new_inline_item_index+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(edit_new_inline_item_index).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_events&Type="+stock_type+"&location="+location, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	}
	
	
	function get_stock_office1(stock_type, edit_new_inline_item_index)
	{
	
		var location=document.getElementById('location_edit').value;
		if(location=="Printery"){
			location="Warehouse1";
		}
			if(location=="Office"){
			location="Warehouse2";
		}
			if(location=="Events"){
			location="Warehouse3";
		}
		
		var Options;
		var xhttp = new XMLHttpRequest();
		edit_new_inline_item_index+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(edit_new_inline_item_index).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_events&Type="+stock_type+"&location="+location, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	}
	
	
	
	
	
	function get_stock_field(stock_type, inline_item_id)
	{
		//alert(stock_type);
		///alert(inline_item_id);
		//Variables
		var Options;
		var xhttp = new XMLHttpRequest();
		inline_item_id+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(inline_item_id).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_Type&Type="+stock_type, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	} 
	
	function get_stock_fields(stock_type, inline_item_id)
	{
		//alert(stock_type);
		///alert(inline_item_id);
		//Variables
		var location=document.getElementById('location').value;
		//alert(location);
		var Options;
		var xhttp = new XMLHttpRequest();
		inline_item_id+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(inline_item_id).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_Types&Type="+stock_type+"&location="+location, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	}
	
		function Create_Receival(validated)
	{
		//kill function if failure to validate
		if(validated == false)
		{
			return false
		}
		//Variables
		var Invoice_Number = document.getElementById("Invoice_Number").value;
	  
		//alert(job_id);
		var Recdate = document.getElementById("Recdate").value;
		var location = document.getElementById("location").value;
		localStorage.setItem('location',location);
		
		var jname = document.getElementById("jname").value;
		var Purpose = document.getElementById("Purpose").value;
	//	var Equipment = document.getElementById("Equipment").value;
		//var id="field_row_'+inline_item_index+'_stock";
	
    //    var size = document.getElementById(id).value;

		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Gavin Palmer || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016

		
		//Take all the values of the inline items rows and store the rows individually in objects  -Gavin Palmer || March 2016
		//Firstly find each inline item row by id of the row
		$('div[id^="field_row_"]').each(function()
		{
			
		var Type = $("#"+this.id+"_Type").val();
		
			
			//Secnding store the fields of the rows in variables to be added to the object
			var Stock_ID = $("#"+this.id+"_stock").val();
            var sid=Stock_ID;
			localStorage.setItem('sid',sid);
		
			
	
			
			var quantity = $("#"+this.id+"_papersheet").val();//tHIS IS for the paper 
            var spoil = $("#"+this.id+"_paperspoil").val();//tHIS IS for the paper 

			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			//var Inline_item = {}; 
			Inline_item["Stock_ID"] = Stock_ID;

			Inline_item["Type"] = Type;
			Inline_item["quantity"] = quantity;
			Inline_item["spoil"] = spoil;
		
			
			//Thirdly, add the object to the already existing array of objects
			Inline_items.push(Inline_item);
		});
		
		//Stringyfy array of inline items to be passed to the servers as one variable
		var Inline_items_Sringyfied = JSON.stringify(Inline_items);
		
		
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
					var result=xhttp.responseText;
			
					$('#Message').delay(5000).fadeOut(400)
					if (result.match(/You have exceeded stock amount.*/)) {
                        //alert('match');
                        //switch_page(1);
                       }
                        if (result.match(/Internal PO Created.*/)) {
                    		
					/*document.getElementById("Invoice_Number").value="";
					document.getElementById("Recdate").value="";
					document.getElementById("location").value="";
		
					document.getElementById("fields").innerHTML = "";*/
					document.getElementById("Message").innerHTML = xhttp.responseText;
                       	var sid=localStorage.getItem('sid');
                       	
                       	Rtest(sid,location);
                        reload();
                       	
                      }
                      else{} 	
                       }
				else
				{
					//alert(xhttp.responseText);
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
			xhttp.open("POST", "php/Query_Manager.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		xhttp.send("Query=Add_Usage&Invoice_Number="+Invoice_Number+"&Recdate="+Recdate+"&location="+location+"&jname="+jname+"&Purpose="+Purpose+"&Inline_items="+Inline_items_Sringyfied);
		//alert(Inline_items_Sringyfied );
		//alert("End"); 
	}
	

	/** 
	*	@Discription:	Remove the receival from the receival listing by id number
	*	
	*	@param (int) id - The id number of the receival
	*
	*	@return (void)
	*/
	function Remove_Usage(row,id)
	{
		//alert(id);
		
				
	var xhttp1 = new XMLHttpRequest();

	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
						
					}
					else{
						//alert(xhttp1.responseText);
						var location=xhttp1.responseText;
						
						localStorage.setItem('location',location);
						
						}
				
					
				}
				else
				{
					//alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&location="+id);
	

		var xhttp = new XMLHttpRequest();
		
		//Confirm before action is taken
		var action = confirm("Are you sure?");
		
		if(action==false)
		{
			return false;
		}
		
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
				
					document.getElementById("Receival_listing_Message").innerHTML = xhttp.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+row).delay(1000).fadeOut(400);
					document.getElementById("Message1").innerHTML = xhttp.responseText;
					$('#Message1').delay(5000).fadeOut(400)
						var loc=localStorage.getItem('location');
					Rtest(id,loc);
					
					//reload();
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Usage&id="+id, true);
		xhttp.send();
		//alert("stop");
	}
	
	  	function Del_Usage(id)
	{
		//alert(id);
		


		var xhttp = new XMLHttpRequest();
		
		//Confirm before action is taken
		var action = confirm("Are you sure?");
		
		if(action==false)
		{
			return false;
		}
		
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
				
					document.getElementById("Receival_listing_Message").innerHTML = xhttp.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+row).delay(1000).fadeOut(400);
					document.getElementById("Message1").innerHTML = xhttp.responseText;
					$('#Message1').delay(5000).fadeOut(400)
						//var loc=localStorage.getItem('location');
					//Rtest(id,loc);
					
					//reload();
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Del_Usage&id="+id, true);
		xhttp.send();
		//alert("stop");
	}
	
	  
	  
	  
	function get_fields()
	{
		//alert("Satrt");
		inline_item_index=inline_item_index+1;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="field_row_"+inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
								 +'<div class="col-md-4 custyle">'
								 
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								 +'			<select class="form-control equipment_type" id="field_row_'+inline_item_index+'_Type" name="Type" onChange="get_stock_field(this.value, \'field_row_'+inline_item_index+'\')get_stock_fields(this.value, \'field_row_'+inline_item_index+'\')">'
								 +'				<option  value="" disabled selected>Type</option>'
								 +'				'+type_options				
								 +'			</select>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-4 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="field_row_'+inline_item_index+'_stock">'
								 +'					<option value="" disabled selected>Stock1</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-2 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-scale"></span>'
								 +'			</div>'
								 +'			<input class="form-control" id="field_row_'+inline_item_index+'_quantity" name="Quantity" type="number" placeholder="Quantity"/>'
								 +'		</div>'
								 +'	</div>'
								 +'	<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Remove</span></button>'
								 +'	</div>';
								 +' <br/>'
								 +''
			
		document.getElementById("fields").appendChild(new_line_item);
		//alert("Stop");
	}
	
	
	/** -Gavin Palmer || March 2016
	*	@Discription:	bring up edit usage page
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Show_Edit_Usage(id)//This loads the  usage edit form 
	{
		//alert(id);
		//Variables
		
		
		//Switch views to show the receival page 
		
		
		//Get and display basic receival information 
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(id);
					//alert(xhttp.responseText);
					var receival_object = JSON.parse(xhttp.responseText);
									
 if (receival_object.location=="Warehouse1"){
 	receival_object.location="Printery";
 }
 if (receival_object.location=="Warehouse2"){
 	receival_object.location="Office";
 }
 if (receival_object.location=="Warehouse3"){
 	receival_object.location="Events";
 }
	
					var job = document.getElementById('job_id_Edit').value =id;
                
               //  localStorage.setItem('job',job);
					document.getElementById('Invoice_Number_Edit').value = receival_object.Invoice_Number;
					document.getElementById('ID_Number_Edit').value = id;
					document.getElementById('Recdate_Edit').value = receival_object.Usagedate;
					
					document.getElementById('Purpose_Edit').value = receival_object.Purpose;
					document.getElementById('Equipment_Edit').value = receival_object.Equipment;
					document.getElementById('location_edit').value = receival_object.location;
					document.getElementById('jname_edit').value = receival_object.jname;
					
					 //alert(job);
		var xhttp_line_items = new XMLHttpRequest();
		
		xhttp_line_items.onreadystatechange = function()
		{
			if(xhttp_line_items.readyState == 4)
			{
				if(xhttp_line_items.status == 200)
				{
				
					document.getElementById('fields_Edit').innerHTML = ""; //Clear the section of the page before writing to it
					var line_item_objects = JSON.parse(xhttp_line_items.responseText);
					
					for (a = 0; a < line_item_objects.length; a++)
					{
						Edit_add_field(a, line_item_objects[a].id, line_item_objects[a].item,line_item_objects[a].stock_id,line_item_objects[a].qty, line_item_objects[a].spoilage, line_item_objects[a].equip,line_item_objects[a].usage_id, line_item_objects[a].size); 
					//alert(line_item_objects[a].equip);
					}
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp_line_items.open("GET", "php/Query_Manager.php?Query=Get_Usage_line_items_JSON&id="+id, true);
		xhttp_line_items.send();
					switch_page(2);
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
    xhttp.open("GET", "php/Query_Manager.php?Query=Basic_Usage_info&id="+id, true);
		xhttp.send();
			
	    //var job=localStorage.getItem('job');
		//Get and display basic receival information -Gavin Palmer || March 2016
		//alert(job1);
		
		
		
		//alert('Stop');
	}
	
	
	/** 
	*	@Discription:	add new field for every attemp collected for the receival
	*	
	*	@param void
	*
	*	@return void
	*/
	function Edit_add_field(row_num, id,item, stock_id, qty, spoilage,equip,usage_id,size)
	{
	
			
		//alert("start");
		edit_inline_item_index=row_num;
		//alert(inline_item_index);
		var new_line_item = document.createElement('div');
		new_line_item.id="edit_field_row_"+edit_inline_item_index; //Giving dynamic ID to the row, will be required for the uploading off information
		new_line_item.className ='row';
		new_line_item.innerHTML = ''
		                      
		                       
		                          
		                   // this is the 1st option select
		                     +'	</br>'
		                   	     +'<div id="displaypaper" style="display:block">'
								 +'<div class="col-md-3 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-link"></span>'
								 +'			</div>'
								
								 +'	<select class="form-control equipment_type" id="edit_field_row_'+edit_inline_item_index+'_Type" name="Type">'
								
								 +'				<option value="'+equip+'" selected>'+equip+'</option>'
											
								 +'			</select>'  
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_usageid" name="id" type="hidden" value="'+usage_id+'" placeholder="id"/>'
								 +'	 <input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_id" name="id" type="hidden" value="'+id+'" placeholder="id"/>'
								
								 +'		</div>'
								 +'	</div>'
							
								// this is the 1st option select
								
								 
								    
								 +'	<div class="col-md-4 custyle">'
								 +'		<div class="input-group">'
								 +'			<div class="input-group-addon">'
								 +'				<span class="glyphicon glyphicon-shopping-cart"></span>'
								 +'			</div>'
								 +'		<div class="grouped_select required receival_rec_lineitems_stock_id">'
								 +'			<select class="grouped_select required form-control Stocks" name="Stocks" id="edit_field_row_'+edit_inline_item_index+'_stock">'
									 +'					<option value="'+stock_id+'" selected>'+item+'</option>'
								 +'			</select>'
								 +'		</div>'
								 +'		</div>'
								 +'	</div>'
								
							
								 		 +'<div class="col-md-2 custyle">'
								 +'		<div class="input-group" id="qtysheet2_input_field_row_'+edit_inline_item_index+'">'
								 +'			<div class="input-group-addon">Qty'
								 +'				<span class=""></span>'
								 +'			</div>'
								 
								 +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_paperqty" name="qty" type="number" value="'+qty+'"placeholder="Quantity"/>'

								  +'		</div>'
								  
								  
								  
								  
								  
								   +'		<div class="input-group" id="qtysheet2_input_field_row_'+edit_inline_item_index+'">'
								 +'			<div class="input-group-addon">Spoil'
								 +'				<span class=""></span>'
								 +'			</div>'
								 

								  +'			<input class="form-control" id="edit_field_row_'+edit_inline_item_index+'_paperslp" name="spl" type="number" value="'+spoilage+'"placeholder="Spoilage"/>'
								  +'		</div>'
								
								
						
								  +'		</div>'
								 +'	</div>'
								 +'	</div>'
								   
								   +'<div class="col-md-2 custyle">'
								 +'		<button type="button" class="btn btn-danger Remove_field_button" style="border-radius: 10px;" onClick="this.parentNode.parentNode.remove();Del_Usage('+id+');"> <span class="glyphicon glyphicon-remove-sign">&nbsp;Del</span></button>'
								 +'	</div>'
							
								 +''
			
		document.getElementById("fields_Edit").appendChild(new_line_item);
		
		
		
	
		
	
			
		
		
		
	}
	
	
	/** 
	*	@Discription:	add a new row for the line item in the usage that is being added
	*	
	*	@param void
	*
	*	@return void
	*/

	
	/** 
	*	******************@Discription:	Remove the receival  line item from the receival listing by id number
	*	
	*	@param (int) id - The id number of the receival line item
	*
	*	@return (void)
	*/
	function Remove_Receival_line_item(row, id)
	{
		alert("start");
		//Variables
		var xhttp = new XMLHttpRequest();
		
		//Confirm before action is taken
		var action = confirm("Are you sure this line item from the record?");
		
		if(action==false)
		{
			return false;
		}
		
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
					document.getElementById("Receival_listing_Message").innerHTML = "Receival deleted";
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#edit_field_row_'+row).delay(500).fadeOut(400);
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Usage_line_item&id="+id, true);
		xhttp.send();
		//alert("stop");
	}


	/** 
	*	@Discription:	Collect and send of sets of information required to update the receival information
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	
	function stock(sid){
	var sid=sid;
	alert(sid);
	localStorage.setItem('sid',sid);
}
function loc(){
	var location =document.getElementById("location").value;

	//alert(location);
	
	if (location=="Warehouse1")
	{
		
		
		//document.getElementById("location").value=location;
		//document.getElementById("Invoice_Number").placeholder="Job #";
		//document.getElementById("jname1").style.display="block";
		
	}
	
	
	
	if (location=="Warehouse2")
	{
		//document.getElementById("Invoice_Number").placeholder="Item Id";
		// document.getElementById("jname1").style.display="none";
		//switch_page(3);
		
	}
	
		if (location=="Warehouse2")
	{
		
		
	//	document.getElementById("location").value=location;
		
	}
	
}






	function Rtest1(id) //This is the function to remove the receivals for the Receival Tabel
	{
	//alert(id);

			var xhttp1 = new XMLHttpRequest();
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					//alert(xhttp1.responseText);
					if(xhttp1.responseText==""){
						
					}
					else{
						alert(xhttp1.responseText);
							document.getElementById("Receival_listing_Message").innerHTML =xhttp1.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
						
						}
				
				}
				else
				{
					//alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&id="+id);
	}


	
		function Rtest(sid,location) //This is the function to remove the receivals for the Receival Tabel
	{
	
//alert('start');
			var xhttp1 = new XMLHttpRequest();
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
						
					}
					else{
						alert(xhttp1.responseText);
						}
					
					document.getElementById("Receival_listing_Message").innerHTML =xhttp1.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+row).delay(1000).fadeOut(400);
					//reorder();
				//	reload();
				}
				else
				{
					//alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&sid="+sid+"&loc="+location);
	}

function Rtest2(id) //This is the function to remove the receivals for the Receival Tabel
	{

			var xhttp1 = new XMLHttpRequest();
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
						
					}
					else{
						alert(xhttp1.responseText);
						}
				
					reload();
				}
				else
				{
					//alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&location="+id);
	}
	
	function Update_Usage(validated)
	{
		//kill function if failure to validate
		if(validated == false)
		{
			return false
		}
		//alert("Start - Update_Usage()");
		//Variables
		var ID = document.getElementById("ID_Number_Edit").value;
		var Invoice_Number = document.getElementById("Invoice_Number_Edit").value;
		var Usagedate = document.getElementById("Recdate_Edit").value;
		var Purpose = document.getElementById("Purpose_Edit").value;
		var Equipment = document.getElementById("Equipment_Edit").value;
		var location = document.getElementById("location_edit").value;
		
				if(location=="Printery"){
			location="Warehouse1";
		}
			if(location=="Office"){
			location="Warehouse2";
		}
			if(location=="Events"){
			location="Warehouse3";
		}
		
		
		var jname = document.getElementById("jname_edit").value;
		
		var Inline_items = []; //Array to hold the list of inline items that will be purchase -Gavin Palmer || March 2016
		var Inline_items_Sringyfied = ""; //array of objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016
		var new_Inline_items = []; //Array to hold the list of newly added inline items that will be purchase -Gavin Palmer || March 2016
		var new_Inline_items_Sringyfied = ""; //array of of newly added inline items  objects stringyfied to be passed on to the server  -Gavin Palmer || March 2016
		//alert("after the variables");
		//Take all the values of the inline items rows and store the rows individually in objects  -Gavin Palmer || March 2016
		//Firstly find each inline item row by id of the row
		$('div[id^="edit_field_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			
			var Type = $("#"+this.id+"_Type").val();
			
			var Item_ID = $("#"+this.id+"_usageid").val();
			var sid = $("#"+this.id+"_id").val();

			//var Item = $("#"+this.id+"_item").val();
			var Stock_ID = $("#"+this.id+"_stock").val();
			var Quantity = $("#"+this.id+"_paperqty").val();
			var Spoilage = $("#"+this.id+"_paperslp").val();
			
	//alert(Item_ID);
			
	
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["Item_ID"] = Item_ID;
			//Inline_item["Item"] = Item;
			Inline_item["Stock_ID"] = Stock_ID;
			Inline_item["sid"] = sid;
			
			Inline_item["Quantity"] = Quantity;
			Inline_item["Spoilage"] = Spoilage;
			Inline_item["Type"] = Type;
			
			
			
			//Thirdly, add the object to the already existing array of objects
			Inline_items.push(Inline_item);
			
		});
		
		//Stringyfy array of inline items to be passed to the servers as one variable
		var Inline_items_Sringyfied = JSON.stringify(Inline_items);
		
		
			$('div[id^="edit_new_field_row_"]').each(function()
		{
			//Secnding store the fields of the rows in variables to be added to the object
			var stock = $("#"+this.id+"_stock").val();
			var type = $("#"+this.id+"_Type").val();
			var qty = $("#"+this.id+"_papersheet").val();
			var spoil = $("#"+this.id+"_unitcost").val();
			
			
			//Add the value to the object
			var Inline_item = {}; //Empty Inline Item object
			Inline_item["stock"] = stock;
			Inline_item["type"] = type;
			Inline_item["qty"] = qty;
			Inline_item["spoil"] = spoil;
			
			//Thirdly, add the object to the already existing array of objects
			new_Inline_items.push(Inline_item);
		});
		
		//Stringyfy array of new inline items to be passed to the servers as one variable
		var new_Inline_items_Sringyfied = JSON.stringify(new_Inline_items);


		
		

		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					alert(xhttp.responseText);
					var result=xhttp.responseText;
				//	document.getElementById("Invoice_Number_Edit").value="";
					//document.getElementById("ID_Number_Edit").value="";
					//document.getElementById("Recdate_Edit").value="";
					//document.getElementById("fields_Edit").innerHTML = "";
					//document.getElementById("new_fields_Edit").innerHTML = "";
					document.getElementById("Message1").innerHTML = xhttp.responseText;
					$('#Message1').delay(5000).fadeOut(400)
					//alert("Successfuly updated");
				if(result.match(/Cannot update that Amount:*/)|| result.match(/You have exceeded stock amount by*/)) {
                        //alert('match');
                      
                  
                        //alert('match');
                      
                       }
                       else{
                       
                       		
                       	
                       	//var sid=localStorage.getItem('sid');
				   //alert(sid);
				   Rtest1(ID);
                       	
                       	
                     reload();
                       }	
                       
					
				}
				else
				{
					//alert(xhttp.responseText);
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("POST", "php/Query_Manager.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("Query=Update_Usage&ID="+ID+"&Invoice_Number="+Invoice_Number+"&Usagedate="+Usagedate+"&Purpose="+Purpose+"&Equipment="+Equipment+"&location="+location+"&jname="+jname+"&Inline_items="+Inline_items_Sringyfied+"&new_Inline_items="+new_Inline_items_Sringyfied);
		
		//alert("Stop");
	}
	

	/** 
	*	@Discription:	Enable/Disable the equipment selection
	*	
	*	@param (void)
	*
	*	@return (void)
	*/
	function Allow_Equipment(state)
	{
		$("#Equipment").prop("disabled", state);
		document.getElementById("Equipment").value="";
	}
	
	
	/**
	*	@Discription:	
	*	
	*	@param (String) 
	*	@param (String) 
	*
	*	@return (void)
	*/


	
	//this function loads the input 
	function showqty(stock_id, inline_item_id)
	{
	  
	
  
		if(stock_id == stock_id)
		{
		 //id="qtysheet2_input_field_row_'+inline_item_index+'" style="display:block"
		var cl2=inline_item_id;


	     
		cl2="qtysheet2_input_"+cl2;
	
		
			   document.getElementById(cl2).style.display="block";
			
			
              inline_item_id="envqty_input_"+inline_item_id; 

			//alert(inline_item_id);
			document.getElementById(inline_item_id).style.visibility="visible";
	
		}
		
	
		
		
		
				if(stock_id == "PrintedForm")
		{
			//alert(stock_id);
			
			inline_item_id="sheet1_input_"+inline_item_id; 
       
		
			//document.getElementById(inline_item_id).style.visibility="visible";
			
	
			
			
		}
	
		
					
		else
		{
			
					
		}
		
		//alert("stop");
	}

function get_stock_fields1(stock_type, edit_new_inline_item_index)
	{
		//alert(stock_type);
		//alert(edit_new_inline_item_index);
		//Variables
		var location=document.getElementById('location_edit').value;
		if(location=="Printery"){
			location="Warehouse1";
		}
			if(location=="Office"){
			location="Warehouse2";
		}
			if(location=="Events"){
			location="Warehouse3";
		}
		//alert(location);
		var Options;
		var xhttp = new XMLHttpRequest();
		edit_new_inline_item_index+="_stock";
		//alert(inline_item_id);
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					Options = xhttp.responseText;
					document.getElementById(edit_new_inline_item_index).innerHTML = Options;
				}
				else
				{
					alert("An error occured while trying to get the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Stock_in_Types&Type="+stock_type+"&location="+location, true);
		xhttp.send();
		
		//alert(Stock_field);
		//alert("stop");
	}
	
	

	//This  function loads the envelope input 

	


  function reload(){
    setTimeout(function(){location.reload()}, 3000);
    var timer = null;
  }


	
	
	//_______________________________[Loaded functions to b executed when the page is ready]______s________________________________________________
	$(document).ready(function()
	{
		//reorder();
	//alert('working');
		
		
		
		
$("#edit").click(function() {
		

 //reload();
 
	});
	
	$("#use").click(function() {
		

//reload();
 
	});


		
		//Load default reveival listing table
		
		
		$('#search_field').keyup(function()
		{
			Search_Usage_table();
		});
		
		//Apply style to check box
		//$("[name='Equipment_checkbox']").bootstrapSwitch();
		//Add validator to form -Gavin Palmer || March 2016
		$('#Create_ID').validator();
		$('#Edit_Create_ID').validator();
		
		//Prevent submition of form and check if the required fields are filled in-Gavin Palmer || March 2016
		$('#Create_ID').validator().on('submit', function (e)
		{
			var no_error=true;
			
			e.preventDefault();
			
			if(e.isDefaultPrevented())
		  	{
				if($("#Invoice_Number").val() == null || $("#Invoice_Number").val() === "" || $("#Invoice_Number").val() == 0)
				{
					no_error=false;
				}
				if($("#Recdate").val() == null || $("#Recdate").val() === "")
				{
					no_error=false;
				}
				if($("#Purpose").val() == null || $("#Purpose").val() === "")
				{
					no_error=false;
				}
				/*if($("#Equipment").val() == null || $("#Equipment").val() === "")
				{
					no_error=false;
				}*/
				
				Create_Receival(no_error);
				//$('#_submit').prop('disabled', true);
		  	}
		 	 else
		  	{
				// everything looks good!
				//alert("everything is good");
		  	}
		})
		
		
		$('#Edit_Create_ID').validator().on('submit', function (e)
		{
			var no_error=true;
			
			e.preventDefault();
			
			if(e.isDefaultPrevented())
		  	{
				if($("#Invoice_Number_Edit").val() == null || $("#Invoice_Number_Edit").val() === "" || $("#Invoice_Number_Edit").val() == 0)
				{
					no_error=false;
				}
				if($("#Recdate_Edit").val() == null || $("#Recdate_Edit").val() === "")
				{
					no_error=false;
				}
				if($("#Purpose_Edit").val() == null || $("#Purpose_Edit").val() === "")
				{
					no_error=false;
				}
				/*if($("#Equipment_Edit").val() == null || $("#Equipment_Edit").val() === "")
				{
					no_error=false;
				}*/
				
				Update_Usage(no_error);
				//$('#_submit').prop('disabled', true);
		  	}
		 	 else
		  	{
				// everything looks good!
				//alert("everything is good");
		  	}
		})
	});
	
</script>
<style type="text/css">
<!--/*@import url('http://getbootstrap.com/dist/css/bootstrap.css');*/
-->
</style>

    </head>


    <body onload="" class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
    
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            

            <!-- Left Sidebar End --> 



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                   
                                    <h4 class="page-title">Events Internal PO</h4>
                                </div>
                            </div>
                        </div>
     <div class="card-box" >
	
      
 	<!--banner-->	
		    <div class="banner" id="usg1" style="display:block">
		    	
		    	<h5>
				<a href="#" onClick="switch_page(0);" style="color: #22A7F0;">Job listing</a> &nbsp;&nbsp; &nbsp;&nbsp;
			
				<!--span>Receival listing</span-->
			
					
											
				<a href="#" onClick="switch_page(1);" style="color: #22A7F0;">Create Job</a>	
			
			
				</h5>
		    </div>
		<!--//banner-->
 	 <!--This is the Usage inventory-->
 	<div id="Receival_listing" class="blank" style="overflow-y: none;">
		
	
		
		<!--Adding in page info-->
		








                        <div id="try" class="row " >
                        	
                            <div class="col-sm-12">
                                <div class="table-responsive">

                                    <h4 class="m-t-0 header-title"><b></b></h4>
                                 <div id="Receival_listing_Message" style="padding: 10px; text-align: center">
			</div>

                                    <table id="datatable-fixed-header" class="table table table-hover ">
                                       
                                       
                                        <thead>
                                            <tr>
                                            	<th style='display:none'>PO #</th>
                                            	
                                            	<th>Date</th>
                                                <th>Job #</th>
                                                <th>Job Name</th>
                                                <th>Location</th>
                                                
                                            
                                                                                                                                         
      <?php	if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
				  echo "<th>Action</th>";	
                     }
?>
       
                                            </tr>
                                        </thead>
<tbody id="" style="">

                                      
                                        	
                                       <?php
require 'db.php';

$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";



	$sql = "SELECT DISTINCT usages.*,usages.id as uid, usage_lineitems.usage_id,usage_lineitems.req_by,usage_lineitems.location 
	FROM usages
	INNER JOIN usage_lineitems ON usage_lineitems.usage_id=usages.id
    WHERE usage_lineitems.location='Warehouse3'";
			   	 //   
//$conn = new mysqli($db_servername, $db_username, $db_password, $db_name); 
		   			  
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
			
										       $id=$row["uid"];
										       //$date=$row["usagedate"];
										       $job_id=$row["job_id"];
										      // $usageid=$row["usage_id"];
												$inv=$row["invoice_number"];
												$date=$row["usagedate"];
												//$equip=$row["equip"];
												$item=$row["req_by"];
												//$qty=$row["qty"];
												$location=$row["location"];
			
												//$cost=$row["total"];
											//$myNumber = $cost;	
													if($job_id=="")
									{$job_id="-";
									}
										if($location=="Warehouse1")
									{
										$location="Printery";
									}
									if($location=="Warehouse2")
									{
										$location="Office";
									}	
									if($location=="Warehouse3")
									{
										$location="Events";
									}
									
									if($inv=="")
									{$inv="&nbsp;&nbsp;&nbsp;&nbsp;-";
									}		
													
												
												
											echo"
											
											<tr id='Listing_row_$id' class='text-black' style='color: #000000;'>
											 <td style='display:none'><b>$id</td>	
										
											<td><b>$date</b></td>
											<td><b>$inv</b></td>
											<td><b>$item</b></td>
										
										    <td><b>$location</b></td>";														
			if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
					
				  echo "<td align='center'> <a class='btn btn-primary btn-md button_style_addon' href='#' onClick='Show_Edit_Usage($id);' style='border-radius: 5px;'><span class='glyphicon glyphicon-edit'></span> Edit</a> <a href='#' class='btn btn-danger btn-md button_style_addon' style='border-radius: 5px;' onClick='Remove_Usage($id,$id);'><span class='glyphicon glyphicon-remove'></span> Del</a></td></tr>";
				}
				
														
											
			}
		}


}
?> 	
                                        
                              	</tbody>
                                    </table>
                                </div>
                            </div>
                        </div></div>

		<!-- -->

<!--*************** Create Usages Page ****************************************************************************************************************************************************************data -->
	<div id="Enter_Receival" class="blank" style="display: none; overflow-y: auto;">
		<form id="Create_ID" data-toggle="validator" role="form" class="" autocomplete="off">
			<div class="form-group">
				<div class="row col-md-12 custyle">
					
							<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
									<label for="sel1"></label><select class="form-control" id="location" onchange="loc();"><option value='Warehouse3'>Events</option></select>
									<div class="help-block with-errors"></div>
				</div>
									<br/>
									
								
									<div class="help-block with-errors"></div>
					
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="Invoice_Number" name="Invoice_Number" type="text" placeholder="Job #"/>
									</div>
									<div class="help-block with-errors"></div>
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
										<input class="form-control" id="Recdate" name="Recdate" type="text" placeholder="Date"/>
									</div>
									<div class="help-block with-errors"></div>
									
									<div id="jname1" class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="jname" name="jname" type="text" placeholder="Job name"/>
									</div>
									<br/>
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-certificate"></span> 
										</div>
										<input class="form-control" id="Purpose" name="Purpose" type="text" placeholder="Details"/>
									</div>
									<div class="help-block with-errors"></div>
									
									<!--<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-print"></span> 
										</div>
										input type="checkbox" name="Equipment_checkbox" id="Equipment_checkbox" onChange="Allow_Equipment(this.checked);"
										<select class="form-control" id="Equipment" name="Equipment" onChange="">
											<option  value="" hidden selected>Select Item</option>
												<?php
													//database connection variables
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";

													$sql = "SELECT id, name FROM equipment";
													$formatted_result="";
																		
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
																$data_row_item_formatted = '<option value="'.$row["id"].'">'.$row["name"].'</option>';
																$formatted_result=$formatted_result.$data_row_item_formatted;
															}
															$conn->close();
															echo $formatted_result;
														}
														else
														{
															$conn->close();
														}
													}
												?>
										</select>
									</div>
									<div class="help-block with-errors"></div>
										
												
									</div>-->
					
									
									<div class="help-block with-errors"></div>	
									
						
												
				</div>
					
			
					
				<div id="Message" style="padding: 10px; text-align: center">
				</div>
					
				<div id="fields">   <!--This is the page input usage item starts here ****************************************-->
				 
				</div>
				<br/>
			<button type="button" class="btn btn-primary" style="border-radius: 10px;" onClick="add_fields();"> <span class="glyphicon glyphicon-plus">&nbsp;Add Items</span></button><!--This add new row in -->	
			
			<br/>

				
				<center>
					<button type="submit" id="use" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="/*Create_Receival();*/">Process Job&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
				</center> 
				
		</form>
			</div>  
			
	
	</div>
		
		
	<div id="Edit_Receival" class="blank card-box" style="display: none; overflow-y: scroll; font-size: ; font-weight: ; color: #D95459;">
		<div style="padding: 10px; text-align: center; color: #000000;">
			Edit Job
		</div>
		<form id="Edit_Create_ID" data-toggle="validator" role="form" class="" autocomplete="off">
			<div class="form-group">
				<div class="row col-md-12 custyle">
					<div class="input-group" style='display:none'>
										<div class="input-group-addon">PO #
											<span class=""></span> 
										</div>
										<input class="form-control" id="job_id_Edit" name="job_id_Edit" type="text" placeholder="PO #" readonly/>
										
									</div>
								<div class="help-block with-errors"></div>	
									
									<div class="input-group">
										<div class="input-group-addon">Job #
											<span class=""></span> 
										</div>
										<input class="form-control" id="Invoice_Number_Edit" name="Invoice_Number" type="text" placeholder="Job #"/>
										
										<input class="form-control" id="ID_Number_Edit" name="ID_Number_Edit" type="hidden" placeholder="ID number"/>
									</div>
									<div class="help-block with-errors"></div>
									<div class="input-group">
										<div class="input-group-addon">Date
											<span class=""></span> 
										</div>
										<input class="form-control" id="Recdate_Edit" name="Recdate" type="text" placeholder="Received date">
									</div>
									<div class="help-block with-errors"></div>
									
									
									<div class="input-group">
										<div class="input-group-addon">Job Name
											<span class=""></span> 
										</div>
										<input class="form-control" id="jname_edit" name="jname_edit" type="text" placeholder="Job name"/>
									</div>
									<br/>
								
									
									<div class="input-group">
										<div class="input-group-addon">Details
											<span class=""></span> 
										</div>
										<input class="form-control" id="Purpose_Edit" name="Purpose_Edit" type="text" placeholder="Purpose">
									</div>
									<div class="help-block with-errors"></div>
						<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span> 
										</div>
										<input class="form-control" id="location_edit" name="location" type="text" placeholder="Location" readonly/>
									</div>	
									<br/>
									<div class="input-group" style="display:none ">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-print"></span> 
										</div>
										<select class="form-control" id="Equipment_Edit" name="Equipment_Edit" >
											<option  value="" disabled selected>Equipment</option>
												<?php
													//database connection variables
$db_servername = "localhost";
		$db_username = "dert1_creative";
		$db_password = "creativeunit";
		$db_name =  "dert1_creative_unit";

													$sql = "SELECT id, name FROM equipment";
													$formatted_result="";
																		
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
																$data_row_item_formatted = '<option value="'.$row["id"].'">'.$row["name"].'</option>';
																$formatted_result=$formatted_result.$data_row_item_formatted;
															}
															$conn->close();
															echo $formatted_result;
														}
														else
														{
															$conn->close();
														}
													}
												?>
										</select>
									</div>
									<div class="help-block with-errors"></div>
									
								
				</div>
					
				<hr style="height: 1px; width: 100%; background-color: #999999;"/>
					
				<div id="Message1" style="padding: 10px; text-align: center">
				</div>
					
				<div id="fields_Edit">
					
				</div>
				
				<div id="new_fields_Edit">
				
				</div>
				<br/>
<button type="button" class="btn btn-primary" style="border-radius: 10px;" onClick="edit_new_add_fields();"> <span class="glyphicon glyphicon-plus">&nbsp;Add Item</span></button>
				
				<br/>
				<br/>
				<center>
					<button type="submit" id="edit" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="/*Update_Usage();*/" >Update Job&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
				</center>
			</div><!-- End of Edit Usage form ****************************************************************************************************************************************************-->
		</form>
	</div>
	
	<!--//faq-->
		<!---->
	        	
	</div>
	</div>	
		</div>
		<div class="clearfix"> </div>
       </div>
     
<!---->     <div class="side-bar right-bar">
                <div class="nicescroll">
                    
            </div>
            <!-- /Right-bar -->

        </div>
<!--scrolling js-->

            </div>
            
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
       
        <!-- END wrapper -->


    
        <script>
            var resizefunc = [];
        </script>

     <!-- Plugins  -->
<script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>
        
        <!-- Counter Up  -->
        <script src="../plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>

        <!-- circliful Chart -->
        <script src="../plugins/jquery-circliful/js/jquery.circliful.min.js"></script>
        <script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- skycons -->
        <script src="../plugins/skyicons/skycons.min.js" type="text/javascript"></script>
        
        <!-- Page js  -->
        <script src="assets/pages/jquery.dashboard.js"></script>
        
        

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        
        <script type="text/javascript">
              

            jQuery(document).ready(function($) {
            	
            	
            var oTable = null;
		 oTable = $('#datatable-fixed-header').dataTable( {
                 "sPaginationType": "full_numbers",
                 "aaSorting": [[ 0, "asc" ]],
                 "iDisplayLength": 50,
                 "oLanguage": {
                 "sLengthMenu": 'Show <select>'+
                            
                             
                                '<option value="50">50</option>'+
                                '<option value="100">100</option>'+
                                '<option value="150">150</option>'+
                                '<option value="200">200</option>'+
                                '<option value="-1">All</option>'+
                                '</select> entries'
                  }
             } );	
            	
            	
            	
            	
            	
            	
            	
            	
            	
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
                $('.circliful-chart').circliful();
            });

            // BEGIN SVG WEATHER ICON
            if (typeof Skycons !== 'undefined'){
            var icons = new Skycons(
                {"color": "#3bafda"},
                {"resizeClear": true}
                ),
                    list  = [
                        "clear-day", "clear-night", "partly-cloudy-day",
                        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                        "fog"
                    ],
                    i;

                for(i = list.length; i--; )
                icons.set(list[i], list[i]);
                icons.play();
            };
            
            
            
            
            

        </script>
        
        
         <!-- Datatables-->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="../plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="../plugins/datatables/jszip.min.js"></script>
        <script src="../plugins/datatables/pdfmake.min.js"></script>
        <script src="../plugins/datatables/vfs_fonts.js"></script>
        <script src="../plugins/datatables/buttons.html5.min.js"></script>
        <script src="../plugins/datatables/buttons.print.min.js"></script>
        <script src="../plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="../plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="../plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="../plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

    

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
               // var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
        
        <!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

    
    </body>
</html>
