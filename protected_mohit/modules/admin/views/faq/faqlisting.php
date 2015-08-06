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

               $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/faq/ajaxFaqStatus')?>",
					 
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
              



         });
         


        // ajax to deactive the status

        $('.deactive').click(function(){

              var id=$(this).attr('id');

               $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/faq/ajaxFaqDeactivate')?>",
					 
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
              



         });



    }); 




	  function dlt(id)
	  {
	  	 
	  	       
               if(confirm('Are you sure you want to delete this?'))
               {
                    $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/faq/ajaxdeletefaq')?>",
					 
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
			<h1>Faq Listing</h1>
			
			<a href ="<?php echo Yii::app()->request->baseUrl; ?>/admin/faq/addfaq">
			<section style="float:right;margin-bottom:2px;"><div><button class="reset">Add Faq Content</button></div></section>
			</a>
			<table class="datatable">
				<thead>
					<tr>
					    <th>Sr No</th>
						<th class="sort">Question</th>
						
						<th>Answer</th>
						<th>Status</th>
						<th>Action</th>
						
					</tr>
				</thead>

				<tbody>
					<?php 
                     $i=1;
					foreach($list as $l) { ?>
					<tr class="gradeX">
					    <td><?php echo $i++;?></td>

					    <td><?php echo $l->question; ?></td>
                        
						<td>
						<?php
							$desc = $l->answer;
							$len = strlen($desc);
							if($len>50){
								
								$trimmed = substr(strip_tags($desc), 0, 50)."...";
								echo $trimmed;

							}else echo $desc;
						?>
						</td>

                        

						<?php if($l->status==0) { ?>
						
						<td><a href="javascript:void(0);" id="<?php echo $l->id;?>" class="active">Activate</a> </td>
						
						<?php } else { ?>
                        
                              <td><a href="javascript:void(0);" id="<?php echo $l->id;?>" class="deactive">Deactivate</a></td>

						<?php } ?>
						<td class="c"><a href ="javascript:void(0)" onclick="dlt(id)"  id="<?php echo $l->id;?>" class="btn i_trashcan" title="Delete"></a>
						<a href="<?php echo Yii::app()->createUrl('admin/faq/editfaq')?>/<?php echo $l->id;?>" class="btn i_pencil" title="Edit"></a>
						<a href="<?php echo Yii::app()->createUrl('admin/faq/faqview')?>/<?php echo $l->id;?>" class="btn i_folder" title="View"></a></td>
						
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

			
		</section>
		
   </body>
