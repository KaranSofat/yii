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
			<h1>Payment Listing</h1>
			<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/payment/export">
			<section style="float:right;margin-bottom:2px;"><div><button class="reset">Download Csv</button></div></section>
			</a>
			<?php //echo CHtml::link('Download CSV',array('payment/export'));?>

			<table class="datatable">

				<thead>
					<tr>
					    <th>Sr No</th>
						<th class="sort">Name</th>
						<th>Company</th>
						<th>Service Type</th>
						<th>Cleaning Address</th>
						<th>Transaction Id</th>
						<th>Price</th>
						 <th>Action</th> 
					</tr>
				</thead>
				<tbody>
					<?php 
                     $i=1;
					foreach($list as $l) { ?>
					<tr class="gradeX">
					    <td><?php echo $i++;?></td>
						<td><?php echo $l->customer['cname']." ".$l->customer['clname']; ?></td>
						<td><?php echo $l->service['company_name']; ?></td>
						<td><?php echo $l->serviceType['service_name'];?></td>
						<td><?php echo $l->customerAddress['address'];?></td>
					 	<td><?php echo $l->trans_id;?></td>
					 	<td><?php echo $l->price;?></td>
					 	<td class="c">
						 	<a href="<?php echo Yii::app()->createUrl('admin/payment/paymentview')?>/<?php echo $l->id;?>" class="btn i_folder"></a>
						</td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div>

			
		</section>
		
   </body>
