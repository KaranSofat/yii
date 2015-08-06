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
						<label>Customer Payment Detail</label>
                        

                                      
                                                 

                        <section><label for="text_tooltip">Comapny</label>
							<div><?php echo $detail->service['company_name'];?></div>
						</section>
                        

                        <section><label for="text_tooltip">Service Type</label>
							<div><?php echo $detail->serviceType['service_name'];?></div>
						</section>


                        <section><label for="text_tooltip">Address For Cleaning</label>
							<div><?php echo $detail->customerAddress['address'];?></div>
						</section>


                        <section><label for="text_tooltip">Cleaning Detail</label>
							<div><?php echo $detail['cleaningDetail'];?></div>
						</section>

						 <section><label for="text_tooltip">Transaction Id</label>
							<div><?php echo $detail['trans_id'];?></div>
						</section>


						 <section><label for="text_tooltip">Price</label>
							<div><?php echo $detail['price'];?></div>
						</section>

                        <?php if(!empty($detail['additional'])) { ?>
                        <section><label for="text_tooltip">Additional Detail</label>
							<div><?php echo $detail['additional'];?></div>
						</section>

					   <?php } ?>	
                     
                   
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
