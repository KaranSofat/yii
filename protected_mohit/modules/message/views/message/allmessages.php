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
					               url:"<?php echo Yii::app()->createUrl('message/message/deletemsg')?>",
					 
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
			<h1>Message Listing</h1>
			
			<a href ="<?php echo Yii::app()->request->baseUrl; ?>/message/message/createmessage">
			<section style="float:right;margin-bottom:2px;"><div><button class="reset">Create Message</button></div></section>
			</a>
			<table class="datatable">
				<thead>
					<tr>
					    <th>From</th>
					    <th>Message</th>																	
						<th>Action</th>						
					</tr>
				</thead>
				<tbody>

					<?php 
                    
					foreach($list as $l) { 
                     
                          if($l->conversation['reciver_type']=='company')
                          {
                          	 $rec=ServiceUser::model()->findByAttributes(array('id'=>$l->conversation['reciver_id']));
                          	 $name=$rec->company_name;
                          }	


					?>
					<tr class="gradeX">

					    <td> <?php if($l->user_type=='admin'){echo "Me:";} else { echo ucfirst($name);}?></td>
						
						<td><?php echo $l->msg;?></td>
				    
						
						<td class="c">
						<a href ="javascript:void(0)" onclick="dlt(id)"  id="<?php echo $l->id;?>" class="btn i_trashcan"></a>
							
						</td>
						
					</tr>
				 <?php } ?>
				</tbody>
			</table>
		</div>

			
		</section>
		
   </body>
