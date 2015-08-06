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
       var url="<?php echo Yii::app()->createUrl('admin/reviewslisting') ?> ";
       //alert(url);
       location.reload(url);
	}
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
				

				<form id="form" >
					<fieldset>
						<label>Reviews View</label>
						<section><label for="text_field">Company</label>
							<div><?php echo $view->service['company_name'];?></div>
						</section>
						
						<section><label for="text_tooltip">Customer Name</label>
							<div><?php echo $view->customer['cname']." ".$l->customer['clname'];?></div>
						</section>
						<section><label for="text_field">Reviews</label>
							<div><?php echo $view->review;?></div>
						</section>
						
						<section><label for="text_tooltip">Rating</label>
							<div><?php
						$star= $view->rating;
						$a=1;
						$stars=$a*$star;
						$path= Yii::app()->request->baseUrl."/themes/back/css/images/icons/dark/Places-favorites-icon.png";
						for($j=0;$j<$stars;$j++){
						echo "<img src=".$path.">"; 
						}
						?>

</div>
						</section>
					
						
					</fieldset>
				</form>	
				<section>

					<div><button class="reset" onclick="history.go(-1)">Back</button></div>
				</section>
				</div>
		</section>
		
   </body>
