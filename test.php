<?php
require 'db.php';
 if (isset($_POST["addNewRow"])) {
	$sql ="SELECT * FROM fields ";
	$result = $mysqli->query($sql);
	
	

?>
 

     <tr>
        <td><b class="number"></b></td>
        <td>
        <select id="pname" name="pname[]" class="form-control form-control-sm pname"onChange="get_partname();" >
        <option value="0">Select Item</option>
     <?php
     foreach ($result as $row) {
     	?>
 
     		
     		echo '<option value="'.$row['id'].'">'.$row["name"].'</option>';
     	<?php
     }
     ?>
     	</select>
   


     	
     	
        </td>
       
        <td><select  name="partname[]" id="partname"class="form-control form-control-sm partname">
    <option value="">Select Part</option></select></td>
        <td><input name="qty[]" type="text" class="form-control form-control-sm qty"></td>
        <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></td>
        <td>Rs.<span class="amt">0</span></td>
        <td><input type="hidden" type="text" name="pro_name[]" class="pro_name" id="pro_name"></td>
      </tr>
      
      
      
           
    <script type="text/javascript">
var count=0;

function get_partname(){
	count += 1;

	alert();
	$('#pname').on('change',function(){
        var partid = $(this).val();
        if(partid){
            $.ajax({
                type:'POST',
                url:'getpartname.php',
                data:'partid='+partid,
                success:function(html){
                    $('.partname').html(html);
                }
            })
        }else{
            $('#partname').html('<option value="">Select state first</option>'); 
        }
    })
}
     
     </script>
     <?php
     exit();
} 

  
?>

