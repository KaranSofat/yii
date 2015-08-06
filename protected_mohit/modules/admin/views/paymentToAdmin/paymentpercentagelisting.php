<?php

/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
        <!-- configuration to overwrite settings-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/config.js"></script> 
		
	<!-- the script which handles all the access to plugins etc...  -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/script.js">
	</script>
	<style>
	.alert .success
	{
       display:none !important;
	}
	</style>
	<script>
     
    $(document).ready(function(){
     
         $('.active').click(function(){

              var id=$(this).attr('id');
              //alert(id)
               $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/paymentToAdmin/ajaxActive')?>",
					 
					                data:{'id':id},
								   success:function(result)
								   {
								   	  //alert(result)
								       location.reload()
								      return true;
								     
								   
								   },
								   error: function (result) {
										alert("Error.")
									
									      return false;
									}
			       });
              



         });
         


        // ajax to deactive the status

        $('.deactive').click(function(){

              var id=$(this).attr('id');

               $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/paymentToAdmin/ajaxDeactivate')?>",
					 
					                data:{'id':id},
								   success:function(result)
								   {

								   	     //alert(result)  
								        location.reload()
								        return true;
								     
								   
								   },
								   error: function (result) {
										//alert("Error.")
									
									      return false;
									}
			       });
              



         });



    }); 




	  function dlt(id)
	  {
	  	 
	  	       
               if(confirm('Are you sure you want to delete this?'))
               {
                    $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/paymentToAdmin/ajaxdelete')?>",
					 
					                data:{'id':id},
								   success:function(result)
								   {
								   	   
								      location.reload()
								      return true;
								     //alert(result);
								   
								   },
								   error: function (result) {
										//alert("Error.")
									
									      return false;
									}
			       });
		

               } 

	  	 
	  }
	</script>

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		
		<section id="content">
			<div class="g12">
			<h1>Percentage cost Listing</h1>
			<!--
			<a href ="<?php //echo Yii::app()->request->baseUrl; ?>/admin/paymentToAdmin/addpaymentpercentage">
			<section style="float:right;margin-bottom:2px;"><div><button class="reset">Add Percentage Payment</button></div></section>
			</a> -->
			<table class="datatable">
				<thead>
					<tr>
					    <th>Sr No</th>
						<th class="sort">Amount</th>
						<th class="sort">Type of Cost</th>
						<th>Status</th>
						<th>Action</th>
						
					</tr>
				</thead>

				<tbody>
					<?php 
                     $i=1;
					foreach($list as $r) { ?>
					<tr class="gradeX">
					    <td><?php echo $i++;?></td>
						
                                            
                         
						<td><?php echo $r->cost_percentage; ?></td>
                       				<td><?php echo $r->type_of_cost; ?></td>
                          
			           
						<?php if($r->status==0) { ?>
						
						<td><a href="javascript:void(0);" id="<?php echo $r->id;?>" class="active">Activate</a> </td>
						
						<?php } else { ?>
                        
                              <td><a href="javascript:void(0);" id="<?php echo $r->id;?>" class="deactive">Deactivate</a></td>

						<?php } ?>
						<td class="c"><a href ="javascript:void(0)" onclick="dlt(id)"  id="<?php echo $r->id;?>" class="btn i_trashcan" title="Delete"></a>
						<a href="<?php echo Yii::app()->createUrl('admin/paymentToAdmin/edit')?>/<?php echo $r->id;?>" class="btn i_pencil" title="Edit"></a>
						<a href="<?php echo Yii::app()->createUrl('admin/paymentToAdmin/view')?>/<?php echo $r->id;?>" class="btn i_folder" title="View"></a></td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

			
		</section>
		
   </body>
