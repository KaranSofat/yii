<?php

/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
        <!-- configuration to overwrite settings-->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/config.js"></script> 
		
	<!-- the script which handles all the access to plugins etc...  -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/script.js">	</script>
	<style>
	.alert .success
	{
       display:none !important;
	}
	</style>
	<script>
    $(document).ready(function(){

       // var val=$( "#comp option:selected" ).val();
        
        //onload get the details for a service provider
        $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/price/ajaxPriceLoad')?>",
					 
					                data:{'val':val},
								   success:function(result)
								   {
								   	   $(".datatable").html(result);
								      //alert(result);
								      //location.reload()
								      return true;
								     //alert(result);
								   
								   },
								   error: function (result) {
										alert("Error.")
									
									      return false;
									}
			       });
		 


    }); 

	  function dlt(id)
	  {
	  	 
	  	       
               if(confirm('Are you sure you want to delete this?'))
               {
                    $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/priceadmin/delete')?>",
					 
					                data:{'id':id},
								   success:function(result)
								   {
								   	   //$("#alert success").html(data);
								      //alert(result);
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
			<h1>Price Listing</h1>

			
            <a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/priceadmin/addprice">
			<section style="float:right;margin-bottom:2px;"><div><button class="reset">Add Service Price</button></div></section>
			</a>
			<table class="datatable">
			
             				
				<thead>
					<tr>
					    <th>Sr No</th>
						 <th class="sort">Comapnay Name</th>
						<th>Service Type</th>
						<th>Bedroom Price (Euro)</th>
						<th>Bathroom Price (Euro)</th>
						<th>Property Price (Euro)</th>
						
						<!--<th>Price</th> -->
						<th>Action</th>
						
						
					</tr>
				</thead>
				<tbody>
					<?php 
                    $i=1;
					foreach($Plist as $l) { ?>

					<tr class="gradeX">
					    <td><?php echo $i++;?></td>
                        <td><?php echo ucfirst($l->service['company_name']);?></td>
						
						<td><?php echo $l->serviceType['service_name'];?></td>
						<td><?php echo $l->bedroom ;?></td>
						<td><?php echo $l->bathroom;?></td>
						<td><?php echo $l->property;?></td>
											
						<!--<td><?php //echo $l->price."$";?></td> -->
						
						<td class="c"><a href ="javascript:void(0)" onclick="dlt(id)"  id="<?php echo $l->id;?>" class="btn i_trashcan" title="Delete"></a>
						
						<a href="<?php echo Yii::app()->createUrl('admin/priceadmin/priceEdit')?>/<?php echo $l->id;?>"class="btn i_pencil"></a> 
                        <a href="<?php echo Yii::app()->createUrl('admin/priceadmin/priceview')?>/<?php echo $l->id;?>" class="btn i_folder"></a>
						 
						</td>
					</tr>
				    <?php } ?>
				</tbody>
			</table> 
		</div>

			
		</section>
		
   </body>
