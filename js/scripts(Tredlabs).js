/*
Author: Gavin Palmer
Co-Author: Romaine Whyte
Author URL: http:/www.tredlabs.com
License: 
License URL: 
*/


/** -Gavin Palmer || March 2016
*	@Discription:	Requets from the server the default formated infromation in the receival table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Load_Default_Receival_table()
{
	//alert("start");
	//Variables
	var table_data;
	var xhttp = new XMLHttpRequest();
	
  	xhttp.onreadystatechange = function()
	{
    	if(xhttp.readyState == 4)
		{
			if(xhttp.status == 200)
			{
				//alert(xhttp.responseText);
     			table_data = xhttp.responseText;
				document.getElementById("Receival_table_body").innerHTML = table_data;
				$('[rel="popover"]').popover(); //Ensuring that pop over work
			}
			else
			{
				alert("An error occured while trying to get the data you requested");
			}
    	}
  	};
	xhttp.open("GET", "php/Query_Manager.php?Query=Receival_default", true);
	xhttp.send();
	
	//alert("stop");
}



/** -Gavin Palmer || March 2016
*	@Discription:	request for all items in table similar to the search_value 
*	
*	@param (String) search_value - The search value
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Search_Receival_table()
{
	//alert("start");
	//Variables
	var table_data;
	var xhttp = new XMLHttpRequest();
	var search_value = document.getElementById("search_field").value;
	var search_start_date = document.getElementById("search_start_date").value;
	var search_end_date = document.getElementById("search_end_date").value;
	
	/*if start date present and now end date mention set the end date to today -Gavin Palmer || March 2016*/
	/*if((search_start_date!="") && (search_end_date==""))
	{
		var now = new Date();
		alert(now);
	
		//search_end_date =  (now.getMonth() + 1) + '/' + now.getDate() + '/' +  now.getFullYear());
		alert(search_end_date);
	}*/
	
	
  	xhttp.onreadystatechange = function()
	{
    	if(xhttp.readyState == 4)
		{
			if(xhttp.status == 200)
			{
				//alert(xhttp.responseText);
     			table_data = xhttp.responseText;
				document.getElementById("Receival_table_body").innerHTML = table_data;
				$('[rel="popover"]').popover(); //Ensuring that pop over work
			}
			else
			{
				alert("An error occured while trying to get the data you requested");
			}
    	}
  	};
	xhttp.open("GET", "php/Query_Manager.php?Query=Receival_default&search_value="+search_value+"&search_start_date="+search_start_date+"&search_end_date="+search_end_date , true);
	xhttp.send();
	
	//alert("stop");
}

  
function Load_Default_Inventory_table()
{
	//alert("start");
	//Variables
	var table_data;
	var xhttp = new XMLHttpRequest();
	
  	xhttp.onreadystatechange = function()
	{
    	if(xhttp.readyState == 4)
		{
			if(xhttp.status == 200)
			{
				//alert(xhttp.responseText);
     			table_data = xhttp.responseText;
				document.getElementById("Inventory_table_body").innerHTML = table_data;
			}
			else
			{
				alert("An error occured while trying to get the data you requested");
			}
    	}
  	};
	xhttp.open("GET", "php/Query_Manager.php?iQery=Inventory_default", true);
	xhttp.send();
	
	//alert("stop");
}



/** -Gavin Palmer || March 2016
*	@Discription:	request for all items in table similar to the search_value 
*	
*	@param (String) search_value - The search value
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Search_Inventory_table()
{
	//alert("start");
	//Variables
	var table_data;
	var xhttp = new XMLHttpRequest();
	var search_value = document.getElementById("search_field").value;
	var search_start_date = document.getElementById("search_start_date").value;
	var search_end_date = document.getElementById("search_end_date").value;
	
	/*if start date present and now end date mention set the end date to today -Gavin Palmer || March 2016*/
	/*if((search_start_date!="") && (search_end_date==""))
	{
		var now = new Date();
		alert(now);
	
		//search_end_date =  (now.getMonth() + 1) + '/' + now.getDate() + '/' +  now.getFullYear());
		alert(search_end_date);
	}*/
	
	
  	xhttp.onreadystatechange = function()
	{
    	if(xhttp.readyState == 4)
		{
			if(xhttp.status == 200)
			{
				//alert(xhttp.responseText);
     			table_data = xhttp.responseText;
				document.getElementById("Inventory_table_body").innerHTML = table_data;
			}
			else
			{
				alert("An error occured while trying to get the data you requested");
			}
    	}
  	};
	xhttp.open("GET", "php/Query_Manager.php?iQery=Inventory_default&search_value="+search_value+"&search_start_date="+search_start_date+"&search_end_date="+search_end_date , true);
	xhttp.send();
	
	//alert("stop");
}


/** -Gavin Palmer || March 2016
*	@Discription:	Requets from the server the default formated infromation in the Usage table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Load_Default_Usage_table()
{
	//alert("start");
	//Variables
	var table_data;
	var xhttp = new XMLHttpRequest();
	
  	xhttp.onreadystatechange = function()
	{
    	if(xhttp.readyState == 4)
		{
			if(xhttp.status == 200)
			{
				//alert(xhttp.responseText);
     			table_data = xhttp.responseText;
				document.getElementById("Receival_table_body").innerHTML = table_data;
				$('[rel="popover"]').popover(); //Ensuring that pop over work
			}
			else
			{
				alert("An error occured while trying to get the data you requested");
			}
    	}
  	};
	xhttp.open("GET", "php/Query_Manager.php?Query=Usage_default", true);
	xhttp.send();
	
	//alert("stop");
}


/** -Gavin Palmer || March 2016
*	@Discription:	request for all items in table similar to the search_value in usage table
*	
*	@param (String) search_value - The search value
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Search_Usage_table()
{
	//alert("start");
	//Variables
	var table_data;
	var xhttp = new XMLHttpRequest();
	var search_value = document.getElementById("search_field").value;
	var search_start_date = document.getElementById("search_start_date").value;
	var search_end_date = document.getElementById("search_end_date").value;
	
	/*if start date present and now end date mention set the end date to today -Gavin Palmer || March 2016*/
	/*if((search_start_date!="") && (search_end_date==""))
	{
		var now = new Date();
		alert(now);
	
		//search_end_date =  (now.getMonth() + 1) + '/' + now.getDate() + '/' +  now.getFullYear());
		alert(search_end_date);
	}*/
	
	
  	xhttp.onreadystatechange = function()
	{
    	if(xhttp.readyState == 4)
		{
			if(xhttp.status == 200)
			{
				//alert(xhttp.responseText);
     			table_data = xhttp.responseText;
				document.getElementById("Receival_table_body").innerHTML = table_data;
				$('[rel="popover"]').popover(); //Ensuring that pop over work
			}
			else
			{
				alert("An error occured while trying to get the data you requested");
			}
    	}
  	};
	xhttp.open("GET", "php/Query_Manager.php?Query=Usage_default&search_value="+search_value+"&search_start_date="+search_start_date+"&search_end_date="+search_end_date , true);
	xhttp.send();
	
	//alert("stop");
}



/** -Gavin Palmer || March 2016
*	@Discription:	Requets from the server the default formated infromation in the Usage table
*	
*	@param none
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Load_Default_Inventory_table()
{
	//alert("start");
	//Variables
	var table_data;
	var xhttp = new XMLHttpRequest();
	
  	xhttp.onreadystatechange = function()
	{
    	if(xhttp.readyState == 4)
		{
			if(xhttp.status == 200)
			{
				//alert(xhttp.responseText);
     			table_data = xhttp.responseText;
				document.getElementById("Receival_table_body").innerHTML = table_data;
				$('[rel="popover"]').popover(); //Ensuring that pop over work
			}
			else
			{
				alert("An error occured while trying to get the data you requested");
			}
    	}
  	};
	xhttp.open("GET", "php/Query_Manager.php?Query=Inventory_default", true);
	xhttp.send();
	
	//alert("stop");
}



/** -Gavin Palmer || March 2016
*	@Discription:	request for all items in table similar to the search_value in usage table
*	
*	@param (String) search_value - The search value
*
*	@return (String) HTML formatted table containing the results of the receival table
*/
function Search_Inventory_table()
{
	//alert("start");
	//Variables
	var table_data;
	var xhttp = new XMLHttpRequest();
	var search_value = document.getElementById("search_field").value;
	var search_start_date = "";//document.getElementById("search_start_date").value;
	var search_end_date = "";//document.getElementById("search_end_date").value;
	
	/*if start date present and now end date mention set the end date to today -Gavin Palmer || March 2016*/
	/*if((search_start_date!="") && (search_end_date==""))
	{
		var now = new Date();
		alert(now);
	
		//search_end_date =  (now.getMonth() + 1) + '/' + now.getDate() + '/' +  now.getFullYear());
		alert(search_end_date);
	}*/
	
	
  	xhttp.onreadystatechange = function()
	{
    	if(xhttp.readyState == 4)
		{
			if(xhttp.status == 200)
			{
				//alert(xhttp.responseText);
     			table_data = xhttp.responseText;
				document.getElementById("Receival_table_body").innerHTML = table_data;
				$('[rel="popover"]').popover(); //Ensuring that pop over work
			}
			else
			{
				alert("An error occured while trying to get the data you requested");
			}
    	}
  	};
	xhttp.open("GET", "php/Query_Manager.php?Query=Inventory_default&search_value="+search_value+"&search_start_date="+search_start_date+"&search_end_date="+search_end_date , true);
	xhttp.send();
	
	//alert("stop");
}



	 
	 
function DeleteRow(){
	var id = ooo;
	 
	if(confirm("Are you sure you want to delete this record?"))
	{
		alert(id+" Deleted!");
	}
	
}



/*__________________________________________________________________[Usage validation functions]________________________________________________*/

function check_numeric(element_id)
{
	alert("start");
	var x=document.getElementById(element_id);

	//Check if empty
	if (x.value==null || x.value=="") 
	{
		alert("Must not be empty");
		//(x.parentElement.id);
		x.parentElement.className += " sucess";
		//$("#"+element_id).addClass("sucess");
		//$("#"+element_id).removeClass("form-control");
		alert("classes adjusted");
		return false;
	}
	else
	{
		alert("has information");
		return true;
	}

	//Check if numeric
	if (isNaN(x.value)) 
	{
		alert("Must input numbers");
		return false;
	}
	else
	{
		alert("number");
		return true;
	}
	
	alert("stop");
}

/*______________________________________________________________________________________________________________________________________________*/

