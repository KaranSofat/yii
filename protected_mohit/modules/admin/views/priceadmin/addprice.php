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

        //onload chnage get the rec
          var val=$( ".serviceType option:selected" ).text();

            
            var serviceTypeId=$( ".serviceType option:selected" ).val();

            var companyId=$(".company option:selected").val();

            


         $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/priceadmin/ajaxServiceTypeFieldName')?>",
					 
					                data:{'serviceTypeId':serviceTypeId,'companyId':companyId},
					                dataType: "json",
								   success:function(data)
								   {

                                      //alert(data)

								   	  document.getElementById("formId").value = data['id'];
								   	  document.getElementById("PriceAdmin_bedroom").value = data['bedroom'];
								      document.getElementById("PriceAdmin_bathroom").value = data['bathroom'];
								      document.getElementById("PriceAdmin_property").value = data['property'];
								      document.getElementById("PriceAdmin_desk").value = data['desk'];
								      document.getElementById("PriceAdmin_cleaning_material_price").value = data['cleaning_material_price'];
								      

								      return true;
								     //alert(result);
								   
								   },
								   error: function (result) {
										//alert("Error.")
									
									      return false;
									}
			       });

  

        
        
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
                $(".notofc").hide();    
            }
            else
            {
                $(".abc").hide();
                $(".notofc").show();
                //$("span").removeClass("error required");

            }

            //get the newly added field name 

            $.ajax({
		    	                   type:'GET',  
					               url:"<?php echo Yii::app()->createUrl('admin/priceadmin/ajaxServiceTypeFieldName')?>",
					 
					                data:{'serviceTypeId':serviceTypeId,'companyId':companyId},
					                dataType: "json",
								   success:function(data)
								   {


								   	  document.getElementById("formId").value = data['id'];
								   	  document.getElementById("PriceAdmin_bedroom").value = data['bedroom'];
								      document.getElementById("PriceAdmin_bathroom").value = data['bathroom'];
								      document.getElementById("PriceAdmin_property").value = data['property'];
								      document.getElementById("PriceAdmin_desk").value = data['desk'];
								      document.getElementById("PriceAdmin_cleaning_material_price").value = data['cleaning_material_price'];
								      

								      document.getElementById("PriceAdmin_living_room").value                =data['living_room'];
								      document.getElementById("PriceAdmin_kitchen_staircases").value         =data['kitchen_staircases'];
								      document.getElementById("PriceAdmin_carpets_interior_windows").value   =data['carpets_interior_windows'];
								      document.getElementById("PriceAdmin_cupboards").value                  =data['cupboards'];
								      document.getElementById("PriceAdmin_kitchen").value                    =data['kitchen'];
								      document.getElementById("PriceAdmin_staircases").value                 =data['staircases'];
								      document.getElementById("PriceAdmin_elevator").value                   =data['elevator'];
								
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
					                dataType: "json",
								   success:function(data)
								   {
								   	   
                                       //alert(data);
								   	   //$(".res").html(result);
								   	  
								   	  	
								   	  document.getElementById("formId").value = data['id'];
								      
								      document.getElementById("PriceAdmin_bedroom").value = data['bedroom'];
								      document.getElementById("PriceAdmin_bathroom").value = data['bathroom'];
								      document.getElementById("PriceAdmin_property").value = data['property'];
								      document.getElementById("PriceAdmin_desk").value = data['desk'];
								      document.getElementById("PriceAdmin_cleaning_material_price").value = data['cleaning_material_price'];
								      
								      document.getElementById("PriceAdmin_living_room").value                =data['living_room'];
								      document.getElementById("PriceAdmin_kitchen_staircases").value         =data['kitchen_staircases'];
								      document.getElementById("PriceAdmin_carpets_interior_windows").value   =data['carpets_interior_windows'];
								      document.getElementById("PriceAdmin_cupboards").value                  =data['cupboards'];
								      document.getElementById("PriceAdmin_kitchen").value                    =data['kitchen'];
								      document.getElementById("PriceAdmin_staircases").value                 =data['staircases'];
								      document.getElementById("PriceAdmin_elevator").value                   =data['elevator'];
								
                                       return true;
								      
								   
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

				<input type="hidden" id="formId" value="" name="PriceAdmin[recid]">
					<fieldset>
						<label>Add Service Price </label>
						
						<section><?php echo $form->labelEx($model,'service_id',array('label'=>'Company')); ?>
							
							<div>
							      
							     
							     <?php 
							     	$result = array();
							     foreach($user as $service_user) { ?>
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
						<section><?php echo $form->labelEx($model,'bedroom',array('label'=>' Bedroom Price')); ?>
							<div>

                                 $ <?php echo $form->textField($model,'bedroom',array('class'=>'integer','type'=>'number','min'=>'1','max'=>'2')); ?>
	                              <?php echo $form->error($model,'bedroom'); ?>
	                              /
	                              <?php echo $form->textField($model,'bedroom_hr',array('class'=>'integer','type'=>'number','min'=>'1','max'=>'2')); ?>
	                              <?php echo $form->error($model,'bedroom_hr'); ?>
	                              hour(s)
							</div>
						</section>
						<section><?php echo $form->labelEx($model,'bathroom',array('label'=>' Bathroom Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'bathroom',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'bathroom'); ?>
	                              /
	                              <?php echo $form->textField($model,'bathroom_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'bathroom_hr'); ?>
								  hour(s)
							</div>
						</section>
                        <!-- extras field added not for office cleaning-->
						<section class="notofc"><?php echo $form->labelEx($model,'living_room',array('label'=>'Living Room Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'living_room',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'living_room'); ?>
								  /
								  <?php echo $form->textField($model,'living_room_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'living_room_hr'); ?>
	                              hour(s)
							</div>
						</section>
						<section class="notofc"><?php echo $form->labelEx($model,'kitchen_staircases',array('label'=>'Kitchen Staircases Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'kitchen_staircases',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'kitchen_staircases'); ?>
	                              /
								  <?php echo $form->textField($model,'kitchen_staircases_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'kitchen_staircases_hr'); ?>
	                              hour(s)
							</div>
						</section>
						<section class="notofc"><?php echo $form->labelEx($model,'carpets_interior_windows',array('label'=>'Carpets Interior Windows Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'carpets_interior_windows',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'carpets_interior_windows'); ?>
								  /
								  <?php echo $form->textField($model,'carpets_interior_windows_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'carpets_interior_windows_hr'); ?>
	                              hour(s)
							</div>
						</section>
						<!-- extras field added not for office cleaning -->
						<section class="abc"><?php echo $form->labelEx($model,'property',array('label'=>'Square Feet')); ?>
							<div>

                                  $<?php echo $form->textField($model,'property',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'property');   ?>
								  /
								  <?php echo $form->textField($model,'property_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'property_hr');   ?>
	                              hour(s)
							</div>
						</section>
						
						
						<section class="abc"><?php echo $form->labelEx($model,'desk',array('label'=>' Desk Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'desk',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'desk'); ?>
								  /
								  <?php echo $form->textField($model,'desk_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'desk_hr'); ?>
	                              hour(s)
							</div>
						</section>
                        <!--Extra ofc fields  -->
						<section class="abc"><?php echo $form->labelEx($model,'cupboards',array('label'=>' CupBoards Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'cupboards',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'cupboards'); ?>
	                              /
								  <?php echo $form->textField($model,'cupboards_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'cupboards_hr'); ?>
	                              hour(s)
							</div>
						</section>

							<section class="abc"><?php echo $form->labelEx($model,'kitchen',array('label'=>'Kitchen Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'kitchen',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'kitchen'); ?>
								  /
								  <?php echo $form->textField($model,'kitchen_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'kitchen_hr'); ?>
	                              hour(s)
							</div>
						</section>
                       

							<section class="abc"><?php echo $form->labelEx($model,'staircases',array('label'=>'StairCases Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'staircases',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'staircases'); ?>
							      /
							      <?php echo $form->textField($model,'staircases_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'staircases_hr'); ?>
	                              hour(s)
							</div>
						</section>
						<section class="abc"><?php echo $form->labelEx($model,'elevator',array('label'=>'Elevator Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'elevator',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'elevator'); ?>
								  /
								  <?php echo $form->textField($model,'elevator_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php  echo $form->error($model,'elevator_hr'); ?>
	                              hour(s)
							</div>
						</section>
						<!-- Extra ofc fields -->

						
                        <section><?php echo $form->labelEx($model,'cleaning_material_price',array('label'=>' Cleaning Material Price')); ?>
							<div>

                                  $<?php echo $form->textField($model,'cleaning_material_price',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'cleaning_material_price'); ?>
								  /
								  <?php echo $form->textField($model,'cleaning_material_price_hr',array('class'=>'integer','type'=>'number')); ?>
	                              <?php echo $form->error($model,'cleaning_material_price_hr'); ?>
	                              hour(s)
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
