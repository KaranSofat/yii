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
	<script type="text/javascript">
      

      $(document).ready(function(){

            

                $('.active').click(function(){

                  var id=$(this).attr('id');

               $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/servicetype/ajaxServiceTypeStatus')?>",
					 
					                data:{'id':id},
								   success:function(result)
								   {
								   	   //$("#alert success").html(data);
								      //alert(result);
								       location.reload();
								      return true;
								     //alert(result);
								   
								   },
								   error: function (result) {
										//alert("Error.")
									
									      return false;
									}
			       });
              



         });
         


        // ajax to deactive the status

        $('.deactive').click(function(){

              var id=$(this).attr('id');

               $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/servicetype/ajaxServiceTypeStatusDeactivate')?>",
					 
					                data:{'id':id},
								   success:function(result)
								   {
								   	   //$("#alert success").html(data);
								      //alert(result);
								        location.reload();
								      return true;
								     //alert(result);
								   
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
					               url:"<?php echo Yii::app()->createUrl('admin/servicetype/ajaxservicetypedelete')?>",
					 
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
			<h1>Service type Listing</h1>
			
			<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/servicetype/addservicetype">
			<section style="float:right;margin-bottom:2px;"><div><button class="reset">Add Service Type</button></div></section>
			</a>
			<table class="datatable">
				<thead>
					<tr>
					    <th>Sr No</th>
					    <th>Image</th>
						<th class="sort">Service Name</th>
						<th>status</th>						
						<th>Action</th>						
					</tr>
				</thead>
				<tbody>

					<?php 
                     $i=1;
					foreach($list as $l) { ?>
					<tr class="gradeX">
					    <td><?php echo $i++;?></td>
						<td>
						     <?php if(!empty($l->image)) { ?>
						          <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $l->image;?>" width="50px;"/>
                            
                             <?php } else { ?>
                               
                                 <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/download.jpg" width="50px;"/>
                            

                             <?php }?>
						</td>
						<td><?php echo $l->service_name; ?></td>
						<?php if($l->status==0) { ?>
						
						<td><a href="javascript:void(0);" id="<?php echo $l->id;?>" class="active">Activate</a> </td>
						
						<?php } else { ?>
                        
                              <td><a href="javascript:void(0);" id="<?php echo $l->id;?>" class="deactive">Deactivate</a></td>

						<?php } ?>
						
						<td class="c">
								<a href ="javascript:void(0)" onclick="dlt(id)"  id="<?php echo $l->id;?>" class="btn i_trashcan"></a>
								<a href="<?php echo Yii::app()->createUrl('admin/servicetype/servicetypeedit')?>/<?php echo $l->id;?>" class="btn i_pencil"></a>
								<a href="<?php echo Yii::app()->createUrl('admin/servicetype/servicetypeview')?>/<?php echo $l->id;?>" class="btn i_folder" title="View Service Type Detail"></a>
			                    <a href="<?php echo Yii::app()->createUrl('admin/servicetype/additionalservicelisting')?>/<?php echo $l->id;?>" class="btn i_folder" title="Additional Service Listing"></a>
			
						</td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

			
		</section>
		
   </body>
