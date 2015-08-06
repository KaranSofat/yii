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
	  
       var url="<?php echo Yii::app()->createUrl('admin/cmslisting') ?> ";
   
       location.reload(url);
	}
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
				

				<form id="form" >
					<fieldset>
						<label>Percentage Cost View</label>
						<section><label for="text_field">Type of Cost</label>
							<div><?php echo $view->type_of_cost;?></div>
						</section>
						
						<section><label for="text_field">Percentage Cost</label>
							<div><?php echo $view->cost_percentage;?></div>
						</section>
												
						
					</fieldset>
				</form>	
				<section>

					<div><button class="reset" onclick="history.go(-1)">Back</button></div>
				</section>
				</div>
		</section>
		
   </body>
