<?php

/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
        <!-- configuration to overwrite settings-->
	<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/config.js"></script> -->
		
	<!-- the script which handles all the access to plugins etc...  -->
	<!-- <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/back/js/script.js">	</script> -->
	<script>
	$(document).ready(function(){
        
	});

	function goBack()
	{
	  //alert("fsfs");	 
       //history.pushState( '', '<?php echo Yii::app()->createUrl('admin/cmslisting')?>');
        //echo Yii::app()->request->baseUrl; ?>/admin/cmslisting
       var url="<?php echo Yii::app()->createUrl('admin/cmslisting') ?> ";
       //alert(url);
       location.reload(url);
	}
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
				

				<form id="form" >
					<fieldset>
						<label>Service Type View</label>
						<section><label for="text_field">Service Name</label>
							<div><?php echo $view->service_name;?></div>
						</section>
						<section><label for="text_tooltip">Image</label>
							 <?php if(!empty($view->image)) { ?>
							<div> <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/<?php echo $view->image;?>" width="50px;"/></div>
					        <?php } else { ?>

                                 <div> <img src="<?php echo Yii::app()->request->baseUrl; ?>/banner/download.jpg" width="50px;"/></div>
					        
					        <?php } ?>
                              
							
						</section>
						<section><label for="text_tooltip">Description</label>
							<div><?php echo $view->desc;?></div>
						</section>
						
						<!--<section>

							<div><button class="reset" onclick="goBack()">Back</button></div>
						</section> -->
						
					</fieldset>
				</form>	
				<section> 
                          
							<div>	
							<button class="reset" name="btnback" onclick="history.go(-1)" >Back</button>			
							</div>
			   </section>
				</div>
		</section>
		
   </body>
