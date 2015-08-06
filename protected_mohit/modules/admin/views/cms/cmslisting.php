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
					               url:"<?php echo Yii::app()->createUrl('admin/cms/delete')?>",
					 
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
										alert("Error.")
									
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
			<h1>CMS  Listing</h1>
			
			<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/cms/cms">
			<section style="float:right;margin-bottom:2px;"><div><button class="reset">Add Cms Page</button></div></section>
			</a>
			<table class="datatable">
				<thead>
					<tr>
					    <th>Sr No</th>
						<th class="sort">Title</th>
						<th>Meta Title</th>
						<th>Description</th>
						<th>Action</th>
						
					</tr>
				</thead>
				<tbody>
					<?php 
                     $i=1;
					foreach($list as $l) { ?>
					<tr class="gradeX">
					    <td><?php echo $i++;?></td>
						<td><?php echo $l->title; ?></td>
						<td><?php echo $l->meta_title; ?></td>
						<td>
						<?php
							$desc = $l->desc;
							$len = strlen($desc);
							if($len>50){
								
								$trimmed = substr(strip_tags($desc), 0, 50)."...";
								echo $trimmed;

							}else echo $desc;
						?>
						</td>
						<td class="c">
						<a href ="javascript:void(0)" onclick="dlt(id)"  id="<?php echo $l->id;?>" class="btn i_trashcan"></a>
						<a href="<?php echo Yii::app()->createUrl('admin/cms/cmsedit')?>/<?php echo $l->id;?>"class="btn i_pencil"></a>
						<a href="<?php echo Yii::app()->createUrl('admin/cms/cmsview')?>/<?php echo $l->id;?>" class="btn i_folder"></a></td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

			
		</section>
		
   </body>
