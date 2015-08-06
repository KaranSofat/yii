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
      // var url="<?php echo Yii::app()->createUrl('admin/cmslisting') ?> ";
       //alert(url);
       //location.reload(url);
       window.history.back(-1);return true;
	}
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		
		<section id="content">
				

				<form id="form" >
					<fieldset>
						<label>Company Detail</label>
                        <!-- 
						<section><label for="text_field">Company Name</label>
							<div><?php //echo ucfirst($view->service['company_name']);?></div>
						</section>
						-->
						<section><label for="text_tooltip">Company Name</label>
							<div><?php echo $companyDetail->company_name;?></div>
						</section>
						<section><label for="text_tooltip">Email</label>
							<div><?php echo $companyDetail->email;?></div>
						</section>
						
                        <section><label for="text_tooltip">Company Logo</label>
                            <?php if(!empty($companyDetail->company_logo)) { ?>
							<div> <img src="<?php echo Yii::app()->request->baseUrl; ?>/CompanyLogo/<?php echo $companyDetail->company_logo;?>" width="50px;"/></div>
					        <?php } else { ?>

                                 <div> <img src="<?php echo Yii::app()->request->baseUrl; ?>/CompanyLogo/download.jpg" width="50px;"/></div>
					        
					        <?php } ?>
					 	</section>
                          
                        <section><label for="text_tooltip">City</label>
							<div><?php echo $companyDetail->city;?></div>
						</section>

                        <section><label for="text_tooltip">Post Code</label>
							<div><?php echo $companyDetail->zipcode;?></div>
						</section>

                        <section><label for="text_tooltip">No Of Jobs Done</label>
							<div><?php echo $companyDetail->jobsdone;?></div>
						</section>
                       
                         <label>Other Details</label>
                       
                        <?php if(!empty($service)) { ?> 
                        <section><label for="text_tooltip">Type Of Services </label>
							<div>
							<?php foreach($service as $ser) { ?>

							 <?php echo $ser ." <br/>";?>
                              
                            <?php } ?>
							</div>
						</section>
						<?php } else { ?>
                       

                           <section><label for="text_tooltip">  </label>
							<div>
							      Not yet added.
							</div>
						</section>

						<?php } ?>
                         

                        <!--
						<section><label for="text_tooltip">Price</label>
							<div><?php //echo $view->price."$";?></div>
						</section>

					
                         <section> 
                          
                           <button class="reset" name="btnback" onclick="goBack()" >Back</button> 
                        
                         
							<div>				
							</div>
						</section>	-->
						
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
