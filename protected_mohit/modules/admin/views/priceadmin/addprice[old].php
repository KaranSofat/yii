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

       	//$("#price-form").validate({});
		//$("#price-form").validate({});
        
        var chk=$(".serviceType option:selected").val();

        var company=$(".company option:selected").val();
        //alert(company);

        
         // onload get the rec from db 
            

            var val=$( ".serviceType option:selected" ).text();

            
            var serviceTypeId=$( ".serviceType option:selected" ).val();

            var companyId=$(".company option:selected").val();

           $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/priceadmin/ajaxServiceTypeFieldName')?>",
					 
					                data:{'serviceTypeId':serviceTypeId,'companyId':companyId},
								   success:function(result)
								   {
								   	   //$(".res").html(result);
								      //alert(result);
								      //location.reload()
								      return true;
								     //alert(result);
								   
								   },
								   error: function (result) {
										//alert("Error.")
									
									      return false;
									}
			       });


         // onload get the record from db ends here



        
        
        $("#mServiceProvider").val(company); 

        $("#mService").val(chk); 

        if(chk !='3')
        {	
		  $(".abc").hide();
        }
        

        $(".serviceType").change(function(){

            var val=$( ".serviceType option:selected" ).text();

            
            var serviceTypeId=$( ".serviceType option:selected" ).val();

            var companyId=$(".company option:selected").val();

           

            if(val=="Office cleaning")
            {
                $(".abc").show();    
            }
            else
            {
                $(".abc").hide();
                //$("span").removeClass("error required");

            }

            //get the newly added field name 

            $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/priceadmin/ajaxServiceTypeFieldName')?>",
					 
					                data:{'serviceTypeId':serviceTypeId,'companyId':companyId},
								   success:function(result)
								   {
								   	   //$(".res").html(result);
								      //alert(result);
								      //location.reload()
								      return true;
								     //alert(result);
								   
								   },
								   error: function (result) {
										//alert("Error.")
									
									      return false;
									}
			       });




        });
        
        

        $(".company").change(function(){
               
                var company=$(".company option:selected").val();
                $("#mServiceProvider").val(company); 

                 var serviceTypeId=$( ".serviceType option:selected" ).val();

                  var companyId=$(".company option:selected").val();
                 //get the newly added field name 

            $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/priceadmin/ajaxServiceTypeFieldName')?>",
					 
					                data:{'serviceTypeId':serviceTypeId,'companyId':companyId},
								   success:function(result)
								   {
								   	   $(".res").html(result);
								      //alert(result);
								      //location.reload()
								      document.getElementById("PriceAdmin_bedroom").value=result;
								      return true;
								     //alert(result);
								   
								   },
								   error: function (result) {
										//alert("Error.")
									
									      return false;
									}
			       });



        });


       

       //jquery to delete the added attribute using ajax ends here

        $(".btnDlt").live('click',function(){
          
            var val=$(this).attr("id");

            $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/price/ajaxAddedAttrDlt')?>",
					 
					                data:{'val':val},
								   success:function(result)
								   {
								   	   //$(".res").html(result);
								      //alert(result);

								      location.reload();
								      $(".success").show();
								      return true;
								     //alert(result);
								   
								   },
								   error: function (result) {
										//alert("Error.")
									
									      return false;
									}
			       });
             
        });
        // jquery to delete the added attribute using ajax ends here
          
        

	});


	
	</script>

	

	<?php  include('themes/back/views/layouts/left_sidebar.php'); ?>


	<body>
		<section id="content">
		       
		       <div class="alert success" style="display:none;">Successfully deleted.</div>

              <?php $form=$this->beginWidget('CActiveForm', array(
			        'action'=> Yii::app()->createUrl('admin/priceadmin/addprice'),
					'id'=>'price-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
					'validateOnSubmit'=>true,

					),
				)); ?>
					<fieldset>
						<label>Add Service Price </label>
						
						<section><?php echo $form->labelEx($model,'service_id',array('label'=>'Company')); ?>
							
							<div>
							      
							     
							     <?php foreach($user as $service_user) { ?>
                                               <?php   
                                               $cname[]=ucfirst($service_user->company_name);
                                               $s_id[]=$service_user->id;
                                               $result=array_combine($s_id,$cname); ?>
							      <?php } ?>
							      <?php  //echo $form->dropDownList($model,'service_id',array('0'=>'select')) ?>
							      
                                  	<?php echo $form->dropDownList($model,'service_id',$result,array('class'=>'company')); ?>
	                                                           
	                              <?php echo $form->error($model,'service_id'); ?>
                                 
	                        </div>
	                         
						</section>
                        
						
						<section><?php echo $form->labelEx($model,'service_type_id',array('label'=>'Service Type')); ?>
							
							<div>
							      
							     
							      <?php foreach($serType as $res)  { ?>

								              <?php 
								                    $arr[]=$res->service_name;
								                    
								                    $id[]=$res->id;
                                                    
								                    $types=array_combine($id,$arr);     
								              ?>
							      <?php } ?>
							      <?php  //echo $form->dropDownList($model,'service_id',array('0'=>'select')) ?>
							      <?php  echo $form->dropDownList($model,'service_type_id',$types,array('class'=>'serviceType')); ?>
                                   	                             
	                              <?php echo $form->error($model,'service_id'); ?>
                                 
	                        </div>
	                         
						</section>
						<section><?php echo $form->labelEx($model,'bedroom',array('label'=>' Bed Price')); ?>
							<div>

                                  <?php echo $form->textField($model,'bedroom',array('class'=>'integer','type'=>'number','min'=>'1','max'=>'2')); ?>
	                              <?php echo $form->error($model,'bedroom'); ?>

							</div>
						</section>
						<section><?php echo $form->labelEx($model,'bathroom',array('label'=>' Bathroom Price')); ?>
							<div>

                                  <?php echo $form->textField($model,'bathroom',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'bathroom'); ?>

							</div>
						</section>
						
						<section class="abc"><?php echo $form->labelEx($model,'property',array('label'=>' Square Feet')); ?>
							<div>

                                  <?php echo $form->textField($model,'property',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'property');   ?>

							</div>
						</section>
						
						
						<section class="abc"><?php echo $form->labelEx($model,'desk',array('label'=>' Desk Price')); ?>
							<div>

                                  <?php echo $form->textField($model,'desk',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'desk'); ?>

							</div>
						</section>
						
                       

                      <section class="res">
							
						</section> 
                        <?php //echo "<pre>";print_r($resAttr);die;?>
						<section class="rename">
							
						</section> 

					</fieldset>
					
						<section>
							<div>
									<!--<button class="reset">Reset</button>-->
                                    <button class="submit" style=" height: 38px;line-height:6px;text-transform:none;width:58px !important;">
									<?php echo CHtml::submitButton('Submit',array('class'=>'button reset')); ?>
									</button>
									<!--<button class="submit" name="submitbuttonname" value="submitbuttonvalue">Submit</button>-->
							</div>
						</section>
					</fieldset>
				<?php $this->endWidget(); ?>

                                    
		</section> 
      
		
   </body>
