<?php
session_start();

error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(E_ALL-E_NOTICE);
//error_reporting(0);
include 'lnav.php';

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
<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script src="http://w3resource.com/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-tooltip.js"></script>
<script src="http://w3resource.com/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-popover.js"></script>

<script src="js/validator.js"></script>


<!-- DataTables -->
        <link href="../plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />




<!-- Custom Theme files -->
                    <title>Inventory</title>

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

      <script>



</script>
  
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
<script>


	
	function switch_page(index)
	{
		switch (index)
		{
			case 0:
				document.getElementById("try").style.display = "block";
				document.getElementById("_Receival").style.display = "none";
				
				break;
				
			case 1:
				document.getElementById("Enter_Receival").style.display = "block";
				document.getElementById("Receival_listing").style.display = "none";
				document.getElementById("_Receival").style.display = "none";
				break;
				
			case 2:
				document.getElementById("_Receival").style.display = "block";
			document.getElementById("try").style.display = "none";
				break;
				
		}
	}
	function stocks(sid){
	//var sid=sid;
	//alert(sid);
	//localStorage.setItem('sid',sid);
}

function reload(){
    setTimeout(function(){location.reload()}, 3000);
    var timer = null;
  }

function Update_warehouse()
	{
		var location="Warehouse3";
		//var sid=localStorage.getItem('sid');
		    //alert(location);
		var id = document.getElementById("item_id").value;
		var type = document.getElementById("_type").value;
		var name = document.getElementById("_name").value;
		var cost = document.getElementById("_cost").value;
		var reorder = document.getElementById("_reorder").value;
		var instock = document.getElementById("_instock").value;
	
		//alert(name);

		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					
		/*var type = document.getElementById("_type").value="";
		var name = document.getElementById("_name").value="";
		var cost = document.getElementById("_cost").value="";
		var reorder = document.getElementById("_reorder").value="";	
		var instock = document.getElementById("_instock").value="";*/
		
		document.getElementById("Message").innerHTML =xhttp.responseText;
					$('#Message').delay(5000).fadeOut(400);
					
					//alert(Type);
					//var location=localStorage.getItem('sid');
				   //alert(sid);
				  // Rtest(sid); 
					//
					//switch_page(0);
					reload();
					
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
		xhttp.send("Query=Update_warehouse&ID="+id+"&name="+name+"&cost="+cost+"&type="+type+"&reorder="+reorder+"&instock="+instock+"&location="+location);
		
		//alert("Stop");
	}

function Show_Receival(id)
	{
		var location="Warehouse3";
		//alert(id);
		//Variables
		switch_page(2);
		
		//Switch views to show the receival page -Gavin Palmer || March 2016
		
		
		//Get and display basic receival information -Gavin Palmer || March 2016
		var xhttp = new XMLHttpRequest();
		
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
					
				if(xhttp.status == 200)
				{
					//alert('Start');
					//alert(id);
				  // alert(xhttp.responseText);
					var receival_object = JSON.parse(xhttp.responseText);
					
					document.getElementById('item_id').value =id;
				
                    document.getElementById('_type').value =receival_object.type;
					document.getElementById('_name').value = receival_object.name;
					document.getElementById('_cost').value = receival_object.cost;
					document.getElementById('_instock').value = receival_object.instock;
					document.getElementById('_reorder').value = receival_object.reorderlevel;
				
			
				}
				else
				{
					alert("An error occured while trying to get the data you requested: "+xhttp.responseText);
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Basic_warehouse&id="+id+"&location="+location, true);
		xhttp.send();
		
		
		
		//alert('Stop');
	}
	
	function Remove_Usage(id)
	{
		//alert("start");
		var location="Warehouse3";
		var xhttp = new XMLHttpRequest();
		
		//Confirm before action is taken
		/*var action = confirm("Are you sure?");
		
		if(action==false)
		{
		return false;
		}*/
		
	
		xhttp.onreadystatechange = function()
		{
			if(xhttp.readyState == 4)
			{
				if(xhttp.status == 200)
				{
					//alert(xhttp.responseText);
					document.getElementById("Receival_listing_Message").innerHTML = xhttp.responseText;
					$('#Receival_listing_Message').delay(5000).fadeOut(400);
					$('#Listing_row_'+id).delay(1000).fadeOut(400);
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp.open("GET", "php/Query_Manager.php?Query=Remove_Stock&id="+id+"&location="+location, true);
		xhttp.send();
		//alert("stop");
	}
	
	
	
	
	//_______________________________[Loaded functions to b executed when the page is ready]______s________________________________________________
	$(document).ready(function()
	{
		   var oTable = null;
		 oTable = $('#datatable-fixed-header').dataTable( {
                 "sPaginationType": "full_numbers",
                 "aaSorting": [[ 0, "desc" ]],
                 "iDisplayLength": 50,
                 "oLanguage": {
                 "sLengthMenu": 'Show <select>'+
                            
                             
                                '<option value="10">10</option>'+
                                '<option value="100">100</option>'+
                                '<option value="150">150</option>'+
                                '<option value="200">200</option>'+
                                '<option value="-1">All</option>'+
                                '</select> entries'
                  }
             } );
		
		
		//Load inventory table
		Load_Default_Inventory_table();
		
		$('#search_field').keyup(function()
		{
			Search_Inventory_table();
		});
		
		//Apply style to check box
		//$("[name='Equipment_checkbox']").bootstrapSwitch();
		
	});
	
-->
</script>
<script>

 
 
 
 </script>      
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
                                   
                                    <h4 class="page-title">Events Stock Listing</h4>
                                </div>
                            </div>
                        </div>
<div class="card-box" style="overflow: hidden">
	
	

           
                <div class="table-responsive">  
         
                          
                </div>  
                      
                 <div class="card-box">
           
                <div class="table-responsive">  
         	<div class="receivaldata">
               <h3 align="right"></h3>
                        	
                        			
              
                  <div class="" style="">
 
 	<!--banner-->	
		     <div class="banner">
		    	<h4>
	

				<!--span>Receival listing</span-->
				
				</h4>
		    </div>
		<!--//banner-->
 	 <!--faq-->
 	<div id="Receival_listing" class="blank" style="overflow-y: none;">
		
	
		
		<!--Adding in page info-->
		








                        <div id="try" class="row" style="display: block">
                        	
                            <div class="col-sm-12">
                            	        		<h5>
				<a href="price_events.php" onClick="" style="color: #22A7F0;">Price listing</a> &nbsp;&nbsp;&nbsp;&nbsp;
				
	
				</h5>
                       
                               

                                    <h4 class="m-t-0 header-title"><b>Events</b></h4>
                                 <div id="Receival_listing_Message" style="padding: 10px; text-align: center;">
			</div>

                                    <table id="datatable-fixed-header" class="table table table-hover m-0"style="white-space:nowrap;">
                                       
                                       
                                        <thead>
                                            <tr>
                                                
                                              
                                                <th>Type</th>
                                                <!--<th>Date</th>-->
                                                <th>Name</th>
                                            
                                                
                                             
                                                <th>In Stock</th>
                                                <th>Reorder</th>
                                                <th>Total stock value</th>
                                                
      <?php	if($GLOBALS['role']>0 && $GLOBALS['role']<2)
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


	$conn = new mysqli($GLOBALS['db_servername'], 
	$GLOBALS['db_username'], 
	$GLOBALS['db_password'], 
	$GLOBALS['db_name']);
					
	//Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		//echo "Connected successfully<br/>";
		$sql = "SELECT * FROM Warehouse3"; 				
		
		$result = $conn->query($sql);
			
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc())
			{
						
										       $id=$row["id"];
										       $date=$row["created_at"];
										       $type=$row["type"];
											   $location=$row["location"];
											   $name=$row["name"];
											   
											   $instock=$row["instock"];
											   $reorder=$row["reorderlevel"];
											   $cost=$row["cost"];
											   $myNumber = $cost;
											   
											   $name1=wordwrap($name,30, '<br>');	
											   

// Displays "1,234,568"
					
												
												
								
										if($name1=="")
									{$name1="-";
									}	
											
										if($date=="")
									{$date="-";
									}			
										echo"
												
											<tr id='Listing_row_$id' class=' ' style='color: #000000;'>
											
											<td><b>$type</b></td>
											<!--<td>$date</b></td>-->
											<td><b>$name1</b></td>
											
		
										    <td><b>$instock</b></td>
								            <td><b>$reorder</b></td>
								            
										    <td  align='left'> <b>$"?><?php echo number_format($myNumber,2);"</b></td> 
										    <td class='text-center'>";														
			
				if($GLOBALS['role']>0 && $GLOBALS['role']<3)
				{
				  echo "<td><a class='btn btn-primary btn-md button_style_addon' href='#' onClick='Show_Receival($id)'; style='border-radius: 5px;'>Edit <span class='glyphicon glyphicon-edit'></span> </a> <a href='#' class='btn btn-danger btn-md button_style_addon' style='border-radius: 5px;' onClick='Remove_Usage($id);'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
				}
				
						
										echo"</td></tr>";					
											
												
												
												}									
												
			}
		}



?> 	
                                       	
                                        	
                                        	
                                            
                                            
                              	</tbody>
                                    </table>
                                
                            </div>
                        </div>
	<div id="_Receival" class="blank" style="display: none; overflow-y: scroll; font-size: ; font-weight: ; ">
		<div style="padding: 10px; text-align: center; color: #000000;">
			 Edit Item
		</div>
		<form id="_Create_ID" data-toggle="validator" role="form" class="">
			<div class="form">
				<div class="row col-md-12 custyle">
					             
					             
					             	<div class="input-group" style="display: none">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-tags"></span> 
										</div>
										<input class="form-control" id="item_id" name="item_id" type="number" placeholder="ID"/>
									</div>
					             
										<div class="input-group">
										<div class="input-group-addon">Type
											<span class=""></span> 
										</div>
										<input class="form-control" id="_type" name="_type" type="text" placeholder="Type"/>
									</div>
									<div class=""></div>
									<br>
									<div class="input-group">
										<div class="input-group-addon">Name
											<span class=""></span> 
										</div>
										<input class="form-control" id="_name" name="_name" type="text" placeholder="Name"/>
									</div>
									<br>
									<div class=""></div>
									<div class="input-group">
										<div class="input-group-addon">Instock
											<span class=""></span> 
										</div>
										<input class="form-control" id="_instock" name="_instock" type="number" placeholder="Instock"/>
									</div>
									<br>
									<div class=""></div>
									<div class="input-group">
										<div class="input-group-addon">Reorder Level
											<span class=""></span> 
										</div>
										<input class="form-control" id="_reorder" name="_reorder" type="number" placeholder="Reorder Level"/>
									
									</div>
									<br>
									<div class=""></div>
									<div class="input-group">
										<div class="input-group-addon">Cost $
											<span class=""></span> 
										</div>
										<input class="form-control" id="_cost" name="_cost" type="number" placeholder="Cost"/>
									</div>
									
									<div class=""></div>
				<br/>
				</div>
					
				<hr style="height: 1px; width: 100%; background-color: #999999;"/>
					
				<div id="Message" style="padding: 10px; text-align: center">
				</div>
					
				<div id="fields_">

				</div>
				
				<div id="new_fields_">
				
				</div>
				
				
				<br/>
				<br/>
				<center>
					<button type="submit" id="" class="btn btn-success" style="width: 80%; border-radius: 10px;" onClick="/*Update_warehouse();*/">Update&nbsp;<span class="glyphicon glyphicon-plus-sign"></span></button>
				</center>
			</div><!-- End of form group  -->
		</form>
	</div>

		
	
	
	<!--//faq-->
		<!---->
<div class="copy">
<div class="row col-md-12 custyle">
            
		</div>
		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
     </div>
     </div>
       </div>
       </div>
       </div></div></div></div>
<!---->
<!--scrolling js-->
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
                //var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
                
                $('#_Create_ID').validator();
                
                $('#_Create_ID').validator().on('submit', function (e)
		{
			var no_error=true;
			
			e.preventDefault();
			
			if(e.isDefaultPrevented())
		  	{
				if($("#_name").val() == null || $("#_name").val() === "")
				{
					no_error=false;
				}
				if($("#_type").val() == null || $("#_type").val() === "")
				{
					no_error=false;
				}
				if($("#_instock").val() == null || $("#_instock").val() === "")
				{
					no_error=false;
				}
				
				Update_warehouse(no_error);
				//$('#_submit').prop('disabled', true);
		  	}
		 	 else
		  	{
				// everything looks good!
				//alert("everything is good");
		  	}
		})
                
                
                
            } );
            TableManageButtons.init();

        </script>
        
        <!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

    
    </body>
</html>
