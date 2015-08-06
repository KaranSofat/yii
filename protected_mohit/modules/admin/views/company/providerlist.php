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
	  function dlt(id)
	  {
	  	 
	  	       
               if(confirm('Are you sure you want to delete this?'))
               {
                    $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/company/deleteprovider')?>",
					 
					                data:{'id':id},
								   success:function(result)
								   {
								   	   //$("#alert success").html(data);
								     // alert(result);
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
			<h1>Companies Listing</h1>
			<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/company/addProvider">
				<section style="float:right;margin-bottom:2px;"><div><button class="reset">Add Company</button></div></section>
			</a>
			<?php
				if(isset($list) && is_array($list) && count($list) > 0 )
				{
			?>
					<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/company/export">
					<section style="float:right;margin-bottom:2px;"><div><button class="reset">Download Csv</button></div></section>
					</a>
			<?php
				}
			?>
			<table class="datatable">
				<thead>
					<tr>
					    <th>Sr No</th>
						<th class="sort">Email</th>
						<th>Company Name</th>
						<th>city</th>
						<th>Zip Code</th>
						 <th>Action</th> 
					</tr>
				</thead>
				<tbody>
					<?php 
                     $i=1;
					foreach($list as $l) { ?>
					<tr class="gradeX">
					    <td><?php echo $i++;?></td>
						<td><?php echo $l->email; ?></td>
						<td><?php echo $l->company_name; ?></td>
						<td><?php echo $l->city;?></td>
						<td><?php echo $l->zipcode;?></td>
					 	<td class="c">
						 	<a href ="javascript:void(0)" onclick="dlt(id)"  id="<?php echo $l->id;?>" class="btn i_trashcan"></a>
							<a href="<?php echo Yii::app()->createUrl('admin/company/provideredit')?>/<?php echo $l->id;?>" class="btn i_pencil"></a>
							<a href="<?php echo Yii::app()->createUrl('admin/company/providerview')?>/<?php echo $l->id;?>" class="btn i_folder"></a>
						</td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

			
		</section>
		
   </body>
