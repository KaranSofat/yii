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
						<label>Price View</label>
                         
						<section><label for="text_field">Company Name</label>
							<div><?php echo ucfirst($view->service['company_name']);?></div>
						</section>
						
						<section><label for="text_tooltip">Service Type</label>
							<div><?php echo $view->serviceType['service_name'];?></div>
						</section>
						<section><label for="text_tooltip">Bedroom Price/hr</label>
							<div><?php echo $view->bedroom."  "."\xE2\x82\xAc";?></div>
						</section>
						
                        <section><label for="text_tooltip">Bathroom Price/hr</label>
							<div><?php echo $view->bathroom."  "."\xE2\x82\xAc";?></div>
						</section>

						<section><label for="text_tooltip">Living Room Price/hr</label>
							<div><?php echo $view->living_room."  "."\xE2\x82\xAc";?></div>
						</section>

						<section><label for="text_tooltip">Kitchen StairCase Price/hr</label>
							<div><?php echo $view->kitchen_staircases."  "."\xE2\x82\xAc";?></div>
						</section>

						<section><label for="text_tooltip">Carpets Interior Windows Price/hr</label>
							<div><?php echo $view->carpets_interior_windows."  "."\xE2\x82\xAc";?></div>
						</section>

						

                          
                        <?php if(!empty($view->property) ||  !empty($view->no_of_desk)) { ?>
                        
		                        <section><label for="text_tooltip">Property Price/hr</label>
									<div><?php echo $view->property."  "."\xE2\x82\xAc";?></div>
								</section>

								<section><label for="text_tooltip">Desk Price/hr </label>
									<div><?php echo $view->desk ."  "."\xE2\x82\xAc";?></div>
								</section>
                                
                                <section><label for="text_tooltip">Cupboards Price/hr </label>
									<div><?php echo $view->cupboards ."  "."\xE2\x82\xAc";?></div>
								</section>

                                 <section><label for="text_tooltip">Kitchen Price/hr </label>
									<div><?php echo $view->kitchen ."  "."\xE2\x82\xAc";?></div>
								</section>

								 <section><label for="text_tooltip">Staircases Price/hr </label>
									<div><?php echo $view->staircases ."  "."\xE2\x82\xAc";?></div>
								</section>
								 <section><label for="text_tooltip">Elevator Price/hr </label>
									<div><?php echo $view->elevator ."  "."\xE2\x82\xAc";?></div>
								</section>


                        <?php } ?>
                        
                        <section><label for="text_tooltip">Cleaning Material Price/hr</label>
							<div><?php echo $view->cleaning_material_price."  "."\xE2\x82\xAc";?></div>
						</section>
					
						
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
