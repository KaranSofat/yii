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
	
	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		
		<section id="content">
			<div class="g12">
			<h1>Customers Listing</h1>
			<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/customer/export">
			<section style="float:right;margin-bottom:2px;"><div><button class="reset">Download Csv</button></div></section>
			</a>
			<table class="datatable">
				<thead>
					<tr>
					    <th>Sr No</th>
						<th class="sort">Name</th>
						<th>Country</th>
						<th>Zip Code</th>
						<th>Email</th>
						 <th>Action</th> 
					</tr>
				</thead>
				<tbody>
					<?php 
                     $i=1;
					foreach($list as $l) { ?>
					<tr class="gradeX">
					    <td><?php echo $i++;?></td>
						<td><?php echo $l->cname." ".$l->clname; ?></td>
						<td><?php echo $l->country; ?></td>
						<td><?php echo $l->zipcode;?></td>
						<td><?php echo $l->email;?></td>
					 	<td class="c">
						 	<a href="<?php echo Yii::app()->createUrl('admin/customer/customerview')?>/<?php echo $l->id;?>" class="btn i_folder"></a>
						</td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

			
		</section>
		
   </body>
