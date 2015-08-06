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

	
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
				

				<form id="form" >
					<fieldset>
						<label>Blog Detail</label>
						<section><label for="text_field">Title</label>
							<div><?php echo $view->title;?></div>
						</section>
						<section><label for="text_tooltip">Content </label>
							<div><?php echo $view->content;?></div>
						</section>
						<section><label for="text_tooltip">Tags</label>
							<div><?php echo $view->tags;?></div>
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
		</section>
		
   </body>
