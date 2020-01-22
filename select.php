<?php 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="./js/main.js"></script>
  </head>
  <body>
<div class="overlay"><div class="loader"></div></div>

    <br/><br/>
    <div class="container">
      <div class="row">
        <div class="col-md-10" style="margin:0 auto;">
          <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
            <h4 class="card-header">New Receivals</h4>
            <div class="card-body">

                  <form id="order_form_details" onsubmit="return false" autocomplete="off">
                    <div class="form-group row">
                      <label for="date" class="col-sm-3 col-form-label" align="right">Receivals Date</label>
                      <div class="col-sm-6">
                        <input type="date" name="o_date" class="form-control form-control-sm" id="o_date" value="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="customer" class="col-sm-3 col-form-label" align="right">Invoice No</label>
                      <div class="col-sm-6">
                        <input type="text" name="customer_name" class="form-control form-control-sm" id="customer_name" placeholder="Enter Invoice #">
                      </div>
                    </div>


                    <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
                      <div class="card-body" style="overflow-x:scroll;">
                        <h3>Receivals Item</h3>
                          <table align="center" style="width:800px;">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th style="text-align:center;">Item Name</th>
                                <th style="text-align:center;">Part</th>
                                <th style="text-align:center;">Quantity</th>
                                <th style="text-align:center;">Price</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody id="additem">
                              
                          
                              
                            </tbody>
                          </table>
                          <p></p>
                      <center><button id="add" class="btn btn-success btn-sm" style="width:150px;"><span class="fa fa-plus">&nbsp;</span>Add</button>
                      <button id="remove" class="btn btn-danger btn-sm" style="width:150px;"><span class="fa fa-remove">&nbsp;</span>Remove</button></center>
                      </div>

                    </div>
                    <p></p>
                   
              
                    <center>
                      <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order">
                      <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                    </center>
                     
                  </form>
              




            </div>
          </div>
        </div>
      </div>
    </div>




  </body>
</html>
<script type="text/javascript">
$(document).ready(function(){

function get_partname(){
	count += 1;
	var x = document.getElementsByName("name").length;
	alert(x);
	$('#pname').on('change',function(){
        var partid = $(this).val();
        if(partid){
            $.ajax({
                type:'POST',
                url:'getpartname.php',
                data:'partid='+partid,
                success:function(html){
                    $('#partname').html(html);
                }
            })
        }else{
            $('#partname').html('<option value="">Select state first</option>'); 
        }
    })
}


  $("#add").click(function(){
    addNewRow();
  })





  function addNewRow(){
    $.ajax({
      url :"test.php",
      method : "POST",
      data : {addNewRow:1,number:1},
      success : function(data){
        $("#additem").append(data);//code can run
        var n = 1;
        $(".number").each(function(){
          $(this).html(n);
          n++;
        })
      }
    })
 
 $('#pname').on('change',function(){
        var partid = $(this).val();
        if(partid){
            $.ajax({
                type:'POST',
                url:'getpartname.php',
                data:'partid='+partid,
                success:function(html){
                    $('#partname').html(html);
                }
            })
        }else{
            $('#partname').html('<option value="">Select state first</option>'); 
        }
    })
 
 
}

  $("#remove").click(function(){
    removeRow();
  })

  function removeRow(){
    var tr = $("#additem").children("tr:last");
    tr.remove();
  }
  $('#partname').on('change',function(){
        var partname = $(this).val();
        if(partname){
            $.ajax({
                type:'POST',
                url:'getpartname.php',
                data:'partname='+partname,
                success:function(html){
                    $('#partname').html(html);
                }
            })
        }else{
            $('#partname').html('<option value="">Select state first</option>'); 
        }
    });
});



  



 



</script>